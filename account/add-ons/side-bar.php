<aside class="side-bar disable" id="side-bar-account">
    <div class="flex">
        <div class="side-bar-container" id="side-bar-container">
            <div>
                <div class="side-bar-content" id="side-bar-content">
                    <div class="sidebar-category <?php if(strpos($_SERVER['REQUEST_URI'], 'home')) echo 'active'; ?>" onclick="openLinks('/account/home.php')">
                        <div class="icon"><i class="fas fa-user-circle fa-lg"></i></div>
                        <div><a href="#">Home</a></div>
                    </div>
                    <div class="sidebar-category <?php if(strpos($_SERVER['REQUEST_URI'], 'personal')) echo 'active'; ?>" onclick="openLinks('/account/personal.php')">
                        <div class="icon"><i class="far fa-id-card-alt fa-lg"></i></div>
                        <div><a href="#">Personal Information</a></div>
                    </div>
                    <?php 
                        if($_SESSION['admin'] != 'no') 
                        $admin = '';
                        $trending = '';
                        if(strpos($_SERVER['REQUEST_URI'], 'admin')) $admin =  'active';
                        if(strpos($_SERVER['REQUEST_URI'], 'trending')) $trending =  'active';

                            echo '<div class="sidebar-category '.$admin.'" onclick="openLinks(\'/account/admin.php\')">
                                        <div class="icon"><i class="fas fa-users-crown fa-lg"></i></div>
                                        <div><a href="#" class="side-menu-categories">Admin</a></div>
                                    </div>
                                    <div class="sidebar-category '.$trending.'" onclick="openLinks(\'/account/trending.php\')">
                                        <div class="icon"><i class="far fa-chart-line fa-lg"></i></div>
                                        <div><a href="#" class="side-menu-categories">Trending Section</a></div>
                                    </div>';
                    ?>
                    <div class="sidebar-category <?php if(strpos($_SERVER['REQUEST_URI'], 'settings')) echo 'active'; ?>" onclick="openLinks('/account/settings.php')">
                        <div class="icon"><i class="fas fa-user-cog fa-lg"></i></div>
                        <div><a href="#" class="side-menu-categories">Settings</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<div class="side-bar-responsive disable">
    <div class="slide">
        <ul class="res-container">
            <li class="content-container" onclick="openLinks('/account/home.php')">
                <div>
                    <div class="<?php if(strpos($_SERVER['REQUEST_URI'], 'home')) echo 'active'; ?>"></div>
                    <span class="<?php if(strpos($_SERVER['REQUEST_URI'], 'home')) echo 'active'; ?>">Home</span>
                </div>
            </li>
            <li class="content-container" onclick="openLinks('/account/personal.php')">
                <div>
                    <div class="<?php if(strpos($_SERVER['REQUEST_URI'], 'personal')) echo 'active'; ?>"></div>
                    <span class="<?php if(strpos($_SERVER['REQUEST_URI'], 'personal')) echo 'active'; ?>">Personal Info</span>
                </div>
            </li>
            <?php 
            
                if($_SESSION['admin'] != 'no') 
                $admin = '';
                $trending = '';
                if(strpos($_SERVER['REQUEST_URI'], 'admin')) $admin =  'active';
                if(strpos($_SERVER['REQUEST_URI'], 'trending')) $trending =  'active';

                    echo '  <li class="content-container" onclick="openLinks(\'/account/admin.php\')">
                                <div>
                                    <div class="'.$admin.'"></div>
                                    <span class="'.$admin.'">Admin</span>
                                </div>
                            </li>
                            <li class="content-container" onclick="openLinks(\'/account/trending.php\')">
                                <div>
                                    <div class="'.$trending.'"></div>
                                    <span class="'.$trending.'">Trending</span>
                                </div>
                             </li>';
            
            ?>
          
            <li class="content-container" onclick="openLinks('/account/settings.php')">
                <div>
                    <div class="<?php if(strpos($_SERVER['REQUEST_URI'], 'settings')) echo 'active'; ?>"></div>
                    <span class="<?php if(strpos($_SERVER['REQUEST_URI'], 'settings')) echo 'active'; ?>">Settings</span>
                </div>
            </li>
        </ul>
    </div>
</div>