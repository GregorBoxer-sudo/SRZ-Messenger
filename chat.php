<?php
//hier ihren php code einfügen doer so ich weiß ncihtg enau was du hier machen willst man kann vllt auch mal ne anwendung schreiben die von reddit memes ausgibt
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <link href="Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
    <style>
        /* chat */
        .chatWindow{
            margin-left: 25%;
            margin-right: 25%;
            margin-top: 5%;
            width: 100%;
            height: 100%;
            /*padding-bottom: 40%;*/
            color: darkgray;
            background: #AAAAAA;
            border-radius: 2em;

            box-shadow:
                    0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                    0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                    0 12.5px 10px rgba(0, 0, 0, 0.06),
                    0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                    0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                    0 100px 80px rgba(0, 0, 0, 0.12);
        }
        #containerMessages{
            margin: 2%;
            background: white;
            width: 96%;
            height: 90%;
            padding-top: 70%;
            margin-bottom: 0;
        }
        #containerSendMessage{
            margin: 2%;
            margin-top: 0;
            background: greenyellow;
            width: 96%;
            height: 1.5em;
        }
        #send{
            width: 1.5em;
            height: 1.5em;
            color: white;
            background: dodgerblue;
            float: right;
        }
        .ownMessage{
            float: right;
            height: 1.3em;
            background: dodgerblue;
        }


    </style>
</head>
<body class="preload dark" onload="removePreload()">
<!--navigation bar-->
<div class="navigationBar">
    <a class="navItem" id="home" href="choose.php">Pim</a>

    <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
    <a class="navItem" id="FAQ" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki">FAQ</a>
</div>

<div class="contentContainer">
    <div class="chatWindow" id="chatContainer">
        <div id="containerMessages"><div class="ownMessage">Das hier ist meine erste Nachricht</div></div>

        <div id="containerSendMessage">sende eine Nachricht <div id="send">></div></div>
    </div>
</div>

</body>
<script src="JS/darmode.js"></script>
</html>

