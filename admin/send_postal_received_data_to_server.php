<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$letter_recieved_date = $all_data_exp[0];
$purpose = $all_data_exp[1];
$client_name = $all_data_exp[2];
$application_id = $all_data_exp[3];
$from_address = $all_data_exp[4];
$document_details = $all_data_exp[5];
$consignment_no = $all_data_exp[6];
$consignment_date = $all_data_exp[7];
$receiver_name = $all_data_exp[8];
$receiver_phone = $all_data_exp[9];
$receiver_post = $all_data_exp[10];
$receiver_remark = $all_data_exp[11];
$update_id = $all_data_exp[12];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `recicved_letter` SET `letter_recieved_date`='$letter_recieved_date',purpose='$purpose',client_name = '$client_name',application_id ='$application_id', from_address= '$from_address', document_details ='$document_details', consignment_no = '$consignment_no', consignment_date = '$consignment_date', receivers_name ='$receiver_name', receivers_phone = '$receiver_phone' , receivers_post = '$receiver_post' , receiver_remark = '$receiver_remark' WHERE id = '".$update_id."'";
        //  echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

} else {
    
    $query = "INSERT into `recicved_letter` (letter_recieved_date,purpose, client_name,application_id, from_address, document_details, consignment_no , consignment_date , receivers_name, receivers_phone , receivers_post , receiver_remark )values('$letter_recieved_date','$purpose','$client_name' , '$application_id', '$from_address' , '$document_details' , '$consignment_no', '$consignment_date', '$receiver_name' , '$receiver_phone', '$receiver_post', '$receiver_remark')
    ";
    // echo $query; die;
    $result = mysqli_query($mycon, $query);
if ($result) {
    echo '1';
    // echo $query; die;	
}else{
    echo '2';
}
}
//echo $query;	
