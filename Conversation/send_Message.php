<?php

$in = file_get_contents('php://input');
$decoded = json_decode($in, true);
$data = new stdClass();
$data->msg = 'PHP is working';
$data->user = $decoded['user'];
$data->chatID = $decoded['chatID'];
$data->message = $decoded['message'];
$stringForEcho = json_encode($data);

$chatID = $decoded['chatID'];
$user = $decoded['user'];
$message = $decoded['message'];

$response = new stdClass();

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return strval(round(((float)$usec + (float)$sec)*1000));
}

//require('session.php');
if (isset($message) && isset($chatID) && isset($user)) {
    if ($user == "1" || $user == "0") {
        $zip = new ZipArchive();
        $dir = dirname(dirname(__FILE__));
        $path = $dir . "/FILESYSTEM-Messages/" . sha1($chatID) . "/";
        $filename = microtime_float() . $user . '.pim';
        // Ordner erstellen wenn noch nicht vorhanden
        if (!is_dir($path)) {
            mkdir($path, 0777, true) || chmod($path, 0777);
            echo "Directory established: " . $path . PHP_EOL;
        };
        //ZIP erstellen, verschlüsseln, befüllen
        if ($zip->open($path . $filename, ZipArchive::CREATE)) {
            $zip->setPassword($chatID); // UUID
            //when text
            $zip->addFromString("msg.txt", $message, ZipArchive::FL_ENC_UTF_8); //only php 7 +
            $zip->setEncryptionName("msg.txt", ZipArchive::EM_AES_256); //only php 7.2 +
            $zip->close();

        } else {
            exit("cannot open <$filename>\n");
        }
    } else echo "Übergebene UserID ({$user}) ist nicht identifizierbar";
} else {
    echo "Übergebene parameter sind unvollständig" . PHP_EOL;
}

echo "{}";