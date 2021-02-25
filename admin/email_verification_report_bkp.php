<?php

require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
//pre($mycon);
$allData = getAllApplicationInformation($mycon);
// pre($allData);
$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

//Fetch data from role wised
//echo $ff = $userdata['id']; die;

if ($userdata['role'] == '2' || $userdata['role'] == '3') {
  $user_location = $userdata['org_id'];
  $user_client = $userdata['client_id'];
  $role_item = " AND organization_id = '" . $user_location . "'";
  $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
} else {
  $role_item = '';
  $loc_item = '';
}

$application_id = $_GET['appid'];
$hmds_id = $_GET['hmds_id'];
$client_name = $_GET['client_name'];
$personalData = $_GET['personalData'];
$type_of_check = $_GET['type_of_check'];
$case_id = $_GET['case_id'];
$case_record_date = $_GET['case_record_date'];
$application_status = $_GET['application_status'];


function mail_verification_report($to, $subject, $message, $headers){
    mail($to,$subject,$message,$headers);
}

$to = "vikas.s@seabird.co.in";
$subject = "verification report email check";

$message = "
<html>
<head>
<title>Dear (client-code-client name)</title>
</head>
<body>
<p>Greating from Himadi solutions!</p>
<p>The Verification report is ready with information.</p>
<br/>
<br/>
<p> Details of Application:</p>
<table>
<tr>
<th>HMDS id</th>
<th>Application id</th>
<th>Client Code</th>
<th>Applicant Name </th>
<th>Types of Checks</th>
<th>Case id</th>
<th>Case Record <br />Date</th>
<th>Status</th>
</tr>
<tr>
<td>".$hmds_id."</td>
                                  <td>". $application_id."</td>
                                  <td>". $client_name."</td>
                                  <td>". $personalData."</td>
                                  <td>". $type_of_check."</td>
                                  <td>". $case_id."</td>
                                  <td>". $case_record_date."</td>
                                  <td>".$application_status."</td>

</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <praveenkr724@gmail.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";


mail_verification_report($to, $subject, $message, $headers);


?>
