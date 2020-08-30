        <aside class="side-bar absolute">
            <div class="side-bar-content grid fixed" id="side-bar-content">
                <a href="#" class="side-menu-categories" onclick="createUrlPath('headlines')"><i
                        class="fal fa-newspaper fa-lg"></i>Top Stories</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('forYou')"><i
                        class="fas fa-user-alt fa-lg"></i>For you</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('following')"><i
                        class="fal fa-star fa-lg"></i>Following</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('library')"><i
                        class="fas fa-bookmark fa-lg"></i>Saved news</a>
                <hr>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('covid19')"><i
                        class="fad fa-shield-cross fa-lg"></i>COVID-19</a>
                <hr>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('world')"><i
                        class="fad fa-globe-europe fa-lg"></i>World</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('business')"><i
                        class="fad fa-building fa-lg"></i>Business</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('technology')"><i
                        class="fad fa-microchip fa-lg"></i>Technology</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('entertainment')"><i
                        class="fas fa-camera-movie" ></i>Entertainment</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('sports')"><i
                        class="fas fa-tennis-ball fa-lg"></i>Sports</a>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('health')"><i
                        class="fas fa-heartbeat fa-lg"></i>Health</a>
                <hr>
                <div class="language extra-side-menu pointer" id="show-countries-button"
                    onclick="showSelectCountry()">
                    <span>Language & Region</span>
                    <strong id="country-name-side-menu">United States</strong>
                </div>
                <a href="#" class="side-menu-categories" onclick="createUrlPath('sources')">Sources</a>
                <a href="#" onclick="createUrlPath('settings')">Settings</a>
                <a href="#" class="sidebar-help" onclick="createUrlPath('help')">Help<i class="far fa-external-link-alt fa-sm"></i></a>
                <footer class="grid">
                    <div>
                        <a href="#" onclick="createUrlPath('about')">About</a>
                        <span class="flex align-center justify-center">•</span>
                        <a href="https://newsapi.org/" target="_blank" id="news-api-link">News API</a>
                    </div>
                </footer>
            </div>
            <div class="side-bar-content about-sidebar-content grid fixed" id="about-sidebar-content">
                <!-- <a href="#" class="active" onclick="sidebarCategorySelect(this)">About</a>
                <a href="#" class="" onclick="sidebarCategorySelect(this)">Terms of service</a> -->
            </div>
        </aside>