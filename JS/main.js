let pathLocation = '../'
let weatherArrayToday
let weatherArrayTommorow
let weatherArray2Days

const weather = {
    getweather : async function () {
        city = removeDiacritics(userLocationInformationValue[3])
        const key = await php.info('weather')
        const response = await fetch(`https://cors-anywhere.herokuapp.com/https://api.weatherapi.com/v1/forecast.json?key=${key}&q=${city}&days=7`)
        const data = await response.json()
            weatherArrayToday = data.forecast.forecastday[0]
            weatherArrayTommorow = data.forecast.forecastday[1]
            weatherArray2Days = data.forecast.forecastday[2]
    },
    updateWeather : function () {
        let header = document.querySelectorAll('.weather-main-header')[0]
        header.children[0].src = weatherArrayToday.day.condition.icon
        header.children[1].innerHTML = userLocationInformationValue[3]
        header.children[2].innerHTML = `${Math.round(weatherArrayToday.day.avgtemp_c)}°C`

        let weatherDate = new Date(weatherArrayToday.date)
        let tommorowNumber = weatherDate.getDay()
        let dayAfterTomorrow = weatherDate.getDay()

        if (tommorowNumber == 6)
            tommorowNumber = tommorowNumber - 7
        if (dayAfterTomorrow == 5 || dayAfterTomorrow == 6)
            dayAfterTomorrow = dayAfterTomorrow - 7

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
}

let userLocationInformationValue
const user = {
    location : async() => { userLocationInformationValue = await user.country() },
    country : async() => {
        const key = await php.info('user')
        const response = await fetch(`https://ipinfo.io?token=${key}`)
        const data = await response.json()
        const userCountryAcronym = data.country.toLowerCase()
        const userCountry = getAcronymCountry(userCountryAcronym)
        const userCity = data.city
        const userRegion = data.region
        const userLocation = data.loc
        const userTimeZone = data.timezone
        return [userCountry, userCountryAcronym, userCity, userRegion, userLocation, userTimeZone]
    }
}

const searchBox = {
    update : async (query) => {
        let i = 0
        let images = await searchBox.fetch(query)
        let searchAside = document.querySelector('article.search.aside')
        if(images.hits.length === 0) {
            images = await searchBox.fetch('nature')
            i = Math.round(Math.random() * images.hits.length)
            searchAside.firstElementChild.lastElementChild.innerHTML = 'Search'
        } else searchAside.firstElementChild.lastElementChild.innerHTML = 'Topic'

            searchAside.firstElementChild.firstElementChild.innerHTML = capitalizeString(mainSearchInput.value)
            searchAside.firstElementChild.querySelector('figure img').src = images.hits[i].webformatURL 
            searchAside.firstElementChild.querySelector('figure img').classList.remove('disable')
    },
    fetch : async(query) => {
        const key = await php.info('images')
        const response = await fetch(`https://pixabay.com/api/?key=${key}&q=${query}&image_type=photo`)
        const image = await response.json()
        return image    
    }
}

let mouseSuggestHover = false 
let moreSuggestWordsArray = []
const suggest = {
    fetch : async (input, type) => {
        let res
        place = 0
        if(type === 'words' || !type) res = await fetch(`https://api.datamuse.com/words?ml=${input}`)
        else if(type === 'suggest') res = await fetch(`https://api.datamuse.com/sug?s=${input}`)
        else if(type === 'sp') res = await fetch(`https://api.datamuse.com/words?sp=${input}`)
        return words = await res.json()    
    },
    suggest : async() => {
        let fetchArray = []
        let suggestWordsArray = []
        let replaceInput = mainSearchInput.value.trim().replace(regularExpressions.string.symbols, ' ')
        let input = replaceInput.split(' ')
        let n = 0
        const maxLength = 40
        while(suggestWordsArray.length < maxLength) { 
            fetchArray = await suggest.fetch(input[n])
            for(let i = 0; i < fetchArray.length; i++)
                if(suggestWordsArray.indexOf(fetchArray[i].word) === -1 && fetchArray[i].word !== mainSearchInput.value && suggestWordsArray.length < maxLength) suggestWordsArray.push(fetchArray[i].word)
            if(input.length === n) break
            n++
        }
        suggest.generate(suggestWordsArray)
        removeDisableSideElements()
    },
    generate : (array) => {
        let section = document.querySelector('article.suggested-words.aside section')
        section.innerHTML = ''

        for(let i = 0; i < array.length; i++) {
            let div = document.createElement('div')
                div.innerHTML = array[i]
                div.classList.add('search-box')
                div.onclick = () => suggest.selectSuggestedSearchOption(div)
            section.appendChild(div)
        }
    },
    manageSuggestWords : async () => {
        const maxLength = 10
        let suggestWordsArray = await suggest.getSuggestWords()
        if(suggestWordsArray.length === 0) return hideSuggestWords()
        
        if(suggestWordsArray.length > maxLength) 
            suggestWordsArray = suggestWordsArray.slice(0, maxLength)
        suggest.suggestBox(suggestWordsArray)
    
        for(let i = 0; i < suggestMainInput.getElementsByTagName('div').length;  i++) {
            suggestMainInput.getElementsByTagName('div')[i].onmouseover = () => { 
                place = i
                if(suggestMainInput.querySelectorAll('div.active').length === 1) suggestMainInput.querySelectorAll('div.active')[0].classList.remove('active','key')
                suggestMainInput.getElementsByTagName('div')[i].classList.add('active') 
            }
            suggestMainInput.getElementsByTagName('div')[i].onmouseleave = () => { suggestMainInput.getElementsByTagName('div')[i].classList.remove('active','key') }
        }        
    },
    getSuggestWords : async() => {
        let array
        if(mainSearchInput.value.length < 3) array = await suggest.fetch(mainSearchInput.value, 'sp')
        else array = await suggest.fetch(mainSearchInput.value, 'words')
        if(array.length === 0) array = await suggest.fetch(mainSearchInput.value, 'suggest')
        return array
    },
    suggestBox : (words) => {
        let wordBoxes = words.map(word => `<div class="grid pointer" onclick="suggest.selectSuggestedSearchOption(this.firstElementChild)">
                                            <span>${word.word}</span>
                                        </div>`).join('')
        const html = `<hr class="absolute">${wordBoxes}`
        suggestMainInput.innerHTML = html
    },
    mouseSuggestHoverChange : (parameter) =>  { 
        mouseSuggestHover = parameter 
    },
    removeAllSuggestWordBoxes : () => {
        let numberOfBoxes = suggestMainInput.querySelectorAll('div').length
        for(let i = 0; i < numberOfBoxes; i++) 
            suggestMainInput.querySelector('div').remove()
    },
    selectSuggestedSearchOption : (element) => {
        removeActiveSidebarCategory()
        hideSuggestWords()
        let elementInnerHTML = removeDiacritics(element.innerHTML).trim()
        let selectedCountryAcronym = getCountryAcronym(selectedCountry.innerHTML.trim())
        historyPushState(location.origin + location.pathname, `?q=${elementInnerHTML}&`, `cou=${selectedCountryAcronym}&`,`bg=${backgroundColor}`)
        mainSearch()    
    }
}

const php = {
    info : async (word) => {
        const res =  await fetch(`${pathLocation}privateInfo.php`, {                          
            method: "POST", 
            body: createFormData(word, '')
        })
        return await res.text()
    },
    session : async () => {
        const res =  await fetch('include/session.inc.php', {                          
            method: "POST", 
            body: createFormData('user', '')
        })
        return await res.text()
    },
    userInsertInDB : async (type, userInfo, id_token, clientID) => {
        let array
        if(type === 'google') {
            let id = userInfo.getId()
            let name = userInfo.getGivenName()
            let surname = userInfo.getFamilyName()
            let img = userInfo.getImageUrl()
            let email = userInfo.getEmail()
            array = JSON.stringify([id, id_token, clientID, name, surname, img, email])
        } else if(type === 'facebook') array = JSON.stringify([userInfo[0], userInfo[1], userInfo[2],userInfo[3], userInfo[4], userInfo[5].data.url,userInfo[6]])

        const res = await fetch(`${pathLocation}include/insert.inc.php`, {
            method: "POST", 
            body: createFormData(type, array)
        })
        const data = await res.text()
        console.log(data)
        if(data === 'success') location.reload()
    }
}

const error = {
    window : () => {
        // Checkes if correct country acronym is in URL
        if(window.location.search.match(regularExpressions.url.country)) {
            let countryAcronym = window.location.search.match(regularExpressions.url.country)[0].slice(5, 7)
            let country = getAcronymCountry(countryAcronym)
                if(country) sclStrong.innerHTML = country
                else return openLinks(filePath.headlines)
        }
    },
    headlines : () => {

    },
    search : () => {
        // if(mainSearchInput.value.length === 0) return true
        // if(window.location.pathname.includes('search') && window.location.search.match(regularExpressions.url.query)[0].slice(3, -1).length === 0) return true
        // if(window.location.search.match(regularExpressions.url.query)[0].slice(3, -1).length === 0) return true
    }
}

const regularExpressions = {
    url : {
        query : /[\?|\&]+[q]+[=].*?[&]/g,
        country : /[\?|\&]+[c]+[o]+[u]+[=].{2}/g,
        backgroundColor : /[\&]+[b]+[g]+[=].*/g
    },
    string : {
        symbols : /[@_!#$%^&*()<>?/|}{~:"'-]/g
    }
}

// const error = {
//     headlines : () => {
        
//     },
//     search : () => { 
//         // let countryAcronym = window.location.search.match(regularExpressions.url.country)[0].slice(5, 7)
//         if(!window.location.search.match(regularExpressions.url.country) 
//             || !getAcronymCountry(countryAcronym)
//             || !window.location.search.match(regularExpressions.url.query)
//             || !window.location.search.match(regularExpressions.url.backgroundColor)) 
//                 openLinks(filePath.headlines)
//         else {
//             let urlCountryAcronym = countryAcronym
//             let urlCountry = getAcronymCountry(urlCountryAcronym)
//             updateCountrySelect(urlCountry)
//         }
//     }  
// }

window.onload = async () => {
    windowWidthSettings()
    // Close all open windows
        hideExtraSearchOptions()
        hideSuggestWords()
        generateColors()

    if(window.location.hash === '#login') manageLoginOptions()
    document.querySelectorAll('input').forEach(input => { input.autocomplete = 'off' })

    error.window()

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
    else if (window.location.pathname.includes('search')) mainSearch()
    await user.location()
    // changeBackgroundColor()    
}

window.onclick = (e) => {      
    if(logInOptions.classList.contains('active')) clickInOutCheck(logInOptions, e.target)
    else if(!suggestMainInput.classList.contains('disable')) clickInOutCheck(suggestMainInput, e.target)
    else if(!extOptProfile.classList.contains('disable')) clickInOutCheck(extOptProfile, e.target)
    else if(selectCountryDiv.classList.contains('active')) clickInOutCheck(selectCountryDiv, e.target)
    else if(!extraSearchOptions.classList.contains('disable')) clickInOutCheck(extraSearchOptions, e.target)
}
window.onresize = windowWidthSettings

function historyPushState(webiste, string, country, background) { history.pushState({}, null, webiste + string + country + background) }

function changeBackgroundColor() { document.body.className = window.location.search.match(regularExpressions.url.backgroundColor)[0].slice(4,10) }

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
function celsiusToFahrenheit(number) { return number * 9/5 + 32 }
function celsiusToKelvin(number) { return Number(number) + 273 }
function kelvinToFahrenheit(number) { return (number - 273) * 9/5 + 32 }
function kelvinToCelsius(number) { return number - 273 }
function fahrenheitToCelsius(number) { return (number - 32) * 5/9 }
function fahrenheitToKelvin(number) { return (number - 32) * 5/9 + 273 }

/* HEADLINES */
async function headlines() {
    pathLocation = ''
    await user.location()
    await weather.getweather()
    weather.updateWeather()

    sidebarCategorySelect(document.querySelector('.fa-newspaper').parentElement.parentElement)

    historyPushState(window.location.origin + window.location.pathname, '', `?cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}`,`&bg=${backgroundColor}`)
}

/* SEARCH */ 
    function mainSearch(extra, type) {
        let url = ''
        let newSearch = false 
        pathLocation = ''

        if(error.search() === true) return 

        if(!type) type = 'main-url'
        if(!window.location.pathname.includes('search')) newSearch = true
        if(window.location.search.match(regularExpressions.url.query) === null && newSearch === false) return openLinks(filePath.headlines) 
        
        if(!extra && newSearch === true) {
            url = removeDiacritics(mainSearchInput.value).trim()
            return openLinks(filePath.search + `?q=${url}&cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}&bg=${backgroundColor}`)
        } else if(extra && newSearch === true) {
            url = createUrlExtraOptions()
            return openLinks(filePath.search + url[1] + url[2] + url[3])
        } else if(!extra && newSearch === false) {
            addDisableSideElements()
            url = createUrlExtraOptions(type)
            historyPushState(url[0], url[1], url[2], url[3])
            let searchInputValue = window.location.search.match(regularExpressions.url.query)[0].slice(3, -1)
                mainSearchInput.value = urlEdit(searchInputValue)
        } else if(extra && newSearch === false) {
            addDisableSideElements()
            url = createUrlExtraOptions()
            historyPushState(url[0], url[1], url[2], url[3])
        }

        let searchInputValue = window.location.search.match(regularExpressions.url.query)[0].slice(3, -1)
        mainSearchInput.value = urlEdit(searchInputValue)

        searchBox.update(mainSearchInput.value.trim())
        hideExtraSearchOptions()
        hideSuggestWords()
        suggest.suggest()

        /* Search news articles */
            // console.log(url[4])
    }
    function createUrlExtraOptions(option) {
        let url
        let exactPhraseV = removeDiacritics(exactPhrase.value).trim().replace(/\s\s+/g, ' ')
        let hasWordsV = removeDiacritics(hasWords.value).trim().replace(/\s\s+/g, ' ')
        let excludeWordsV = removeDiacritics(excludeWords.value).trim().replace(/\s\s+/g, ' ')
        let time = `&t=${indexTimeLabel.innerHTML.trim().replace(' ','').toLowerCase()}`

        resetExtraSearchOptions()

        if(option === 'main-url') {
            url = removeDiacritics(window.location.search.match(regularExpressions.url.query)[0].slice(3, -1))
            time = ''
        } else if(option === 'main-input') {
            url = removeDiacritics(mainSearchInput.value).trim()
            time = ''
        } else if(exactPhraseV.length !== 0 && hasWordsV.length === 0  && excludeWordsV.length === 0) url = `"${exactPhraseV}"`
        else if(hasWordsV.length !== 0 && exactPhraseV.length === 0  && excludeWordsV.length === 0) url = hasWordsV
        else if(excludeWordsV.length !== 0 && exactPhraseV.length === 0  && hasWordsV.length === 0) url = `-${excludeWordsV}`
        else if (exactPhraseV.length !== 0 && hasWordsV.length !== 0  && excludeWordsV.length === 0) url = `"${exactPhraseV}" ${hasWordsV}`
        else if(hasWordsV.length !== 0 && excludeWordsV.length !== 0 && exactPhraseV.length === 0) url = `${hasWordsV} ${devideStringIntoWords(excludeWordsV, 'EW')}`
        else if(exactPhraseV.length !== 0 && excludeWordsV.length !== 0 && hasWordsV.length === 0) url = `"${exactPhraseV}" ${devideStringIntoWords(excludeWordsV, 'EW')}`
        else if(exactPhraseV.length !== 0 && excludeWordsV.length !== 0 && hasWordsV.length !== 0) url = `"${exactPhraseV}" ${hasWordsV} ${devideStringIntoWords(excludeWordsV, 'EW')}`
        return [`${location.origin}/News-website/search.php`,`?q=${url + time}`,`&cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}`,`&bg=${backgroundColor}`, url]
    }
    function devideStringIntoWords(string, keyword){
        if(keyword === 'HW') return `+${string.replace(/\s/g, ' +')}`
        if(keyword === 'EW') return `-${string.replace(/\s/g, ' -')}`
    }

/* FOR YOU */

function forYou() {
    sidebarCategorySelect(document.querySelector('.fa-user-alt').parentElement.parentElement)
}

/* FOLLOWING */

function following() {
    sidebarCategorySelect(document.querySelector('.fa-star').parentElement.parentElement)
}

/* LIBRARY */

function library() {
    sidebarCategorySelect(document.querySelector('.fa-bookmark').parentElement.parentElement)
}

/* CATEGORIES */

function category(word) {
    sidebarCategorySelect(document.querySelector(`.${word}`).parentElement.parentElement)
}

/* SETTINGS */

function settings() {
}

/* ABOUT */

function about() {
}

mainSearchFigure.onclick = () => {
    if(window.innerWidth > 964) return mainSearch(undefined, 'main-input')
    if(mainSearchIcon.classList.contains('disable') && navigationBarLeft.classList.contains('disable') && navigationBarRight.classList.contains('disable')) responsiveVersion.closeMobileVersionNavBar()
    else responsiveVersion.openMobileVersionNavBar()
}

mainSearchInput.onfocus = () => {
    if(!extraSearchOptions.classList.contains('disable')) return hideExtraSearchOptions()
    else if(mainSearchInput.value.length !== 0) showSuggestWords()
    suggest.manageSuggestWords()
}
mainSearchInput.onblur = () => {
    // hideSuggestWords()
}
mainSearchInput.oninput = () => {
    if(mainSearchInput.value.length === 0) return hideSuggestWords()
    else if(suggestMainInput.classList.contains('disable')) showSuggestWords()
    suggest.manageSuggestWords() 
}
let place = 0
mainSearchInput.onkeyup = (e) => {
    let suggestDivs = suggestMainInput.querySelectorAll('div')
    let suggestDivActiveKey = suggestMainInput.querySelectorAll('div.active.key')
    if(e.keyCode === 13) {  
        if(suggestDivActiveKey.length === 1) historyPushState(location.origin + location.pathname, `?q=${removeDiacritics(suggestDivActiveKey[0].firstElementChild.innerHTML).trim()}&`, `cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}&`,`bg=${backgroundColor}`)
        else historyPushState(location.origin + location.pathname, `?q=${mainSearchInput.value.trim()}&`, `cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}&`,`bg=${backgroundColor}`)
        mainSearch()
    } 
    if(suggestMainInput.classList.contains('disable') || suggestMainInput.querySelectorAll('div').length === 0) return

    if(suggestMainInput.querySelectorAll('div.active').length === 0 && (e.keyCode === 40 || e.keyCode === 38)) {
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
        return suggestDivs[place].classList.add('active')
    } 
    if(suggestMainInput.querySelectorAll('div.active').length === 1) suggestMainInput.querySelectorAll('div .active')[0].classList.remove('active','key')
    if(e.keyCode === 40) {
        if(place === suggestDivs.length - 1) place = - 1
        suggestDivs[place + 1].classList.add('active','key')
        place ++
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
    }
    else if(e.keyCode === 38) {
        if(place === 0) place = suggestDivs.length
        suggestDivs[place - 1].classList.add('active','key')
        place --
        mainSearchInput.value = suggestDivs[place].firstElementChild.innerHTML
    }
}

function updateCountrySelect(country) {
    selectedCountry.innerHTML = country
    if(location.pathname.includes('search')) string = '&'
    else string = '?'
    historyPushState(location.origin + location.pathname, location.search.replace(regularExpressions.url.country,`${string}cou=${getCountryAcronym(country)}`), '', '')
    hideSelectCountry()
}

function createUrlPath(type, search) {
    let path 
    if(search === undefined && location.pathname.includes(type)) return 
    if(type === 'headlines') path = filePath.headlines
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
    path = `${path}?cou=${getCountryAcronym(selectedCountry.innerHTML.trim())}&bg=${backgroundColor}`
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
        else if(userLocationInformationValue[0] !== suggestCountriesArray[suggestCountriesArray.length - 1] || selectedC !== suggestCountriesArray[suggestCountriesArray.length - 1]) suggestCountriesArray.splice(suggestCountriesArray.length - 3, 1)
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
    if(order === 'change') {
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
const countryDivExceptions = [showCountriesLink, sclSpan, sclStrong]
function clickInOutCheck(parent, target) {
    
    clickOnOpenedElement = false
    doesElementHaveChildren(parent)

    while(children.length !== 0) {
        doesElementHaveChildren(children[0])
        children.shift()
    }
    
    if(checkIfClickIsOnElement(hasChildren, target) === true || checkIfClickIsOnElement(noChildren, target) === true) clickOnOpenedElement = true
    else clickOnOpenedElement = false

    children = []
    hasChildren = []
    noChildren = []
    if(clickOnOpenedElement === true) return
    if(parent === extraSearchOptions && target !== extOptIcon) hideExtraSearchOptions()
    else if(parent === suggestMainInput && document.activeElement !== mainSearchInput) hideSuggestWords() 
    // else if(parent === extOptProfile) manageExtraProfileOptions()
    else if(parent === selectCountryDiv && countryDivExceptions.some((val) => val === target) === false) hideSelectCountry()
    else if(parent === logInOptions && target !== loginButton) manageLoginOptions()
} 
function doesElementHaveChildren(parent) {
    if(parent.children.length > 0){
        hasChildren.push(parent)
        for(let i = 0; i < parent.children.length; i++)
            children.push(parent.children[i])
    }
    else noChildren.push(parent)
}
function checkIfClickIsOnElement(array, target) { return array.some(val => { return val === target}) }


exactPhrase.oninput = () => { inputExtraSearchOptionChange() }
hasWords.oninput = () => { inputExtraSearchOptionChange() }
excludeWords.oninput = () => { inputExtraSearchOptionChange() }

function inputExtraSearchOptionChange() {
    if(hasWords.value.length === 0 && exactPhrase.value.length === 0 && excludeWords.value.length === 0) {
        submitButton.disabled = true
        submitButton.classList.add('ext-opt-submit-disable')
        submitButton.classList.remove('ext-opt-submit')
    } else if (hasWords.value.length !== 0 || exactPhrase.value.length !== 0 || excludeWords.value.length !== 0){
        submitButton.disabled = false
        submitButton.classList.remove('ext-opt-submit-disable')
        submitButton.classList.add('ext-opt-submit')
    }
}

function addDisableSideElements() { mainAsideContent.querySelectorAll('article').forEach(article => article.classList.add('disable')) }
function removeDisableSideElements() { mainAsideContent.querySelectorAll('article.disable').forEach(article => article.classList.remove('disable')) }

function follow(element) {
    if(element.lastElementChild.textContent === 'Follow') fillIcons(element.firstElementChild, element.lastElementChild, 'Following')
    else emptyIcons(element.firstElementChild, element.lastElementChild, 'Follow')

    if(window.location.pathname.includes('search')) followNews()
    else followCategory()
}
function saveNews(element) {
    if(element.lastElementChild.textContent === 'Save') fillIcons(element.firstElementChild, element.lastElementChild, 'Saved')
    else emptyIcons(element.firstElementChild, element.lastElementChild, 'Save')
    //PHP
}
function followNews() {
    //PHP
}
function followCategory() {
    
}

function fillIcons(icon, text, string) {
    icon.classList.remove('far')
    icon.classList.add('fas')
    text.textContent = string
}
function emptyIcons(icon, text, string) {
    icon.classList.add('far')
    icon.classList.remove('fas')
    text.textContent = string
}

/* API */

// fetchNewsArticles()
async function fetchNewsArticles() {

    const key = await php.info('news')
    const response = await fetch(`http://cors-anywhere.herokuapp.com/http://newsapi.org/v2/everything?q=-velenje america "coronavirus"&sortBy=popularity&apiKey=${key}`).catch(() => {
        // noArticlesFoundNotification()
    })
    // const response = await fetch(newsApiLoadUrl).catch(err => {
    //     noArticlesFoundNotification()
    // })
    const json = await response.json()
    const articles = await json.articles
}

function createFormData(word, data) { 
    let formData = new FormData
        formData.append(word, data) 
    return formData
}
function capitalizeString(string) { return string.charAt(0).toUpperCase() + string.slice(1) }
function removeCharactersInString(string, frontNumber, backNumber) { return string.slice(frontNumber, backNumber)}
function removeDuplicates(array) { array.splice(0, array.length, ...(new Set(array))) }
function removeSelectedValuesFromArray(array, target) { return target.filter(val => !array.includes(val)) }
function urlEdit(string) { return decodeURIComponent(string).trim().replace(/\s\s+/g, ' ') }
function checkIfCategoriesAreOpen() { 
    for(let i = 0; i < categories.length; i++)
            if(window.location.pathname.includes(categories[i]) || window.location.pathname.includes('covid-19')) 
                return true
    return false
 }
// string.trim().replace(/\s\s+/g, ' ').replace(/%20/g, ' ').replace(/%22/g, '"')

async function logOut(string) {
    const res = await fetch(`include/logout.inc.php`)
    const data = res.text()
    openLinks(filePath.headlines + string);
}
