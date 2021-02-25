<?php
require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}


function get_available_qty($product_code, $mycon) {
    $tabledata = 0;
    $sql_query1 = "SELECT sum(quantity) AS available_qty FROM temp_split_quantity_putway WHERE product_code='" . $product_code . "' group by product_code";
  
    $result1 = mysqli_query($mycon, $sql_query1);
    $rows_total1 = mysqli_num_rows($result1);
    if (mysqli_num_rows($result1) > 0) {
      while ($row1 = mysqli_fetch_assoc($result1)) {
        $tabledata = $row1['available_qty'];
      }
    }
    return $tabledata;
  }
  
  function get_lockedqty($product_code, $mycon) {
    $total = 0;
    $sql_query = "SELECT SUM(pick_qty) AS qty FROM `picklist_generation` WHERE pro_code='" . $product_code . "' group by pro_code";
    $result = mysqli_query($mycon, $sql_query);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $total = $row['qty'];
      }
    }
  
    return $total;
  }
  
  function get_dispatched_qt($product_code, $mycon) {
    $total = 0;
    $sql_query = "SELECT SUM(picked_qt) AS qty FROM `packed_quantity_data` WHERE product_code='" . $product_code . "' group by product_code";
    $result = mysqli_query($mycon, $sql_query);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $total = $row['qty'];
      }
    }
  
    return $total;
  }
  
  function get_totalbatch($product_code, $mycon) {
    $total = 0;
    $sql_query2 = "SELECT * FROM temp_split_quantity_putway WHERE product_code='" . $product_code . "' group by relation_id";
    $result2 = mysqli_query($mycon, $sql_query2);
    $total2 = mysqli_num_rows($result2);
  
    $sql_query1 = "SELECT * FROM picklist_generation WHERE pro_code='" . $product_code . "' group by batch";
    $result1 = mysqli_query($mycon, $sql_query1);
    $total1 = mysqli_num_rows($result1);
  
    $total = $total2 + $total1;
  
    return $total;
  }
  
  function get_totallocation($product_code, $mycon) {
    $total1 = 0;
    $total2 = 0;
    $sql_query2 = "SELECT * FROM temp_split_quantity_putway WHERE product_code='" . $product_code . "' group by location";
    $result2 = mysqli_query($mycon, $sql_query2);
    $total2 = mysqli_num_rows($result2);
  
    $sql_query1 = "SELECT * FROM picklist_generation WHERE pro_code='" . $product_code . "' group by location";
    $result1 = mysqli_query($mycon, $sql_query1);
    $total1 = mysqli_num_rows($result1);
  
    $total = $total2 + $total1;
  
    return $total;
  }
  
  // Search Data Show
  function get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
    $sql_query = "SELECT * FROM `material_master` WHERE material_box_qty != 0 " . $srcitem . " " . $srcfrom . " " . $role_item . " order by part_no DESC";
    $result = mysqli_query($mycon, $sql_query);
    return mysqli_num_rows($result);
  }
  
  function get_total_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
    $sql_query = "SELECT * FROM `material_master` WHERE material_box_qty != 0 " . $role_item . "";
    $result = mysqli_query($mycon, $sql_query);
    return mysqli_num_rows($result);
  }
  

//Advance Search
$startHour = "00:00:00";
$endHour = "23:55:55";

if (isset($_POST['fileRefno'])) {
    if(trim(strtolower($_POST['fileRefno'])) == "all" || trim(strtolower($_POST['fileRefno'])) == ""){
    $srcitem = "";      
    }else{
        $srcitem = "AND application_id ='" . trim($_POST['fileRefno']) . "'";
    }
  } else {
    $srcitem = "";
  }
  
  
//echo "colunmData--" . $_POST['colunmData'] . "<br/>fromdt--" . $_POST['fromdt'] . "<br/>todt--" . $_POST['todt'] . "<br/>item--" . $_POST['item'];


if ($_POST['department'] == 'department') {
  //include('PHPExcel.php');
  require_once 'PHPExcel/Classes/PHPExcel.php';
  $objPHPExcel = new PHPExcel();

  $objPHPExcel->setActiveSheetIndex(0);
  
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');

  $objPHPExcel->getActiveSheet()->getCell('A1')->setValue("MIS Report 1");

  $objPHPExcel->getActiveSheet()
		  ->getStyle('A1')
		  ->getAlignment()
		  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()
		  ->getStyle('A1:G1')
		  ->getFill()
		  ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		  ->getStartColor()
		  ->setARGB('F28A8C'); //FF3399 33F0FF F28A8C
	
	// Add function for color	  
   function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array(
				 'rgb' => $color
			)
		));
	}

	//cellColor('B5', 'F28A8C');
	//cellColor('G5', 'EFA26E');
// 	cellColor('A2:G2', 'D2C9C9');
// 	cellColor('A3:G3', 'D2C9C9');
// 	cellColor('A4:G4', 'D2C9C9');
//   cellColor('A5:G5', 'D2C9C9');
//   cellColor('A6:G6', 'D2C9C9');	
	
   // End function for color	
   
   //$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('FF0000');
  

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
		  
  /** Borders for all data */
 /*  $objPHPExcel->getActiveSheet()->getStyle(
    'A2:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
	)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); */



	/** Borders for heading */
	 /*  $objPHPExcel->getActiveSheet()->getStyle(
		'A1:G1'
	)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK); */
	

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

  $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray_header);

//   $objPHPExcel->getActiveSheet()->setCellValue('A2', 'WH Code:'); 
//   $objPHPExcel->getActiveSheet()->setCellValue('B2', $wmsData['warehouse_code']);
//   $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Associate Name:');
//   $objPHPExcel->getActiveSheet()->setCellValue('B3', $wmsData['company_name']);
//   $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Email:'); 
//   $objPHPExcel->getActiveSheet()->setCellValue('B4', $wmsData['email']);
//   $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Country:');
//   $objPHPExcel->getActiveSheet()->setCellValue('B5', $wmsData['country']);
//   $objPHPExcel->getActiveSheet()->setCellValue('A6', 'City:');
//   $objPHPExcel->getActiveSheet()->setCellValue('B6', $wmsData['city']);
  
  
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B3:C3');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:C4');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B5:C5');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B6:C6'); 
  
//   $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Warehouse Name:');
//   $objPHPExcel->getActiveSheet()->setCellValue('E2', $wmsData['warehouse_name']);
//   $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Phone:');
//   $objPHPExcel->getActiveSheet()->setCellValue('E3', $wmsData['phone_no']);
//   $objPHPExcel->getActiveSheet()->setCellValue('D4', 'Address:');
//   $objPHPExcel->getActiveSheet()->setCellValue('E4', $wmsData['address']);
//   $objPHPExcel->getActiveSheet()->setCellValue('D5', 'State:');
//   $objPHPExcel->getActiveSheet()->setCellValue('E5', $wmsData['state']);
//   $objPHPExcel->getActiveSheet()->setCellValue('D6', 'Pincode:');
//   $objPHPExcel->getActiveSheet()->setCellValue('E6', $wmsData['pincode']);
  
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E2:G2');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E3:G3');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E4:G4');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E5:G5');
//   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E6:G6');
  
  $objPHPExcel->getActiveSheet()->setCellValue('A2', 'HMDS id');
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Application id');
  $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Client Code');
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Applicant Name');
  $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Types of Checks');
  $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Case id');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Case Record date');
 
  
  
  $rowCnt = 2;
  
  $style_cell12 = array(
	  'alignment' => array(
		  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		  'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
	  )
  );

    
//   $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($style_cell12);
//   $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($style_cell12);
//   $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($style_cell12);
//   $objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($style_cell12);
//   $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($style_cell12);
  
  $style_cell = array(
	  'alignment' => array(
		  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	  )
  );
  
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
  
  $styleArray1 = array(
  'borders' => array(
	  'allborders' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
			  )
		  )
	  );
	
 //$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);
  $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray1);
  $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray1);
  $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);
  $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($style_cell);
  $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);

//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:G2')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  

  $rowCount = 3;

 $sql2 = "SELECT tp . * , ep . * FROM `tbl_application` tp, employee_personal_info_tbl ep WHERE tp.application_ref_id = ep.application_id ".$role_item."" .$srcitem."order by tp.id DESC";
// echo $sql2; die('sda');
  $result2 = mysqli_query($mycon, $sql2);
  if (mysqli_num_rows($result2) > 0) {
	while ($row = mysqli_fetch_array($result2)) {
      
$typeofcheck= getTypeOfCheckName_excel($mycon, explode(',', $row['type_of_check'])); 

       

$full_name = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];

	//   $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $process_type);
	  $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $row['hmds_id']);
	  $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row['application_ref_id']);
	  $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['client_name']);
	  $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $full_name);
	  $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $typeofcheck);
	  $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $row['case_id']);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $row['case_record_date']);
	  
	  
	  $styleArrayrows1 = array(
		  'borders' => array(
			  'allborders' => array(
				  'style' => PHPExcel_Style_Border::BORDER_THIN
					  )
				  )
			  );
	  $styleArrayrows2 = array(
			  'fill' => array(
				  'type' => PHPExcel_Style_Fill::FILL_SOLID)
		  );
		  
	  $objPHPExcel->getActiveSheet()->getStyle('A'. $rowCount.':G'. $rowCount.'')->applyFromArray($styleArrayrows1);
	  $objPHPExcel->getActiveSheet()->getStyle('A'. $rowCount.':G'. $rowCount.'')->applyFromArray($styleArrayrows2);
	  
	  $rowCount++;
	}
  } else {

	$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Not Found Data');

	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:G3');

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
  }
  
  $objPHPExcel->getDefaultStyle()->applyFromArray(array(
            'borders' => array(
                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,
                                      'color' => array('rgb' => PHPExcel_Style_Color::COLOR_WHITE)
                                      )
            )
        ));
		
//For example, you can set a red background color on a range of cells:
//$objPHPExcel->getActiveSheet()->getStyle('B3:B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');

/* A cell can be formatted with font, border, fill, … style information. For example, one can set the foreground colour of a cell to red, aligned to theright, and the border to black and thick border style. Let’s do that on cell B3:  */

/* $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getFill()->getStartColor()->setARGB('FFFF0000'); */



  $dated = date("Y-m-d h-i-s");
  $file = "MIS Report 1-" .$dated. ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $file .'"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
}
