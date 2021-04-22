<?php
if (isset($_POST['chatID']) && isset($_POST['user'])) {
    $dir = dirname(dirname(__FILE__));
    $path = $dir . "/FILESYSTEM-Messages/" . sha1($_POST['chatID']) . "/";
    $files = scandir($path, SCANDIR_SORT_DESCENDING); // neustes file zuerst? TODO check nach mehr?
    $zip = new ZipArchive();
    $userID = $_POST['user'];

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

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            //                echo $path . $file . '<br>';
            $result = $zip->open($path . $file);
            if ($result !== true) {
                $ans = $ZIP_ERROR[$result] ?? 'Unknown error.';
                echo $path . $file . '<br>';
                die($ans);
            }
            $zip->setPassword($_POST['chatID']);
            $msg = $zip->getFromName("msg.txt");
            if (isset($file[10]) && ($file[10] == "1" || $file[10] == "0")) {
                if ($userID == "1" || $userID == "0") {
                    if ($file[10] != $userID) {
                        // TODO löschen
                    }
                    echo 'User: ' . $file[10] . " send: " . $msg . "<br>";
                } else echo 'UserID aus Eingabe nicht identifiezierbar!' . PHP_EOL;
            } else echo "User: ? send: " . $msg . "<br>";
        }
    }
    $zip->close();
} else {
    echo 'KEINE CHAT-ID/UserID gefunden';
}
