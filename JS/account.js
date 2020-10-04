const slideAccount = document.querySelector('.side-bar-responsive .slide')
const sideBarResAccount = document.querySelector('.side-bar-responsive')
const sideBarAccount = document.getElementById('side-bar-account')

window.onload = () => {
    if(window.location.pathname.includes('changeName')) change.name()
    else if(window.location.pathname.includes('changeCountry')) change.country()
    else if(window.location.pathname.includes('changePassword')) change.password()
    if(!window.location.pathname.includes('change')) responsive()
}
window.onresize = () => {
    if(!window.location.pathname.includes('change')) responsive()
}

function responsive() {
   if(window.innerWidth < 780) {
        sideBarResAccount.classList.remove('disable')
        sideBarAccount.classList.add('disable')
        slideAccount.style.width = window.innerWidth + 'px'
        if(window.innerWidth > 430) {
            sideBarResAccount.style.alignItems = 'center'
            sideBarResAccount.style.justifyContent = 'center'
        }
    } else {
        sideBarAccount.classList.remove('disable')
        sideBarResAccount.classList.add('disable')
    }
}


async function logout(string) {
    await fetch(`../include/logout.inc.php`)
    openLinks(filePath.headlines + string);
}

function openLinks(string) { window.location.replace(websiteURL + string) }

const icon = `<i class="fas fa-exclamation-circle fa-lg"></i>`
const name = document.querySelector('.name-container')
const surname = document.querySelector('.surname-container')
const nameInput = document.getElementById('name-input')
const surnameInput = document.getElementById('surname-input')
const nameError = document.querySelector('.error.name')
const surnameError = document.querySelector('.error.surname')
const genderError = document.querySelector('.error.gender')
const countryError = document.querySelector('.error.country')

let pswOld = document.querySelector('.psw-old-container')
let pswOldInput = document.getElementById('psw-old-input')
let psw = document.querySelector('.psw-container')
let pswRepeat = document.querySelector('.psw-repeat-container')
let pswInput = document.getElementById('psw-input')
let pswRepeatInput = document.getElementById('psw-repeat-input')
let pswError = document.querySelector('.error.psw')

const change = {
    name : () => {
        nameInput.onfocus = () => {
            name.querySelector('.label-container').classList.add('active')
            name.querySelector('.label-container').classList.add('google-blue')
            nameInput.classList.add('active')
        }
        nameInput.onblur = () => {
            if(nameInput.value.length === 0) {
                name.querySelector('.label-container').classList.remove('active')
                name.querySelector('.label-container').classList.remove('google-blue')
                nameInput.classList.remove('active')    
            } else {
                name.querySelector('.label-container').classList.remove('google-blue')
                nameInput.classList.remove('active')    
            }
        }
        surnameInput.onfocus = () => {
            surname.querySelector('.label-container').classList.add('active')
            surname.querySelector('.label-container').classList.add('google-blue')
            surnameInput.classList.add('active')
        }
        surnameInput.onblur = () => {
            if(surnameInput.value.length === 0) {
                surname.querySelector('.label-container').classList.remove('active')
                surname.querySelector('.label-container').classList.remove('google-blue')
                surnameInput.classList.remove('active')    
            } else {
                surname.querySelector('.label-container').classList.remove('google-blue')
                surnameInput.classList.remove('active')    
            }
        }        
    },
    password : async () => {

        await change.generateInpout()

        pswOld = document.querySelector('.psw-old-container')
        pswOldInput = document.getElementById('psw-old-input')
        psw = document.querySelector('.psw-container')
        pswRepeat = document.querySelector('.psw-repeat-container')
        pswInput = document.getElementById('psw-input')
        pswRepeatInput = document.getElementById('psw-repeat-input')
        pswError = document.querySelector('.error.psw')

        pswInput.onfocus = () => {
            psw.querySelector('.label-container').classList.add('active')
            psw.querySelector('.label-container').classList.add('google-blue')
            pswInput.classList.add('active')
        }
        pswInput.onblur = () => {
            if(pswInput.value.length === 0) {
                psw.querySelector('.label-container').classList.remove('active')
                psw.querySelector('.label-container').classList.remove('google-blue')
                pswInput.classList.remove('active')    
            } else {
                psw.querySelector('.label-container').classList.remove('google-blue')
                pswInput.classList.remove('active')    
            }
        }
        pswRepeatInput.onfocus = () => {
            pswRepeat.querySelector('.label-container').classList.add('active')
            pswRepeat.querySelector('.label-container').classList.add('google-blue')
            pswRepeatInput.classList.add('active')
        }
        pswRepeatInput.onblur = () => {
            if(pswRepeatInput.value.length === 0) {
                pswRepeat.querySelector('.label-container').classList.remove('active')
                pswRepeat.querySelector('.label-container').classList.remove('google-blue')
                pswRepeatInput.classList.remove('active')    
            } else {
                pswRepeat.querySelector('.label-container').classList.remove('google-blue')
                pswRepeatInput.classList.remove('active')    
            }
        } 
        if(pswOld !== null)  {
            pswOldInput.onfocus = () => {
                pswOld.querySelector('.label-container').classList.add('active')
                pswOld.querySelector('.label-container').classList.add('google-blue')
                pswOldInput.classList.add('active')
            }
            pswOldInput.onblur = () => {
                if(pswOldInput.value.length === 0) {
                    pswOld.querySelector('.label-container').classList.remove('active')
                    pswOld.querySelector('.label-container').classList.remove('google-blue')
                    pswOldInput.classList.remove('active')    
                } else {
                    pswOld.querySelector('.label-container').classList.remove('google-blue')
                    pswOldInput.classList.remove('active')    
                }
            }     
        }  
    },
    generateInpout : async() => {
       const res =  await fetch('../include/check.inc.php', {                          
            method: "POST", 
            body: createFormData('pswSet', '')
        })
        const data = await res.text()
        document.querySelector('article').innerHTML = data
    },
    country : () => {
        for(let i = 0; i < countries.length; i++) {
            let div = document.createElement('div')
                div.onclick = () => { select(div) }
            if(getAcronymCountry(window.location.search.match(/[\?|\&]+[c]+[o]+[u]+[=].{2}/g)[0].slice(5, 7)) === countries[i]) div.classList.add('active')
            let p  = document.createElement('p')
                p.innerHTML = countries[i]
            div.appendChild(p)
            document.querySelector('.countries').appendChild(div)
        }   
    }
}
function getAcronymCountry(acronym) {
    for(let i = 0; i < countries.length; i++)
        if(countryAcronyms[i] === acronym)
            return countries[i]
}

const check = {
    name : async() => {
        if(error.name(nameInput.value.trim(), surnameInput.value.trim()) === true) return errorHandeling.name()
        array = JSON.stringify([nameInput.value.trim(), surnameInput.value.trim()])
        const res =  await fetch('../include/update.inc.php', {                          
            method: "POST", 
            body: createFormData('name', array)
        })
        const data = await res.text()
        if(data === 'success') openLinks('account/personal.php')
    },
    gender : async() => {
        if(!document.querySelector('.gender-container .active')) {
            genderError.classList.remove('disable')
            return errorHandeling.text(genderError.firstElementChild, 'You need to pick one')
        }
        array = JSON.stringify([document.querySelector('.gender-container .active').parentElement.lastElementChild.innerHTML.trim()])
        const res =  await fetch('../include/update.inc.php', {                          
            method: "POST", 
            body: createFormData('gender', array)
        })
        const data = await res.text()
        if(data === 'success') openLinks('account/personal.php')
    }, 
    country : async() => {
        if(!document.querySelector('.country-container .active')) {
            countryError.classList.remove('disable')
            return errorHandeling.text(countryError.firstElementChild, 'Select a country')
        }
        array = JSON.stringify([document.querySelector('.country-container .active').firstElementChild.innerHTML])
        const res =  await fetch('../include/update.inc.php', {                          
            method: "POST", 
            body: createFormData('country', array)
        })
        const data = await res.text()
        if(data === 'success') openLinks('account/personal.php')

    },
    psw : async() => {
        let string = 'newPsw'
        if(pswOldInput !== null) {
            if(error.passwordOld(pswInput.value.trim(), pswRepeatInput.value.trim(),pswOldInput.value.trim()) === true) return errorHandeling.password()
            string = 'oldPsw'
            arrayInput = [pswOldInput.value.trim(), pswInput.value.trim(), pswRepeatInput.value.trim()]
        } else {
            if(error.password(pswInput.value.trim(), pswRepeatInput.value.trim()) === true) return
            arrayInput = [pswInput.value.trim(), pswRepeatInput.value.trim()]
        }          
        array = JSON.stringify(arrayInput)
        const res =  await fetch('../include/update.inc.php', {                          
            method: "POST", 
            body: createFormData(string, array)
        })
        const data = await res.text()
        console.log(data)
        if(data === 'success') openLinks('account/personal.php')
        else error.passwordOldAfter()
    }
}

const error = {
    reset : () => {
        pswError.classList.add('disable')
        pswError.firstElementChild.innerHTML = ""
        pswInput.classList.remove('error-red-border')
        psw.querySelector('label').classList.remove('error-red')
        pswRepeatInput.classList.remove('error-red-border')
        pswRepeat.querySelector('label').classList.remove('error-red')
        pswOldInput.classList.remove('error-red-border')
        pswOld.querySelector('label').classList.remove('error-red')
    },
    name : (FirstName, LastName) => {
        if (FirstName.length === 0 || LastName.length === 0) {
            nameError.classList.remove('disable')
            surnameError.classList.remove('disable')
            if (FirstName.length === 0 && LastName.length === 0) {
                errorHandeling.name()
                errorHandeling.surname()
                errorHandeling.text(nameError.firstElementChild, 'Name must not be empty')
                errorHandeling.text(surnameError.firstElementChild, 'Surname must not be empty')
            } else if (FirstName.length !== 0 && LastName.length === 0) {
                errorHandeling.surname()
                errorHandeling.text(surnameError.firstElementChild, 'Surname must not be empty')
            } else if (FirstName.length === 0 && LastName.length !== 0) {
                errorHandeling.name()
                errorHandeling.text(nameError.firstElementChild, 'Name must not be empty')
                errorHandeling.text(surnameError.firstElementChild, 'Surname must not be empty')
            }
            return true
        }
    },
    password : (Password, PasswordRepeat) => {
        if (Password.length === 0 || PasswordRepeat.length === 0 || Password.length < 6 || Password === '' || PasswordRepeat === '' || Password !== PasswordRepeat) {
            pswError.classList.remove('disable')
            errorHandeling.password()
            errorHandeling.passwordRepeat()

            if(Password.length === 0 || PasswordRepeat.length === 0 || Password === '' || PasswordRepeat === '') errorHandeling.text(pswError.firstElementChild, 'You must type in your password')
            else if(Password.length < 6) errorHandeling.text(pswError.firstElementChild, 'Password must include atleast 7 characters')
            else if(Password !== PasswordRepeat) errorHandeling.text(pswError.firstElementChild, 'Passwords do not match')
            else if(Password.split(' ').length > 1 || PasswordRepeat.split(' ').length > 1) errorHandeling.text(pswError.firstElementChild, 'No white spaces in password')
            return true
        }
        else return false
    },
    passwordOld : (Password, PasswordRepeat, PasswordOld) => {   
        num = 0
        if(PasswordOld.length === 0 || PasswordOld.length === '' || PasswordOld.length > 20) {
            errorHandeling.passwordOld()

            if(PasswordOld.length === 0 ||  PasswordOld.length === '') errorHandeling.text(pswError.firstElementChild, 'Password field should not be empty')
            if(PasswordOld.length > 20) errorHandeling.text(pswError.firstElementChild, 'Password must contain maximum of 20 letters')
            num = 10
        }
        if(error.password(Password, PasswordRepeat) === true) num = 10
        if(num > 0) return true
        else return false 
    },
    passwordOldAfter : () => {
        error.reset()
        pswError.classList.remove('disable')
        errorHandeling.passwordOld()
        errorHandeling.text(pswError.firstElementChild, 'Wrong password')
    }
}
const errorHandeling = {
    name : () => {
        nameInput.classList.add('error-red-border')
        name.querySelector('label').classList.add('error-red')
    },
    surname : () => {
        surnameInput.classList.add('error-red-border')
        surname.querySelector('label').classList.add('error-red')
    },
    password : () => {
        pswInput.classList.add('error-red-border')
        psw.querySelector('label').classList.add('error-red')
    },
    passwordRepeat : () => {
        pswRepeatInput.classList.add('error-red-border')
        pswRepeat.querySelector('label').classList.add('error-red')
    },
    passwordOld : () => {
        pswOldInput.classList.add('error-red-border')
        pswOld.querySelector('label').classList.add('error-red')
    },
    text : (element, text) => { element.innerHTML = `${icon} ${text}` }

}
function createFormData(word, data) { 
    let formData = new FormData
        formData.append(word, data) 
    return formData
}

function setGender(element) {
    let aside = element.parentElement
    let oldSelect = aside.parentElement.querySelector('.active')
        if(oldSelect) {
            oldSelect.classList.remove('active')
            oldSelect.firstElementChild.classList.remove('active')
            oldSelect.firstElementChild.firstElementChild.classList.remove('active')
        }
    aside.firstElementChild.classList.add('active')
    aside.firstElementChild.firstElementChild.classList.add('active')
    aside.firstElementChild.firstElementChild.firstElementChild.classList.add('active')
}

function select(element) {
    if(document.querySelector('.country-container .active')) document.querySelector('.country-container .active').classList.remove('active')
    element.classList.add('active')
}

function managePasswordVisibility(element) {
    if(element.firstElementChild.firstElementChild.classList.contains('disable')) {
        element.firstElementChild.firstElementChild.classList.remove('disable')
        element.firstElementChild.lastElementChild.classList.add('disable')
        if(element.parentElement.firstElementChild.lastElementChild === pswInput) pswInput.type = 'text'
        else if(element.parentElement.firstElementChild.lastElementChild === pswRepeatInput) pswRepeatInput.type = 'text'
        else if(element.parentElement.firstElementChild.lastElementChild === pswOldInput) pswOldInput.type = 'text'

    } else {
        element.firstElementChild.firstElementChild.classList.add('disable')
        element.firstElementChild.lastElementChild.classList.remove('disable')
        if(element.parentElement.firstElementChild.lastElementChild === pswInput) pswInput.type = 'password'
        else if(element.parentElement.firstElementChild.lastElementChild === pswRepeatInput) pswRepeatInput.type = 'password'
        else if(element.parentElement.firstElementChild.lastElementChild === pswOldInput) pswOldInput.type = 'password'
    }
}
