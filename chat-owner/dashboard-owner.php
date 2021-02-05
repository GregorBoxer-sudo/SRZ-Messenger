<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    require('../PHP/dbh.php');
    require('../PHP/idGen.php');
    create_guid();
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
        <form action="chat.php" method="$_POST">
            <label>Please add token from partner:</label>
            <input type="text" name="pwd">
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
      <form action="../PHP/deleteRow.php" method="post">
        <input type="submit" name="someAction" value="Delete Chat"/>
        <input type="hidden" name="chatID" value="<?php echo $_SESSION['chatID'];?>"/>
      </form>
    </body>
</html>