<?php
    require 'session.php';
    $servername = "localhost";
    $dBUsername = "tom";
    $dBPassword = "123456";
    $dBName = "db_m";
    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
        echo "Connection failed: ".mysqli_connect_error();
}