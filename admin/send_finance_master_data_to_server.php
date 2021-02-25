<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}



$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$amount = $all_data_exp[0];
$dd_no = $all_data_exp[1];
$dd_made_or_not = $all_data_exp[2];
$dd_date = $all_data_exp[3];
$dd_sent_date = $all_data_exp[4];
$dd_in_name_of = $all_data_exp[5];
$dd_for_remark = $all_data_exp[6];
$application_id = $all_data_exp[7];
$case_id = $all_data_exp[8];
$client_name = $all_data_exp[9];
$candidate_name = $all_data_exp[10];
$finance_type_of_check = $all_data_exp[11];
$update_id = $all_data_exp[12];



if($update_id!='' && $update_id!=0){
    $query ="UPDATE `finance_master` SET `amount`='$amount',dd_no='$dd_no',dd_made_or_not = '$dd_made_or_not',dd_date ='$dd_date', dd_sent_date= '$dd_sent_date', dd_in_name_of ='$dd_in_name_of', dd_for_remark = '$dd_for_remark' , client_name = '$client_name', Type_of_Checks = '$finance_type_of_check', candidate_name = '$candidate_name', case_id = '$case_id', application_id = '$application_id'  WHERE id = '".$update_id."'";
        //  echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

} else {
    
    $query = "INSERT into `finance_master` (amount ,dd_no , dd_made_or_not, dd_date, dd_sent_date, dd_in_name_of, dd_for_remark, client_name, Type_of_Checks, candidate_name, case_id, application_id  )values('$amount','$dd_no','$dd_made_or_not' , '$dd_date', '$dd_sent_date' , '$dd_in_name_of' , '$dd_for_remark', '$client_name', '$finance_type_of_check', '$candidate_name', '$case_id', '$application_id')
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
