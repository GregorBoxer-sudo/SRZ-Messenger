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
        <link href="../stylesheet.css" rel="stylesheet" type="text/css" />
        <title>PIM-Create</title>
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
                    <button onclick="copyToClipboard()" class="slideButton" id="copyToClipboard">&#x1f4cb;</button>
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
    <script>
        function copyToClipboard() {
            let copyText = document.getElementById("inputID");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied the ID: " + copyText.value);
        }

        //fixing the bug in google chrome, where it plays at the beginning(button and theme transitions)
        //is still there, when you are in the developer mode idk why
        function removePreload() {
            document.getElementsByClassName("preload")[0].classList.remove("preload");
            console.log("now")
        }

        //this function is for the different themes
        function newTheme() {
            console.log(document.body.className)
            if (document.body.className === "dark") {
                document.body.className = "light";
                document.getElementById("switch").innerHTML = "&#x1F311;";
                document.getElementById("githubImage").src = "images/githubBlack.png";
            } else {
                document.body.className = "dark";
                document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
                document.getElementById("githubImage").src = "images/githubWhite.png";
            }
        }

        //select system theme: light/dark
        function isDarkMode() {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                // dark mode
                document.body.className = "dark";
                document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
                document.getElementById("githubImage").src = "images/githubWhite.png";
            } else {
                // light mode
                document.body.className = "light";
                document.getElementById("switch").innerHTML = "&#x1F311;";
                document.getElementById("githubImage").src = "images/githubBlack.png";
            }
        }
        window.onload(isDarkMode());
    </script>
</html>