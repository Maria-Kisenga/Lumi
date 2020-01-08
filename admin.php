<?php
include('db.php');
//require("auth.php");
?>
<!doctype html>
  <head>
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700,800|Open+Sans:300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="css/aos.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
    <link rel="stylesheet" type="text/css" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/font/flaticon.css">
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="images/cherry.png">
  </head>
  <body class="bg-light">
    <body data-spy="scroll" data-target="#ftco-navbar-spy" data-offset="0">
    <div class="site-wrap">
      <nav class="site-menu" id="ftco-navbar-spy">
        <div class="site-menu-inner" id="ftco-navbar">
          <ul class="list-unstyled">
            <li><a href="index.php#section-home">Home</a></li>
			<li><a href="index.php#section-menu">Menu</a></li>
            <li><a href="index.php#section-services">Services</a></li>
            <li><a href="index.php#section-contact">Contact</a></li>
			<br/>
			<li ><a href="logout.php" style = "color: #CC947C; " >Logout</a></li>
          </ul>
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
		</div>
      </header> <!-- site-header -->
	  <br/><br/><br/>
	  
	  <center><h4>All Records</h4><br/>
	  <div>
<h5>Users</h5>

<table width="80%" border="1" style="border-collapse:collapse;">
<thead>
<tr style = "color: #CC947C; ">
<th><strong>U.No</strong></th>
<th><strong>Name</strong></th>
<th><strong>Phone</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$query="SELECT * FROM users ORDER BY user_id desc;";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["phone"]; ?></td>
<td><a href="user_delete.php?id=<?php echo $row["user_id"]; ?>">Delete</a></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
<br /><br />
</div>
<!--recipes-->
<div>
<h5><i>Recipes</i></h5>
<table width="80%" border="1" style="border-collapse:collapse;">
<thead>
<tr style = "color: #CC947C; ">
<th><strong>R.No</strong></th>
<th><strong>Name</strong></th>
<th><strong>User ID</strong></th>
<th><strong>Image</strong></th>
<th><strong>Ingredients</strong></th>
<th><strong>Category</strong></th>
<th><strong>Event Date</strong></th>
<th><strong>Start Time</strong></th>
<th><strong>End Time</strong></th>
<th><strong>Location</strong></th>
<th><strong>Price</strong></th>
<th><strong>Slots</strong></th>
<th><strong>Send Message</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$query="SELECT * FROM recipes ORDER BY recipe_id desc;";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo ucwords($row["name"]); ?></td>
<td><?php echo $row["user_id"]; ?></td>
<td><?php echo "uploads/".$row['image'].""?></td>
<td><?php $ingredients = array();$ingredients[]=$row['ingredients'];echo ucwords(implode(', ', $ingredients)); ?></td>
<td><?php echo $row['category']; ?></td>
<td><?php echo $row['event_date']; ?></td>
<td><?php echo date("g:i a", strtotime($row['time_from']));?></td>
<td><?php echo date("g:i a", strtotime($row['time_to']));?></td>
<td><?php echo ucwords($row['location']); ?></td>
<td><?php echo $row['price'];?></td>
<td><?php echo $row['slots'];?></td>
<?php if(strtotime(date("Y-m-d")) > strtotime($row['event_date'])) { ?>
<td align="center"><a href="SendSMS.php?id=<?php echo $row['recipe_id'];?>">Send Reminder SMS</td>
<?php } else 
{ ?>
	<td></td>
<?php }?>
<td align="center"><a href="recipe_delete.php?id=<?php echo $row["recipe_id"]; ?>">Delete</a></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
<br /><br />
<!--reviews-->
<div>
<h5>Reviews</h5>
<table width="80%" border="1" style="border-collapse:collapse;">
<thead>
<tr style = "color: #CC947C; ">
<th><strong>Re.No</strong></th>
<th><strong>Recipe ID</strong></th>
<th><strong>User ID</strong></th>
<th><strong>Review</strong></th>
<th><strong>Sentiment</strong></th>
<th><strong>Score</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$query="SELECT * FROM reviews ORDER BY review_id desc;";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $row["recipe_id"]; ?></td>
<td><?php echo $row["user_id"]; ?></td>
<td><?php echo $row["review"]; ?></td>
<td><?php echo $row["label"]; ?></td>
<td><?php echo $row["score"]; ?></td>
<td align="center"><a href="review_delete.php?id=<?php echo $row["review_id"]; ?>">Delete</a></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
<br /><br />
<!--contact-->
<div>
<h5>Messages</h5>
<table width="80%" border="1" style="border-collapse:collapse;">
<thead>
<tr style = "color: #CC947C; ">
<th><strong>C.No</strong></th>
<th><strong>Name</strong></th>
<th><strong>Phone</strong></th>
<th><strong>Message</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$query="SELECT * FROM contact ORDER BY contact_id desc;";
$result = mysqli_query($db,$query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["name"]; ?></td>
<td align="center"><?php echo $row["phone"]; ?></td>
<td align="center"><?php echo $row["message"]; ?></td>
<td align="center"><a href="contact_delete.php?id=<?php echo $row["contact_id"]; ?>">Delete</a></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
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