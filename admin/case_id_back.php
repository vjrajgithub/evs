<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
   header('location: ../index.php');
}
 

$application_id = $_GET['application_id'];
$status = $_GET['status'];


if ($application_id != "" && $status == 1 ) {

    // echo "$country_name";
    // $country_id = get_country_id($mycon, $country_name);
    // echo "$country_id";
    
    $sql24 = "SELECT `case_id` FROM `tbl_application` WHERE application_ref_id = '".$application_id."'";
    // echo $sql24; die;
    $res = mysqli_query($mycon, $sql24);
    if(mysqli_num_rows($res) > 0 ){
        
        // $case_id_string = $rows['id'];    
        // $case_id_array = explode(",", $case_id_string);
        
        // // echo $row_toc['checkType']; die;
        
        $rows= mysqli_fetch_assoc($res);
        
        echo $rows['case_id'];
    
    
}
}


if ($application_id != "" && $status == 2 ) {
   

    $sql_query_validation = "SELECT ta.client_name as client_code, cm.customer_name as client_name ,CONCAT(ep.firstName,' ',ep.lastName)  as candidate_name from tbl_application ta, employee_personal_info_tbl ep, customer_master cm  WHERE 1=1  AND  ta.application_ref_id = ep.application_id AND  ta.client_id = cm.customer_id AND ta.application_ref_id ='".$application_id."'";


    //  echo $sql_query_validation; die;
     $result = mysqli_query($mycon, $sql_query_validation);
     if (mysqli_num_rows($result) > 0){
         $res = mysqli_fetch_array($result);
         $data = $res;
echo json_encode($data);
exit;

// echo "hello!!"; die;

}
}
