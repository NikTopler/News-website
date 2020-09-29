const name = document.querySelector('.name-container')
const surname = document.querySelector('.surname-container')
const email = document.querySelector('.email-container')
const psw = document.querySelector('.psw-container')
const pswRepeat = document.querySelector('.psw-repeat-container')

const nameInput = document.getElementById('name-input')
const surnameInput = document.getElementById('surname-input')
const emailInput = document.getElementById('email-input')
const pswInput = document.getElementById('psw-input')
const pswRepeatInput = document.getElementById('psw-repeat-input')

const countries = ['Arab Emirates','Argentina','Australia','Austria','Belgium','Brasil','Bulgaria','Canada','China','Colombia','Cuba','Czech Republic','Egypt','England','France','Germany','Greece','Hong Kong','Hungary','Indonesia','Ireland','Israel','Italy','Japan','Latvia','Lithuania','Malaysia','Mexico','Morocco','Netherlands','New Zealand','Nigeria','Norway','Philippines','Poland','Portugal','Romania','Russia','Saudia Arabia','Serbia','Singapore','Slovakia','Slovenia','South Africa','South Korea','Sweden','Switzerland','Taiwan','Thailand','Turkey','Ukraine','United States','Venezuela']

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

emailInput.onfocus = () => {
    email.querySelector('.label-container').classList.add('active')
    email.querySelector('.label-container').classList.add('google-blue')
    emailInput.classList.add('active')
}
emailInput.onblur = () => {
    if(emailInput.value.length === 0) {
        email.querySelector('.label-container').classList.remove('active')
        email.querySelector('.label-container').classList.remove('google-blue')
        emailInput.classList.remove('active')    
    } else {
        email.querySelector('.label-container').classList.remove('google-blue')
        emailInput.classList.remove('active')    
    }
}
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

window.onload = () => {
    generateCountries()
}

const indexCountrySelect = document.getElementById('index-country-select')
const indexCountryLabel = document.getElementById('index-country-label')

function manageOptionSelect() {
    if(indexCountrySelect.classList.contains('disable')){
        indexCountrySelect.classList.remove('disable')
        showCountrySelect()
    }
    else indexCountrySelect.classList.add('disable') 
}
function showCountrySelect() {
    let selectedValue
    for(let i = 0; i < countries.length; i++) {
        if(indexCountrySelect.children[i].innerHTML === indexCountryLabel.innerHTML) {
            indexCountrySelect.children[i].classList.add('selected-option')
            selectedValue = i
        }
        indexCountrySelect.children[i].onmouseenter = () => { eventHandelerForCountrySelect(indexCountrySelect.children[i],'enter') }
        indexCountrySelect.children[i].onmouseleave = () => { eventHandelerForCountrySelect(indexCountrySelect.children[i],'leave') }
    } 
    return selectedValue
}
function selectValue(selectedElement) {
    event.stopPropagation()
    indexCountryLabel.innerHTML = selectedElement.innerHTML
    indexCountrySelect.classList.add('disable')
}
let countrySelectValueArray = []
function eventHandelerForCountrySelect(element, command) {
    countrySelectValueArray.push(command)
    removeEveryChildsClass(element.parentElement,'selected-option')
    if(command == 'enter' || countrySelectValueArray[countrySelectValueArray.length - 1] == 'leave') element.classList.add('selected-option')
}
function removeEveryChildsClass(parent,className) {
    for(let i = 0; i < parent.children.length; i++)
        parent.children[i].classList.remove(className)
}
function generateCountries() {
    for(let i = 0; i < countries.length; i++) {
        let div = document.createElement('div')
            div.onclick = () => { selectValue(div) }
            div.innerHTML = countries[i]
        indexCountrySelect.appendChild(div)
    }
}
function managePasswordVisibility(element) {
    if(element.firstElementChild.firstElementChild.classList.contains('disable')) {
        element.firstElementChild.firstElementChild.classList.remove('disable')
        element.firstElementChild.lastElementChild.classList.add('disable')
        pswInput.type = 'text'
        pswRepeatInput.type = 'text'

    } else {
        element.firstElementChild.firstElementChild.classList.add('disable')
        element.firstElementChild.lastElementChild.classList.remove('disable')
        pswInput.type = 'password'
        pswRepeatInput.type = 'password'
    }
}
const websiteURL = 'http://localhost:8080/News-website/'

function urlOpen(string) { window.location.replace(`${websiteURL}headlines.php${string}`) }


async function register() {    
    let firstName = nameInput.value.trim()
    let lastName = surnameInput.value.trim()
    let email = emailInput.value.trim()
    let password = pswInput.value.trim()
    let passwordRepeat = pswRepeatInput.value.trim()
    let country = indexCountryLabel.innerHTML.trim()
    error.reset()
    if(error.before(firstName, lastName, email, password, passwordRepeat, country) === false) return
    insertToDB(firstName, lastName, email, password, passwordRepeat, country)
}
async function insertToDB(firstName, lastName, email, password, passwordRepeat, country) {
    array = JSON.stringify([firstName, lastName, email, password, passwordRepeat, country])
    const res =  await fetch('include/insert.inc.php', {                          
        method: "POST", 
        body: createFormData('standard', array)
    })
    const data = await res.text()
    error.after(data)
}
const icon = `<i class="fas fa-exclamation-circle fa-lg"></i>`
const nameError = document.querySelector('.error.name')
const emailError = document.querySelector('.error.email')
const pswError = document.querySelector('.error.psw')
const countryError = document.querySelector('.error.country')
const resultError = document.querySelector('.error.result')


const error = {
    reset : () => {
        nameError.classList.add('disable')
        nameError.firstElementChild.innerHTML = ""
        nameInput.classList.remove('error-red-border')
        name.querySelector('label').classList.remove('error-red')
        emailError.classList.add('disable')
        emailError.firstElementChild.innerHTML = ""
        emailInput.classList.remove('error-red-border')
        email.querySelector('label').classList.remove('error-red')
        pswError.classList.add('disable')
        pswError.firstElementChild.innerHTML = ""
        pswInput.classList.remove('error-red-border')
        psw.querySelector('label').classList.remove('error-red')
        pswRepeatInput.classList.remove('error-red-border')
        pswRepeat.querySelector('label').classList.remove('error-red')
        countryError.classList.add('disable')
        countryError.firstElementChild.innerHTML = ""
        resultError.classList.add('disable')
    },
    before : (FirstName, LastName, Email, Password, PasswordRepeat, Country) => {
        let num = 0
        if(FirstName.length === 0 || LastName.length === 0) {
            nameError.classList.remove('disable')
            if(FirstName.length === 0 && LastName.length === 0) {
                nameError.firstElementChild.innerHTML = `${icon} Name and Surname must not be empty`
                nameInput.classList.add('error-red-border')
                name.querySelector('label').classList.add('error-red')
                surnameInput.classList.add('error-red-border')
                surname.querySelector('label').classList.add('error-red')
            } else if(FirstName.length !== 0 && LastName.length === 0) {
                nameError.firstElementChild.innerHTML = `${icon} Surname must not be empty`
                surnameInput.classList.add('error-red-border')
                surname.querySelector('label').classList.add('error-red')
            } else if(FirstName.length === 0 && LastName.length !== 0) {
                nameError.firstElementChild.innerHTML = `${icon} Name must not be empty`
                nameInput.classList.add('error-red-border')
                name.querySelector('label').classList.add('error-red')
            }
            num = num++
        }
        if(Email.length === 0 || validateEmail(Email) === false) {
            if(validateEmail(Email) === false) emailError.firstElementChild.innerHTML = `${icon} Incorrect email format`
            else emailError.firstElementChild.innerHTML = `${icon} Field email must be filled`
            emailError.classList.remove('disable')
            emailInput.classList.add('error-red-border')
            email.querySelector('label').classList.add('error-red')
            num = num++
        }
        if(Password.length === 0 || PasswordRepeat.length === 0 || Password.length < 6) {
            pswError.classList.remove('disable')
            if(Password.length === 0 && PasswordRepeat.length === 0 || Password.length < 6) {
                if(Password.length === 0 && PasswordRepeat.length === 0) pswError.firstElementChild.innerHTML = `${icon} You must type in your password`
                else pswError.firstElementChild.innerHTML = `${icon} Password must include atleast 7 characters`
                pswInput.classList.add('error-red-border')
                psw.querySelector('label').classList.add('error-red')
                pswRepeatInput.classList.add('error-red-border')
                pswRepeat.querySelector('label').classList.add('error-red')
            } else if(Password !== PasswordRepeat) {
                pswError.firstElementChild.innerHTML = `${icon} Passwords do not match`
                pswInput.classList.add('error-red-border')
                psw.querySelector('label').classList.add('error-red')
                pswRepeatInput.classList.add('error-red-border')
                pswRepeat.querySelector('label').classList.add('error-red')
            } else if(Password.length !== 0 && PasswordRepeat.length === 0) {
                pswError.firstElementChild.innerHTML = `${icon} Surname must not be empty`
                pswRepeatInput.classList.add('error-red-border')
                pswRepeat.querySelector('label').classList.add('error-red')
            } else if(Password.length === 0 && PasswordRepeat.length !== 0) {
                nameError.firstElementChild.innerHTML = `${icon} Name must not be empty`
                pswInput.classList.add('error-red-border')
                psw.querySelector('label').classList.add('error-red')
            }
            num = num++
        }
        if(Country === 'Select Country') {
            countryError.classList.remove('disable')
            countryError.firstElementChild.innerHTML = `${icon}  You must select country`
            num = num++
        }
        if(num > 0) return false
        else true
    },
    after : (data) => {
        if(data === 'success') return urlOpen('')
        
        resultError.classList.remove('disable')
        if(data === `user exist's`) resultError.firstElementChild.innerHTML = 'User with this email already exists!'
        else if(data.includes('google') || data.includes('facebook') || data.includes('github')) resultError.firstElementChild.innerHTML = `You don't have set up password. Sign in with <a href="#" onclick="urlOpen('#login')">${data.split(' ')[1]}</a>`
        else if(data === 'incorrect email') {
            emailError.firstElementChild.innerHTML = `${icon} Incorrect email format`
            emailError.classList.remove('disable')
            emailInput.classList.add('error-red-border')
            email.querySelector('label').classList.add('error-red')
        } else if(data === `passwords don't match`) {
            pswError.firstElementChild.innerHTML = `${icon} Passwords do not match`
            pswInput.classList.add('error-red-border')
            psw.querySelector('label').classList.add('error-red')
            pswRepeatInput.classList.add('error-red-border')
            pswRepeat.querySelector('label').classList.add('error-red')
        } 
    }
}
function createFormData(word, data) { 
    let formData = new FormData
        formData.append(word, data) 
    return formData
}

function validateEmail(email) {
    let mailformat = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/
    if (email.match(mailformat)) return true
    else return false
}