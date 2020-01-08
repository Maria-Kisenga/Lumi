<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('db.php');
require("auth.php");
include('settings.php');
$id=$_REQUEST['id'];
$query = "SELECT * FROM recipes WHERE recipe_id='".$id."'"; 
$result = mysqli_query($db, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<html>
<head>
	<title>Update Recipe Event</title>
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/cherry.png">
	
	
  </head>
  <body class="bg-light">
    <body data-spy="scroll" data-target="#ftco-navbar-spy" data-offset="0">
    <div class="site-wrap">
      
      <nav class="site-menu" id="ftco-navbar-spy">
        <div class="site-menu-inner" id="ftco-navbar">
          <?php echo $nav;?>
        </div>
      </nav>
      <header class="site-header">
        <div class="row align-items-center">
          <div class="col-5 col-md-3">
             
          </div>
          <div class="col-2 col-md-6 text-center site-logo-wrap">
            <a href="index.php" class="site-logo">L</a>
          </div>
          <div class="col-5 col-md-3 text-right menu-burger-wrap">
            <a href="#" class="site-nav-toggle js-site-nav-toggle"><i></i></a>
          </div>
        </div>
       
      </header> <!-- site-header -->
<br/><br/><br/>
<?php
if(isset($_POST['new']) && $_POST['new']==1)
{
$msg="";
$id=$_REQUEST['id'];
$name = $_REQUEST['name'];
$ingredients =$_REQUEST['ingredients'];
$category = $_REQUEST['category'];
$event_date = $_REQUEST['event_date'];
$start_time = $_REQUEST['time_from'];
$end_time = $_REQUEST['time_to'];
$location = $_REQUEST['location'];
$price = $_REQUEST['price'];
$update="UPDATE recipes SET ingredients='".$ingredients."', name='".$name."', category='".$category."', time_from='".$start_time."', time_to='".$end_time."', location='".$location."', price='".$price."' WHERE recipe_id='".$id."'";
$final = mysqli_query($db, $update) or die(mysqli_error());
if($final){
header("Location: profile.php");
} else{
	$msg= "An error occurred";
}
}else {
?>
<div>
<center>
<form method="POST" action="">
<fieldset style="width: 35%; border: 1px #CC947C solid; padding:20px;">
	   <legend style="color: #CC947C; text-align:center;">Update Recipe Event</legend>
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['recipe_id'];?>" />
<label for="name">New Name: </label><input type="text" name="name" class="form-control" required value="<?php echo $row['name'];?>" />
<label for="ingredients">New Ingredients: </label><input type="text" name="ingredients" class="form-control"  required value="<?php echo $row['ingredients'];?>" />
<label for="category">New Category: </label><select required name="category" class="form-control">
				<option style="font-weight: bold; color: grey;" value="<?php echo $row['category']?>">Current: <?php echo $row['category']?></option>
				<option value="Breakfast">Breakfast</option>
				<option value="Brunch">Brunch</option>
				<option value="Lunch">Lunch</option>
				<option value="Dinner">Dinner</option>
			</select>
<label for="event_date">New Date: </label><input required class="form-control" name="event_date" type="date" value="<?php echo $row['event_date'];?>"/>
<label for="time_from">New Start Time: </label><input required class="form-control" name="time_from" type="time" value="<?php echo $row['time_from'];?>"/>
<label for="time_to">New Ending Time: </label><input required class="form-control" name="time_to" type="time" value="<?php echo $row['time_to'];?>"/>
<label for="location">New Location: </label><textarea required class="form-control" name="location" cols="30" rows="3" class="form-control" ><?php echo $row['location'];?></textarea>
<label for="price">New Price: (Kshs)</label><input required class="form-control" name="price" type="number" value="<?php
echo $row['price'];?>"/><br/>
<input style="width:40%;" class="btn btn-secondary btn-outline-secondary btn-block" name="submit" type="submit" value="Update" />
</fieldset>
</form>
<?php } ?>
</center>
</div>
</div>
<br/>
<!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#CC947C"/></svg></div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>    
    <script src="js/aos.js"></script>    
    <script src="js/main.js"></script>
</body>
</html>