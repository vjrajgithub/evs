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
$client_code = $_GET['client_name'];
$personalData = $_GET['personalData'];
$type_of_check = $_GET['type_of_check'];
$case_id = $_GET['case_id'];
$case_record_date = $_GET['case_record_date'];
$application_status = $_GET['application_status'];
$client_id = $_GET['client_id'];


function mail_verification_report($to, $subject, $message, $headers){
    mail($to,$subject,$message,$headers);
}



// function get_client_name($client_id, $mycon){



//   $query = "SELECT `customer_name` FROM customer_master where customer_status = '1' and customer_id='".$client_id."'  order by customer_name";
//   $result = mysqli_query($mycon, $query);
  
//   if (mysqli_num_rows($result) > 0) {
//     $rows = mysqli_fetch_assoc($result);
//     return $rows['customer_name'];
//   }
  


// }

$clientData = get_himadiData($client_code); 
$sender = "EVS-Software@himadi.in";
$client_name = $clientData['customer_name'];
$client_phone = $clientData['phone_number'];
$client_email = $clientData['email'];

$customer_code = 'HIMADI0001';
$himadiData = get_himadiData($customer_code);
$himadi_phone = $himadiData['phone_number'];
$himadi_email = $himadiData['email'];
// $himadi_sending_email[0] = explode(",",$himadi_email);

$subject_client = "Verification Report| Application Id:". $application_id." | Report Date:". date("d-m-Y h-i-s") ."";

$messageclient = "
<html>
<head>
<title></title>
</head>
<body>
<p>Dear Associate Partner ($client_code - ".$client_name.")</>
<p>Greeting from Himadi Solutions!</p>
<p>The verification report is ready with information.</p>

<br/>
<p> Details of Application:</p>
<table>
<tr>
               <th>Application Id</th>
               <td>:</td>
               <td>". $application_id."</td>
</tr>
<tr>
               <th>Case Id</th>
               <td>:</td>
               <td>". $case_id."</td>
</tr>
<tr>
               <th>Case Rec Date</th>
               <td>:</td>
               <td>". date('d-m-Y',strtotime($case_record_date)) ."</td>
</tr>
<tr>
               <th>Himadi ID</th>
               <td>:</td>
               <td>".$hmds_id."</td>
</tr>
<tr>
               <th>Applicant Name</th>
               <td>:</td>
               <td>". $personalData."</td>
</tr>

</table>



<a title='Report Download' href=\"".baseUrl()."verification-report-sheet-print.php?appid=" . $application_id ."\" target='_blank'>click here for Verification Report</a>
 
<p>Thanks and Regards</p>
<p>
Team,<br>
Himadi Solutions Pvt Ltd.<br>
H-3 block , DDA LAL MARKET<br>
Off Number- 202, 2nd floor<br>
Vikas Puri New Delhi-110018<br>
Board - 011- 47702200 : Mob- 08826697345<br>
Ext- 202 : Dir: +91-11-47702202 & 47510333<br>
</p>
</body>
</html>
";

$messagehimadi = "
<html>
<head>
<title></title>
</head>
<body>
<p>Dear Team</>
<p>Greeting!</p>
<p>The verification report is ready with information.</p>

<br/>
<p> Details of Application:</p>
<table>
<tr>
               <th>Application Id</th>
               <td>:</td>
               <td>". $application_id."</td>
</tr>
<tr>
               <th>Case Id</th>
               <td>:</td>
               <td>". $case_id."</td>
</tr>
<tr>
               <th>Case Rec Date</th>
               <td>:</td>
               <td>". date('d-m-Y',strtotime($case_record_date))."</td>
</tr>
<tr>
               <th>Himadi ID</th>
               <td>:</td>
               <td>".$hmds_id."</td>
</tr>
<tr>
               <th>Applicant Name</th>
               <td>:</td>
               <td>". $personalData."</td>
</tr>

</table>



<a title='Report Download' href=\"".baseUrl()."verification-report-sheet-print.php?appid=" . $application_id ."\" target='_blank'>click here for Verification Report</a>
 
<p>Thanks and Regards</p>
<p>
Team,<br>
Himadi Solutions Pvt Ltd.<br>
H-3 block , DDA LAL MARKET<br>
Off Number- 202, 2nd floor<br>
Vikas Puri New Delhi-110018<br>
Board - 011- 47702200 : Mob- 08826697345<br>
Ext- 202 : Dir: +91-11-47702202 & 47510333<br>
</p>
</body>
</html>
";

$client_message ="Dear $client_code - ".$client_name.", 

The verification report is ready with information.-

Report Link: href=\"".baseUrl()."verification-report-sheet-print.php?appid=" . $application_id ."\" ,

Application Id:".$application_id.",
Case Id: ".$case_id."
Case Date: ".date('d-m-Y',strtotime($case_record_date))."
Applicant Name: ".$personalData."

--
Thanks,
Himadi Solution";
                         
 $admin_message ="Hello Team, 

The verification report is ready with information.-

Report Link: href=\"".baseUrl()."verification-report-sheet-print.php?appid=" . $application_id ."\" ,

Application Id:".$application_id.",
Case Id: ".$case_id."
Case Date: ".date('d-m-Y',strtotime($case_record_date))."
Applicant Name: ".$personalData."

--
Thanks,
Himadi Solution";

$sms_notification_to_client = send_sms_user($client_phone, $client_name, $client_message, $subject);

$email_notification_to_client = send_email_user($client_name, $sender, $client_email, $subject, $messageclient);

$sms_notification_to_admin = send_sms_admin($himadi_phone, $client_name, $admin_message, $subject);

$email_notification_to_admin = send_email_admin($client_name, $sender, $himadi_email, $subject, $messagehimadi);

echo "<br/> SMS to Client <br/>".$client_message."<br/><br/>";
echo "<br/> SMS to Admin <br/>".$admin_message."<br/><br/>";
echo "<br/> Email to Client <br/>".$messageclient."<br/><br/>";
echo "<br/> Email to Client <br/>".$messagehimadi."<br/><br/>";
// header('Location: ' . $_SERVER['HTTP_REFERER']);
// exit;

?>
