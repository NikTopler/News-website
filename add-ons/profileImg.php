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
        <section class="insert-photo-container" id="insert-photo-container" onclick="openFolder()">
            <div class="main-insert-photo-container">
                <div class="img-text">
                    <p>Click on grey area and add image</p>
                </div>
                <div class="select-img">
                    <div class="icon">
                        <i class="fab fa-dropbox"></i>
                    </div>
                </div>
                <div class="footer">
                    <div class="file-name">
                        <span></span>
                    </div>
                    <div class="button">
                        <div>
                            Upload
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="color-img">
        <div class="img-text">
            <p>Select image from your computer or type in a link</p>
        </div>
    </section>
    <div class="x" onclick="showProfileImg()" >
        <div>
            <i class="fal fa-times x-icon fa-lg"aria-hidden="true"></i>  
        </div> 
    </div>
</div>
