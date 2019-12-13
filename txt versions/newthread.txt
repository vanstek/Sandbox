<!--php code to check for logged in session-->
<?php
session_start();

// if (!isset($_SESSION['username'])) {
//     echo 'You must log in to visit this page. Returning to log in page.';
//     header('Refresh: 3; URL = login.php');
//     exit();
// }
include('config.php');

$image = '';
$board = '';
$error = 0;
if (htmlspecialchars($_GET["board_id"]) == 1) {
    $board = 'Eyesight Test Messageboard';
    $image = 'img\penguinglasses.gif';
} else if (htmlspecialchars($_GET["board_id"]) == 2) {
    $board = 'Pirate TTS Messageboard';
    $image = 'img\pirate.gif';
} else if (htmlspecialchars($_GET["board_id"]) == 3) {
    $board = 'Off-topic Messageboard';
    $image = 'img\random.gif';
} else {
    $error = 1;
}


//newthread sql insert

if (isset($_POST['title'])) {
    //sets SQL insert variables
    $username = htmlspecialchars($_SESSION['username']);
    $title =  htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['text']);;


    //thread SQL insert
    $sql = 'INSERT INTO ideas(board, username, title, date)
        VALUES("' . mysqli_real_escape_string($con, $board) . '",
                "' . mysqli_real_escape_string($con, $_SESSION['username']) .
        '", "' . mysqli_real_escape_string($con, $_POST['title']) .
        '", NOW())';

    //checks for sql insert error, exits if there is one
    if (!mysqli_query($con, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con) . "<br><br>";
        exit();
    }
    $thread_ID = mysqli_insert_id($con);
    $sql = 'INSERT INTO replies(idea_id, playername, body, date)
    VALUES(' . mysqli_real_escape_string($con, $thread_ID) . ',
            "' . mysqli_real_escape_string($con, $_SESSION['username']) .
        '", "' . mysqli_real_escape_string($con, $body) .
        '", NOW())';

    //checks for sql insert error, exits if there is one
    if (!mysqli_query($con, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        exit();
    } else {
        header('Location: ./thread.php?threadID=' . $thread_ID);
    }
}

$con->close();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $board ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img\cursor.ico" />
    <!-- bootstrap and fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4067afb655.js" crossorigin="anonymous"></script>


</head>

<body>

    <div class="container-fluid h-100">
        <div class="container-fluid h-100">
            <div class="row pt-md-0 pt-5">
                <div class="home-link col-2"><a class="home-link" href="index.php">Voicebox</a></div>
                <div class="game-header col-8 .game-header">Messageboards</div>
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
                    ?>

                </div>
            </div>
            <div class="container d-flex justify-content-center flex-column  p-5 w-75 align-items-center">
                <div class="container d-flex justify-content-center new flex-column my-5 w-50 align-items-center">
                    <div class="thread-form">
                        <h2>Create new <?php echo $board ?> thread</h2>
                        <form class="d-flex justify-content-center flex-column align-items-center w-100" role="form" action=<?php echo 'newthread.php?board_id=' . $_GET["board_id"]; ?> method="post">
                            <input class="my-3 w-75" type="text" name="title" placeholder="Thread title">
                            <textarea class="form-control w-100" name="text" placeholder="Optional text" rows="3"></textarea>
                            <input class="btn btn-primary mt-3" type="submit">
                        </form>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-around flex-row justify-content-around w-75">
                    <button class="mx-3 btn btn-primary" onclick="history.go(-1);">Back </button>
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
        <!-- tilt.js -->
        <script src="./js/tilt.jquery.js"></script>
        <script>
            $('.gamecard').tilt({
                scale: 1.05,
                perspective: 2750,

            });
        </script>

</body>

</html>