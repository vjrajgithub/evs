<?php
//print_r($_POST);
//pre($_POST);
session_start();
define('FCPATH', dirname(__DIR__) . '/');
define('ABSPATH', dirname(dirname(__FILE__)) . '/');

include_once 'application-update.php';

function getConnection() {
  $dbuser = "root";
  $dbpass = "";
  $dbname = "evs_new_db";
  $mycon = mysqli_connect("localhost", $dbuser, $dbpass, $dbname);
  if (!$mycon) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $mycon;
}

function get_client_id($mycon, $client_code){
  $sql_query1 = "SELECT `customer_id` FROM `customer_master` WHERE `customer_code` ='".$client_code."'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
      $client_id = $row['customer_id'];
    }
  }
  return $client_id;
}
function get_client_name($mycon, $application_ref_id){
  $sql_query1 = "SELECT `client_name` FROM `tbl_application` WHERE `application_ref_id` ='".$application_ref_id."'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
      $client_name = $row['client_name'];
    }
  }
  return $client_name;
}

function pre($var, $exit = true) {
  echo "<pre>";
  print_r($var);
  echo "</pre>";
  if ($exit) {
    exit;
  }
}

$mycon = getConnection();


if (isset($_POST['form_type']) && $_POST['form_type'] == 'application' && !isApplicationAvailableAlready($_POST['application_id'], "tbl_application", "application_ref_id")) {
  $client_id = get_client_id($mycon, $_POST['client_name']);
  $_SESSION['application_ref_id'] = $_POST['application_id'];
   $sql = "INSERT INTO tbl_application SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "hmds_id = '" . $_POST['hmds_id'] . "',"
          . "client_name = '" . $_POST['client_name'] . "',"
          . "client_id = '" . $client_id . "',"
          . "client_location  = '" . $_POST['client_location'] . "',"
          . "case_id = '" . $_POST['case_id'] . "',"
          . "application_ref_id = '" . $_POST['application_id'] . "',"
          . "case_record_date = '" . $_POST['case_rec_date'] . "',"
          . "client_relationship_person_name = '" . $_POST['relationship_person_name'] . "',"
          . "client_contact_number = '" . $_POST['client_contact_number'] . "',"
          . "type_of_check = '" . implode(',', $_POST['type_of_check']) . "',"
          . "unique_id  = '" . $_POST['unique_id'] . "',"
          . "client_ref_number  = '" . $_POST['crn'] . "'"
          // . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " ";//die;

    // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully", "application_id" => $_POST['application_id']);
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'application' && isApplicationAvailableAlready($_POST['application_id'], "tbl_application", "application_ref_id")) {
   $json = updateApplicationInfo();
  echo json_encode($json);
  die;
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'employer' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_employment_info_tbl", "application_id")) {
  //pre($_POST);
  // echo 'insert';
  // die;
  $count = count($_POST['employer_name']);
  //die;
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "INSERT INTO employee_employment_info_tbl SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "employer_name = '" . $_POST['employer_name'][$i] . "',"
            . "date_of_joining   = '" . $_POST['fromdt'][$i] . "',"
            . "date_of_relieving  = '" . $_POST['todt'][$i] . "',"
            . "designation  = '" . $_POST['position'][$i] . "',"
            . "department = '" . $_POST['department'][$i] . "',"
            . "reason_for_leaving = '" . $_POST['reason_for_Leaving'][$i] . "',"
            . "branch_address = '" . $_POST['empaddress'][$i] . "',"
            . "salary = '" . $_POST['salary'][$i] . "',"
            . "company_phone = '" . $_POST['telephone'][$i] . "',"
            . "reporting_mngr_name = '" . $_POST['reporting_manager_name'][$i] . "',"
            . "verification_mode = '" . $_POST['verification_mode'][$i] . "',"
            . "order_no = '" . $i . "',"
            . "company_name = '" . $_POST['company_name'][$i] . "'"
            . " ";
    // die;
    // echo $sql; die;
    mysqli_query($mycon, $sql);
    //$image_url = uploadImageMulti($_FILES['certificate_file'], $i);
    $image_url = uploadImageArray($_FILES['certificate_file' . ($i + 1)]);
    $result = uploadDoc($image_url, 'employer', 'employer' . $i, $_POST['certificate_number'][$i]);
  }
  if ($result) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
//mysqli_close($mycon);
  echo json_encode($json);
  die;
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'employer' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_employment_info_tbl", "application_id")) {
  
  $json = updateEmployerInfo();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'personal' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_personal_info_tbl", "application_id")) {
//  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  //echo 'hhh';
  //die;
  $image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_personal_info_tbl SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "firstName = '" . $_POST['firstname'] . "',"
          . "lastName = '" . $_POST['lastname'] . "',"
          . "fatherName  = '" . $_POST['fathername'] . "',"
          . "phoneNo  = '" . $_POST['phone'] . "',"
          . "alternateContact = '" . $_POST['alternate_contact_no'] . "',"
          . "is_are_you_legally_eligible_for_employment_in_the_india  = '" . $_POST['is_eligible'] . "',"
          . "middleName = '" . $_POST['middlename'] . "',"
          . "dob = '" . $_POST['dob'] . "',"
          . "email = '" . $_POST['email'] . "',"
          . "profile_image = '" . $_FILES['passport_photo']['name'] . "',"
          . "gender  = '" . $_POST['gender'] . "'"
          . " ";

  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'personal' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_personal_info_tbl", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updatePersonalInfo();

  echo json_encode($json);
  die;
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'bank' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "bank_statement_info", "application_id")) {
  //pre($_FILES);
  $image_url = uploadImageArray($_FILES['bank_statement_doc']);
  $sql = "INSERT INTO bank_statement_info SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "bank_name = '" . $_POST['bank_name'] . "',"
          . "bank_holder_name = '" . $_POST['account_holder_name'] . "',"
          . "account_no  = '" . $_POST['account_number'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "',"
          . "period_of_verif  = '" . $_POST['period_of_verif'] . "',"
          . "bank_branch = '" . $_POST['branch_name'] . "'"
          . " ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, "bank", "Bank Statement", $_POST['account_number'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'bank' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "bank_statement_info", "application_id")) {
  $json = updateBankInfo();
  echo json_encode($json);
  die;
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'cibil' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_cibil_info", "application_id")) {
  //pre($_POST);
  $image_url = uploadImage($_FILES['cibil_doc']);
  $sql = "INSERT INTO employee_cibil_info SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "pancard_no = '" . $_POST['pancard_no'] . "',"
          // . "aadhar_no = '" . $_POST['aadhar_no'] . "',"
          // . "mobile  = '" . $_POST['mobile'] . "',"
          // . "email  = '" . $_POST['email'] . "',"
          // . "occupation  = '" . $_POST['occupation'] . "',"
          // . "monthly_income  = '" . $_POST['monthly_income'] . "',"
          // . "annual_income  = '" . $_POST['annual_income'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          // . "net_and_gross_income  = '" . $_POST['net_and_gross_income'] . "'"
          . " ";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, "cibil", "CIBIL Statement", $_POST['pancard_no'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'cibil' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_cibil_info", "application_id")) {
  $json = updateCIBILInfo();
  echo json_encode($json);
  die;
}

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'identity_verif' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_identity_verif", "application_id")) {
//  isApplicationAvailableAlready($_SESSION['application_ref_id']);

  // $image_url = uploadImage($_FILES['doc_file']);
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['identity_doc']);

  $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
  $client_id = get_client_id($mycon, $client_name);
  $sql = "INSERT INTO employee_identity_verif SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "client_id = '" . $client_id . "',"
          
          . "type_of_identity = '" . $_POST['identity_type_doc'] . "',"
          . "document_no = '" . $_POST['identity_doc_desc'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " ";
        // echo $sql; die;
  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'identity_verif_doc', $_POST['identity_type_doc'], $_POST['identity_doc_desc'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'identity_verif' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_identity_verif", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateidentityInfo();

  echo json_encode($json);
  die;
}

// =======================global_base_check==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'gbc' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_global_base_check", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_global_base_check SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'gbc_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'gbc' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_global_base_check", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = updateGBCInfo();
  
    echo json_encode($json);
    die;
  }


// =======================end global_base_check==================

// =======================socal_security_number==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'ssn' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_socal_security_number", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_socal_security_number SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "ss_no = '" . $_POST['ss_no'] . "',"
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'ssn_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'ssn' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_socal_security_number", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = updateSSNInfo();
  
    echo json_encode($json);
    die;
  }


// =======================end socal_security_number==================

// =======================criminal_background==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'criminal_back' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_criminal_background", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_criminal_background SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'criminal_back_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'criminal_back' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_criminal_background", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = updateCriminal_backInfo();
  
    echo json_encode($json);
    die;
  }


// =======================end criminal_background==================

// =======================global_sanctions==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'global_sanctions' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_global_sanctions", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_global_sanctions SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'global_sanctions_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'global_sanctions' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_global_sanctions", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = update_global_sanctions_Info();
  
    echo json_encode($json);
    die;
  }


// =======================end global_sanctions==================

// =======================national_sex_registry==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'nsr' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_national_sex_registry", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_national_sex_registry SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'nsr_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'nsr' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_national_sex_registry", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = updateNSRInfo();
  
    echo json_encode($json);
    die;
  }


// =======================end national_sex_registry==================

// =======================court Record==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'court_rec' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_court_record", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_court_record SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'court_rec_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'court_rec' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_court_record", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = update_court_Info();
  
    echo json_encode($json);
    die;
  }


// =======================end court Record==================
// =======================Drug ==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'drug' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_drug_test", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_drug_test SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "document_no = '" . $_POST['doc_no'] . "',"
            
            . "panel = '" . implode(',', $_POST['type_of_panel']). "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'drug_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'drug' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_drug_test", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = update_drug_Info();
  
    echo json_encode($json);
    die;
  }


// =======================end Drug ==================
// =======================Company Verification ==================

if (isset($_POST['form_type']) && trim($_POST['form_type']) == 'comp_verif' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_company_verifaction", "application_id")) {
  //  isApplicationAvailableAlready($_SESSION['application_ref_id']);
  
  $image_url = uploadImageArray($_FILES['doc']);
    // $image_url = uploadImage($_FILES['doc']);
    $client_name = get_client_name($mycon, $_SESSION['application_ref_id']);
    $client_id = get_client_id($mycon, $client_name);
    $sql = "INSERT INTO employee_company_verifaction SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_SESSION['application_ref_id'] . "',"
            . "client_id = '" . $client_id . "',"
            
            . "company_name = '" . $_POST['company_name'] . "',"
            . "company_address = '" . $_POST['company_add'] . "',"
            . "contact_no = '" . $_POST['phone'] . "',"
            . "contact_person_no = '" . $_POST['contact_person_no'] . "',"
            . "company_email = '" . $_POST['email'] . "',"
            . "company_location = '" . $_POST['company_location'] . "',"
            . "document_no = '" . $_POST['doc_no'] . "',"
            . "verification_mode  = '" . $_POST['verification_mode'] . "'"
            . " ";
          // echo $sql; die;
    if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'company_doc', $_POST['doc_type'], $_POST['doc_no'])) {
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    } else {
  
      $json = array("status" => 0, "msg" => "Server Error");
    }
    mysqli_close($mycon);
    echo json_encode($json);
  } elseif (isset($_POST['form_type']) && trim($_POST['form_type']) == 'comp_verif' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_company_verifaction", "application_id")) {
    //echo "TTTTT";
    //die;
  
    $json = update_comp_verif_Info();
  
    echo json_encode($json);
    die;
  }


// =======================end Company Verification ==================


if (isset($_POST['form_type']) && $_POST['form_type'] == 'add_customer') {
  $sql = "INSERT INTO customer_master SET "
          . "customer_name = '" . $_POST['customer_name'] . "',"
          . "customer_code = '" . $_POST['customer_code'] . "',"
          . "concerned_person  = '" . $_POST['concerned_person'] . "',"
          . "phone_number  = '" . $_POST['phone_number'] . "',"
          . "office_no  = '" . $_POST['office_no'] . "',"
          . "email  = '" . $_POST['email'] . "',"
          . "region  = '" . $_POST['region'] . "',"
          . "customer_group  = '" . $_POST['customer_group'] . "',"
          . "gst_reg_number  = '" . $_POST['gst_reg_number'] . "',"
          . "company_name  = '" . $_POST['company_name'] . "',"
          . "country  = '" . $_POST['country'] . "',"
          . "state  = '" . $_POST['state'] . "',"
          . "city  = '" . $_POST['city'] . "',"
          . "pincode  = '" . $_POST['pincode'] . "',"
          . "address1  = '" . $_POST['address'] . "'"
          . " ";
  //die;

  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'update_customer') {
  $json = updateCustomerInfo();
  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'address' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_address", "application_id")) {
  //echo 'addresssssssssssss';
  //die;
//  pre($_FILES, FALSE);
//  pre($_POST);
// echo isset($_POST['sameadd']);
// die;

  $image_url = uploadImageArray($_FILES['address_doc']);
  $home_image_url = uploadImageArray($_FILES['home_address_doc']);
//  die;
  $sqlAddress = "INSERT INTO employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['address'] . "',"
          . "city = '" . $_POST['city'] . "',"
          . "state  = '" . $_POST['state'] . "',"
          . "country = '" . $_POST['country'] . "',"
          . "pin_code  = '" . $_POST['pincode'] . "',"
          . "landmark = '" . $_POST['landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "address_type = '1'"
          . " ";
  $sqlHomeAddress = "INSERT INTO employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['homeaddress'] . "',"
          . "city = '" . $_POST['homecity'] . "',"
          . "state  = '" . $_POST['homestate'] . "',"
          . "country = '" . $_POST['homecountry'] . "',"
          . "pin_code  = '" . $_POST['homepincode'] . "',"
          . "landmark = '" . $_POST['home_landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "address_type = '2'"
          . " ";
          if(isset($_POST['sameadd'])) {
            $sqlHomeAddress = "INSERT INTO employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['address'] . "',"
          . "city = '" . $_POST['city'] . "',"
          . "state  = '" . $_POST['state'] . "',"
          . "country = '" . $_POST['country'] . "',"
          . "pin_code  = '" . $_POST['pincode'] . "',"
          . "landmark = '" . $_POST['landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "address_type = '2'"
          . " ";
          $home_image_url = uploadImageArray($_FILES['address_doc']);
          }

  if (mysqli_query($mycon, $sqlAddress) && mysqli_query($mycon, $sqlHomeAddress) && uploadDoc($home_image_url, 'home_address', $_POST['home_address_doc_type'], $_POST['home_address_doc_desc']) && uploadDoc($image_url, 'present_address', $_POST['address_doc_type'], $_POST['address_doc_desc'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'address' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_address", "application_id")) {
  $json = updateAddressInfo();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'education' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_education_tbl", "application_id")) {
  //echo 'ttttt';
//  pre($_FILES);
//  die;
//   $mycon = getConnection();
  
  $school_image_url = uploadImageArray($_FILES['high_school_doc_file']);
  // die($school_image_url);
  $intermediate_image_url = uploadImageArray($_FILES['intermediate_doc_file']);
  $graduation_image_url = uploadImageArray($_FILES['graduation_doc_file']);
  $post_graduation_image_url = uploadImageArray($_FILES['post_graduation_doc_file']);
  $diploma_image_url = uploadImageArray($_FILES['diploma_doc_file']);


  if (
          insertEducation("1", "High School (10)", $_POST['high_school_school'], $_POST['high_school_roll_number'], $_POST['high_school_passing_year'], $_POST['high_school_board'], $_POST['verification_mode']) && insertEducation("2", "Intermediate (10+2)", $_POST['intermediate_school'], $_POST['intermediate_roll_no'], $_POST['intermediate_passing_year'], $_POST['intermediate_board'], $_POST['verification_mode_inter']) && insertEducation("3", "Graduation", $_POST['graduation_school'], $_POST['graduation_roll_no'], $_POST['graduation_passing_year'], $_POST['graduation_board'], $_POST['verification_mode_grad'], $_POST['graduation_degree']) && insertEducation("4", "Post Graduation", $_POST['post_graduation_school'], $_POST['post_graduation_roll_no'], $_POST['post_graduation_passing_year'], $_POST['post_graduation_board'], $_POST['verification_mode_pg'], $_POST['post_graduation_degree']) && insertEducation("5", "Diploma", $_POST['diploma_school'], $_POST['diploma_roll_no'], $_POST['diploma_passing_year'], $_POST['diploma_board'], $_POST['verification_mode_diploma'], $_POST['diploma'])
  ) {
    uploadDoc($school_image_url, 'highschool', 'education', $_POST['high_school_doc_number']);
    uploadDoc($intermediate_image_url, 'intermediate', 'education', $_POST['intermediate_doc_number']);
    uploadDoc($graduation_image_url, 'graduation', 'education', $_POST['graduation_doc_number']);
    uploadDoc($post_graduation_image_url, 'post graduation', 'education', $_POST['post_graduation_doc_number']);
    uploadDoc($diploma_image_url, 'diploma', 'education', $_POST['diploma_doc_number']);
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}else if(isset($_POST['form_type']) && $_POST['form_type'] == 'education' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_education_tbl", "application_id")){
  $json = updateEducationInfo();
  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'reference' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_reference", "application_id")) {

  if (
          insertReference("1", "2", $_POST['name_pr1'], $_POST['phone_pr1'], $_POST['city_pr1'], $_POST['country_pr1'], $_POST['pincode_pr1'], $_POST['email_pr1'], $_POST['relation_pr1'], $_POST['address_pr1'], $_POST['state_pr1'], $_POST['landmark_pr1'], $_POST['verification_mode1']) && insertReference("2", "2", $_POST['name_pr2'], $_POST['phone_pr2'], $_POST['city_pr2'], $_POST['country_pr2'], $_POST['pincode_pr2'], $_POST['email_pr2'], $_POST['relation_pr2'], $_POST['address_pr2'], $_POST['state_pr2'], $_POST['landmark_pr2'], $_POST['verification_mode2']) && insertReference("3", "1", $_POST['name_perr1'], $_POST['phone_perr1'], $_POST['city_perr1'], $_POST['country_perr1'], $_POST['pincode_perr1'], $_POST['email_perr1'], $_POST['relation_perr1'], $_POST['address_perr1'], $_POST['state_perr1'], $_POST['landmark_perr1'], $_POST['verification_mode3']) && insertReference("4", "1", $_POST['name_perr2'], $_POST['phone_perr2'], $_POST['city_perr2'], $_POST['country_perr2'], $_POST['pincode_perr2'], $_POST['email_perr2'], $_POST['relation_perr2'], $_POST['address_perr2'], $_POST['state_perr2'], $_POST['landmark_perr2'], $_POST['verification_mode4'])
  ) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'reference' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_reference", "application_id")) {
  $json = updateReferenceInfo();

  echo json_encode($json);
  die;
}
//pre($_POST);
if (isset($_POST['form_type']) && $_POST['form_type'] == 'verification' && !isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_police_verification", "application_id")) {
  // echo 'insert';
  //die;
  // pre($_FILES, FALSE);
  // pre($_POST);
  $image_url = uploadImageArray($_FILES['address_proof']);
  $sql = "INSERT INTO employee_police_verification SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "first_name = '" . $_POST['firstname_police'] . "',"
          . "middle_name = '" . $_POST['middlename_police'] . "',"
          . "last_name = '" . $_POST['lastname_police'] . "',"
          . "address  = '" . $_POST['address_police'] . "',"
          . "landmark = '" . $_POST['landmark_police'] . "',"
          // . "village  = '" . $_POST['village_police'] . "',"
          . "state = '" . $_POST['state_police'] . "',"
          . "city = '" . $_POST['city_police'] . "',"
          . "police_station = '" . $_POST['police_station'] . "',"
          // . "house_no = '" . $_POST['house_no_police'] . "',"
          // . "street_no = '" . $_POST['streetNo'] . "',"
          // . "area = '" . $_POST['area'] . "',"
          . "post_office = '" . $_POST['postoffice'] . "',"
          // . "district = '" . $_POST['district_police'] . "',"
          . "pincode = '" . $_POST['pincode_police'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "country = '" . $_POST['country_police'] . "'"
          . " ";
//die;
    // echo $sql; die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'police', 'verification doc', $_POST['verification_doc_number'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'verification' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_police_verification", "application_id")) {
  $json = updateVerificationInfo();

  echo json_encode($json);
  die;
}
if (isset($_POST['action']) && isset($_POST['application_id'])) {
  $mycon = getConnection();
//  echo $sqlDeleteApplication = "DELETE  tbl_application, employee_personal_info_tbl,employee_address,employee_education_tbl,employee_employment_info_tbl,employee_police_verification,employee_reference from tbl_application  "
//  . " inner join employee_personal_info_tbl "
//  . " inner join employee_address "
//  . " inner join employee_education_tbl "
//  . " inner join employee_employment_info_tbl "
//  . " inner join employee_police_verification "
//  . " inner join employee_reference "
//  . " inner join document_upload "
//          . " WHERE tbl_application.application_ref_id = employee_personal_info_tbl.application_id"
//          . " AND employee_personal_info_tbl.application_id = employee_address.application_id"
//          . " AND employee_address.application_id = employee_education_tbl.application_id"
//          . " AND employee_education_tbl.application_id = employee_employment_info_tbl.application_id"
//          . " AND employee_employment_info_tbl.application_id = employee_police_verification.application_id"
//          . " AND employee_police_verification.application_id = employee_reference.application_id"
//          . " AND employee_reference.application_id = document_upload.application_id"
//  . " AND employee_reference.application_id = '" . $_POST['application_id'] . "'";
//  die;


  $sqlDeleteApplication = "DELETE  tbl_application,employee_personal_info_tbl,employee_address,employee_education_tbl,employee_employment_info_tbl,employee_police_verification,employee_reference,bank_statement_info,employee_cibil_info from tbl_application  "
          . " LEFT join employee_personal_info_tbl ON tbl_application.application_ref_id = employee_personal_info_tbl.application_id"
          . " LEFT join employee_address ON tbl_application.application_ref_id = employee_address.application_id"
          . " LEFT join employee_education_tbl ON tbl_application.application_ref_id = employee_education_tbl.application_id"
          . " LEFT join employee_employment_info_tbl ON tbl_application.application_ref_id = employee_employment_info_tbl.application_id"
          . " LEFT join employee_police_verification ON tbl_application.application_ref_id = employee_police_verification.application_id"
          . " LEFT join employee_reference ON tbl_application.application_ref_id = employee_reference.application_id"
          . " LEFT join bank_statement_info ON tbl_application.application_ref_id = bank_statement_info.application_id"
          . " LEFT join employee_cibil_info ON tbl_application.application_ref_id = employee_cibil_info.application_id"
          . " Where tbl_application.application_ref_id = '" . $_POST['application_id'] . "'";
  // die;

  if (mysqli_query($mycon, $sqlDeleteApplication)) {
    $json = array("status" => 1, "msg" => "Data Deleted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}

if (isset($_POST['action']) && ($_POST['action'] = 'delete') && isset($_POST['customer_id'])) {
  $mycon = getConnection();
  $sql = "UPDATE customer_master SET "
          . "customer_status  = '0'"
          . " WHERE customer_id  = '" . $_POST['customer_id'] . "' ";


  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Deleted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}

function insertEducation($order_no, $qualification, $institute, $rollNo, $passingYear, $univercity,$verification_mode, $course = null) {
  $mycon = getConnection();
  $sqlInsertEducation = "INSERT INTO employee_education_tbl SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "qualification  = '" . $qualification . "',"
          . "course  = '" . $course . "',"
          . "college_institute  = '" . $institute . "',"
          . "roll_no = '" . $rollNo . "',"
          . "passing_year  = '" . $passingYear . "',"
          . "order_no  = '" . $order_no . "',"
          . "verification_mode  = '" . $verification_mode . "',"
          . "university_board = '" . $univercity . "'"
          . " ";
        //   echo $sqlInsertEducation, die;
          
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function insertReference($order_no, $rType, $name, $phone, $city, $country, $pincode, $email, $relation, $address, $state, $landmark, $verification_mode) {
  $mycon = getConnection();
  $sqlInsertRefference = "INSERT INTO employee_reference SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "reference_type  = '" . $rType . "',"
          . "name  = '" . $name . "',"
          . "phone_no = '" . $phone . "',"
          . "city  = '" . $city . "',"
          . "country  = '" . $country . "',"
          . "pin_code  = '" . $pincode . "',"
          . "email_address  = '" . $email . "',"
          . "relation  = '" . $relation . "',"
          . "address  = '" . $address . "',"
          . "state  = '" . $state . "',"
          . "order_no  = '" . $order_no . "',"
          . "verification_mode  = '" . $verification_mode . "',"
          . "landmark = '" . $landmark . "'"
          . " ";
  if (mysqli_query($mycon, $sqlInsertRefference)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function isApplicationAvailableAlready($applicationId, $table, $appfield) {
  $mycon = getConnection();
  $sql = "SELECT id FROM " . $table . "  WHERE " . $appfield . " = '" . $applicationId . "'";
  $result1 = mysqli_query($mycon, $sql);
  //echo mysqli_num_rows($result1);
  if (mysqli_num_rows($result1) > 0) {
     // echo "1";
    return TRUE;
  } else {
     // echo "0";
    return FALSE;
  }
}

function uploadDoc($image_url, $type, $title, $desc) {
  $mycon = getConnection();
  $sqlAddressDoc = "INSERT INTO document_upload SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "title = '" . $title . "',"
          . "related_to = '" . $type . "',"
          . "document_no  = '" . $desc . "',"
          . "filename = '" . $image_url . "'"
          . " ";

          // die($$_FILES['passport_photo']['name']);
  if (mysqli_query($mycon, $sqlAddressDoc)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function uploadImageMulti($fileName, $i) {
//echo 'jjjjjjjjjjjjjhhh';
//die;
  pre($fileName['name'][$i]);
//echo basename($fileName['name'][$i]);
//die;
  if ((!empty($fileName)) && ($fileName['error'][$i] == 0)) {
    $filename = basename($fileName['name'][$i]);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if (($ext == "jpg" && $fileName["type"][$i] == 'image/jpeg') || ($ext == "png" && $fileName["type"][$i] == 'image/png') || ($ext == "gif" && $fileName["type"][$i] == 'image/gif')) {
      $temp = explode(".", $fileName["name"][$i]);
      $newfilename = $fileName["name"][$i];
      // $newfilename = NewGuid() . '.' . end($temp);
      move_uploaded_file($fileName["tmp_name"][$i], FCPATH . '/images/application/' . $newfilename);
      return $newfilename;
    } else {
      return '';
    }
  }
  return '';
}

function uploadImage($fileName) {
  // die('sdfdsfsdfsdf');
  if ((!empty($fileName)) && ($fileName['error'] == 0)) {
    $filename = basename($fileName['name']);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if (($ext == "jpg" && $fileName["type"] == 'image/jpeg') || ($ext == "png" && $fileName["type"] == 'image/png') || ($ext == "gif" && $fileName["type"] == 'image/gif')) {
      $temp = explode(".", $fileName["name"]);
      
      $newfilename = $fileName["name"];
      // $newfilename = NewGuid() . '.' . end($temp);
      move_uploaded_file($fileName["tmp_name"], FCPATH . '/images/application/' . $newfilename);
      // die($newfilename."sdfdsfsdfds".FCPATH);
      return $newfilename;
    } else {
      return '';
    }
  }
  return '';
}

function uploadImageArray($fileName) {
  $nameString = '';
  //pre($fileName);
  // die("sfsdfdsfdsf");

  $arrayCount = count($fileName['name']);
  for ($i = 0; $i <= ($arrayCount - 1); $i++) {
    if ((!empty($fileName)) && ($fileName['error'][$i] == 0)) {
      $filename = basename($fileName['name'][$i]);
      $ext = substr($filename, strrpos($filename, '.') + 1);
      if (($ext == "jpg" && $fileName["type"][$i] == 'image/jpeg') || ($ext == "png" && $fileName["type"][$i] == 'image/png') || ($ext == "gif" && $fileName["type"][$i] == 'image/gif') || ($ext == "pdf" && $fileName["type"][$i] == 'application/pdf')) {
        $temp = explode(".", $fileName["name"][$i]);
        $newfilename =  $fileName["name"][$i];
        // $newfilename = NewGuid() . '.' . end($temp);
        move_uploaded_file($fileName["tmp_name"][$i], FCPATH . '/images/application/' . $newfilename);
        //CHANGE  fileName["name"][$i] TO  newfilename for UNIQUE REFFERENCE OF DOCUMENT WITH fileName["name"][$i] IT WILL BE SAVED WITH DEFAULT NAME OF DOCUMENT.
        $nameString = $nameString . $fileName["name"][$i];
      } else {
        $nameString = '';
      }
    }
  }
  return $nameString;
}

function NewGuid() {
  $s = strtoupper(md5(uniqid(rand(), true)));
  $guidText = substr($s, 0, 8) . '-' .
          substr($s, 8, 4) . '-' .
          substr($s, 12, 4) . '-' .
          substr($s, 16, 4) . '-' .
          substr($s, 20);

  return $guidText;
}
