<?php

function updateApplicationCheckInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE tbl_application_check SET "
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
          . "is_relation_details_checked = '" . $_POST['is_relation_details_checked'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "' ";


          $sqlCheck = "UPDATE tbl_application SET "
          . "application_status = '6'"
          . " WHERE application_ref_id  = '" . $_POST['application_id'] . "' ";
//   echo $sql; die;


  if (mysqli_query($mycon, $sql)) {
    // return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
    // if($_POST['complete_status_check']==1){
    //   mysqli_query($mycon, $sqlCheck);
    //   return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully and Application status Updated");
    // }
   
    $application_status_check = get_application_status_no($mycon, $_POST['application_id']);

    if($_POST['complete_status_check']==1 && $application_status_check != 4){
      mysqli_query($mycon, $sqlCheck);
      return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully and Application status Updated");
    }elseif($_POST['complete_status_check']==1 && $application_status_check == 4){
      return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully however Request for Payment is Raised");

    }else{
      return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");

    }
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updatePersonalInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_personal_info_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_personal_info_tbl_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_personal_info_tbl_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}



function updateGCBInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_global_base_check_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_global_base_check_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_global_base_check_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}


function updatecourt_verifInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_court_record_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_court_record_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_court_record_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}
function updatedrug_verifInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE drug_abuse_test_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_drug_test_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_drug_test_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateSSNInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_socal_security_number_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_socal_security_number_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_socal_security_number_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateCriminalInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_criminal_background_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_criminal_background_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_criminal_background_id = '" . $_POST['id'] . "'";
        //   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateGSInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_global_sanctions_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_global_sanctions_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_global_sanctions_id = '" . $_POST['id'] . "'";
        //   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateNSRInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_national_sex_registry_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_national_sex_registry_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_national_sex_registry_id = '" . $_POST['id'] . "'";
        //   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}
function updateidentity_verifInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_identity_verif_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_identity_verif_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_identity_verif_id = '" . $_POST['id'] . "'";
        //   echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateComp_verifiInfoCheck() {
  // echo 'hhh';
  // die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_company_verifaction_tbl_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_company_verifaction_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  AND employee_company_verifaction_id = '" . $_POST['id'] . "'";
          // echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}



function updateAddressCheckInfo() {
  $mycon = getConnection();
  $count = count($_POST['verifier_name']);
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "UPDATE employee_address_check SET "
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
            . " WHERE application_id  = '" . $_POST['application_id'] . "' AND  employee_address_id  = '" . $_POST['address_id'][$i] . "' ";

    //die;
    $result = mysqli_query($mycon, $sql);

    //$image_url = uploadImageMulti($_FILES['address_doc'], $i);
    //$result = uploadDoc($image_url, 'address_verification', '', 'Address Verification Docs' . $i);
  }
  if ($result) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateEducationInfo() {
//  echo 'hhh';
//  die;
  $mycon = getConnection();
//  echo 'ttttt';
//  pre($_POST);
//  die;


  if (
          updateEducation($_POST['high_school_id'], $_POST['is_emp_name_correct_10'], $_POST['is_rollno_correct_10'], $_POST['is_university_correct_10'], $_POST['is_institute_correct_10'], $_POST['is_passing_year_correct_10'], $_POST['verifier_name_10'], $_POST['verifier_designation_10'], $_POST['verifier_remark_10']) && updateEducation($_POST['intermediate_id'], $_POST['is_emp_name_correct_12'], $_POST['is_rollno_correct_12'], $_POST['is_university_correct_12'], $_POST['is_institute_correct_12'], $_POST['is_passing_year_correct_12'], $_POST['verifier_name_12'], $_POST['verifier_designation_12'], $_POST['verifier_remark_12']) && updateEducation($_POST['graduation_degree_id'], $_POST['is_emp_name_correct_grad'], $_POST['is_rollno_correct_grad'], $_POST['is_university_correct_grad'], $_POST['is_institute_correct_grad'], $_POST['is_passing_year_correct_grad'], $_POST['verifier_name_grad'], $_POST['verifier_designation_grad'], $_POST['verifier_remark_grad']) && updateEducation($_POST['post_graduation_degree_id'], $_POST['is_emp_name_correct_pgrad'], $_POST['is_rollno_correct_pgrad'], $_POST['is_university_correct_pgrad'], $_POST['is_institute_correct_pgrad'], $_POST['is_passing_year_correct_pgrad'], $_POST['verifier_name_pgrad'], $_POST['verifier_designation_pgrad'], $_POST['verifier_remark_pgrad']) && updateEducation($_POST['diploma'], $_POST['is_emp_name_correct_diploma'], $_POST['is_rollno_correct_diploma'], $_POST['is_university_correct_diploma'], $_POST['is_institute_correct_diploma'], $_POST['is_passing_year_correct_diploma'], $_POST['verifier_name_diploma'], $_POST['verifier_designation_diploma'], $_POST['verifier_remark_diploma']
          )
  //updateEducation("1", "High School (10)", $_POST['high_school_school'], $_POST['high_school_roll_number'], $_POST['high_school_passing_year'], $_POST['high_school_board']) && updateEducation("2", "Intermediate (10+2)", $_POST['intermediate_school'], $_POST['intermediate_roll_no'], $_POST['intermediate_passing_year'], $_POST['intermediate_board']) && updateEducation("3", "Graduation", $_POST['graduation_school'], $_POST['graduation_roll_no'], $_POST['graduation_passing_year'], $_POST['graduation_board']) && updateEducation("4", "Post Graduation", $_POST['post_graduation_school'], $_POST['post_graduation_roll_no'], $_POST['post_graduation_passing_year'], $_POST['post_graduation_board']) && updateEducation("5", "Diploma", $_POST['diploma_school'], $_POST['diploma_roll_no'], $_POST['diploma_passing_year'], $_POST['high_school_board'])
  ) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateReferenceInfoCheck() {
//  echo 'hhh';
//  die;
  $mycon = getConnection();
  //  echo 'ttttt';
//  pre($_FILES);
//  die;


  if (
          updateReference($_POST['id'][0], $_POST['verifier_name'][0], $_POST['verifier_designation'][0], $_POST['verifier_remark'][0], $_POST['about_candidate_during_period'][0], $_POST['about_association_period'][0], $_POST['self_improvement'][0], $_POST['general_reputation'][0], $_POST['ratings1'], $_POST['is_verify1']) && updateReference($_POST['id'][1], $_POST['verifier_name'][1], $_POST['verifier_designation'][1], $_POST['verifier_remark'][1], $_POST['about_candidate_during_period'][1], $_POST['about_association_period'][1], $_POST['self_improvement'][1], $_POST['general_reputation'][1], $_POST['ratings2'], $_POST['is_verify2']) && updateReference($_POST['id'][2], $_POST['verifier_name'][2], $_POST['verifier_designation'][2], $_POST['verifier_remark'][2], $_POST['about_candidate_during_period'][2], $_POST['about_association_period'][2], $_POST['self_improvement'][2], $_POST['general_reputation'][2], $_POST['ratings3'], $_POST['is_verify3']) && updateReference($_POST['id'][3], $_POST['verifier_name'][3], $_POST['verifier_designation'][3], $_POST['verifier_remark'][3], $_POST['about_candidate_during_period'][3], $_POST['about_association_period'][3], $_POST['self_improvement'][3], $_POST['general_reputation'][3], $_POST['ratings4'], $_POST['is_verify4'])
  ) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateReference($id, $vname, $vdesc, $vremark, $acdp, $aap, $si, $gp, $rating, $is_verify) {
  $mycon = getConnection();
  $sqlInsertEducation = "UPDATE employee_reference_check SET "
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
          . " WHERE application_id  = '" . $_POST['application_id'] . "' AND employee_reference_id  = '" . $id . "'";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function updateEmployerInfoCheck() {
  $mycon = getConnection();
  $count = count($_POST['verifier_name']);
  //die;
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "UPDATE employee_employment_info_tbl_check SET "
            . "user_id = '" . $_SESSION['id'] . "',"
            . "application_id = '" . $_POST['application_id'] . "',"
            . "verifier_name = '" . $_POST['verifier_name'][$i] . "',"
            . "verifier_designation   = '" . $_POST['verifier_designation'][$i] . "',"
            . "verifier_remark  = '" . $_POST['verifier_remark'][$i] . "',"
            . "how_was_the_candidate_behavior_during_tenure   = '" . $_POST['was_the_candidate_behavior_during_tenure'][$i] . "',"
            . "eligible_for_rehire  = '" . $_POST['eligible_for_rehire'][$i] . "',"
            . "employee_employment_info_tbl_id = '" . $_POST['employer_id'][$i] . "'"
            . " WHERE application_id  = '" . $_POST['application_id'] . "' AND  employee_employment_info_tbl_id  = '" . $_POST['employer_id'][$i] . "' ";

    //die;

    $result = mysqli_query($mycon, $sql);

    //$image_url = uploadImageMulti($_FILES['certificate_file'], $i);
    //$result = uploadDoc($image_url, 'employer_verification', $_POST['certificate_number'][$i], 'employer' . $i);
  }
  if ($result) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateVerificationInfoCheck() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();
  $sql = "UPDATE employee_police_verification_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "employee_police_verification_id = '" . $_POST['id'] . "',"
          . "verifier_name = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "police_authority = '" . $_POST['police_authority'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "' AND  employee_police_verification_id  = '" . $_POST['id'] . "' ";

//die;

  if (mysqli_query($mycon, $sql)) {

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateBankInfoCheck() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();
  $sql = "UPDATE bank_statement_info_check SET "
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
          . " WHERE application_id  = '" . $_POST['application_id'] . "' AND  bank_statement_info_id  = '" . $_POST['id'] . "' ";

//die;

  if (mysqli_query($mycon, $sql)) {

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateCIBILInfoCheck() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();
  $sql = "UPDATE employee_cibil_check SET "
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
          . " WHERE application_id  = '" . $_POST['application_id'] . "' AND  employee_cibil_info_id  = '" . $_POST['id'] . "' ";

//die;

  if (mysqli_query($mycon, $sql)) {

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateCortInfoCheck() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();
  $sql = "UPDATE employee_court_record_check SET "
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
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  ";

//die;

  if (mysqli_query($mycon, $sql)) {

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateDrugInfoCheck() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();
  $sql = "UPDATE drug_abuse_test_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_POST['application_id'] . "',"
          . "panel = '" . $_POST['panel'] . "',"
          . "sample_collected = '" . $_POST['sample_collected'] . "',"
          . "verifier_name  = '" . $_POST['verifier_name'] . "',"
          . "verifier_designation  = '" . $_POST['verifier_designation'] . "',"
          . "verifier_remark  = '" . $_POST['verifier_remark'] . "',"
          . "is_verify  = '" . $_POST['is_verify'] . "'"
          . " WHERE application_id  = '" . $_POST['application_id'] . "'  ";

//die;

  if (mysqli_query($mycon, $sql)) {

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateEducation($eduId, $isNameCorrect, $isRollNoCorrect, $isUnivercityCorrect, $isInstituteCorrect, $isPassyearCorrect, $verifierName, $verifierDesc, $verifierRemark) {
  $mycon = getConnection();
  $sqlInsertEducation = "UPDATE employee_education_tbl_check SET "
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
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND employee_education_tbl_id = '" . $eduId . "'";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}
