<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    require('../PHP/dbh.php');
    require('../PHP/idGen.php');
    $guid = create_guid();
    $guid = $_SESSION['chatID'];
?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </head>
    <body>
      <h1>
        Welcome at Pim
      </h1>
      <br>
      <br>
        Your ChatID is: <?php echo $_SESSION['chatID'];?>
      <br>
        <form action="chat.php" method="POST">
            <label>Please add token from partner:</label>
            <input type="text" name="pwd"/>
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
            <input type="submit">
        </form>
        <p>
        <?php
          if (isset($_GET['error'])) {
            if ($_GET['error']=="NoConn") {
              echo 'false Password';
            }
          }
        ?>
      </p>
      <form action="../PHP/deleteRow.php" method="POST">
        <input type="submit" name="someAction" value="Delete Chat"/>
        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
      </form>
    </body>
</html>