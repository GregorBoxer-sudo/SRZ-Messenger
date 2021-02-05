<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_SESSION['chatID'];
    if (checkConnStat($guid)!==1) {
      echo "<script>window.location.href = 'dashboard.php?error=NoConn';</script>";
    }
?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </head>
    <body>
      <h1>
        Welcome at Pim
      </h1>
      <p><br>
        ChatID: <?php echo $_SESSION['chatID'];?>
      <br>
        Chat eröffnet!
      <br></p>
      <button onclick="window.location.href = '../PHP/deleteRow.php'">Delete Chat</button>
    </body>
</html>