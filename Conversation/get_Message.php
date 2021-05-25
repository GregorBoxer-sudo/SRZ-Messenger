<?php

    $in = file_get_contents('php://input');
    $decoded = json_decode($in, true);
    $data = new stdClass();
    $data->msg = 'PHP is working';
    $data->user = $decoded['user'];
    $data->chatID = $decoded['chatID'];
    $stringForEcho = json_encode($data);

    $chatID = $decoded['chatID'];
    $user = $decoded['user'];

    $response = new stdClass();//todo vllt mal eleganter lösen
    $json = "";
    if (isset($chatID) && isset($user)) {
        $dir = dirname(dirname(__FILE__));
        $path = $dir . "/FILESYSTEM-Messages/" . sha1($chatID) . "/";

        $files = scandir($path, SCANDIR_SORT_ASCENDING); // neustes file zuerst? TODO check nach mehr?
        $filesToDelete = [];


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
                $zip = new ZipArchive();
                if (is_file($path . $file)) {
                    $result = $zip->open($path . $file);

                    if ($result !== true) {
                        $ans = $ZIP_ERROR[$result] ?? 'Unknown error.';
                        #echo $path . $file . '<br>';
                        die($ans);
                    }

                    $zip->setPassword($chatID);
                    $msg = $zip->getFromName("msg.txt");
                    if (isset($file[10]) && ($file[10] == "1" || $file[10] == "0")) {
                        if ($user == "1" || $user == "0") {
                            $time = substr($file, 0, 10);
                            $json .= "{\"user\": $file[10], \"time\": \" $time\", \"message\": \"$msg\"}, ";

                            if ($user != $file[10]) {
                                array_push($filesToDelete, $path . $file);
                            }

                        } else $response->error = 'UserID aus Eingabe nicht identifiezierbar!' . PHP_EOL;
                    } else $response->error = 'User: ? send: " . $msg . "';//todo mal schauen wie man das hier macht, da dort nicht bekannt ist welcher user
                }
            }
        }
        if(isset($zip)){
            $zip->close();
        }
        foreach ($filesToDelete as $file){
            //echo 'Deleted: '.$file;
            unlink($file);
        }
    } else $response->error = "KEINE CHAT-ID/UserID gefunden";

    #$response->messages = "[".$json."]";



    if (isset($response->error))
        echo json_encode($response);
    else
        echo json_encode("[".substr($json, 0, -2)."]");//subtracts the last ,
