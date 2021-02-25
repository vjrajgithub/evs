<?php 

require_once 'init.php'; 

$userdata = getUserDataByUserId($_SESSION['id']);
$userid = $userdata['id'];

logout($userid, $mycon);
	
 ?>