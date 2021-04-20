<?php
if (isset($_POST['chatID'])) {
    $path = "../FILESYSTEM-Messages/".sha1($_POST['chatID'])."/";
    $files = scandir($path, SCANDIR_SORT_DESCENDING); // neustes file zuerst? TODO check nach mehr?
    $zip = new ZipArchive();

    $ZIP_ERROR = [
        ZipArchive::ER_EXISTS => 'File already exists.',
        ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
        ZipArchive::ER_INVAL => 'Invalid argument.',
        ZipArchive::ER_MEMORY => 'Malloc failure.',
        ZipArchive::ER_NOENT => 'No such file.',
        ZipArchive::ER_NOZIP => 'Not a zip archive.',
        ZipArchive::ER_OPEN => "Can't open file.",
        ZipArchive::ER_READ => 'Read error.',
        ZipArchive::ER_SEEK => 'Seek error.',
    ];

    foreach($files as $file) {
        if ($file != '.' && $file != '..') {
//                echo $path . $file;
//                echo '<br>';
                $result = $zip->open($path . $file);
                if ($result !== true) {
                    $ans = $ZIP_ERROR[$result] ?? 'Unknown error.';
                    echo $path . $file.'<br>';
                    die ($ans);
                }
                $zip->setPassword($_POST['chatID']);
                $msg = $zip->getFromName("msg.txt");
                echo $msg.'<br>';
                // TODO wenn abgerufen, check nutzer -> lesebestätigung!, löschen wenn anderer Nutzer
            }
        }
    $zip->close();
}else{
    echo 'KEINE CHAT-ID gefunden';
}
