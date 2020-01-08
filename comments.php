<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI'];
include('db.php');
require("auth.php");
include('settings.php');
//include ('password.php');
//$user = $_SESSION['user_id'];
//$user = $_SESSION['user_id'];
//$recipe = "SELECT recipe_id FROM recipes WHERE user_id = $user";
$id=$_REQUEST['id'];
$query = "SELECT * FROM reviews WHERE recipe_id='".$id."'"; 
$result = mysqli_query($db, $query) or die ( mysqli_error());
$pie = "<button style='background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;'><a class='btn btn-secondary btn-outline-secondary btn-block' style='font-size:10px;' href='chart.php?id=$id'>Pie Chart Summary</a></button>";
//$row = mysqli_fetch_assoc($result);
//$recipe = $row['review_id'];
?>
<html>
<head>
<title>Analysis</title>
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
<center><h3>Event Details</h3></center>
<hr style="width:15%;"/>
<?php
$id=$_REQUEST['id'];
$queryy = "SELECT * FROM recipes WHERE recipe_id='".$id."'"; 
$resultt = mysqli_query($db, $queryy) or die ( mysqli_error());
$hold = mysqli_fetch_assoc($resultt); 
?>
 <div style="width: 70%; margin-left: 100px;">
                      <div class="text order-1 mb-3">
                        <img style="max-width: 100px; max-height: 100px;" src="<?php echo "uploads/".$hold['image'].""?>"/>
                        <u><a style="font-family: 'Yeon Sung', cursive; font-size: 24px; color: black;"><?php echo $hold['name']; ?> Event</a></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$hold['ingredients'];echo ucfirst(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $hold['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $hold['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($hold['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($hold['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo $hold['location']; ?></p>
                      </div>
                      <div class="price order-2" style="color:#CC947C;">
                        <strong>Kshs. <?php echo $hold['price'];?></strong>
                      </div>  
                  </div>
				  <br/><br/>
<center>
<!--searched reviews-->
<div id="section-search">
<form action="#section-search" method= "POST" style="width:60%;">
				<fieldset style="width: 100%; border: 1px #CC947C solid; padding:20px;"> 
				<legend style="font-weight:bold;"></legend>
				<label for="name">Search by review category: </label>
<select class="form-control" name="text" required>
  <option value="positive">Positive</option>
  <option value="neutral">Neutral</option>
  <option value="negative">Negative</option>
</select>
				<input style="width:35%;" class="btn btn-secondary btn-outline-secondary btn-block" type="submit" name="search" value="Search"/>
				</fieldset>
				</form>
				<?php
if(isset($_POST['search']))
{
	$num=1;
    $label = $_POST['text'];
    $queryyyy = "SELECT * FROM reviews WHERE label = '".$label."' AND recipe_id='".$id."'";
    $resulttttt = mysqli_query($db, $queryyyy);
    if(mysqli_num_rows($resulttttt) > 0)
    {
		echo "<br/><h4 style='color: #CC947C; font-weight:bold;'>Search results for:</h4><br/>" .ucfirst($label);
		?>
	<table border="1" style="border-collapse:collapse; width: 80%;">
<thead>
<tr style="border: 2px solid #CC947C; height: 2.2em; color: #CC947C; border-radius: 20px;">
<th width="20%"><strong>C.No</strong></th>
<th width="80%"><strong>Review</strong></th>
</tr>
</thead>
<tbody>
<?php
while ($lb = mysqli_fetch_assoc($resulttttt)){
	echo "<hr"
		  ?>
<input name="id" type="hidden" value="<?php echo $lb['recipe_id'];?>" />
<tr style="border: 2px solid #cccccc; height: 2.2em; border-radius: 20px;">
<td><?php echo $count; ?></td>
<td><?php echo $lb["review"]; ?></td>
</tr>
<?php $num++; } ?>
</tbody>
</table>
<?php		
echo "<br/><hr/>";			  
      }  
    else {
        echo "Nothing found";
		echo "<br/><hr/>";
    }
}
?>
</div>
<!--all reviews-->
<h4 style="font-family: 'Yeon Sung', cursive; font-size: 24px; color: black;">All Reviews</h4>
<hr style="width:10%;"/>
<br/>
<table border="1" style="border-collapse:collapse; width: 80%;">
<thead>
<tr style="border: 2px solid #CC947C; height: 2.2em; color: #CC947C; border-radius: 20px;">
<th width="30%"><strong>C.No</strong></th>
<th width="70%"><strong>Review</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
//$recipe = $row['recipe_id'];
//$query="SELECT * FROM reviews WHERE review_id = $recipe ORDER BY review_id desc;";
//$result = mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result)) {
?>
<input name="id" type="hidden" value="<?php echo $row['recipe_id'];?>" />
<tr style="border: 2px solid #cccccc; height: 2.2em; border-radius: 20px;">
<td><?php echo $count; ?></td>
<td><?php echo $row["review"]; ?></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
<br/> <br/> 
<?php echo $pie;?>
</center>
<br/>
<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff7a5c"/></svg></div>
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