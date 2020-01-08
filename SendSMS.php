<?php
error_reporting(E_ALL);
require('db.php');
$id = $_REQUEST['id'];
//echo $id;
$query = "SELECT * FROM users WHERE booked = '".$id."'";
$result = mysqli_query($db, $query) or die(mysqli_error());
$hold = mysqli_fetch_assoc($result);
print_r ($hold);
$seat = $hold['booked'];
echo $seat;
$bookings = explode(',', $seat);		 
if(in_array($id, $bookings)){
	$phoneNumber = $hold['phone'];
	echo $phoneNumber;
//send the sms
try{
	$message = 'From+Lumi:%0AWhat+did+you+think+about+the+food?+Tell+us+now+at:+http://192.168.100.27/lumi/#section-menu';
	//$phoneNumber = '+254716937867';
	//$phoneNumber = '+254706111124';
	if($message !=null && $phoneNumber !=null){
		$url = "http://192.168.100.51:8090/SendSMS?username=Lumi&password=1234&phone=" . $phoneNumber . "&message=" . $message;
		$curl = curl_init($url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if($curl_response === false){
			$info = curl_getinfo($curl);
			curl_close($curl);
			die(var_export($info));
		}
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		$response  = json_decode($curl_response);
		print_r ($response);			
		if($httpCode == 200){
			echo 'Message sent';
			//header('Location: receiveSMS.php?'.$url);
		}else{			
			echo 'Technical Problem';
		}
	}
}catch(Exception $ex){
	//throw new Exception("Value must be 1 or below");
	echo $ex;
}
}
?>
<!--<a href='receiveSMS.php?<?php //echo $url?>'>Get Message</a>-->