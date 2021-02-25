<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
   header('location: ../index.php');
}
 

$application_id = $_GET['application_id'];
// $state_name = $_GET['state'];
// echo "$country_name";

function get_check_type($mycon, $type_check){
    $sql_query = "SELECT `checkType` FROM `type_of_check` WHERE id = '".$type_check."'";
    $ressult = mysqli_query($mycon, $sql_query);
    $row = mysqli_fetch_assoc($ressult);
    $check_type = $row['checkType'];
    return $check_type;

}




if ($application_id != "") {

    // echo "$country_name";
    // $country_id = get_country_id($mycon, $country_name);
    // echo "$country_id";
    
    $sql24 = "SELECT type_of_check FROM `tbl_application` WHERE application_ref_id = '".$application_id."'";
    $res = mysqli_query($mycon, $sql24);
    $row = mysqli_fetch_array($res);
    // $echo $row['type_of_check']; 
    $type_of_check_string = $row['type_of_check']; 
    // die;
    $type_of_check_array = explode(",",$type_of_check_string);
    // print_r($type_of_check_array);
    $sql_toc = "SELECT * FROM `type_of_check` WHERE id IN ('".$type_of_check_string."')";
    $res_toc = mysqli_query($mycon, $sql_toc);
    $row_toc = mysqli_fetch_array($res_toc);
    // echo $row_toc['checkType']; die;
    
    
    
    echo "< select id='type_of_check'  >";
    
    echo "<option value=''>";
    echo "Select";
    echo "</option>";
    foreach($type_of_check_array as $type_check) {

        echo "<option value='" . $type_check . "'>";
        echo get_check_type($mycon, $type_check);
        echo '</option>';
    }

    echo "</select>";



}

