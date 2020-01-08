<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI'];
include('db.php');
require("auth.php");
include('settings.php');
$user = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE user_id = $user";
$resultt = mysqli_query($db, $sql) or die (mysqli_error());
$hold = mysqli_fetch_assoc($resultt);
?>
<html>
<head>
<title>Profile</title>
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
<br/>
<div class="section bg-light" id="section-menu" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h3 class="heading mb-3"><?php echo ucfirst($hold['name']);?>'s Menu</h3>
				<hr style="width:30%;"/>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel">
				  <?php
                  $count=1;
                  $query="SELECT * FROM recipes WHERE user_id = $user ORDER BY recipe_id desc;";
                  $result = mysqli_query($db,$query) or die (mysqli_error());
				  if (mysqli_num_rows($result)==0) {
					  echo "<br/><br/><center><span style='color: #CC947C; font-weight: bold;'>No recipe events yet</span></center>";
					  echo "<center><span>Host first event?</span> <a href= 'upload.php'>Do it now</a></center>";
				  } 
				  else {
                  while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="d-block d-md-flex menu-food-item">
                      <div class="text order-1 mb-3">
                        <img src="<?php echo "uploads/".$row['image'].""?>"/>
                        <u><h3 style="font-family: 'Yeon Sung', cursive; font-size: 26px; color: black;"><?php echo $row['name']; ?> Event</h3></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$row['ingredients'];echo ucwords(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $row['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $row['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($row['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($row['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo $row['location']; ?></p>
						<center><p style="display: inline;"><u><a style="color:#CC947C;" href="comments.php?id=<?php echo $row["recipe_id"]; ?>">Analysis</a></u><strong>|</strong><u><a style="color:#CC947C;" href="update.php?id=<?php echo $row["recipe_id"]; ?>">Update</a></u><strong>|</strong><u><a style="color:#CC947C;" href="delete.php?id=<?php echo $row["recipe_id"]; ?>">Delete</a></u></p></center>
                      </div>
                      <div class="price order-2">
                        <strong>Kshs.<?php echo $row['price'];?></strong>							
                      </div>  
                    </div> <!-- .menu-food-item -->
				  <?php $count++; } }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
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