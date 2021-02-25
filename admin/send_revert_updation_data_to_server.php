<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$revert_date = $all_data_exp[0];
$revert_to = $all_data_exp[1];
$revert_remark = $all_data_exp[2];
$update_id = $all_data_exp[3];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `recicved_letter` SET `revert_date`='$revert_date',revert_to='$revert_to',revert_remark = '$revert_remark', revert_status= '1' WHERE id = '".$update_id."'";
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
