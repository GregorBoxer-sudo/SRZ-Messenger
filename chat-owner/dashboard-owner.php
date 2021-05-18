<?php
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
        <script src="../JS/darmode.js"></script>
        <script src="../JS/copyToClipboard.js"></script>
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
                <p class="leftMenu">Chat-ID</p>
            </div>

            <div class="rightContentContainer">
                <!-- todo vllt mal hier anders lösen-->
                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">Chat-ID</h1>
                    <p class="rightSubText">
                        Your chat-ID is:
                    </p>
                    <input value="<?php echo $_SESSION['chatID'];?>" type="text" class="input" id="inputID">
                    <button onclick="copyToClipboard(this, document.getElementById('inputID'))" class="slideButton" id="copyToClipboard">&#x1f4cb;</button>
                </div>

                <div class="rightSubContentContainer">
                    <h1 class="rightSubTitle">partner token</h1>
                    <p class="rightSubText">
                        Enter the token from your Partner
                    </p>
                    <form action="chat.php" method="POST">
                        <input type="text" name="pwd" autocomplete="off" class="input"/> <!--todo make it green, when its correct-->
                        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
                        <input type="submit" class="slideButton">
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