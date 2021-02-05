<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    setRandNum($_SESSION['rn'], $_SESSION['chatID']);
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
      <p><br>
        ChatID: <?php echo $_SESSION['chatID'];?>
      <br>
        PW: <?php echo $_SESSION['rn'];?>
      <br></p>
      <button onclick="window.location.href = 'chat.php'">Check and Join</button>
      <p>
        <?php
          if (isset($_GET['error'])) {
            if ($_GET['error']=="NoConn") {
              echo 'Your Partner has to enter the Password first!';
            }
          }
        ?>
      </p>
    </body>
</html>