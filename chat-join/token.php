<?php
    require('../PHP/session.php');
    $token = randomNumber(4);
    $_SESSION['token'] = $token;
    if (isset($_POST['chatID'])) {
        $_SESSION['chatID'] = $_POST['chatID'];
    } else {
        echo "<script>window.location.href = 'link-join.php';</script>";
    }
    function randomNumber($length) {
        $min = str_repeat(0, $length-1) . 1;
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);
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
      <br>
        ChatID: <?php echo $_SESSION['chatID'];?>
      <br>
        Token: <?php echo $_SESSION['token'];?>
      <br>
        Token-Hash: <?php echo sha1($_SESSION['token']);?>
      <br>
    </body>
</html>