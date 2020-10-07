/* News API */

    const countries = ['Arab Emirates','Argentina','Australia','Austria','Belgium','Brasil','Bulgaria','Canada','China','Colombia','Cuba','Czech Republic','Egypt','England','France','Germany','Greece','Hong Kong','Hungary','Indonesia','Ireland','Israel','Italy','Japan','Latvia','Lithuania','Malaysia','Mexico','Morocco','Netherlands','New Zealand','Nigeria','Norway','Philippines','Poland','Portugal','Romania','Russia','Saudia Arabia','Serbia','Singapore','Slovakia','Slovenia','South Africa','South Korea','Sweden','Switzerland','Taiwan','Thailand','Turkey','Ukraine','United States','Venezuela']
    const countryAcronyms = ['ae','ar','au','at','be','br','bg','ca','cn','co','cu','cz','eg','gb','fr','de','gr','hk','hu','id','it','il','it','jp','lt','lv','my','mx','ma','nl','nz','ng','no','ph','pl','pt','ro','ru','sa','rs','sg','sk','si','za','kr','se','ch','tw','th','tr','ua','us','ve']
    const categories = ['all','business','entertainment','general','health','science','sports','technology','world']
    const language = ['All','Arabic','German','English','Spanish','French','Italian','Dutch','Norwegian','Portuguese','Russian','Swedish','Chinese']
    const languageAcronyms = ['all','ar','de','en','es','fr','it','nl','no','pt','ru','se','zh']
    const colors = ['rgb(211, 47, 47)','rgb(123, 31, 162)','rgb(81, 45, 168)','rgb(48, 63, 159)','rgb(25, 118, 210)','rgb(2, 136, 209)','rgb(0, 151, 167)','rgb(0, 121, 107)','rgb(56, 142, 60)','rgb(104, 159, 56)','rgb(175, 180, 43)','rgb(251, 192, 45)','rgb(255, 160, 0)','rgb(245, 124, 0)','rgb(230, 74, 25)','rgb(93, 64, 55)','rgb(97, 97, 97)']
    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
    const daysAcronyms = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']
    // const websiteURL = 'http://localhost:8080/News-website'
    const websiteURL = 'https://news.niktopler.com'

    const topStoriesURL = '&t=topstories&'
    const everythingURL = '&t=everything&'
    const sourcesURL = '&t=sources&'

/* Index */

    /** Navigation Bar Left */
    const burgerMenuFigure = document.getElementById('menu-burger-button')

    /** Navigation Bar Middle */
    const navigationBar = document.getElementById('navigation-bar')
    const navigationBarLeft = document.getElementById('navigation-bar-left')
    const navigationBarMiddle = document.getElementById('navigation-bar-middle')
    const navigationBarRight = document.getElementById('navigation-bar-right')

    const extraSearchOptions = document.getElementById('extra-search-options')
    const extOptIcon = document.getElementById('option-icon-search-bar')
    const mainSearchIcon = document.getElementById('main-search-icon')
    const mainSearchInput = document.getElementById('main-search-input')
        const mainSearchFigure = document.getElementById('search-icon-figure')
        const suggestMainInput = document.getElementById('search-words')    
        const mainSearchBackLeftIcon = document.getElementById('main-search-icon-back-left')
        const mainSearchBackLeftTooltiptext = document.getElementById('main-search-back-left-tooltiptext')
        const exactPhrase = document.getElementById('extra-option-input1')
        const hasWords = document.getElementById('extra-option-input2')
        const excludeWords = document.getElementById('extra-option-input3')
        const submitButton = document.getElementById('extraOptionsSearchButton')
        const date = document.getElementById('extra-option-select')
    /** Navigation Bar Right */
        const loginButton = document.getElementById('login-button')
    /** Extra Search Options */
        const indexTimeSelect = document.getElementById('index-time-select')
        const indexTimeLabel = document.getElementById('index-time-label')

    /* Navigation Bar Right */
        const logInOptions = document.getElementById('login-option-div')

        const CORS = 'https://cors-anywhere.herokuapp.com/'
    /** Main Content */
        /** Side Menu */
        let sideBarContent = document.getElementById('side-bar-content')
        let sideBar = document.getElementById('side-bar')
        const selectCountryDiv = document.getElementById('select-country')
        const listOfCountries = document.getElementById('list-of-countries')
        const selectedCountry = document.getElementById('country-name-side-menu')
        const suggestCountryCountainer = document.getElementById('suggest-country')
        const searchCountriesInput = document.getElementById('search-country-input')
        const mainContentSection = document.getElementById('main-content-section')
        let mainAsideContent = document.getElementById('main-side-content-container')
        let aboutContentSection = document.getElementById('about-content-section')
        const sideBarAboutContent = document.getElementById('about-sidebar-content')
        const mainContentContainer = document.getElementById('main-content-container')
        let mainContentHeader = document.getElementById('main-content-header')
        const showCountriesLink = document.getElementById('show-countries-button')
        let sclSpan
        let sclStrong
        const mainImgContainer = document.querySelector('#main-img-container.main-img-container')
        if(showCountriesLink !== null) {
            sclSpan = showCountriesLink.firstElementChild.firstElementChild
            sclStrong = showCountriesLink.firstElementChild.lastElementChild
        }

        const imageNameLabel = document.getElementById('image-name-label')
        const errorSpanUploadImage = document.getElementById('error-span-upload-image')

    const main = document.getElementById('main')
    const overlay = document.getElementById('overlay')
    const navigationBarProfileImageDiv = document.getElementById('outter-container')
    const extOptProfile = document.getElementById('profile-extra-options')


    let currentNewsArticles = [
        {
            "title" : "Naslov1",
            "subtitle" : "Podnaslov1",
            "description" : 'Opis1',
            "date" : "20-20-2020",
            "source" : "CNN1",
            "author" : "Nik Topler1"
        },
        {
            "title" : "Naslov2",
            "subtitle" : "Podnaslov2",
            "description" : 'Opis2',
            "date" : "20-20-2020",
            "source" : "CNN2",
            "author" : "Nik Topler2"
        },
        {
            "title" : "Naslov3",
            "subtitle" : "Podnaslov3",
            "description" : 'Opis3',
            "date" : "20-20-2020",
            "source" : "CNN3",
            "author" : "Nik Topler3"
        },
        {
            "title" : "Naslov4",
            "subtitle" : "Podnaslov4",
            "description" : 'Opis4',
            "date" : "20-20-2020",
            "source" : "CNN4",
            "author" : "Nik Topler4"
        },
        {
            "title" : "Naslov5",
            "subtitle" : "Podnaslov5",
            "description" : 'Opis5',
            "date" : "20-20-2020",
            "source" : "CNN5",
            "author" : "Nik Topler5"
        }
    ]
    
    currentNewsArticles.push(
        {
            "title" : "Naslov6",
            "subtitle" : "Podnaslov6",
            "description" : 'Opis6',
            "date" : "20-20-2020",
            "source" : "CNN6",
            "author" : "Nik Topler6"
        }
    )

    const filePath = {
        headlines : 'headlines.php',
        search : 'search.php',
        following : 'personal/following.php',
        forYou : 'personal/for-you.php',
        library : 'personal/library.php',
        covid19 : 'topics/covid-19.php',
        world : 'topics/world.php',
        business : 'topics/business.php',
        technology : 'topics/technology.php',
        entertainment : 'topics/entertainment.php',
        sports : 'topics/sports.php',
        health : 'topics/health.php'
     }

/* Personal */

    let backgroundColor = 'light'