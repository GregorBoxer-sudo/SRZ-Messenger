<?php
//require('session.php');
if (isset($_POST['TextField'])&&isset($_POST['chatID'])) {
    $msg = $_POST['TextField'];
    $zip = new ZipArchive();
    $path = "../FILESYSTEM-Messages/".sha1($_POST['chatID'])."/";
    $filename = Strval(time()) . '.pim';
echo $path;
echo $filename;
    if (! is_dir($path)){
        mkdir($path);
        echo "Directory established: ".$path;
    };
    if ($zip->open($path.$filename, ZipArchive::CREATE)){
        $zip->setPassword($_POST['chatID']); // UUID
        //when text
        $zip->addFromString("msg.txt", $msg, ZipArchive::FL_ENC_UTF_8); //only php 7 +
        $zip->setEncryptionName("msg.txt", ZipArchive::EM_AES_256); //only php 7.2 +
        //TODO pics, files...

        print("msg.txt hinzugefügt ".PHP_EOL);
        $zip -> close();
    }else{
        exit("cannot open <$filename>\n");
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