<?php
    require('../PHP/session.php');
    require('PHP/idGen.php');
    setRandNum($_SESSION['rn'], $_SESSION['chatID']);
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
        PW: <?php echo $_SESSION['rn'];?>
      <br></p>
    </body>
</html>