<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$_SESSION['curl'] = $_SERVER['REQUEST_URI'];
include('db.php');
//include("auth.php");
include('settings.php');
?>
<!doctype html>
  <head>
    <title>Lumi</title>
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
      <div class="main-wrap " id="section-home">
        <div class="cover_1 overlay bg-slant-white bg-light">
          <div class="img_bg" style="background-image: url(images/slider-2.jpg);" data-stellar-background-ratio="0.5">
            <div class="container">
              <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10" data-aos="fade-up">
                  <h2 class="heading mb-5" style="color:black;">Lumi Pop-up Restaurants</h2>
                  <p class="sub-heading mb-5" class="swing">Taking your restaurant business to the next level!</p>
                  <p><a href="#section-menu" class="smoothscroll btn btn-outline-white px-5 py-3">What's On The Menu?</a></p>
                </div>
              </div>
            </div>
          </div>
        </div> 		
		<!--Menu Section-->
        <div class="section bg-light" id="section-menu" data-aos="fade-up">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Events</h2>
<hr/>				
              </div>
            </div>            
			<div class="row justify-content-center">
              <div class="col-md-12">
				<!--search-->
				<center>
				<form action="#section-menu" method= "POST" style="width:70%;">
				<fieldset style="width: 100%; border: 1px #CC947C solid; padding:20px;"> 
				<legend style="font-weight:bold;"></legend>
				<label for="name">Search by meal category: </label>
<select class="form-control" name="text" required>
  <option value="Breakfast">Breakfast</option>
  <option value="Brunch">Brunch</option>
  <option value="Lunch">Lunch</option>
  <option value="Dinner">Dinner</option>
</select>
				<input class="btn btn-secondary btn-outline-secondary " type="submit" name="search" value="Search"/>
				</fieldset>
				</form>
<?php
if(isset($_POST['search']))
{
    $id = $_POST['text'];
    $queryyyy = "SELECT * FROM recipes WHERE category = '".$id."'";
    $resulttttt = mysqli_query($db, $queryyyy);
    if(mysqli_num_rows($resulttttt) > 0)
    {
		echo "<br/><h4 style='color: #CC947C; font-weight:bold;'>Search Results:</h4><br/>";
      while ($hold = mysqli_fetch_array($resulttttt))
      {
		?>
		<div class="text order-1 mb-3">
                        <img style="max-width: 100px; max-height: 100px;" src="<?php echo "uploads/".$hold['image'].""?>"/>
                        <u><a href="review.php?id=<?php echo $hold['recipe_id'];?>" style="font-family: 'Yeon Sung', cursive; font-size: 24px; color: black;"><?php echo $hold['name']; ?> Event</a></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$hold['ingredients'];echo ucfirst(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $hold['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $hold['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($hold['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($hold['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo $hold['location']; ?></p>
                      </div>
                      <div class="price order-2" style="color:#CC947C;">
                        <strong>Kshs <?php echo $hold['price'];?></strong>
                      </div>
<?php		
echo "<br/>";			  
      }  
    }
    else {
        echo "Nothing found";
    }
}
?>
				</center>
				<br/>
				<hr/>
		<center><h4 style='color: #CC947C; font-weight:bold;'>All Events</h4></center>
		<hr style="width: 20%;"/>
		<br/>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel">
				  <?php
                  $count=1;
                  $query="SELECT * FROM recipes ORDER BY event_date desc;";
                  $result = mysqli_query($db,$query);
                  while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="d-block d-md-flex menu-food-item">
                      <div class="text order-1 mb-3">
                        <img src="<?php echo "uploads/".$row['image'].""?>"/>
                        <u><a href="review.php?id=<?php echo $row['recipe_id'];?>" style="font-family: 'Yeon Sung', cursive; font-size: 27px; color: black;"><?php echo ucwords($row['name']); ?> Event</a></u>
                        <p><span style="color:#CC947C;" >Ingredients: </span><?php $ingredients = array();$ingredients[]=$row['ingredients'];echo ucwords(implode(', ', $ingredients)); ?><br/><span style="color:#CC947C;" >Category: </span><?php echo $row['category']; ?><br/><span style="color:#CC947C;" >Event Date: </span><?php echo $row['event_date']; ?><br/><span style="color:#CC947C;" >Start Time: </span><?php echo date("g:i a", strtotime($row['time_from']));?><br/><span style="color:#CC947C;" >End Time: </span><?php echo date("g:i a", strtotime($row['time_to']));?><br/><span style="color:#CC947C;" >Location: </span><?php echo $row['location']; ?> </p>
						<p style="display: inline;">
						<?php
$id = $row['recipe_id'];											
$sqll = "SELECT * FROM recipes WHERE recipe_id='".$id."'";
$resq = mysqli_query($db, $sqll) or die (mysqli_error());
$var = mysqli_fetch_assoc($resq);
$count_so_far = $var['booked'];
$total_guests = $var['slots'];
if (is_null($count_so_far)){$count_so_far=0;} else {$count_so_far=$count_so_far;}
//echo $count_so_far;
//echo $total_guests;
if(strtotime(date("Y-m-d")) > strtotime($row['event_date'])) {
	echo "";
} else {
if ($count_so_far < $total_guests) {
if(!isset($_SESSION['user_id'])) {
		echo "<button style='background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;'><u style='color: #CC947C; font-size:17px;'><a href='login.php'>Login to reserve a seat</a></u></button><br/>";
	} else {
?>
<form method="POST" action="book.php">
<input type="hidden" name ="id" value="<?php echo $row['recipe_id'];?>"/>
<button style='background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;'>
<input type="submit" name="book" class='btn btn-secondary btn-outline-secondary btn-block' style='font-size:10px;' class="form-control" id="reserve" value= 'Reserve a seat'/><a href="book.php?id=<?php echo $row['recipe_id'];?>"></a></button><span id="reserved" style="font-size:17px;"></span>
<?php 
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
}
?>
</form>
<?php
   }   
}  
else {
	echo "<span style='font-size:20px; font-weight: bold; color: blue'>Fully Booked</span>";
 }
}
if(strtotime(date("Y-m-d")) > strtotime($row['event_date'])) 
{
?>
<button style='background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;'><a class='btn btn-secondary btn-outline-secondary btn-block' style='font-size:10px;' href='review.php?id=<?php echo $row['recipe_id'];?>'>Leave a Comment</a></button>

<!--for admin to send messages-->
<?php 
if($_SESSION['user_id'] == 1) {
?>
<button style='background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;'><a class='btn btn-secondary btn-outline-secondary btn-block' style='font-size:10px;' href='SendSMS.php?id=<?php echo $row['recipe_id'];?>'>Send Reminder</a></button>
<?php } else {
	echo "";
}?>
<?php
} else {
	echo "";
}
?>
</p>
                      </div>
                      <div class="price order-2">
                        <strong>Kshs.<?php echo $row['price'];?></strong>
                      </div>  
                    </div> <!-- .menu-food-item -->
					<?php $count++; } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
		<!-- .section: services -->
        <div class="section bg-white services-section" data-aos="fade-up" id="section-services">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Services</h2>  
              </div>
            </div>
            <div class="row">
              <div class="col-m mb-5d-6 col-lg-4" data-aos="fade-up">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-soup"></span>
                  </div>
                  <div class="media-body">
                    <h3>Quality Cuisine</h3>
                    <p>High quality meals at throw-away prices</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
                    <span class="flaticon-tray"></span>
                  </div>
                  <div class="media-body">
                    <h3>Exotic Meals</h3>
                    <p>Never before seen recipes for adventurous eaters</p>
                  </div>
                </div>
              </div>			  
              <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="300">
                <div class="media feature-icon d-block text-center">
                  <div class="icon">
				  <br>
                    <img src="images/pie.png"/>
                  </div>
                  <div class="media-body">
                    <h3>Sentiment Analysis</h3>
                    <p>Get to know exactly what your customers think and feel</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
		<!-- .section: contact -->
        <div class="section" data-aos="fade-up" id="section-contact">
          <div class="container">
            <div class="row section-heading justify-content-center mb-5">
              <div class="col-md-8 text-center">
                <h2 class="heading mb-3">Get In Touch</h2>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-10 p-5 form-wrap">
                <form action="#section-contact" method="POST">
                  <div class="row mb-4">
                    <div class="form-group col-md-6">
                      <label for="name" class="label">Name:</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-person"></span>
                        <input type="text" class="form-control" id="name" name="name">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone" class="label">Phone:</label>
                      <div class="form-field-icon-wrap">
                        <span class="icon ion-android-call"></span>
						<input type="number" name="phone" class="form-control" value="+254" 
		oninput="javascript: 
		if (this.value.length > this.maxLength) 
			this.value = this.value.slice(0, this.maxLength);"
    type = "number" maxlength = "13"  required />
                      </div>
                    </div>
                   <div class="form-group col-md-12">
                      <label for="message" class="label">Message:</label>
                     <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                   </div>
                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-4">
                      <input type="submit" name="submit" class="btn btn-secondary btn-outline-secondary btn-block" value="Send Message">
                    </div>
                  </div>
                </form>
						<?php	
if(isset($_POST['submit'])){
 $name = $_POST['name'];
 $phone = $_POST['phone'];
 $message = $_POST['message'];
$qry=mysqli_query($db,"INSERT INTO contact (name, phone, message) VALUES ('$name', '$phone', '$message')");
if($qry){
	echo  "<br/><center><span style='color:blue;'>Message received. We will get back to you shortly</span></center>";
	//header("Location: index.php#section-contact");
} else {
	echo  "<br/><center><span style='color:red;'>An error occurred. Please try again later</span></center>";
	//header("Location: index.php#section-contact");
 }
}
?>
              </div>
            </div>
         </div>
        </div> <!-- .section -->
        <footer class="ftco-footer">          
              <div class="col-md-12 text-center">
                <p>&copy; 2019</p>
              </div>     
        </footer>    
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