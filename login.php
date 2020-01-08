<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require('db.php');
include('settings.php');
$status="";	
//If form submitted, insert values into the database.
if (isset($_POST['submit'])){
           $name = mysqli_real_escape_string($db,$_POST["name"]);  
           $password = mysqli_real_escape_string($db, $_POST["password"]);  
           $query = "SELECT * FROM users WHERE name = '$name'";  
           $result = mysqli_query($db, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                while($row = mysqli_fetch_array($result))  
                {  
			         $password = substr($password, 0, 60);
                     if(password_verify($password, $row["password"]))  
                     {  
                          //return true;  
                          $_SESSION['user_id'] = $row['user_id'];
                          if($row['utype']=="admin"){
		            header("Location: admin.php");
					exit();
	            }else{
		            //header("Location: profile.php");
					header('Location: '.$_SESSION['curl']);
					exit();
					}  
                     }  
                     else  
                     {  
                          //return false;  
                          $status = "<span style='color: red;'>Invalid name or password</span>";  
                     }  
                }  
           }  
           else  
           {  
                $status = "<span style='color: red;'>Invalid name or password</span>";  
           }	
}
?>
<html>
<head>
	<title>Login</title>
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
	<style>html, body, {position:fixed;top:0;bottom:0;left:0;right:0;}</style>
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
<center>
<br/><br/><br/><br/><br/>
	<form method="POST" action="" >
	<br/><br/>
  <fieldset style="width: 30%; border: 1px #CC947C solid; padding:20px;">
    <legend style="color: #CC947C; text-align:center;">Login Below</legend>
      <span class="required">*</span> <label for="name">Name: </label> <input class="form-control" type="text" name="name" required />
      <span class="required">*</span> <label for="password">Password: </label> <input class="form-control" type="password" name="password" required /> <br/>
      <input style="width: 25%;"type="submit" value="Login" name="submit" class="btn btn-secondary btn-outline-secondary " style="margin-left:10px; height:3em;"/>
   </fieldset>
   <?php echo $status;?>
   <br/>
   <center><a href='register.php'>Register</a></center>
 </form>
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