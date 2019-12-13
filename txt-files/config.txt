<?php
// Database connection
$host = "sis-teach-01.sis.pitt.edu";
$port = 3306;
$socket = "";
$user = "alv44";
$password = "4029499";
$dbname = "alv44";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
