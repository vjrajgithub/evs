<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}


$data = $_GET['data'];
$all_data_exp = explode("~", $data);


$customer_name = $all_data_exp[0];
$customer_code = $all_data_exp[1];
$concerned_person = $all_data_exp[2];
$phone_number = $all_data_exp[3];
$office_no = $all_data_exp[4];
$email = $all_data_exp[5];
$region = $all_data_exp[6];
$customer_group = $all_data_exp[7];
$gst_reg_number = $all_data_exp[8];
$company_name = $all_data_exp[9];
$country = $all_data_exp[10];
$state = $all_data_exp[11];
$city = $all_data_exp[12];
$pincode = $all_data_exp[13];
$address = $all_data_exp[14];
$update_id = $all_data_exp[15];




if($update_id!='' && $update_id!=0){
    $query ="UPDATE `customer_master` SET customer_code='$customer_code',customer_name='$customer_name',concerned_person='$concerned_person',country='$country',phone_number='$phone_number',office_no='$office_no',email='$email', state ='$state',city='$city',region='$region',customer_group='$customer_group',gst_reg_number='$gst_reg_number', company_name='$company_name', address1='$address', pincode='$pincode' WHERE customer_id = '".$update_id."'";
         // echo $query; die;	
          $result = mysqli_query($mycon, $query);
          
          if ($result){  
              echo '1';

          }else{
            echo '2';
        }

} else {
    
    $query = "INSERT into `customer_master` (customer_code,customer_name,concerned_person,country,phone_number,office_no,email,`state`,city,region,customer_group,gst_reg_number, company_name, address1, pincode)values('$customer_code','$customer_name','$concerned_person','$country','$phone_number','$office_no','$email','$state','$city','$region', '$customer_group', '$gst_reg_number','$company_name', '$address', '$pincode')
    ";
    $result = mysqli_query($mycon, $query);
if ($result) {
    echo '1';
    // echo $query; die;	
}else{
    echo '2';
}
}
//echo $query;	
