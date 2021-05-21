<?php
    function delMessages($dir){
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
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
        //Löschen Nachrichten
        if (is_dir("../FILESYSTEM-Messages/" . sha1($_POST['chatID']) . "/")) {
            delMessages("../FILESYSTEM-Messages/" . sha1($_POST['chatID']) . "/");
        }
    }
    session_destroy();
    if (isset($_POST['reload'])) {
        echo "<script>window.location.href = '../chat-owner/dashboard-owner.php';</script>";
    } else {
        echo "<script>window.location.href = '../index.php';</script>";
    }
?>