<?php
if (isset($_POST['chatID'])) {
    $zip = new ZipArchive();
    $path = "../FILESYSTEM-Messages/".sha1($_POST['chatID'])."/";
    $files = scandir($path, SCANDIR_SORT_DESCENDING);
    $newestFile = $files[0];
    if (isset($newestFile)) {
        $openedZip = $zip->open($path . $newestFile);
        if ($openedZip) {
            $zip->setPassword($_POST['chatID']);
            $msg = $zip->getFromName("msg.txt");
            echo $msg;
            // TODO wenn abgerufen, check nutzer -> lesebestätigung!, löschen wenn anderer Nutzer
        } else {
            echo 'Couldnt open zip at ' . $path . $newestFile;
        }
    }else{
        echo 'no file in directory';
    }

}
