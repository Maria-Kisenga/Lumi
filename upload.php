<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI']; 
require ("auth.php");
include('settings.php');
$user_id = $_SESSION['user_id'];
//var_dump($_SESSION);
include ('db.php');
$targetDir = "uploads/";
$fileName= basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir.$fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
if(isset($_POST['upload'])){
 if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
//get all submitted data from the form
$rec_name = $_POST['rec_name'];
//$ingredients = explode(PHP_EOL, $_POST["ingredients"]);
//$ing = trim($_POST['ingredients']); // remove the last \n or whitespace character $ingredients = nl2br($ing);
$ingredients = preg_replace('#\s+#', ', ',trim($_POST['ingredients']));
$ingredients = ucwords($ingredients);
$category = $_POST['category'];
$event_date = $_POST['event_date'];
$time_from = $_POST['time_from'];
$time_to = $_POST['time_to'];
$location = ucwords($_POST['location']);
$price = $_POST['price'];
$slots =$_POST['slots'];
$sql = "INSERT INTO recipes (user_id, name, image, ingredients, category, event_date, time_from, time_to, location, price, slots) VALUES ('$user_id', '$rec_name', '$fileName', '$ingredients', '$category', '$event_date', '$time_from', '$time_to', '$location', '$price', '$slots')";
mysqli_query($db, $sql) or die(mysqli_error());//store submitted values into database table: recipes
  
//move uploaded image into folder
if($sql){
    //echo "<script>alert('Recipe uploaded');</script>";
	header('Location: profile.php');
            }
}else {
	echo "<script>alert('An error occurred.Please try again later');</script>";
 }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Upload</title>
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
	  <br/><br/><br/><br/>
      <center>
	   <form method="POST" action="" enctype="multipart/form-data">
	   <fieldset style="width: 35%; border: 1px #CC947C solid; padding:20px;">
	   <legend style="color: #CC947C;">Upload Recipe Event</legend>
	   <span class="required">*</span> <label for="name">Photo of the Meal: </label><input class="form-control" type="file" name="file" required />
	   <span class="required">*</span> <label for="name">Name of the Meal: </label><input class="form-control" name="rec_name" type="text" required />
	   <span class="required">*</span><label for="name">Ingredients: </label><textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="10" class="form-control" required></textarea>
	   <span class="required">*</span> <label for="name">Category: </label><select class="form-control" name="category" required>
  <option value="Breakfast">Breakfast</option>
  <option value="Brunch">Brunch</option>
  <option value="Lunch">Lunch</option>
  <option value="Dinner">Dinner</option>
</select>
	   <span class="required">*</span> <label for="event_date">Event Date: </label><input class="form-control" name="event_date" type="date" required />
	   <span class="required">*</span> <label for="time_from">Start Time: </label><input class="form-control" name="time_from" type="time" required />
	   <span class="required">*</span> <label for="time_to">End Time: </label><input class="form-control" name="time_to" type="time" required /><br/>
	   <span class="required">*</span> <label for="slots">Number of people you can accommodate: </label><input class="form-control" name="slots" type="number" required /><br/>
	   <span class="required">*</span><label for="name">Location: </label><textarea class="form-control" name="location" id="location" cols="30" rows="3" class="form-control" placeholder="e.g. 336 Cucumber Estate, Salsa Road, Mombasa" required></textarea>
		  <span class="required">*</span> <label for="name">Price (Kshs): </label><input class="form-control" name="price" type="number" required /><br/>
	      <div><input style="width:40%;" class="btn btn-secondary btn-outline-secondary btn-block" type="submit" name="upload" value="Upload Recipe"/></div>  
</fieldset>		  
	   </form>
	   <br/>
	   </center>
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