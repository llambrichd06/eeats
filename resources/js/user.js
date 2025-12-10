const forms = document.getElementsByClassName('dataForm');
const formList = Array.from(forms);

const id = document.getElementById('userId');
const idDisplay = document.getElementById('userIdDisplay');
const name = document.getElementById('userName');
const email = document.getElementById('userEmail');
const profile = document.getElementById('userPFP');
const password = document.getElementById('userPass');
const role = document.getElementById('userRole');
const userRole = document.getElementById('userNormalRole');
const adminRole = document.getElementById('userAdminRole');
const premium = document.getElementById('userIsPremium');

async function showUsers() { //how do i make stuff wait for this function's result??
    fetch(currentApiURL+"?controller=User&action=getUsers", {
        method: 'GET'
    }).then(r => r.json())
    .then(r => {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = "";
        r.forEach(user => {
            const newUser = new User(user.id, user.name, user.email, user.profile_picture, user.password, user.role, user.premium) 
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
                        id.value = newUser.getId();
                        idDisplay.innerHTML = newUser.getId();
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
                    button.addEventListener('click', btn => {
                        let idRemoved = newUser.getId();
                        fetch(currentApiURL+"?controller=User&action=deleteUser", {
                            method: 'DELETE',
                            body: JSON.stringify({
                                id: idRemoved
                            })
                        }).then(showUsers());
                        
                    })
                }
                buttonBlock.append(button);
                userRow.append(buttonBlock);

            }
            tbody.append(userRow);
        })
    })
}
showUsers();
formList.forEach(form => {
    form.addEventListener('submit', async f => {
        f.preventDefault();
        console.log(f);

        const button = f.submitter;
        button.disabled = true; // Find a way to do this only untill data is updated
        let nameValue = f.target[1].value;
        let emailValue = f.target[2].value;
        let profileValue = f.target[3].value;
        let passwordValue = f.target[4].value;
        let roleValue = f.target[5].value;
        let premiumValue = f.target[6].value == 'on' ? 1 : 0;
        console.log(f.target[0].value.length)
        if (f.target[0].value.length != 0) {
            let idValue = f.target[0].value;
            await fetch(currentApiURL+"?controller=User&action=editUser", {
                method: 'PUT',
                body: JSON.stringify({
                    id: idValue,
                    name: nameValue, 
                    email: emailValue, 
                    profile_picture: profileValue, 
                    password: passwordValue, 
                    role: roleValue, 
                    premium: premiumValue,
                    deleted: 0
                })
            })
        } else {
            await fetch(currentApiURL+"?controller=User&action=saveUser", {
                method: 'POST',
                body: JSON.stringify({
                    name: nameValue, 
                    email: emailValue, 
                    profile_picture: profileValue, 
                    password: passwordValue, 
                    role: roleValue, 
                    premium: premiumValue,
                    deleted: 0
                })
            })
        }
        await showUsers();
        button.disabled = false;
    })
})

formList.forEach(form => {
    form.addEventListener('reset', f => {
        idDisplay.innerHTML = 'No Id Selected';
        id.value = "";
    })
})
class User {
    constructor(id, name, email, profile_picture, password, role, premium)  {
        this.id = id;
        this.name = name;
        this.email = email;
        this.profile_picture = profile_picture;
        this.password = password;
        this.role = role;
        this.premium = premium;
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
}