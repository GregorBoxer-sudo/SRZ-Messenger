<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
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
        <form action="token.php" method="POST">
            <label>ChatID:</label>
            <input type="text" name="chatID">
            <input type="submit">
        </form>
      <br>
      <br>
    </body>
</html>