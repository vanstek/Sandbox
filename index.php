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
    <title>Voicebox</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img\favicon.ico" />
    <!-- bootstrap and fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4067afb655.js" crossorigin="anonymous"></script>


</head>

<body>

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
    <div class="container-fluid h-100">
        <div class="row pt-md-0 pt-5">
            <div class="jumbo">Voicebox</div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-1"></div>
            <div class="col-lg-3 col-md-4 col-8">
                <div class="gamecard">
                    <a href="eyesight.php">
                        <h2>Eyesight Test</h2>
                    </a>
                    <a href="eyesight.php">
                        <img src="./img/eyesight.png" alt="game_image">
                    </a>
                    <div class="description">
                        Pit your eyeballs against other players! This game tests your vision with ever-shrinking words that you have to read. Rack up points and see if you can get on the leaderboards!
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-8">
                <div class="gamecard">
                    <a href="pirate.php">
                        <h2>Pirate TTS</h2>
                    </a>
                    <a href="pirate.php">
                        <img src="./img/piratifier.jpg" alt="game_image">
                    </a>
                    <div class="description">
                        This is an application that records your voice, turns it into pirate-talk, and speaks it back to you.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-8">
                <div class="gamecard">
                    <a href="messageboard.php">
                        <h2>Message Boards</h2>
                    </a>
                    <a href="messageboard.php">
                        <img src="./img/flamecursor.png" alt="game_image">
                    </a>
                    <div class="description">
                        Come hang out and say what's on your mind! Add to the conversation or create your own topics!
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <div class="row p-3">
            <!-- spacing for tilt.js to move -->
        </div>
    </div>



    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- tilt.js -->
    <script src="./js/tilt.jquery.js">

    </script>
    <script>
        $('.gamecard').tilt({
            scale: 1.05,
            perspective: 2750,

        });
    </script>
</body>

</html>