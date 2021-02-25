<?php

// print_r($_POST);


$area = $_POST['area'];
$data = file_get_contents('https://api.postalpincode.in/postoffice/'.$area);
$data = json_decode($data);

// echo '<pre>';
// // // print_r($data);
// var_dump($data);
// echo '</pre>';

if(isset($data[0]->PostOffice['0'])){
    
    for($i = 0; $i < count($data[0]->PostOffice); $i++ ){

        $arr['pincode'][$i]= $data[0]->PostOffice[$i]->Pincode;
        
        
    }
    
    echo json_encode($arr);
}else{
    echo 'no';
}










?>