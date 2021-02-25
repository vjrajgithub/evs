<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$application_status = $all_data_exp[0];
$update_id = $all_data_exp[1];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `tbl_application` SET `application_status`='$application_status' WHERE application_ref_id = '".$update_id."'";
        //  echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

}else{
    echo '2';    
} 
//echo $query;	
