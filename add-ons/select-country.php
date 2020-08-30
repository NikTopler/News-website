    <div class="select-country absolute fixed grid" id="select-country">
        <header>
            <h3>Region of interest</h3>
            <h4>See latest news based on region</h4>
        </header>

        <div class="country-search-input-div grid align-center justify-center">
            <input type="text" placeholder="Search for country" id="search-country-input">
            <figure class="search-icon-country flex align-center justify-center default-pointer">
                <i class="far fa-search"></i>
            </figure>
        </div>
        <h6 class="blue-link flex align-center">Suggested</h6>
        <div id="suggest-country">
        </div>

        <h6 class="blue-link flex align-center">All available regions</h6>

        <div class="list-of-countries" id="list-of-countries">
        </div>

        <footer class="flex align-center">
            <button class="blue-link pointer" onclick="hideSelectCountry()">Cancel</button>
            <button class="blue-link pointer" onclick="updateCountrySelect(document.querySelector('.radio-button-container > .active').parentElement.lastElementChild.innerHTML)">Update</button>
        </footer>
        <figure class="x-icon absolute flex align-center justify-center border-radius-50"
            onclick="hideSelectCountry()">
            <i class="fal fa-times fa-lg pointer"></i>
        </figure>
    </div>