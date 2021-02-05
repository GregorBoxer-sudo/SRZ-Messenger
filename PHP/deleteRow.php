<?php
    require('session.php');
    if (isset($_POST['chatID'])) {
        require('../PHP/idGen.php');
        $guid = $_POST['chatID'];
        echo $guid;
        require('dbh.php');
        $guid = sha1($guid);
        $stmt = $conn->prepare("DELETE FROM chats WHERE ChatID = ?");
        $stmt->bind_param("s", $guid);
        $stmt->execute();
        $stmt->close();
    }
    session_destroy();
    echo "<script>window.location.href = '../choose.php';</script>";
?>