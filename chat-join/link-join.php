<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo "<script>document.getElementById('error').innerhtml=$error</script>";
    }
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link href="../stylesheet.css" rel="stylesheet" type="text/css" />
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
            <p class="rightSubText">
                enter your Chat-ID:
            </p>
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

<script>
    //fixing the bug in google chrome, where it plays at the beginning(button and theme transitions)
    //is still there, when you are in the developer mode idk why
    function removePreload() {
        document.getElementsByClassName("preload")[0].classList.remove("preload");
        console.log("now")
    }
</script>
<script>
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
</script>
<script>
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