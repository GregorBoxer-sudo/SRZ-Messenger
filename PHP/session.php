<?php
    if (!isset($_SESSION['active'])) {
        session_start();
        $_SESSION['active'] = "yes";
    }
?>