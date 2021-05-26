<?php
    require("../PHP/darkMode.php");
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_SESSION['chatID'];
    $dir = dirname(dirname(__FILE__));
    $path = $dir . "/FILESYSTEM-Messages/" . sha1($guid) . "/";
    // Ordner erstellen wenn noch nicht vorhanden
    if (!is_dir($path)) {
        mkdir($path, 0777, true) || chmod($path, 0777);
    }
    if (checkConnStat($guid)!=1) {
        echo "<script>window.location.href = 'dashboard.php?error=NoConn';</script>";
    }
?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>PIM-Chat</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <script src="../JS/jquery.min.js"></script>    <script src="../JS/darkmode.js"></script>
    <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../Stylesheets/chatstyle.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="../JS/encryption.js"></script>
    <script src="../JS/messageFormatting.js"></script>
    <script src="../JS/cookieFunctions.js"></script>
    <script src="../JS/darkmode.js"></script>
    <script src="../JS/crypto.js"></script>
    <script src="../JS/keyListener.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>-->
    <script src="../JS/hideKey.js"></script>
    <script src="../JS/onChatReady.js"></script>
    <script src="../JS/checkLinebreak.js"></script>
    <script>
        user = 1
        let messages = [];

        function sendMessage(){
            let message = document.getElementsByClassName("MessageInputField")[0].value;
            if (message !== ""){
                let seconds = parseInt(new Date().getTime());
                message = checkLinebreak(message)
                messages[messages.length] = {"user": user, "time": seconds, "message": message}
                formatMessage();

                let sendData = { "user": user, "chatID": '<?php echo $guid?>', "message": encrypt(message, sessionStorage.getItem('key'))};

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Conversation/send_Message.php', true);
                xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                xhr.onreadystatechange = function () {
                };

                xhr.send(JSON.stringify(sendData));

                document.getElementsByClassName("MessageInputField")[0].value = "";
                return false;
            }
        }
        function getMessages(){
            console.log("get")
            let data = { "user": user, "chatID": '<?php echo $guid?>' };

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Conversation/get_Message.php', true);
            xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(JSON.parse((xhr.response)))[0]

                    if(response !== undefined){
                        response["time"] = parseInt(response["time"])
                        response["message"] = decrypt(response["message"], sessionStorage.getItem('key'))

                        if(messages[messages.length-1] === undefined){
                            messages[messages.length] = response
                            formatMessage();
                            return
                        }
                        if(!(messages[messages.length-1]["time"] === response["time"] && messages[messages.length-1]["message"] === response["message"]) && response["user"] !== user){
                            messages[messages.length] = response
                            formatMessage();
                        }
                    }
                }
            };
            xhr.send(JSON.stringify(data));
            return false;
        }
    </script>


</head>

<body class="<?php echo darkMode()?>" id="bodyChat" onload="isDarkMode()"> <!--onload="removePreload()" todo do remove preload or check if its necessary-->
<div class="navigationBar">
    <a class="navItem" id="home" href="../index.php">Pim</a>
    <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
</div>

<p class="chatIDP">ChatID: <?php echo $_SESSION['chatID'];?></p>
<p class="chatIDP">Encryption-Key: <a class="keyHidden" id="printKey" onclick="hideKey()"></a></p>
<br>

<div class="interactionContainer">
    <div class="seeMessages">
        <div  class="noMessageText">&#x1f440; no messages yet</div>
        <div  class="subNoMessageText">write a message and send it by hitting enter <br>
            or wait until you receive a message from your partner</div>
    </div>

    <div class="writingContainer">
        <!--            TODO input file/pic ...-->
        <input type="text" name="TextField" id="messageInput" placeholder="your message ..." class="MessageInputField" autofocus="autofocus"
               autocomplete="off">
    </div>


</div>
<div class="footer" id="leftFooter">
    <form action="../PHP/deleteRow.php" method="post">
        <input type="submit" name="someAction" value="Delete Chat" class="smallButtons" id="deleteChatButton"/>
        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
    </form>
</div>
<div class="footer" id="rightFooter">
    <button onclick="changeKey()" class="smallButtons" id="changeEncryptionButton">change Encryptionkey</button>
</div>
</body>
</html>