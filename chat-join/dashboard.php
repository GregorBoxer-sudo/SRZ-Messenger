<?php
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
        <script src="../JS/darmode.js"></script>
        <script src="../JS/copyToClipboard.js"></script>
        <script>
            function clipboard(button){
                copyToClipboard(button, document.getElementById('inputPassword'))
                let interval = setInterval(function (){
                     window.location.href = 'chat.php'
                }, 3000);
            }
        </script>
    </head>
    <body class="preload dark" onload="removePreload()">
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
                </div>

                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">password</h1>
                    <p class="rightSubText">your password: </p>
                    <input type="text" value="<?php echo $_SESSION['rn'];?>" id="inputPassword" class="input">
                    <button onclick="clipboard(this)" class="slideButton" id="copyToClipboard">&#x1f4cb;</button>
                    <p class="errorMessagePassword">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']=="NoConn") {
                                echo 'Waiting for your Partner ...';
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