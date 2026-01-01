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



