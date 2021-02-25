<?php

require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

if (isset($_GET['appid'])) {
  $_SESSION['application_ref_id'] = $_GET['appid'];
}
//print_r($mycon);
//die;
$appInformation = getAllAppInformation($mycon, $_GET['appid']);
//$appInformationcheck = getAllAppInformationCheck($mycon, $_GET['appid']);
//echo '<pre>';
//print_r($appInformation);
//die;
$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];
$user_department = $userdata['department'];
// echo $user_department;

////Fetch data from role wised
////echo $ff = $userdata['id']; die;

if ($userdata['role'] == '2' || $userdata['role'] == '3') {
  $user_location = $userdata['org_id'];
  $user_client = $userdata['client_id'];
  $role_item = " AND organization_id = '" . $user_location . "'";
  $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
} else {
  $role_item = '';
  $loc_item = '';
}

$app_id = $_GET['appid'];
$userdata = getUserDataByUserId($_SESSION['id']);
// $userRole = $userdata['role'];
$user_id = $userdata['id'];

// echo $user_id; die;
function get_type_of_verification($mycon, $app_id)
{

  $sql = "select type_of_check from tbl_application where application_ref_id = '" . $app_id . "' limit 1";
  $result =  mysqli_query($mycon, $sql);
  if (mysqli_num_rows($result) >  0) {
    $row = mysqli_fetch_assoc($result);
    return $row['type_of_check'];
  }
}

function get_type_of_verification_case_allocate($mycon, $app_id, $user_id)
{

  $sql = "select allocate_type_of_check from `case_allocate` where application_id = '" . $app_id . "' and user_id= '" . $user_id . "' limit 1";

  //  echo $sql; die;
  $result =  mysqli_query($mycon, $sql);
  if (mysqli_num_rows($result) >  0) {
    $row = mysqli_fetch_assoc($result);
    return $row['allocate_type_of_check'];
  }
}

$type_of_verification = get_type_of_verification($mycon, $app_id);
$type_of_verification_array = explode(',', $type_of_verification);


if (trim(strtolower($user_department)) == trim(strtolower("Research Executive")) || trim(strtolower($user_department)) == trim(strtolower("Research Executive"))) {

  $type_of_verification = get_type_of_verification_case_allocate($mycon, $app_id, $user_id);
  $type_of_verification_array = explode(',', $type_of_verification);
}
// print_r($type_of_verification_array);
// echo gettype($type_of_verification_array);
// if (in_array('2', $type_of_verification_array)) {
//    echo "The 'Employment Details' element is in the array";
// }



function is_visble_verification_tab($tab_no, $type_of_verification_array)
{
  if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
  else return 'style="display:none"';
}
function is_visble_verification_tab_multi($tab_no_array, $type_of_verification_array)
{

  foreach ($tab_no_array as $tab_no) {
    if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
    else $status = false;
  }

  if ($status == false) {
    return 'style="display:none"';
  }
}


// function is_showable($display_cl){

// }



// END code to ALLOW only SELECTED TABS




?>
<?php include 'includes/head.php'; ?>

<!--************* Css Link **********************-->
<script>
  var baseURL = "<?php echo baseUrl(); ?>";
</script>
<!-- <link rel="icon" href="../assets/images/fav_icon.png" type="image/x-icon"> -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bower_components/sweetalert/css/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="../assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../assets/icon/feather/css/feather.css">
<!-- <link rel="stylesheet" type="text/css" href="files/../assets/css/component.css"> -->
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery-steps.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">

<style type="text/css">
   .step-app>.step-content {
      border: 1px solid #e5e5e5;
      padding: 10px 10px 80px !important;
      border-top: 0;
      min-height: 680px !important;
      max-height: 2400px !important;
   }

   .step-app>.step-steps {
    margin: 0;
    padding: 0;
    display: flex;
    border-radius: 3px 3px 0 0;
    overflow: auto;
}

.step-app>.step-steps>li>a {
    display: block;
    padding: 10px;
    color: #333;
    background-color: #e5e5e5;
    text-decoration: none;
    border-right: 1px solid #fff;
    min-height: 75px;
    min-width:140px;
    vertical-align: middle;
    text-align: center;
    font-weight: 600;
}
   .step-app>.step-footer {
      margin-top: 23px !important;
      margin-bottom: 1px !important;
      text-align: center;
   }

   .disabled {
      color: currentColor;
      cursor: default;
      pointer-events: none;
      opacity: 0.5;
      text-decoration: none;
   }
</style>

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">
          <div class="card">
            <div class="card-block application_dtls">



              <!--******** Wizard_new Start HTML ***********-->
              <div id="demo">
                <div class="step-app">
                  <ul class="step-steps">
                    <li><a href="#tab1">Application Details</a></li>
                    <li><a href="#tab2">Personal Details</a></li>
                    <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?>><a href="#tab3">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="#tab4">Educational Details</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>><a href="#tab18">Identity Verification</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>><a href="#tab5">Employment Details</a></li>
                    <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?>><a href="#tab6">Police Verification</a></li>
                    <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?>><a href="#tab7">Reference Details</a></li>
                    <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?>><a href="#tab8">Bank Details</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab9">CIBIL Details</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab10">Court Records Check</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab11">Drug Details</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab12">Global data base check</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab13">Social Security Number (SSN) Verification</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab14">Criminal background check</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab15">Global Sanction</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab16">National Sex Offender Registry (NSO)</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="#tab17">Company Verification</a></li>
                  </ul>
                  <div class="step-content">
                    <div class="step-tab-panel" id="tab1">
                      <h3 class="employer_one">Application Details</h3>
                      <form method="post" id="import_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="application">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id']; ?>">


                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>HMDS ID</th>
                                <td> : </td>
                                <td><?php echo $appInformation['hmds_id']; ?></td>
                              </tr>
                              <tr>
                                <th>Client Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['client_name']; ?></td>
                              </tr>
                              <tr>
                                <th>Client Location</th>
                                <td> : </td>
                                <td><?php echo $appInformation['client_location']; ?></td>
                              </tr>
                              <tr>
                                <th>Case Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['case_id']; ?></td>

                              </tr>
                              <tr>
                                <th>Type Of Check</th>
                                <td> : </td>
                                <?php getTypeOfCheckName($mycon, explode(',', $appInformation['type_of_check'])); ?></td>


                              </tr>
                              <tr>
                                <th>Unique Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['unique_id']; ?></td>

                              </tr>
                            </table>

                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Application Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['application_ref_id']; ?></td>

                              </tr>
                              <tr>
                                <th>Application Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['application_ref_id']; ?></td>

                              </tr>
                              <tr>
                                <th>Case Rec. date</th>
                                <td> : </td>
                                <td><?php echo $appInformation['case_record_date']; ?></td>

                              </tr>
                              <tr>
                                <th>Client Relationship Person Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['client_relationship_person_name']; ?></td>

                              </tr>
                              <tr>
                                <th>Client Contact Number</th>
                                <td> : </td>
                                <td><?php echo $appInformation['phone']; ?></td>

                              </tr>

                            </table>


                          </div>
                        </div>
                        <?php if (trim(strtolower($user_department)) == trim(strtolower("Team leader")) || trim(strtolower($user_department)) == trim(strtolower("Manager"))) {
                        ?>
                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">Team Member Name </label>
                                <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Team Member Name" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Team Member Designation </label>
                                <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Team Member Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Team Member Remark</label>
                                <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Team Member Remark" class="form-control">
                              </div>
                            </div>


                            <div class="col-md-6">

                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box"> Is Apllication <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                              </div>
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Personal <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_personal_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_personal_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_personal_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Address <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_address_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_address_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_address_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Education <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_education_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_education_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_education_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Employer <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_emp_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_emp_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_emp_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Police <br>Verification Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_police_verification_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_police_verification_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_police_verification_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Relation <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_relation_details_checked" value="1" checked="checked"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_relation_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_relation_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Bank <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_bank_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_bank_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_bank_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?> class="form-group eligibility_ind"><label class=" input_hdr check_box">Is CIBIL <br>Details Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_cibil_details_checked" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_cibil_details_checked" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_cibil_details_checked" value="0" checked="checked"> <span>NA</span></label>

                              </div>
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is All form <br> Component Verified
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="complete_status_check" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="complete_status_check" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="complete_status_check" value="0" checked="checked"> <span>NA</span></label>

                              </div>


                            </div>

                          </div>
                        <?php  } ?>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="appCheckSubmit()" type="submit" class="btn btn-primary">Save</button>

                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab2">
                      <h3 class="employer_one">Personal Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="personal">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['personalData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="personalCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab3">
                      <h3 class="employer_one">Address Details</h3>
                      <form method="post" id="address_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="address">
                        <input type="hidden" name="application_id" value="<?php echo $_GET['appid'] ?>">

                        <div class="row">

                          <?php
                          // print_r($appInformation['addressData']);
                          foreach ($appInformation['addressData'] as $addressData) {
                            $addressType = ($addressData['address_type'] == '1') ? "Present Address" : "Permanent Address";
                          ?>

                            <div class="col-md-6">
                              <div class="present_adress">
                                <label class="input_hdr"><?php echo $addressType; ?></label>
                              </div>
                              <table class="table">
                                <tr>
                                  <th>Address</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['address'] ?></td>
                                </tr>
                                <tr>
                                  <th>Landmark</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['landmark'] ?></td>
                                </tr>
                                <tr>
                                  <th>Country</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['country'] ?></td>
                                </tr>
                                <tr>
                                  <th>City</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['city'] ?></td>
                                </tr>
                                <tr>
                                  <th>State</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['state'] ?></td>
                                </tr>
                                <tr>
                                  <th>Pin Code</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['pin_code'] ?></td>
                                </tr>
                              </table>
                            </div>
                          <?php } ?>


                        </div>

                        <div class="row">
                          <?php
                          $i = 0;
                          // print_r($appInformation['addressData']);
                          foreach ($appInformation['addressData'] as $addressData) {
                          ?>
                            <div class="col-md-6">

                              <input type="hidden" name="address_id[]" value="<?php echo $addressData['id'] ?>">
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Accommodation Type
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="accommodation_type<?php echo $i ?>[]" value="Rented" checked="checked"> <span>Rented</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="accommodation_type<?php echo $i ?>[]" value="Owned"> <span>Owned</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="accommodation_type<?php echo $i ?>[]" value="Paying Guest"> <span>Paying Guest</span></label>
                              </div>
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">IS Verify
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify<?php echo $i ?>[]" value="1"> <span>YES</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify<?php echo $i ?>[]" value="2"> <span>NO</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_verify<?php echo $i ?>[]" value="0" checked="checked"> <span>NA</span></label>
                              </div>


                              <div class="form-group">
                                <label class="control-label input_hdr">How Many Years Candidate is Residing </label>
                                <div>
                                  <input type="text" name="living_period[]" id="living_period" data-required="1" placeholder="How Many Years Candidate is Residing " class="form-control">
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="control-label input_hdr">Verifier Relationship
                                  <span class="required" aria-required="true"> * </span>
                                </label>
                                <div>
                                  <input type="text" name="verifier_relationship[]" id="verifier_relationship" placeholder="Verifier Relationship" data-required="1" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label input_hdr">Sign of Respondent
                                  <span class="required" aria-required="true"> * </span>
                                </label>
                                <div>
                                  <input type="text" name="sign_of_respondent[]" id="sign_of_respondent" placeholder="Sign of Respondent" data-required="1" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label input_hdr">Contact of Respondent
                                  <span class="required" aria-required="true"> * </span>
                                </label>
                                <div>
                                  <input type="text" name="contact_of_respondent[]" id="contact_of_respondent" placeholder="Contact of Respondent" data-required="1" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Name </label>
                                <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Designation </label>
                                <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Remark</label>
                                <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                              </div>

                              <!---Start upload documents code--->
                              <br /><br />
                              <p style="color:#c51b1b;">Upload Documents</p>
                              <div class="form-group">
                                <label class="input_hdr" for="select">Select Documents</label>
                                <select name="address_doc_type[]" class="form-control">
                                  <option value="Adhar card">Adhar card </option>
                                  <option value="Pan card">Pan card </option>
                                  <option value="Pan card">Voter card</option>
                                  <option value="Pan card">Passport no.</option>

                                </select>
                              </div>
                              <div class="form-group">
                                <!--   <label class="control-label">Telephone
                                  <span aria-required="true" class="required"> * </span></label>  -->
                                <div><input type="text" name="address_doc_desc[]" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                              </div>
                              <div class="form-group">
                                <div>
                                  <input type="file" name="address_doc[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                </div>
                              </div>
                              <!---End upload documents code--->
                            </div>

                          <?php
                            $i++;
                          }
                          ?>
                        </div>

                        <!----------------------------------------------------------------------------------->


                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="address_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="addressCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- tab4 -->
                    <div class="step-tab-panel" id="tab4" style="height: 960px !important;">
                      <h3 class="employer_one">Educational Details</h3>
                      <form name="frmLogin" id="frmLogin" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="education" />
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id']; ?>" />

                        <div>
                          <div class="alert alert-success alert-dismissable" id="edu_success_message" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <div></div>
                          </div>

                          <!--<p id="success_message"></p>-->

                          <!-- vertical tab -->
                          <div class="vertical_tabs_views">
                            <div class="tabordion">
                              <section id="section1">
                                <input type="radio" name="sections" id="option1" checked />
                                <label class="labls" for="option1">High School (10th) </label>
                                <article>
                                  <h4 class="employer_one">High School (10th)</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][0]['college_institute'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][0]['roll_no'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][0]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][0]['university_board'] ?></td>
                                      </tr>
                                    </table>
                                  </div>

                                  <input type="hidden" name="high_school" id="high_school" value="High School" data-required="1" class="form-control" />
                                  <input type="hidden" name="high_school_id" id="high_school" value="<?php echo $appInformation['eduData'][0]['id'] ?>" data-required="1" class="form-control" />

                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Emp Name Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_10" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_10" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_10" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Roll No Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_10" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_10" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_10" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is University Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_10" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_10" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_10" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Institute Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_10" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_10" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_10" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Passing Year Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_10" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_10" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_10" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Name </label>
                                    <input type="text" name="verifier_name_10" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Designation </label>
                                    <input type="text" name="verifier_designation_10" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Remark</label>
                                    <input type="text" name="verifier_remark_10" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control" />
                                  </div>

                                  <!---Start upload documents code--->
                                  <br />
                                  <br />
                                  <p style="color: #c51b1b;">Upload Documents</p>
                                  <div class="form-group">
                                    <div><input type="text" name="high_school_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no." /></div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="high_school_doc_file[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple />
                                    </div>
                                  </div>
                                  <!---End upload documents code--->
                                </article>
                              </section>
                              <section id="section2">
                                <input type="radio" name="sections" id="option2" />
                                <label class="labls" for="option2">Intermediate (12th) </label>
                                <article>
                                  <h4 class="employer_one">Intermediate (12th)</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][1]['college_institute'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][1]['roll_no'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][1]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][1]['university_board'] ?></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <input type="hidden" name="intermediate" id="intermediate" value="Intermediate" data-required="1" class="form-control" />
                                  <input type="hidden" name="intermediate_id" id="intermediate_id" value="<?php echo $appInformation['eduData'][1]['id'] ?>" data-required="1" class="form-control" />

                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Emp Name Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_12" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_12" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_12" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Roll No Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_12" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_12" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_12" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is University Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_12" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_12" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_12" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Institute Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_12" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_12" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_12" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Passing Year Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_12" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_12" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_12" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Name </label>
                                    <input type="text" name="verifier_name_12" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Designation </label>
                                    <input type="text" name="verifier_designation_12" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Remark</label>
                                    <input type="text" name="verifier_remark_12" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control" />
                                  </div>

                                  <!---Start upload documents code--->
                                  <br />
                                  <br />
                                  <p style="color: #c51b1b;">Upload Documents</p>
                                  <div class="form-group">
                                    <div><input type="text" name="intermediate_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no." /></div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="intermediate_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple />
                                    </div>
                                  </div>
                                  <!---End upload documents code--->
                                </article>
                              </section>
                              <section id="section3">
                                <input type="radio" name="sections" id="option3" />
                                <label class="labls" for="option3">Degree Graduation </label>
                                <article>
                                  <h4 class="employer_one">Graduation Degree</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][2]['college_institute'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][2]['roll_no'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][2]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][2]['university_board'] ?></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">
                                      Degree (Please Specify)
                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                    </label>
                                    <div>
                                      <input type="text" name="graduation_degree" id="graduation_degree" data-required="1" class="form-control" />
                                      <input type="hidden" name="graduation_degree_id" id="graduation_degree_id" value="<?php echo $appInformation['eduData'][2]['id'] ?>" data-required="1" class="form-control" />
                                    </div>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Emp Name Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_grad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_grad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_grad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Roll No Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_grad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_grad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_grad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is University Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_grad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_grad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_grad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Institute Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_grad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_grad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_grad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Passing Year Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_grad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_grad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_grad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Name </label>
                                    <input type="text" name="verifier_name_grad" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Designation </label>
                                    <input type="text" name="verifier_designation_grad" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Remark</label>
                                    <input type="text" name="verifier_remark_grad" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control" />
                                  </div>
                                  <!---Start upload documents code--->
                                  <br />
                                  <br />
                                  <p style="color: #c51b1b;">Upload Documents</p>
                                  <div class="form-group">
                                    <div><input type="text" name="graduation_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no." /></div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="graduation_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple />
                                    </div>
                                  </div>
                                  <!---End upload documents code--->
                                </article>
                              </section>
                              <section id="section4">
                                <input type="radio" name="sections" id="option4" />
                                <label class="labls" for="option4">Post Graduation</label>
                                <article>
                                  <h4 class="employer_one">Post Graduation</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][3]['college_institute'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][3]['roll_no'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][3]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][3]['university_board'] ?></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">
                                      Degree (Please Specify)
                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                    </label>
                                    <div>
                                      <input type="text" name="post_graduation_degree" id="post_graduation_degree" data-required="1" class="form-control" placeholder="" />
                                      <input type="hidden" name="post_graduation_degree_id" value="<?php echo $appInformation['eduData'][3]['id'] ?>" id="post_graduation_degree" data-required="1" class="form-control" placeholder="" />
                                    </div>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Emp Name Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_pgrad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_pgrad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_pgrad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Roll No Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_pgrad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_pgrad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_pgrad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is University Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_pgrad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_pgrad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_pgrad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Institute Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_pgrad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_pgrad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_pgrad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Passing Year Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_pgrad" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_pgrad" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_pgrad" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Name </label>
                                    <input type="text" name="verifier_name_pgrad" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Designation </label>
                                    <input type="text" name="verifier_designation_pgrad" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Remark</label>
                                    <input type="text" name="verifier_remark_pgrad" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control" />
                                  </div>
                                  <!---Start upload documents code--->
                                  <br />
                                  <br />
                                  <p style="color: #c51b1b;">Upload Documents</p>
                                  <div class="form-group">
                                    <div><input type="text" name="post_graduation_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no." /></div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="post_graduation_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple />
                                    </div>
                                  </div>
                                  <!---End upload documents code--->
                                </article>
                              </section>
                              <section id="section5">
                                <input type="radio" name="sections" id="option5" />
                                <label class="labls" for="option5">If Any Other Qualification</label>
                                <article>
                                  <h4 class="employer_one">If Any Other Qualification</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Degree/ Diploma/ Professional Courses</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData']['4']['course'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][4]['college_institute'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][4]['roll_no'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][4]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td>:</td>
                                        <td><?php echo $appInformation['eduData'][4]['university_board'] ?></td>
                                      </tr>
                                    </table>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">
                                      Degree/ Diploma/ Professional Courses
                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                    </label>
                                    <div>
                                      <input type="text" name="diploma" id="diploma" data-required="1" class="form-control" />
                                      <input type="hidden" name="diploma" value="<?php echo $appInformation['eduData'][4]['id'] ?>" id="diploma" data-required="1" class="form-control" />
                                    </div>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Emp Name Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_diploma" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_diploma" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_emp_name_correct_diploma" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Roll No Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_diploma" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_diploma" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_rollno_correct_diploma" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is University Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_diploma" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_diploma" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_university_correct_diploma" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Institute Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_diploma" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_diploma" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_institute_correct_diploma" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group eligibility_ind">
                                    <label class="input_hdr check_box">Is Passing Year Correct <span aria-required="true" class="required"> * </span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_diploma" value="1" /> <span>Yes</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_diploma" value="2" /> <span>No</span></label>
                                    <label class="radio input_hdr"><input type="radio" name="is_passing_year_correct_diploma" value="" checked="checked" /> <span>NA</span></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Name </label>
                                    <input type="text" name="verifier_name_diploma" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Designation </label>
                                    <input type="text" name="verifier_designation_diploma" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label class="input_hdr" for="">Verifier Remark</label>
                                    <input type="text" name="verifier_remark_diploma" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control" />
                                  </div>
                                  <!---Start upload documents code--->
                                  <br />
                                  <br />
                                  <p style="color: #c51b1b;">Upload Documents</p>
                                  <div class="form-group">
                                    <div><input type="text" name="diploma_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no." /></div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                      <input type="file" name="diploma_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple />
                                    </div>
                                  </div>
                                  <!---End upload documents code--->
                                </article>
                              </section>
                            </div>
                          </div>
                          <!-- vertical tab -->
                          <div class="row">
                            <div class="col text-center" style="margin-top: 53%;">
                              <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                              <button onclick="eduCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- End tab4 -->






                    <!--  tab5 -->

                    <div class="step-tab-panel" id="tab5" style="min-height: 100% !important;">
                      <h3 class="employer_one">Employer Details-1</h3>
                      <!--  form employment end -->
                      <form method="post" id="imployer_form" enctype="multipart/form-data">

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Employer Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['employer_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Period of Employment </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['date_of_joining'] ?></td>
                              </tr>
                              <tr>
                                <th>Salary (Monthly) </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['salary'] ?></td>
                              </tr>
                              <tr>
                                <th>Telephone </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['company_phone'] ?></td>
                              </tr>
                              
                              <!-- <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php // echo $appInformation['empData'][0]['employer_name'] ?></td>
                              </tr> -->
                              <tr>
                                <th>Company or Branch Address</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['branch_address'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Reporting Manager Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['reporting_mngr_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Reporting Manager Email </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['reporting_mngr_email'] ?></td>
                              </tr>
                              <tr>
                                <th>Position</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Department</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['department'] ?></td>
                              </tr>
                              <tr>
                                <th>Reason for Leaving </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['reason_for_leaving'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <input type="hidden" name="form_type" value="employer">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="form_type" value="employer">
                        <div class="customer_records" style="width: 100%">

                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Name </label>
                                <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Designation </label>
                                <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Remark</label>
                                <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                              </div>
                              <!---Start upload documents code--->
                              <br /><br />
                              <p style="color:#c51b1b; margin-top: -42px;">Upload Documents</p>
                              <div class="form-group" style="margin-top: -20px;">
                                <label class="input_hdr" for="select">Select Documents</label>
                                <select name="employer_certificate[]" class="form-control">
                                  <option>Employer-1</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <!--   <label class="control-label">Telephone
                                  <span aria-required="true" class="required"> * </span></label>  -->
                                <div><input type="text" name="certificate_number[]" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                              </div>
                              <div class="form-group">
                                <div>
                                  <input type="file" name="certificate_file1[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                </div>
                              </div>
                              <!---End upload documents code--->
                            </div>
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">Was the candidate Behavior During Tenure </label>
                                <input type="text" name="was_the_candidate_behavior_during_tenure[]" id="was_the_candidate_behavior_during_tenure" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Eligible for Rehire </label>
                                <input type="text" name="eligible_for_rehire[]" id="eligible_for_rehire" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                              </div>

                            </div>


                            <!-- <a class="extra-fields-customer" href="#">Add More Employer <span class="fa fa-plus-circle"></span></a>-->
                          </div>
                        </div>
                        <br /><br />
                        <h3 class="employer_one">Employer Details-2</h3>
                        <!--  form employment end -->

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][1]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Employer Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['employer_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Period of Employment </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['date_of_joining'] ?></td>
                              </tr>
                              <tr>
                                <th>Salary (Monthly) </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['salary'] ?></td>
                              </tr>
                              <tr>
                                <th>Telephone </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['company_phone'] ?></td>
                              </tr>
                              <!-- <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php // echo $appInformation['empData'][1]['employer_name'] ?></td>
                              </tr> -->
                              <tr>
                                <th>Company or Branch Address</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['branch_address'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Reporting Manager Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reporting_mngr_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Reporting Manager Email </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reporting_mngr_email'] ?></td>
                              </tr>
                              <tr>
                                <th>Position</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Department</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['department'] ?></td>
                              </tr>
                              <tr>
                                <th>Reason for Leaving </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reason_for_leaving'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>


                        <div class="customer_records" style="width: 100%">
                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Name </label>
                                <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Designation </label>
                                <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Remark</label>
                                <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                              </div>
                              <!---Start upload documents code--->
                              <br /><br />
                              <p style="color:#c51b1b; margin-top: -42px;">Upload Documents</p>
                              <div class="form-group" style="margin-top: -20px;">
                                <label class="input_hdr" for="select">Select Documents</label>
                                <select name="employer_certificate[]" class="form-control">
                                  <option>Employer-1</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <!--   <label class="control-label">Telephone
                                  <span aria-required="true" class="required"> * </span></label>  -->
                                <div><input type="text" name="certificate_number[]" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                              </div>
                              <div class="form-group">
                                <div>
                                  <input type="file" name="certificate_file2[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                </div>
                              </div>
                              <!---End upload documents code--->
                            </div>
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">What was the candidate Behavior During Tenure </label>
                                <input type="text" name="was_the_candidate_behavior_during_tenure[]" id="was_the_candidate_behavior_during_tenure" aria-describedby="" placeholder="What was the candidate Behavior During Tenure" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Eligible for Rehire </label>
                                <input type="text" name="eligible_for_rehire[]" id="eligible_for_rehire" aria-describedby="" placeholder="Eligible for Rehire" class="form-control">
                              </div>

                            </div>


                            <!-- <a class="extra-fields-customer" href="#">Add More Employer <span class="fa fa-plus-circle"></span></a>-->
                          </div>
                        </div>
                        <br /><br />
                        <h3 class="employer_one">Employer Details-3</h3>
                        <!--  form employment end -->

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][2]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Employer Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['employer_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Period of Employment </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['date_of_joining'] ?></td>
                              </tr>
                              <tr>
                                <th>Salary (Monthly) </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['salary'] ?></td>
                              </tr>
                              <tr>
                                <th>Telephone </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['company_phone'] ?></td>
                              </tr>
                              <!-- <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php // echo $appInformation['empData'][2]['employer_name'] ?></td>
                              </tr> -->
                              <tr>
                                <th>Company or Branch Address</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['branch_address'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Reporting Manager Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reporting_mngr_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Reporting Manager Email </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reporting_mngr_email'] ?></td>
                              </tr>
                              <tr>
                                <th>Position</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Department</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['department'] ?></td>
                              </tr>
                              <tr>
                                <th>Reason for Leaving </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reason_for_leaving'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>



                        <div class="customer_records" style="width: 100%">
                          <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Name </label>
                                <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Designation </label>
                                <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Verifier Remark</label>
                                <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                              </div>
                              <!---Start upload documents code--->
                              <br /><br />
                              <p style="color:#c51b1b; margin-top: -42px;">Upload Documents</p>
                              <div class="form-group" style="margin-top: -20px;">
                                <label class="input_hdr" for="select">Select Documents</label>
                                <select name="employer_certificate[]" class="form-control">
                                  <option>Employer-1</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <!--   <label class="control-label">Telephone
                                  <span aria-required="true" class="required"> * </span></label>  -->
                                <div><input type="text" name="certificate_number[]" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                              </div>
                              <div class="form-group">
                                <div>
                                  <input type="file" name="certificate_file3[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                </div>
                              </div>
                              <!---End upload documents code--->
                            </div>
                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="input_hdr" for="">What was the candidate Behavior During Tenure </label>
                                <input type="text" name="was_the_candidate_behavior_during_tenure[]" id="was_the_candidate_behavior_during_tenure" aria-describedby="" placeholder="What was the candidate Behavior During Tenure" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="input_hdr" for="">Eligible for Rehire </label>
                                <input type="text" name="eligible_for_rehire[]" id="eligible_for_rehire" aria-describedby="" placeholder="Eligible for Rehire" class="form-control">
                              </div>

                            </div>


                            <!-- <a class="extra-fields-customer" href="#">Add More Employer <span class="fa fa-plus-circle"></span></a>-->
                          </div>
                        </div>
                        <div class="customer_records_dynamic"></div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="emp_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center" style="margin-top: 0%;">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="empCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>


                    <!-- End tab5 -->









                    <!--  form employment end -->

                    <!-- tab6 -->

                    <div class="step-tab-panel" id="tab6">
                      <h3 class="employer_one">Police Verification Details</h3>
                      <form name="frmMobile" id="frmMobile" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="verification">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['vrificationData']['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['vrificationData']['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['first_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['last_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Address </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['address'] ?></td>
                              </tr>
                              <tr style="display: none;" >
                                <th>Village / Town / City </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['city'] ?></td>
                              </tr>
                              <tr>
                                <th> City </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['state'] ?></td>
                              </tr>
                              <tr>
                                <th> State </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['country'] ?></td>
                              </tr>
                              <tr>
                                <th> Police Station Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['police_station'] ?></td>
                              </tr>

                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['middle_name'] ?></td>
                              </tr>
                              <tr style="display: none;">
                                <th>House No/Bldg./ Apt. </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['house_no'] ?></td>
                              </tr>
                              <tr>
                                <th>Landmark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['landmark'] ?></td>
                              </tr>
                              <tr style="display: none;">
                                <th>Area / Locality / Sector</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['area'] ?></td>
                              </tr>

                              <tr style="display: none;">
                                <th>Distic</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['district'] ?></td>
                              </tr>
                              <tr>
                                <th>Pin Code</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['pincode'] ?></td>
                              </tr>
                              <tr>
                                <th>Country</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['country'] ?></td>
                              </tr>

                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>


                            <!---Start upload documents code--->
                            <br /><br />
                            <p style="color:#c51b1b;">Upload Documents</p>
                            <!--                            <div class="form-group">
                                                          <label class="input_hdr" for="select">Select Documents</label>
                                                          <select name="select" class="form-control">
                                                            <option>Police Verification</option>
                                                          </select>
                                                        </div>-->
                            <div class="form-group">
                              <!--   <label class="control-label">Telephone
                                <span aria-required="true" class="required"> * </span></label>  -->
                              <div><input type="text" name="verification_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                            </div>
                            <div class="form-group">
                              <div>
                                <input type="file" name="verification_doc[]" id="verification_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                              </div>
                            </div>
                            <!---End upload documents code--->
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Police Authority
                                <!--  <span aria-required="true" class="required"> * </span> --></label>
                              <div>
                                <input type="text" name="police_authority" id="police_authority" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>



                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="verificationCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>


                    </div>









                    <!-- End tab6 -->






                    <!--******** refrence details  start **********-->
                    <div class="step-tab-panel" id="tab7">
                      <h3 class="employer_one">Reference Details</h3>
                      <form name="reference_form" id="reference_form">

                        <input type="hidden" name="form_type" value="reference">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <!-- vertical tab -->
                        <div class="vertical_tabs_views">
                          <div class="tabordion">
                            <section id="section611">
                              <input type="radio" name="sections" id="option611" checked="">
                              <label class="labls" for="option611">Professional Reference-1
                              </label>
                              <article>
                                <div class="row">
                                  <h4 class="employer_one">Professional Reference-1</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceData'][0]['id'] ?>">
                                      <tbody>
                                        <tr>
                                          <th>Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['name'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>Email</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['email_address'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Phone No.</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['phone_no'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>City</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['city'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>State</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['state'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Country</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['country'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Pin Code</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][0]['pin_code'] ?></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Name </label>
                                      <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Designation </label>
                                      <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Remark</label>
                                      <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify1" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify1" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify1" value="0" checked="checked"> <span>NA</span></label>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Candidate During Period </label>
                                      <input type="text" name="about_candidate_during_period[]" id="about_candidate_during_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Association Period </label>
                                      <input type="text" name="about_association_period[]" id="about_association_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Self Improvement</label>
                                      <input type="text" name="self_improvement[]" id="self_improvement" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">General Reputation</label>
                                      <input type="text" name="general_reputation[]" id="general_reputation" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Rating
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings1" value="1" checked="checked"> <span>1</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings1" value="2"> <span>2</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings1" value="3"> <span>3</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings1" value="4"> <span>4</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings1" value="5"> <span>5</span></label>
                                    </div>
                                  </div>

                                </div>
                              </article>
                            </section>
                            <section id="section711">
                              <input type="radio" name="sections" id="option711">
                              <label class="labls" for="option711">
                                professional Reference-2
                              </label>
                              <article>
                                <h4 class="employer_one">Professional Reference-2</h4>

                                <div class="row">

                                  <div class="col-md-12">
                                    <table class="table">
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceData'][1]['id'] ?>">

                                      <tbody>
                                        <tr>
                                          <th>Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['name'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>Email</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['email_address'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Phone No.</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['phone_no'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>City</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['city'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>State</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['state'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Country</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['country'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Pin Code</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][1]['pin_code'] ?></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Name </label>
                                      <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Designation </label>
                                      <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Remark</label>
                                      <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify2" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify2" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify2" value="0" checked="checked"> <span>NA</span></label>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Candidate During Period </label>
                                      <input type="text" name="about_candidate_during_period[]" id="about_candidate_during_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Association Period </label>
                                      <input type="text" name="about_association_period[]" id="about_association_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Self Improvement</label>
                                      <input type="text" name="self_improvement[]" id="self_improvement" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">General Reputation</label>
                                      <input type="text" name="general_reputation[]" id="general_reputation" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Rating
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings2" value="1" checked="checked"> <span>1</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings2" value="2"> <span>2</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings2" value="3"> <span>3</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings2" value="4"> <span>4</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings2" value="5"> <span>5</span></label>
                                    </div>
                                  </div>

                                </div>
                              </article>
                            </section>
                            <section id="section811">
                              <input type="radio" name="sections" id="option811">
                              <label class="labls" for="option811">
                                Personal Reference-1
                              </label>
                              <article>
                                <h4 class="employer_one"> Personal Reference-1</h4>
                                <div class="row">

                                  <div class="col-md-12">
                                    <table class="table">
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceData'][2]['id'] ?>">
                                      <tbody>
                                        <tr>
                                          <th>Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['name'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>Email</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['email_address'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Phone No.</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['phone_no'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>City</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['city'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>State</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['state'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Country</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['country'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Pin Code</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][2]['pin_code'] ?></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Name </label>
                                      <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Designation </label>
                                      <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Remark</label>
                                      <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify3" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify3" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify3" value="0" checked="checked"> <span>NA</span></label>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Candidate During Period </label>
                                      <input type="text" name="about_candidate_during_period[]" id="about_candidate_during_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Association Period </label>
                                      <input type="text" name="about_association_period[]" id="about_association_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Self Improvement</label>
                                      <input type="text" name="self_improvement[]" id="self_improvement" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">General Reputation</label>
                                      <input type="text" name="general_reputation[]" id="general_reputation" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Rating
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings3" value="1" checked="checked"> <span>1</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings3" value="2"> <span>2</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings3" value="3"> <span>3</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings3" value="4"> <span>4</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings3" value="5"> <span>5</span></label>
                                    </div>
                                  </div>

                                </div>
                              </article>
                            </section>
                            <section id="section911">
                              <input type="radio" name="sections" id="option911">
                              <label class="labls" for="option911"> Personal Reference-2</label>
                              <article>
                                <h4 class="employer_one"> Personal Reference-2</h4>
                                <div class="row">

                                  <div class="col-md-12">
                                    <table class="table">
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceData'][3]['id'] ?>">
                                      <tbody>
                                        <tr>
                                          <th>Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['name'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>Email</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['email_address'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Phone No.</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['phone_no'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>City</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['city'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>State</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['state'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Country</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['country'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Pin Code</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceData'][3]['pin_code'] ?></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Name </label>
                                      <input type="text" name="verifier_name[]" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Designation </label>
                                      <input type="text" name="verifier_designation[]" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Verifier Remark</label>
                                      <input type="text" name="verifier_remark[]" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify4" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify4" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_verify4" value="0" checked="checked"> <span>NA</span></label>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Candidate During Period </label>
                                      <input type="text" name="about_candidate_during_period[]" id="about_candidate_during_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">About Association Period </label>
                                      <input type="text" name="about_association_period[]" id="about_association_period" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Self Improvement</label>
                                      <input type="text" name="self_improvement[]" id="self_improvement" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">General Reputation</label>
                                      <input type="text" name="general_reputation[]" id="general_reputation" aria-describedby="" class="form-control">
                                    </div>
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Rating
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings4" value="1" checked="checked"> <span>1</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings4" value="2"> <span>2</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings4" value="3"> <span>3</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings4" value="4"> <span>4</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="ratings4" value="5"> <span>5</span></label>
                                    </div>
                                  </div>

                                </div>
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <section id="section5437">
                              <input type="radio" name="sections" id="option543">
                              <label style="background: 0 !important" class="labls" for="option543">&nbsp;</label>
                              <article>
                                &nbsp;
                              </article>
                            </section>
                            <!-- MultiplyImagesuploading start-->



                            <!--                            <div class="colummns large-12">
                                                          <div class="row">
                                                            <div class="large-4 columns" style="margin:0 auto">
                                                              <h4 style="font-size:14px;font-size: 14px; color: #920706;font-weight: 600;">Upload Document</h4>

                                                              <ul id="photos_clearing" class="clearing-thumbs" data-clearing>
                                                              </ul>
                                                              <br/>
                                                              <label for='photos'>Add some pics?:</label>
                                                              <input type="file" id="photos" name="photos[]" multiple/>
                                                            </div>
                                                          </div>
                                                        </div>-->



                            <!-- MultiplyImagesuploading end-->
                          </div>
                        </div>

                        <!-- vertical tab -->

                        <div class="alert alert-success alert-dismissable" id="reference_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="referenceCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!--******** refrence details  end **********-->


















                    <!--  tab8 -->
                    <div class="step-tab-panel" id="tab8">
                      <h3 class="employer_one">Bank Details</h3>
                      <form name="formBank" id="formBank" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="bank">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['bankData'][0]['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['bankData'][0]['id'] ?>">
                        <input type="hidden" name="account_number" value="<?php echo $appInformation['bankData'][0]['account_no'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Bank Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankData'][0]['bank_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Account Holder Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankData'][0]['bank_holder_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Account Number: </th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankData'][0]['account_no'] ?></td>
                              </tr>
                              <tr>
                                <th>Bank Branch </th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankData'][0]['bank_branch'] ?></td>
                              </tr>


                            </table>
                          </div>
                          <div class="col-md-6">
                            <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                            <?php
                            foreach ($appInformation['bankImages'] as $image) {
                              if ($image['title'] == 'Bank Statement' && $image['filename'] != '' && $image['related_to'] == 'bank') {
                            ?>
                                <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                  <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                              }
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>


                            <!---Start upload documents code--->
                            <br /><br />
                            <p style="color:#c51b1b;">Upload Documents</p>


                            <div class="form-group">
                              <div>
                                <input type="file" name="bank_statement_doc[]" id="bank_statement_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                              </div>
                            </div>
                            <!---End upload documents code--->
                          </div>
                          <div class="col-md-6">

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Bank Name Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_name_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_name_correct" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_name_correct" value="" checked="checked"> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Bank Branch Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_branch_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_branch_correct" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_branch_correct" value="" checked="checked"> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Bank Account Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_account_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_account_correct" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_account_correct" value="" checked="checked"> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Bank Holder Name Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_holder_name_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_holder_name_correct" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_bank_holder_name_correct" value="" checked="checked"> <span>NA</span></label>
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>



                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="bankCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>


                    </div>
                    <!-- End tab8  -->







                    <!-- tab9 -->
                    <div class="step-tab-panel" id="tab9">
                      <h3 class="employer_one">CIBIL Details</h3>
                      <form name="formcibil" id="formcibil" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="cibil">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['cibilData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>PAN Card Number </th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['pancard_no'] ?></td>
                              </tr>
                              <!-- <tr>
                                <th>Aadhar Number</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['aadhar_no'] ?></td>
                              </tr>
                              <tr>
                                <th>Mobile Number</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['mobile'] ?></td>
                              </tr>
                              <tr>
                                <th>Email</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['email'] ?></td>
                              </tr>
                              <tr>
                                <th>Occupation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['occupation'] ?></td>
                              </tr>
                              <tr>
                                <th>Monthly Income</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['monthly_income'] ?></td>
                              </tr> -->
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <!-- <tr>
                                <th>Annual Income</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['annual_income'] ?></td>
                              </tr>
                              <tr>
                                <th>Net and Gross Income</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['net_and_gross_income'] ?></td>
                              </tr> -->
                            </table>
                            <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                            <?php
                            foreach ($appInformation['cibilImages'] as $image) {
                              if ($image['filename'] != '' && $image['related_to'] == 'bank') {
                            ?>
                                <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                  <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                              }
                            }
                            ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Reference Number </label>
                              <input type="text" name="reference_number" id="reference_number" aria-describedby="" placeholder="Reference Number" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Member Id </label>
                              <input type="text" name="member_id" id="member_id" aria-describedby="" placeholder="Member Id" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Score Name </label>
                              <input type="text" name="score_name" id="score_name" aria-describedby="" placeholder="Score Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Scoring Factor </label>
                              <input type="text" name="scoring_factor" id="scoring_factor" aria-describedby="" placeholder="Scoring Factor" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Score</label>
                              <input type="text" name="score" id="score" aria-describedby="" placeholder="Score" class="form-control">
                            </div>



                            <!---Start upload documents code--->
                            <br /><br />
                            <p style="color:#c51b1b;">Upload Documents</p>


                            <div class="form-group">
                              <div>
                                <input type="file" name="cibil_doc" id="cibil_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                              </div>
                            </div>
                            <!---End upload documents code--->
                          </div>
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">CIBIL Remark </label>
                              <input type="text" name="cibil_remark" id="cibil_remark" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Dispute Remark </label>
                              <input type="text" name="dispute_remark" id="dispute_remark" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>No</span></label>
                            </div>



                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="cibilCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>


                    </div>

                    <!-- End tab9 -->















                    <div class="step-tab-panel" id="tab010">
                      <h3 class="employer_one">Court Records Check</h3>
                      <form name="formcort" id="formcort" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="court">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">

                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record All India Court for Civil </label>
                              <input type="text" name="found_record_all_india_court_for_civil" id="found_record_all_india_court_for_civil" aria-describedby="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record in All High Court of India for Civil </label>
                              <input type="text" name="found_record_in_all_high_courts_of_india_for_civil" id="found_record_in_all_high_courts_of_india_for_civil" aria-describedby="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record in Supreme Court of India for Civil</label>
                              <input type="text" name="found_record_in_supreme_court_of_india_for_civil" id="found_record_in_supreme_court_of_india_for_civil" aria-describedby="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record in All Session Courts for Criminal</label>
                              <input type="text" name="found_record_in_all_session_courts_for_criminal" id="found_record_in_all_session_courts_for_criminal" aria-describedby="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record All High Courts of India for Criminal</label>
                              <input type="text" name="found_record_all_high_courts_of_india_for_criminal" id="found_record_all_high_courts_of_india_for_criminal" aria-describedby="" class="form-control">
                            </div>



                            <!---Start upload documents code--->
                            <br /><br />
                            <p style="color:#c51b1b;">Upload Documents</p>


                            <div class="form-group">
                              <div>
                                <input type="file" name="court_doc[]" id="court_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                              </div>
                            </div>
                            <!---End upload documents code--->
                          </div>
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Found Record in Supreme Court of India for Criminal </label>
                              <input type="text" name="found_record_in_supreme_court_of_india_for_criminal" id="found_record_in_supreme_court_of_india_for_criminal" aria-describedby="" class="form-control">
                            </div>

                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Applicant Name <br> Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_applicant_name_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_applicant_name_correct" value="0"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_applicant_name_correct" value="" checked=""> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Father Name Correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_father_name_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_father_name_correct" value="0"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_father_name_correct" value="" checked=""> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Address correct
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_address_correct" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_address_correct" value="0"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_address_correct" value="" checked=""> <span>NA</span></label>
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked=""> <span>NA</span></label>
                            </div>



                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="cortCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>


                    </div>
                    <div class="step-tab-panel" id="tab011">
                      <h3 class="employer_one">Drug Details</h3>
                      <form name="formdrud" id="formdrug" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="drug">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">

                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Panel </label>
                              <input type="text" name="panel" id="panel" aria-describedby="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Sample Collected </label>
                              <input type="text" name="sample_collected" id="sample_collected" aria-describedby="" class="form-control">
                            </div>




                            <!---Start upload documents code--->
                            <br /><br />
                            <p style="color:#c51b1b;">Upload Documents</p>


                            <div class="form-group">
                              <div>
                                <input type="file" name="drug_doc[]" id="drug_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                              </div>
                            </div>
                            <!---End upload documents code--->
                          </div>
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="client_location" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="case_id" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="application_id" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked=""> <span>NA</span></label>
                            </div>



                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="drugCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>
                      </form>


                    </div>
  
                    
            <!-- ================== Court Records Check   ===================== -->
            <div class="step-tab-panel" id="tab10">
                      <h3 class="employer_one">Court Records Check </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_court" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="court_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['courtData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="court_verif_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="court_verifCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End Court Records Check ===================== -->
            <!-- ================== Drug Details   ===================== -->
            <div class="step-tab-panel" id="tab11">
                      <h3 class="employer_one">Drug Details </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_drug" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="drug_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['drugData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="drug_verif_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="drug_verifCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End Drug Details ===================== -->


  <!-- ====================global data base check ==================== -->
                    <div class="step-tab-panel" id="tab12">
                      <h3 class="employer_one">Global data base check</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_gcb" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="gcb">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['globalBaseData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="gcb_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="gcbCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>


                    <!-- ==================Social Security Number (SSN) Verification===================== -->
                    <div class="step-tab-panel" id="tab13">
                      <h3 class="employer_one">Social Security Number (SSN) Verification</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_ssn" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="ssn">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['ssnData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="ssn_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="ssnCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================Social Security Number (SSN) Verification===================== -->



                    <!-- ==================Criminal background check ===================== -->
                    <div class="step-tab-panel" id="tab14">
                      <h3 class="employer_one">Criminal background check</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_criminal" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="criminal">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['criminalData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="criminal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="criminalCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================Criminal background check===================== -->

            <!-- ==================Global Sanctions  ===================== -->
                                        <div class="step-tab-panel" id="tab15">
                      <h3 class="employer_one">Global Sanctions </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_gs" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="gs">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['gsData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="gs_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="gsCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End Global Sanctions ===================== -->

            <!-- ================== National Sex Offender Registry   ===================== -->
                  <div class="step-tab-panel" id="tab16">
                      <h3 class="employer_one">National Sex Offender Registry </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_nsr" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="nsr">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['nsrData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />    
                        <div class="alert alert-success alert-dismissable" id="nsr_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="nsrCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End National Sex Offender Registry ===================== -->

            <!-- ================== Identity Verification   ===================== -->
            <div class="step-tab-panel" id="tab18">
                      <h3 class="employer_one">Identity Verification </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_identity" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="identity_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['identityData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>First Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['firstName'] ?></td>
                              </tr>
                              <tr>
                                <th>Last Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['lastName'] ?></td>
                              </tr>
                              <tr>
                                <th>Phone No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['phoneNo'] ?></td>
                              </tr>
                              <tr>
                                <th>Alternate Contact No.</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['alternateContact'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Middle Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['middleName'] ?></td>
                              </tr>
                              <tr>
                                <th>D.O.B</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['dob'] ?></td>
                              </tr>
                              <tr>
                                <th>Email Id</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalData'][0]['email'] ?></td>
                              </tr>
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="identity_verif_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="identity_verifCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End Identity Verification ===================== -->



                    <!-- ================== Company Varification   ===================== -->
                      <div class="step-tab-panel" id="tab17">
                      <h3 class="employer_one">Company Verification </h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="frmInfo_comp_verif" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="comp_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['compVerifData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Company Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['company_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Company Address</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['company_address'] ?></td>
                              </tr>
                              <tr>
                                <th>Contact No</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['contact_no'] ?></td>
                              </tr>
                              <tr>
                                <th>Contact Person Number</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['contact_person_no'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Company Email</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['company_email'] ?></td>
                              </tr>
                              <tr>
                                <th>Company Location</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['company_location'] ?></td>
                              </tr>
                              
                              <!--                              <tr>
                                <th>Gender</th>
                                <td> : </td>
                                <td>Male</td>
                              </tr>-->
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Name </label>
                              <input type="text" name="verifier_name" id="verifier_name" aria-describedby="" placeholder="Verifier Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Designation </label>
                              <input type="text" name="verifier_designation" id="verifier_designation" aria-describedby="" placeholder="Verifier Designation" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Verifier Remark</label>
                              <input type="text" name="verifier_remark" id="verifier_remark" aria-describedby="" placeholder="Verifier Remark" class="form-control">
                            </div>
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is Verify
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_verify" value="0" checked="checked"> <span>NA</span></label>
                            </div>
                          </div>

                          <!--  <div class="file-upload">

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                               </div>
                                <div class="file-upload-content">
                                  <img class="file-upload-image" src="#" alt="your image">
                                  <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                  </div>
                                </div>
                               </div>-->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="comp_verif_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button onclick="comp_verifCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <div class="row">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>



                    <!-- ==================End Company Varification ===================== -->



                  </div>

                  <div class="step-footer" style="display: none">
                    <button data-direction="prev" class="step-btn prev">Previous</button>
                    <button data-direction="next" class="step-btn next">Next</button>
                    <button data-direction="finish" class="step-btn finish">Finish</button>
                  </div>
                </div>
              </div>

              <!--******** Wizard_new End HTML *************-->
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- modal for add from -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 500px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Request for DD/Payment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept="">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label"> Amount
                </label>
                <div>
                  <input type="text" name="amount" id="amount" onkeypress=" var result =  isNumber(event); return result; " maxlength="20" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">DD No
                </label>
                <div>
                  <input type="text" id="dd_no" name="dd_no" onkeypress=" var result =  isNumber(event); return result; " maxlength="50" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="input_hdr" for="select">DD made or not </label>
                <!-- <input type="text" id="case_id" name="case_id" class="form-control"> -->
                <div>
                  <select name="dd_made_or_not" id="dd_made_or_not" class="form-control">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>



                    <?php
                    // $sql_all_app_id = "select application_ref_id from tbl_application";
                    // echo $sql_all_app_id; die;
                    // $result_all_app_id = mysqli_query($mycon, $sql_all_app_id);
                    // if (mysqli_num_rows($result_all_app_id) > 0) {
                    //     while ($application = mysqli_fetch_assoc($result_all_app_id)) {
                    ?>
                    <!-- //         <option value="<?php // echo $application['application_ref_id']; 
                                                    ?>"><?php //echo $application['application_ref_id'] 
                                                        ?></option> -->
                    // <?php //}
                        // } 
                        ?>


                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Application ID
                </label>
                <div>
                  <select name="applicationIdDD" id="applicationIdDD" onchange="changed_application_id('applicationIdDD','type_of_check');" class="form-control">
                    <option value="">Select</option>
                    <?php
                    $sql_all_app_id = "select application_ref_id from tbl_application";
                    // echo $sql_all_app_id; die;
                    $result_all_app_id = mysqli_query($mycon, $sql_all_app_id);
                    if (mysqli_num_rows($result_all_app_id) > 0) {
                      while ($application = mysqli_fetch_assoc($result_all_app_id)) {
                    ?>
                        <option value="<?php echo $application['application_ref_id']; ?>"><?php echo $application['application_ref_id'] ?></option>
                    <?php }
                    } ?>


                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="input_hdr" for="select">Case ID </label>
                <input type="text" id="case_id" name="case_id" class="form-control">
                <!-- <select name="case_id" id="case_id" class="form-control">

                </select> -->
              </div>
              <div class="form-group">
                <label class="input_hdr" for="select">Client Name </label>
                <input type="text" id="client_name" name="client_name" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label input_hdr">Candidate Name
                  <!-- <span class="required" aria-required="true"> * </span> -->
                </label>
                <div>
                  <input type="text" name="candidate_name" id="candidate_name" data-required="1" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label for="type_of_check"> Type of Check &#9734; </label>
                <select name="type_of_check" id="type_of_check" multiple="multiple" class="form-control" style="height: 200px">

                  <option value=""> Select </option>


                </select>
              </div>

              <div class="form-group">
                <label class="control-label">DD Date
                </label>
                <div>
                  <input type="date" id="dd_date" name="dd_date" class="form-control">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label" for="from_address">DD Sent Date</label>
                <input type="date" id="dd_sent_date" name="dd_sent_date" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">DD in the name of payble at
                  <!-- <span class="required" aria-required="true"> * </span> -->
                </label>
                <div>
                  <input type="text" name="name_of_payble_at" id="name_of_payble_at" class="form-control">

                </div>
              </div>

              <div class="form-group">


                <input type="hidden" id="id_finance_master" name="id_finance_master" class="form-control">
                <label class="control-label" for="dd_for_remark"> DD for Remark </label>
                <input type="text" id="dd_for_remark" name="dd_for_remark" class="form-control">
              </div>


            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" onclick="send_data_toserver();">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- modal for add from -->
<?php include 'includes/footer.php'; ?>
</div>
</div>
</div>
</div>

<script>
  function set_all_data_new_edit(application_id) {

    // alert(id_finance_master);
    // document.getElementById('amount').value = amount;
    // document.getElementById('dd_no').value = dd_no;
    document.getElementById('applicationIdDD').value = application_id;
    changed_application_id('applicationIdDD', 'type_of_check');
    // document.getElementById('dd_made_or_not').value = dd_made_or_not;

    // document.getElementById('dd_date').value = dd_date;
    // document.getElementById('dd_sent_date').value = dd_sent_date;
    // document.getElementById('name_of_payble_at').value = dd_in_the_name_of;
    // document.getElementById('dd_for_remark').value = dd_for_remark;
    // document.getElementById('id_finance_master').value = id_finance_master;

  }


  // changed_application_id
  function changed_application_id(application_dd, type_check_dd) {
    change_case_id(application_dd);
    change_client_name(application_dd);
    var xmlhttp = new XMLHttpRequest();
    // alert(document.getElementById("countrydd").value);
    // state back is for geting state and city list present in database for state list we require country_id and for city list we require state_id
    xmlhttp.open("GET", "type_of_check_back_postal.php?application_id=" + document.getElementById(application_dd).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(type_check_dd).innerHTML = xmlhttp.responseText;

    if (document.getElementById(application_dd).value == "") {
      document.getElementById(type_check_dd).innerHTML = "<select><option value=''>Select</option></select>";
      // document.getElementById(city_Search).innerHTML = "<select><option  value=''>Select</option></select>";
    }



  }

  function change_case_id(application_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "case_id_back.php?application_id=" + document.getElementById(application_id).value + "&status=" + 1, false);
    xmlhttp.send(null);
    document.getElementById('case_id').value = xmlhttp.responseText;
  }

  function change_client_name(application_id) {

    $.post("case_id_back.php?application_id=" + document.getElementById(application_id).value + "&status=" + 2, function(data) {
      var res = $.parseJSON(data);
      document.getElementById('client_name').value = "" + res['client_code'] + "-" + res['client_name'];
      document.getElementById('candidate_name').value = res['candidate_name'];


    });

  }


  function send_data_toserver() {
    var amount = document.getElementById('amount').value;
    var dd_no = document.getElementById('dd_no').value;
    var dd_made_or_not = document.getElementById('dd_made_or_not').value;
    var dd_date = document.getElementById('dd_date').value;
    var dd_sent_date = document.getElementById('dd_sent_date').value;
    var dd_in_name_of = document.getElementById('name_of_payble_at').value;
    var dd_for_remark = document.getElementById('dd_for_remark').value;
    var application_id = document.getElementById('applicationIdDD').value;
    var case_id = document.getElementById('case_id').value;
    var client_name = document.getElementById('client_name').value;
    var candidate_name = document.getElementById('candidate_name').value;
    var finance_type_of_check = Array.from(document.getElementById("type_of_check").options).filter(option => option.selected).map(option => option.value);
    var id_finance_master = document.getElementById('id_finance_master').value;
    // var allocated_type_of_check = document.getElementById('type_of_check').value;



    if (amount == "" || amount == "") {
      alert('Enter Amount');
    } else if (dd_no == "" || dd_no == "0") {
      alert('Select dd No');
    } else if (dd_made_or_not == "" || dd_made_or_not == "0") {
      alert('Select DD Made or Not');
    } else if (dd_date == "" || dd_date == "0") {
      alert('Select  DD Date');
    } else if (dd_sent_date == "" || dd_sent_date == "0") {
      alert('Select DD Sent Date');
    } else if (dd_in_name_of == "" || dd_in_name_of == "0") {
      alert('Select  dd_in_name_of');
    } else if (dd_for_remark == "" || dd_for_remark == "0") {
      alert('Select DD for Remark');

    } else {
      urll = "send_finance_master_data_to_server.php?data=" + amount + "~" + dd_no + "~" + dd_made_or_not + "~" + dd_date + "~" + dd_sent_date + "~" + dd_in_name_of + "~" + dd_for_remark + "~" + application_id + "~" + case_id + "~" + client_name + "~" + candidate_name + "~" + finance_type_of_check + "~" + id_finance_master;
      // prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {
            update_application_status(4, application_id);
            alert('Data has been saved Successfully.');
            window.location = "add-application-verification.php?appid=" + application_id;
          } else if (this.responseText == 2 || this.responseText == '2') {
            alert('Sorry Something went Wrong.');

          }
        }
      };
      xhttp.open("GET", urll, true);
      xhttp.send();
    }

  }


  function update_application_status(application_status, application_id) {




    if (application_status == "" || application_status == "0") {
      alert('Invalid Application status');

    } else {
      urll = "send_update_application_status.php?data=" + application_status + "~" + application_id;
      // prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {

            alert('Application status updated');
            // window.location = "form-data-review-check.php?appid=" + application_id;
          } else if (this.responseText == 2 || this.responseText == '2') {
            // alert('Sorry Something went Wrong.');

          }
        }
      };
      xhttp.open("GET", urll, true);
      xhttp.send();
    }

  }
</script>

<!--==================== Start Script Link ======================-->
<script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="../assets/js/datatable.js" type="text/javascript"></script> -->
<!-- <script src="../assets/js/datatable.min.js" type="text/javascript"></script> -->
<script src="../assets/js/table-datatables-buttons.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- <script type="text/javascript" src="files/../bower_components/sweetalert/js/sweetalert.min.js"></script> -->
<!-- <script type="text/javascript" src="files/../assets/js/modal.js"></script> -->
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<script src="../assets/js/pcoded.min.js" type="text/javascript"></script>
<script src="../assets/js/vartical-layout.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="files/../assets/js/classie.js"></script> -->
<script src="../assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="files/../assets/js/modalEffects.js"></script> -->
<script type="text/javascript" src="../assets/js/classie.js"></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<script type="text/javascript" src="../assets/js/custom.js"></script>
<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script>
<script type="text/javascript" src="../assets/js/page/application-check.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>


<script type="text/javascript">
  $(".chosen").chosen();
</script>
<!--================= cdn link datatable start===================-->

</body>

</html>