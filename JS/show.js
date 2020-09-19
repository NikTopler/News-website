
let sideMenuCounter = 0
function manageSideMenu() {
    if(checkWindowWidth900() === true && sideMenuCounter === 0){
        sideBarContent.style.left = '-100%'
        sideMenuCounter = 1
    } else if(checkWindowWidth900() === true && sideMenuCounter === 1){
        sideBarContent.style.left = '0%'
        sideMenuCounter = 0
    } else if(checkWindowWidth900() === false && sideMenuCounter === 0){
        sideBarContent.style.left = '-100%'
        sideMenuCounter = 1
    } else if(checkWindowWidth900() === false && sideMenuCounter === 1) {
        sideBarContent.classList.remove('disable')
        sideBarContent.style.left = '0%'
        sideMenuCounter = 0
    }
}

function checkWindowWidth900() {
    if(window.innerWidth > 930) return true
    else return false
}

function manageExtraSearchOptions() {
    if(extraSearchOptions.classList.contains('disable')) {
        hideSuggestWords()
        showExtraSearchOptions()
    } else hideExtraSearchOptions()
}
function showExtraSearchOptions() {
    extraSearchOptions.classList.remove('disable')
    mainSearchInput.style.borderBottomLeftRadius = '0'
    mainSearchInput.style.borderBottomRightRadius = '0'
    extOptIcon.style.transform = 'rotate(180deg)'
    if(!indexTimeSelect.classList.contains('disable')) indexTimeSelect.classList.add('disable')
}
function hideExtraSearchOptions() {
    extraSearchOptions.classList.add('disable')
    mainSearchInput.style.borderBottomLeftRadius = '6px'
    mainSearchInput.style.borderBottomRightRadius = '6px'
    extOptIcon.style.transform = 'rotate(0deg)'
}
function resetExtraSearchOptions() {
    indexTimeLabel.innerHTML = 'Anytime'
    for(let i = 0; i < 3; i++)
        document.querySelectorAll('.extra-search-options > div > input')[i].value = '' 
}

function manageTimeOptionSelect() {
    if(indexTimeSelect.classList.contains('disable')){
        indexTimeSelect.classList.remove('disable')
        let selectedValue = -32 * showTimeOptionSelect()
        indexTimeSelect.style.top = `${selectedValue}px`
    }
    else indexTimeSelect.classList.add('disable') 
}
function showTimeOptionSelect() {
    let selectedValue
    for(let i = 0; i < 4; i++) {
        if(indexTimeSelect.children[i].innerHTML === indexTimeLabel.innerHTML) {
            indexTimeSelect.children[i].classList.add('selected-option')
            selectedValue = i
        }
        indexTimeSelect.children[i].onmouseenter = () => { eventHandelerForTimeOptionSelect(indexTimeSelect.children[i],'enter') }
        indexTimeSelect.children[i].onmouseleave = () => { eventHandelerForTimeOptionSelect(indexTimeSelect.children[i],'leave') }
    } 
    return selectedValue
}

let timeOptionSelectValueArray = []
function eventHandelerForTimeOptionSelect(element,command) {
    timeOptionSelectValueArray.push(command)
    removeEveryChildsClass(element.parentElement,'selected-option')
    if(command == 'enter' || timeOptionSelectValueArray[timeOptionSelectValueArray.length - 1] == 'leave') element.classList.add('selected-option')
}

function removeEveryChildsClass(parent,className) {
    for(let i = 0; i < parent.children.length; i++)
        parent.children[i].classList.remove(className)
}

function selectValue(selectedElement) {
    event.stopPropagation()
    indexTimeLabel.innerHTML = selectedElement.innerHTML
    selectedElement.parentElement.classList.add('disable')
}

function showSuggestWords() {
    mainSearchInput.style.borderBottomLeftRadius = '0'
    mainSearchInput.style.borderBottomRightRadius = '0'
    suggestMainInput.classList.remove('disable')
}
function hideSuggestWords() {
    mainSearchInput.style.borderBottomLeftRadius = '6px'
    mainSearchInput.style.borderBottomRightRadius = '6px'
    suggestMainInput.classList.add('disable')
    suggest.removeAllSuggestWordBoxes()
}

function hideSelectCountry() {
    selectCountryDiv.classList.remove('active')
    overlay.classList.remove('active')
    searchCountriesInput.value = ''
}

function showSelectCountry() {
    selectCountryDiv.classList.add('active')
    overlay.classList.add('active')
    elementAdjustmentsSearchCountries()
    generateCountries()
}
function hideSelectCountry() {
    selectCountryDiv.classList.remove('active')
    overlay.classList.remove('active')
    searchCountriesInput.value = ''
    selectedC = null
}

function manageLoginOptions() {
    if(!logInOptions.classList.contains('active')) {
        logInOptions.classList.add('active')
        overlay.classList.add('active')
    } else {
        logInOptions.classList.remove('active')
        overlay.classList.remove('active')
    }
}

function resetExtraSearchOptions() {
    indexTimeLabel.innerHTML = 'Anytime'
    for(let i = 0; i < 3; i++)
        document.querySelectorAll('.extra-search-options > div > input')[i].value = '' 
}

function sidebarCategorySelect(selectedElement) {
    if(selectedElement.classList.contains('side-menu-active')) return
    selectedElement.classList.add('side-menu-active')
    selectedElement.firstElementChild.classList.add('side-menu-active')
    /* Search news articles */    
} 
function removeActiveSidebarCategory() {
    let oldSelectedElements = document.querySelectorAll('.side-menu-active')
    for(let i = 0; i < oldSelectedElements.length; i++)
        oldSelectedElements[i].classList.remove('side-menu-active')
}
