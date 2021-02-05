<html>
<head>
    <meta charset="utf-8">
    <title>Choose</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
</head>
<body class="preload dark" onload="removePreload()">

<!--navigation bar-->
<div class="navigationBar">
    <a class="navItem" id="home" href="choose.php">Home</a>

    <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
    <a class="navItem" id="aboutUs" href="https://en.wikipedia.org/wiki/Glaucus_atlanticus">About Us</a>
    <a class="navItem" id="donate" href="https://en.wikipedia.org/wiki/Mutillidae">Donate</a>
    <a class="navItem" id="privacy" href="Security.html">Privacy</a>

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
            <p class="textChatParagraph">
                Click on the button down below, to create a new chat.
                If you click the button, you get a Chat-ID.
                You have to give this ID to your partner.
                To verify your partner, you must enter his token.</p>
            <button class="chatButton" onclick="window.location.href = 'chat-owner/dashboard-owner.php'">create chat</button>
        </div>
        <div class="containerChat" id="joinChatContainer">
            <h1 class="ChatTitle">join chat</h1>
            <p class="textChatParagraph">
                Click on the button down below, to join a new chat.
                If you click the button, you must enter the Chat-ID, from your partner.
                We will generate you a token, to ensure that the right person enters the chat.
                </p>
            <button class="chatButton" onclick="window.location.href = 'chat-join/link-join.php'">join chat</button>
        </div>
    </div>
</div>

</body>
<script>
    //fixing the bug in google chrome, where it plays at the beginning(button and theme transitions)
    //is still there, when you are in the developer mode idk why
    function removePreload(){
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
        } else {
            document.body.className = "dark";
            document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
        }
    }

    //todo maybe add a session storage habe gerade keine Lust mehr dazu es ist 4 uhr
</script>
</html>