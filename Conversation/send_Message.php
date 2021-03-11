<?php
//require('session.php');
if (isset($_POST['TextField'])&&isset($_POST['chatID'])) {
    $msg = $_POST['TextField'];
    $zip = new ZipArchive();
    $create = Strval(time()) . '.pim';

    if ($zip->open($create, ZipArchive::CREATE)){
        $zip->setPassword($_POST['chatID']); // UUID
        $zip->addFromString("msg.txt", $msg, ZipArchive::FL_ENC_UTF_8); //only php 7 +
        $zip->setEncryptionName("msg.txt", ZipArchive::EM_AES_256); //only php 7.2 +

        print("msg.txt hinzugefügt ".PHP_EOL);
        $zip -> close();
    }

}else{
    print("übergebene parameter sind ungültig".PHP_EOL);
}
//session_destroy();
//if (isset($_POST['reload'])) {
//    echo "<script>window.location.href = '../chat-owner/dashboard-owner.php';</script>";
//} else {
//    echo "<script>window.location.href = '../choose.php';</script>";
//}