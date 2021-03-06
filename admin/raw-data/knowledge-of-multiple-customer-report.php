<?php

require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName) {
  $sql_query = "SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1
	  AND roleId IN (2, 3, 4, 13, 14)";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $empid = $row['emp_code'];
    }

    return $empid;
  }
}

function get_Customer($mycon, $cust_code) {
  $sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $cust_code . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $clientName = $row1['client'];
    }
  }
  return $clientName;
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

if ($_POST['item'] !== '') {
  $srcitem = "AND tm.cust_code = " . $_POST['item'];
} else {
  $srcitem = '';
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


// Merge Columns for showing 'Employee Matrix's Data' close--------------->

  $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Emp Code');
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Name');
  $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Designation');
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Department');
  $objPHPExcel->getActiveSheet()->setCellValue('E2', 'DOJ');
  $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Location');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Customer Name');

  $rowCnt = 2;
  $columnFor = 'H';
  $sql_query_loc = "SELECT * FROM  `tbl_clients`";
  $result_loc = mysqli_query($mycon, $sql_query_loc);
  if (mysqli_num_rows($result_loc) > 0) {
    $tol_loc = mysqli_num_rows($result_loc);
    while ($rowloc = mysqli_fetch_assoc($result_loc)) {
      $lastRow = $tol_loc + 1;

      //$lastRow = $worksheet->getHighestRow();
      //for ($row = 1; $row <= $lastRow; $row++) {
      $objPHPExcel->getActiveSheet()->setCellValue($columnFor . $rowCnt, $rowloc['client']);
      $columnFor++;
      //}
    }
  }

  $objPHPExcel->getActiveSheet()->setCellValue($columnFor . $rowCnt, '% of Customer Knowledge');

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

  // Merge Columns for showing 'Matrix's Data' start---------------
  $objPHPExcel->setActiveSheetIndex(0)
          ->mergeCells('A1:' . $columnFor . '1');

  $objPHPExcel->getActiveSheet()
          ->getCell('A1')
          ->setValue("Knowledge Of Multiple Customer Report");


  $objPHPExcel->getActiveSheet()
          ->getStyle('A1')
          ->getAlignment()
          ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()
          ->getStyle('A1:' . $columnFor . '1')
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

  $objPHPExcel->getActiveSheet()->getStyle('A1:' . $columnFor . '1')->applyFromArray($styleArray_header);
  $objPHPExcel->getActiveSheet()->getStyle('A2:' . $columnFor . '2')->applyFromArray($style_cell);

  $objPHPExcel->getActiveSheet()->getStyle('A2:' . $columnFor . '2')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);

//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:X2')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);

  $columnFor1 = 'H';
  $sql_query_loc = "SELECT * FROM  `tbl_clients`";
  $result_loc = mysqli_query($mycon, $sql_query_loc);
  if (mysqli_num_rows($result_loc) > 0) {
    $tol_loc = mysqli_num_rows($result_loc);
    while ($rowloc = mysqli_fetch_assoc($result_loc)) {
      $lastRow = $tol_loc + 1;

      //$lastRow = $worksheet->getHighestRow();
      //for ($row = 1; $row <= $lastRow; $row++) {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnFor1)->setWidth(10);
      $columnFor1++;
      //}
    }
  }

  $objPHPExcel->getActiveSheet()->getStyle('A2:' . $columnFor1 . '2')->applyFromArray($styleArray);

  $rowCount = 3;

  //$sql2 = "SELECT * FROM `tbl_emp_dept_matrix` WHERE 1 = 1 " . $srcitem . " " . $srcemp . " " . $srcfrom . " Order By id DESC";
  if ($_POST['item'] != '') {
    $sql2 = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";
  } else {
    $sql2 = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";
  }
  $result2 = mysqli_query($mycon, $sql2);
  if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_array($result2)) {

      $loc_name = get_loc_name($mycon, $row2['loc_code']);
      $customer = get_Customer($mycon, $row2['cust_code']);

      $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $row2['emp_code']);
      $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row2['name']);
      $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row2['designation']);
      $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row2['main_department']);
      $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row2['doj']);
      $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $loc_name);
      $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $customer);

      $columnFor2 = 'H';
      $sql_query_loc1 = "SELECT * FROM  `tbl_clients`";
      $result_loc1 = mysqli_query($mycon, $sql_query_loc1);
      if (mysqli_num_rows($result_loc1) > 0) {
        $i = 0;
        $k = 0;
        while ($rowloc1 = mysqli_fetch_assoc($result_loc1)) {
          $sql_query_loc2 = "SELECT * FROM `tbl_emp_dept_matrix` WHERE cust_code = '" . $rowloc1['id'] . "' AND emp_id = '" . $row2['emp_code'] . "'";
          $result_loc2 = mysqli_query($mycon, $sql_query_loc2);
          if (mysqli_num_rows($result_loc2) > 0) {
            $loc_count = mysqli_num_rows($result_loc2);
          } else {
            $loc_count = 0;
          }

          if ($loc_count > 0) {
            $green_box = "006A00";
            $styleArray1 = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => $green_box))
            );
            $i++;
          } else {
            $red_box = "ff0000";
            $styleArray1 = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => $red_box))
            );
          }
          $objPHPExcel->getActiveSheet()->getStyle($columnFor2 . $rowCount)->applyFromArray($styleArray1);
          $columnFor2++;
          $k++;
        }
      }

      $loc_percentage = round((($i / $k) * 100), 2) . "%";

      $objPHPExcel->getActiveSheet()->setCellValue($columnFor2 . $rowCount, $loc_percentage);

      unset($i);
      unset($k);

      $rowCount++;
    }
  } else {

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Not Found Data');

    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:X3');

    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getCell('A3')->setValue("Not Found Data");
  }

  $dated = date("Y-m-d h-i-s");
  $file = "Knowledge-of-multiple-customer-report-" . $dated . ".xls";
// Redirect output to a client’s web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $file . '"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
}
