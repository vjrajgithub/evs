<?php  
 require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

function get_validdata($mycon, $exdate, $loc_code, $cust_code, $emp_id){
	 $totalrecord = 0;
	 $sql_query1 = "SELECT * FROM tbl_emp_dept_matrix WHERE updatedDate='" . $exdate . "' AND emp_id='" . $emp_id . "' AND loc_code='" . $loc_code . "' AND cust_code='" . $cust_code . "'";
      $result1 = mysqli_query($mycon, $sql_query1);
       $totalrecord = mysqli_num_rows($result1);
  return $totalrecord;
}

if($_POST['fileref'] !=''){
 if($_POST['location'] !=''){
  if($_POST['customer_name'] !=''){
    if(!empty($_FILES["excel_file"])){
     //echo $userRole; die('check2');
      //$mycon = mysqli_connect("localhost", "root", "", "eems");  
      $file_array = explode(".", $_FILES["excel_file"]["name"]); 
      if($file_array[1] == "xls" || $file_array[1] == "xlsx")  
      {  
        //echo $userRole; die('check3');
           include("PHPExcel/Classes/PHPExcel/IOFactory.php"); 
           $output = ''; 
           $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr>  
                          <th>Emp Code</th>  
                          <th>Customer Code</th>  
                          <th>Location Code</th>  
                          <th>Inward <br /> document <br /> checking <br /> process</th>
                          <th>Inward <br /> vehicle <br /> unloading <br /> process</th>  
                          <th>Inward <br /> floor <br /> planning</th>  
                          <th>Inward <br /> segregation <br /> rocess</th>  
                          <th>Inward <br /> system <br /> process</th>
                          <th>uc <br /> floor <br /> process</th>  
                          <th>uc <br /> system <br /> process</th>  
                          <th>binning <br /> system <br /> process</th>  
                          <th>inventory <br /> handling <br /> process <br /> audit</th>
                          <th>outward <br /> system <br /> process</th>  
                          <th>picking <br /> process</th>  
                          <th>packing <br /> process</th>  
                          <th>dispatch <br /> process</th>
                          <th>dispatch <br /> document <br /> checking <br /> process</th>  
                          <th>piv <br /> floor <br /> process</th>  
                          <th>piv <br /> system <br /> process</th>  
                          <th>WH <br /> adminstration <br /> process</th>
                          <th>MIS <br /> process</th> 
                          <th>Date</th>						  
                     </tr>  
                     ";  
           $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);  
           foreach($object->getWorksheetIterator() as $worksheet)  
           { 
             // echo $userRole; die('check4');		   
		    // echo "<pre>"; print_r($worksheet); echo "</pre>"; die('hiiiiiii');
                $highestRow = $worksheet->getHighestRow();  
                for($row=2; $row<=$highestRow; $row++)  
                {  
                   $emp_id = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(0, $row)->getValue());   
                   $inward_document_checking_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(1, $row)->getValue());$inward_vehicle_unloading_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
				   $inward_floor_planning = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(3, $row)->getValue());  
                   $inward_segregation_rocess = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(4, $row)->getValue());  
                   $inward_system_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(5, $row)->getValue());  
                   $uc_floor_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                   $uc_system_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(7, $row)->getValue());  
                   $binning_system_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(8, $row)->getValue());  
                   $inventory_handling_process_audit = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(9, $row)->getValue());  
                   $outward_system_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(10, $row)->getValue());  
                   $picking_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
				   $packing_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(12, $row)->getValue());  
                   $dispatch_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(13, $row)->getValue());  
                   $dispatch_document_checking_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(14, $row)->getValue());  
                   $piv_floor_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                   $piv_system_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(16, $row)->getValue());  
                   $wh_adminstration_process = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                   $mis = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                   $exdate = mysqli_real_escape_string($mycon, $worksheet->getCellByColumnAndRow(19, $row)->getValue());				   

                    // echo "<pre>"; print_r($cust_code); echo "</pre>"; die('hiiiiiii');
					 $groupId = time();
					 $filerefno = $_POST['fileref'];
					 $cust_code = $_POST['customer_name'];  
                     $loc_code = $_POST['location'];
				   $validdata = get_validdata($mycon, $exdate, $loc_code, $cust_code, $emp_id);
				   //echo $validdata; die;
                   if($validdata == 0){					
					 $query = "INSERT INTO tbl_emp_dept_matrix  
                     (emp_id, cust_code, loc_code, inward_document_checking_process, inward_vehicle_unloading_process, inward_floor_planning, inward_segregation_rocess, inward_system_process, uc_floor_process, uc_system_process, binning_system_process, inventory_handling_process_audit, outward_system_process, picking_process, packing_process, dispatch_process, dispatch_document_checking_process, piv_floor_process, piv_system_process, wh_adminstration_process, mis, updatedDate, fileRefno)   
                     VALUES ('".$emp_id."', '".$cust_code."', '".$loc_code."', '".$inward_document_checking_process."', '".$inward_vehicle_unloading_process."', '".$inward_floor_planning."', '".$inward_segregation_rocess."', '".$inward_system_process."', '".$uc_floor_process."', '".$uc_system_process."', '".$binning_system_process."', '".$inventory_handling_process_audit."', '".$outward_system_process."', '".$picking_process."', '".$packing_process."', '".$dispatch_process."', '".$dispatch_document_checking_process."', '".$piv_floor_process."', '".$piv_system_process."', '".$wh_adminstration_process."', '".$mis."', '".$exdate."', '".$filerefno."')  
                     ";  

                     mysqli_query($mycon, $query);  
                     $output .= '  
                     <tr>  
                          <td>'.$emp_id.'</td>
						  <td>'.$cust_code.'</td>  
                          <td>'.$loc_code.'</td>  
                          <td>'.$inward_document_checking_process.'</td>  
                          <td>'.$inward_vehicle_unloading_process.'</td>  
                          <td>'.$inward_floor_planning.'</td>
                          <td>'.$inward_segregation_rocess.'</td>  
                          <td>'.$inward_system_process.'</td>  
                          <td>'.$uc_floor_process.'</td>  
                          <td>'.$uc_system_process.'</td>
                          <td>'.$binning_system_process.'</td>
						  <td>'.$inventory_handling_process_audit.'</td>  
                          <td>'.$outward_system_process.'</td>  
                          <td>'.$picking_process.'</td>  
                          <td>'.$packing_process.'</td>  
                          <td>'.$dispatch_process.'</td>
                          <td>'.$dispatch_document_checking_process.'</td>  
                          <td>'.$piv_floor_process.'</td>  
                          <td>'.$piv_system_process.'</td>  
                          <td>'.$wh_adminstration_process.'</td>
                          <td>'.$mis.'</td>
                          <td>'.$exdate.'</td> 						  
                     </tr>  
                     '; 	
                  } else {
					  echo '<label class="text-danger">Sorry, Today you have updated the data already.</label>'; 
					  exit();
				  } 					 
                }  // for loop
           }  
           $output .= '</table>';  
           echo $output;  
      }  
      else  
      {  
           echo '<label class="text-danger">Invalid File.!</label>';  
      }  
     
 }

} else { echo '<label class="text-danger">Select Customer Name.!</label>'; }

} else { echo '<label class="text-danger">Select Location.!</label>'; }

} else { echo '<label class="text-danger">File Reference Number not found.!</label>'; }
