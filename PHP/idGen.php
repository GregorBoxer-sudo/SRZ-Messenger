<?php
    require('../PHP/session.php');
    function create_guid() { // Create GUID (Globally Unique Identifier)
        $guid = '';
        $namespace = rand(11111, 99999);
        $uid = uniqid('', true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  4) . '-' . substr($hash,  8,  2) . substr($hash, 12,  2) . '-' . substr($hash, 16,  4) . '-' . substr($hash, 20, 4);
        $hash = sha1($guid);
        require("dbh.php");
        $sql = $conn->prepare("INSERT INTO `chats`(`ChatID`) VALUES (?)");
        $sql->bind_param("s", $hash);
        if ($sql->execute() === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $_SESSION['chatID'] = $guid;
        $conn->close();
    }
    function rn() {
        $rn = createRn(4);
        if (isset($_POST['chatID'])) {
            $_SESSION['chatID'] = $_POST['chatID'];
        } else {
            echo "<script>window.location.href = 'link-join.php';</script>";
        }
        return $rn;
    }
    function createRn($length) {
        return join('', array_map(function($value) { return $value == 1 ? mt_rand(1, 9) : mt_rand(0, 9); }, range(1, $length)));
    }
    function checkGUID($guid) {
        require('../PHP/dbh.php');
        $guid = sha1($guid);
        $sql = $conn->prepare("SELECT * FROM `chats` WHERE ChatID=?");
        echo "SELECT * FROM `chats` WHERE ChatID='$guid' <br>";
        $bind = "'$guid'";
        $sql->bind_param("s", $bind);
        if (!$sql)
        {
            die('Error: ' . mysqli_error($conn));
        }
        if(mysqli_num_rows($sql) > 0){
            return false;
        }else{
            return true;
        }
    }
    function setRandNum($randNum, $chatID) {
        require('dbh.php');
        $sql = $conn->prepare("UPDATE chats SET randNum=? WHERE chatID = $chatID");
        $sql->bind_param("s", $randNum);
        if ($sql->execute() === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>