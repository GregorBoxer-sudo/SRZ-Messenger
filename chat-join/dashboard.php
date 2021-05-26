<?php
    require("../PHP/darkMode.php");
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    setRandNum($_SESSION['rn'], $_SESSION['chatID']);
    $guid = $_SESSION['chatID'];
    $_SESSION['user'] = 1
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <title>PIM</title>
        <script src="../JS/cookieFunctions.js"></script>
        <script src="../JS/darkmode.js"></script>
        <script src="../JS/copyToClipboard.js"></script>
        <script>
            function clipboard(button){
                copyToClipboard(button, document.getElementById('inputPassword'))
                let interval = setInterval(function (){
                     window.location.href = 'chat.php'
                }, 3000);
            }
            function encryptKey() {
                console.log("sakldjadslkdj: "+sessionStorage.length);
                if (sessionStorage.length < 1) {
                    var encrytionKey = "";
                    var chars = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                    for (i = 0; i < 12; i++) {
                        randomElement = chars[Math.floor(Math.random()*chars.length)];
                        encrytionKey += randomElement;
                    }
                    sessionStorage.setItem("key", encrytionKey);
                    return encrytionKey;
                } else {
                    return sessionStorage.getItem('key');
                }
            }
            function showKey() {
                var encryptionKey = encryptKey();
                var showKey = encryptionKey.match(/.{1,4}/g).join('-');
                var token = document.getElementById('inputPassword').value
                document.getElementById("inputPassword").value = token+"-"+showKey;
            }
        </script>
    </head>
    <body class="<?php echo darkMode()?>" onload="removePreload(); isDarkMode()">
        <!--navigation bar-->
        <div class="navigationBar">
            <a class="navItem" id="home" href="../index.php">Home</a>
            <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
            <a class="navItem" id="FAQ" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki">FAQ</a>
        </div>

        <div class="contentContainer">
            <div class="leftContentContainer">
                <h1 class="leftTitle">Pim</h1>
                <p class="leftMenu">password</p>
            </div>

            <div class="rightContentContainer">
                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">Chat-ID</h1>
                    <p class="rightSubText">Your chat-ID is: </p>
                    <input value="<?php echo $_SESSION['chatID'];?>" type="text" class="input" id="inputID" readonly="readonly">
                    <p class="rightSubText">
                        The ChatID consists of various server and remote data and a randomly determined namespace,
                        encrypted with an irreversible algorithm.
                    </p>
                </div>

                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">token</h1>
                    <p class="rightSubText">your token: </p>
                    <input type="text" value="<?php echo $_SESSION['rn'];?>" id="inputPassword" class="input" readonly="readonly">
                    <script>showKey();</script>
                    <button onclick="clipboard(this)" class="slideButton" id="copyToClipboard">&#x1f4cb;</button>
                    <p class="rightSubText">
                        In some browsers and iOS the transfer of the key does not work correctly. To use the chat, click on change Encryptionkey (bottom rigth).
                    </p>
                    <p class="errorMessagePassword">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']=="NoConn") {
                                echo 'Waiting for your Partner ...!';
                                echo '<script> let interval = setInterval(function (){window.location.href = "chat.php"}, 3000); </script>';
                            }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>