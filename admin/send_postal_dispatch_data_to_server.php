<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$letter_send_date = $all_data_exp[0];
$application_id = $all_data_exp[1];
$case_id = $all_data_exp[2];
$client_name = $all_data_exp[3];
$candidate_name = $all_data_exp[4];
$postal_type_of_check = $all_data_exp[5];
$to_address = $all_data_exp[6];
$document_details = $all_data_exp[7];
$sender_name = $all_data_exp[8];
$consignment_no = $all_data_exp[9];
$postal_charges = $all_data_exp[10];
$consignment_date = $all_data_exp[11];
$sender_remark = $all_data_exp[12];
$update_id = $all_data_exp[13];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `send_letter` SET `letter_send_date`='$letter_send_date',client_name='$client_name',Type_of_Checks = '$postal_type_of_check',candidate_name ='$candidate_name', case_id= '$case_id', application_id ='$application_id', to_address = '$to_address', document_details = '$document_details', letter_sender_name ='$sender_name', consignment_no = '$consignment_no' , postal_charges = '$postal_charges' , consignment_date = '$consignment_date' , sender_remark = '$sender_remark' WHERE id = '".$update_id."'";
        //  echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

} else {
    
    $query = "INSERT into `send_letter` (letter_send_date,client_name,Type_of_Checks,candidate_name, case_id, application_id, to_address , document_details , letter_sender_name, consignment_no , postal_charges , consignment_date , sender_remark )values('$letter_send_date','$client_name','$postal_type_of_check' , '$candidate_name', '$case_id' , '$application_id' , '$to_address', '$document_details', '$sender_name' , '$consignment_no', '$postal_charges', '$consignment_date', '$sender_remark')
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
