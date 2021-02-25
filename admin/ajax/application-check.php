<?php

//pre($_POST);
session_start();
define('FCPATH', dirname(__DIR__) . '/');
define('ABSPATH', dirname(dirname(__FILE__)) . '/');

include_once 'application-update-check.php';

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
function check_application_status($mycon, $applicationId,$check_status ){
  $result=false;
  $sql_query= "SELECT * FROM `tbl_application` WHERE application_ref_id = '".$applicationId."'";
  // echo $sql_query; die;
  $result = mysqli_query($mycon, $sql_query );
  if(mysqli_num_rows($result) > 0 ){
    $rows= mysqli_fetch_assoc($result);
    if($rows['application_status'] == $check_status){

      $result = True;
    }
    
  }

  return $result;

}

function get_application_status_no($mycon, $applicationId ){
  
  $sql_query= "SELECT * FROM `tbl_application` WHERE application_ref_id = '".$applicationId."'";
  // echo $sql_query; die;
  $result = mysqli_query($mycon, $sql_query );
  if(mysqli_num_rows($result) > 0 ){
    $rows= mysqli_fetch_assoc($result);
     
    return $rows['application_status'];
    
  }

  

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

if (isset($_POST['form_type']) && $_POST['form_type'] == 'application' && !isApplicationAvailableAlready($_POST['application_id'], "tbl_application_check", "application_id")) {
  //pre($_POST);
  //echo "hjghfdj";
  //die;
  //$_SESSION['application_ref_id'] = $_POST['application_id'];
  $sql = "INSERT INTO tbl_application_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_verify = '" . $_POST['is_verify'] . "',"
          . "complete_status_check = '" . $_POST['complete_status_check'] . "',"
          . "is_personal_details_checked = '" . $_POST['is_personal_details_checked'] . "',"
          . "is_address_details_checked = '" . $_POST['is_address_details_checked'] . "',"
          . "is_education_details_checked = '" . $_POST['is_education_details_checked'] . "',"
          . "is_emp_details_checked = '" . $_POST['is_emp_details_checked'] . "',"
          . "is_police_verification_checked = '" . $_POST['is_police_verification_checked'] . "',"
          . "is_bank_details_checked = '" . $_POST['is_bank_details_checked'] . "',"
          . "is_cibil_details_checked = '" . $_POST['is_cibil_details_checked'] . "',"
          . "is_relation_details_checked = '" . $_POST['is_relation_details_checked'] . "'"
          . " ";

          $sqlCheck = "UPDATE tbl_application SET "
          . "application_status = '6'"
          . " WHERE application_ref_id  = '" . $_POST['application_id'] . "' ";
//   echo $sql; die;


  if (mysqli_query($mycon, $sql)) {
    // $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    // echo "check_application_status : ".check_application_status($mycon, $_POST['application_id'], 4);
    $application_status_check = get_application_status_no($mycon, $_POST['application_id']);
    // die;
    if($_POST['complete_status_check']==1 && $application_status_check != 4 ){
      mysqli_query($mycon, $sqlCheck);
      $json = array("status" => 1, "msg" => "Data Submitted Sucessfully and Application status Updated");
    }elseif($_POST['complete_status_check']==1 && $application_status_check == 4){
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully however Request for Payment is Raised");

    }else{
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");

    }
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'application' && isApplicationAvailableAlready($_POST['application_id'], "tbl_application_check", "application_id")) {
  //echo "TTTTT";
  //die;
  $json = updateApplicationCheckInfo();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'employer' && !isApplicationAvailableAlready($_POST['application_id'], "employee_employment_info_tbl_check", "application_id")) {
  //pre($_POST);
  //echo 'insert';
  //die;
  $count = count($_POST['verifier_name']);
  //die;
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "INSERT INTO employee_employment_info_tbl_check SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_POST['application_id'] . "',"
            . "verifier_name = '" . $_POST['verifier_name'][$i] . "',"
            . "verifier_designation   = '" . $_POST['verifier_designation'][$i] . "',"
            . "verifier_remark  = '" . $_POST['verifier_remark'][$i] . "',"
            . "how_was_the_candidate_behavior_during_tenure   = '" . $_POST['was_the_candidate_behavior_during_tenure'][$i] . "',"
            . "eligible_for_rehire  = '" . $_POST['eligible_for_rehire'][$i] . "',"
            . "employee_employment_info_tbl_id = '" . $_POST['employer_id'][$i] . "'"
            . " ";
    //die;

    mysqli_query($mycon, $sql);

    $image_url = uploadImageArray($_FILES['certificate_file' . ($i + 1)]);

    $result = uploadDoc($image_url, 'employer_verification', 'employer' . $i, $_POST['certificate_number'][$i]);
  }
  if ($result) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
//mysqli_close($mycon);
  echo json_encode($json);
  die;
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'employer' && isApplicationAvailableAlready($_POST['application_id'], "employee_employment_info_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;
  $json = updateEmployerInfoCheck();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'personal' && !isApplicationAvailableAlready($_POST['application_id'], "employee_personal_info_tbl_check", "application_id")) {
  //pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_personal_info_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_personal_info_tbl_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";

  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'personal' && isApplicationAvailableAlready($_POST['application_id'], "employee_personal_info_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updatePersonalInfoCheck();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'address' && !isApplicationAvailableAlready($_POST['application_id'], "employee_address_check", "application_id")) {
  $count = count($_POST['verifier_name']);
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "INSERT INTO employee_address_check SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_POST['application_id'] . "',"
            . "employee_address_id = '" . $_POST['address_id'][$i] . "',"
            . "accommodation_type   = '" . $_POST['accommodation_type' . $i][0] . "',"
            . "how_many_years_candidate_is_residing  = '" . $_POST['living_period'][$i] . "',"
            . "verifier_relationship  = '" . $_POST['verifier_relationship'][$i] . "',"
            . "sign_of_respondent = '" . $_POST['sign_of_respondent'][$i] . "',"
            . "contact_of_respondent = '" . $_POST['contact_of_respondent'][$i] . "',"
            . "verifier_name = '" . $_POST['verifier_name'][$i] . "',"
            . "verifier_designation = '" . $_POST['verifier_designation'][$i] . "',"
            . "verifier_remark = '" . $_POST['verifier_remark'][$i] . "',"
            . "is_verify = '" . $_POST['is_verify' . $i][0] . "'"
            . " ";

    mysqli_query($mycon, $sql);

    //$image_url = uploadImageMulti($_FILES['address_doc'], $i);
    $image_url = uploadImageArray($_FILES['address_doc']);
    $result = uploadDoc($image_url, 'address_verification', '', 'Address Verification Docs' . $i);
  }
  if ($result) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
//mysqli_close($mycon);
  echo json_encode($json);
  die;
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'address' && isApplicationAvailableAlready($_POST['application_id'], "employee_address_check", "application_id")) {
  $json = updateAddressCheckInfo();
  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'education' && !isApplicationAvailableAlready($_POST['application_id'], "employee_education_tbl_check", "application_id")) {
  //echo 'ttttt';
  //pre($_POST, FALSE);
  //pre($_FILES);
  //die;
  $school_image_url = uploadImageArray($_FILES['high_school_doc_file']);
  $intermediate_image_url = uploadImageArray($_FILES['intermediate_doc_file']);
  $graduation_image_url = uploadImageArray($_FILES['graduation_doc_file']);
  $post_graduation_image_url = uploadImageArray($_FILES['post_graduation_doc_file']);
  $diploma_image_url = uploadImageArray($_FILES['diploma_doc_file']);


  if (
          insertEducation($_POST['high_school_id'], $_POST['is_emp_name_correct_10'], $_POST['is_rollno_correct_10'], $_POST['is_university_correct_10'], $_POST['is_institute_correct_10'], $_POST['is_passing_year_correct_10'], $_POST['verifier_name_10'], $_POST['verifier_designation_10'], $_POST['verifier_remark_10']) && insertEducation($_POST['intermediate_id'], $_POST['is_emp_name_correct_12'], $_POST['is_rollno_correct_12'], $_POST['is_university_correct_12'], $_POST['is_institute_correct_12'], $_POST['is_passing_year_correct_12'], $_POST['verifier_name_12'], $_POST['verifier_designation_12'], $_POST['verifier_remark_12']) && insertEducation($_POST['graduation_degree_id'], $_POST['is_emp_name_correct_grad'], $_POST['is_rollno_correct_grad'], $_POST['is_university_correct_grad'], $_POST['is_institute_correct_grad'], $_POST['is_passing_year_correct_grad'], $_POST['verifier_name_grad'], $_POST['verifier_designation_grad'], $_POST['verifier_remark_grad']) && insertEducation($_POST['post_graduation_degree_id'], $_POST['is_emp_name_correct_pgrad'], $_POST['is_rollno_correct_pgrad'], $_POST['is_university_correct_pgrad'], $_POST['is_institute_correct_pgrad'], $_POST['is_passing_year_correct_pgrad'], $_POST['verifier_name_pgrad'], $_POST['verifier_designation_pgrad'], $_POST['verifier_remark_pgrad']) && insertEducation($_POST['diploma'], $_POST['is_emp_name_correct_diploma'], $_POST['is_rollno_correct_diploma'], $_POST['is_university_correct_diploma'], $_POST['is_institute_correct_diploma'], $_POST['is_passing_year_correct_diploma'], $_POST['verifier_name_diploma'], $_POST['verifier_designation_diploma'], $_POST['verifier_remark_diploma']
          )
  ) {
    uploadDoc($school_image_url, 'verify_education', 'highschool', $_POST['high_school_doc_number']);
    uploadDoc($intermediate_image_url, 'verify_education', 'intermediate', $_POST['intermediate_doc_number']);
    uploadDoc($graduation_image_url, 'verify_education', 'graduation', $_POST['graduation_doc_number']);
    uploadDoc($post_graduation_image_url, 'verify_education', 'post graduation', $_POST['post_graduation_doc_number']);
    uploadDoc($diploma_image_url, 'verify_education', 'diploma', $_POST['diploma_doc_number']);
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'education' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_education_tbl", "application_id")) {
  $json = updateEducationInfo();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'reference' && !isApplicationAvailableAlready($_POST['application_id'], "employee_reference_check", "application_id")) {
  //pre($_POST);
  if (
          insertReference($_POST['id'][0], $_POST['verifier_name'][0], $_POST['verifier_designation'][0], $_POST['verifier_remark'][0], $_POST['about_candidate_during_period'][0], $_POST['about_association_period'][0], $_POST['self_improvement'][0], $_POST['general_reputation'][0], $_POST['ratings1'], $_POST['is_verify1']) && insertReference($_POST['id'][1], $_POST['verifier_name'][1], $_POST['verifier_designation'][1], $_POST['verifier_remark'][1], $_POST['about_candidate_during_period'][1], $_POST['about_association_period'][1], $_POST['self_improvement'][1], $_POST['general_reputation'][1], $_POST['ratings2'], $_POST['is_verify2']) && insertReference($_POST['id'][2], $_POST['verifier_name'][2], $_POST['verifier_designation'][2], $_POST['verifier_remark'][2], $_POST['about_candidate_during_period'][2], $_POST['about_association_period'][2], $_POST['self_improvement'][2], $_POST['general_reputation'][2], $_POST['ratings3'], $_POST['is_verify3']) && insertReference($_POST['id'][3], $_POST['verifier_name'][3], $_POST['verifier_designation'][3], $_POST['verifier_remark'][3], $_POST['about_candidate_during_period'][3], $_POST['about_association_period'][3], $_POST['self_improvement'][3], $_POST['general_reputation'][3], $_POST['ratings4'], $_POST['is_verify4'])
  ) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'reference' && isApplicationAvailableAlready($_SESSION['application_ref_id'], "employee_reference", "application_id")) {
  $json = updateReferenceInfoCheck();

  echo json_encode($json);
  die;
}
//pre($_POST);
if (isset($_POST['form_type']) && $_POST['form_type'] == 'verification' && !isApplicationAvailableAlready($_POST['application_id'], "employee_police_verification_check", "application_id")) {
  // echo 'insert';
  //die;
  //pre($_FILES, FALSE);
//  pre($_POST);
  $image_url = uploadImageArray($_FILES['verification_doc']);
  $sql = "INSERT INTO employee_police_verification_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_police_verification_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "police_authority = '" . $_POST['police_authority'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
//die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'police_check', $_POST['verification_doc_number'], 'verification doc')) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'verification' && isApplicationAvailableAlready($_POST['application_id'], "employee_police_verification_check", "application_id")) {
  $json = updateVerificationInfoCheck();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'bank' && !isApplicationAvailableAlready($_POST['application_id'], "bank_statement_info_check", "application_id")) {
  //pre($_POST);
  $image_url = uploadImageArray($_FILES['bank_statement_doc']);
  $sql = "INSERT INTO bank_statement_info_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "bank_statement_info_id  = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_bank_name_correct  = '" . $_POST['is_bank_name_correct'] . "',"
          . "is_bank_branch_correct  = '" . $_POST['is_bank_branch_correct'] . "',"
          . "is_bank_account_correct  = '" . $_POST['is_bank_account_correct'] . "',"
          . "is_bank_holder_name_correct  = '" . $_POST['is_bank_holder_name_correct'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  //die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'bank_check', $_POST['account_number'], 'Bank Statement')) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'bank' && isApplicationAvailableAlready($_POST['application_id'], "bank_statement_info_check", "application_id")) {
  $json = updateBankInfoCheck();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'cibil' && !isApplicationAvailableAlready($_POST['application_id'], "employee_cibil_check", "application_id")) {
  //pre($_POST);
  $image_url = uploadImage($_FILES['cibil_doc']);
  $sql = "INSERT INTO employee_cibil_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_cibil_info_id  = '" . $_POST['id'] . "',"
          . "reference_number = '" . $_POST['reference_number'] . "',"
          . "member_id = '" . $_POST['member_id'] . "',"
          . "score_name  = '" . $_POST['score_name'] . "',"
          . "scoring_factor  = '" . $_POST['scoring_factor'] . "',"
          . "score  = '" . $_POST['score'] . "',"
          . "cibil_remark  = '" . $_POST['cibil_remark'] . "',"
          . "dispute_remark  = '" . $_POST['dispute_remark'] . "',"
          . "verifier_name  = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  //die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'cibil_check', $_POST['reference_number'], 'CIBIL Statement')) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'cibil' && isApplicationAvailableAlready($_POST['application_id'], "employee_cibil_check", "application_id")) {
  $json = updateCIBILInfoCheck();

  echo json_encode($json);
  die;
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'court' && !isApplicationAvailableAlready($_POST['application_id'], "employee_court_record_check", "application_id")) {
  //pre($_POST);
  $image_url = uploadImageArray($_FILES['court_doc']);
  $sql = "INSERT INTO employee_court_record_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "found_record_all_india_court_for_civil = '" . $_POST['found_record_all_india_court_for_civil'] . "',"
          . "found_record_in_all_high_courts_of_india_for_civil = '" . $_POST['found_record_in_all_high_courts_of_india_for_civil'] . "',"
          . "found_record_in_supreme_court_of_india_for_civil  = '" . $_POST['found_record_in_supreme_court_of_india_for_civil'] . "',"
          . "found_record_in_all_session_courts_for_criminal  = '" . $_POST['found_record_in_all_session_courts_for_criminal'] . "',"
          . "found_record_all_high_courts_of_india_for_criminal  = '" . $_POST['found_record_all_high_courts_of_india_for_criminal'] . "',"
          . "found_record_in_supreme_court_of_india_for_criminal  = '" . $_POST['found_record_in_supreme_court_of_india_for_criminal'] . "',"
          . "is_applicant_name_correct  = '" . $_POST['is_applicant_name_correct'] . "',"
          . "is_father_name_correct  = '" . $_POST['is_father_name_correct'] . "',"
          . "is_address_correct  = '" . $_POST['is_address_correct'] . "',"
          . "verifier_name  = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  //die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'court_check', "", 'Court Statement')) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'court' && isApplicationAvailableAlready($_POST['application_id'], "employee_court_record_check", "application_id")) {
  //die;
  $json = updateCortInfoCheck();

  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'drug' && !isApplicationAvailableAlready($_POST['application_id'], "drug_abuse_test_check", "application_id")) {
  //pre($_FILES);
  $image_url = uploadImageArray($_FILES['drug_doc']);
  $sql = "INSERT INTO drug_abuse_test_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "panel = '" . $_POST['panel'] . "',"
          . "sample_collected = '" . $_POST['sample_collected'] . "',"
          . "verifier_name  = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  //die;

  if (mysqli_query($mycon, $sql) && uploadDoc($image_url, 'drug_check', "", 'Drug Statement')) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'drug' && isApplicationAvailableAlready($_POST['application_id'], "drug_abuse_test_check", "application_id")) {
  //die;
  $json = updateDrugInfoCheck();

  echo json_encode($json);
  die;
}

// ============================= court_verif ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'court_verif' && !isApplicationAvailableAlready($_POST['application_id'], "employee_court_record_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_court_record_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_court_record_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'court_verif' && isApplicationAvailableAlready($_POST['application_id'], "employee_court_record_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updatecourt_verifInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End court_verif ========================

// ============================= drug_verif ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'drug_verif' && !isApplicationAvailableAlready($_POST['application_id'], "drug_abuse_test_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO drug_abuse_test_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_drug_test_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'drug_verif' && isApplicationAvailableAlready($_POST['application_id'], "drug_abuse_test_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updatedrug_verifInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End drug_verif ========================

// =============================global base check============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'gcb' && !isApplicationAvailableAlready($_POST['application_id'], "employee_global_base_check_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_global_base_check_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_personal_info_tbl_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'gcb' && isApplicationAvailableAlready($_POST['application_id'], "employee_global_base_check_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateGCBInfoCheck();

  echo json_encode($json);
  die;
}



// =============================Social Security Number (SSN) Verification============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'ssn' && !isApplicationAvailableAlready($_POST['application_id'], "employee_socal_security_number_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_socal_security_number_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_socal_security_number_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'ssn' && isApplicationAvailableAlready($_POST['application_id'], "employee_socal_security_number_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateSSNInfoCheck();

  echo json_encode($json);
  die;
}

// =====================================End Social Security Number (SSN) ========================


// =============================Criminal background check ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'criminal' && !isApplicationAvailableAlready($_POST['application_id'], "employee_criminal_background_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_criminal_background_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_criminal_background_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
//   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'criminal' && isApplicationAvailableAlready($_POST['application_id'], "employee_criminal_background_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateCriminalInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End Criminal background check ========================


// =============================global sanction ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'gs' && !isApplicationAvailableAlready($_POST['application_id'], "employee_global_sanctions_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_global_sanctions_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_global_sanctions_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
//   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'gs' && isApplicationAvailableAlready($_POST['application_id'], "employee_global_sanctions_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateGSInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End Global Sanction ========================

// =============================National Sex Offender Registry (NSO) ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'nsr' && !isApplicationAvailableAlready($_POST['application_id'], "employee_national_sex_registry_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_national_sex_registry_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_national_sex_registry_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'nsr' && isApplicationAvailableAlready($_POST['application_id'], "employee_national_sex_registry_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateNSRInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End National Sex Offender Registry (NSO) ========================

// =============================identity_verif ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'identity_verif' && !isApplicationAvailableAlready($_POST['application_id'], "employee_identity_verif_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_identity_verif_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_identity_verif_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'identity_verif' && isApplicationAvailableAlready($_POST['application_id'], "employee_identity_verif_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateidentity_verifInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End identity_verif ========================



// =============================company verification ============== 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'comp_verif' && !isApplicationAvailableAlready($_POST['application_id'], "employee_company_verifaction_tbl_check", "application_id")) {
  // pre($_POST);
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "INSERT INTO employee_company_verifaction_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_company_verifaction_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " ";
  // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
} elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'comp_verif' && isApplicationAvailableAlready($_POST['application_id'], "employee_company_verifaction_tbl_check", "application_id")) {
  //echo "TTTTT";
  //die;

  $json = updateComp_verifiInfoCheck();

  echo json_encode($json);
  die;
}

// ===================================== End company verification ========================






if (isset($_POST['action']) && isset($_POST['application_id'])) {
  $mycon = getConnection();
  $sqlDeleteApplication = "DELETE  "
          . "tbl_application_check, "
          . "employee_personal_info_tbl,"
          . "employee_address,"
          . "employee_education_tbl,"
          . "employee_employment_info_tbl,"
          . "employee_police_verification,"
          . "employee_reference,"
          . "bank_statement_info,"
          . "employee_cibil_info, "
          . "employee_personal_info_tbl_check,"
          . "employee_address_check,"
          . "employee_education_tbl_check,"
          . "employee_employment_info_tbl_check,"
          . "employee_police_verification_check,"
          . "employee_reference_check,"
          . "bank_statement_info_check,"
          . "employee_cibil_check ,"
          . "employee_court_record_check ,"
          . "drug_abuse_test_check "
          . "from tbl_application  "
          . " LEFT join tbl_application_check ON tbl_application.application_ref_id = tbl_application_check.application_id"
          . " LEFT join employee_personal_info_tbl ON tbl_application.application_ref_id = employee_personal_info_tbl.application_id"
          . " LEFT join employee_address ON tbl_application.application_ref_id = employee_address.application_id"
          . " LEFT join employee_education_tbl ON tbl_application.application_ref_id = employee_education_tbl.application_id"
          . " LEFT join employee_employment_info_tbl ON tbl_application.application_ref_id = employee_employment_info_tbl.application_id"
          . " LEFT join employee_police_verification ON tbl_application.application_ref_id = employee_police_verification.application_id"
          . " LEFT join employee_reference ON tbl_application.application_ref_id = employee_reference.application_id"
          . " LEFT join bank_statement_info ON tbl_application.application_ref_id = bank_statement_info.application_id"
          . " LEFT join employee_cibil_info ON tbl_application.application_ref_id = employee_cibil_info.application_id"
          . " LEFT join employee_personal_info_tbl_check ON tbl_application.application_ref_id = employee_personal_info_tbl_check.application_id"
          . " LEFT join employee_address_check ON tbl_application.application_ref_id = employee_address_check.application_id"
          . " LEFT join employee_education_tbl_check ON tbl_application.application_ref_id = employee_education_tbl_check.application_id"
          . " LEFT join employee_employment_info_tbl_check ON tbl_application.application_ref_id = employee_employment_info_tbl_check.application_id"
          . " LEFT join employee_police_verification_check ON tbl_application.application_ref_id = employee_police_verification_check.application_id"
          . " LEFT join employee_reference_check ON tbl_application.application_ref_id = employee_reference_check.application_id"
          . " LEFT join bank_statement_info_check ON tbl_application.application_ref_id = bank_statement_info_check.application_id"
          . " LEFT join employee_cibil_check ON tbl_application.application_ref_id = employee_cibil_check.application_id"
          . " LEFT join drug_abuse_test_check ON tbl_application.application_ref_id = drug_abuse_test_check.application_id"
          . " LEFT join employee_court_record_check ON tbl_application.application_ref_id = employee_court_record_check.application_id"
          . " WHERE tbl_application.application_ref_id = '" . $_POST['application_id'] . "'";
  //die;

  if (mysqli_query($mycon, $sqlDeleteApplication)) {
    $json = array("status" => 1, "msg" => "Data Deleted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}

function insertEducation($eduId, $isNameCorrect, $isRollNoCorrect, $isUnivercityCorrect, $isInstituteCorrect, $isPassyearCorrect, $verifierName, $verifierDesc, $verifierRemark) {
  $mycon = getConnection();
  $sqlInsertEducation = "INSERT INTO employee_education_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_education_tbl_id  = '" . $eduId . "',"
          . "is_emp_name_correct  = '" . $isNameCorrect . "',"
          . "is_rollno_correct = '" . $isRollNoCorrect . "',"
          . "is_university_correct  = '" . $isUnivercityCorrect . "',"
          . "is_institute_correct  = '" . $isInstituteCorrect . "',"
          . "is_passing_year_correct  = '" . $isPassyearCorrect . "',"
          . "verifier_name  = '" . $verifierName . "',"
          . "verifier_designation  = '" . $verifierDesc . "',"
          . "verifier_remark  = '" . $verifierRemark . "'"
          . " ";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function insertReference($id, $vname, $vdesc, $vremark, $acdp, $aap, $si, $gp, $rating, $is_verify) {
  $mycon = getConnection();
  $sqlInsertEducation = "INSERT INTO employee_reference_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_reference_id = '" . $id . "',"
          . "verifier_name  = '" . $vname . "',"
          . "verifier_designation  = '" . $vdesc . "',"
          . "verifier_remark  = '" . $vremark . "',"
          . "about_candidate_during_period = '" . $acdp . "',"
          . "about_association_period  = '" . $aap . "',"
          . "self_improvement  = '" . $si . "',"
          . "general_reputation  = '" . $gp . "',"
          . "ratings  = '" . $rating . "',"
          . "is_verify  = '" . $is_verify . "'"
          . " ";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function isApplicationAvailableAlready($applicationId, $table, $appfield) {
  $mycon = getConnection();
  $sql = "SELECT id FROM " . $table . "  WHERE " . $appfield . " = '" . $applicationId . "'";
  $result1 = mysqli_query($mycon, $sql);
  if (mysqli_num_rows($result1) > 0) {
    return TRUE;
  } else {
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
  if (mysqli_query($mycon, $sqlAddressDoc)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function uploadImageMulti($fileName, $i) {
//echo 'jjjjjjjjjjjjjhhh';
//die;
//pre($fileName['name']);
//echo basename($fileName['name'][$i]);
//die;
  if ((!empty($fileName)) && ($fileName['error'][$i] == 0)) {
    $filename = basename($fileName['name'][$i]);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if (($ext == "jpg" && $fileName["type"][$i] == 'image/jpeg') || ($ext == "png" && $fileName["type"][$i] == 'image/png') || ($ext == "gif" && $fileName["type"][$i] == 'image/gif')) {
      $temp = explode(".", $fileName["name"][$i]);
      $newfilename = NewGuid() . '.' . end($temp);
      move_uploaded_file($fileName["tmp_name"][$i], FCPATH . '/images/application/' . $newfilename);
      return $newfilename;
    } else {
      return '';
    }
  }
  return '';
}

function uploadImage($fileName) {
  if ((!empty($fileName)) && ($fileName['error'] == 0)) {
    $filename = basename($fileName['name']);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if (($ext == "jpg" && $fileName["type"] == 'image/jpeg') || ($ext == "png" && $fileName["type"] == 'image/png') || ($ext == "gif" && $fileName["type"] == 'image/gif')) {
      $temp = explode(".", $fileName["name"]);
      $newfilename = NewGuid() . '.' . end($temp);
      move_uploaded_file($fileName["tmp_name"], FCPATH . '/images/application/' . $newfilename);
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
  $arrayCount = count($fileName['name']);
  for ($i = 0; $i <= ($arrayCount - 1); $i++) {
    if ((!empty($fileName)) && ($fileName['error'][$i] == 0)) {
      $filename = basename($fileName['name'][$i]);
      $ext = substr($filename, strrpos($filename, '.') + 1);
      if (($ext == "jpg" && $fileName["type"][$i] == 'image/jpeg') || ($ext == "png" && $fileName["type"][$i] == 'image/png') || ($ext == "gif" && $fileName["type"][$i] == 'image/gif') || ($ext == "pdf" && $fileName["type"][$i] == 'application/pdf')) {
        $temp = explode(".", $fileName["name"][$i]);
        $newfilename = NewGuid() . '.' . end($temp);
        move_uploaded_file($fileName["tmp_name"][$i], FCPATH . '/images/application/' . $newfilename);
        $nameString = $nameString . $newfilename . ',';
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
