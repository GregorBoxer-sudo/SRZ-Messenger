<?php
require 'session.php';
$servername = "localhost";
$dBUsername = "User";
$dBPassword = "Password";
$dBName = "messenger";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
    echo "Connection failed: ".mysqli_connect_error();
}