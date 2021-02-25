<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$delivery_date = $all_data_exp[0];
$reciver_name = $all_data_exp[1];
$reciver_phone = $all_data_exp[2];
$reciver_post = $all_data_exp[3];
$reciver_remark = $all_data_exp[4];
$update_id = $all_data_exp[5];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `send_letter` SET `delievered_date`='$delivery_date',receivers_name='$reciver_name',receivers_phone = '$reciver_phone', receivers_post = '$reciver_post',receiver_remark ='$reciver_remark', delivered_status= '1' WHERE id = '".$update_id."'";
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
