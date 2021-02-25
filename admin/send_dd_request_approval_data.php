<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$remark_for_aproval = $all_data_exp[0];
$approval_status = $all_data_exp[1];

$update_id = $all_data_exp[2];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `finance_master` SET `remark_approval`='$remark_for_aproval',approval_status='$approval_status' WHERE id = '".$update_id."'";
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
