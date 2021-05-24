<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_POST['chatID'];
    $pwd = $_POST['pwd'];
    if (checkForPassword($pwd, $guid)!=1) {
        echo "<script>window.location.href = '../chat-owner/dashboard-owner.php?error=NoConn&chatID=".$guid."'</script>";
    } else {
        setConnStatTrue($guid);
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
        <script src="../JS/jquery.min.js"></script>
        <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="../Stylesheets/chatstyle.css" rel="stylesheet" type="text/css" />
        <script src="../JS/darmode.js"></script>
        <script src="../JS/encryption.js"></script>
        <script src="../JS/messageFormatting.js"></script>
        <script src="../JS/crypto.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>-->
        <script>
            $(document).ready(function(){
                getMessages();
                let interval = setInterval(getMessages, 100);
                //todo es anders lösen, dass ich nicht die gnaze zeit nach den nachrichten frage sonder man halt nur einzelne hat und dann noch überhaupt nachfrgaen ob da in dem directory was drin ist damit es keine errrs wirft
                //todo in der php file werden sekunden benutzt,da kann man evtl mikrosekunden benutzen
                //TODO FIND ERROR IN FILESTUFF ALSO FEHLER FINDEN BEI DEM ZIPPEN, DENN DA WIRFT ER NEN FEHLER DESWEGEN FUNKTIONIERT ES GLAUBE NICHT
            })
        </script>
        <script>

            let messages = {};
            user = 0

            function getMessages(){
                let data = { "user": user, "chatID": '<?php echo $guid?>' };

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Conversation/get_Message.php', true);
                xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        messages = formatMessage(xhr.response, sessionStorage.getItem('key'));
                    }
                };

                xhr.send(JSON.stringify(data));
                return false;
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

        <p class="chatIDP">ChatID: <?php echo $_POST['chatID'];?></p>
        <br>

    <div class="interactionContainer">
        <div class="seeMessages">
            <div  class="noMessageText">&#x1f440; no messages yet</div>
            <div  class="subNoMessageText">write a message and send it by hitting enter <br>
                or wait until you receive a message from your partner</div>
        </div>

        <div class="writingContainer">
            <!--            TODO input file/pic ...-->
            <input type="text" name="TextField" placeholder="your message ..." class="MessageInputField"
                   autofocus="autofocus" autocomplete="off">
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