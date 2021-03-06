<?php

require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName) {
  $sql_query = "SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $empid = $row['emp_code'];
    }

    return $empid;
  }
}

function get_Customer($mycon, $organization_id) {
  $sql_query = "SELECT client_id FROM tbl_organization WHERE id='" . $organization_id . "'";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $row['client_id'] . "'";
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

function get_loc_name($mycon, $loc_code) {
  $sql_query1 = "SELECT loc_name FROM tbl_location WHERE loc_id='" . $loc_code . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $loc_nm = $row1['loc_name'];
    }
  }
  return $loc_nm;
}

//Advance Search
$startHour = "00:00:00";
$endHour = "23:55:55";
$srcitem = "";
if ($_POST['item'] == 'emp_id') {
  $srcitem = " AND emp_code ='" . trim($_POST['colunmData']) . "'";
} else if ($_POST['item'] == 'name') {
  $srcitem = " AND name LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'designation') {
  $srcitem = " AND designation LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'department') {
  $srcitem = " AND main_department LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'email') {
  $srcitem = " AND email LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'mob') {
  $srcitem = " AND mobile LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'loc') {
  $sql_query1 = "SELECT id FROM tbl_organization WHERE org_name LIKE '%" . trim($_POST['colunmData']) . "%'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $loc_id = $row1['id'];
    }
  }
  $srcitem = " AND organization_id = '" . $loc_id . "'";
} else if ($_POST['item'] == 'customer') {
  $sql_query1 = "SELECT tc . *, tog.id AS toid FROM tbl_clients tc, tbl_organization tog WHERE tc.id = tog.client_id AND tc.client LIKE '%" . trim($_POST['colunmData']) . "%' LIMIT 0, 1";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $org_id = $row1['toid'];
    }
  }
  $srcitem = " AND organization_id = '" . $org_id . "'";
} else if ($_POST['item'] == 'all') {
  $srcitem = "";
}

$srcfrom = '';
if ($_POST['todt'] != '') {
  $srcfrom = "AND created_on BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
} else {
  $srcfrom = '';
}

//end header code

if ($_POST['department'] == 'department') {
  //include('PHPExcel.php');
  require_once 'PHPExcel/Classes/PHPExcel.php';
  $objPHPExcel = new PHPExcel();

  $objPHPExcel->setActiveSheetIndex(0);

// Merge Columns for showing 'Matrix's Data' start---------------
  $objPHPExcel->setActiveSheetIndex(0)
          ->mergeCells('A1:I1');

  $objPHPExcel->getActiveSheet()
          ->getCell('A1')
          ->setValue("Total Employee");


  $objPHPExcel->getActiveSheet()
          ->getStyle('A1')
          ->getAlignment()
          ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()
          ->getStyle('A1:I1')
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

  $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray_header);

  /* $styleArrayborder = array(
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
  $objPHPExcel->getActiveSheet()->setCellValue('E2', 'DOJ');
  $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Email Address');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Mobile No.');
  $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Location');
  $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Customer Name');

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

  $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style_cell);

  $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);

//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:X2')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);



  $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);

  $rowCount = 3;

  if ($_POST['item'] != '') {
    $sql_query = "SELECT * FROM tbl_users as tu WHERE isDeleted != 1 AND roleId IN (2, 3, 4, 13, 14) " . $srcitem . " " . $srcfrom . " " . $role_item . " order by name";
  } else {
    $sql_query = "SELECT * FROM tbl_users as tu WHERE isDeleted != 1 AND roleId IN (2, 3, 4, 13, 14) " . $role_item . " order by name";
  }

  $result2 = mysqli_query($mycon, $sql_query);
  while ($row2 = mysqli_fetch_array($result2)) {


    $loc_name = get_loc_name($mycon, $row2['organization_id']);
    $customer = get_Customer($mycon, $row2['organization_id']);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $row2['emp_code']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row2['name']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row2['designation']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row2['main_department']);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row2['doj']);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $row2['email']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $row2['mobile']);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, $loc_name);
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $rowCount, $customer);

    $rowCount++;
  }

  $dated = date("Y-m-d h-i-s");
  $file = "Employee Data-" . $dated . ".xls";
// Redirect output to a client’s web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $file . '"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
}

