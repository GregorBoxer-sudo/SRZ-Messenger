<?php
    require("../PHP/darkMode.php");
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    require('../PHP/dbh.php');
    require('../PHP/idGen.php');
    if (isset($_GET['chatID'])) {
        $guid = $_GET['chatID'];
        $_SESSION['chatID'] = $guid;
    } else {
        $guid = create_guid();
        $guid = $_SESSION['chatID'];
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <title>PIM-Create</title>
        <script src="../JS/cookieFunctions.js"></script>
        <script src="../JS/darkmode.js"></script>
        <script src="../JS/copyToClipboard.js"></script>
        <script>
            function proof(input){
                if (input.value.length === 19){
                    var contentArray = input.value.split('-');
                    if (contentArray.length = 4) {
                        var token = contentArray[0];
                        var key = contentArray[1]+contentArray[2]+contentArray[3];
                        document.getElementById('outToken').value = token;
                        sessionStorage.setItem('key', key);
                        document.getElementById("submitForm").submit();
                    } else {
                        console.warn("TOKEN NOT VALID");
                    }
                }
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
                <p class="leftMenu">Chat-ID</p>
            </div>

            <div class="rightContentContainer">
                <!-- todo vllt mal hier anders lösen-->
                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">Chat-ID</h1>
                    <p class="rightSubText">
                        Your chat-ID is:
                    </p>
                    <input value="<?php echo $_SESSION['chatID'];?>" type="text" class="input" id="inputID" readonly="readonly">
                    <button onclick="copyToClipboard(this, document.getElementById('inputID')); document.getElementById('inputPassword').select();" class="slideButton" id="copyToClipboard">&#x1f4cb;</button>
                    <p class="rightSubText">
                        The ChatID consists of various server and remote data and a randomly determined namespace,
                        encrypted with an irreversible algorithm.
                    </p>
                </div>

                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">partner token</h1>
                    <p class="rightSubText">
                        Enter the token from your Partner
                    </p>
                    <input type="text" name="pwd-Raw" autocomplete="off" class="input" oninput="proof(this)"/> <!--todo make it green, when its correct-->
                    <form action="chat.php" method="POST" id="submitForm">
                        <input type="hidden" name="pwd" id="outToken" autocomplete="off" class="input"/>
                        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
                        <p class="rightSubText">
                        In some browsers and iOS the transfer of the key does not work correctly. To use the chat, click on change Encryptionkey (bottom rigth).
                        </p>
                    </form>
                    <p class="errorMessagePassword" style="background-image='images/Pim background.png';   background-repeat='no-repeat'; background-size='contain'; background-position='center' ">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']=="NoConn") {
                                echo 'false Password';
                            }
                        }
                        ?>
                    </p>
                    <form action="../PHP/deleteRow.php" method="POST">
                        <input type="submit" name="reload" value="New Chat-ID" class="smallButtons"/>
                        <input type="submit" name="someAction" value="Delete Chat" class="smallButtons" id="deleteChatButton"/>
                        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>