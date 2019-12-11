<!--php code to check for logged in session-->
<?php
session_start();

// if (!isset($_SESSION['username'])) {
//     echo 'You must log in to visit this page. Returning to log in page.';
//     header('Refresh: 3; URL = login.php');
//     exit();
// }
include('config.php');

//gets thread id from URL
$threadID = htmlspecialchars($_GET["threadID"]);
$sql = "SELECT COUNT(*)
FROM replies
WHERE idea_id = $threadID";
$result = $con->query($sql);

//$count is the number of posts for thread
$row = mysqli_fetch_row($result);
$count = $row[0];

//fetches rows of particular thread
$sql = "SELECT *
FROM replies
WHERE idea_id = $threadID";
$result = $con->query($sql);


$sql = "SELECT *
FROM ideas
WHERE idea_id = $threadID";
$rslt = $con->query($sql);
$thread = mysqli_fetch_assoc($rslt);
$title = $thread['title'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
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
            <div class="container d-flex justify-content-center flex-column mt-5 p-5 w-75 align-items-center">
                <h3 class="title">
                    <?php echo $title ?>
                </h3>
                <table class="table table-hover table-dark mt-2">
                    <col width="20%">
                    <col width="60%">
                    <col width="20%">
                    <thead class="thead-dark">
                        <tr>
                            <th>User</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // for loop to create new rows in table. 
                        // queries for number of posts in threadID
                        // posts  # queries sum of posts of same threadID


                        //keeps threads in array $threads
                        while ($replies = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                        <td>' . $replies['playername'] . '</td>
                        <td>' . $replies['body'] . '</td>
                        <td>' . $replies['date'] . '</td>
                        </tr>';
                        }

                        $con->close();
                        ?>
                    </tbody>
                </table>
                <div>
                    <button class="mx-3 btn btn-primary" onclick="history.go(-1);">Back </button>
                    <?php
                    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                        echo '
                    <a class="mx-3 btn btn-primary" role="button" href="reply.php?threadID=' . $_GET["threadID"] . '&title=' . $title . '" title="topics">Reply to this thread</a>';
                    }
                    ?></div>
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