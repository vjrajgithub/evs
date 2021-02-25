<?php

require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
if (isset($_GET['appid'])) {
  $_SESSION['application_ref_id'] = $_GET['appid'];
}

$appInformation = getAllAppInformation($mycon, $_GET['appid']);


$type_of_verification_array = explode(',', $appInformation['type_of_check']);

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


$userdata = getUserDataByUserId( $_SESSION['id']);
$userRole = $userdata['role'];
//
////Fetch data from role wised
////echo $ff = $userdata['id']; die;
//

if ($userdata['role'] == '2' || $userdata['role'] == '3') {
 $user_location = $userdata['org_id'];
 $user_client = $userdata['client_id'];
 $role_item = " AND organization_id = '" . $user_location . "'";
 $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
} else {
 $role_item = '';
 $loc_item = '';
}




//pre($appInformation);
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
  .step-app > .step-content {
    border: 1px solid #e5e5e5;
    padding: 10px 10px 80px !important;
    border-top: 0;
    min-height: 680px !important;
    max-height: 2400px !important;
  }
  .step-app > .step-footer {
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


<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">

          <div class="card">

            <div class="card-block application_dtls">

              <!-- <button style="float:right" class="btn btn-success" onclick="window.history.back()">Back</button> -->

              <!--******** Wizard_new Start HTML ***********-->
              <div id="demo">

                <div class="step-app">
                  <ul class="step-steps">
                    <li  ><a href="#tab1">Application Details</a></li>
                    <li  ><a href="#tab2">Personal Details</a></li>
                    <li <?php echo is_visble_verification_tab_multi(array('1','5'), $type_of_verification_array); ?> ><a href="#tab3">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?> ><a href="#tab4">Educational Details</a></li>
                    <li <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?> ><a href="#tab18">Identity Details</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?> ><a href="#tab5">Employment Details</a></li>
                    <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?> ><a href="#tab6">Police Verification </a></li>
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

                  </ul>
                  <div class="step-content">
                    <div class="step-tab-panel" id="tab1">
                      <h3 class="employer_one">Application Details</h3>
                      <form method="post" id="app_form" enctype="multipart/form-data">
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
                                <?php echo getTypeOfCheckName($mycon, explode(',', $appInformation['type_of_check'])) ?>

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
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label class="input_hdr" for="">Review Remark:* </label>
                              <textarea name="review_comment"  id="areview_comment" placeholder="Type the comment..." class="form-control" <?php echo ($appInformation['addressData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['addressData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">NOTE:
                                <span aria-required="true" class="required"> * </span></label>
                              Please select "Is all form component completed" column value after completion other tab review.
                            </div>

                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is all form <br>component completed
                                <span aria-required="true" class="required"> * </span></label>

                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete" value="3" <?php echo ($appInformation['application_status'] == '3') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete" value="2"  <?php echo ($appInformation['application_status'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input required="" type="radio" name="is_all_complete"  value="1" <?php echo ($appInformation['application_status'] == '1') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>

                            <div class="form-group eligibility_ind">
                              <label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span>
                              </label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" value="1" <?php echo ($appInformation['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" value="2" <?php echo ($appInformation['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_form_complete" value="0" <?php echo ($appInformation['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                            </div>
                          </div>

                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab2">
                      <h3 class="employer_one">Personal Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="personal_form" enctype="multipart/form-data">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['personalData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['personalData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['personalData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['personalData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['personalData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
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
                          foreach ($appInformation['addressData'] as $addressData) {
                            $addressType = ($addressData['address_type'] == '1') ? "Present Address" : "Permanent Address";
                            //echo $i;
                            ?>
                            <input type="hidden" name="id<?php echo $i ?>" value="<?php echo $addressData['id'] ?>">

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

                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment<?php echo $i ?>"  id="review_comment<?php echo $i ?>" placeholder="Type the comment..." class="form-control"<?php echo ($addressData['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $addressData['review_comment']; ?></textarea>
                              </div>

                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="1" <?php echo ($addressData['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="2" <?php echo ($addressData['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed<?php echo $i ?>" value="0" <?php echo ($addressData['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
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
                          if ($image['filename'] != '' && ($image['related_to'] == 'home_address' || $image['related_to'] == 'present_address')) {
                            ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                            <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>


                            <?php
                          }
                        }
                        ?>



                        <!----------------------------------------------------------------------------------->


                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="address_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button onclick="addressCheckSubmit()" type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab4">
                      <h3 class="employer_one">Educational Details</h3>
                      <form name="frmLogin" id="edu_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="education">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id']; ?>">


                        <div>
                          <div class="alert alert-success alert-dismissable" id="edu_success_message" style="display :none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <div ></div>
                          </div>

                        <!--<p id="success_message"></p>-->
                          <div class="row">
                            <div class="col text-center">
                              <button  type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </div>
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
                                        <th>School / College Name (with location)</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][0]['college_institute'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][0]['roll_no'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][0]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][0]['university_board'] ?></td>
                                      </tr>


                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'highschool' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <!--                                      <a download="" target="_blank" href="<?php echo $image['imageUrl'] ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <img src="<?php echo $image['imageUrl'] ?>" alt="Forest">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </a>-->

                                      <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                      <?php
                                    }
                                  }
                                  ?>

                                  <input type="hidden" name="id1" id="id1" value="<?php echo $appInformation['eduData'][0]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment1"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['eduData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData']['0']['review_comment']; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1" <?php echo ($appInformation['eduData']['0']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2" <?php echo ($appInformation['eduData']['0']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" <?php echo ($appInformation['eduData']['0']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>

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
                                        <th>School / College Name (with location)</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][1]['college_institute'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][1]['roll_no'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][1]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][1]['university_board'] ?></td>
                                      </tr>


                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'intermediate' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      ?>
                                      <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                      <?php
                                    }
                                  }
                                  ?>
                                  <input type="hidden" name="id2" id="id2" value="<?php echo $appInformation['eduData'][1]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment2"  id="review_comment2" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['eduData']['1']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData']['1']['review_comment']; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1" <?php echo ($appInformation['eduData']['1']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2" <?php echo ($appInformation['eduData']['1']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" <?php echo ($appInformation['eduData']['1']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
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
                                        <th>School / College Name (with location)</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][2]['college_institute'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][2]['roll_no'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][2]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][2]['university_board'] ?></td>
                                      </tr>


                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'graduation' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      ?>
                                      <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                      <?php
                                    }
                                  }
                                  ?>
                                  <input type="hidden" name="id3" id="id3" value="<?php echo $appInformation['eduData'][2]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment3"  id="review_comment3" placeholder="Type the comment..." class="form-control" <?php echo ($appInformation['eduData']['2']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData']['2']['review_comment']; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1" <?php echo ($appInformation['eduData']['2']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2" <?php echo ($appInformation['eduData']['2']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" <?php echo ($appInformation['eduData']['2']['is_completed'] == '0') ? "checked" : "" ?>> <span>Na</span></label>
                                      </div>
                                    </div>
                                  </div>
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
                                        <th>School / College Name (with location)</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][3]['college_institute'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][3]['roll_no'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][3]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][3]['university_board'] ?></td>
                                      </tr>


                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'post graduation' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      ?>
                                      <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                      <?php
                                    }
                                  }
                                  ?>
                                  <input type="hidden" name="id4" id="id4" value="<?php echo $appInformation['eduData'][3]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment4"  id="review_comment4" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['eduData']['3']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData']['3']['review_comment']; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="1" <?php echo ($appInformation['eduData']['3']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="2" <?php echo ($appInformation['eduData']['3']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="0" <?php echo ($appInformation['eduData']['3']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
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
                                        <th>Degree/ Diploma/ Professional Courses</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData']['4']['course'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>School / College Name (with location)</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][4]['college_institute'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Roll number / Reg. Number</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][4]['roll_no'] ?> </td>
                                      </tr>
                                      <tr>
                                        <th>Year Of passing</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][4]['passing_year'] ?></td>
                                      </tr>
                                      <tr>
                                        <th>Board / University</th>
                                        <td> : </td>
                                        <td><?php echo $appInformation['eduData'][4]['university_board'] ?></td>
                                      </tr>


                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'diploma' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      ?>
                                      <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                        <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                      <?php
                                    }
                                  }
                                  ?>
                                  <input type="hidden" name="id5" id="id5" value="<?php echo $appInformation['eduData'][4]['id'] ?>" data-required="1" class="form-control">

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="input_hdr" for="">Review Comment </label>
                                        <textarea name="review_comment5"  id="review_comment5" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['eduData']['4']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData']['4']['review_comment']; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                          <span aria-required="true" class="required"> * </span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="1" <?php echo ($appInformation['eduData']['4']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="2" <?php echo ($appInformation['eduData']['4']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                        <label class="radio  input_hdr"><input type="radio" name="is_completed5" value="0" <?php echo ($appInformation['eduData']['4']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                      </div>
                                    </div>
                                  </div>
                                </article>

                              </section>

                            </div>


                          </div>

                          <!-- vertical tab -->

                        </div>



                      </form>
                    </div>
                    <div class="step-tab-panel" id="tab5">
                      <h3 class="employer_one">Employer Details-1</h3>
                      <!--  form employment end -->
                      <form method="post" id="emp_form" enctype="multipart/form-data">

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
                              <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][0]['employer_name'] ?></td>
                              </tr>
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
                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['empImages'] as $image) {
                          if ($image['title'] == 'employer0' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                            ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                          }
                        }
                        ?>

                        <input type="hidden" name="form_type" value="employer">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">

                        <div class="customer_records" style="width: 100%">
                          <input type="hidden" name="id1" value="<?php echo $appInformation['empData'][0]['id'] ?>">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment1"  id="review_comment1" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['empData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData']['0']['review_comment']; ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1" <?php echo ($appInformation['empData']['0']['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2" <?php echo ($appInformation['empData']['0']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" <?php echo ($appInformation['empData']['0']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <br/><br/>
                        <h3 class="employer_one">Employer Details-2</h3>
                        <!--  form employment end -->

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
                              <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['employer_name'] ?></td>
                              </tr>
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
                                <td><?php echo $appInformation['empData'][1]['reporting_mngr_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Reporting Manager Email </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['reporting_mngr_email'] ?></td>
                              </tr>
                              <tr>
                                <th>Position</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['designation'] ?></td>
                              </tr>
                              <tr>
                                <th>Department</th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][1]['department'] ?></td>
                              </tr>
                              <tr>
                                <th>Reason for Leaving </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['reason_for_leaving'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['empImages'] as $image) {
                          if ($image['title'] == 'employer1' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                            ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                          }
                        }
                        ?>

                        <div class="customer_records" style="width: 100%">
                          <input type="hidden" name="id2" value="<?php echo $appInformation['empData'][1]['id'] ?>">

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment2"  id="review_comment2" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['empData']['1']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData']['1']['review_comment']; ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1" <?php echo ($appInformation['empData']['1']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2" <?php echo ($appInformation['empData']['1']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" <?php echo ($appInformation['empData']['1']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <br/><br/>
                        <h3 class="employer_one">Employer Details-3</h3>
                        <!--  form employment end -->

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
                              <tr>
                                <th>Email Id </th>
                                <td>:</td>
                                <td><?php echo $appInformation['empData'][2]['employer_name'] ?></td>
                              </tr>
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

                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['empImages'] as $image) {
                          if ($image['title'] == 'employer2' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                            ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                          }
                        }
                        ?>

                        <div class="customer_records" style="width: 100%">
                          <input type="hidden" name="id3" value="<?php echo $appInformation['empData'][2]['id'] ?>">

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="input_hdr" for="">Review Comment </label>
                                <textarea name="review_comment3"  id="review_comment3" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['empData']['2']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData']['2']['review_comment']; ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                  <span aria-required="true" class="required"> * </span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1" <?php echo ($appInformation['empData']['2']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2" <?php echo ($appInformation['empData']['2']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" <?php echo ($appInformation['empData']['2']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="customer_records_dynamic"></div>
                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="emp_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!--  form employment end -->
                    <div class="step-tab-panel" id="tab6">
                      <h3 class="employer_one">Police Verification Details</h3>
                      <form name="police_form" id="police_form" method="post" enctype="multipart/form-data">
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
                                <th>Address  </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['address'] ?></td>
                              </tr>
                              <tr style="display: none;">
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
                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['policeImages'] as $image) {
                          if ($image['title'] == 'verification doc' && $image['filename'] != '' && $image['related_to'] == 'police') {
                            ?>
                            <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                              <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                            <?php
                          }
                        }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control" <?php echo ($appInformation['vrificationData']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['vrificationData']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['vrificationData']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['vrificationData']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['vrificationData']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                            </div>
                          </div>
                        </div>
                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="verification_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>


                    </div>

                    <!--******** refrence details  start **********-->

                    <div class="step-tab-panel" id="tab7">
                      <h3 class="employer_one">Reference Details</h3>
                      <form name="ref_form" id="ref_form">

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


                                      </tbody></table>
                                  </div>

                                </div>
                                <input type="hidden" name="id1" value="<?php echo $appInformation['referenceData'][0]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment1"  id="review_comment1" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['referenceData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData']['0']['review_comment']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="1" <?php echo ($appInformation['referenceData']['0']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="2" <?php echo ($appInformation['referenceData']['0']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed1" value="0" <?php echo ($appInformation['referenceData']['0']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
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


                                      </tbody></table>
                                  </div>

                                </div>
                                <input type="hidden" name="id2" value="<?php echo $appInformation['referenceData'][1]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment2"  id="review_comment2" placeholder="Type the comment..." class="form-control" <?php echo ($appInformation['referenceData']['1']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData']['1']['review_comment']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="1" <?php echo ($appInformation['referenceData']['1']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="2" <?php echo ($appInformation['referenceData']['1']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed2" value="0" <?php echo ($appInformation['referenceData']['1']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
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


                                      </tbody></table>
                                  </div>

                                </div>
                                <input type="hidden" name="id3" value="<?php echo $appInformation['referenceData'][2]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment3"  id="review_comment3" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['referenceData']['2']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData']['2']['review_comment']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="1" <?php echo ($appInformation['referenceData']['2']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="2" <?php echo ($appInformation['referenceData']['2']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed3" value="0" <?php echo ($appInformation['referenceData']['2']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                    </div>
                                  </div>
                                </div>
                              </article>
                            </section>
                            <section id="section911">
                              <input type="radio" name="sections" id="option911">
                              <label class="labls" for="option911">  Personal Reference-2</label>
                              <article>
                                <h4 class="employer_one"> Personal Reference-2</h4>
                                <div class="row">

                                  <div class="col-md-12">
                                    <table class="table">
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


                                      </tbody></table>
                                  </div>

                                </div>
                                <input type="hidden" name="id4" value="<?php echo $appInformation['referenceData'][3]['id'] ?>">

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Comment </label>
                                      <textarea name="review_comment4"  id="review_comment4" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['referenceData']['3']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData']['3']['review_comment']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                        <span aria-required="true" class="required"> * </span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="1" <?php echo ($appInformation['referenceData']['3']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="2" <?php echo ($appInformation['referenceData']['3']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                      <label class="radio  input_hdr"><input type="radio" name="is_completed4" value="0" <?php echo ($appInformation['referenceData']['3']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
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
                          <div ></div>
                        </div>

                        <!--<p id="success_message"></p>-->
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--******** refrence details  end **********-->

                    <div class="step-tab-panel" id="tab8">
                      <h3 class="employer_one">Bank Details</h3>
                      <form name="bank_form" id="bank_form">

                        <input type="hidden" name="form_type" value="bank">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Bank Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['bankData'][0]['bank_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Account Holder Name</th>
                                <td> : </td>
                                <td><?php echo $appInformation['bankData'][0]['bank_holder_name'] ?></td>
                              </tr>
                              <tr>
                                <th>Account Number</th>
                                <td> : </td>
                                <td><?php echo $appInformation['bankData'][0]['account_no'] ?></td>
                              </tr>
                              <tr>
                                <th>Bank Branch</th>
                                <td> : </td>
                                <td><?php echo $appInformation['bankData'][0]['bank_branch'] ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">

                            <label for="form_control_1" style="color: #404040;font-weight: bold;">Bank Statement: </label>
                            <?php
                            foreach ($appInformation['bankImages'] as $image) {
                              if ($image['title'] == 'bank' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                ?>
                                <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                  <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                <?php
                              }
                            }
                            ?>
                            <input type="hidden" name="id" value="<?php echo $appInformation['bankData'][0]['id'] ?>">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="input_hdr" for="">Review Comment </label>
                                  <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['bankData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['bankData']['0']['review_comment']; ?></textarea>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                    <span aria-required="true" class="required"> * </span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['bankData']['0']['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['bankData']['0']['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['bankData']['0']['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!--******** bank details  end **********-->

                    <!--******** CIBIL  start **********-->

                    <div class="step-tab-panel" id="tab9">
                      <h3 class="employer_one">CIBIL Details</h3>
                      <form name="cibil_form" id="cibil_form">

                        <input type="hidden" name="form_type" value="cibil">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
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
                              if ($image['filename'] != '' && $image['related_to'] == 'cibil') {
                                ?>
                                <p> <a href="#" onclick="showImage('<?php echo $image['imageUrl'] ?>')">Preview</a> |
                                  <a href="<?php echo $image['imageUrl'] ?>" download>Download</a></p>
                                <?php
                              }
                            }
                            ?>
                            <input type="hidden" name="id" value="<?php echo $appInformation['cibilData'][0]['id'] ?>">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="input_hdr" for="">Review Comment </label>
                                  <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['cibilData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['cibilData']['0']['review_comment']; ?></textarea>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                    <span aria-required="true" class="required"> * </span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['cibilData']['0']['is_completed'] == '1') ? "checked" : "" ?>> <span>Yes</span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['cibilData']['0']['is_completed'] == '2') ? "checked" : "" ?>> <span>No</span></label>
                                  <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['cibilData']['0']['is_completed'] == '0') ? "checked" : "" ?>> <span>NA</span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button  type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--******** CIBIL  end **********-->
                    <!--******** Court Records Check   **********-->
                    <div class="step-tab-panel" id="tab10">
                      <h3 class="employer_one">Court Records Check</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="court_rec_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="court_rec">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['courtData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['courtData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['courtData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['courtData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['courtData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Court Records Check  end **********-->


                    <!--******** Drug    **********-->
                                        <div class="step-tab-panel" id="tab11">
                      <h3 class="employer_one">Drug  Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="drug_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="drug">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['drugData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['drugData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['drugData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['drugData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['drugData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Drug   end **********-->
                  
                  
                <!--******** Global Base Check    **********-->
                <div class="step-tab-panel" id="tab12">
                      <h3 class="employer_one">Global Base Check Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="gbc_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="gbc">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['globalBaseData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['globalBaseData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['globalBaseData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['globalBaseData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['globalBaseData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Global Base Check  end **********-->

                  <!--******** Social Security Number    **********-->
                <div class="step-tab-panel" id="tab13">
                      <h3 class="employer_one">Social Security Number Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="ssn_form" enctype="multipart/form-data">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['ssnData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['ssnData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['ssnData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['ssnData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['ssnData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Social Security Number  end **********-->

                  <!--******** Criminal Background details    **********-->
                  <div class="step-tab-panel" id="tab14">
                      <h3 class="employer_one">Criminal Background details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="criminal_back_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="criminal_back">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['criminalData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['criminalData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['criminalData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['criminalData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['criminalData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Criminal Details  end **********-->


                  <!--******** Global Sanctions Details    **********-->
                  <div class="step-tab-panel" id="tab15">
                      <h3 class="employer_one">Global Sanctions Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="global_sanctions_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="global_sanctions">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['gsData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['gsData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['gsData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['gsData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['gsData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Global Sanctions Details  end **********-->

                    
                  <!--******** National Sex Offender Registry Details    **********-->
                  <div class="step-tab-panel" id="tab16">
                      <h3 class="employer_one">National Sex Offender Registry Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="nsr_form" enctype="multipart/form-data">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['nsrData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['nsrData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['nsrData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['nsrData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['nsrData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** National Sex Offender Registry Details  end **********-->
                    
                  <!--******** Company Varification  Details    **********-->
                  <div class="step-tab-panel" id="tab17">
                      <h3 class="employer_one">Company Verification Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="comp_verif_form" enctype="multipart/form-data">
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
                              <tr>
                                <th>Verification Mode</th>
                                <td> : </td>
                                <td><?php echo $appInformation['compVerifData'][0]['verification_mode'] ?></td>
                              </tr>
                              
                              
                            </table>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['compVerifData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['compVerifData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['compVerifData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['compVerifData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['compVerifData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Company Varification Details  end **********-->
                    
                  <!--******** Identity Verification    **********-->
                  <div class="step-tab-panel" id="tab18">
                      <h3 class="employer_one">Identity Details</h3>
                      <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                      <form method="post" id="identity_verif_form" enctype="multipart/form-data">
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
                              <label class="input_hdr" for="">Review Comment </label>
                              <textarea name="review_comment"  id="review_comment" placeholder="Type the comment..." class="form-control"<?php echo ($appInformation['identityData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['identityData']['0']['review_comment']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Is form data completed?
                                <span aria-required="true" class="required"> * </span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="1" <?php echo ($appInformation['identityData'][0]['is_completed'] == '1') ? "checked" : "" ?> > <span>Yes</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="2" <?php echo ($appInformation['identityData'][0]['is_completed'] == '2') ? "checked" : "" ?> > <span>No</span></label>
                              <label class="radio  input_hdr"><input type="radio" name="is_completed" value="0" <?php echo ($appInformation['identityData'][0]['is_completed'] == '0') ? "checked" : "" ?> > <span>NA</span></label>
                            </div>
                          </div>
                        </div>

                        <br/><br/>
                        <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div ></div>
                        </div>
                        <div class="row">
                          <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--******** Identity Verification  end **********-->
                    

              </div>
                  <div class="step-footer">
                    <button data-direction="prev" class="step-btn prev" >Previous</button>
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
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript" src="../assets/js/page/review-form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
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
<!--================= cdn link datatable start===================-->

</body>
</html>