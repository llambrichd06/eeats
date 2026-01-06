const buttons = document.getElementsByClassName('nav-link');
const buttonList = Array.from(buttons);

const sections = document.getElementsByClassName('content-section');
const sectionList = Array.from(sections);

const submits = document.getElementsByClassName('submitButton');
const submitList = Array.from(submits);


buttonList.forEach(button => { //Nav buttons event listeners, in case of click, highlight the button and show the corresponding section, while hiding the others
    button.addEventListener('click', btn => {
        buttonList.forEach(b => {
            b.classList.remove('btn-primary', 'btn-class');
        });
        btn.target.classList.add('btn-primary', 'btn-class');
        showSection(btn.target.getAttribute('for'));
    })
})


function showSection(attrName) {
    sectionList.forEach(section => {
        section.classList.remove('show');
    })
    const selectedSection = document.getElementById(attrName)
    selectedSection.classList.add('show')
}

//FREECURRENCYAPI SELECTOR

let currentCurrency = "EUR";
let currencyRates = { EUR: 1 };
const storedCurrencyKey = "selectedCurrency";
loadCurrencyRates();

async function loadCurrencyRates() {
    const res = await fetch(
        "https://api.freecurrencyapi.com/v1/latest?apikey=" + freeCurrencyApiKey + "&base_currency=EUR"
    );
    const data = await res.json();
    currencyRates = { EUR: 1, ...data.data };
    loadSavedCurrency();
    createCurrencySelector();
}
function loadSavedCurrency() {
    const saved = localStorage.getItem(storedCurrencyKey);

    if (saved && currencyRates[saved]) {
        currentCurrency = saved;
    } else {
        currentCurrency = "EUR";
    }
    console.log(currentCurrency)
}

// CONTINUE WITH THE CHATGPT RESPONSE FOR THE IMPLEMENTATION OF FREECURRENCYAPI
function createCurrencySelector() {
    const wrapper = document.getElementById("currencySelector");

    const select = document.createElement("select");
    select.className = "form-select w-auto";

    Object.keys(currencyRates).forEach(code => {
        const option = document.createElement("option");
        option.value = code;
        option.textContent = code;
        if (code === currentCurrency) option.selected = true;
        select.appendChild(option);
    });
    updateAllDisplayedPrices();

    select.addEventListener("change", e => {
        currentCurrency = e.target.value;
        localStorage.setItem(storedCurrencyKey, currentCurrency);
        updateAllDisplayedPrices();
    });

    wrapper.appendChild(select);
}

function convertPrice(eurValue) {
    const rate = currencyRates[currentCurrency] || 1;//the two bars beans that if the currency is not found, it will default to 1 (so the value isnt changed)
    return (eurValue * rate).toFixed(2);
}

function updateAllDisplayedPrices() {
    document.querySelectorAll(".price-cell").forEach(cell => { //get all the table cells with the price class and update their displayed value
        const eur = parseFloat(cell.dataset.eur);
        cell.textContent = convertPrice(eur);
    });
}

