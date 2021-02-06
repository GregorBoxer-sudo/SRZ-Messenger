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
        PW:
        <input type="text" value="<?php echo $_SESSION['rn'];?>" id="inputPassword">
        <button onclick="copyToClipboard()">copy to &#x1f4cb;</button>
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
    <script>
        function copyToClipboard() {
            let copyText = document.getElementById("inputPassword");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied the password: " + copyText.value);
        }
    </script>
</html>