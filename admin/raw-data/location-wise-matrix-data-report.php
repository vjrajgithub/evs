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
  $sql_query1 = "SELECT loc_name FROM  tbl_location WHERE loc_id='" . $loc_code . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $loc_nm = $row1['loc_name'];
    }
  }
  return $loc_nm;
}

if ($_POST['item'] !== '') {
  $srcitem = "AND loc_code = " . $_POST['item'];
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

// Merge Columns for showing 'Matrix's Data' start---------------
  $objPHPExcel->setActiveSheetIndex(0)
          ->mergeCells('A1:AB1');

  $objPHPExcel->getActiveSheet()
          ->getCell('A1')
          ->setValue("Location Wise Department Knowledge Report");


  $objPHPExcel->getActiveSheet()
          ->getStyle('A1')
          ->getAlignment()
          ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()
          ->getStyle('A1:AB1')
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

  $objPHPExcel->getActiveSheet()->getStyle('A1:AB1')->applyFromArray($styleArray_header);

// Merge Columns for showing 'Employee Matrix's Data' close--------------->

  $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Emp Id');
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Name');
  $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Designation');
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Department');
  $objPHPExcel->getActiveSheet()->setCellValue('E2', 'DOJ');
  $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Location');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Customer Name');
  $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Inward Document checking Process');
  $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Inward Vehicle unloading Process');
  $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Inward Floor Planning');
  $objPHPExcel->getActiveSheet()->setCellValue('K2', 'Inward Segregation Process');
  $objPHPExcel->getActiveSheet()->setCellValue('L2', 'Inward System Process');
  $objPHPExcel->getActiveSheet()->setCellValue('M2', 'UC Floor Process');
  $objPHPExcel->getActiveSheet()->setCellValue('N2', 'UC System Process');
  $objPHPExcel->getActiveSheet()->setCellValue('O2', 'Binning System Process');
  $objPHPExcel->getActiveSheet()->setCellValue('P2', 'Inventory Handling Process/Audit');
  $objPHPExcel->getActiveSheet()->setCellValue('Q2', 'Outward System Process');
  $objPHPExcel->getActiveSheet()->setCellValue('R2', 'Picking Process');
  $objPHPExcel->getActiveSheet()->setCellValue('S2', 'Packing Process');
  $objPHPExcel->getActiveSheet()->setCellValue('T2', 'Dispatch Process');
  $objPHPExcel->getActiveSheet()->setCellValue('U2', 'Dispatch Document Checking Process');
  $objPHPExcel->getActiveSheet()->setCellValue('V2', 'PIV Floor Process');
  $objPHPExcel->getActiveSheet()->setCellValue('W2', 'PIV System Process');
  $objPHPExcel->getActiveSheet()->setCellValue('X2', 'W/H Adminstration Process');
  $objPHPExcel->getActiveSheet()->setCellValue('Y2', 'MIS');
  $objPHPExcel->getActiveSheet()->setCellValue('Z2', '100% Knowledge in department');
  $objPHPExcel->getActiveSheet()->setCellValue('AA2', '50% Knowledge in department');
  $objPHPExcel->getActiveSheet()->setCellValue('AB2', '0% Knowledge in department');

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

  $objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->applyFromArray($style_cell);

  $objPHPExcel->getActiveSheet()->getStyle('A2:AB2')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);

//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:X2')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(12);



  $objPHPExcel->getActiveSheet()->getStyle('A2:AA2')->applyFromArray($styleArray);

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


      if ($row2['inward_document_checking_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inward_document_checking_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inward_document_checking_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['inward_vehicle_unloading_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inward_vehicle_unloading_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inward_vehicle_unloading_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('I' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['inward_floor_planning'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inward_floor_planning'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inward_floor_planning'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('J' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['inward_segregation_rocess'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inward_segregation_rocess'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inward_segregation_rocess'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('K' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['inward_system_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inward_system_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inward_system_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('L' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['uc_floor_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['uc_floor_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['uc_floor_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('M' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['uc_system_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['uc_system_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['uc_system_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('N' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['binning_system_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['binning_system_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['binning_system_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('O' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['inventory_handling_process_audit'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['inventory_handling_process_audit'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['inventory_handling_process_audit'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('P' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['outward_system_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['outward_system_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['outward_system_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('Q' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['picking_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['picking_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['picking_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('R' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['packing_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['packing_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['packing_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('S' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['dispatch_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['dispatch_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['dispatch_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('T' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['dispatch_document_checking_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['dispatch_document_checking_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['dispatch_document_checking_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('U' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['piv_floor_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['piv_floor_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['piv_floor_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('V' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['piv_system_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['piv_system_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['piv_system_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('W' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['wh_adminstration_process'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['wh_adminstration_process'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['wh_adminstration_process'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('X' . $rowCount)->applyFromArray($styleArray1);

      if ($row2['mis'] == 100) {
        $green_box = "006A00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $green_box))
        );
        $i++;
      } else if ($row2['mis'] == 50) {
        $yellow_box = "ffff00";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $yellow_box))
        );
        $j++;
      } else if ($row2['mis'] == 0) {
        $red_box = "ff0000";
        $styleArray1 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $red_box))
        );
        $k++;
      }
      $objPHPExcel->getActiveSheet()->getStyle('Y' . $rowCount)->applyFromArray($styleArray1);

      $hpdk = round((($i / 18) * 100), 2) . "%";
      $fpdk = round((($j / 18) * 100), 2) . "%";
      $zpdk = round((($k / 18) * 100), 2) . "%";
      ;
      $objPHPExcel->getActiveSheet()->setCellValue('Z' . $rowCount, $hpdk);
      unset($i);
      $objPHPExcel->getActiveSheet()->setCellValue('AA' . $rowCount, $fpdk);
      unset($j);
      $objPHPExcel->getActiveSheet()->setCellValue('AB' . $rowCount, $zpdk);
      unset($k);

      $rowCount++;
    }
  } else {
    //$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, 'Not Found Data');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:AB3');

    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getCell('A3')->setValue("Not Found Data");
  }

  $dated = date("Y-m-d h-i-s");
  $file = "Location-wise-department-knowledge-report-" . $dated . ".xls";
// Redirect output to a client’s web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $file . '"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
}
