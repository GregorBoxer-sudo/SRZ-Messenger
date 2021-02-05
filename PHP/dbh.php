<?php
require 'session.php';
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "felisfelis1X!";
$dBName = "messenger";
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
    echo "Connection failed: ".mysqli_connect_error();
}