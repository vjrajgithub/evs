<?php

//session_start();
$dataAbout = "Employee With 100% Knowledge In DISPATCH PROCESS";
include_once 'include/excelreport.php';

if ($_POST['item'] != '') {
  $sql2 = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
        tm.dispatch_process = 100
        " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";
} else {
  $sql2 = "SELECT tm . *, tu . * FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
        tm.dispatch_process = 100 " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14)
        group by tm.emp_id order by tm.id";
}

$result2 = mysqli_query($mycon, $sql2);
while ($row2 = mysqli_fetch_array($result2)) {

  $loc_name = get_loc_name($mycon, $row2['loc_code']);
  $customer = get_Customer($mycon, $row2['cust_code']);
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
$file = "Employee-with-100-percent-Knowledge-in-DISPATCH-PROCESS-" . $dated . ".xls";
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $file . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


