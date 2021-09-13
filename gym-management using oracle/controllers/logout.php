<?php
    session_start();
    unset($_SESSION['flag']);

    header("location:loginCheck.php");
?>