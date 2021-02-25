<?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}

$hmds_id = $_GET['hmds_id'];
$applicationId = $_GET['applicationId'];
  $sql_query_validation="SELECT type_of_check FROM `tbl_application` WHERE id='".$hmds_id."' and id='".$applicationId."'";
      $result = mysqli_query($mycon, $sql_query_validation);
       if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {  
			 $data_new=$row['transporter_name'];			
		  }
		 }

	echo $data_new;
?>
