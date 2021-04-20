<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_POST['chatID'];
    $pwd = $_POST['pwd'];
    if (checkForPassword($pwd, $guid)!=1) {
        echo "<script>window.location.href = 'dashboard-owner.php?error=NoConn&chatID=".$guid."';</script>";
    } else {
        setConnStatTrue($guid);
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
    </head>
    <body class="preload dark" onload="removePreload()">
        <h1>Welcome at Pim</h1>
        <br>
        <p>ChatID: <?php echo $_POST['chatID'];?><br>Chat eröffnet!</p>
        <br>
        <form action="../PHP/deleteRow.php" method="post">
            <input type="submit" name="someAction" value="Delete Chat"/>
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
        <form action="../Conversation/send_Message.php" method="post">
            <!--            TODO input file/pic ...-->
            <input type="text" name="TextField" placeholder="Deine Nachricht ...">
            <input type="submit" name="SendMsg">
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
        <form action="../Conversation/get_Message.php" method="post">
            <!--            TODO input file/pic ...-->
            <input type="submit" name="Nach Nachrichten Suchen">
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
    </body>
</html>