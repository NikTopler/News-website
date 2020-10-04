<nav class="navigation-bar grid align-center fixed active" id="navigation-bar">

    <div class="nav-left-side flex align-center" id="navigation-bar-left">
        <figure class="menu-icon flex relative align-center justify-center border-radius-50 pointer"
            onclick="manageSideMenu()" id="menu-burger-button">
            <div class="menu-burger-icon">
            </div>
        </figure>
        <a href="#" onclick="openLinks('headlines.php')" class="logo">Fews</a>
    </div>

    <div class="nav-search flex align-center justify-center relative" id="navigation-bar-middle">
        <div class="main-search-bar-input-div grid" id="main-search-bar-input-div">
            <input type="text" class="main-search-input" id="main-search-input"
                placeholder="Search for latest news articles" autocomplete="off" value="">
            <figure class="search-icon-figure flex align-center justify-center relative" id="search-icon-figure">
                <a href="#" class="search-icon flex align-center justify-center border-radius-50" id="main-search-icon-a">
                    <i class="far fa-search" id="main-search-icon"></i>
                    <i class="far fa-arrow-left back-icon disable" id="main-search-icon-back-left"></i>
                </a>
                <span class="tooltiptext tooltiptextTop120 disable" id="main-search-back-left-tooltiptext">
                    Close Search
                </span>
            </figure>
            <i class="extra-option-icon option-icon-search-bar flex align-center justify-center pointer"
                id="option-icon-search-bar" onclick="manageExtraSearchOptions()"></i>
        </div>

        <aside class="extra-search-options extra-search grid absolute disable" id="extra-search-options">
            <dt class="extra-option-dt1 flex align-center">Narrow your search results</dt>

            <div class="grid extra-search-options-div">
                <label class="extra-option-label1">Exact Phrase</label>
                <input type="text" class="extra-option-input1" id="extra-option-input1" onchange="">
                <span class="underline-input-animation"></span>
            </div>
            <div class="grid extra-search-options-div">
                <label class="extra-option-label2">Has words</label>
                <input type="text" class="extra-option-input2" id="extra-option-input2" onchange="">
                <span class="underline-input-animation"></span>
            </div>
            <div class="grid extra-search-options-div">
                <label class="extra-option-label3">Exclude Words</label>
                <input type="text" class="extra-option-input3" id="extra-option-input3" onchange="">
                <span class="underline-input-animation"></span>
            </div>

            <div class="grid relative">
                <label class="extra-option-label4">Date</label>

                <div class="select-div" onclick="manageTimeOptionSelect()">
                    <label id="index-time-label">Anytime</label>
                    <i class="option-icon-select flex align-center justify-center absolute"></i>
                    <aside class="select-options time-select absolute disable" id="index-time-select">
                        <div onclick="selectValue(this)">Anytime</div>
                        <div onclick="selectValue(this)">Today</div>
                        <div onclick="selectValue(this)">Yesterday</div>
                        <div onclick="selectValue(this)">Last week</div>
                    </aside>
                </div>
            </div>

            <footer class="extra-option-button-div flex align-center">
                <button class="extra-option-btn ext-opt-reset pointer" id="extraOptionsClearButton"
                    onclick="resetExtraSearchOptions()">Clear</button>
                <button class="extra-option-btn ext-opt-submit-disable pointer" id="extraOptionsSearchButton"
                    onclick="mainSearch('extra')">Search</button>
            </footer>
        </aside>
        <aside class="search-words absolute disable" id="search-words" onmouseover="suggest.mouseSuggestHoverChange(true)" onmouseout="suggest.mouseSuggestHoverChange(false)">
            <hr class="absolute">
        </aside>
    </div>

    <?php include 'navigation-bar-right.php' ?>

</nav>