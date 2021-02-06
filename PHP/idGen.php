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
        if (!($stmt = $conn->prepare("INSERT INTO chats (ChatID, Stat) VALUES (?, ?);"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $int = 0;
        if (!$stmt->bind_param("si", $hash, $int)) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $_SESSION['chatID'] = $guid;
        }
        $stmt->close();
        $conn->close();
        return $guid;
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
        require('dbh.php');
        $guid = sha1($guid);
        $stmt = $conn->prepare("SELECT * FROM chats WHERE ChatID = ?");
        $stmt->bind_param("s", $guid);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt) {
        if ($stmt->num_rows > 0) {
            echo 'found!';
            return false;
        } else {
            echo 'not found';
            return true;
        }
        } else {
            echo 'Error: '.mysqli_error($conn);
        }
    }
    function setRandNum($randNum, $chatID) {
        require('dbh.php');
        $chatID = sha1($chatID);
        $randNum = sha1($randNum);
        $stmt = $conn->prepare("UPDATE chats SET randNum = ? WHERE chatID = ?");
        $stmt->bind_param("ss", $randNum, $chatID);
        if ($stmt->execute() === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
    function checkForPassword($pwd, $guid) {
        require('dbh.php');
        $hash = sha1($pwd);
        $guid = sha1($guid);
        echo "hash: $hash <br>guid: $guid <br>";
        $stmt = $conn->prepare("SELECT randNum FROM chats where ChatID = ?");
        $stmt->bind_param("s", $guid);
        $stmt->execute();
        $result = $stmt->get_result();
        $rightPWD = null;
        if($result->num_rows === 0) exit('No rows');
        while($row = $result->fetch_assoc()) {
            $rightPWD = $row['randNum'];
        }
        if ($hash === $rightPWD) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
      }
      function setConnStatTrue($chatID) {
        require('dbh.php');
        $chatID = sha1($chatID);
        $stmt = $conn->prepare("UPDATE `chats` SET `Stat` = ? WHERE `chats`.`ChatID` = ?");
        $int = "1";
        $stmt->bind_param("ss", $int, $chatID);
        if ($stmt->execute() === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
      }
    function checkConnStat($guid) {
        require('dbh.php');
        $guid = sha1($guid);
        $stmt = $conn->prepare("SELECT Stat FROM chats where ChatID = ?");
        $stmt->bind_param("s", $guid);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) exit('No rows');
        while($row = $result->fetch_assoc()) {
            return $row['Stat'];
        }
        $stmt->close();
    }
?>