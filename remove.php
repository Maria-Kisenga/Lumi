<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require('db.php');
//require ('auth.php');
$id = $_REQUEST['id'];
$posted_by = $_SESSION['user_id'];
$result = mysqli_query($db,"SELECT * FROM recipes WHERE user_id ='$posted_by'");
$hold = mysqli_fetch_array($result);
//remove only that specific recipe
if($_SESSION['user_id'] == 1 || $hold['user_id'] == $_SESSION['user_id']){
$rec = $hold['booked'];
$new_rec = $rec-1;
$query = "UPDATE recipes SET booked = '".$new_rec."' WHERE recipe_id = '".$id."'"; 
$result = mysqli_query($db,$query) or die (mysqli_error());
if($result){
	$resultt = mysqli_query($db,"SELECT booked FROM users WHERE user_id ='$posted_by'");
    $holdd = mysqli_fetch_array($resultt);
	$boooked = $holdd['booked'];
	$arr = explode(',',$boooked);
	$arr = array_diff($arr, array($id));
	$arr = implode ($arr);
    $resultttt = mysqli_query($db, "UPDATE users SET booked = '".$arr."' WHERE user_id = '$posted_by'");
} 
if($resultttt){
header("Location: bookings.php"); 
} else {
	header("refresh:1;url=bookings.php"); 
	echo '<script language="javascript">';
	echo 'alert("An error occurred. Please try again later.")';
	echo '</script>';
	exit;
}
}
else{
	header("refresh:1;url=bookings.php"); 
	echo '<script language="javascript">';
	echo 'alert("An error occurred. Please try again later.")';
	echo '</script>';
	exit;
}
?>