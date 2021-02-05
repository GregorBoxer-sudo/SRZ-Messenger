<html>
<head>
    <meta charset="utf-8">
    <title>Choose</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
</head>
<body class="bodyChoose preload" onload="removePreload()">

<!--navigation bar-->
<div class="navigationBar">
    <a class="navItem" id="home" href="choose.php">Home</a>
    <a class="navItem" id="aboutUs" href="https://en.wikipedia.org/wiki/Glaucus_atlanticus">About Us</a>
    <a class="navItem" id="donate" href="https://en.wikipedia.org/wiki/Mutillidae">Donate</a>
    <a class="navItem" id="privacy" href="https://en.wikipedia.org/wiki/Pasteur%27s_day_gecko#Distribution">Privacy</a>
</div>

<div class="contentContainer">
    <div class="logo">
        <h1 class="pim">Pim</h1>
        <p class="pimPrivacyText">Pim is your secure messenger with single use chats,<br> which stores no data and no messages. <br> We use no cookies or trackers.</p>
        <a class="privacyButton" href="https://de.wikipedia.org/wiki/Wei%C3%9Fbauchschuppentier"><u>learn more ></u></a>
    </div>

    <div class="chatInteraction"><!--todo rename all things-->
        <div class="containerChat" id="openChatContainer" >
            <h1 class="ChatTitle">create chat</h1>
            <p class="textChatParagraph">Said soft foot football relay gas prices. <br> Integer developers. Tomorrow protein. <br> If not always live element.</p>
            <button class="chatButton" onclick="window.location.href = 'chat-owner/dashboard-owner.php'">create chat</button>
        </div>
        <div class="containerChat" id="joinChatContainer">
            <h1 class="ChatTitle">join chat</h1>
            <p class="textChatParagraph">Said soft foot football relay gas prices. <br> Integer developers. Tomorrow protein. <br> If not always live element.</p>
            <button class="chatButton" onclick="window.location.href = 'chat-join/link-join.php'">join chat</button>
        </div>
    </div>
</div>

</body>
<script>
    //fixing the bug in google chrome, where it plays at the beginning
    function removePreload(){
        document.getElementsByClassName("preload")[0].classList.remove("preload");
    }
</script>
</html>