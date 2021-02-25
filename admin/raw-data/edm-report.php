s<?php session_start();

require_once '../init.php';

if (not_logged_in() === TRUE) {
	header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName)
{
	$sql_query = "SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$empid = $row['emp_code'];
		}

		return $empid;
	}
}

function get_name($mycon, $empid)
{
	$sql_query = "SELECT name FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$nam = $row['name'];
		}

		return $nam;
	}
}

function get_designation($mycon, $empid)
{
	$sql_query = "SELECT designation FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$desi = $row['designation'];
		}
		return $desi;
	}
}

function get_Customer($mycon, $empid)
{
	$sql_query = "SELECT cust_code FROM tbl_emp_dept_matrix WHERE emp_id='" . $empid . "'";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $row['cust_code'] . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {

				while ($row = mysqli_fetch_assoc($result1)) {
					$clientName = $row['client'];
				}
			}
		}
		return $clientName;
	}
}


function get_department($mycon, $empid)
{
	$sql_query = "SELECT main_department FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$depart= $row['main_department'];
		}
		return $depart;
	}
}

function get_loc_name($mycon, $empid)
{
	$sql_query = "SELECT loc_code FROM tbl_emp_dept_matrix WHERE emp_id='" . $empid . "'";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$sql_query1 = "SELECT org_name FROM tbl_organization WHERE id='" . $row['loc_code'] . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
					$loc_nm = $row1['org_name'];
				}
			}
		}
       return $loc_nm;
	}
}

if (isset($_POST['item']) || $_POST['employee'] != '' || $_POST['fromdt'] != '') {

	//echo $_POST['item']."----".$_POST['employee']."-------".$_POST['fromdt']."-------".$_POST['todt']."-------".$_POST['department'];  die('Hellooooo');

	if ($_POST['item'] !== '') {
		$srcitem = "AND loc_code = " . $_POST['item'];
	} else {
		$srcitem = '';
	}

	if ($_POST['employee'] !== '') {
		$empid = get_empid($mycon, $_POST['employee']);
		$srcemp = "AND emp_id = " . $empid;
	} else {
		$srcemp = '';
	}

	if ($_POST['todt'] != '') {
		$srcfrom = "AND created_at BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
	} else {
		$srcfrom = '';
	}

if ($_POST['department'] == 'department') {
		//include('PHPExcel.php');
		require_once 'PHPExcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->setActiveSheetIndex(0);
 
//echo "<pre>--" .$datattt;
//print_r($result); 
//die('cheeeed');

// Merge Columns for showing 'Matrix's Data' start---------------
$objPHPExcel->setActiveSheetIndex(0)
 ->mergeCells('A1:W1');
 
$objPHPExcel->getActiveSheet()
 ->getCell('A1')
 ->setValue("Employee Matrix Data");
 
 
$objPHPExcel->getActiveSheet()
 ->getStyle('A1')
 ->getAlignment()
 ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
$objPHPExcel->getActiveSheet()
 ->getStyle('A1:W1')
 ->getFill()
 ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 ->getStartColor()
 ->setARGB('F28A8C'); //FF3399 33F0FF F28A8C
 
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
 
 $objPHPExcel->getActiveSheet()->getStyle('A1:W1')->applyFromArray($styleArray_header);
 
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
 
 $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Emp Id');
 $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Name');
 $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Designation');
 $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Department');
 $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Location');
 $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Customer Name');
 $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Inward Document checking Process');
 $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Inward Vehicle unloading Process');
 $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Inward Floor Planning');
 $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Inward Segregation Process');
 $objPHPExcel->getActiveSheet()->setCellValue('K2', 'Inward System Process');
 $objPHPExcel->getActiveSheet()->setCellValue('L2', 'UC Floor Process');
 $objPHPExcel->getActiveSheet()->setCellValue('M2', 'UC System Process');
 $objPHPExcel->getActiveSheet()->setCellValue('N2', 'Binning System Process');
 $objPHPExcel->getActiveSheet()->setCellValue('O2', 'Inventory Handling Process/Audit');
 $objPHPExcel->getActiveSheet()->setCellValue('P2', 'Outward System Process');
 $objPHPExcel->getActiveSheet()->setCellValue('Q2', 'Picking Process');
 $objPHPExcel->getActiveSheet()->setCellValue('R2', 'Packing Process');
 $objPHPExcel->getActiveSheet()->setCellValue('S2', 'Dispatch Process');
 $objPHPExcel->getActiveSheet()->setCellValue('T2', 'Dispatch Document Checking Process');
 $objPHPExcel->getActiveSheet()->setCellValue('U2', 'PIV Floor Process');
 $objPHPExcel->getActiveSheet()->setCellValue('V2', 'PIV System Process');
 $objPHPExcel->getActiveSheet()->setCellValue('W2', 'W/H Adminstration Process');
 
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
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->applyFromArray($style_cell);
 
 $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->getAlignment()->setWrapText(true);
 $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);
 
//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:X2')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(12);

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

$objPHPExcel->getActiveSheet()->getStyle('A2:W2')->applyFromArray($styleArray);
 
$rowCount = 3;

 $sql2 = "SELECT * FROM `tbl_emp_dept_matrix` WHERE 1 = 1 " . $srcitem . " " . $srcemp . " " . $srcfrom . " Order By id DESC";
 $result2 = mysqli_query($mycon,$sql2);
 while($row2 = mysqli_fetch_array($result2)){
	 
	 $name        = get_name($mycon, $row2['emp_id']);
	 $designation = get_designation($mycon, $row2['emp_id']);
	 $department  = get_department($mycon, $row2['emp_id']);
	 $loc_name    = get_loc_name($mycon, $row2['emp_id']);
	 $customer    = get_Customer($mycon, $row2['emp_id']);
	 
   $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $row2['emp_id']);
   $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $name);
   $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $designation);
   $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $department);
   $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $loc_name);
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, $customer);
   
    if($row2['inward_document_checking_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inward_document_checking_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inward_document_checking_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->applyFromArray($styleArray1);
	
    if($row2['inward_vehicle_unloading_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inward_vehicle_unloading_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inward_vehicle_unloading_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount)->applyFromArray($styleArray1);

    if($row2['inward_floor_planning'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inward_floor_planning'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inward_floor_planning'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount)->applyFromArray($styleArray1);

    if($row2['inward_segregation_rocess'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inward_segregation_rocess'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inward_segregation_rocess'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount)->applyFromArray($styleArray1);

    if($row2['inward_system_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inward_system_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inward_system_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount)->applyFromArray($styleArray1);

    if($row2['uc_floor_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['uc_floor_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['uc_floor_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowCount)->applyFromArray($styleArray1);

    if($row2['uc_system_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['uc_system_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['uc_system_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount)->applyFromArray($styleArray1);		
   
   if($row2['binning_system_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['binning_system_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['binning_system_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['inventory_handling_process_audit'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['inventory_handling_process_audit'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['inventory_handling_process_audit'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['outward_system_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['outward_system_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['outward_system_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['picking_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['picking_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['picking_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['packing_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['packing_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['packing_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('R'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['dispatch_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['dispatch_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['dispatch_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('S'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['dispatch_document_checking_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['dispatch_document_checking_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['dispatch_document_checking_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('T'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['piv_floor_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['piv_floor_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['piv_floor_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('U'.$rowCount)->applyFromArray($styleArray1);
		
    if($row2['piv_system_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['piv_system_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['piv_system_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('V'.$rowCount)->applyFromArray($styleArray1);
		
	if($row2['wh_adminstration_process'] == 100){ 
		 $green_box = "006A00";
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $green_box)) 
             );
		} else if($row2['wh_adminstration_process'] == 50){
		 $yellow_box = "ffff00"; 
         $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $yellow_box)) 
             );
		} else if($row2['wh_adminstration_process'] == 0){
		 $red_box = "ff0000"; 
		 $styleArray1 = array(
             'fill' => array( 
             'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => $red_box)) 
             );
		}
		$objPHPExcel->getActiveSheet()->getStyle('W'.$rowCount)->applyFromArray($styleArray1);
		
   //$objPHPExcel->getActiveSheet()->setCellValue('N'.$rowCount, $row2['binning_system_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('O'.$rowCount, $row2['inventory_handling_process_audit']);
   //$objPHPExcel->getActiveSheet()->setCellValue('P'.$rowCount, $row2['outward_system_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowCount, $row2['picking_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('R'.$rowCount, $row2['packing_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('S'.$rowCount, $row2['dispatch_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('T'.$rowCount, $row2['dispatch_document_checking_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('U'.$rowCount, $row2['piv_floor_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('V'.$rowCount, $row2['piv_system_process']);
   //$objPHPExcel->getActiveSheet()->setCellValue('W'.$rowCount, $row2['wh_adminstration_process']);
   
	 
  $rowCount++;
 }

$dated = date("Y-m-d h-i-s");
$file = "department-wise-matrix-data-" .$dated. ".xls";
// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="'. $file .'"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');
	}
}
