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
                            Set your gender
                        </h1>
                    </div>
                    <div class="text">
                        <p>
                            Select your gender
                        </p>
                    </div>
                </section>
                <article>
                    <div class="gender-container">
                        <aside class="radio-button-container grid">

                            <figure class="radio-button flex align-center justify-center <?php if($_SESSION['gender'] == 'Male') echo 'active'; else echo 'not-active'?>"  onclick="setGender(this)">
                                <div class="radio-button-border flex align-center justify-center pointer <?php if($_SESSION['gender'] == 'Male') echo 'active'; else echo 'not-active'?>">
                                    <div class="radio-button-center <?php if($_SESSION['gender'] == 'Male') echo 'active'; else echo 'not-active'?>"></div>
                                </div>
                            </figure>
                            <p>Male</p>
                        </aside>
                        <aside class="radio-button-container grid">
                            <figure class="radio-button flex align-center justify-center <?php if($_SESSION['gender'] == 'Female') echo 'active'; else echo 'not-active'?>" onclick="setGender(this)">
                                <div class="radio-button-border flex align-center justify-center pointer <?php if($_SESSION['gender'] == 'Female') echo 'active'; else echo 'not-active'?>">
                                    <div class="radio-button-center <?php if($_SESSION['gender'] == 'Female') echo 'active'; else echo 'not-active'?>"></div>
                                </div>
                            </figure>
                            <p>Female</p>
                        </aside>
                        <aside class="radio-button-container grid">
                            <figure class="radio-button flex align-center justify-center <?php if($_SESSION['gender'] == 'Prefer not to say') echo 'active'; else echo 'not-active'?>" onclick="setGender(this)">
                                <div class="radio-button-border flex align-center justify-center pointer <?php if($_SESSION['gender'] == 'Prefer not to say') echo 'active'; else echo 'not-active'?>">
                                    <div class="radio-button-center <?php if($_SESSION['gender'] == 'Prefer not to say') echo 'active'; else echo 'not-active'?>"></div>
                                </div>
                            </figure>
                            <p>Prefer not to say</p>
                        </aside>
                    </div>
                    <div class="error gender disable">
                            <div class="red"></div>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="personal.php">Back</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="check.gender()">Next</div>
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