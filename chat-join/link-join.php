<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo "<script>document.getElementById('error').innerhtml=$error</script>";
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
        <form action="load.php" method="POST">
            <label>ChatID:</label>
            <input type="text" name="chatID">
            <input type="submit">
        </form>
      <br>
      <p><?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            switch ($error) {
                case "IdNotFound": echo "The chat you searched for does not exist!"; break;
                default: echo "Unknown Error $error";
            }
        }
      ?></p>
      <br>
    </body>
</html>