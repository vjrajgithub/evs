<?php

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

function pre($var, $exit = true) {
  echo "<pre>";
  print_r($var);
  echo "</pre>";
  if ($exit) {
    exit;
  }
}

$mycon = getConnection();
if (isset($_POST['form_type']) && $_POST['form_type'] == 'application') {
  //pre($_POST);
  $sql = "UPDATE tbl_application SET "
          . "application_status = '" . $_POST['is_all_complete'] . "',"
          . "review_comment = '" . $_POST['review_comment'] . "',"
          . "is_completed = '" . $_POST['is_form_complete'] . "'"
          . " WHERE application_ref_id  = '" . $_POST['application_id'] . "' ";
// echo $sql; die;

  if (mysqli_query($mycon, $sql)) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'employer') {
  //pre($_POST);
  if (updateFormComment("employee_employment_info_tbl", "application_id", "id", $_POST['id1'], $_POST['review_comment1'], $_POST['is_completed1']) && updateFormComment("employee_employment_info_tbl", "application_id", "id", $_POST['id2'], $_POST['review_comment2'], $_POST['is_completed2']) && updateFormComment("employee_employment_info_tbl", "application_id", "id", $_POST['id3'], $_POST['review_comment3'], $_POST['is_completed3'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
  die;
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'personal') {
  //pre($_POST);
  if (updateFormComment("employee_personal_info_tbl", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'bank') {


  if (updateFormComment("bank_statement_info", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'cibil') {

  if (updateFormComment("employee_cibil_info", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}

// Drug

if (isset($_POST['form_type']) && $_POST['form_type'] == 'drug') {

  if (updateFormComment("employee_drug_test", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {
    $json = array("status" => 0, "msg" => "Server Error");
  }
  mysqli_close($mycon);
  echo json_encode($json);
}
// end Drug
// court

if (isset($_POST['form_type']) && $_POST['form_type'] == 'court_rec') {
  //pre($_POST);
  if (updateFormComment("employee_court_record", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end court


// Global Base Check 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'gbc') {
  //pre($_POST);
  if (updateFormComment("employee_global_base_check", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Global Base Check 

// Social Security Number 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'ssn') {
  //pre($_POST);
  if (updateFormComment("employee_socal_security_number", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Social Security Number 
// =====
// Criminal Background details 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'criminal_back') {
  //pre($_POST);
  if (updateFormComment("employee_criminal_background", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Criminal Background

// Global Sanctions Details 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'global_sanctions') {
  //pre($_POST);
  if (updateFormComment("employee_global_sanctions", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Global Sanctions Details 
// National Sex Offender Registry Details 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'nsr') {
  //pre($_POST);
  if (updateFormComment("employee_national_sex_registry", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end National Sex Offender Registry Details 
// Company Varification Details 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'comp_verif') {
  //pre($_POST);
  if (updateFormComment("employee_company_verifaction", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Company Varification Details 
// Identity Details 

if (isset($_POST['form_type']) && $_POST['form_type'] == 'identity_verif') {
  //pre($_POST);
  if (updateFormComment("employee_identity_verif", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}

// end Identity Details 


// ========================
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
if (isset($_POST['form_type']) && $_POST['form_type'] == 'address') {
  //pre($_POST);


  if (updateFormComment("employee_address", "application_id", "id", $_POST['id1'], $_POST['review_comment1'], $_POST['is_completed1']) && updateFormComment("employee_address", "application_id", "id", $_POST['id2'], $_POST['review_comment2'], $_POST['is_completed2'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'education') {

  if (
          updateFormComment("employee_education_tbl", "application_id", "id", $_POST['id1'], $_POST['review_comment1'], $_POST['is_completed1']) && updateFormComment("employee_education_tbl", "application_id", "id", $_POST['id2'], $_POST['review_comment2'], $_POST['is_completed2']) && updateFormComment("employee_education_tbl", "application_id", "id", $_POST['id3'], $_POST['review_comment3'], $_POST['is_completed3']) && updateFormComment("employee_education_tbl", "application_id", "id", $_POST['id4'], $_POST['review_comment4'], $_POST['is_completed4']) && updateFormComment("employee_education_tbl", "application_id", "id", $_POST['id5'], $_POST['review_comment5'], $_POST['is_completed5'])
  ) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}
if (isset($_POST['form_type']) && $_POST['form_type'] == 'reference') {

  if (
          updateFormComment("employee_reference", "application_id", "id", $_POST['id1'], $_POST['review_comment1'], $_POST['is_completed1']) && updateFormComment("employee_reference", "application_id", "id", $_POST['id2'], $_POST['review_comment2'], $_POST['is_completed2']) && updateFormComment("employee_reference", "application_id", "id", $_POST['id3'], $_POST['review_comment3'], $_POST['is_completed3']) && updateFormComment("employee_reference", "application_id", "id", $_POST['id4'], $_POST['review_comment4'], $_POST['is_completed4'])
  ) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  // mysqli_close($mycon);
  echo json_encode($json);
}
//pre($_POST);
if (isset($_POST['form_type']) && $_POST['form_type'] == 'verification') {
  if (updateFormComment("employee_police_verification", "application_id", "id", $_POST['id'], $_POST['review_comment'], $_POST['is_completed'])) {
    $json = array("status" => 1, "msg" => "Data Submitted Sucessfully");
  } else {

    $json = array("status" => 0, "msg" => "Server Error");
  }
  echo json_encode($json);
}
if (isset($_POST['action']) && isset($_POST['application_id'])) {
  $mycon = getConnection();
  $sqlDeleteApplication = "DELETE  tbl_application, employee_personal_info_tbl,employee_address,employee_education_tbl,employee_employment_info_tbl,employee_police_verification,employee_reference from tbl_application  "
          . " inner join employee_personal_info_tbl "
          . " inner join employee_address "
          . " inner join employee_education_tbl "
          . " inner join employee_employment_info_tbl "
          . " inner join employee_police_verification "
          . " inner join employee_reference "
          . " inner join document_upload "
          . " WHERE tbl_application.application_ref_id = employee_personal_info_tbl.application_id"
          . " AND employee_personal_info_tbl.application_id = employee_address.application_id"
          . " AND employee_address.application_id = employee_education_tbl.application_id"
          . " AND employee_education_tbl.application_id = employee_employment_info_tbl.application_id"
          . " AND employee_employment_info_tbl.application_id = employee_police_verification.application_id"
          . " AND employee_police_verification.application_id = employee_reference.application_id"
          . " AND employee_reference.application_id = document_upload.application_id"
          . " AND employee_reference.application_id = '" . $_POST['application_id'] . "'";

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

function insertEducation($order_no, $qualification, $institute, $rollNo, $passingYear, $univercity) {
  $mycon = getConnection();
  $sqlInsertEducation = "INSERT INTO employee_education_tbl SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "qualification  = '" . $qualification . "',"
          . "college_institute  = '" . $institute . "',"
          . "roll_no = '" . $rollNo . "',"
          . "passing_year  = '" . $passingYear . "',"
          . "order_no  = '" . $order_no . "',"
          . "university_board = '" . $univercity . "'"
          . " ";
  if (mysqli_query($mycon, $sqlInsertEducation)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function insertReference($order_no, $rType, $name, $phone, $city, $country, $pincode, $email, $address, $state, $landmark) {
  $mycon = getConnection();
  $sqlInsertEducation = "INSERT INTO employee_reference SET "
          . "user_id = '" . $_SESSION['id'] . "',"
          . "application_id = '" . $_SESSION['application_ref_id'] . "',"
          . "reference_type  = '" . $rType . "',"
          . "name  = '" . $name . "',"
          . "phone_no = '" . $phone . "',"
          . "city  = '" . $city . "',"
          . "country  = '" . $country . "',"
          . "pin_code  = '" . $pincode . "',"
          . "email_address  = '" . $email . "',"
          . "address  = '" . $address . "',"
          . "state  = '" . $state . "',"
          . "order_no  = '" . $order_no . "',"
          . "landmark = '" . $landmark . "'"
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

function updateFormComment($table, $applicationId, $appfield, $id, $comment, $status) {
  $mycon = getConnection();
  $sql = "UPDATE " . $table . " SET "
          . "review_comment = '" . $comment . "',"
          . "is_completed  = '" . $status . "'"
          . " WHERE " . $applicationId . "  = '" . $_POST['application_id'] . "' AND  " . $appfield . "  = '" . $id . "'";

// echo $sql; die;
  if (mysqli_query($mycon, $sql)) {

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

function NewGuid() {
  $s = strtoupper(md5(uniqid(rand(), true)));
  $guidText = substr($s, 0, 8) . '-' .
          substr($s, 8, 4) . '-' .
          substr($s, 12, 4) . '-' .
          substr($s, 16, 4) . '-' .
          substr($s, 20);

  return $guidText;
}
