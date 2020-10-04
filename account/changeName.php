<?php include 'add-ons/head.php' ?>

<body>
    
    <nav class="account">
        <div class="left">
                <div class="container">
                    <div class="logo">
                        <a href="">Fews Account</a>
                    </div>
                </div>
        </div>
        <div class="right">
                <div class="main-container">
                    <?php include '../add-ons/navigation-bar-right.php' ?>
                </div>
        </div>
    </nav>

    <main>
        <div class="main-content change">
            <div class="container">
                <section class="header">
                    <div class="h1">
                        <h1>
                            Update your name
                        </h1>
                    </div>
                    <div class="text">
                        <p>
                           You can change both or one
                        </p>
                    </div>
                </section>
                <article>
                    <div class="name-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="name-input">First Name</label>
                            </div>
                            <input type="text" name="name" id="name-input" autocomplete="off" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name'] ?>">
                        </div>
                        <div class="error name disable">
                            <div class="red"></div>
                        </div>
                    </div>
                    <div class="surname-container">
                        <div class="input-container">
                            <div class="label-container">
                                <label for="surname-input">Last Name</label>
                            </div>
                            <input type="text" name="surname" id="surname-input" autocomplete="off" value="<?php if(isset($_SESSION['surname'])) echo $_SESSION['surname'] ?>">
                        </div>
                        <div class="error surname disable">
                            <div class="red"></div>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="personal.php">Back</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="check.name()">Next</div>
                        </div>
                    </div>
                </div>
                </article>
            </div>
        </div>
        </div>
    </main>

</body>
</html>