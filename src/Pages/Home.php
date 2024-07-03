<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.5/gsap.min.js"></script>

    <!-- Bootstrap -->
    <link href="./src/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="./src/js/bootstrapjs/bootstrap.bundle.min.js" type="text/javascript"></script>

    <!-- JQuery -->
    <script src="./src/js/jquery.min.js" type="text/javascript"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- myCSS -->
    <link rel="stylesheet" href="./src/css/style.css">
    <title>MyPage</title>
</head>

<body>

    <!-- Navigation Bar -->
    <header>
        <?php require "./src/Module/navBar.php" ?>
    </header>

    <!-- Main -->
    <main>

        <div id="particles-js">
            <div class="container">
                
                
                <div class="row">
                    <div class="tab-content" id="myTabContent">
                        <div class="one-half column tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row top">
                                <div class="Title">
                                    <h1>Mohamed Kharrat</h1>
                                    <h2>Computer Science Student</h2>
                                </div>
                            </div>
                            <?php require "./src/Module/student.php" ?>    
                        </div>

                        <div class="one-half column tab-pane fade show" id="games" role="tabpanel" aria-labelledby="games-tab">
                            <?php require "./src/Module/games.php" ?>
                        </div>

                        <div class="one-half column tab-pane fade show" id="web" role="tabpanel" aria-labelledby="web-tab">
                            fesfsefsefes
                        </div>

                        <div class="one-half column tab-pane fade show" id="miscellanious" role="tabpanel" aria-labelledby="miscellanious-tab">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <?php require "./src/Module/footer.php" ?>

    <!-- JS Scripts -->
    <script src="./src/js/fadein.js"></script>
    <script src="./src/js/particles/particles.js"></script>
    <script src="./src/js/particles/Portfolio.js"></script>
    <script src="./src/js/buttonslide.js"></script>
    

</body>

</html>