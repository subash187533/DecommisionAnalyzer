<?php
ob_start();
session_start();

// print_r($_SESSION);

if(!$_SESSION['userId']) {
    header('Location: ./login.php');
}

?>