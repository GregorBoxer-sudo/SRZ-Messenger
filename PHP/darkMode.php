<?php
    function darkMode() {
        if(isset($_COOKIE['darkMode'])) {
            if ($_COOKIE['darkMode'] == "0") {
                return "preload light";
            } else {
                return "preload dark";
            }
        } else {
            return "preload dark";
        }
    }
?>