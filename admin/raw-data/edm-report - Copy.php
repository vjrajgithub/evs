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

  // $qry_user=mysql_query("SELECT * FROM `tbl_emp_dept_matrix` WHERE cust_code != 0 AND loc_code != 0 ".$srcitem." ".$srcemp." ".$srcfrom." Order By id DESC");
  // $result_user =mysql_fetch_assoc($qry_user);

  //echo $qry_user;  die('Hellooooo');

  if ($_POST['department'] == 'department') {
    //echo $_POST['department'];  die('Hellooooo');
    include('PHPExcel.php');
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1;
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'dfdsfdsfsd');
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'dfdsfdsfsd');
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'dfdsfdsfsd');
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'dfdsfdsfsd');
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'dfdsfdsfsd');
    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'dfdsfdsfsd');

    // excel formating code
    //width
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(100);
    // column Bold
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

    // Rename first worksheet
    //echo date('H:i:s') , " Rename first worksheet" , EOL;
    $objPHPExcel->getActiveSheet()->setTitle('Department Matrix Data');

    // column Alignment
    $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //$objPHPExcel->getActiveSheet()->getStyle('D1:F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle('A:B')->getAlignment()->applyFromArray(
      array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
    );

    $objPHPExcel->getActiveSheet()->getStyle('D:E')->getAlignment()->applyFromArray(
      array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
    );
    // Border
    $BStyle = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($BStyle);

    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray(
      array(
        'fill' => array(
          'type' => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array('rgb' => '3ca7ff')
        )
      )
    );
    //End excel formating code

    $sql = "SELECT * FROM `tbl_emp_dept_matrix` WHERE created_at != '' " . $srcitem . " " . $srcemp . " " . $srcfrom . " Order By id DESC";
    $result = mysqli_query($mycon, $sql);
    //echo $sql; die('Helloooo');
    if (mysqli_num_rows($result) > 0) {
      //print_r($sql_data); echo "</pre>"; die('hellooo');
      $j = 0;
      $k = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row); echo "</pre>"; die('hellooo');
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['emp_id']);
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['loc_code']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['cust_code']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['emp_id']);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['loc_code']);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['cust_code']);
      }
    } else { }
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
