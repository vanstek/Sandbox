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
            <div class="home-link col-2"><a class="home-link" href="index.php">Voicebox</a></div>
            <div class="game-header col-8 .game-header">Leaderboards</div>
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
        <div class="row justify-content-center px-md-5 mt-5">

            <div class="col-md-5 col-8">
                <table class="table table-hover table-dark mt-1">
                    <h1>
                        Eyesight Test
                    </h1>
                    <thead class="thead-dark">
                        <tr>
                            <col width="40%">
                            <col width="40%">
                            <col width="20%">
                            <th>Player</th>
                            <th>Score</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT playername, value, date
                                FROM scores ORDER BY value DESC LIMIT 50";
                        $result = $con->query($sql);
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td>';
                            echo $row['playername'];
                            echo '</td>';
                            echo '<td>';
                            echo $row['value'];
                            echo '</td>';
                            echo '<td>';
                            echo $row['date'];
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-md-5 col-8">
                <table class="table table-hover table-dark mt-1">
                    <h1>
                        Pirate TTS
                    </h1>
                    <thead class="thead-dark">
                        <tr>
                            <col width="20%">
                            <col width="80%">

                            <th>User</th>
                            <th>Text</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // selects last 50 translations
                        $sql = "SELECT pirate_text, playername, date
                                FROM pirate ORDER BY date DESC LIMIT 50";
                        $result = $con->query($sql);
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td>';
                            echo $row['playername'];
                            echo '</td>';
                            echo '<td>';
                            echo $row['pirate_text'];
                            echo '</td>';
                        }

                        $con->close();
                        ?>
                    </tbody>
                </table>
            </div>



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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>