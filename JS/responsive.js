const responsiveVersion = {
    openMobileVersionNavBar() {
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
        sideBar.style.marginLeft = '-100%' 
        sideMenuCounter = 1
    },
    closeMobileVersionNavBar() {
        mainSearchIcon.classList.remove('disable')
        mainSearchBackLeftIcon.classList.add('disable')
        navigationBarLeft.classList.remove('disable')
        navigationBarRight.classList.remove('disable')
        navigationBarMiddle.style.gridColumn = '2/3'
        mainSearchFigure.style.gridColumn = '3/4'
        mainSearchBackLeftTooltiptext.classList.add('disable')
        mainSearchInput.style.display = 'none'
        extOptIcon.style.display = 'none'   
        navigationBar.style.gridTemplateColumns = '120px 1fr 85px'

    },
    defaultNaviagtionBar() {
        mainSearchIcon.classList.remove('disable')
        mainSearchBackLeftIcon.classList.add('disable')
        navigationBarLeft.classList.remove('disable')
        navigationBarRight.classList.remove('disable')
        navigationBar.style.gridTemplateColumns = '1fr 730px 1fr'
        mainSearchInput.style.display = 'grid'
        extOptIcon.style.display = 'grid'
        mainSearchFigure.style.gridColumn = '1/2'
    },
    smallScreen457() {
        if(window.innerWidth < 510) {
            // document.querySelectorAll('.article-container .main-header .buttons .white-button span')[0].innerHTML = ''
            // document.querySelectorAll('.article-container .main-header .buttons .white-button span')[1].innerHTML = ''
        } else {
            // document.querySelectorAll('.article-container .main-header .buttons .white-button span')[0].innerHTML = 'Following'
            // document.querySelectorAll('.article-container .main-header .buttons .white-button span')[1].innerHTML = 'Share'
        }
    }

}

function windowWidthSettings() {
    if(window.innerWidth > 964) {
        responsiveVersion.defaultNaviagtionBar()
    } else {
        if(!suggestMainInput.classList.contains('disable') || !extraSearchOptions.classList.contains('disable')) {
            hideSuggestWords()
            hideExtraSearchOptions()
        }
        responsiveVersion.closeMobileVersionNavBar()
    }
    if(checkIfCategoriesAreOpen() === true) responsiveVersion.smallScreen457()

}
