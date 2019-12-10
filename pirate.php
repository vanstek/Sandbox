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
    <title>Pirate</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/png" href="/img/pirate.ico" />
    <!-- bootstrap and fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4067afb655.js" crossorigin="anonymous"></script>
    <!-- annyang -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.1/annyang.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- pirate! -->
    <script src="./js/piratify.js">
    </script>
    <script src="./js/voice-piratify.js"></script>


</head>

<body>
    <div class="container-fluid h-100">
        <div class="container-fluid h-100">
            <div class="row pt-md-0 pt-5">
                <div class="home-link col-2"><a class="home-link" href="index.php">Voicebox</a></div>
                <div class="game-header col-8 .game-header">
                    Piratifier
                    <img class="pirate-img" src="./img/flag.png">
                </div>
                <div class="col-2">
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
                    ?></div>
            </div>

            <div class="row justify-content-center align-items-center pt-5">

                <div class="col-6 ">
                    <div class="row mt-5 p-3 game h-100 pirate-game">
                        <div class="col-lg-6 col-12 justify-content-center" class="pirate-input">
                            <textarea id="pirate-input" class="pirate-textarea">Type your text in here, or record your voice with the record button.
                            </textarea>
                        </div>
                        <div class="pirate-output col-lg-6 col-12 d-flex flex-column">

                            <button class="btn record" onclick="record()">Record</button>
                            <button class="btn translate" onclick="toPirate()">Translate</button>
                            <div id="output"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>


    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        var parent = $('.game'),
            child = parent.children('.pirate-output');
        if (child.height() > parent.height()) {
            parent.height(child.height());
        }
    </script>

</body>

</html>