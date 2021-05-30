<?php
    require('../PHP/idGen.php');
    $rn = rn();
    $guid = $_POST['chatID'];
    $_SESSION['chatID'] = $guid;
    $_SESSION['rn'] = $rn;
    if (checkGUID($guid) == 0) {
        echo  "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        echo  "<script>window.location.href = 'link-join.php?error=IdNotFound';</script>";
    }
?>