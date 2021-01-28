<?php
    require('../PHP/session_kill.php');
    require('../PHP/session.php');
    $uid = create_guid();
    $uidHash = sha1($uid);
    $_SESSION['chatID'] = $uid;
    function create_guid() { // Create GUID (Globally Unique Identifier)
      $guid = '';
      $namespace = rand(11111, 99999);
      $uid = uniqid('', true);
      $data = $namespace;
      $data .= $_SERVER['REQUEST_TIME'];
      $data .= $_SERVER['HTTP_USER_AGENT'];
      $data .= $_SERVER['REMOTE_ADDR'];
      $data .= $_SERVER['REMOTE_PORT'];
      $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
      $guid = substr($hash,  0,  4) . '-' .
              substr($hash,  8,  2) .
              substr($hash, 12,  2) . '-' .
              substr($hash, 16,  4) . '-' .
              substr($hash, 20, 4);
      return $guid;
  }
?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </head>
    <body>
      <h1>
        Willkommen beim private Messenger
      </h1>
      <br>
      <br>
        Deine ChatID ist: <?php echo $_SESSION['chatID'];?>
      <br>
        <form>
            <label>Hier den Token vom gegenüber eingeben:</label>
            <input type="text">
            <input type="submit">
        </form>
    </body>
</html>