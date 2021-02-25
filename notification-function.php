<?php
function send_sms_user($mobile, $name, $message, $subject) {
  
  global $mycon;
	  
	$reciever_mobile = $mobile;

	$reciever_name = $name;
					 
    $smstext = $message;
	
	$subject = $subject;

	$authKey = "323750ASJWd3MVG5e70d242P1";

	$mobileNumber = $reciever_mobile;
	//$mobileNumber = 9871404378;

	//$senderId = $sender_id;
	$senderId = 'HIMADI';

	$message = urlencode($smstext);

	$route = 4;
	//$route = "default";
	//Eg: route=1 for promotional, route=4 for transactional SMS.
	
	$Unicode=1;
	
	$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobileNumber,
		'message' => $message,
		'sender' => $senderId,
		'unicode' => $Unicode,
		'route' => $route
	);
	
	//echo "<pre>"; print_r($postData); die;

	//API URL
	$url="http://api.msg91.com/api/sendhttp.php";

	// init the resource
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		//,CURLOPT_FOLLOWLOCATION => true
	));


	//Ignore SSL certificate verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


	//get response
	$output = curl_exec($ch);

	//Print error if any
	if(curl_errno($ch))
	{
		$msgerror= 'error:' . curl_error($ch);
	}

	curl_close($ch);

		/*$sql2 = "INSERT INTO sms_notifications (name, mobile, subject, message) VALUES ('$reciever_name', '$reciever_mobile', '$subject', '$message')"; 
		$result2 = mysqli_query($mycon, $sql2);
		if($result2) { */
		if($output) {
		    return true;
		  } else {
			return false;
		  }		
}

function send_email_user($from_name, $sender, $to, $subject, $message){
	
	    global $mycon;
	
        $from = $sender;

		$headers = 'From: ' . $from . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


		
		$sendemail = mail($to, $subject, $message, $headers); //utf-8

		/*$sql2 = "INSERT INTO email_notifications (name, email, subject, message) VALUES ('$reciever_name', '$email', '$subject', '$message')"; 
		$result2 = mysqli_query($mycon, $sql2);
		if($result2) { */
		if($sendemail) { 
			return true;
		  } else {
			return false;
		  }	
}

function send_sms_admin($mobile, $name, $message, $subject) {
  
  global $mycon;
	  
	$reciever_mobile = $mobile;

	$reciever_name = $name;
					 
    $smstext = $message;
	
	$subject = $subject;

	$authKey = "323750ASJWd3MVG5e70d242P1";

	$mobileNumber = $reciever_mobile;
	//$mobileNumber = 9871404378;

	//$senderId = $sender_id;
	$senderId = 'HIMADI';

	$message = urlencode($smstext);

	$route = 4;
	//$route = "default";
	//Eg: route=1 for promotional, route=4 for transactional SMS.
	
	$Unicode=1;
	
	$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobileNumber,
		'message' => $message,
		'sender' => $senderId,
		'unicode' => $Unicode,
		'route' => $route
	);
	
	//echo "<pre>"; print_r($postData); die;

	//API URL
	$url="http://api.msg91.com/api/sendhttp.php";

	// init the resource
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		//,CURLOPT_FOLLOWLOCATION => true
	));


	//Ignore SSL certificate verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


	//get response
	$output = curl_exec($ch);

	//Print error if any
	if(curl_errno($ch))
	{
		$msgerror= 'error:' . curl_error($ch);
	}

	curl_close($ch);

		if($output) {
		    return true;
		  } else {
			return false;
		  }		
}

function send_email_admin($from_name, $sender, $to, $subject, $message){
	
	    global $mycon;
	
        $from = $sender;

		$headers = 'From: ' . $from . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		
		$sendemail = mail($to, $subject, $message, $headers); //utf-8

		/*$sql2 = "INSERT INTO email_notifications (name, email, subject, message) VALUES ('$reciever_name', '$email', '$subject', '$message')"; 
		$result2 = mysqli_query($mycon, $sql2);
		if($result2) { */
		if($sendemail) { 
			return true;
		  } else {
			return false;
		  }	
}

function send_notification($user_id, $title, $notification_message, $type){
	$sql2 = "INSERT INTO sms_notifications (user_id, title, notification_message, type) VALUES ('$user_id', '$title', '$notification_message', '$type')"; 
		$result2 = mysqli_query($mycon, $sql2);
		if($result2) {
			return true;
		  } else {
			return false;
		  }	
}

function sanitize_my_email($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
    }

?>
