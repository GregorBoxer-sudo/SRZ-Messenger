<?php
//require('session.php');
if (isset($_POST['TextField']) && isset($_POST['chatID']) && isset($_POST['user'])) {
    $userID = $_POST['user'];
    if ($userID == "1" || $userID == "0") {
        $msg = $_POST['TextField'];
        $zip = new ZipArchive();
        $dir = dirname(dirname(__FILE__));
        $path = $dir . "/FILESYSTEM-Messages/" . sha1($_POST['chatID']) . "/";
        $filename = Strval(time()) . $_POST["user"] . '.pim';
        echo 'USER: ' . $_POST['user'];
        echo $path . $filename . '<br>';
        // Ordner erstellen wenn noch nicht vorhanden
        if (!is_dir($path)) {
            mkdir($path, 0777, true) || chmod($folderPath, 0777);
            echo "Directory established: " . $path . PHP_EOL;
        };
        //ZIP erstellen, verschlüsseln, befüllen
        if ($zip->open($path . $filename, ZipArchive::CREATE)) {
            $zip->setPassword($_POST['chatID']); // UUID
            //when text
            $zip->addFromString("msg.txt", $msg, ZipArchive::FL_ENC_UTF_8); //only php 7 +
            $zip->setEncryptionName("msg.txt", ZipArchive::EM_AES_256); //only php 7.2 +
            //TODO pics, files...
            $zip->close();

            print("msg.txt hinzugefügt " . PHP_EOL);
        } else {
            exit("cannot open <$filename>\n");
        }
    } else echo "Übergebene UserID ({$userID}) ist nicht identifizierbar";
} else {
    print("Übergebene parameter sind unvollständig" . PHP_EOL);
}
