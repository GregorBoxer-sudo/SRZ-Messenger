<?php
    require("PHP/darkMode.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PIM-Choose</title>
        <link href="Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <script src="JS/cookieFunctions.js"></script>
        <script src="JS/darkmode.js"></script>
        <script>
            sessionStorage.clear();
        </script>
    </head>
    <body class="<?php echo darkMode()?>" onload="removePreload(); isDarkMode()">
        <!--navigation bar-->
        <div class="navigationBar">
            <a class="navItem" id="home" href="index.php">Home</a>

            <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
            <a class="navItem" id="FAQ" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki">FAQ</a>
        </div>

        <div class="contentContainer">
            <div class="leftContentContainer">
                <h1 class="leftTitle">Pim</h1>
                <p class="leftText">Pim is your secure messenger with single use chats,<br> which stores no data and no messages. <br> We use no trackers.</p>
                <a class="leftLink" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki"><u>learn more ></u></a>
            </div>

            <div class="rightContentContainer">
                <!--todo rename all things
                todo vllt mal hier anders lösen-->
                <div class="rightSubContentContainer" id="openChatContainer">
                    <h1 class="rightSubTitle">create chat</h1>
                    <p class="rightSubText">
                        Click on the button down below, to create a new chat.
                        If you click the button, you get a Chat-ID.
                        You have to give this ID to your partner.
                        To verify your partner, you must enter his token.</p>
                    <button class="slideButton" onclick="window.location.href = 'chat-owner/dashboard-owner.php'">create chat</button>
                </div>

                <div class="rightSubContentContainer" id="joinChatContainer">
                    <h1 class="rightSubTitle">join chat</h1>
                    <p class="rightSubText">
                        Click on the button down below, to join a new chat.
                        If you click the button, you must enter the Chat-ID, from your partner.
                        We will generate you a token, to ensure that the right person enters the chat.
                    </p>
                    <button class="slideButton" onclick="window.location.href = 'chat-join/link-join.php'">join chat</button>
                </div>
            </div>
        </div>

    </body>
</html>