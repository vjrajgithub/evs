<?php

function updateApplicationInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  //$image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE tbl_application SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "hmds_id = '" . $_POST['hmds_id'] . "',"
          . "client_name = '" . $_POST['client_name'] . "',"
          . "client_location  = '" . $_POST['client_location'] . "',"
          . "case_id = '" . $_POST['case_id'] . "',"
          . "application_ref_id = '" . $_POST['application_id'] . "',"
          . "case_record_date = '" . $_POST['case_rec_date'] . "',"
          . "client_relationship_person_name = '" . $_POST['relationship_person_name'] . "',"
          . "client_contact_number = '" . $_POST['client_contact_number'] . "',"
          . "type_of_check = '" . implode(',', $_POST['type_of_check']) . "',"
          . "unique_id  = '" . $_POST['unique_id'] . "',"
          . "client_ref_number  = '" . $_POST['crn'] . "',"
          . "review_comment  = '',"
          . "is_completed  = '0'"         
          . " WHERE application_ref_id  = '" . $_POST['application_id'] . "' ";
  //die;
  // echo $sql; die;

  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updatePersonalInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  $image_url = uploadImage($_FILES['passport_photo']);
  $sql = "UPDATE employee_personal_info_tbl SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "firstName = '" . $_POST['firstname'] . "',"
          . "fatherName = '" . $_POST['fathername'] . "',"
          . "lastName = '" . $_POST['lastname'] . "',"
          . "phoneNo  = '" . $_POST['phone'] . "',"
          . "alternateContact = '" . $_POST['alternate_contact_no'] . "',"
          . "is_are_you_legally_eligible_for_employment_in_the_india  = '" . $_POST['is_eligible'] . "',"
          . "middleName = '" . $_POST['middlename'] . "',"
          . "dob = '" . $_POST['dob'] . "',"
          . "email = '" . $_POST['email'] . "',"
          . "profile_image = '" . $image_url . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "gender  = '" . $_POST['gender'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";

  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}
function updateidentityInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  $image_url = uploadImageArray($_FILES['identity_doc']);
  $sql = "UPDATE employee_identity_verif SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          . "type_of_identity = '" . $_POST['identity_type_doc'] . "',"
          . "document_no = '" . $_POST['identity_doc_desc'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

    
if($image_url != "" ){
  update_uploadDoc($image_url, 'identity_verif_doc', $_POST['identity_type_doc'], $_POST['identity_doc_desc']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================gbc===================

function updateGBCInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_global_base_check SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

    if($image_url != "" ){
      update_uploadDoc($image_url, 'gbc_doc', $_POST['doc_type'], $_POST['doc_no']);
    }
    

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end gbc===================
// =========================================SSN===================

function updateSSNInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_socal_security_number SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "ss_no = '" . $_POST['ss_no'] . "',"
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    
if($image_url != "" ){
  update_uploadDoc($image_url, 'ssn_doc', $_POST['doc_type'], $_POST['doc_no']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end SSN===================
// =========================================criminal_back===================

function updateCriminal_backInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_criminal_background SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    
if($image_url != "" ){
  update_uploadDoc($image_url, 'criminal_back_doc', $_POST['doc_type'], $_POST['doc_no']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end criminal_back===================
// =========================================global_sanctions===================

function update_global_sanctions_Info() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_global_sanctions SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    
if($image_url != "" ){
  update_uploadDoc($image_url, 'global_sanctions_doc', $_POST['doc_type'], $_POST['doc_no']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end global_sanctions===================
// =========================================national_sex_registry===================

function updateNSRInfo() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_national_sex_registry SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
    
if($image_url != "" ){
  update_uploadDoc($image_url, 'nsr_doc', $_POST['doc_type'], $_POST['doc_no']);
}


    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end national_sex_registry===================
// =========================================court_record===================

function update_court_Info() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_court_record SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
   
if($image_url != "" ){
  update_uploadDoc($image_url, 'court_rec_doc', $_POST['doc_type'], $_POST['doc_no']);
}
   
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end court_record===================
// =========================================drug===================

function update_drug_Info() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_drug_test SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "panel = '" . implode(',', $_POST['type_of_panel']). "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {
   
    if($image_url != "" ){
      update_uploadDoc($image_url, 'drug_doc', $_POST['doc_type'], $_POST['doc_no']);
    }
    

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end drug===================
// =========================================company_verification===================

function update_comp_verif_Info() {
  //echo 'hhh';
  //die;
  $mycon = getConnection();
  // $image_url = uploadImage($_FILES['identity_doc']);
  $image_url = uploadImageArray($_FILES['doc']);
  $sql = "UPDATE employee_company_verifaction SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          
          . "company_name = '" . $_POST['company_name'] . "',"
            . "company_address = '" . $_POST['company_add'] . "',"
            . "contact_no = '" . $_POST['phone'] . "',"
            . "contact_person_no = '" . $_POST['contact_person_no'] . "',"
            . "company_email = '" . $_POST['email'] . "',"
            . "company_location = '" . $_POST['company_location'] . "',"
          . "document_no = '" . $_POST['doc_no'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

    
if($image_url != "" ){
  update_uploadDoc($image_url, 'company_doc', $_POST['doc_type'], $_POST['doc_no']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

// =========================================end company_verification===================

function updateCIBILInfo() {
  $mycon = getConnection();
  $image_url = uploadImage($_FILES['cibil_doc']);

  $sql = "UPDATE employee_cibil_info SET "
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
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

    
if($image_url != "" ){
  update_uploadDoc($image_url, "cibil", "CIBIL Statement", $_POST['pancard_no']);
}

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateBankInfo() {

  $mycon = getConnection();
  $image_url = uploadImageArray($_FILES['bank_statement_doc']);


  $sql = "UPDATE bank_statement_info SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "bank_name = '" . $_POST['bank_name'] . "',"
          . "bank_holder_name = '" . $_POST['account_holder_name'] . "',"
          . "account_no  = '" . $_POST['account_number'] . "',"
          . "verification_mode  = '" . $_POST['verification_mode'] . "',"
          . "period_of_verif  = '" . $_POST['period_of_verif'] . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "bank_branch = '" . $_POST['branch_name'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' ";
// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

    if($image_url != "" ){
      update_uploadDoc($image_url, "bank", "Bank Statement", $_POST['account_number']);
    }

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateCustomerInfo() {

  //pre($_POST);
  $mycon = getConnection();

  $sql = "UPDATE customer_master SET "
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
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "address1  = '" . $_POST['address'] . "'"
          . " WHERE customer_id  = '" . $_POST['id'] . "' ";

  if (mysqli_query($mycon, $sql)) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateAddressInfo() {
//  echo 'hhh';
//  die;

$image_url = uploadImageArray($_FILES['address_doc']);
  $home_image_url = uploadImageArray($_FILES['home_address_doc']);

  $mycon = getConnection();
  $sqlAddress = "UPDATE employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['address'] . "',"
          . "city = '" . $_POST['city'] . "',"
          . "state  = '" . $_POST['state'] . "',"
          . "country = '" . $_POST['country'] . "',"
          . "pin_code  = '" . $_POST['pincode'] . "',"
          . "landmark = '" . $_POST['landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "address_type = '1'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND address_type = '1'";
  $sqlHomeAddress = "UPDATE employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['homeaddress'] . "',"
          . "city = '" . $_POST['homecity'] . "',"
          . "state  = '" . $_POST['homestate'] . "',"
          . "country = '" . $_POST['homecountry'] . "',"
          . "pin_code  = '" . $_POST['homepincode'] . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "landmark = '" . $_POST['home_landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "address_type = '2'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND address_type = '2'";


          if(isset($_POST['sameadd'])) {
            $sqlHomeAddress = "UPDATE employee_address SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "address = '" . $_POST['address'] . "',"
          . "city = '" . $_POST['city'] . "',"
          . "state  = '" . $_POST['state'] . "',"
          . "country = '" . $_POST['country'] . "',"
          . "pin_code  = '" . $_POST['pincode'] . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "landmark = '" . $_POST['landmark'] . "',"
          . "verification_mode = '" . $_POST['verification_mode'] . "',"
          . "address_type = '2'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND address_type = '2'";


          $home_image_url = uploadImageArray($_FILES['address_doc']);
            $_POST['home_address_doc_type'] = $_POST['address_doc_type'];
            $_POST['home_address_doc_desc'] =  $_POST['address_doc_desc'];
          }

  if (mysqli_query($mycon, $sqlAddress)) {
    
if($home_image_url != "" ){
  update_uploadDoc($home_image_url, 'home_address', $_POST['home_address_doc_type'], $_POST['home_address_doc_desc']);
}

if($image_url != "" ){
  update_uploadDoc($image_url, 'present_address', $_POST['address_doc_type'], $_POST['address_doc_desc']);
}

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
//  pre($_FILES);
//  die;


$school_image_url = uploadImageArray($_FILES['high_school_doc_file']);
// die($school_image_url);
$intermediate_image_url = uploadImageArray($_FILES['intermediate_doc_file']);
$graduation_image_url = uploadImageArray($_FILES['graduation_doc_file']);
$post_graduation_image_url = uploadImageArray($_FILES['post_graduation_doc_file']);
$diploma_image_url = uploadImageArray($_FILES['diploma_doc_file']);




  if (
          updateEducation("1", "High School (10)", $_POST['high_school_school'], $_POST['high_school_roll_number'], $_POST['high_school_passing_year'], $_POST['high_school_board'], $_POST['verification_mode']) && updateEducation("2", "Intermediate (10+2)", $_POST['intermediate_school'], $_POST['intermediate_roll_no'], $_POST['intermediate_passing_year'], $_POST['intermediate_board'], $_POST['verification_mode_inter']) && updateEducation("3", "Graduation", $_POST['graduation_school'], $_POST['graduation_roll_no'], $_POST['graduation_passing_year'], $_POST['graduation_board'], $_POST['verification_mode_grad'], $_POST['graduation_degree']) && updateEducation("4", "Post Graduation", $_POST['post_graduation_school'], $_POST['post_graduation_roll_no'], $_POST['post_graduation_passing_year'], $_POST['post_graduation_board'], $_POST['verification_mode_pg'], $_POST['post_graduation_degree'] ) && updateEducation("5", "Diploma", $_POST['diploma_school'], $_POST['diploma_roll_no'], $_POST['diploma_passing_year'], $_POST['diploma_board'], $_POST['verification_mode_diploma'], $_POST['diploma'])
  ) {
if($school_image_url != "" ){
  update_uploadDoc($school_image_url, 'highschool', 'education', $_POST['high_school_doc_number']);
}
if($intermediate_image_url != "" ){
    update_uploadDoc($intermediate_image_url, 'intermediate', 'education', $_POST['intermediate_doc_number']);
}
if($graduation_image_url != ""){
  update_uploadDoc($graduation_image_url, 'graduation', 'education', $_POST['graduation_doc_number']);
}
  if($post_graduation_image_url != ""){
    update_uploadDoc($post_graduation_image_url, 'post graduation', 'education', $_POST['post_graduation_doc_number']);
  }
  if($diploma_image_url != ""){
    update_uploadDoc($diploma_image_url, 'diploma', 'education', $_POST['diploma_doc_number']);
  }

    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateReferenceInfo() {
//  echo 'hhh';
//  die;
  $mycon = getConnection();
  //  echo 'ttttt';
//  pre($_FILES);
//  die;


  if (
          updateReference("1", "2", $_POST['name_pr1'], $_POST['phone_pr1'], $_POST['city_pr1'], $_POST['country_pr1'], $_POST['pincode_pr1'], $_POST['email_pr1'], $_POST['relation_pr1'], $_POST['address_pr1'], $_POST['state_pr1'], $_POST['landmark_pr1'], $_POST['verification_mode1']) && updateReference("2", "2", $_POST['name_pr2'], $_POST['phone_pr2'], $_POST['city_pr2'], $_POST['country_pr2'], $_POST['pincode_pr2'], $_POST['email_pr2'], $_POST['relation_pr2'], $_POST['address_pr2'], $_POST['state_pr2'], $_POST['landmark_pr2'], $_POST['verification_mode2']) && updateReference("3", "1", $_POST['name_perr1'], $_POST['phone_perr1'], $_POST['city_perr1'], $_POST['country_perr1'], $_POST['pincode_perr1'], $_POST['email_perr1'], $_POST['relation_perr1'], $_POST['address_perr1'], $_POST['state_perr1'], $_POST['landmark_perr1'], $_POST['verification_mode3']) && updateReference("4", "1", $_POST['name_perr2'], $_POST['phone_perr2'], $_POST['city_perr2'], $_POST['country_perr2'], $_POST['pincode_perr2'], $_POST['email_perr2'], $_POST['relation_perr2'], $_POST['address_perr2'], $_POST['state_perr2'], $_POST['landmark_perr2'], $_POST['verification_mode4'])
  ) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateReference($order_no, $rType, $name, $phone, $city, $country, $pincode, $email, $relation, $address, $state, $landmark, $verification_mode) {
  $mycon = getConnection();
  $sqlInsertEducation = "UPDATE employee_reference SET "
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
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "verification_mode  = '" . $verification_mode . "',"
          . "order_no  = '" . $order_no . "',"
          . "landmark = '" . $landmark . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND order_no = '" . $order_no . "'";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function updateEmployerInfo() {
  //pre($_POST);
  //echo 'update';
  //die;
  $mycon = getConnection();
  $count = count($_POST['employer_name']);
  $result = FALSE;
  for ($i = 0; $i < $count; $i++) {
    $sql = "UPDATE employee_employment_info_tbl SET "
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
            . "reporting_mngr_email = '" . $_POST['reporting_manager_email_id'][$i] . "',"
            . "verification_mode = '" . $_POST['verification_mode'][$i] . "',"
            . "review_comment  = '',"
            . "is_completed  = '0',"
            . "order_no = '" . $i . "',"
            . "company_name = '" . $_POST['company_name'][$i] . "'"
            . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND order_no = '" . $i . "'";

            // echo $sql; die;
    mysqli_query($mycon, $sql);

    //$image_url = uploadImageMulti($_FILES['certificate_file'], $i);
    $result = TRUE;
  }
  if ($result) {
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateVerificationInfo() {
//  echo 'update';
//  die;
  //pre($_POST);
//  echo 'update';
//  die;
  $mycon = getConnection();


  $image_url = uploadImageArray($_FILES['address_proof']);  
  $sql = "UPDATE employee_police_verification SET "
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
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "country = '" . $_POST['country_police'] . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "'";
//die;

  if (mysqli_query($mycon, $sql)) {


    
if($image_url != "" ){
  update_uploadDoc($image_url, 'police', 'verification doc', $_POST['verification_doc_number']);
}
    return $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    return $json = array("status" => 0, "msg" => "Server Error");
  }
}

function updateEducation($order_no, $qualification, $institute, $rollNo, $passingYear, $univercity, $verification_mode, $course = null) {
  $mycon = getConnection();
  $sqlInsertEducation = "UPDATE employee_education_tbl SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "qualification  = '" . $qualification . "',"
          . "course  = '" . $course . "',"
          . "college_institute  = '" . $institute . "',"
          . "roll_no = '" . $rollNo . "',"
          . "passing_year  = '" . $passingYear . "',"
          . "order_no  = '" . $order_no . "',"
          . "verification_mode  = '" . $verification_mode . "',"
          . "review_comment  = '',"
          . "is_completed  = '0',"
          . "university_board = '" . $univercity . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id'] . "' AND order_no = '" . $order_no . "'";
            //  echo $sqlInsertEducation, die;
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}



function update_uploadDoc($image_url, $type, $title, $desc) {
  $mycon = getConnection();
  $sqlAddressDoc = "UPDATE document_upload SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "title = '" . $title . "',"
          . "related_to = '" . $type . "',"
          . "document_no  = '" . $desc . "',"
          . "filename = '" . $image_url . "'"
          . " WHERE application_id  = '" . $_SESSION['application_ref_id']. "' AND related_to ='".$type."'";

          // echo $sqlAddressDoc; die;
          // die($$_FILES['passport_photo']['name']);
  if (mysqli_query($mycon, $sqlAddressDoc)) {
    return TRUE;
  } else {
    return FALSE;
  }
}
