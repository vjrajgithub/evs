<?php
require_once '../init.php';
include_once 'function.php';
if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
if (isset($_GET['appid'])) {
  //$_SESSION['application_ref_id'] = $_GET['appid'];
}
//print_r($mycon);
//die;
$appInformation = getAllAppInformationCheck($mycon, $_GET['appid']);
// pre($appInformation);


$app_id =$_GET['appid'];
$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];
$user_department = $userdata['department'];
// echo $user_department;

$user_id = $userdata['id'];

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

   $sql = "select allocate_type_of_check from `case_allocate` where application_id = '" . $app_id . "' and user_id= '".$user_id."' limit 1";
   
  //  echo $sql; die;
   $result =  mysqli_query($mycon, $sql);
   if (mysqli_num_rows($result) >  0) {
      $row = mysqli_fetch_assoc($result);
      return $row['allocate_type_of_check'];
   }
}


$type_of_verification = get_type_of_verification($mycon, $app_id);
$type_of_verification_array = explode(',', $type_of_verification);

if(trim(strtolower($user_department)) == trim(strtolower("Research Executive")) || trim(strtolower($user_department)) == trim(strtolower("Research Executive"))){

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

   foreach($tab_no_array as $tab_no){
      if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
      else $status= false;
      
   }

   if($status==false){
      return 'style="display:none"';
   }
}




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
<!-- <style type="text/css">
  .step-app>.step-content {
    border: 1px solid #e5e5e5;
    padding: 10px 10px 80px !important;
    border-top: 0;
    min-height: 680px !important;
    max-height: 2400px !important;
  }

  .step-app>.step-footer {
    margin-top: 23px !important;
    margin-bottom: 1px !important;
    text-align: center;
  }
</style> -->

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



<style>
  img {
    border: 1px solid #ddd;
    /* Gray border */
    border-radius: 4px;
    /* Rounded border */
    padding: 5px;
    /* Some padding */
    width: 150px;
    /* Set a small width */
  }

  /* Add a hover effect (blue shadow) */
  img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
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
                    <li <?php echo is_visble_verification_tab_multi(array('1','5'), $type_of_verification_array); ?> ><a href="#tab3">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?> ><a href="#tab4">Educational Details</a></li>
                    <li <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?> ><a href="#tab18">Identity Details</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?> ><a href="#tab5">Employment Details</a></li>
                    <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?> ><a href="#tab6">Police Verification</a></li>
                    <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?> ><a href="#tab7">Reference Details</a></li>
                    <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?> ><a href="#tab8">Bank Details</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?> ><a href="#tab9">CIBIL Details</a></li>
                    <li <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?> ><a href="#tab10">Court Records Check</a></li>
                    <li <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?> ><a href="#tab11">Drug Details</a></li>
                    <li <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?> ><a href="#tab12">Global Base Check </a></li>
                    <li <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?> ><a href="#tab13">Social Security Number</a></li>
                    <li <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?> ><a href="#tab14">Criminal Background details</a></li>
                    <li <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?> ><a href="#tab15">Global Sanctions Details</a></li>
                    <li <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?> ><a href="#tab16">National Sex Offender Registry Details</a></li>
                    <li <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?> ><a href="#tab17">Company Verification Details</a></li>

                    <!-- <li><a href="#tab10">Court Records Check</a></li>
                    <li><a href="#tab11">Drug Details</a></li> -->
                  </ul>
                  <div class="step-content">
                    <div class="step-tab-panel" id="tab1">
                      <h3 class="employer_one">Application Details</h3>
                      <form method="post" id="app_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="application">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id']; ?>">


                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['verifier_name']; ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['verifier_designation']; ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['verifier_remark']; ?></td>
                              </tr>
                              <tr>
                                <th>Complete Status Check</th>
                                <td> : </td>
                                <td><?php echo $appInformation['complete_status_check']; ?></td>

                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>


                            </table>

                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Is Personal Details Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_personal_details_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>
                              <tr>
                                <th>Is Address Details Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_address_details_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>
                              <tr>
                                <th>Is Education Details Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_education_details_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>
                              <tr>
                                <th>Is Employee Details Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_emp_details_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>
                              <tr>
                                <th>Is Police Verification Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_police_verification_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>
                              <tr>
                                <th>Is Relation Details Checked</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['is_relation_details_checked']) ? ('Yes') : ('No'); ?></span></label></td>

                              </tr>


                            </table>


                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="areview_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is all form component completed
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete" value="8"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete" value="7"> <span>No</span></label>
                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete" checked="" value="1"> <span>NA</span></label>
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" checked="" value=""> <span>NA</span></label>
                            </div>
                          </div>

                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
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
                      <form method="post" id="personal_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="personal">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['personalDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['personalDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['personalDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
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
                          $i = 1;
                          //print_r($appInformation['addressData']);
                          foreach ($appInformation['addressDataCheck'] as $addressData) {
                            $addressType = ($addressData['address_type'] == '1') ? "Present Address" : "Permanent Address";
                          ?>

                            <div class="col-md-6">
                              <div class="present_adress">
                                <label class="input_hdr"><?php echo $addressType; ?></label>
                              </div>
                              <table class="table">
                                <tr>
                                  <th>Verifier Name</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['verifier_name'] ?></td>
                                </tr>
                                <tr>
                                  <th>Verifier Designation</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['verifier_designation'] ?></td>
                                </tr>
                                <tr>
                                  <th>Verifier Remark</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['verifier_remark'] ?></td>
                                </tr>
                                <tr>
                                  <th>Verifier Relationship</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['verifier_relationship'] ?></td>
                                </tr>
                                <tr>
                                  <th>Sign of Respondent</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['sign_of_respondent'] ?></td>
                                </tr>
                                <tr>
                                  <th>Contact of Respondent</th>
                                  <td> : </td>
                                  <td><?php echo $addressData['contact_of_respondent'] ?></td>
                                </tr>
                                <tr>
                                  <th>Is Verified</th>
                                  <td> : </td>
                                  <td><label class="radio  "> <span><?php echo ($addressData['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                                </tr>
                              </table>
                              <input type="hidden" name="id<?php echo $i ?>" value="<?php echo $addressData['id'] ?>">
                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment<?php echo $i ?>" id="review_comment<?php echo $i ?>" placeholder="Type the comment..." class="form-control"></textarea>
                              </div>

                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="0" checked=""> <span>NA</span></label>
                              </div>
                            </div>
                          <?php
                            $i++;
                          }
                          ?>

                        </div>

                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['addressImages'] as $image) {
                          //if ($image['title'] == 'verification doc' && $image['filename'] != '' && $image['related_to'] == 'police') {
                        ?>
                          <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                            <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          //}
                        }
                        ?>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>


                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab4">
                      <h3 class="employer_one">Educational Details</h3>
                      <form name="frmLogin" id="edu_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="education">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id']; ?>">


                        <div>

                          <!-- vertical tab -->
                          <div class="vertical_tabs_views">
                            <div class="tabordion">
                              <section id="section1">
                                <input type="radio" name="sections" id="option1" checked>
                                <label class="labls" for="option1">High School (10th)
                                </label>
                                <article>
                                  <h4 class="employer_one">High School (10th)</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Verifier Name</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][0]['verifier_name'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Designation</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][0]['verifier_designation'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Remark</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][0]['verifier_remark'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Is Employee Name Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][0]['is_emp_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is RollnoCorrect</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][0]['is_rollno_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is University Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][0]['is_university_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Institute Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][0]['is_institute_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Passing Year Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][0]['is_passing_year_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>



                                    </table>
                                  </div>
                                  <input type="hidden" name="id1" id="id1" value="<?php echo $appInformation['eduDataCheck'][0]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment1" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1"> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2"> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" checked=""> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>

                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'highschool' && $image['filename'] != '') {
                                  ?>
                                      <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                  <?php
                                    }
                                  }
                                  ?>

                                </article>
                              </section>
                              <section id="section2">
                                <input type="radio" name="sections" id="option2">
                                <label class="labls" for="option2">Intermediate (12th)
                                </label>
                                <article>
                                  <h4 class="employer_one">Intermediate (12th) </h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Verifier Name</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][1]['verifier_name'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Designation</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][1]['verifier_designation'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Remark</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][1]['verifier_remark'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Is Employee Name Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][1]['is_emp_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is RollnoCorrect</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][1]['is_rollno_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is University Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][1]['is_university_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Institute Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][1]['is_institute_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Passing Year Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][1]['is_passing_year_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>



                                    </table>
                                  </div>
                                  <input type="hidden" name="id2" id="id2" value="<?php echo $appInformation['eduDataCheck'][1]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment2" id="review_comment2" placeholder="Type the comment..." class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1"> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2"> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" checked=""> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>

                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'intermediate' && $image['filename'] != '') {
                                  ?>
                                      <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                  <?php
                                    }
                                  }
                                  ?>
                                </article>
                              </section>
                              <section id="section3">
                                <input type="radio" name="sections" id="option3">
                                <label class="labls" for="option3">Degree Graduation
                                </label>
                                <article>
                                  <h4 class="employer_one">Graduation Degree </h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Verifier Name</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][2]['verifier_name'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Designation</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][2]['verifier_designation'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Remark</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][2]['verifier_remark'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Is Employee Name Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][2]['is_emp_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is RollnoCorrect</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][2]['is_rollno_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is University Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][2]['is_university_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Institute Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][2]['is_institute_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Passing Year Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][2]['is_passing_year_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>



                                    </table>
                                  </div>
                                  <input type="hidden" name="id3" id="id3" value="<?php echo $appInformation['eduDataCheck'][2]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment3" id="review_comment3" placeholder="Type the comment..." class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1"> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2"> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" checked=""> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'graduation' && $image['filename'] != '') {
                                  ?>
                                      <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                  <?php
                                    }
                                  }
                                  ?>
                                </article>
                              </section>
                              <section id="section4">
                                <input type="radio" name="sections" id="option4">
                                <label class="labls" for="option4">Post Graduation</label>
                                <article>
                                  <h4 class="employer_one">Post Graduation</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Verifier Name</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][3]['verifier_name'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Designation</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][3]['verifier_designation'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Remark</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][3]['verifier_remark'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Is Employee Name Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][3]['is_emp_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is RollnoCorrect</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][3]['is_rollno_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is University Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][3]['is_university_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Institute Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][3]['is_institute_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Passing Year Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][3]['is_passing_year_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>



                                    </table>
                                  </div>
                                  <input type="hidden" name="id4" id="id4" value="<?php echo $appInformation['eduDataCheck'][3]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment4" id="review_comment4" placeholder="Type the comment..." class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="1"> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="2"> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="0" checked=""> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'post graduation' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                  ?>
                                      <a download="" target="_blank" href="<?php echo $image['imageUrl'] ?>">
                                        <img src="<?php echo $image['imageUrl'] ?>" alt="Forest">
                                      </a>
                                  <?php
                                    }
                                  }
                                  ?>
                                </article>
                              </section>
                              <section id="section5">
                                <input type="radio" name="sections" id="option5">
                                <label class="labls" for="option5">If Any Other Qualification</label>
                                <article>
                                  <h4 class="employer_one">If Any Other Qualification</h4>
                                  <div class="col-md-12">
                                    <table class="table">
                                      <tr>
                                        <th>Verifier Name</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][4]['verifier_name'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Designation</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][4]['verifier_designation'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Verifier Remark</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduDataCheck'][4]['verifier_remark'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Is Employee Name Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][4]['is_emp_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is RollnoCorrect</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][4]['is_rollno_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is University Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][4]['is_university_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Institute Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][4]['is_institute_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>
                                      <tr>
                                        <th>Is Passing Year Correct</th>
                                        <td> : </td>
                                        <td><label class="radio  "> <span><?php echo ($appInformation['eduDataCheck'][4]['is_passing_year_correct']) ? ('Yes') : ('No'); ?></span></label></td>

                                      </tr>



                                    </table>
                                  </div>
                                  <input type="hidden" name="id5" id="id5" value="<?php echo $appInformation['eduDataCheck'][4]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment5" id="review_comment5" placeholder="Type the comment..." class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="1"> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="2"> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="0" checked=""> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'diploma' && $image['filename'] != '') {
                                  ?>
                                      <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                  <?php
                                    }
                                  }
                                  ?>
                                </article>

                              </section>

                            </div>


                          </div>
                          <!-- vertical tab -->

                        </div>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab5">
                      <h3 class="employer_one">Employer Details-1</h3>
                      <!--  form employment end -->
                      <form method="post" id="emp_form" enctype="multipart/form-data">

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Eligible for Rehire </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][0]['eligible_for_rehire'] ?></td>
                              </tr>
                              <tr>
                                <th>How Was The Candidate <br>Behavior During Tenure </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][0]['how_was_the_candidate_behavior_during_tenure'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['empDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>

                        </div>

                        <input type="hidden" name="form_type" value="employer">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="form_type" value="employer">
                        <div class="customer_records" style="width: 100%">
                          <input type="hidden" name="id1" value="<?php echo $appInformation['empDataCheck'][0]['id'] ?>">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment1" id="review_comment1" placeholder="Type the comment..." class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1"> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2"> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" checked=""> <span>NA</span></label>
                              </div>
                            </div>
                          </div>


                          <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer0' && $image['filename'] != '') {
                          ?>
                              <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                          <?php
                            }
                          }
                          ?>
                        </div>
                        <br /><br />
                        <h3 class="employer_one">Employer Details-2</h3>
                        <!--  form employment end -->

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][1]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Eligible for Rehire </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][1]['eligible_for_rehire'] ?></td>
                              </tr>
                              <tr>
                                <th>How Was The Candidate <br>Behavior During Tenure </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][1]['how_was_the_candidate_behavior_during_tenure'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][1]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][1]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][1]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['empDataCheck'][1]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>

                        </div>
                        <input type="hidden" name="id2" value="<?php echo $appInformation['empDataCheck'][1]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment2" id="review_comment2" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <div class="customer_records" style="width: 100%">

                          <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer1' && $image['filename'] != '') {
                          ?>
                              <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                          <?php
                            }
                          }
                          ?>
                        </div>
                        <br /><br />
                        <h3 class="employer_one">Employer Details-3</h3>
                        <!--  form employment end -->

                        <input type="hidden" name="employer_id[]" value="<?php echo $appInformation['empData'][2]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Eligible for Rehire </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][2]['eligible_for_rehire'] ?></td>
                              </tr>
                              <tr>
                                <th>How Was The Candidate <br>Behavior During Tenure </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][2]['how_was_the_candidate_behavior_during_tenure'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][2]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][2]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empDataCheck'][2]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['empDataCheck'][2]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>

                        </div>

                        <input type="hidden" name="id3" value="<?php echo $appInformation['empDataCheck'][2]['id'] ?>">

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment3" id="review_comment3" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <div class="customer_records" style="width: 100%">

                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer2' && $image['filename'] != '') {
                          ?>
                              <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                          <?php
                            }
                          }
                          ?>
                        </div>
                        <div class="customer_records_dynamic"></div>
                        <br /><br />
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--  form employment end -->
                    <div class="step-tab-panel" id="tab6">
                      <h3 class="employer_one">Police Verification Details</h3>
                      <form name="frmMobile" id="police_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="verification">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['vrificationData']['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['vrificationDataCheck']['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Police Authority </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationDataCheck']['police_authority'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationDataCheck']['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationDataCheck']['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>verifier Remark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationDataCheck']['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['vrificationDataCheck']['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>


                            </table>

                          </div>


                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <?php
                        foreach ($appInformation['policeImages'] as $image) {
                          if ($image['title'] == 'verification doc' && $image['filename'] != '') {
                        ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          }
                        }
                        ?>


                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>


                    </div>

                    <!--******** refrence details  start **********-->

                    <div class="step-tab-panel" id="tab7">
                      <h3 class="employer_one">Reference Details</h3>
                      <form name="ref_form" id="ref_form">

                        <input type="hidden" name="form_type" value="reference">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
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
                                          <th>About Candidate During Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['about_candidate_during_period'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>About Association Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['about_association_period'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Self Improvement</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['self_improvement'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>General Reputation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['general_reputation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['verifier_name'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Designation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['verifier_designation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Remark</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][0]['verifier_remark'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Ratings</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo $appInformation['referenceDataCheck'][0]['ratings']; ?></span></label></td>
                                        </tr>
                                        <tr>
                                          <th>Is Verify</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo ($appInformation['referenceDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <input type="hidden" name="id1" value="<?php echo $appInformation['referenceDataCheck'][0]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment1" id="review_comment1" placeholder="Type the comment..." class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" checked=""> <span>NA</span></label>
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
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceDataCheck'][1]['id'] ?>">
                                      <tbody>
                                        <tr>
                                          <th>About Candidate During Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['about_candidate_during_period'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>About Association Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['about_association_period'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Self Improvement</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['self_improvement'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>General Reputation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['general_reputation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['verifier_name'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Designation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['verifier_designation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Remark</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][1]['verifier_remark'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Ratings</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo $appInformation['referenceDataCheck'][1]['ratings']; ?></span></label></td>
                                        </tr>
                                        <tr>
                                          <th>Is Verify</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo ($appInformation['referenceDataCheck'][1]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <input type="hidden" name="id2" value="<?php echo $appInformation['referenceDataCheck'][1]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment2" id="review_comment2" placeholder="Type the comment..." class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" checked=""> <span>NA</span></label>
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
                                      <input type="hidden" name="id[]" value="<?php echo $appInformation['referenceDataCheck'][2]['id'] ?>">
                                      <tbody>
                                        <tr>
                                          <th>About Candidate During Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['about_candidate_during_period'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>About Association Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['about_association_period'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Self Improvement</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['self_improvement'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>General Reputation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['general_reputation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['verifier_name'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Designation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['verifier_designation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Remark</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][2]['verifier_remark'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Ratings</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo $appInformation['referenceDataCheck'][2]['ratings']; ?></span></label></td>
                                        </tr>
                                        <tr>
                                          <th>Is Verify</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo ($appInformation['referenceDataCheck'][2]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <input type="hidden" name="id3" value="<?php echo $appInformation['referenceDataCheck'][2]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment3" id="review_comment3" placeholder="Type the comment..." class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" checked=""> <span>NA</span></label>
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
                                          <th>About Candidate During Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['about_candidate_during_period'] ?> </td>
                                        </tr>
                                        <tr>
                                          <th>About Association Period</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['about_association_period'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Self Improvement</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['self_improvement'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>General Reputation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['general_reputation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Name</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['verifier_name'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Designation</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['verifier_designation'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Verifier Remark</th>
                                          <td> : </td>
                                          <td><?php echo $appInformation['referenceDataCheck'][3]['verifier_remark'] ?></td>
                                        </tr>
                                        <tr>
                                          <th>Ratings</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo $appInformation['referenceDataCheck'][3]['ratings']; ?></span></label></td>
                                        </tr>
                                        <tr>
                                          <th>Is Verify</th>
                                          <td> : </td>
                                          <td><label class="radio  "> <span><?php echo ($appInformation['referenceDataCheck'][3]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                                        </tr>


                                      </tbody>
                                    </table>
                                  </div>

                                </div>
                                <input type="hidden" name="id4" value="<?php echo $appInformation['referenceDataCheck'][3]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment4" id="review_comment4" placeholder="Type the comment..." class="form-control"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="1"> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="2"> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="0" checked=""> <span>NA</span></label>
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
                            <!-- MultiplyImagesuploading end-->
                          </div>
                        </div>

                        <!-- vertical tab -->

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>


                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
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

                    <div class="step-tab-panel" id="tab8">
                      <h3 class="employer_one">Bank Details</h3>
                      <form name="bank_form" id="bank_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="bank">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['bankData'][0]['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['bankDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>verifier Remark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['bankDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                              <tr>
                                <th>Is Bank Name Correct</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_bank_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                              <tr>
                                <th>is_bank_branch_correct</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_bank_branch_correct']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                              <tr>
                                <th>is_bank_account_correct</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_bank_account_correct']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                              <tr>
                                <th>is_bank_holder_name_correct</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_bank_holder_name_correct']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>


                            </table>
                          </div>


                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" checked=""> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <?php
                        foreach ($appInformation['bankImages'] as $image) {
                          if ($image['title'] == 'Bank Statement' && $image['filename'] != '') {
                        ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          }
                        }
                        ?>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>


                    </div>

                    <div class="step-tab-panel" id="tab9">
                      <h3 class="employer_one">CIBIL Details</h3>
                      <form name="cibil_form" id="cibil_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="cibil">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['cibilData'][0]['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['cibilDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Reference Number </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['reference_number'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Member Id </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['member_id'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Score Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['score_name'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Scoring Factor </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['scoring_factor'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Score</th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['score'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>CIBIL Remark </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['cibil_remark'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Dispute Remark </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['dispute_remark'] ?></td>
                              </tr>
                              <tr>




                            </table>
                          </div>

                          <div class="col-md-6">
                            <table class="table">


                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>

                                <th>Verifier Designation</th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>verifier Remark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['cibilDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['bankDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>



                            </table>

                          </div>

                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <?php
                        foreach ($appInformation['cibilImages'] as $image) {
                          if ($image['filename'] != '') {
                        ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          }
                        }
                        ?>

                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>


                    </div>

                      <!-- Identity Details -->
                    <div class="step-tab-panel" id="tab18">
                      <h3 class="employer_one">Identity Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="identity_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="identity">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['identityDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['identityDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['identityDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['identityDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['identityDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!--  Court verification Details -->

                      <div class="step-tab-panel" id="tab10">
                      <h3 class="employer_one">Court Records Check</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="court_verif_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="court_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['courtDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['courtDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Court verification Details -->

            <!--  Drug Details -->

            <div class="step-tab-panel" id="tab11">
                      <h3 class="employer_one">Drug Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="drug_verif_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="drug_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['drugDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['drugDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Drug Details -->




                    <div class="step-tab-panel" id="tab010">
                      <h3 class="employer_one">Court Records Check</h3>
                      <form name="court_form" id="court_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="court_verif">
                        <input type="hidden" name="id" value="<?php echo $appInformation['courtDataCheck'][0]['id'] ?>">

                        <input type="hidden" name="application_id" value="<?php echo $appInformation['courtDataCheck'][0]['application_id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Found Record All India <br> Court for Civil </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_all_india_court_for_civil'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Found Record in All High <br> Court of India for Civil </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_in_all_high_courts_of_india_for_civil'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Found Record in Supreme <br> Court of India for Civil </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_in_supreme_court_of_india_for_civil'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Found Record in All Session <br> Courts for Criminal </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_in_all_session_courts_for_criminal'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Found Record All High <br> Courts of India for Criminal</th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_all_high_courts_of_india_for_criminal'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Found Record in Supreme <br> Court of India for Criminal </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['found_record_in_supreme_court_of_india_for_criminal'] ?></td>
                              </tr>
                              <tr>

                              <tr>




                            </table>
                          </div>

                          <div class="col-md-6">
                            <table class="table">


                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>

                                <th>Verifier Designation</th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>verifier Remark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['courtDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['courtDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>



                            </table>

                          </div>

                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>


                        <?php
                        foreach ($appInformation['courtImages'] as $image) {
                          if ($image['filename'] != '') {
                        ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          }
                        }
                        ?>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
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
                      <form name="drug_form" id="drug_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="drug">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['drugDataCheck'][0]['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['drugDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">

                              <tr>
                                <th>Panel </th>
                                <td>:</td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['panel'] ?></td>
                              </tr>
                              <tr>
                              <tr>
                                <th>Sample Collected </th>
                                <td>:</td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['sample_collected'] ?></td>
                              </tr>





                            </table>
                          </div>

                          <div class="col-md-6">
                            <table class="table">


                              <tr>
                                <th>Verifier Name </th>
                                <td>:</td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>

                                <th>Verifier Designation</th>
                                <td>:</td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>verifier Remark</th>
                                <td>:</td>
                                <td><?php echo $appInformation['drugDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['drugDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>



                            </table>

                          </div>

                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <?php
                        foreach ($appInformation['drugImages'] as $image) {
                          if ($image['filename'] != '') {
                        ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                        <?php
                          }
                        }
                        ?>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                         <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>


                    </div>

                      <!-- Global Base Check Details -->
                      <div class="step-tab-panel" id="tab12">
                      <h3 class="employer_one">Global Base Check</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="gcb_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="gcb">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['globalBaseDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['globalBaseDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['globalBaseDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['globalBaseDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['globalBaseDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Global Base Check Details -->


                      <!-- Social Security Number Details -->
                      <div class="step-tab-panel" id="tab13">
                      <h3 class="employer_one">Social Security Number</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="ssn_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="ssn">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['ssnDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['ssnDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['ssnDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['ssnDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['ssnDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Social Security Number Details -->


                      <!-- Criminal Background details Details -->
                      <div class="step-tab-panel" id="tab14">
                      <h3 class="employer_one">Criminal Background details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="criminal_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="criminal">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['criminalDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['criminalDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['criminalDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['criminalDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['criminalDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Criminal Background details Details -->

            <!-- Global Sanctions Details Details -->
              <div class="step-tab-panel" id="tab15">
                      <h3 class="employer_one">Global Sanctions Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="gs_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="gs">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['gsDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['gsDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['gsDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['gsDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['gsDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Global Sanctions Details Details -->


            <!-- National Sex Offender Registry Details Details -->
              <div class="step-tab-panel" id="tab16">
                      <h3 class="employer_one">National Sex Offender Registry Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="nsr_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="nsr">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['nsrDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['nsrDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['nsrDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['nsrDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['nsrDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END National Sex Offender Registry Details Details -->


            <!-- Company Varification Details Details -->
            <div class="step-tab-panel" id="tab17">
                      <h3 class="employer_one">Company Verification Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="comp_verif_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="comp_verif">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $appInformation['compVerifDataCheck'][0]['id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Verifier Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifDataCheck'][0]['verifier_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Designation</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifDataCheck'][0]['verifier_designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Verifier Remark</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifDataCheck'][0]['verifier_remark'] ?></td>
                              </tr>
                              <tr>
                                <th>Is Verified</th>
                                <td> : </td>
                                <td><label class="radio  "> <span><?php echo ($appInformation['compVerifDataCheck'][0]['is_verify']) ? ('Yes') : ('No'); ?></span></label></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment" id="review_comment" placeholder="Type the comment..." class="form-control" >
                              <?php // echo $appInformation['identityDataCheck'][0]['review_comment'];  ?>
                              </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1"> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2"> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" checked=""> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br /><br />
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row" style="display: none">
                          <div>
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="set_all_data_new_edit('<?php echo $_GET['appid'] ?>');">
                                Request for DD/Payment <i class="fa fa-plus-circle" aria-hidden="true"></i>
                              </button>
                            </a>
                          </div>
                        </div>

                      </form>
                    </div>

            <!-- END Company Varification Details Details -->


                  </div>

                  <div class="step-footer">
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

<script type="text/javascript" src="../assets/js/page/review-form-check.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script type="text/javascript">
  $(".chosen").chosen();


  function showImage(imgurl) {
    //alert(imgurl);
    Swal.fire({
      //title: 'Sweet!',
      //text: 'Modal with a custom image.',
      imageUrl: imgurl,
      imageWidth: 600,
      imageHeight: 500,
      imageAlt: 'Custom image',
      animation: true,
      showConfirmButton: false,
      showCloseButton: true,
    })
  }
</script>

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
            update_application_status(4,application_id);
            alert('Data has been saved Successfully.');
            window.location = "form-data-review-check.php?appid=" + application_id;
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
<script type="text/javascript">
  $(".chosen").chosen();
</script>
<!--================= cdn link datatable start===================-->

</body>

</html>