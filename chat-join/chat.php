<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_SESSION['chatID'];
    if (checkConnStat($guid)!=1) {
        echo "<script>window.location.href = 'dashboard.php?error=NoConn';</script>";
    }
?>
<html lang="en">
    <head class="preload dark" onload="removePreload()">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
    </head>
    <body>
        <h1>Welcome at Pim</h1>
        <br>
        <p>ChatID: <?php echo $_SESSION['chatID'];?> <br> Chat eröffnet!</p>
        <br>
        <form action="../PHP/deleteRow.php" method="post">
            <input type="submit" name="someAction" value="Delete Chat"/>
            <input type="hidden" name="chatID" value="<?php echo $_SESSION['chatID'];?>"/>
        </form>
        <form action="../Conversation/send_Message.php" method="post">
<!--            TODO input file/pic ...-->
            <input type="text" name="TextField" placeholder="Deine Nachricht ...">
            <input type="submit" name="SendMsg">
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
    </body>
</html>