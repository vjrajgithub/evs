<?php session_start();

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


function get_department($mycon, $empid)
{
	$sql_query = "SELECT department_id FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$sql_query1 = "SELECT dept_name FROM tbl_departments WHERE dept_id='" . $row['department_id'] . "' AND isDeleted != 1";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {

				while ($row = mysqli_fetch_assoc($result1)) {
					$desi = $row['dept_name'];
				}
			}
		}
		return $depart;
	}
}

function get_loc_name($mycon, $loccode)
{
	$sql_query = "SELECT org_name FROM tbl_organization WHERE id='" . $loccode . "' AND isDeleted != 1";
	$result = mysqli_query($mycon, $sql_query);
	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$loc_name = $row['org_name'];
		}

		return $loc_name;
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
		//echo $_POST['todt'] . " srcitem-----" . $srcfrom;
		//die('Hellooooo');








		include('PHPExcel.php');
		//$objPHPExcel = new PHPExcel();




		//echo ('hghghghg');
		$objPHPExcel    =   new PHPExcel();
		//$result         =   $db->query("SELECT * FROM countries") or die(mysql_error());

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Country Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Country Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Capital');

		//$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold(true);

		// $rowCount   =   2;
		// while ($row  =   $result->fetch_assoc()) {
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($row['countryCode'], 'UTF-8'));
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row['countryName'], 'UTF-8'));
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper($row['capital'], 'UTF-8'));
		// 	$rowCount++;
		// }


		$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);


		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="you-file-name.xls"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		die('hhhhhhhhhh');








		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;
		//echo $_POST['todt'] . " srcitem-----" . $srcfrom;
		//die('Hellooooo');

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'sdfsd');
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'dfdsffdfvsddsfsd');
		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'qweq');
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'xv');
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'czx');
		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'ttty');

		//echo $_POST['todt'] . " srcitem-----" . $srcfrom;
		//die('check-123');

		// $sql = "SELECT * FROM `tbl_emp_dept_matrix` WHERE created_at != '' " . $srcitem . " " . $srcemp . " " . $srcfrom . " Order By id DESC";
		// $result = mysqli_query($mycon, $sql);
		// //echo $sql; die('Helloooo');
		// if (mysqli_num_rows($result) > 0) {
		// 	//print_r($sql_data); echo "</pre>"; die('hellooo');
		// 	$j = 0;
		// 	$k = 0;
		// 	$rowCount = 2;
		// 	while ($row = mysqli_fetch_assoc($result)) {
		// 		// echo "<pre>";
		// 		// print_r($row);
		// 		// echo "</pre>";
		// 		// die('hellooo');
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['emp_id']);
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['loc_code']);
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['cust_code']);
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['emp_id']);
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['loc_code']);
		// 		$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['cust_code']);
		// 		$rowCount++;
		// 	}
		// } else {
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'No found data.');
		// }

		$file = "department-wise-matrix-data.xls";
		// Redirect output to a client’s web browser (Excel2007)
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $file . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//print_r($objWriter); exit;
		ob_get_clean();
		$objWriter->save('php://output');
		ob_end_flush();
		//$objWriter->save(str_replace('.php', '.xls', __FILE__));
		exit;
	}
}
