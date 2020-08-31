window.onload = async () => {

    await getuserLocationInformationValue()
    removeActiveSidebarCategory()
    if (window.location.pathname.includes('headlines')) headlines()
    else if (window.location.pathname.includes('for-you')) forYou()
    else if (window.location.pathname.includes('following')) following()
    else if (window.location.pathname.includes('library')) library()
    else if (window.location.pathname.includes('covid')) category('fa-shield-cross')
    else if (window.location.pathname.includes('world')) category('fa-globe-europe')
    else if (window.location.pathname.includes('business')) category('fa-building')
    else if (window.location.pathname.includes('technology')) category('fa-microchip')
    else if (window.location.pathname.includes('entertainment')) category('fa-camera-movie')
    else if (window.location.pathname.includes('sports')) category('fa-tennis-ball')
    else if (window.location.pathname.includes('health')) category('fa-heartbeat')
    else if (window.location.pathname.includes('setings')) setings()
    else if (window.location.pathname.includes('about')) about()
    else if (window.location.pathname.includes('help')) help()
    else if (window.location.pathname.includes('search')) search()

    // changeBackgroundColor()
    let selectedCountryAcronym = getCountryAcronym(selectedCountry.innerHTML)

    if(!window.location.search.match(regularExpressions.url.country)) historyPushState(window.location.origin + window.location.pathname, '', `?cou=${selectedCountryAcronym}&`,`bg=${backgroundColor}`)
    else {
        urlCountryAcronym = window.location.search.match(regularExpressions.url.country)[0].slice(5,7)
        if(getAcronymCountry(urlCountryAcronym) === undefined) return openLinks(filePath.headlines)
        urlCountry = getAcronymCountry(urlCountryAcronym)
        updateCountrySelect(urlCountry)
    }
    
    if(!window.location.search.match(regularExpressions.url.query)) return

    let query = location.search.match(regularExpressions.url.query)[0]
        query = removeCharactersInString(query, 3, query.length - 1)
    /* Search news */

}

window.onclick = (e) => {  
    
    if(logInOptions.classList.contains('active')) clickInOutCheck(logInOptions,e.target)
    else if(!extOptProfile.classList.contains('disable')) clickInOutCheck(extOptProfile,e.target)
    else if(selectCountryDiv.classList.contains('active')) clickInOutCheck(selectCountryDiv,e.target)
    else if(!extraSearchOptions.classList.contains('disable')) clickInOutCheck(extraSearchOptions,e.target)
}

window.onkeydown = test

function test() {
    // alert(this)
}

// for(let i = 0; i < document.querySelectorAll('a').length; i++)
//     document.querySelectorAll('a')[i].addEventListener('click', (e) => { e.preventDefault() })

function openLinks(string) { window.location.replace(websiteURL + string) }

function historyPushState(webiste, string, country, background) { history.pushState({}, null, webiste + string + country + background) }

function changeBackgroundColor() { document.body.className = window.location.search.match(regularExpressions.url.backgroundColor)[0].slice(4,10) }

let userLocationInformationValue
async function getuserLocationInformationValue() { userLocationInformationValue = await getUsersCountry() }

async function getUsersCountry() {
    const response = await fetch('https://ipinfo.io?token=ea08233c62eaef')
    const data = await response.json()
    const userCountryAcronym = data.country.toLowerCase()
    const userCountry = getAcronymCountry(userCountryAcronym)
    const userCity = data.city
    const userRegion = data.region
    const userLocation = data.loc
    const userTimeZone = data.timezone
    return [userCountry,userCountryAcronym,userCity,userRegion,userLocation,userTimeZone]
}

let weatherArrayToday
let weatherArrayTommorow
let weatherArray2Days
async function getWeather() {
    city = changeDiacritics(userLocationInformationValue[3])
    const response = await fetch(`https://cors-anywhere.herokuapp.com/https://api.weatherapi.com/v1/forecast.json?key=4d93fac43abe41dda15152718201307&q=${city}&days=7`)
    const data = await response.json()
    weatherArrayToday = data.forecast.forecastday[0]
    weatherArrayTommorow = data.forecast.forecastday[1]
    weatherArray2Days = data.forecast.forecastday[2]
}
function changeDiacritics(string) {
    const regexDiacritics = /č|ć|đ|š|ž/g
    string = string.split('')
    for(let i = 0; i < string.length; i++)
        if(regexDiacritics.test(string[i]))
            string[i] = diacriticsReplacement[string[i]]
    return string
}

function getLanguageAcronym(target) {
    for(let i = 0; i < language.length; i++)
        if(language[i] === target)
            return languageAcronyms[i]
}


function getCountryAcronym(target) {
    for(let i = 0; i < countries.length; i++)
        if(countries[i] === target)
            return countryAcronyms[i] 
}

function getAcronymCountry(acronym) {
    for(let i = 0; i < countries.length; i++)
        if(countryAcronyms[i] === acronym)
            return countries[i]
}
function getAcronymLanguage(acronym) {
    for(let i = 0; i < language.length; i++)
        if(languageAcronyms[i] === acronym)
            return language[i]
}

function updateWeather() {
    let header =  document.querySelectorAll('.weather-main-header')[0]
        header.children[0].src = weatherArrayToday.day.condition.icon
        header.children[1].innerHTML = userLocationInformationValue[3]
        header.children[2].innerHTML =  `${Math.round(weatherArrayToday.day.avgtemp_c) }°C`
    
    let weatherDate = new Date(weatherArrayToday.date)
    let tommorowNumber = weatherDate.getDay()
    let dayAfterTomorrow = weatherDate.getDay()

    if(tommorowNumber == 6) tommorowNumber = tommorowNumber - 7
    if(dayAfterTomorrow == 5 || dayAfterTomorrow == 6) dayAfterTomorrow = dayAfterTomorrow - 7

    let dayAcronymTommorow = daysAcronyms[tommorowNumber + 1]
    let dayAcronymIn2Days = daysAcronyms[dayAfterTomorrow + 2]

    let mainWeatherContent = document.querySelectorAll('.weather-3-days')[0]
        mainWeatherContent.children[0].firstElementChild.innerHTML = 'Today'
        mainWeatherContent.children[1].firstElementChild.innerHTML = dayAcronymTommorow
        mainWeatherContent.children[2].firstElementChild.innerHTML = dayAcronymIn2Days

        mainWeatherContent.children[0].children[1].firstElementChild.src = weatherArrayToday.day.condition.icon
        mainWeatherContent.children[1].children[1].firstElementChild.src = weatherArrayTommorow.day.condition.icon
        mainWeatherContent.children[2].children[1].firstElementChild.src = weatherArray2Days.day.condition.icon

        mainWeatherContent.children[0].children[2].firstElementChild.src = 'http://cdn.weatherapi.com/weather/64x64/day/302.png'
        mainWeatherContent.children[1].children[2].firstElementChild.src = 'http://cdn.weatherapi.com/weather/64x64/day/302.png'
        mainWeatherContent.children[2].children[2].firstElementChild.src = 'http://cdn.weatherapi.com/weather/64x64/day/302.png'

        mainWeatherContent.children[0].children[1].lastElementChild.innerHTML = `${weatherArrayToday.day.avgtemp_c}°C`
        mainWeatherContent.children[1].children[1].lastElementChild.innerHTML = `${weatherArrayTommorow.day.avgtemp_c}°C`
        mainWeatherContent.children[2].children[1].lastElementChild.innerHTML = `${weatherArray2Days.day.avgtemp_c}°C`

        mainWeatherContent.children[0].children[2].lastElementChild.innerHTML = `${weatherArrayToday.day.daily_chance_of_rain}%`
        mainWeatherContent.children[1].children[2].lastElementChild.innerHTML = `${weatherArrayTommorow.day.daily_chance_of_rain}%`
        mainWeatherContent.children[2].children[2].lastElementChild.innerHTML = `${weatherArray2Days.day.daily_chance_of_rain}%`
}

function changeTemperatureUnit(element) {
    const unit = element.innerHTML
    const temperatureElements = document.querySelectorAll('.temperature')
    let numberString
    let number
    let newUnit 
    let convertMethod
    if(unit === temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1)) return
    if(unit === 'F' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'C') {
        newUnit = '°F'
        convertMethod = celsiusToFahrenheit 
        numberString = -2
    } else if(unit === 'K' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'C') {
        newUnit = 'K'
        convertMethod = celsiusToKelvin
        numberString = -2
    } else if(unit === 'F' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'K') {
        newUnit = '°F'
        convertMethod = kelvinToFahrenheit
        numberString = -1
    } else if(unit === 'C' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'K') {
        newUnit = '°C'
        convertMethod = kelvinToCelsius
        numberString = -1
    } else if(unit === 'C' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'F') {
        newUnit = '°C'
        convertMethod = fahrenheitToCelsius
        numberString = -2
    } else if(unit === 'K' && temperatureElements[0].innerHTML.charAt(temperatureElements[0].innerHTML.length - 1) === 'F') {
        newUnit = 'K'
        convertMethod = fahrenheitToKelvin
        numberString = -2
    }
    for(let i = 0; i < temperatureElements.length; i ++) {
        number = removeCharactersInString(temperatureElements[i].innerHTML, 0, numberString)
        number = convertMethod(number)
        temperatureElements[i].innerHTML = Math.round(number) + newUnit
    }
    document.querySelectorAll('.weather-article .active')[0].classList.remove('active')
    element.classList.add('active')
}

function removeCharactersInString(string, frontNumber, backNumber) { return string.slice(frontNumber, backNumber)}

function celsiusToFahrenheit(number) { return number * 9/5 + 32 }
function celsiusToKelvin(number) { return Number(number) + 273 }
function kelvinToFahrenheit(number) { return (number - 273) * 9/5 + 32 }
function kelvinToCelsius(number) { return number - 273 }
function fahrenheitToCelsius(number) { return (number - 32) * 5/9 }
function fahrenheitToKelvin(number) { return (number - 32) * 5/9 + 273 }


/* HEADLINES */

async function headlines() {
    // await getWeather()   
    // updateWeather()
    sidebarCategorySelect(document.querySelector('.fa-newspaper').parentElement)
}

/* SEARCH */ 

    function searchArticles() {

        if(!mainSearchIcon.classList.contains('disable') && window.innerWidth < 930) mobileVersionNavigationBar()
        else if(mainSearchIcon.classList.contains('disable') && window.innerWidth > 930) desktopVersionNavigationBar()

        if(mainSearchInput.value.length === 0) return
        let selectedCountryAcronym = getCountryAcronym(selectedCountry.innerHTML)
        if(extraSearchOptions.classList.contains('disable')) searchQuery = addCharacterBetweenSpaceInString(mainSearchInput.value,' ','+')
        if(window.location.pathname.includes('search')) historyPushState(location.origin + location.pathname, `?q=${searchQuery}&`, `cou=${selectedCountryAcronym}&`,`bg=${backgroundColor}`)
        else createUrlPath('search', searchQuery)

        document.querySelectorAll('h1.search')[0].innerHTML = mainSearchInput.value.charAt(0).toUpperCase() + mainSearchInput.value.slice(1)
        addDisableSideElements()
    }
    function search() {
        if(window.location.search.match(regularExpressions.url.query) === null) return openLinks(filePath.headlines) 

        searchInputValue = window.location.search.match(regularExpressions.url.query)[0].slice(3, -1)
        mainSearchInput.value = addCharacterBetweenSpaceInString(searchInputValue, '+', ' ')
        document.querySelectorAll('h1.search')[0].innerHTML = mainSearchInput.value.charAt(0).toUpperCase() + mainSearchInput.value.slice(1)
        suggestWords()
        /* Search news articles */
    }
    function mobileVersionNavigationBar() {
        mainSearchIcon.classList.add('disable')
        mainSearchBackLeftIcon.classList.remove('disable')
        navigationBarLeft.classList.add('disable')
        navigationBarRight.classList.add('disable')
        navigationBarMiddle.style.gridColumn = '1/4'
        mainSearchFigure.style.gridColumn = '1/2'
        mainSearchBackLeftTooltiptext.classList.remove('disable')
        mainSearchInput.style.display = 'grid'
        extOptIcon.style.display = 'flex'
        mainSearchInput.focus()
        sideBarContent.style.left = '-100%'
        sideMenuCounter = 1
    }
    function desktopVersionNavigationBar() {
        mainSearchIcon.classList.remove('disable')
        mainSearchBackLeftIcon.classList.add('disable')
        navigationBarLeft.classList.remove('disable')
        navigationBarRight.classList.remove('disable')
        navigationBarMiddle.style.gridColumn = '2/3'
        mainSearchFigure.style.gridColumn = '3/4'
        mainSearchBackLeftTooltiptext.classList.add('disable')
        mainSearchInput.style.display = 'none'
        extOptIcon.style.display = 'none'
    }

/* FOR YOU */

function forYou() {
    sidebarCategorySelect(document.querySelector('.fa-user-alt').parentElement)
}

/* FOLLOWING */

function following() {
    sidebarCategorySelect(document.querySelector('.fa-star').parentElement)
}

/* LIBRARY */

function library() {
    sidebarCategorySelect(document.querySelector('.fa-bookmark').parentElement)
}

/* CATEGORIES */

function category(word) {
    sidebarCategorySelect(document.querySelector(`.${word}`).parentElement)
}

/* SETTINGS */

function settings() {
}

/* ABOUT */

function about() {
}

const regularExpressions = {
    url : {
        query : /[\?|\&]+[q]+[=].*?[&]/g,
        country : /[\?|\&]+[c]+[o]+[u]+[=].{2}/g,
        backgroundColor : /[\&]+[b]+[g]+[=].*/g
    },
    string : {
        symbols : /[@_!#$%^&*()<>?/|}{~:]/g
    }
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

mainSearchInput.onfocus = () => {
    if(!extraSearchOptions.classList.contains('disable')) manageExtraSearchOptions()
    else if(mainSearchInput.value.length !== 0) showSuggestWords()
}

mainSearchInput.oninput = () => {
    if(mainSearchInput.value.length === 0) return hideSuggestWords()
    else if(suggestMainInput.classList.contains('disable')) showSuggestWords()
    manageSuggestWords() 
}
let place = 0
mainSearchInput.onkeyup = (e) => {
    if(e.keyCode === 13) {
        if(!suggestMainInput.classList.contains('disable')) hideSuggestWords()
        return searchArticles()
    } 
    if(suggestMainInput.classList.contains('disable') || suggestMainInput.querySelectorAll('div').length === 0) return

    let suggestDivs = suggestMainInput.querySelectorAll('div')

    if(suggestMainInput.querySelectorAll('div.active').length === 0 && (e.keyCode === 40 || e.keyCode === 38)) {
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
        return suggestDivs[place].classList.add('active')
    } 
    if(suggestMainInput.querySelectorAll('div.active').length === 1) suggestMainInput.querySelectorAll('div .active')[0].classList.remove('active')
    if(e.keyCode === 40) {
        if(place === suggestDivs.length - 1) place = - 1
        suggestDivs[place + 1].classList.add('active')
        place ++
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
    }
    else if(e.keyCode === 38) {
        if(place === 0) place = suggestDivs.length
        suggestDivs[place - 1].classList.add('active')
        place --
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
    }
}

let mouseSuggestHover = false 
function mouseSuggestHoverChange(parameter) {
    mouseSuggestHover = parameter
}

let searchSuggestOptionsArray = []
let resultArray = []
let searchSuggestOptionSelectedWord
const maxNumberSuggestWords = 6

async function fetchWords(input) {
    const res = await fetch(`https://api.datamuse.com/sug?s=${input}`)
    return words = await res.json()
}
async function manageSuggestWords() {
    let  suggestWordsArray = await fetchWords(mainSearchInput.value)
    if(suggestWordsArray.length === 0) return hideSuggestWords()
    
    if(suggestWordsArray.length > 6) suggestWordsArray = removeCharactersInString(suggestWordsArray, 4, suggestWordsArray.length)

    suggestBox(suggestWordsArray)

    for(let i = 0; i < suggestMainInput.getElementsByTagName('div').length;  i++) {
        suggestMainInput.getElementsByTagName('div')[i].onmouseover = () => { 
            place = i
            if(suggestMainInput.querySelectorAll('div.active').length === 1) suggestMainInput.querySelectorAll('div.active')[0].classList.remove('active')
            suggestMainInput.getElementsByTagName('div')[i].classList.add('active') 
        }
        suggestMainInput.getElementsByTagName('div')[i].onmouseleave = () => { suggestMainInput.getElementsByTagName('div')[i].classList.remove('active') }
    }
}

const suggestBox = words => {
    let wordBoxes = words.map(word => `<div class="grid pointer" onclick="selectSuggestedSearchOption(this)">
                                        <span>${word.word}</span>
                                    </div>`).join('')
    const html = `<hr class="absolute">${wordBoxes}`
    suggestMainInput.innerHTML = html
}

function removeAllSuggestWordBoxes() {
    let numberOfBoxes = suggestMainInput.querySelectorAll('div').length
    for(let i = 0; i < numberOfBoxes; i++) 
        suggestMainInput.querySelector('div').remove()
}

function selectSuggestedSearchOption(element) {
    removeActiveSidebarCategory()
    hideSuggestWords()
    let elementInnerHTML = addCharacterBetweenSpaceInString(element.firstElementChild.innerHTML, ' ', '+')
        mainSearchInput.value = element.firstElementChild.innerHTML
    searchArticles()
} 

function addCharacterBetweenSpaceInString(word ,replace ,character) { 
    word = word.trim().replace(/\s\s+/g, ' ');
    if(replace === ' ') return word.replace(/\s/g, character) 
    else if(replace === '+')return word.replace(/\+/g, character)
}

function updateCountrySelect(country) {
    selectedCountry.innerHTML = country
    if(location.pathname.includes('search')) string = '&'
    else string = '?'
    historyPushState(location.origin + location.pathname, location.search.replace(regularExpressions.url.country,`${string}cou=${getCountryAcronym(country)}`), '', '')
    hideSelectCountry()
}

function createUrlPath(type, search) {
    if(search === undefined && location.pathname.includes(type)) return 
    let path 
    let query = ''
    if(type === 'headlines') path = filePath.headlines
    else if(type === 'search') {
        path = filePath.search 
        query = `q=${search}&`
    } 
    else if(type === 'following') path = filePath.following
    else if(type === 'for-you') path = filePath.forYou
    else if(type === 'library') path = filePath.library
    else if(type === 'covid-19') path = filePath.covid19
    else if(type === 'world') path = filePath.world
    else if(type === 'business') path = filePath.business
    else if(type === 'technology') path = filePath.technology
    else if(type === 'entertainment') path = filePath.entertainment
    else if(type === 'sports') path = filePath.sports
    else if(type === 'health') path = filePath.health
    
    path = `${path}?${query}cou=${getCountryAcronym(selectedCountry.innerHTML)}&bg=${backgroundColor}`
    openLinks(path)
}

let activeCountry
let suggestCountriesArray = []
function generateCountries() {
    listOfCountries.innerHTML = ''
    suggestCountryCountainer.innerHTML = ''
    if(selectedCountry.innerHTML.trim() !== userLocationInformationValue[0]) {
        if(checkForDoubleCountriesSuggest(userLocationInformationValue[0]) === false) suggestCountriesArray.push(userLocationInformationValue[0])
    } else suggestCountriesArray.push(userLocationInformationValue[0])    

    if(selectedC !== null) suggestCountriesArray.push(selectedC)

    while(suggestCountriesArray.length > 3) {
        if(userLocationInformationValue[0] !== suggestCountriesArray[suggestCountriesArray.length - 1] && selectedC !== suggestCountriesArray[suggestCountriesArray.length - 1]) suggestCountriesArray.pop()
        else if(userLocationInformationValue[0] !== suggestCountriesArray[suggestCountriesArray.length - 1] || selectedC !== suggestCountriesArray[suggestCountriesArray.length - 1]) suggestCountriesArray.splice(suggestCountriesArray.length - 3,1)
        else suggestCountriesArray.splice(suggestCountriesArray.length - 2, 1)
    }
    suggestCountriesArray.unshift(selectedCountry.innerHTML.trim())

    removeDuplicates(suggestCountriesArray)
    

    for(let i = 0; i < suggestCountriesArray.length; i++) {
        if(i === 0 && selectedC == null) createElementsForCountry(suggestCountriesArray[i], 'active', 'suggested-countries') 
        else if(i === suggestCountriesArray.length - 1 && selectedC !== null) createElementsForCountry(suggestCountriesArray[i], 'active', 'suggested-countries')
        else if(suggestCountriesArray[i] !== undefined) createElementsForCountry(suggestCountriesArray[i], 'not-active', 'suggested-countries')
    }
    selectedC = null
    
    let newCountriesArray = removeSelectedValuesFromArray(suggestCountriesArray, countries)
    for(let i = 0; i < newCountriesArray.length; i++) 
        createElementsForCountry(newCountriesArray[i], 'not-active', 'normal') 
}
function removeDuplicates(array) { array.splice(0, array.length, ...(new Set(array))) }
function removeSelectedValuesFromArray(array, target) { return target.filter(val => !array.includes(val)) }
function checkForDoubleCountriesSuggest(country) {
    for(let i = 0; i < suggestCountriesArray.length; i++) 
        if(suggestCountriesArray[i] === country)
            return true
    return false
}

function createElementsForCountry(country, activeCountry, location) {
    let aside = document.createElement('aside')
        aside.classList.add('radio-button-container','grid')
    let figure = document.createElement('figure')
        figure.classList.add('radio-button','flex','align-center','justify-center', activeCountry)
    let divBorder = document.createElement('div')
        divBorder.classList.add('radio-button-border','flex','align-center','justify-center','pointer', activeCountry)
        divBorder.onclick = () => {changeSelectedCountry(divBorder)}
    let divCenter = document.createElement('div')
        divCenter.classList.add('radio-button-center', activeCountry)

    let p = document.createElement('p')
        p.innerHTML = country
        p.onclick = () => { changeSelectedCountry(p) }

    divBorder.appendChild(divCenter)
    figure.appendChild(divBorder)
    aside.appendChild(figure)
    aside.appendChild(p)
    location === 'suggested-countries' ? suggestCountryCountainer.appendChild(aside) : listOfCountries.appendChild(aside)    

}
function changeSelectedCountry(element) {
    let aside = element.parentElement
    if(element.firstElementChild) aside = aside.parentElement
    if(aside.firstElementChild.classList.contains('active')) return  
    let oldSelect = document.querySelector('.radio-button-container > .active')
        if(oldSelect) {
            oldSelect.classList.remove('active')
            oldSelect.firstElementChild.classList.remove('active')
            oldSelect.firstElementChild.firstElementChild.classList.remove('active')
        }
    aside.firstElementChild.classList.add('active')
    aside.firstElementChild.firstElementChild.classList.add('active')
    aside.firstElementChild.firstElementChild.firstElementChild.classList.add('active')
}

let lastSelectedCountry = null
let selectedC = null
let newCountriesArray = []
searchCountriesInput.oninput = () => {
    let input = searchCountriesInput.value
    selectedC = document.querySelector('.radio-button-container > .active')
    if(selectedC !== null) {
        selectedC = selectedC.parentElement.lastElementChild.innerHTML
        lastSelectedCountry = selectedC
    } 
    listOfCountries.innerHTML = ''
    suggestCountryCountainer.innerHTML = ''
    if(!input.trim()){
        elementAdjustmentsSearchCountries()
        return generateCountries()
    }
    elementAdjustmentsSearchCountries('change')
    newCountriesArray = []
    for(let i = 0; i < countries.length; i++)
        if(countries[i].toLowerCase().includes(input.toLowerCase()) > 0)
            newCountriesArray[i] = countries[i]

    newCountriesArray = newCountriesArray.filter((e) => { return e != null })
    for(let i = 0; i < newCountriesArray.length; i++) {
        if(newCountriesArray[i] === lastSelectedCountry) createElementsForCountry(newCountriesArray[i], 'active', 'list')
        else createElementsForCountry(newCountriesArray[i], 'no', 'list')
    }
}

function elementAdjustmentsSearchCountries(order) {
    if(order == 'change') {
        document.querySelectorAll('#select-country > h6')[0].classList.add('disable')
        document.querySelectorAll('#select-country > h6')[1].classList.add('disable')
        listOfCountries.style.gridRow = '3/8'    
    } else {
        document.querySelectorAll('#select-country > h6')[0].classList.remove('disable')
        document.querySelectorAll('#select-country > h6')[1].classList.remove('disable')
        listOfCountries.style.gridRow = 'auto'    
    }
}

let children = []
let hasChildren = []
let noChildren = []
let clickOnOpenedElement
function clickInOutCheck(parent,target) {

    clickOnOpenedElement = false
    doesElementHaveChildren(parent)

    while(children.length !== 0) {
        doesElementHaveChildren(children[0])
        children.shift()
    }

    if(parent === selectCountryDiv || parent === logInOptions){
        if(target === overlay) clickOnOpenedElement = false
        else clickOnOpenedElement = true
    } else {
        if(target.lastElementChild == document.querySelectorAll('script').lastElementChild) clickOnOpenedElement = true
        else clickOnOpenedElement = false
    }

    checkIfClickIsOnElement(hasChildren,target)
    checkIfClickIsOnElement(noChildren,target)
    
    if(clickOnOpenedElement == false && parent == extraSearchOptions) manageExtraSearchOptions()
    else if(clickOnOpenedElement == false && parent == extOptProfile) manageExtraProfileOptions()
    else if(clickOnOpenedElement == false && parent == selectCountryDiv) hideSelectCountry()
    else if(clickOnOpenedElement == false && parent == logInOptions) manageLoginOptions()

    children = []
    hasChildren = []
    noChildren = []
} 
function doesElementHaveChildren(parent) {
    if(parent.children.length > 0){
        hasChildren.push(parent)
        for(let i = 0; i < parent.children.length; i++)
            children.push(parent.children[i])
    }
    else noChildren.push(parent)
}
function checkIfClickIsOnElement(array,target) {
   for(let i = 0; i < array.length; i++) 
       if(array[i] === target) 
            return clickOnOpenedElement = true
}


exactPhrase.oninput = () => { inputExtraSearchOptionChange() }
hasWords.oninput = () => { inputExtraSearchOptionChange() }
excludeWords.oninput = () => { inputExtraSearchOptionChange() }

function inputExtraSearchOptionChange() {
    if(hasWords.value.length === 0 && exactPhrase.value.length === 0 && excludeWords.value.length === 0){
        submitButton.disabled = true
        submitButton.classList.add('ext-opt-submit-disable')
        submitButton.classList.remove('ext-opt-submit')
    } else if (hasWords.value.length !== 0 || exactPhrase.value.length !== 0 || excludeWords.value.length !== 0){
        submitButton.disabled = false
        submitButton.classList.remove('ext-opt-submit-disable')
        submitButton.classList.add('ext-opt-submit')
    }
}


function saveSearchWord(element) {
    if(element.firstElementChild.classList.contains('yellow-color')) {
        element.firstElementChild.classList.remove('yellow-color', 'fa')
        element.firstElementChild.classList.add('fal')
    } 
    else {
        element.firstElementChild.classList.add('yellow-color', 'fa')
        element.firstElementChild.classList.remove('fal')
    }
}
function followSearchWord(element) {
    if(element.firstElementChild.classList.contains('blue-color')) {
        element.innerHTML = ' <i class="fa fa-star"></i> Follow'
        element.firstElementChild.classList.remove('blue-color')
        element.classList.remove('blue-color')
    } else {
        element.innerHTML = ' <i class="fa fa-star"></i> Following'
         element.firstElementChild.classList.add('blue-color')
         element.classList.add('blue-color')
    }
} 


async function suggestWords() {
    let fetchArray = []
    let suggestWordsArray = []
    let input = mainSearchInput.value.split(' ')
    let n = 0
    while(suggestWordsArray.length < 8) { 
        fetchArray = await fetchWords(input[n])

        for(let i = 0; i < fetchArray.length; i++)
            if(suggestWordsArray.indexOf(fetchArray[i].word) === -1 && fetchArray[i].word !== mainSearchInput.value) suggestWordsArray.push(fetchArray[i].word)
        
        input[n] = removeCharactersInString(input[n], 0, -1)
        if(input.length === 0) break
        if(n == input.length) n = 0
        else n++
    }
    document.querySelector('.suggested-words footer').innerHTML = 'More'    
    removeDisableSideElements()
    generateSuggestWords(suggestWordsArray)
}

let moreSuggestWordsArray = []
function generateSuggestWords(array) {
    let section = document.querySelector('.suggested-words section')
        section.innerHTML = ''

    for(let i = 0; i < array.length; i++) {
        let div = document.createElement('div')
            div.innerHTML = array[i]
            // div.onclick = selectSuggestedSearchOption
        let hr = document.createElement('hr')

        if(i > 5) {
            div.classList.add('disable')
            hr.classList.add('disable')
            moreSuggestWordsArray.push(div, hr)
        } 
        section.appendChild(div)
        section.appendChild(hr)
    }
}
function moreSuggestWords() { 
    if(document.querySelector('.suggested-words footer').innerHTML.trim() === 'More') {
        moreSuggestWordsArray.forEach(element => element.classList.remove('disable')) 
        document.querySelector('.suggested-words footer').innerHTML = 'Less'    
    } else {
        moreSuggestWordsArray.forEach(element => element.classList.add('disable')) 
        document.querySelector('.suggested-words footer').innerHTML = 'More'    
    }
}

function addDisableSideElements() { mainAsideContent.querySelectorAll('article.disable').forEach(article => article.classList.add('disable')) }
function removeDisableSideElements() { mainAsideContent.querySelectorAll('article.disable').forEach(article => article.classList.remove('disable')) }






/* API */

// fetchNewsArticles()
// async function fetchNewsArticles() {


//     const response = await fetch(`http://cors-anywhere.herokuapp.com/`).catch(() => {
//         noArticlesFoundNotification()
//     })
//     // const response = await fetch(newsApiLoadUrl).catch(err => {
//     //     noArticlesFoundNotification()
//     // })
//     const json = await response.json()
//     const articles = await json.articles

//     console.log(articles)


// }





function sayHello (name, age) {
    // console.log(name)
    // console.log(age)
    // console.log(this)
}
sayHello.call('This', 'Nik Topler', 18)

const information = {
    firstName : 'Nik',
    lastName : 'Topler'
}
let { firstName } = information
// console.log(firstName)


let newArray = [1 ,2, 123, 23, 4, 3.123, 12, 93, 0]
let result = newArray.filter( val => { return val % 2 === 1} )
// console.log(result)