const email = document.querySelector('.email-container')
const password = document.querySelector('.password-container')

const emailInput = document.getElementById('email-input')
const passwordInput = document.getElementById('password-input')

const websiteURL = 'https://news.niktopler.com/'

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
passwordInput.onfocus = () => {
    password.querySelector('.label-container').classList.add('active')
    password.querySelector('.label-container').classList.add('google-blue')
    passwordInput.classList.add('active')
}
passwordInput.onblur = () => {
    if(passwordInput.value.length === 0) {
        password.querySelector('.label-container').classList.remove('active')
        password.querySelector('.label-container').classList.remove('google-blue')
        passwordInput.classList.remove('active')    
    } else {
        password.querySelector('.label-container').classList.remove('google-blue')
        passwordInput.classList.remove('active')    
    }
}

function switchLoginBox() {

    if(!email.classList.contains('active')) {
        email.classList.add('active')
        password.classList.add('active')
        resetPsw()
    } else {
        email.classList.remove('active')
        password.classList.remove('active')
        setupSubHeading()
        errorContainer.classList.add('disable')
        emailInput.classList.remove('error-red-border')
        email.querySelector('.label-container').classList.remove('error-red')
    }
}
async function checkEmail() {
    array = JSON.stringify([emailInput.value.trim()])
    const res =  await fetch('include/check.inc.php', {                          
        method: "POST", 
        body: createFormData('email', array)
    })
    const data = await res.text()
    
    if(errorHandelingEmail(data) === true) {
        switchLoginBox()
        setupProfile()
    }
    
}

const errorPswContainer = document.querySelector('.error.psw')
async function checkPassword() {
    if(passwordInput.value.length === 0) {
        errorPswContainer.classList.remove('disable')
        errorPswContainer.firstElementChild.innerHTML = `${icon} Field password must not be empty`;
        passwordInput.classList.add('error-red-border')
        password.querySelector('label').classList.add('error-red')
        return
    }
    array = JSON.stringify([emailInput.value.trim(), passwordInput.value.trim()])
    const res =  await fetch('include/check.inc.php', {                          
        method: "POST", 
        body: createFormData('login', array)
    })
    const data = await res.text()
    
    if(data === 'success') urlOpen('')
    else if(data == 'wrong password') {
        errorPswContainer.classList.remove('disable')
        errorPswContainer.firstElementChild.innerHTML = `${icon} Incorrect password`;
        passwordInput.classList.add('error-red-border')
        password.querySelector('label').classList.add('error-red')
    }
}

function setupProfile() {
    const upperContainer = document.getElementById('upper-container')
    upperContainer.firstElementChild.classList.add('disable')
    upperContainer.lastElementChild.classList.remove('disable')
    upperContainer.lastElementChild.firstElementChild.querySelector('span').innerHTML = emailInput.value
}
function setupSubHeading() {
    const upperContainer = document.getElementById('upper-container')
    upperContainer.firstElementChild.classList.remove('disable')
    upperContainer.lastElementChild.classList.add('disable')
    upperContainer.lastElementChild.firstElementChild.querySelector('span').innerHTML = ''
}

const errorContainer = document.querySelector('.error')
const icon = `<i class="fas fa-exclamation-circle fa-lg"></i>`

function errorHandelingEmail(data) {
    if(data === `user exists`) return true  
        
    if(emailInput.value.length === 0) errorContainer.firstElementChild.innerHTML = `${icon} Enter your email adress`
    else if(!validateEmail(emailInput.value.trim())) errorContainer.firstElementChild.innerHTML = `${icon} Email address doesn't exist`
    else if(data === `user doesn't exist`) errorContainer.firstElementChild.innerHTML = `${icon} There is no user with this email`
    else if(data === `google user doesn't have password set up`) {
        errorContainer.firstElementChild.innerHTML = `${icon} No set up password`
        errorContainer.lastElementChild.classList.remove('disable')
        errorContainer.lastElementChild.innerHTML = `You have logged in with your Google account, but you didn't set up your password.`
    } else if(data === `facebook user doesn't have password set up`) {
        errorContainer.firstElementChild.innerHTML = `${icon} No set up password`
        errorContainer.lastElementChild.classList.remove('disable')
        errorContainer.lastElementChild.innerHTML = `You have logged in with your Facebook account, but you didn't set up your password.`
    } else if(data === `github user doesn't have password set up`) {
        errorContainer.firstElementChild.innerHTML = `${icon} No set up password`
        errorContainer.lastElementChild.classList.remove('disable')
        errorContainer.lastElementChild.innerHTML = `You have logged in with your Facebook account, but you didn't set up your password.`
    }
    errorContainer.classList.remove('disable')
    email.querySelector('.label-container').classList.add('error-red')
    emailInput.classList.add('error-red-border')

    return false 
}

function validateEmail(email) {
    let mailformat = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/
    if (email.match(mailformat)) return true
    else return false
}
function createFormData(word, data) { 
    let formData = new FormData
        formData.append(word, data) 
    return formData
}

function urlOpen(string) { window.location.replace(`${websiteURL}headlines.php${string}`) }

element = document.querySelector('.eye-icon-container')

function managePswVisibility() {
    if(element.firstElementChild.firstElementChild.classList.contains('disable')) {
        element.firstElementChild.firstElementChild.classList.remove('disable')
        element.firstElementChild.lastElementChild.classList.add('disable')
        passwordInput.type = 'text'
    } else {
        element.firstElementChild.firstElementChild.classList.add('disable')
        element.firstElementChild.lastElementChild.classList.remove('disable')
        passwordInput.type = 'password'
    }
}

function resetPsw() {
    passwordInput.value = ''
    element.firstElementChild.firstElementChild.classList.add('disable')
    element.firstElementChild.lastElementChild.classList.remove('disable')
    passwordInput.type = 'password'
}
