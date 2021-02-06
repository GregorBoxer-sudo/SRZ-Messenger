<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    require('../PHP/dbh.php');
    require('../PHP/idGen.php');
    if (isset($_GET['chatID'])) {
        $guid = $_GET['chatID'];
        $_SESSION['chatID'] = $guid;
    } else {
        $guid = create_guid();
        $guid = $_SESSION['chatID'];
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
      <br>
        Your ChatID is:
        <input value="<?php echo $_SESSION['chatID'];?>" type="text" id="inputID">
        <button onclick="copyToClipboard()">copy to &#x1f4cb;</button>
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
      <input type="submit" name="reload" value="New ChatID"/>
        <input type="submit" name="someAction" value="Delete Chat"/>
        <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
      </form>
    </body>
<script>
    function copyToClipboard() {
        let copyText = document.getElementById("inputID");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied the ID: " + copyText.value);
    }
</script>
</html>