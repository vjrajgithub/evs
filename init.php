<?php

//Start our session.
session_start();

//Expire the session if user is inactive for 30
//minutes or more.
//$expireAfter = 15;

/* if (isset($_SESSION['last_action'])) {

  //Figure out how many seconds have passed
  //since the user was last active.
  $secondsInactive = time() - $_SESSION['last_action'];

  //Convert our minutes into seconds.
  $expireAfterSeconds = $expireAfter * 60;

  //Check to see if they have been inactive for too long.
  if ($secondsInactive >= $expireAfterSeconds) {
  //User has been inactive for too long.
  //Kill their session.
  session_unset();
  session_destroy();

  header('location: index.php');
  }
  } */

//Assign the current timestamp as the user's
//latest activity

$_SESSION['last_action'] = time();

require_once 'admin/helpers/dbconn.php';
$dbConn = new DatabaseConn();
$mycon = $dbConn->getConnection();
if (!$mycon) {
  die("Connection failed: " . mysqli_connect_error());
}

require_once 'users.php';
require_once 'notification-function.php';

$userdata = getUserDataByUserId($_SESSION['id']);
$userid = $userdata['id'];

$customerdata = getcustomerById($userdata['client_id']);
$customername = $customerdata['customer_name'];
$customercode = $customerdata['customer_code'];

$customer_code = 'HIMADI0001';
$himadiData = get_himadiData($customer_code);
$himadiEmail = $himadiData['email'];

function get_client_name($mycon, $client_id) {
  $sql_query1 = "SELECT customer_name FROM customer_master WHERE customer_id ='" . $client_id . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $customer_nm = $row1['customer_name'];
    }
  }
  return $customer_nm;
}

function baseUrl() {
  define('BASE_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
  $base = "https://" . $_SERVER['HTTP_HOST'];
  $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
  return $base;
}

?>