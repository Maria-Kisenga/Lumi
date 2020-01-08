<?php
session_start();
if(!isset($_SESSION["user_id"])){
header("Location: login.php");
exit(); }
//check if user is logged in
?>