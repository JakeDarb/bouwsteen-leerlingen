<?php
if (!isset($_SESSION)) {
    session_start();
}
if(empty($_SESSION['student'])) {
    session_destroy();
    header("Location: login.php");
}