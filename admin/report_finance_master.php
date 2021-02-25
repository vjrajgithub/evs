<?php


require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}




$colunmData = $_POST['colunmData'];
$item = $_POST['item'];
$fromdt = $_POST['fromdt'];
$todt = $_POST['todt'];

$startHour = "00:00:00";
$endHour = "23:55:55";

if (isset($_POST['fileRefno'])) {
  if(trim(strtolower($_POST['fileRefno'])) == "all" || trim(strtolower($_POST['fileRefno'])) == ""){
  $srcitem = "";      
  }else{
      $srcitem = "AND dd_no ='" . trim($_POST['fileRefno']) . "'";
  }
} else {
  $srcitem = "";
}




$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

//Fetch data from role wised
//echo $ff = $userdata['id']; die;

if ($userdata['role'] == '2' || $userdata['role'] == '3') {
    $user_location = $userdata['org_id'];
    $user_client = $userdata['client_id'];
    $role_item = " AND organization_id = '" . $user_location . "'";
    $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
} else {
    $role_item = '';
    $loc_item = '';
}


if ($_POST['department'] == 'department') {
  //include('PHPExcel.php');
  require_once 'PHPExcel/Classes/PHPExcel.php';
  $objPHPExcel = new PHPExcel();

  $objPHPExcel->setActiveSheetIndex(0);
  
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:H1');

  $objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Finance Master");

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
		'A1:H1'
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

  $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray_header);

  // $objPHPExcel->getActiveSheet()->setCellValue('A2', 'WH Code:'); 
  // $objPHPExcel->getActiveSheet()->setCellValue('B2', $wmsData['warehouse_code']);
  // $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Associate Name:');
  // $objPHPExcel->getActiveSheet()->setCellValue('B3', $wmsData['company_name']);
  // $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Email:'); 
  // $objPHPExcel->getActiveSheet()->setCellValue('B4', $wmsData['email']);
  // $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Country:');
  // $objPHPExcel->getActiveSheet()->setCellValue('B5', $wmsData['country']);
  // $objPHPExcel->getActiveSheet()->setCellValue('A6', 'City:');
  // $objPHPExcel->getActiveSheet()->setCellValue('B6', $wmsData['city']);
  
  
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B3:C3');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:C4');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B5:C5');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B6:C6'); 
  
  // $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Warehouse Name:');
  // $objPHPExcel->getActiveSheet()->setCellValue('E2', $wmsData['warehouse_name']);
  // $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Phone:');
  // $objPHPExcel->getActiveSheet()->setCellValue('E3', $wmsData['phone_no']);
  // $objPHPExcel->getActiveSheet()->setCellValue('D4', 'Address:');
  // $objPHPExcel->getActiveSheet()->setCellValue('E4', $wmsData['address']);
  // $objPHPExcel->getActiveSheet()->setCellValue('D5', 'State:');
  // $objPHPExcel->getActiveSheet()->setCellValue('E5', $wmsData['state']);
  // $objPHPExcel->getActiveSheet()->setCellValue('D6', 'Pincode:');
  // $objPHPExcel->getActiveSheet()->setCellValue('E6', $wmsData['pincode']);
  
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E2:G2');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E3:G3');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E4:G4');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E5:G5');
  // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E6:G6');
  
  $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Amount');
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'DD No');
  $objPHPExcel->getActiveSheet()->setCellValue('C2', 'DD Made or Not');
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'DD Date');
  $objPHPExcel->getActiveSheet()->setCellValue('E2', 'dd_sent_date');
  $objPHPExcel->getActiveSheet()->setCellValue('F2', 'dd_in_name_of');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'dd_for_remark');
  $objPHPExcel->getActiveSheet()->setCellValue('H2', 'created_at');
  
  
  $rowCnt = 2;
  
  $style_cell12 = array(
	  'alignment' => array(
		  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		  'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
	  )
  );

    
  // $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($style_cell12);
  // $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($style_cell12);
  // $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($style_cell12);
  // $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray($style_cell12);
  // $objPHPExcel->getActiveSheet()->getStyle('A6:H6')->applyFromArray($style_cell12);
  
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
  $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray1);
  $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray1);
  $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);
  $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($style_cell);
  $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);

//$objPHPExcel->getActiveSheet()->getColumnDimension('A2:H2')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);


  $rowCount = 3;

  $sql2 = "SELECT * FROM `finance_master` WHERE 1=1 ".$role_item."".$srcitem."  ORDER BY id DESC";

// echo $sql2; die(' sda');
  $result2 = mysqli_query($mycon, $sql2);
  if (mysqli_num_rows($result2) > 0) {
	while ($row = mysqli_fetch_array($result2)) {
        
        
      //   if ($row['location_type'] == '0') {
      //       $row['location_type'] = "";
      //     }
       
        
      //  if($row['is_two_bin_system']  == 0){
      //       $binning_type= "For both process"; 
      //   }else if($row['is_two_bin_system']  == 1){
      //       $binning_type= "Inward process"; 
      //   }else if($row['is_two_bin_system']  == 2){
      //       $binning_type= "Outward process"; 
      //   }else {
      //       $binning_type= "Not Specified"; 
      //   }
        
	  $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $row['amount']);
	  $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row['dd_no']);
	  $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['dd_made_or_not']);
	  $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row['dd_date']);
	  $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row['dd_sent_date']);
	  $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowCount, $row['dd_in_name_of']);
	  $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowCount, $row['dd_for_remark']);
	  $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowCount, $row['created_at']);
	  	  
	  
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
		  
	  $objPHPExcel->getActiveSheet()->getStyle('A'. $rowCount.':H'. $rowCount.'')->applyFromArray($styleArrayrows1);
	  $objPHPExcel->getActiveSheet()->getStyle('A'. $rowCount.':H'. $rowCount.'')->applyFromArray($styleArrayrows2);
	  
	  $rowCount++;
	}
  } else {

	$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Not Found Data');

	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:H3');

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
  $file = "Finance Master-" .$dated. ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $file .'"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
}
