<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$remark_for_qc_done = $all_data_exp[0];
$approval_status = $all_data_exp[1];

$update_id = $all_data_exp[2];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `tbl_application` SET `qc_remark`='$remark_for_qc_done', qc_done_status='$approval_status', application_status='$approval_status'  WHERE application_ref_id = '".$update_id."'";
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
