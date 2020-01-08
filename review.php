<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI'];
include('db.php');
//require("auth.php");
include('settings.php');
$msg = "";
//$recipe = "SELECT recipe_id FROM recipes WHERE user_id = $user";
//if user adds comment
if(isset($_POST['add'])){
$id=$_REQUEST['id'];
$review = $_POST['review'];
$user = $_SESSION['user_id'];
 //echo $id;
 //echo $review;
$sql2 = "INSERT INTO reviews (recipe_id, review, user_id) VALUES ('$id', '$review', '$user')";
$result2 = mysqli_query($db, $sql2) or die (mysqli_error());
if($result2){
/* echo shell_exec("python /xampp/htdocs/lumi/model.py");
echo shell_exec("python /xampp/htdocs/lumi/api.py $review");
$sentiment = htmlspecialchars($_GET["sentiment"]); */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://192.168.100.27:12345/predict");
curl_setopt($ch, CURLOPT_POST, 1);
$reviewJson = json_encode(array('txt' => $review));
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('txt' => '$reviewJson')));
curl_setopt($ch, CURLOPT_POSTFIELDS, $reviewJson);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "txt=$review");
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
//handle json values
$dec = json_decode($server_output, true);
//print_r ($dec);echo "<br/>";
//print_r ($dec['probability']); echo "<br/>"; //associative array
//print_r (array_keys($dec)); echo "<br/>";
//$data = array();
//array_push($data,$dec);
foreach ($dec as $key => $v) {
    $label = current($v);
    $score =  end($v); 	
	$sql = "UPDATE reviews SET label='$label', score='$score' WHERE review='$review'";
	mysqli_query($db, $sql);
}
//$data[] = array('label' => '', 'score' => '');
/* foreach ($data as $array) {
    $sql  = "INSERT INTO reviews";
    $sql .= " (`".implode("`, `", array_keys($array))."`)";
    $sql .= " VALUES ('".implode("', '", $array)."') ";
    $result = mysqli_query($sql) or die(mysqli_error());
} */
} else{
	echo "An error occurred. Please try again later.";
 }
}
?>
<html>
<head>
<title>Event Details</title>
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
<style>
* {
  box-sizing: border-box;
justify-content: center;
}

/* Float four columns side by side */
.column {
  width: 30%;
  padding: 0 10px;
  display: table;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>
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

<!--event details-->
<?php
$id=$_REQUEST['id'];
$queryy = "SELECT * FROM recipes WHERE recipe_id='".$id."'"; 
$resultt = mysqli_query($db, $queryy) or die ( mysqli_error());
$row = mysqli_fetch_assoc($resultt); 
?>
 <div class="section bg-light" id="section-menu" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h3 class="heading mb-3">Event Details</h3>
				<hr style="width:30%;"/>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel">
                        <img style="max-width: 100px; max-height: 100px;" src="<?php echo "uploads/".$row['image'].""?>"/>
                        <u><a href="review.php?id=<?php echo $row['recipe_id'];?>" style="font-family: 'Yeon Sung', cursive; font-size: 25px; color: black;"><?php echo ucwords($row['name']); ?> Event</a></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$row['ingredients'];echo ucwords(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $row['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $row['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($row['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($row['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo ucwords($row['location']); ?></p>
                      </div>
                      <div class="price order-2" style="color:#CC947C;">
                        <strong>Kshs. <?php echo $row['price'];?></strong>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div> 			  
<!--comments-->
<hr/>	
<center>	
<?php
$id=$_REQUEST['id'];
$queryyyyyy = "SELECT * from reviews where recipe_id='".$id."'"; 
$result = mysqli_query($db, $queryyyyyy) or die (mysqli_error());
$holdddd = mysqli_fetch_assoc($result);
$comments = $holdddd['recipe_id'];
if(empty($comments)){
	echo $msg;
} else {
?>	
<h4 style="font-family: 'Yeon Sung', cursive; font-size: 26px; color: black;">Comments</h4>
<hr style="width:10%"/>
<br/>
<table border="1" style="border-collapse:collapse; width: 80%;">
<thead>
<tr style="border: 2px solid #CC947C; height: 2.2em; color: #CC947C; border-radius: 20px;">
<th ><strong>R.No</strong></th>
<th><strong>Review</strong></th>
</tr>
</thead>
<tbody>
<?php
$count=1;
$id=$_REQUEST['id'];
$query = "SELECT * from reviews where recipe_id='".$id."'"; 
$result = mysqli_query($db, $query) or die ( mysqli_error());
while($holddd = mysqli_fetch_assoc($result)) {
?>
<input name="id" type="hidden" value="<?php echo $holddd['recipe_id'];?>" />
<tr style="border: 2px solid #cccccc; height: 2.2em; border-radius: 20px;">
<td ><?php echo $count; ?></td>
<td><?php echo $holddd["review"]; ?></td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
<?php } ?>
<br/><br/>
<?php
if(!isset($_SESSION["user_id"])){
$queryyyy = "SELECT * from recipes where recipe_id='".$id."'"; 
$resulttt = mysqli_query($db, $queryyyy) or die (mysqli_error());
$hold = mysqli_fetch_assoc($resulttt); 
$recipe= $hold['recipe_id'];
//echo "11";
//echo $recipe;
//echo $row['event_date'];
    if(strtotime(date("Y-m-d")) > strtotime($hold['event_date'])) 
   {
	$msg = "<p>Be the first to comment<p/>";
	echo "<hr/>";
    echo "<u style='color: #CC947C;'><a href='login.php'>Login to Comment</a></u>";
   } 
    else 
	{
	$msg = "";
    echo "Come back and leave a comment about the food after you attend the event";
  }
} 
else{
?>
<form action="" method= "POST" style="width: 55%;">
<fieldset style="border: 1px #CC947C solid; padding:20px;">
	   <legend style="color: #CC947C; text-align:center;">Add Comment</legend>
    <input class="form-control" type="text" name="review" required placeholder="Your thoughts on the food?"/><input style="width:30%;" class="btn btn-secondary btn-outline-secondary btn-block" type="submit" name="add" value="+ Add" />
</fieldset>
</form>
<?php } ?>
<!--other events-->
<br/><br/>
<hr/>
<br/>
<center><h4 style="font-family: 'Yeon Sung', cursive; font-size: 27px; color: black;">Other Events</h4></center>
<hr/>
<br/>
<center>
<div class="row">
<?php
$num=1;
$queryyyyyyy="SELECT * FROM recipes ORDER BY event_date desc;";
$resulttttt = mysqli_query($db,$queryyyyyyy);
while($row = mysqli_fetch_assoc($resulttttt)) { ?>
  <div class="column">
    <div class="card">
      <center><img height="200" width="200" src="<?php echo "uploads/".$row['image'].""?>"/></center>
                        <u><a href="review.php?id=<?php echo $row['recipe_id'];?>" style="font-family: 'Yeon Sung', cursive; font-size: 24px; color: black;"><?php echo ucwords($row['name']); ?> Event</a></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$row['ingredients'];echo ucwords(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $row['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $row['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($row['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($row['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo ucwords($row['location']); ?> </p>
						<span style="color: #CC947C;"><strong>Kshs. <?php echo $row['price'];?></strong></span>
    </div>
  </div>
  <?php $num++; } ?>
</div>
</center>
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