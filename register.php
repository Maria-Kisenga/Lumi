<?php
include "db.php";
include('settings.php');
if(isset($_POST['submit'])){
 $name = $_POST['name'];
 $phone = $_POST['phone'];
 $pwd = $_POST['password'];
 $password = password_hash($pwd, PASSWORD_DEFAULT);
 //echo strlen($password);
 $password = substr($password, 0, 60);
 $type = "user";
$qry=mysqli_query($db,"INSERT INTO users (name, phone, password, utype) VALUES ('$name', '$phone', '$password', '$type')");
if($qry){
	//echo "Success";
	header ("Location: login.php");
} else {
	echo "Invalid name or password";
 }
}
?>
<html>
<head>
	<title>Register</title>
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
<br/><br/><br/><br/><br/>
<center>
	<form method="POST" action="" >
		<fieldset style="width: 30%; border: 1px #CC947C solid; padding:20px;">
			<legend style="color: #CC947C; text-align:center;">Register Below</legend>
		<span class="required">*</span><label for="name">Name: </label><input class="form-control"type="text" name="name" required />
		<span class="required">*</span><label for="phone">Phone Number: </label><input class="form-control" type="number" name="phone" placeholder="e.g 07.." 
		oninput="javascript: 
		if (this.value.length > this.maxLength) 
			this.value = this.value.slice(0, this.maxLength);"
    type = "number" maxlength = "10"  required />
	<span class="required">*</span><label for="password">Password: </label><input class="form-control" type="password" name="password" required /><br/>
		<center>
                  <input type="submit" name="submit" class="btn btn-secondary btn-outline-secondary " value="Register"/>
			</center>
		</fieldset>
	</form>	
	<?php echo "<center><a href='login.php'>Login</a></center>"; ?>
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