<!-- sends scores to database if logged in-->
<?php
session_start();
include('config.php');

if (!empty($_SESSION['username'])) {
    // adds score with username
    $playername = mysqli_real_escape_string($con, $_SESSION['username']);
    $value = mysqli_real_escape_string($con, $_POST['value']);
    $sql = "INSERT INTO scores(value, playername)
    VALUES('$value', '$playername')";
    if ($con->query($sql) === TRUE) {
        echo "Page saved!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
