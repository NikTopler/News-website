let sideMenuCounter = 0
function manageSideMenu() {
    if(window.innerWidth < 1101 && sideMenuCounter === 0){
        sideBar.style.marginLeft = '-100%'
        sideMenuCounter = 1
    } else if(window.innerWidth < 1101 && sideMenuCounter === 1){
        sideBar.style.marginLeft = '0'
        sideMenuCounter = 0
    } else if(window.innerWidth > 1100 && sideMenuCounter === 0){
        sideBar.style.marginLeft = '-100%'
        sideMenuCounter = 1
    } else if(window.innerWidth > 1100 && sideMenuCounter === 1) {
        sideBar.style.marginLeft = '0'
        sideMenuCounter = 0
    }
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

function sidebarCategorySelect(selectedElement) {
    if(selectedElement.classList.contains('active')) return
    selectedElement.classList.add('active')
    selectedElement.firstElementChild.classList.add('active')
    /* Search news articles */    
} 
function removeActiveSidebarCategory() {
    let oldSelectedElements = document.querySelectorAll('sidebar-category.active')
    for(let i = 0; i < oldSelectedElements.length; i++)
        oldSelectedElements[i].classList.remove('active')
}


function manageExtraProfileOptions() {
    if(extOptProfile.classList.contains('disable')) {
        extOptProfile.classList.remove('disable')
        navigationBarProfileImageDiv.classList.add('active')
    } else {
        extOptProfile.classList.add('disable')
        navigationBarProfileImageDiv.classList.remove('active')
    }
}

function openLinks(string) { window.location.replace(websiteURL +'/'+ string) }
const insertContainer = document.getElementById('insert-photo-container')
function showProfileImg() {
    if(mainImgContainer.classList.contains('active')) {
        manageInsertContainer()
        mainImgContainer.classList.remove('active')
        overlay.classList.remove('active')
        insertContainer.classList.remove('active')
        document.querySelector('.color-img').classList.remove('active')

    } else {
        document.querySelector('.color-img').classList.add('active')
        mainImgContainer.classList.add('active')
        overlay.classList.add('active')
    }
}
function manageInsertContainer() {
    if(insertContainer.classList.contains('active')) insertContainer.classList.remove('active')
    else insertContainer.classList.add('active')
}
function openFolder() { document.getElementById('file-upload').click() }

function generateColors () {
    let parent = document.querySelector('.color-container')
    if(!parent) return
    for(let i = 0; i < colors.length; i++) {
        let divP = document.createElement('div')
            divP.style.position = 'realtive'
            divP.classList.add('box-container')
        let div = document.createElement('div')
            div.classList.add('img','medium')
            div.style.backgroundColor = colors[i]
            divP.onclick = () => { selectImg(div) }
            divP.appendChild(div)
        if(document.querySelector('.img.small.test').style.backgroundColor === colors[i]) {
            let div1 = document.createElement('div')
                div1 .classList.add('check-mark')
            let i = document.createElement('i')
                i.classList.add('far', 'fa-check')
                div1.appendChild(i)
                div.appendChild(div1)
        }
        parent.appendChild(divP)
    }
}
function saveImg() {
    selectedImg = document.querySelector('.check-mark')
    if(!selectedImg) return
    let num
    if(selectedImg.parentElement.classList.contains('costum')) num = 0
    else if(selectedImg.parentElement.classList.contains('img')) num = 1
    else if(selectedImg.parentElement.classList.contains('google')) num = 2
    else if(selectedImg.parentElement.classList.contains('facebook')) num = 3
    else if(selectedImg.parentElement.classList.contains('github')) num = 4
    if (selectedImg.parentElement.firstElementChild.tagName == 'IMG') {
        if(num == 0 && newImg == true) img = currentImageUploadLocation
        else if(num == 0 && newImg == false) img = selectedImg.parentElement.firstElementChild.src.replace(websiteURL, '')
        else img = selectedImg.parentElement.firstElementChild.src
    } 
    else img = selectedImg.parentElement.firstElementChild.parentElement.style.backgroundColor
    uploadImg(num, img)
    newImg = false
    
}
let locationOrganiser = '../'
if(window.location.pathname.includes('headlines') || window.location.pathname.includes('search')) locationOrganiser = ''
async function uploadImg(num, img) {
    array = JSON.stringify([num, img])
    console.log(num,img)
    await fetch(`${locationOrganiser}include/update.inc.php`, {
        method: "POST", 
        body: createFormData('imageUpload', array)
    })
    location.reload()
}



function openExtraOptions(element) {
    if(element.parentElement.lastElementChild.classList.contains('disable')) {
        element.parentElement.lastElementChild.classList.remove('disable')
    } else {
        element.parentElement.lastElementChild.classList.add('disable') 
    }
} 
function hideArticle(c) { 
    document.querySelector(`article.${c}`).remove() 
    //Php
}
function openNews(element) { element.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.click() }


function follow(element) {
    if(element.lastElementChild.textContent === 'Follow') fillIcons(element.firstElementChild, element.lastElementChild, 'Following')
    else emptyIcons(element.firstElementChild, element.lastElementChild, 'Follow')

    if(window.location.pathname.includes('search')) followNews()
    else followCategory()
}
async function saveNews(num, element) {
    let i1
    let i2
    let res = await checkIfUserIsLoggedIn()
    if(res == 'ni') return manageLoginOptions()
    if(num == 1) {
        i1 = element.firstElementChild.firstElementChild
        i2 = document.querySelectorAll('.'+element.classList[1])[2].children[1].firstElementChild.firstElementChild    
    } else {
        i1 = element.children[1].firstElementChild.firstElementChild
        i2 = element.parentElement.parentElement.firstElementChild.querySelector('i')
        let n = 0
        for(let i = 0; i < publicArticleArray.length; i++) {
            if(element.parentElement.parentElement.parentElement.parentElement.classList[1].includes(i)) n = i
        }
        let array = JSON.stringify([publicArticleArray[n].title])

        const res =  await fetch(`${locationOrganiser}include/update.inc.php`, {                          
            method: "POST", 
            body: createFormData('unsaveNews', array)
        })
        const data = await res.text()
        console.log(data)
    }
    if(i1.classList.contains('fas')) {
        i1.classList.remove('fas')
        i1.classList.add('far')
        i1.classList.remove('yellow-color')
        i2.classList.remove('fas')
        i2.classList.add('far')
        i2.classList.remove('yellow-color')
        string = 'unsaveNews'
    } else {
        i1.classList.add('fas')
        i1.classList.remove('far')
        i1.classList.add('yellow-color')
        i2.classList.add('fas')
        i2.classList.remove('far')
        i2.classList.add('yellow-color')
        string = 'saveNews'
    }
        let n = 0
        let array 
        if(publicArticleArray !== null && publicArticleArray !== undefined && publicArticleArray.length !== 0) {
            for(let i = 0; i < publicArticleArray.length; i++) {
                if(element.parentElement.parentElement.parentElement.parentElement.classList[1].includes(i)) n = i
            }
            array = JSON.stringify([publicArticleArray[n].title])    
        } else array = JSON.stringify([element.parentElement.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.innerHTML.trim()])
        const res2 =  await fetch(`${locationOrganiser}include/update.inc.php`, {                          
            method: "POST", 
            body: createFormData(string, array)
        })
        const data2 = await res2.text()
        console.log(data2)
}
async function manageNews() {
    const res =  await fetch(`${locationOrganiser}include/check.inc.php`, {                          
        method: "POST", 
        body: createFormData('isIdSet', '')
    })
    const data = await res.text()
    return data;
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

function manageArticleText(element,c) {
    if(document.querySelector('.'+c).classList.contains('disable')) {
        document.querySelector('.'+c).classList.remove('disable')
        element.classList.add('r180')
    } 
    else {
        document.querySelector('.'+c).classList.add('disable')
        element.classList.remove('r180')
    }
}

async function checkIfUserIsLoggedIn() {
    const res =  await fetch(`${locationOrganiser}include/check.inc.php`, {                          
        method: "POST", 
        body: createFormData('isIdSet', '')
    })
    const data = await res.text()
    return data;
}

async function showTrendingOptions(element) {
    let keyword
    if(element.parentElement.parentElement.classList.contains('trending')) {
        keyword = 'trendingOut'
        document.querySelector('section.all article').appendChild(element)
    } else if(element.parentElement.parentElement.classList.contains('all')) {
        document.querySelector('section.trending article').appendChild(element)
        keyword = 'trendingIn'
    } else location.reload()
    if(!element.querySelector('.id').innerHTML) location.reload()
    const res =  await fetch('../include/update.inc.php', {                          
        method: "POST", 
        body: createFormData(keyword, element.querySelector('.id').innerHTML)
    })
}
