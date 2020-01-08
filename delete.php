<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require('db.php');
//require ('auth.php');
$recipe_id = $_REQUEST['id'];
$posted_by = $_SESSION['user_id'];
$result = mysqli_query($db,"SELECT * FROM recipes WHERE user_id ='$posted_by'");
$hold = mysqli_fetch_array($result);
//admin id = 1
//only admin and user who posted the recipe can delete it
if($_SESSION['user_id'] == 1 || $hold['user_id'] == $_SESSION['user_id']){
$query = "DELETE FROM recipes WHERE recipe_id= $recipe_id"; 
$result = mysqli_query($db,$query) or die (mysqli_error());
header("Location: profile.php"); 
	 }
else{
	header("refresh:1;url=profile.php"); 
	echo '<script language="javascript">';
	echo 'alert("An error occurred. Please try again later")';
	echo '</script>';
	exit;
}
?>