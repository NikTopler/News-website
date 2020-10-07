<div class="main-img-container" id="main-img-container">
    <header>
        <h1>Change Profile Image</h1>
    </header>

    <section>
        <div class="img-text">
            <p>Select image from your computer or type in a link</p>
        </div>
        <div class="container">
            <div class="img medium add" onclick="manageInsertContainer()">
                <div>
                    <i class="fal fa-plus fa-lg"></i>
                </div>
            </div>  
            <div class="img medium add">
                <div>
                <i class="far fa-link"></i>
                </div>
            </div>  
        </div>
        <div class="container external" id="external-img-container">
            <?php 
                $path = '../';
                if(strpos($_SERVER['REQUEST_URI'], 'search') || strpos($_SERVER['REQUEST_URI'], 'headlines')) $path = '';

                $check = '<div class="check-mark"> <i class="far fa-check"></i></div>';
                    if(isset($_SESSION['profile_img']) && $_SESSION['profile_img'] != null) {
                        if($_SESSION['profile_choice'] == 0) $checkC = $check;
                        else $checkC = '';
                        echo '<div style="display:flex; align-items:center; justify-content:center; position:relative;" class="costum" onclick="selectImg(this)"> <img src="'.$path.$_SESSION['profile_img'].'"  alt="profile" class="img medium"> 
                                <span class="tooltiptext tooltiptextTop120">Costum Image</span>
                                '.$checkC.'
                            </div>';
                    }
                    if(isset($_SESSION['google_profile_img']) && $_SESSION['google_profile_img'] != null) {
                        if($_SESSION['profile_choice'] != 2) $checkG = '';
                        else $checkG = $check;
                        echo '<div style="display:flex; align-items:center; justify-content:center; position:relative;" class="google" onclick="selectImg(this)"> <img src="'.$_SESSION['google_profile_img'].'"  alt="profile" class="img medium"> 
                                <span class="tooltiptext tooltiptextTop120">Google Image</span>
                                '.$checkG.'
                            </div>';
                    }
                    if(isset($_SESSION['facebook_profile_img']) && $_SESSION['facebook_profile_img'] != null) {
                        if($_SESSION['profile_choice'] != 3) $checkF = '';
                        else $checkF = $check;
                        echo '<div style="display:flex; align-items:center; justify-content:center; position:relative;" class="facebook" onclick="selectImg(this)"> <img src="'.$_SESSION['facebook_profile_img'].'"  alt="profile" class="img medium add"> 
                                <span class="tooltiptext tooltiptextTop120">Facebook Image</span>
                                '.$checkF.'
                            </div>';
                    }
            ?>
        </div>
        <section class="insert-photo-container" id="insert-photo-container">
            <div class="main-insert-photo-container">
                <div class="img-text">
                    <p>Click on grey area and add image</p>
                </div>                        
                <div><span class="error red-color" id="error-span-upload-image"></span></div>

                <div class="select-img"  onclick="openFolder()">
                    <div class="icon">
                        <i class="fab fa-dropbox"></i>
                    </div>
                </div>
                <div class="footer">
                    <form action="include/uploadFile.inc.php" method="post" enctype="multipart/form-data" id="uploadProfileImageForm">
                        <input type="file" hidden="hidden" id="file-upload" name="file"  onChange='fileChange()'>
                    </form> 
                    <div class="footer disable">
                        <div class="name"><span class="image-name-label" id="image-name-label"></span></div>
                        <div class="button" onclick="submitProfileImageUploadForm()">
                            Submit
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="color-img">
        <div class="img-text">
            <p>Select a color you like</p>
        </div>
        <div class="color-container">
        </div>
    </section>
        <div class="footer-container">
            <div class="button" onclick="saveImg()">
                <div class="blue-button">Save</div>
            </div>
        </div>
    <div class="x" onclick="showProfileImg()" >
        <div>
            <i class="fal fa-times x-icon fa-lg"aria-hidden="true"></i>  
        </div> 
    </div>
</div>
