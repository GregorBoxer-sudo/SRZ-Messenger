<?php
require('../PHP/session.php');
require('../PHP/idGen.php');
$guid = $_SESSION['chatID'];
if (checkConnStat($guid)!=1) {
    echo "<script>window.location.href = 'dashboard.php?error=NoConn';</script>";
}
?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>PIM-Chat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/darmode.js"></script>
    <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../Stylesheets/chatstyle.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="../JS/encryption.js"></script>
    <script src="../JS/messageFormatting.js"></script>
    <script src="../JS/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script>
        $(document).ready(function(){
            getMessages();
            let interval = setInterval(getMessages, 100);
        })
    </script>
    <script>
        user = 1
        let messages = {};

        function changeKey() {
            newKey = prompt("Enter the new Key for message-encryption:")
            sessionStorage.setItem('key', newKey);
            getMessages();
        }

        function sendMessage(){
            if (document.getElementsByClassName("MessageInputField")[0].value !== ""){
                let data = { "user": user, "chatID": '<?php echo $guid?>', "message": encrypt(document.getElementsByClassName("MessageInputField")[0].value, sessionStorage.getItem('key'))};
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Conversation/send_Message.php', true);
                xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                xhr.onreadystatechange = function () {
                };

                xhr.send(JSON.stringify(data));
                document.getElementsByClassName("MessageInputField")[0].value = "";
                getMessages();
                return false;
            }else{
                //todo alert
            }
        }
        function getMessages(){
            let data = { "user": user, "chatID": '<?php echo $guid?>' };

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Conversation/get_Message.php', true);
            xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    messages = formatMessage(xhr.response, sessionStorage.getItem('key'))
                }
            };

            xhr.send(JSON.stringify(data));
            return false;
        }

        document.addEventListener('keydown', (e) => {
            if (e.code === "Enter")
                sendMessage();
        })

    </script>


</head>

<body class="preload dark" id="bodyChat"> <!--onload="removePreload()" todo do remove preload or check if its necessary-->
<div class="navigationBar">
    <a class="navItem" id="home" href="../index.php">Pim</a>
    <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
</div>

<p class="chatIDP">ChatID: <?php echo $_SESSION['chatID'];?></p>
<br>

<div class="interactionContainer">
    <div class="seeMessages">
        <div  class="noMessageText">&#x1f440; no messages yet</div>
        <div  class="subNoMessageText">write a message and send it by hitting enter <br>
            or wait until you receive a message from your partner</div>
    </div>

    <div class="writingContainer">
        <!--            TODO input file/pic ...-->
        <input type="text" name="TextField" placeholder="your message ..." class="MessageInputField" autofocus="autofocus"
               autocomplete="off">
    </div>

    <div class="footer">
        <button onclick="changeKey()" class="smallButtons">Change Encryption-Key</button>
        <form action="../PHP/deleteRow.php" method="post">
            <input type="submit" name="someAction" value="Delete Chat" class="smallButtons" id="deleteChatButton"/>
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
    </div>
</div>
</body>
</html>