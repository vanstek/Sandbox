<!-- sends scores to database if logged in-->
<?php
session_start();
include('config.php');

if (!empty($_SESSION['username'])) {
    // adds text with username
    $playername = mysqli_real_escape_string($con, $_SESSION['username']);
    $pirate_text = mysqli_real_escape_string($con, $_POST['pirate_text']);
    $sql = "INSERT INTO pirate(pirate_text, playername)
    VALUES('$pirate_text', '$playername')";
    if ($con->query($sql) === TRUE) {
        echo "Page saved!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    // adds text without username
    $pirate_text = mysqli_real_escape_string($con, $_POST['pirate_text']);
    $sql = "INSERT INTO pirate(pirate_text)
    VALUES('$pirate_text')";
    if ($con->query($sql) === TRUE) {
        echo "Page saved!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
