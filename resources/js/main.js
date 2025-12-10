const buttons = document.getElementsByClassName('nav-link');
const buttonList = Array.from(buttons);

const sections = document.getElementsByClassName('content-section');
const sectionList = Array.from(sections);

const submits = document.getElementsByClassName('submitButton');
const submitList = Array.from(submits);

const forms = document.getElementsByClassName('dataForm');
const formList = Array.from(forms);

const id = document.getElementById('userId');
const name = document.getElementById('userName');
const email = document.getElementById('userEmail');
const profile = document.getElementById('userPFP');
const password = document.getElementById('userPass');
const role = document.getElementById('userRole');
const userRole = document.getElementById('userNormalRole');
const adminRole = document.getElementById('userAdminRole');
const premium = document.getElementById('userIsPremium');

const currentApiURL = 'http://eeats.com/api.php'

fetch(currentApiURL+"?controller=User&action=getUsers", {
    method: 'GET'
}).then(r => r.json())
.then(r => {
    const tbody = document.getElementById('userTableBody')
    r.forEach(user => {
        const newUser = new User(user.id, user.name, user.email, user.profile_picture, user.password, user.role, user.premium, user.deleted) 
        const userRow = document.createElement('tr');
        /**
         * This is to iterate the values inside of the user class
         * if i dont separate the key and the value itself, it puts both in the same variable
         */
        Object.entries(newUser).forEach(([key, userData]) => { 
            const block = document.createElement('td');
            block.innerHTML = userData;
            userRow.append(block);
        });

        for (let i = 0; i < 2; i++) {
            const buttonBlock = document.createElement('td');
            const button = document.createElement('button');
            if (i == 0) {
                button.classList.add('userEditButton');
                button.innerHTML = 'Edit';
                button.addEventListener('click', btn => {
                    id.innerHTML = newUser.getId();
                    name.value = newUser.getName();
                    email.value = newUser.getEmail();
                    profile.value = newUser.getProfilePicture();
                    password.value = newUser.getPassword();
                    if (newUser.getRole() == 'user') userRole.selected = true;
                    if (newUser.getRole() == 'admin') adminRole.selected = true;
                    premium.checked = newUser.getPremium() == 1 ? true : false;
                })
            } else {
                button.classList.add('userRemoveButton');
                button.innerHTML = 'Delete';
            }
            buttonBlock.append(button);
            userRow.append(buttonBlock);
            
        }
        

        tbody.append(userRow);
    })
})



buttonList.forEach(button => {
    button.addEventListener('click', btn => {
        buttonList.forEach(b => {
            b.classList.remove('btn-primary', 'btn-class');
        });
        btn.target.classList.add('btn-primary', 'btn-class');
        showSection(btn.target.getAttribute('for'));
    })
})
formList.forEach(form => {
    form.addEventListener('submit', f => {
        f.preventDefault();
        console.log(f);

        const button = f.submitter;
        // button.disabled = true; // Find a way to do this only untill data is updated
        // id = 
        // name = 
        // email = 
        // profile = 
        // password = 
        // role = 
        // premium = 

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

class User {
    constructor(id, name, email, profile_picture, password, role, premium, deleted)  {
        this.id = id;
        this.name = name;
        this.email = email;
        this.profile_picture = profile_picture;
        this.password = password;
        this.role = role;
        this.premium = premium;
        this.deleted = deleted;
    }

    getId() {
        return this.id;
    }
    getName() {
        return this.name;
    }
    getEmail() {
        return this.email;
    }
    getProfilePicture() {
        return this.profile_picture;
    }
    getPassword() {
        return this.password;
    }
    getRole() {
        return this.role;
    }
    getPremium() {
        return this.premium;
    }
    getDeleted() {
        return this.deleted;
    }
}

