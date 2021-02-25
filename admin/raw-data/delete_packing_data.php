<?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
	//urll="delete_packing_data.php?picking_search_id="+picking_search_id+"&order="+order_id+"&v_code="+v_code;
   
$picking_search_id = $_GET['picking_search_id'];
$order = $_GET['order'];
$v_code= $_GET['v_code'];


	   $query ="update generate_vehicle_code set order_id=0,packed_status='0',outward_packing_box_id='',outward_packing_on='0000-00-00 00:00:00' where vehicle_code='$v_code' and order_id='$order'";

			$result = mysqli_query($mycon, $query);
			
			if ($result)  
			{  
				
			 echo "1";
			}
			else
			{
			echo '2';	
			}
/* }
else{
	echo '-1';	
} */
	
?>
