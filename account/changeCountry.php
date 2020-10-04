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
                            Select your country
                        </h1>
                    </div>
                    <div class="text">
                        <p>
                            You will automaticly recive news articles from the country you select
                        </p>
                    </div>
                </section>
                <article>
                    <div class="country-container">
                        <div class="countries">
                        </div>
                    </div>
                    <div class="error country disable">
                        <div class="red"></div>
                    </div>
                    <div class="button-container">
                        <div class="inner-container">
                            <a href="personal.php">Back</a>
                        </div>
                        <div class="inner-container">
                            <div class="blue-button" onclick="check.country()">Next</div>
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