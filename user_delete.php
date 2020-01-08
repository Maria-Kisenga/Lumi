<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require('db.php');
require ('auth.php');

$id = $_REQUEST['id'];
if($_SESSION['user_id'] == 1){
$query = "DELETE FROM users WHERE user_id= $id"; 
$result = mysqli_query($db,$query) or die (mysqli_error());
header("Location: admin.php"); 
	 }
else{
	header("refresh:1;url=admin.php"); 
	echo '<script language="javascript">';
	echo 'alert("An error occurred. Please try again later")';
	echo '</script>';
	exit;
}
?>