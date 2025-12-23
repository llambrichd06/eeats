const userForm = document.getElementById('userForm');

const userId = document.getElementById('userId');
const userIdDisplay = document.getElementById('userIdDisplay');
const userName = document.getElementById('userName');
const userEmail = document.getElementById('userEmail');
const userProfile = document.getElementById('userPFP');
const userPassword = document.getElementById('userPass');
const userRole = document.getElementById('userRole');
const userNormalRole = document.getElementById('userNormalRole');
const userAdminRole = document.getElementById('userAdminRole');
const userPremium = document.getElementById('userIsPremium');

showUsers();

async function showUsers() {
    fetch(currentApiURL+"?controller=User&action=getUsers", {
        method: 'GET'
    }).then(r => r.json())
    .then(r => {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = "";
        r.forEach(user => {
            const newUser = new User(user.id, user.name, user.email, user.profile_picture, user.password, user.role, user.premium);
            const userRow = document.createElement('tr');

            Object.entries(newUser).forEach(([key, userData]) => { 
                const block = document.createElement('td');
                block.innerHTML = userData;
                userRow.append(block);
            });

            for (let i = 0; i < 2; i++) {
                const buttonBlock = document.createElement('td');
                const button = document.createElement('button');
                if (i == 0) {
                    button.classList.add('userEditButton', 'btn', 'btn-secondary');
                    button.innerHTML = 'Edit';
                    button.addEventListener('click', () => {
                        userId.value = newUser.getId();
                        userIdDisplay.innerHTML = newUser.getId();
                        userName.value = newUser.getName();
                        userEmail.value = newUser.getEmail();
                        userProfile.value = newUser.getProfilePicture();
                        userPassword.value = newUser.getPassword();
                        if (newUser.getRole() == 'user') userNormalRole.selected = true;
                        if (newUser.getRole() == 'admin') userAdminRole.selected = true;
                        userPremium.checked = newUser.getPremium() == 1 ? true : false;
                    })
                } else {
                    button.classList.add('userRemoveButton', 'btn', 'btn-danger');
                    button.innerHTML = 'Delete';
                    button.addEventListener('click', () => {
                        let idRemoved = newUser.getId();
                        fetch(currentApiURL+"?controller=User&action=deleteUser", {
                            method: DELETE,
                            body: JSON.stringify({
                                id: idRemoved
                            })
                        }).then(setTimeout(showUsers(), 50));
                    })
                }
                buttonBlock.append(button);
                userRow.append(buttonBlock);
            }
            tbody.append(userRow);
        })
    })
}



userForm.addEventListener('submit', async f => {
    f.preventDefault();

    const button = f.submitter;
    button.disabled = true;

    let nameValue = f.target[1].value;
    let emailValue = f.target[2].value;
    let profileValue = f.target[3].value;
    let passwordValue = f.target[4].value;
    let roleValue = f.target[5].value;
    let premiumValue = f.target[6].checked ? 1 : 0;

    if (f.target[0].value.length != 0) {
        let idValue = f.target[0].value;
        await fetch(currentApiURL+"?controller=User&action=editUser", {
            method: PUT,
            body: JSON.stringify({
                id: idValue,
                name: nameValue, 
                email: emailValue, 
                profile_picture: profileValue, 
                password: passwordValue, 
                role: roleValue, 
                premium: premiumValue,
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
            })
        })
    }

    await showUsers();
    button.disabled = false;
})

userForm.addEventListener('reset', f => {
    userIdDisplay.innerHTML = 'No Id Selected';
    userId.value = "";
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
