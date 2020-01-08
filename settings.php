<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!isset($_SESSION["user_id"])){
	  $nav = "<ul class='list-unstyled'>
            <li><a href='index.php#section-home'>Home</a></li>
			<li><a href='index.php#section-menu'>Events</a></li>
            <li><a href='index.php#section-services'>Services</a></li>
            <li><a href='index.php#section-contact'>Contact</a></li>
			<li><a href='upload.php'>Upload</a></li>
			<br/>
			<li><a href='profile.php' style = 'color: #CC947C; '>My Events</a></li>
			<li><a href='bookings.php' style = 'color: #CC947C; '>My Bookings</a></li>
          </ul>";
}
	else {
		$nav="<ul class='list-unstyled'>
		<li><a href='index.php#section-home'>Home</a></li>
		<li><a href='index.php#section-menu'>Events</a></li>
		<li><a href='index.php#section-services'>Services</a></li>
		<li><a href='index.php#section-contact'>Contact</a></li>
		<li><a href='upload.php'>Upload</a></li>
		<br/>
		<li><a href='profile.php' style = 'color: #CC947C; '>My Events</a></li>
		<li><a href='bookings.php' style = 'color: #CC947C; '>My Bookings</a></li>
		<br/>
		<li ><a href='logout.php'>Logout</a></li>
	  </ul>";
}
	?>