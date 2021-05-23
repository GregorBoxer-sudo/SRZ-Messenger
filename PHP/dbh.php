<?php
    require 'session.php';
    //Enter here your own attributes
    $servername = "localhost";
    $dBUsername = "webUser";
    $dBPassword = "webUser";
    $dBName = "messenger";
    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
        echo "Connection failed: ".mysqli_connect_error();
    }
?>
