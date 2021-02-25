<?php 



function get_country_id($mycon,$state){
    if(is_numeric($state)){
        $sql_query = "select country_id from states where state_id ='".$state."' limit 1";

    }else{
        $sql_query = "select country_id from states where state_name ='".$state."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $country_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $country_id = $row['country_id'];
            
        }
        
        return $country_id;
}

function get_city_id($mycon, $city){

    if(is_numeric($city)){
        return $city;

    }else{
        $sql_query = "select city_id from cities where city_name ='".$city."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $city_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $city_id = $row['city_id'];
            
        }
        return $city_id;
}


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


?>