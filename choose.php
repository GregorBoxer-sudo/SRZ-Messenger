<?php
 require('PHP/session_kill.php');
 require('PHP/session.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Choose</title>
    <link rel="icon" href="https://lh3.googleusercontent.com/proxy/LLwGSJOeIeB9Xy10EjCXU5hhO4kjSL17llih51Mr1ydWaVFanvBBf5Ny_6jj9R0093i61P7OGuhsM6Ag9mWiyvPn9GqBaoIUAQRGDQkV18G5zb5y1OUuJ8VzjNl3VboWHJgBceKOQ1GqwGM5rJR42rLT8UKtu57A6M2V9g-aDQ">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
</head>
<body class="bodyChoose">

<div class="navigationBar">
    <a class="navItem" id="home" href="choose.php">Home</a>
    <a class="navItem" id="aboutUs" href="https://en.wikipedia.org/wiki/Glaucus_atlanticus">About Us</a>
    <a class="navItem" id="donate" href="https://en.wikipedia.org/wiki/Mutillidae">Donate</a>
    <a class="navItem" id="privacy" href="https://en.wikipedia.org/wiki/Pasteur%27s_day_gecko#Distribution">Privacy</a>
</div>

<div class="contentContainer">
    <div class="logo">
        <img src="images/Pim%20background.png" width="1000" height="1000">
        <h1 class="pim">Pim</h1>
        <p class="pimPrivacyText">Pim is a private Single-Use Messenger,<br> which stores no Data and no Messages. <br> We use no Cookies or Trackers.</p>
        <a class="privacyButton"><u>learn more ></u></a>
    </div>


    <div class="chatInteraction"><!--todo rename all things-->
        <div class="containerChat">
            <h1 class="ChatTitle">Open new chat</h1>
            <p class="textChatParagraph">Said soft foot football relay gas prices. <br> Integer developers. Tomorrow protein. <br> If not always live element.</p>
            <button class="chatButton" onclick="window.location.href = 'chat-owner/dashboard-owner.php'">Open new Chat</button>
        </div>
        <div class="containerChat">
            <h1 class="ChatTitle">Join chat</h1>
            <p class="textChatParagraph">Said soft foot football relay gas prices. <br> Integer developers. Tomorrow protein. <br> If not always live element.</p>
            <button class="chatButton" onclick="window.location.href = 'chat-join/link-join.php'">Join Chat</button>
        </div>
    </div>
</div>

</body>
</html>