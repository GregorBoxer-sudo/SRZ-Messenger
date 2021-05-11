<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo "<script>document.getElementById('error').innerhtml=$error</script>";
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <title>PIM-Join</title>
        <script src="../JS/darmode.js"></script>
    </head>
    <body class="preload dark" onload="removePreload()">
        <!--navigation bar-->
        <div class="navigationBar">
            <a class="navItem" id="home" href="../choose.php">Home</a>
            <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
            <a class="navItem" id="FAQ" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki">FAQ</a>
        </div>

        <div class="contentContainer">
            <div class="leftContentContainer">
                <h1 class="leftTitle">Pim</h1>
                <p class="leftMenu">join chat</p>
            </div>

            <div class="rightContentContainer">
                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">join chat</h1>
                    <p class="rightSubText">enter your Chat-ID: </p>
                    <form action="load.php" method="POST">
                        <input type="text" name="chatID" class="input">
                        <input type="submit" class="slideButton">
                    </form>
                    <p class="errorMessagePassword"><?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            switch ($error) {
                                case "IdNotFound": echo "The chat you searched for does not exist!"; break;
                                default: echo "Unknown Error $error";
                            }
                        }
                    ?></p>
                </div>
            </div>
        </div>
    </body>
</html>