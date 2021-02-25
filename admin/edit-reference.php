<?php
require_once '../init.php';
include_once 'function.php';
include_once 'selected_tabs_visible_functions.php';
include_once 'city_state_country_functions.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
if (isset($_GET['appid'])) {
  $_SESSION['application_ref_id'] = $_GET['appid'];
}
//print_r($mycon);
$appInformation = getAllAppInformation($mycon, $_GET['appid']);
//pre($appInformation);

$countries = getCountries($mycon);
$states = getStates($mycon, $country = 100);
$cities = getCities($mycon, $state = 0);
$departments = getDepartments($mycon);
//pre($departments);
//pre(explode(',', $appInformation['type_of_check']));

// FOR SELECTED TABS 
$app_id = $appInformation['application_ref_id'];
$type_of_verification_array = explode(',', $appInformation['type_of_check']);


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

  .step-app>.step-footer {
    margin-top: 23px !important;
    margin-bottom: 1px !important;
    text-align: center;
  }
</style>
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
    min-width: 140px;
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
          <div class="card" style="height: 800px;">
            <div class="card-block application_dtls">
              <!-- 
              <button style="float:right" class="btn btn-success" onclick="window.history.back()">Back</button> -->

              <!--******** Wizard_new Start HTML ***********-->
              <div id="demo">
                <div class="step-app">
                  <ul class="step-steps">
                    <li><a href="edit-new-applications.php?appid=<?php echo $app_id; ?>">Application Details</a></li>
                    <li><a href="edit-personal.php?appid=<?php echo $app_id; ?>">Personal Details</a></li>
                    <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?>><a href="edit-address.php?appid=<?php echo $app_id; ?>">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="edit-education.php?appid=<?php echo $app_id; ?>">Educational Details</a></li>
                    <li <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?>><a href="edit-identity_verif.php?appid=<?php echo $app_id; ?>">Identity Verification</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>><a href="edit-employment.php?appid=<?php echo $app_id; ?>">Employment Details</a></li>
                    <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?>><a href="edit-police.php?appid=<?php echo $app_id; ?>">Police Verification</a></li>
                    <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?> class="active"><a href="edit-reference.php?appid=<?php echo $app_id; ?>">Reference Details</a></li>
                    <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?>><a href="edit-bank.php?appid=<?php echo $app_id; ?>">Bank Details</a></li>
                    <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="edit-cibil.php?appid=<?php echo $app_id; ?>">CIBIL Details</a></li>
                    <li <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?>><a href="edit-court_record.php?appid=<?php echo $app_id; ?>">Court Records Check</a></li>
                    <li <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?>><a href="edit-drug_test.php?appid=<?php echo $app_id; ?>">Drug Test Screening</a></li>
                    <li <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?>><a href="edit-global_base_check.php?appid=<?php echo $app_id; ?>">Global data base check</a></li>
                    <li <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?>><a href="edit-socal_security_number.php?appid=<?php echo $app_id; ?>">Social Security Number (SSN) Verification</a></li>
                    <li <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?>><a href="edit-criminal_background_check.php?appid=<?php echo $app_id; ?>">Criminal background check (Federal and Local)</a></li>
                    <li <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="edit-global_sanctions.php?appid=<?php echo $app_id; ?>">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                    <li <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="edit-national_sex_registry.php?appid=<?php echo $app_id; ?>">National Sex Offender Registry (NSO)</a></li>
                    <li <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="edit-company_verifaction.php?appid=<?php echo $app_id; ?>">Company Verification</a></li>
                  </ul>
                  <div>


                    <!--******** refrence details  start **********-->

                    <div class="step-tab-panel" id="tab7">
                      <h3 class="employer_one">Reference Details</h3>
                      <form name="reference_form" id="reference_form">

                        <input type="hidden" name="form_type" value="reference">
                        <!-- vertical tab -->
                        <div class="vertical_tabs_views">
                          <div class="tabordion">
                            <section id="section6">
                              <input type="radio" name="sections" id="option6" checked="">
                              <label class="labls" for="option6">Professional Reference-1
                              </label>
                              <article>
                                <h4 class="employer_one">Professional Reference-1</h4>
                                <input type="hidden" name="reference_type" id="reference_type" value="1">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Name
                                      </label>
                                      <div>
                                        <input type="text" name="name_pr1" value="<?php echo $appInformation['referenceData']['0']['name'] ?>" id="name_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Phone No.
                                      </label>
                                      <div>
                                        <input type="number" name="phone_pr1" value="<?php echo $appInformation['referenceData']['0']['phone_no'] ?>" id="phone_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="City">City</label>
                                      <!-- <select name="city_pr1" id="city_pr1" class="form-control"> -->


                                      <!-- city -->
                                      <!-- <option value="">Select</option>
                                        <?php
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['0']['state']);
                                        $city_id = get_city_id($mycon, $appInformation['referenceData']['0']['city']);
                                        $sql_query = "SELECT * FROM `cities` WHERE state_id = '" . $state_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['city_name']; ?>" <?php if ($row['city_id'] == $city_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['city_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?> -->

                                      <!-- </select> -->

                                      <!-- city -->
                                      <input type="text" name="city_pr1" value="<?php echo $appInformation['referenceData']['0']['city']; ?>" id="city_pr1" placeholder="Enter city" data-required="1" class="form-control">




                                    </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="state">State</label>
                                      <select name="state_pr1" id="state_pr1" class="form-control">

                                        <!-- state  -->
                                        <option value="">Select</option>
                                        <?php
                                        $country_id = get_country_id($mycon, $appInformation['referenceData']['0']['state']);
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['0']['state']);
                                        $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['state_name']; ?>" <?php if ($row['state_id'] == $state_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['state_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?>



                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label input_hdr">Pincode
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="number" name="pincode_pr1" value="<?php echo $appInformation['referenceData']['0']['pin_code'] ?>" id="pincode_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Email
                                      </label>
                                      <div>
                                        <input type="email" name="email_pr1" value="<?php echo $appInformation['referenceData']['0']['email_address'] ?>" id="email_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Address
                                      </label>
                                      <div>
                                        <input type="text" name="address_pr1" value="<?php echo $appInformation['referenceData']['0']['address'] ?>" id="address_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label">Relation
                                      </label>
                                      <div>
                                        <input type="text" name="relation_pr1" value="<?php echo $appInformation['referenceData']['0']['relation'] ?>" id="relation_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="Country">Country</label>
                                      <select name="country_pr1" id="country_pr1" onchange="change_country('country_pr1','state_pr1','city_pr1');" class="form-control">
                                        <option value=""><?php echo "Select Country" ?></option>
                                        <?php
                                        foreach ($countries as $country) {
                                          $selected = "";
                                          if ($country['country_name'] == $appInformation['referenceData']['0']['country']) {
                                            $selected = " selected ";
                                          }
                                        ?>
                                          <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                        <?php } ?>


                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label input_hdr">Landmark
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="text" name="landmark_pr1" value="<?php echo $appInformation['referenceData']['0']['landmark'] ?>" id="landmark_pr1" data-required="1" class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="select">Verification Mode</label>
                                      <select name="verification_mode1" id="verification_mode" required="" class="form-control">
                                        <option value="">Select</option>
                                        <option <?php echo ($appInformation['referenceData']['0']['verification_mode'] == "both") ? "selected" : "" ?> value="both">Both</option>
                                        <option <?php echo ($appInformation['referenceData']['0']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                        <option <?php echo ($appInformation['referenceData']['0']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Remark:* </label>
                                      <h6 <?php echo ($appInformation['referenceData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['referenceData']['0']['review_comment']; ?></h6>
                                    </div>

                                  </div>
                                </div>
                                <!---Start upload documents code--->
                                <!--                                <br/><br /><p style="color:#c51b1b;">Upload Documents</p>
                                <div class="form-group">
                                  <label class="input_hdr" for="select">Select Documents</label>
                                  <select name="select" class="form-control">
                                    <option>PR-1</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                     <label class="control-label">Telephone
                                    <span aria-required="true" class="required"> * </span></label>
                                  <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                </div>
                                <div class="form-group">
                                  <div>
                                    <input type="file" name="address_proof" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                  </div>
                                </div>-->
                                <!---End upload documents code--->
                              </article>
                            </section>
                            <section id="section7">
                              <input type="radio" name="sections" id="option7">
                              <label class="labls" for="option7">
                                professional Reference-2
                              </label>
                              <article>
                                <h4 class="employer_one">Professional Reference-2</h4>
                                <input type="hidden" name="reference_type" id="reference_type" value="1">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Name
                                      </label>
                                      <div>
                                        <input type="text" name="name_pr2" value="<?php echo $appInformation['referenceData']['1']['name'] ?>" id="name_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Phone No.
                                      </label>
                                      <div>
                                        <input type="number" name="phone_pr2" value="<?php echo $appInformation['referenceData']['1']['phone_no'] ?>" id="phone_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="City">City</label>
                                      <!-- <select name="city_pr2" id="city_pr2" class="form-control"> -->



                                      <!-- city -->
                                      <!-- <option value="">Select</option>
                                        <?php
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['1']['state']);
                                        $city_id = get_city_id($mycon, $appInformation['referenceData']['1']['city']);
                                        $sql_query = "SELECT * FROM `cities` WHERE state_id = '" . $state_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['city_name']; ?>" <?php if ($row['city_id'] == $city_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['city_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?> -->

                                      <!-- </select> -->
                                      <!-- city -->
                                      <input type="text" name="city_pr2" value="<?php echo $appInformation['referenceData']['1']['city']; ?>" id="city_pr2" placeholder="Enter city" data-required="1" class="form-control">

                                    </div>

                                    <div class="form-group">
                                      <label class="control-label input_hdr">Pincode
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="number" name="pincode_pr2" value="<?php echo $appInformation['referenceData']['1']['pin_code'] ?>" id="pincode_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Email
                                      </label>
                                      <div>
                                        <input type="email" name="email_pr2" value="<?php echo $appInformation['referenceData']['1']['email_address'] ?>" id="email_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Address
                                      </label>
                                      <div>
                                        <input type="text" name="address_pr2" value="<?php echo $appInformation['referenceData']['1']['address'] ?>" id="address_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                                      <label class="control-label">Relation
                                                      </label>
                                                      <div>
                                                         <input type="text" name="relation_pr2" value="<?php echo $appInformation['referenceData']['1']['relation'] ?>" id="relation_pr2" data-required="1" class="form-control">
                                                      </div>
                                                   </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="Country">Country</label>
                                      <select name="country_pr2" id="country_pr2" onchange="change_country('country_pr2','state_pr2','city_pr2');" class="form-control">
                                        <option value=""><?php echo "Select Country" ?></option>

                                        <?php
                                        foreach ($countries as $country) {
                                          $selected = "";
                                          if ($country['country_name'] == $appInformation['referenceData']['1']['country']) {
                                            $selected = " selected ";
                                          }
                                        ?>
                                          <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                        <?php } ?>


                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="state">State</label>
                                      <select name="state_pr2" id="state_pr2" class="form-control">

                                        <!-- state  -->
                                        <option value="">Select</option>
                                        <?php
                                        $country_id = get_country_id($mycon, $appInformation['referenceData']['1']['state']);
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['1']['state']);
                                        $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['state_name']; ?>" <?php if ($row['state_id'] == $state_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['state_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?>


                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label input_hdr">Landmark
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="text" name="landmark_pr2" value="<?php echo $appInformation['referenceData']['1']['landmark'] ?>" id="landmark_pr2" data-required="1" class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="select">Verification Mode</label>
                                      <select name="verification_mode2" id="verification_mode" required="" class="form-control">
                                        <option value="">Select</option>
                                        <option <?php echo ($appInformation['referenceData']['1']['verification_mode'] == "both") ? "selected" : "" ?> value="both">Both</option>
                                        <option <?php echo ($appInformation['referenceData']['1']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                        <option <?php echo ($appInformation['referenceData']['1']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Remark:* </label>
                                      <h6 <?php echo ($appInformation['referenceData']['1']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['referenceData']['1']['review_comment']; ?></h6>
                                    </div>

                                  </div>
                                </div>
                                <!---Start upload documents code--->
                                <!--                                <br/><br /><p style="color:#c51b1b;">Upload Documents</p>
                                <div class="form-group">
                                  <label class="input_hdr" for="select">Select Documents</label>
                                  <select name="select" class="form-control">
                                    <option>PR-2</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                     <label class="control-label">Telephone
                                    <span aria-required="true" class="required"> * </span></label>
                                  <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                </div>
                                <div class="form-group">
                                  <div>
                                    <input type="file" name="address_proof" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                  </div>
                                </div>-->
                                <!---End upload documents code--->
                              </article>
                            </section>
                            <section id="section8">
                              <input type="radio" name="sections" id="option8">
                              <label class="labls" for="option8">
                                Personal Reference-1
                              </label>
                              <article>
                                <h4 class="employer_one"> Personal Reference-1</h4>
                                <input type="hidden" name="reference_type" id="reference_type" value="2">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Name
                                      </label>
                                      <div>
                                        <input type="text" name="name_perr1" value="<?php echo $appInformation['referenceData']['2']['name'] ?>" id="name_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Phone No.
                                      </label>
                                      <div>
                                        <input type="number" name="phone_perr1" value="<?php echo $appInformation['referenceData']['2']['phone_no'] ?>" id="phone_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="City">City</label>
                                      <!-- <select name="city_perr1" id="city_perr1" class="form-control"> -->

                                      <!-- city -->
                                      <!-- <option value="">Select</option>
                                        <?php
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['2']['state']);
                                        $city_id = get_city_id($mycon, $appInformation['referenceData']['2']['city']);
                                        $sql_query = "SELECT * FROM `cities` WHERE state_id = '" . $state_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['city_name']; ?>" <?php if ($row['city_id'] == $city_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['city_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?> -->
                                      <!-- </select> -->

                                      <!-- city -->
                                      <input type="text" name="city_perr1" value="<?php echo $appInformation['referenceData']['2']['city']; ?>" id="city_perr1" placeholder="Enter city" data-required="1" class="form-control">

                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="state">State</label>
                                      <select name="state_perr1" id="state_perr1" class="form-control">

                                        <!-- state  -->
                                        <option value="">Select</option>
                                        <?php
                                        $country_id = get_country_id($mycon, $appInformation['referenceData']['2']['state']);
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['2']['state']);
                                        $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['state_name']; ?>" <?php if ($row['state_id'] == $state_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['state_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?>


                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label input_hdr">Pincode
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="number" name="pincode_perr1" value="<?php echo $appInformation['referenceData']['2']['pin_code'] ?>" id="pincode_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Email
                                      </label>
                                      <div>
                                        <input type="email" name="email_perr1" value="<?php echo $appInformation['referenceData']['2']['email_address'] ?>" id="email_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Address
                                      </label>
                                      <div>
                                        <input type="text" name="address_perr1" value="<?php echo $appInformation['referenceData']['2']['address'] ?>" id="address_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                                      <label class="control-label">Relation
                                                      </label>
                                                      <div>
                                                         <input type="text" name="relation_perr1" value="<?php echo $appInformation['referenceData']['2']['relation'] ?>" id="relation_perr1" data-required="1" class="form-control">
                                                      </div>
                                                   </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="Country">Country</label>
                                      <select name="country_perr1" id="country_perr1" onchange="change_country('country_perr1','state_perr1','city_perr1');" class="form-control">
                                        <option value=""><?php echo "Select Country" ?></option>

                                        <?php
                                        foreach ($countries as $country) {
                                          $selected = "";
                                          if ($country['country_name'] == $appInformation['referenceData']['2']['country']) {
                                            $selected = " selected ";
                                          }
                                        ?>
                                          <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                        <?php } ?>


                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label input_hdr">Landmark
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="text" name="landmark_perr1" value="<?php echo $appInformation['referenceData']['2']['landmark'] ?>" id="landmark_perr1" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="select">Verification Mode</label>
                                      <select name="verification_mode3" id="verification_mode" required="" class="form-control">
                                        <option value="">Select</option>
                                        <option <?php echo ($appInformation['referenceData']['2']['verification_mode'] == "both") ? "selected" : "" ?> value="both">Both</option>
                                        <option <?php echo ($appInformation['referenceData']['2']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                        <option <?php echo ($appInformation['referenceData']['2']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Remark:* </label>
                                      <h6 <?php echo ($appInformation['referenceData']['2']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['referenceData']['2']['review_comment']; ?></h6>
                                    </div>

                                  </div>
                                </div>
                                <!---Start upload documents code--->
                                <!--                                <br/><br /><p style="color:#c51b1b;">Upload Documents</p>
                                <div class="form-group">
                                  <label class="input_hdr" for="select">Select Documents</label>
                                  <select name="select" class="form-control">
                                    <option>Per.R-1</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                     <label class="control-label">Telephone
                                    <span aria-required="true" class="required"> * </span></label>
                                  <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                </div>
                                <div class="form-group">
                                  <div>
                                    <input type="file" name="address_proof" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                  </div>
                                </div>-->
                                <!---End upload documents code--->
                              </article>
                            </section>
                            <section id="section9">
                              <input type="radio" name="sections" id="option9">
                              <label class="labls" for="option9"> Personal Reference-2</label>
                              <input type="hidden" name="reference_type" id="reference_type" value="2">
                              <article>
                                <h4 class="employer_one"> Personal Reference-2</h4>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Name
                                      </label>
                                      <div>
                                        <input type="text" name="name_perr2" value="<?php echo $appInformation['referenceData']['3']['name'] ?>" id="name_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Phone No.
                                      </label>
                                      <div>
                                        <input type="number" name="phone_perr2" value="<?php echo $appInformation['referenceData']['3']['phone_no'] ?>" id="phone_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="City">City</label>
                                      <!-- <select name="city_perr2" id="city_perr2" class="form-control"> -->

                                      <!-- city -->
                                      <!-- <option value="">Select</option>
                                        <?php
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['3']['state']);
                                        $city_id = get_city_id($mycon, $appInformation['referenceData']['3']['city']);
                                        $sql_query = "SELECT * FROM `cities` WHERE state_id = '" . $state_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['city_name']; ?>" <?php if ($row['city_id'] == $city_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['city_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?> -->
                                      <!-- </select> -->

                                      <!-- city -->
                                      <input type="text" name="city_perr2" value="<?php echo $appInformation['referenceData']['3']['city']; ?>" id="city_perr2" placeholder="Enter city" data-required="1" class="form-control">



                                    </div>

                                    <div class="form-group">
                                      <label class="control-label input_hdr">Pincode
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="number" name="pincode_perr2" value="<?php echo $appInformation['referenceData']['3']['pin_code'] ?>" id="pincode_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Email
                                      </label>
                                      <div>
                                        <input type="email" name="email_perr2" value="<?php echo $appInformation['referenceData']['3']['email_address'] ?>" id="email_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Address
                                      </label>
                                      <div>
                                        <input type="text" name="address_perr2" value="<?php echo $appInformation['referenceData']['3']['address'] ?>" id="address_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                                      <label class="control-label">Relation
                                                      </label>
                                                      <div>
                                                         <input type="text" name="relation_perr2" value="<?php echo $appInformation['referenceData']['3']['relation'] ?>" id="relation_perr2" data-required="1" class="form-control">
                                                      </div>
                                                   </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="Country">Country</label>
                                      <select name="country_perr2" id="country_perr2" onchange="change_country('country_perr2','state_perr2','city_perr2');" class="form-control">
                                        <option value=""><?php echo "Select Country" ?></option>

                                        <?php
                                        foreach ($countries as $country) {
                                          $selected = "";
                                          if ($country['country_name'] == $appInformation['referenceData']['3']['country']) {
                                            $selected = " selected ";
                                          }
                                        ?>
                                          <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                        <?php } ?>


                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="state">State</label>
                                      <select name="state_perr2" id="state_perr2" class="form-control">

                                        <!-- state  -->
                                        <option value="">Select</option>
                                        <?php
                                        $country_id = get_country_id($mycon, $appInformation['referenceData']['3']['state']);
                                        $state_id = get_state_id($mycon, $appInformation['referenceData']['3']['state']);
                                        $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' ";
                                        $result = mysqli_query($mycon, $sql_query);

                                        if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?php echo $row['state_name']; ?>" <?php if ($row['state_id'] == $state_id) {
                                                                                                echo 'selected="selected"';
                                                                                              } ?>>

                                              <?php echo $row['state_name']; ?></option>
                                        <?php
                                          }
                                        }
                                        ?>


                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label input_hdr">Landmark
                                        <!-- <span class="required" aria-required="true"> * </span> -->
                                      </label>
                                      <div>
                                        <input type="text" name="landmark_perr2" value="<?php echo $appInformation['referenceData']['3']['landmark'] ?>" id="landmark_perr2" data-required="1" class="form-control">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="input_hdr" for="select">Verification Mode</label>
                                      <select name="verification_mode4" id="verification_mode" required="" class="form-control">
                                        <option value="">Select</option>
                                        <option <?php echo ($appInformation['referenceData']['3']['verification_mode'] == "both") ? "selected" : "" ?> value="both">Both</option>
                                        <option <?php echo ($appInformation['referenceData']['3']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                        <option <?php echo ($appInformation['referenceData']['3']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label class="input_hdr" for="">Review Remark:* </label>
                                      <h6 <?php echo ($appInformation['referenceData']['3']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['referenceData']['3']['review_comment']; ?></h6>
                                    </div>
                                  </div>
                                </div>
                                <!---Start upload documents code--->
                                <!--                                <br/><br /><p style="color:#c51b1b;">Upload Documents</p>
                                <div class="form-group">
                                  <label class="input_hdr" for="select">Select Documents</label>
                                  <select name="select" class="form-control">
                                    <option>Per.R-2</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                     <label class="control-label">Telephone
                                    <span aria-required="true" class="required"> * </span></label>
                                  <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                </div>
                                <div class="form-group">
                                  <div>
                                    <input type="file" name="address_proof" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                  </div>
                                </div>-->
                                <!---End upload documents code--->
                              </article>
                            </section>
                          </div>
                        </div>
                        <!-- vertical tab -->

                        <div class="alert alert-success alert-dismissable" id="reference_success_message" style="display :none">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <div></div>
                        </div>


                        <!--<p id="success_message"></p>-->


                      </form>

                    </div>
                    <!--******** refrence details  end **********-->


                  </div>


                </div>
              </div>
</div>

              <!--******** Wizard_new End HTML *************-->
            </div>
            <div class="row">
                          <div class="col text-center">
                             <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
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
<!-- 
<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script> -->
<script type="text/javascript" src="../assets/js/page/application.js"></script>
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>


<script type="text/javascript">
  $(".chosen").chosen();

  function change_country(country_Search, state_Search, city_Search) {

    var xmlhttp = new XMLHttpRequest();
    // alert(document.getElementById("countrydd").value);
    // state back is for geting state and city list present in database for state list we require country_id and for city list we require state_id
    xmlhttp.open("GET", "customer_management_stateback.php?country=" + document.getElementById(country_Search).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(state_Search).innerHTML = xmlhttp.responseText;

    if (document.getElementById(country_Search).value == "") {
      document.getElementById(state_Search).innerHTML = "<select><option value=''>Select</option></select>";
      // document.getElementById(city_Search).innerHTML = "<select><option  value=''>Select</option></select>";
    }



  }



  function change_state(state_search, city_search) {
    // alert("hello sfsdfjlkj");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "customer_management_stateback.php?state=" + document.getElementById(state_search).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(city_search).innerHTML = xmlhttp.responseText;
  }
</script>
<!--================= cdn link datatable start===================-->

</body>

</html>