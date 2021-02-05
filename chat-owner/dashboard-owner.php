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
        <form>
            <label>Please add token from partner:</label>
            <input type="text">
            <input type="submit">
        </form>
    </body>
</html>