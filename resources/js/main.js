const buttons = document.getElementsByClassName('nav-link');
const buttonList = Array.from(buttons);

const sections = document.getElementsByClassName('content-section');
const sectionList = Array.from(sections);

const submits = document.getElementsByClassName('submitButton');
const submitList = Array.from(submits);



const currentApiURL = 'http://eeats.com/api.php'; //If we want to edit the api URL for the server, we just have to touch this variable
const PUT = 'PUT'; //IN CASE WE USE A HOSTING THAT DOESEN'T LET YOU USE PUT PATCH AND DELETE, JUST SET ALL OF THESE TO POST;
const PATCH = 'PATCH';
const DELETE = 'DELETE';




buttonList.forEach(button => {
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
    console.log(selectedSection);
    selectedSection.classList.add('show')
}



