<?php

// print_r($_POST);


$pincode = $_POST['pincode'];
$data = file_get_contents('https://api.postalpincode.in/pincode/'.$pincode);
$data = json_decode($data);

// echo '<pre>';
// // print_r($data);
// var_dump($data);
// echo '</pre>';

if(isset($data[0]->PostOffice['0'])){
    // echo "hello";
    $arr['city']= $data[0]->PostOffice['0']->Block;
    $arr['state']= $data[0]->PostOffice['0']->State;
    echo json_encode($arr);

}else{
    echo 'no';
}










?>