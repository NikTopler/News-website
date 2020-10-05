<div class="main-img-container disable" id="main-img-container">
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
        <section class="insert-photo-container" id="insert-photo-container">
            <div class="main-insert-photo-container">
                <div class="img-text">
                    <p>Click on grey area and add image</p>
                </div>                        
                <div><span class="error-span-upload-image red-color" id="error-span-upload-image"></span></div>

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
                        <div class="name"><span class="image-name-label" id="image-name-label">Ime</span></div>
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
    <div class="x" onclick="showProfileImg()" >
        <div>
            <i class="fal fa-times x-icon fa-lg"aria-hidden="true"></i>  
        </div> 
    </div>
</div>
