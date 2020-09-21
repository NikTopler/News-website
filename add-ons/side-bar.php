<aside class="side-bar absolute grid" id="side-bar">
        <div class="flex">
                <div class="side-bar-container" id="side-bar-container">
                        <div>
                                <div class="side-bar-content" id="side-bar-content">
                                        <div class="sidebar-category" onclick="createUrlPath('headlines')">
                                                <div class="icon"><i class="fal fa-newspaper fa-lg"></i></div>
                                                <div><a href="#">Top Stories</a></div>
                                        </div>
                                        <div class="sidebar-category" onclick="createUrlPath('for-you')">
                                                <div class="icon"><i class="fas fa-user-alt fa-lg"></i></div>
                                                <div><a href="#">For you</a></div>
                                        </div>
                                        <div class="sidebar-category" onclick="createUrlPath('following')">
                                                <div class="icon"><i class="fal fa-star fa-lg"></i></div>
                                                <div><a href="#" class="side-menu-categories">Following</a></div>
                                        </div>
                                        <div class="sidebar-category" onclick="createUrlPath('library')">
                                                <div class="icon"><i class="fas fa-bookmark fa-lg"></i></div>
                                                <div><a href="#" class="side-menu-categories">Saved news</a></div>
                                        </div>
                                        <div class="sidebar-line"><hr></div>
                                        <div class="sidebar-category" onclick="createUrlPath('covid-19')">
                                                <div class="icon"><i class="fad fa-shield-cross fa-lg"></i></div>
                                                <div><a href="#" class="side-menu-categories">COVID-19</a></div>
                                        </div>
                                        <div class="sidebar-line"><hr></div>
                                        <div class="categories">
                                                <div class="sidebar-category" onclick="createUrlPath('world')">
                                                        <div class="icon"><i class="fad fa-globe-europe fa-lg"></i></div>
                                                        <div><a href="#" class="side-menu-categories">World</a></div>
                                                </div>
                                                <div class="sidebar-category" onclick="createUrlPath('business')">
                                                        <div class="icon"><i class="fad fa-building fa-lg"></i></div>
                                                        <div><a href="#" class="side-menu-categories">Business</a></div>
                                                </div>
                                                <div class="sidebar-category" onclick="createUrlPath('technology')">
                                                        <div class="icon"><i class="fad fa-microchip fa-lg"></i></div>
                                                        <div><a href="#" class="side-menu-categories">Technology</a></div>
                                                </div>
                                                <div class="sidebar-category" onclick="createUrlPath('entertainment')">
                                                        <div class="icon"><i class="fas fa-camera-movie"></i></div>
                                                        <div><a href="#" class="side-menu-categories">Entertainment</a></div>
                                                </div>
                                                <div class="sidebar-category" onclick="createUrlPath('sports')">
                                                        <div class="icon"><i class="fas fa-tennis-ball fa-lg"></i></div>
                                                        <div><a href="#" class="side-menu-categories">Sports</a></div>
                                                </div>
                                                <div class="sidebar-category" onclick="createUrlPath('health')">
                                                        <div class="icon"><i class="fas fa-heartbeat fa-lg"></i></div>
                                                        <div><a href="#" class="side-menu-categories">Health</a></div>
                                                </div>
                                        </div>
                                        <div class="sidebar-line"><hr></div>
                                        <div class="other">
                                                <div class="sidebar-category country" id="show-countries-button" onclick="showSelectCountry()"> 
                                                        <div class="sidebar-country-container grid">
                                                                <span>Language & Region</span> 
                                                                <strong id="country-name-side-menu"><?php echo 'United States' ?></strong> 
                                                        </div>
                                                </div>
                                                <div class="sidebar-category">
                                                        <div class="text"><a href="#" class="side-menu-categories" onclick="createUrlPath('sources')">Sources</a></div>
                                                </div>
                                                <div class="sidebar-category">
                                                        <div class="text"><a href="#" onclick="createUrlPath('settings')">Settings</a>
                                                        </div>
                                                </div>
                                                <div class="sidebar-category">
                                                        <div class="text"><a href="#" class="sidebar-help"
                                                                        onclick="createUrlPath('help')">Help</a></div>
                                                        <div><i class="far fa-external-link-alt fa-sm"></i></div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <footer>
                                <div class="about text"><a href="#" onclick="createUrlPath('about')">About</a></div>
                                <div><span class="flex align-center justify-center" style="color: var(--font-medium);">•</span></div>
                                <div class="text"><a href="https://newsapi.org/" target="_blank" id="news-api-link">News Api</a> </div>
                        </footer>
                </div>
        </div>
</aside>