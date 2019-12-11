<?php
session_start();
include('config.php');

//redirects to index if already logged in
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$error = '';

//checks for empty form
if (
    !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    //sets username and password to form post input
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    //creates new user
    $sql = 'INSERT INTO players(username, password)
    VALUES("' . mysqli_real_escape_string($con, $myusername) . '",
            "' . mysqli_real_escape_string($con, $mypassword) . '")';


    // if successful go to sign and print "success"
    if (!mysqli_query($con, $sql)) {
        $error = '<div class="alert alert-danger" role="alert">Username taken</div>';
    } else {
        $con->close();
        header("location: login.php?success=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="container d-flex justify-content-center flex-column align-items-center h-100">

        <div class="row pt-md-0 pt-5 pb-4">
            <div class="login-jumbo"><a href="index.php">Voicebox</a></div>
        </div>
        <h3 class="mb-4 ">Register your account</h3>
        <div class="login-box mb-5 p-3 pt-5">

            <form class="d-flex justify-content-center flex-column align-items-center" role="form" action="register.php" method="post">
                <?php echo $error; ?>
                <span class='login-tag'>Username</span>
                <input class="m-2" type="text" name="username" placeholder="Username" required autofocus>
                <span class='login-tag'>Password</span>
                <input class="m-2" type="password" name="password" placeholder="Password" required>
                <button class="m-3" type="submit" name="register">Register</button>
            </form>
        </div>
        <div class="p-5"></div>
        <div class="p-5"></div>
        <div class="p-5"></div>
        <div class="p-5"></div>
    </div>


    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>