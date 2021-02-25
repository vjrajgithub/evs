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

//echo '<pre>';
//print_r($appInformation);
//die;
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
</style>
<style>
  img {
    border: 1px solid #ddd; /* Gray border */
    border-radius: 4px;  /* Rounded border */
    padding: 5px; /* Some padding */
    width: 150px; /* Set a small width */
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
                    <li><a href="#tab3">Address Details</a></li>
                    <li><a href="#tab4">Educational Details</a></li>
                    <li><a href="#tab5">Employment Details</a></li>
                    <li><a href="#tab6">Police Verification</a></li>
                    <li><a href="#tab7">Reference Details</a></li>
                    <li><a href="#tab8">Bank Details</a></li>
                    <li><a href="#tab9">CIBIL Details</a></li>
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
                                <td><?php echo $appInformation['client_contact_number']; ?></td>

                              </tr>
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['review_comment']; ?></span></td>

                              </tr>

                            </table>


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
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['personalData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['personalData'][0]['review_comment']; ?></span></td>

                              </tr>
                            </table>
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
                                <tr>
                                  <th>Review Comment</th>
                                  <td> : </td>
                                  <td><span <?php echo ($addressData['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $addressData['review_comment']; ?></span></td>

                                </tr>
                              </table>
                            </div>
                          <?php } ?>

                        </div>




                      </form>
                      <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                      <?php
                      foreach ($appInformation['addressImages'] as $image) {
                        if ($image['filename'] != '' && ($image['related_to'] == 'home_address' || $image['related_to'] == 'present_address')) {

                          $Imagecount = count($image['imageUrl']);
                          for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                            //echo $image['imageUrl'][$i];
                            //die;
                            ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                            <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                              <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                            <?php
                          }
                        }
                      }
                      ?>
                    </div>
                    <div class="step-tab-panel" id="tab4">
                      <h3 class="employer_one">Educational Details</h3>
                      <form name="frmLogin" id="frmLogin" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="education">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id']; ?>">


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

                                      <tr>
                                        <th>Review Comment</th>
                                        <td> : </td>
                                        <td><span <?php echo ($appInformation['eduData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData'][0]['review_comment']; ?></span></td>

                                      </tr>
                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'highschool' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      $Imagecount = count($image['imageUrl']);
                                      for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                        //echo $image['imageUrl'][$i];
                                        //die;
                                        ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                        <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                          <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                        <?php
                                      }
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

                                      <tr>
                                        <th>Review Comment</th>
                                        <td> : </td>
                                        <td><span <?php echo ($appInformation['eduData'][1]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData'][1]['review_comment']; ?></span></td>

                                      </tr>
                                    </table>
                                  </div>
                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'intermediate' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      $Imagecount = count($image['imageUrl']);
                                      for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                        //echo $image['imageUrl'][$i];
                                        //die;
                                        ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                        <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                          <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                        <?php
                                      }
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
                                      <tr>
                                        <th>Review Comment</th>
                                        <td> : </td>
                                        <td><span <?php echo ($appInformation['eduData'][2]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData'][2]['review_comment']; ?></span></td>

                                      </tr>

                                    </table>
                                  </div>

                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'graduation' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      $Imagecount = count($image['imageUrl']);
                                      for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                        //echo $image['imageUrl'][$i];
                                        //die;
                                        ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                        <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                          <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                        <?php
                                      }
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

                                      <tr>
                                        <th>Review Comment</th>
                                        <td> : </td>
                                        <td><span <?php echo ($appInformation['eduData'][3]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData'][3]['review_comment']; ?></span></td>

                                      </tr>
                                    </table>
                                  </div>


                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'post graduation' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      $Imagecount = count($image['imageUrl']);
                                      for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                        //echo $image['imageUrl'][$i];
                                        //die;
                                        ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                        <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                          <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                        <?php
                                      }
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
                                      <tr>
                                        <th>Review Comment</th>
                                        <td> : </td>
                                        <td><span <?php echo ($appInformation['eduData'][4]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['eduData'][4]['review_comment']; ?></span></td>

                                      </tr>

                                    </table>
                                  </div>

                                  <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                                  <?php
                                  foreach ($appInformation['eduImages'] as $image) {
                                    if ($image['title'] == 'diploma' && $image['filename'] != '' && $image['related_to'] == 'education') {
                                      $Imagecount = count($image['imageUrl']);
                                      for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                        //echo $image['imageUrl'][$i];
                                        //die;
                                        ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                        <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                          <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                        <?php
                                      }
                                    }
                                  }
                                  ?>


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
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['empData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData'][0]['review_comment']; ?></span></td>

                              </tr>
                            </table>
                          </div>
                        </div>

                        <input type="hidden" name="form_type" value="employer">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <input type="hidden" name="form_type" value="employer">
                        <div class="customer_records" style="width: 100%">


                          <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer0' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                              $Imagecount = count($image['imageUrl']);
                              for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                //echo $image['imageUrl'][$i];
                                //die;
                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                  <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                <?php
                              }
                            }
                          }
                          ?>

                        </div>
                        <br/><br/>
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
                                <td><?php echo $appInformation['empData'][1]['reason_for_leaving'] ?></td>
                              </tr>
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['empData'][1]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData'][1]['review_comment']; ?></span></td>

                              </tr>
                            </table>
                          </div>
                        </div>


                        <div class="customer_records" style="width: 100%">
                          <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer1' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                              $Imagecount = count($image['imageUrl']);
                              for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                //echo $image['imageUrl'][$i];
                                //die;
                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                  <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                <?php
                              }
                            }
                          }
                          ?>

                        </div>
                        <br/><br/>
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
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['empData'][2]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['empData'][2]['review_comment']; ?></span></td>

                              </tr>
                            </table>
                          </div>
                        </div>



                        <div class="customer_records" style="width: 100%">
                          <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                          <?php
                          foreach ($appInformation['empImages'] as $image) {
                            if ($image['title'] == 'employer2' && $image['filename'] != '' && $image['related_to'] == 'employer') {
                              $Imagecount = count($image['imageUrl']);
                              for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                //echo $image['imageUrl'][$i];
                                //die;
                                ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                  <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                <?php
                              }
                            }
                          }
                          ?>
                        </div>
                        <div class="customer_records_dynamic"></div>
                        <br/><br/>

                      </form>
                    </div>
                    <!--  form employment end -->
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
                                <th>Address</th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['address'] ?></td>
                              </tr>
                              <tr style="display: none;" >
                                <th>Village / Town  </th>
                                <td>:</td>
                                <td><?php echo $appInformation['vrificationData']['village'] ?></td>
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
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['vrificationData']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['vrificationData']['review_comment']; ?></span></td>

                              </tr>
                            </table>
                          </div>


                        </div>
                        <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                        <?php
                        foreach ($appInformation['policeImages'] as $image) {
                          if ($image['title'] == 'verification doc' && $image['filename'] != '' && $image['related_to'] == 'police') {
                            $Imagecount = count($image['imageUrl']);
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                              <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                              <?php
                            }
                          }
                        }
                        ?>
                        <br/><br/>

                      </form>


                    </div>

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
                                        <tr>
                                          <th>Review Comment</th>
                                          <td> : </td>
                                          <td><span <?php echo ($appInformation['referenceData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData'][0]['review_comment']; ?></span></td>

                                        </tr>


                                      </tbody></table>
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
                                        <tr>
                                          <th>Review Comment</th>
                                          <td> : </td>
                                          <td><span <?php echo ($appInformation['referenceData'][1]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData'][1]['review_comment']; ?></span></td>

                                        </tr>

                                      </tbody></table>
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
                                        <tr>
                                          <th>Review Comment</th>
                                          <td> : </td>
                                          <td><span <?php echo ($appInformation['referenceData'][2]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData'][2]['review_comment']; ?></span></td>

                                        </tr>

                                      </tbody></table>
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
                                        <tr>
                                          <th>Review Comment</th>
                                          <td> : </td>
                                          <td><span <?php echo ($appInformation['referenceData'][3]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['referenceData'][3]['review_comment']; ?></span></td>

                                        </tr>

                                      </tbody></table>
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



                      </form>
                    </div>
                    <!--******** refrence details  end **********-->
                    <!--******** bank details  start **********-->

                    <div class="step-tab-panel" id="tab8">
                      <h3 class="employer_one">Bank Details</h3>
                      <form name="reference_form" id="reference_form">

                        <input type="hidden" name="form_type" value="reference">
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
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['bankData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['bankData'][0]['review_comment']; ?></span></td>

                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <label for="form_control_1" style="color: #404040;font-weight: bold;">Bank Statement: </label>
                            <?php
                            foreach ($appInformation['bankImages'] as $image) {
                              if ($image['title'] == 'Bank Statement' && $image['filename'] != '' && $image['related_to'] == 'bank') {
                                $Imagecount = count($image['imageUrl']);
                                for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                  //echo $image['imageUrl'][$i];
                                  //die;
                                  ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                  <p><?php echo $image['title']; ?> => 
                                    <a  target="_blank"  href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" >Preview</a>|<a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                  <?php
                                }
                              }
                            }
                            ?>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--******** bank details  end **********-->

                    <!--******** bank details  start **********-->

                    <div class="step-tab-panel" id="tab9">
                      <h3 class="employer_one">CIBIL Details</h3>
                      <form name="reference_form" id="reference_form">

                        <input type="hidden" name="form_type" value="reference">
                        <input type="hidden" name="application_id" value="<?php echo $appInformation['application_ref_id'] ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>PAN Card Number </th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['pancard_no'] ?></td>
                              </tr>
                              <tr>
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
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table">
                              <tr>
                                <th>Annual Income</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['annual_income'] ?></td>
                              </tr>
                              <tr>
                                <th>Net and Gross Income</th>
                                <td> : </td>
                                <td><?php echo $appInformation['cibilData'][0]['net_and_gross_income'] ?></td>
                              </tr>
                              <tr>
                                <th>Review Comment</th>
                                <td> : </td>
                                <td><span <?php echo ($appInformation['cibilData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?> ><?php echo $appInformation['cibilData'][0]['review_comment']; ?></span></td>

                              </tr>
                            </table>

                            <label for="form_control_1" style="color: #404040;font-weight: bold;">Uploaded Ref. Documents: </label>
                            <?php
                            foreach ($appInformation['cibilImages'] as $image) {
                              if ($image['filename'] != '' && $image['related_to'] == 'cibil') {
                                $Imagecount = count($image['imageUrl']);
                                for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                  //echo $image['imageUrl'][$i];
                                  //die;
                                  ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<button onclick="showImage('<?php echo $image['imageUrl'] ?>')" type="button" class="close" data-dismiss="alert" aria-hidden="true">preaview</button>-->



                                  <p><?php echo $image['title']; ?> => <a href="#" onclick="showImage('<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>')">Preview</a> |
                                    <a href="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>" download>Download</a></p>


                                  <?php
                                }
                              }
                            }
                            ?>
                          </div>
                        </div>

                      </form>
                    </div>
                    <!--******** bank details  end **********-->
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
<script type="text/javascript" src="../assets/js/page/application-check.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>

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