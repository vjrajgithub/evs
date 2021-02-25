<?php //session_start();

require_once '../init.php';

if (not_logged_in() === TRUE) {
	header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName)
   {
	  $sql_query="SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$empid = $row['emp_code'];
	
		  }
	
		  return $empid;
   }
   }

function get_Customer($mycon, $cust_id)
{
	$sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $cust_id . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {

				while ($row = mysqli_fetch_assoc($result1)) {
					$clientName = $row['client'];	
        }
    }
    return $clientName;
}
   

function get_loc_name($mycon, $loc_code)
{
	$sql_query1 = "SELECT org_name FROM tbl_organization WHERE id='" . $loc_code . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$loc_nm = $row1['org_name'];
       
	  }
  }
   return $loc_nm;
}

if($_POST['item'] !== ''){ $srcitem = "AND loc_code = ".$_POST['item']; } else { $srcitem = ''; }

if($_POST['employee'] !== ''){ 

$empid = get_empid($mycon, $_POST['employee']); 
$srcemp = "AND emp_id = ".$empid; 

} else { $srcemp = ''; }

if($_POST['todt'] != ''){ $srcfrom = "AND created_at BETWEEN '".$_POST['fromdt']." $startHour' AND '".$_POST['todt']." $endHour'"; } else { $srcfrom = ''; }
   


//Advance Search
$startHour = "00:00:00";
$endHour = "23:55:55";
$srcitem = "";
if ($_POST['item'] == 'emp_id') {
  $srcitem = " AND tu.emp_code ='" . trim($_POST['colunmData']) . "'";
} else if ($_POST['item'] == 'name') {
  $srcitem = " AND tu.name LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'designation') {
  $srcitem = " AND tu.designation LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'department') {
  $srcitem = " AND tu.main_department LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'email') {
    $srcitem = " AND tu.email LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'mob') {
    $srcitem = " AND tu.mobile LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'loc') {
    $sql_query1 = "SELECT id FROM tbl_organization WHERE org_name LIKE '%" . trim($_POST['colunmData']) . "%'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$loc_id = $row1['id'];
	           }
           }
    $srcitem = " AND tm.loc_code = '" . $loc_id . "'";
} else if ($_POST['item'] == 'customer') {
    $sql_query1 = "SELECT id FROM tbl_clients WHERE client LIKE '%" . trim($_POST['colunmData']) . "%'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$cust_id = $row1['id'];
	           }
           }
    $srcitem = " AND tm.cust_code = '" . $cust_id . "'";
} else if ($_POST['item'] == 'all') {
  $srcitem = "";
}
$srcfrom = '';
if ($_POST['todt'] != '') {
  $srcfrom = "AND created_on BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
} else {
  $srcfrom = '';
}
//Fetch data from role wised
if($userdata['role'] == 2 || $userdata['role'] == 3){
	$user_location = $userdata['org_id'];
	$user_client = $userdata['client_id'];
	$role_item = " AND tm.loc_code = '" . $user_location . "' AND tm.cust_code = '" . $user_client . "'";
} else {
	$role_item = '';
}

//end header code

if ($_POST['department'] == 'department') {
		//include('PHPExcel.php');
		require_once 'PHPExcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->setActiveSheetIndex(0);

// Merge Columns for showing 'Matrix's Data' start---------------
$objPHPExcel->setActiveSheetIndex(0)
 ->mergeCells('A1:H1');
 
$objPHPExcel->getActiveSheet()
 ->getCell('A1')
 ->setValue("EMPLOYEE WITH 0 % KNOWLEDGE IN ALL DEPARTMENT");
 
 
$objPHPExcel->getActiveSheet()
 ->getStyle('A1')
 ->getAlignment()
 ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
$objPHPExcel->getActiveSheet()
 ->getStyle('A1:H1')
 ->getFill()
 ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 ->getStartColor()
 ->setARGB('F28A8C'); //FF3399 33F0FF F28A8C
 
 $objPHPExcel->getDefaultStyle()
    ->getBorders()
    ->getTop()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getDefaultStyle()
    ->getBorders()
    ->getBottom()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getDefaultStyle()
    ->getBorders()
    ->getLeft()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getDefaultStyle()
    ->getBorders()
    ->getRight()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

 $styleArray_header = array(
 'font' => array(
 'bold' => true,
 'color' => array('rgb' => '19194d'),
 'size' => 12,
 'name' => 'Verdana'
 ),
 'fill' => array( 
 'type' => PHPExcel_Style_Fill::FILL_SOLID,
 'color' => array('rgb' => '9999ff')) 
 );
 
 $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray_header);
 
 /*$styleArrayborder = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => 'FFFF0000'),
		),
	),
   );
  $objPHPExcel->getActiveSheet()->getStyle('A1:W1')->applyFromArray($styleArrayborder);
  $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->applyFromArray($styleArrayborder); */
 
 
// Merge Columns for showing 'Employee Matrix's Data' close--------------->
 
 $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Emp Code');
 $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Name');
 $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Designation');
 $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Department');
 $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Email Address');
 $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Mobile No.');
 $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Location');
 $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Customer Name');
 
 $styleArray = array(
 'font' => array(
 'bold' => true,
 'color' => array('rgb' => '19194d'),
 'size' => 10,
 'name' => 'Verdana'
 ),
 'fill' => array( 
 'type' => PHPExcel_Style_Fill::FILL_SOLID,
 'color' => array('rgb' => 'ccccff')) 
 );
 
 $style_cell = array(
   'alignment' => array(
       'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
       'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
   ) 
 ); 
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($style_cell);
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setWrapText(true);
 $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);
 
//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:X2')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
 
$rowCount = 3;

if($_POST['item'] != ''){
    $sql2 = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
        tm.inward_document_checking_process = 0 AND
        tm.inward_vehicle_unloading_process = 0 AND
        tm.inward_floor_planning = 0 AND
        tm.inward_segregation_rocess = 0 AND
        tm.inward_system_process = 0 AND
        tm.uc_floor_process = 0 AND
        tm.uc_system_process = 0 AND
        tm.binning_system_process = 0 AND
        tm.inventory_handling_process_audit = 0 AND
        tm.outward_system_process = 0 AND
        tm.picking_process = 0 AND
        tm.packing_process = 0 AND
        tm.dispatch_process = 0 AND
        tm.dispatch_document_checking_process = 0 AND
        tm.piv_floor_process = 0 AND
        tm.piv_system_process = 0 AND
        tm.wh_adminstration_process = 0
        ".$srcitem." ".$srcfrom." ".$role_item." AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tu.name";
    
   } else {
    $sql2 = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
        tm.inward_document_checking_process = 0 AND
        tm.inward_vehicle_unloading_process = 0 AND
        tm.inward_floor_planning = 0 AND
        tm.inward_segregation_rocess = 0 AND
        tm.inward_system_process = 0 AND
        tm.uc_floor_process = 0 AND
        tm.uc_system_process = 0 AND
        tm.binning_system_process = 0 AND
        tm.inventory_handling_process_audit = 0 AND
        tm.outward_system_process = 0 AND
        tm.picking_process = 0 AND
        tm.packing_process = 0 AND
        tm.dispatch_process = 0 AND
        tm.dispatch_document_checking_process = 0 AND
        tm.piv_floor_process = 0 AND
        tm.piv_system_process = 0 AND
        tm.wh_adminstration_process = 0 ".$role_item." AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14)
        group by tm.emp_id order by tu.name";
   }
 
 $result2 = mysqli_query($mycon,$sql2);
 while($row2 = mysqli_fetch_array($result2)){
	 
    $loc_name = get_loc_name($mycon, $row2['loc_code']);
	$customer = get_Customer($mycon, $row2['cust_code']);
   $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $row2['emp_code']);
   $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $row2['name']);
   $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $row2['designation']);
   $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $row2['main_department']);
   $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $row2['email']);
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, $row2['mobile']);
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$rowCount, $loc_name);
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$rowCount, $customer);
   	 
  $rowCount++;
 }

$dated = date("Y-m-d h-i-s");
$file = "Employee-with-Zero-percent-Knowledge-in-ALL-DEPARTMENT-" .$dated. ".xls";
// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="'. $file .'"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');
	}

