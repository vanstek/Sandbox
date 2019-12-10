<!--php code to check for logged in session-->
<?php
session_start();

// if (!isset($_SESSION['username'])) {
//     echo 'You must log in to visit this page. Returning to log in page.';
//     header('Refresh: 3; URL = login.php');
//     exit();
// }

include('config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eyesight Checker</title>
    <link rel="shortcut icon" type="image/png" href="img\glasses.ico" />
    <!-- bootstrap and fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4067afb655.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Annyang voice recognition script -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.1/annyang.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- randomwords generator https://github.com/punkave/random-words-->
    <script src="./js/randomWords.js"></script>
    <!-- game script -->
    <script src="./js/eyesight.js"></script>




</head>

<body>

    <div class="container-fluid h-100">
        <div class="container-fluid h-100">
            <div class="row pt-md-0 pt-5">
                <div class="home-link col-4"><a class="home-link" href="index.php">Voicebox</a></div>
                <div class="game-header col-4 .game-header">Eyesight Test
                    <img src="./img/glasses.svg">
                </div>
                <div class="col-4">
                    <!-- prints login/out button-->
                    <?php
                    if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
                        echo  "<button class='loginbutton' onClick=\"location.href='./login.php';\">
                        <span>Log in</span>
                    </button>";
                    } else if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                        echo  "<button class='loginbutton' onClick=\"location.href='./logout.php';\">
                        <span>Log out</span>
                    </button>";
                    }
                    ?>

                </div>
            </div>
            <div class=" row justify-content-center align-items-center">

                <div class="col-12">
                    <div class="game eyesight-game" id="eyeball">
                        <div class="eyesight-description" id="eyesight_desc">Welcome to the Eyesight Test. This test is not endorsed by doctors, and you should not use this to come to any scientific or physiological conclusions about yourself.<br><br>
                            <b> Instructions:</b> <br>The game is simple. 3 random word will be displayed on screen.. It is your duty to recite those words at a distance of ~10 feet. Make sure you have allowed
                            the website to access your microphone, or else it won't work. Every time you recite the words correctly, the text will get smaller, and you will go again. Every correct answer is a point, and you get five strikes until you lose.
                            The text is ~3.75, inches tall, but varies with the PPI of your monitor. Also, if there are some words that could be homophones, feel free to say "skip" to generate new words. <br><br>Best of luck!
                            <br><br>
                            <center><button id="startButton" class="btn btn-light" onclick="startEyesight()">Start game</button></center>

                        </div>
                        <div class="eyesight-string" id="eyesight-string"></div>
                        <div class="eyesight-counter" id="eyesight-counter">
                            <div class="eyesight-lives" id="eyesight-lives">
                                <img alt="skull icon" id="skull1" src="./img/skull.png">
                                <img alt="skull icon" id="skull2" src="./img/skull.png">
                                <img alt="skull icon" id="skull3" src="./img/skull.png">
                                <img alt="skull icon" id="skull4" src="./img/skull.png">
                                <img alt="skull icon" id="skull5" src="./img/skull.png">
                            </div>
                            <div class="eyesight-score">
                                <p>Points</p>
                                <div id="eyesight-score">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid h-25">
    </div>



    <!-- bootstrap js -->
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- tilt.js -->
    <script src="./js/tilt.jquery.js">
    </script>


</body>

</html>