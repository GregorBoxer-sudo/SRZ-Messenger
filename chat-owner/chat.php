<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_SESSION['chatID'];
    $pwd = $_GET['pwd'];
    if (checkForPassword($pwd, $guid)!=1) {
      echo "<script>window.location.href = 'dashboard-owner.php?error=NoConn';</script>";
    } else {
      setConnStatTrue($guid);
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
      <form action="../PHP/deleteRow.php" method="post">
        <input type="submit" name="someAction" value="Delete Chat"/>
        <input type="hidden" name="chatID" value="<?php echo $_SESSION['chatID'];?>"/>
      </form>
    </body>
</html>