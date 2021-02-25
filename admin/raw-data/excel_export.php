<?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
     $order_id=$_GET['order_id'];
     $n_id=$_GET['n_id'];
	 
	    function get_recever_buyer_det($id,$mycon,$type)
   {
	    $data_a=array();
	  echo $sql_query="SELECT name,code,address,other FROM `unloading_reciver_buyer_details` where id='".$id."' and type='".$type."'";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$data_a[0]=$row['name'];
			$data_a[1]=$row['code'];
			$data_a[2]=$row['address'];
			$data_a[3]=$row['other'];
		  }
	
		  return $data_a;
   }
   }
   
      function get_sender_deatils($id,$mycon)
   {
	   $data_a=array();
	   $sql_query="SELECT * FROM `unloading_sender_details` where id='".$id."'";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$data_a[0]=$row['sender_name'];
			$data_a[1]=$row['sender_code'];
			$data_a[2]=$row['sender_address'];
			$data_a[3]=$row['sender_other'];
		
		  }
	
		  return $data_a;
   }
   }
   
   
   function get_vall($id,$mycon)
   {
	   $sql_query="SELECT vehicle_name FROM `unloading_vehicle_type`  where id='".$id."'";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
	  $vehicle_name=$row['vehicle_name'];
		  }
	
		  return $vehicle_name;
   }
   }
   
   function get_unloading_data($id,$mycon)
   {
	   $f_arr=array();
	   $sql_query="SELECT ud.*,uvt.vehicle_name FROM `unloading_data` ud join unloading_vehicle_type uvt on ud.unloading_type=uvt.id where ud.get_pass_number='".$id."' ";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
	   $f_arr[]=$row;
		  }
	
		  return $f_arr[0];
   }
   }
   
   
   function get_all($id,$mycon)
   {
	   $f_arr=array();
	   $sql_query="SELECT sc.*,sc.id as m_id,tm.transporter_name as tname FROM security_check_details sc join transporter_master tm on sc.transporter_name=tm.id where sc.id='".$id."' ";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
	   $f_arr[]=$row;
		  }
	
		  return $f_arr;
   }
   }
      $idd=$_GET['id'];
  $set_data=get_all($idd,$mycon);
  
  $set_data[0]['transiction_type']= get_vall($set_data[0]['transiction_type'],$mycon); 
  $set_data[0]['ref_number']=get_vall($set_data[0]['ref_number'],$mycon);
  $set_data[0]['vehicle_type']=get_vall($set_data[0]['vehicle_type'],$mycon);
  
   if($set_data[0]['vehicle_type']=="1")
   {
	   $set_data[0]['vehicle_type']="Inbound";
   }
   else if($set_data[0]['vehicle_type']=="2")
   {
	    $set_data[0]['vehicle_type']="outbound";
   }
   
$output_array=$set_data[0];

$unloading_data=get_unloading_data($set_data[0]['gate_pass_number'],$mycon);

$sender_details=get_sender_deatils($output_array['sender_id'],$mycon);

	$tsv  = array();
	$html = array();
	if($unloading_data['unloading_type']==1){$unloading_type= "FTL"; }else if($unloading_data['unloading_type']==2){$unloading_type=  "PTL";}else if($unloading_data['unloading_type']==3){$unloading_type=  "Other";}
	
/* $row1 = array("Vehicle Number","Transporter Name","Driver Name","Driver License Number","Vehicle Type","Process Type","Vehicle In Date&Time","Vehicle Seal Number","Vehicle Size","Vehicle Out Date&Time");
$tsv[]  = implode("\t", $row1);

$row1 = array($output_array['vehicle_number'] ,$output_array['tname'],$output_array['driver_name'],$output_array['driver_licence_number'],$unloading_type,$set_data[0]['vehicle_type'], $unloading_data['created_at'],$unloading_data['vehicle_seal_number'],$unloading_data['vehicle_size'],$set_data[0]['out_at']);
			
$tsv[]  = implode("\t", $row1); */


	$row1 = array("Vehicle Number","Transporter Name","Driver Name","Driver License Number","Vehicle Type","Process Type","Vehicle In Date&Time","Vehicle Seal Number","Vehicle Size","Vehicle Out Date&Time","Gatepass Number.","LR Number","Supplier Name","Warehouse Client Name","No.of Invoices","No.of Boxes","Qty (LR)","Gatepass Date&Time","Remarks");
$tsv[]  = implode("\t", $row1);

$sql_query="SELECT * FROM `vehicle_in_out_lr_data` where relation_id='".$set_data[0]['relation_id']."' ";
	if ($mycon->multi_query($sql_query) &&  $res = $mycon->store_result())
	{

		while ($row = $res->fetch_array())
		{
$row1 = array($output_array['vehicle_number'] ,$output_array['tname'],$output_array['driver_name'],$output_array['driver_licence_number'],$unloading_type,$set_data[0]['vehicle_type'], $unloading_data['created_at'],$unloading_data['vehicle_seal_number'],$unloading_data['vehicle_size'],$set_data[0]['out_at'],$row['gate_pass_number'] ,$row['lr_number'],$row['vendor_name'],$row['customer_name'], $row['no_invoices'],$row['no_boxes'], $row['lr_qty'],$row['created_on'],$row['remarks']);
			
			$tsv[]  = implode("\t", $row1);
		}
			$res->free();
	}	
			$tsv = implode("\r\n", $tsv);
			$fileName = "security_check_data.xls";
			
			header("Content-type:application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$fileName");		
			echo $tsv;

?>