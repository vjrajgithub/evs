<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
   header('location: ../index.php');
}
 

$country_name = $_GET['country'];
$state_name = $_GET['state'];
// echo "$country_name";

function get_state_id($mycon, $state){
    if(is_numeric($state)){
        return $state;

    }else{
        $sql_query = "select state_id from states where state_name ='".$state."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $state_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $state_id = $row['state_id'];
            
        }
        return $state_id;
}



function get_country_id($mycon, $country_name)
{
    if(is_numeric($country_name)){
        return $country_name;
    }
    $sql_query = "SELECT * FROM `countries`";
    $ressult = mysqli_query($mycon, $sql_query);
    while ($row = mysqli_fetch_assoc($ressult)) {
        if ($row['country_name'] == $country_name) {
            return $row['country_id'];
        }
    }
}


if ($country_name != "") {

    // echo "$country_name";
    $country_id = get_country_id($mycon, $country_name);
    // echo "$country_id";

    $res = mysqli_query($mycon, "select * from states where country_id = $country_id");
    // echo "<select id='state' onchange='change_state()'>";

    echo "<option value=''>";
    echo "Select";
    echo "</option>";
    while ($row = mysqli_fetch_array($res)) {


        echo "<option value='" . $row['state_name'] . "'>";
        echo $row['state_name'];
        echo '</option>';
    }

    // echo "</select>";



}



if ($state_name != "") {



    // echo "$country_name";
    $state_id = get_state_id($mycon, $state_name);
    // echo "$country_id";


    $res = mysqli_query($mycon, "select * from cities where state_id = $state_id");
    echo "<option value=''>";
    echo "Select";
    echo "</option>";

    while ($row = mysqli_fetch_array($res)) {


        echo "<option value='" . $row['city_name'] . "'>";
        echo $row['city_name'];
        echo '</option>';
    }

    // echo "</select>";

}else{
    echo "<option value=''>";
    echo "Select";
    echo "</option>";

}
