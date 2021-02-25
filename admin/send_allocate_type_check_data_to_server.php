<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}


$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$user_id = $all_data_exp[0];
$application_id = $all_data_exp[1];
$allocate_type_of_check = $all_data_exp[2];
$created_at = $all_data_exp[3];
$update_id = $all_data_exp[4];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `case_allocate` SET `user_id`='$user_id',application_id='$application_id',allocate_type_of_check='$allocate_type_of_check',created_at='$created_at' WHERE customer_id = '".$update_id."'";
         // echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

} else {
    
    $query = "INSERT into `case_allocate` (user_id,application_id,allocate_type_of_check)values('$user_id','$application_id','$allocate_type_of_check')
    ";
    $result = mysqli_query($mycon, $query);
    // echo $query; die;
if ($result) {
    echo '1';
    // echo $query; die;	
}else{
    echo '2';
}
}
//echo $query;	
