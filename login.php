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
    isset($_POST['login']) && !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    //sets username and password to form post input
    $myusername = mysqli_real_escape_string($con, $_POST['username']);
    $mypassword = mysqli_real_escape_string($con, $_POST['password']);

    //creates database query for said user
    $sql = "SELECT user_ID FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($con, $sql);

    //if queried number of rows is 1, then input must match the database info
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        //if count = 1, session is initiated
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $myusername;
        $con->close();
        header("location: index.php");
        exit();
    } else {
        $error = '<div class="alert alert-danger" role="alert"> Wrong username or password</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in to Voicebox</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="container d-flex justify-content-center flex-column align-items-center h-100">

        <div class="row pt-md-0 pt-5 pb-4">
            <div class="login-jumbo"><a href="index.php">Voicebox</a></div>
        </div>
        <h3 class="mb-4 ">Sign in</h3>
        <div class="login-box mb-5 p-3 pt-5">

            <form class="d-flex justify-content-center flex-column align-items-center" role="form" action="login.php" method="post">
                <?php echo $error; ?>
                <span class='login-tag'>Username</span>
                <input class="m-2" type="text" name="username" placeholder="Username" required autofocus>
                <span class='login-tag'>Password</span>
                <input class="m-2" type="password" name="password" placeholder="Password" required>
                <button class="m-3" type="submit" name="login">Sign in</button>
            </form>
        </div>
        <div class="p-5"></div>
        <div class="p-5"></div>
        <div class="p-5"></div>
        <div class="p-5"></div>
    </div>

    <!-- logout button if session is started -->
    <?php
    if (isset($_SESSION['username'])) {
        echo '<div class="container d-flex justify-content-center p-4 flex-column my-5 align-items-center">
            <a class="m-5 btn btn-secondary" role="button" href="logout.php" title="Logout">Log out</a>
        </div>';
    }
    ?>
    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>