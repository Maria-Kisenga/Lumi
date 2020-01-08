<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI'];
require('db.php');
require("auth.php");
$id = $_REQUEST['id']; //recipe_id
$user = $_SESSION['user_id']; //user_id
//echo $id;
if(isset($_POST['book'])){
	//check if user has already reserved a seat
	$queryyyy = "SELECT booked FROM users WHERE user_id = '".$user."'";
	$resultttt =mysqli_query($db, $queryyyy) or die (mysqli_error());
	$hold = mysqli_fetch_assoc($resultttt);
	if($resultttt){
		$seat = $hold['booked'];
		$bookings = explode(',', $seat);		
		if(in_array($id, $bookings)){
			echo "<script>alert('You have already reserved a seat for this event'); window.location.href='index.php#section-menu';</script>";
	 } 
	 else {	
	//mark user as booked
	$query = "UPDATE users SET booked= CONCAT_WS (',' ,booked, '".$id."') WHERE user_id='".$user."'";
	$result = mysqli_query($db, $query) or die(mysqli_error());
	 }
	if($result){
		//get current count status
		$queryy = "SELECT booked FROM recipes WHERE recipe_id = '".$id."'";
		$resultt = mysqli_query($db, $queryy) or die (mysqli_error());
		$row = mysqli_fetch_assoc($resultt);
		if($resultt){	
		$num = $row['booked'];
		$count = $num + 1;
		$queryyy = "UPDATE recipes SET booked = '".$count."' WHERE recipe_id = '".$id."'";
		$resulttt = mysqli_query($db, $queryyy) or die (mysqli_error());
		if($resulttt){
			echo "<script>alert('Your seat has been reserved');window.location.href='index.php#section-menu';</script>";
		 }
		} 
		else {
			echo "An error occurred. Please try again later";
		}
	} 
	else {
		echo "An error occurred. Please try again later";
	}
} else {
	echo "An error has occurred. Please try again later";
 }
}
?>