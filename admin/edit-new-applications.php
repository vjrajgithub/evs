<?php
require_once '../init.php';
include_once 'function.php';
include_once 'selected_tabs_visible_functions.php';
if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
if (isset($_GET['appid'])) {
  $_SESSION['application_ref_id'] = $_GET['appid'];
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];


//print_r($mycon);


$appInformation = getAllAppInformation($mycon, $_GET['appid']);
// pre($appInformation);


$countries = getCountries($mycon);
$states = getStates($mycon, $country = 100);
$cities = getCities($mycon, $state = 0);
$departments = getDepartments($mycon);


//pre($departments);
//pre(explode(',', $appInformation['type_of_check']));

// FOR SELECTED TABS 
// $type_of_verification_array = explode(',', $appInformation['type_of_check']);

$type_of_verification_array = explode(',', $appInformation['type_of_check']);
$app_id = $appInformation['application_ref_id'];



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
                    <li class="active"><a href="edit-new-applications.php?appid=<?php echo $app_id; ?>">Application Details</a></li>
                    <li><a href="edit-personal.php?appid=<?php echo $app_id; ?>">Personal Details</a></li>
                    <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?>><a href="edit-address.php?appid=<?php echo $app_id; ?>">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="edit-education.php?appid=<?php echo $app_id; ?>">Educational Details</a></li>
                    <li  <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?>><a href="edit-identity_verif.php?appid=<?php echo $app_id; ?>">Identity Verification</a></li>
                    <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>><a href="edit-employment.php?appid=<?php echo $app_id; ?>">Employment Details</a></li>
                    <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?>><a href="edit-police.php?appid=<?php echo $app_id; ?>">Police Verification</a></li>
                    <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?>><a href="edit-reference.php?appid=<?php echo $app_id; ?>">Reference Details</a></li>
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
                    <div class="step-tab-panel" id="tab1">
                      <h3 class="employer_one">Application Details</h3>
                      <!--                      <div class="row">
                                              <div class="col-md-12">
                                                <marquee behavior="alternate" direction="left"><h6   <?php echo ($appInformation['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['review_comment']; ?></h6></marquee>
                                              </div>
                                            </div>-->
                      <form method="post" id="import_form" enctype="multipart/form-data">
                        <input type="hidden" name="form_type" value="application">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">HMDS ID</label>
                              <input type="text" name="hmds_id" id="hmds_id" aria-describedby="" value="<?php echo $appInformation['hmds_id']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">Client Name</label>
                              <select class="form-control" name="client_name" id="client_name">
                                <?php if ($userRole == 28) {
                                  $sql_query = "SELECT customer_name, customer_code FROM customer_master WHERE customer_id = '" . $userdata['client_id'] . "'";
                                } else {
                                  $sql_query = "SELECT customer_name, customer_code FROM customer_master ORDER By customer_name";
                                  echo '<option value="">--Select--</option>';
                                }

                                $result = mysqli_query($mycon, $sql_query);
                                if (mysqli_num_rows($result) > 0) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    $selected = "";
                                    if ($appInformation['client_name'] == $row['customer_code']) {
                                      $selected = "selected";
                                    }
                                ?>
                                    <option <?php echo $selected ?> value="<?php echo $row['customer_code'] ?>"><?php echo $row['customer_code'] . " - " . $row['customer_name']; ?></option>
                                <?php
                                  }
                                }
                                ?>

                              </select>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Client Location</label>
                              <input type="text" name="client_location" id="client_location" aria-describedby="" value="<?php echo $appInformation['client_location'] ?>" placeholder="Enter Client Location" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Case ID</label>
                              <input type="text" name="case_id" id="case_id" aria-describedby="" value="<?php echo $appInformation['case_id'] ?>" placeholder="Enter Case ID" class="form-control">
                            </div>
                            <div class="form-group" >
                              <label class="input_hdr" for="select">Type Of Check</label>
                              <select name="type_of_check[]" multiple="multiple" id="type_of_check" class="form-control" style="height: 240px;">
                                <?php
                                $sql_querycheck = "SELECT * FROM type_of_check WHERE status = 1";
                                $resultcheck = mysqli_query($mycon, $sql_querycheck);
                                if (mysqli_num_rows($resultcheck) > 0) {
                                  while ($rowcheck = mysqli_fetch_assoc($resultcheck)) {
                                    $selected = "";
                                    if (in_array($rowcheck['id'], explode(',', $appInformation['type_of_check']))) {
                                      $selected = "selected";
                                    }
                                ?>
                                    <option <?php echo $selected ?> value="<?php echo $rowcheck['id']; ?>"><?php echo $rowcheck['checkType']; ?></option>
                                <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="input_hdr" for="">Application Id</label>
                              <input type="text" name="application_id" id="application_id" aria-describedby="" value="<?php echo $appInformation['application_ref_id']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Case Rec. date</label>
                              <input type="date" name="case_rec_date" id="case_rec_date" aria-describedby="" placeholder="dd-mm-yyyy" value="<?php echo $appInformation['case_record_date']; ?>" class="form-control" style="width: 220px;">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Client Relationship Person Name</label>
                              <input type="text" value="<?php echo $appInformation['client_relationship_person_name']; ?>" name="relationship_person_name" id="relationship_person_name" aria-describedby="" placeholder="Enter Client Relationship Person Name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Client Contact Number</label>
                              <input type="number" name="client_contact_number" value="<?php echo $appInformation['client_contact_number']; ?>" id="client_contact_number" aria-describedby="" placeholder="Enter Client Contact Number" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Unique Id</label>
                              <input type="text" value="<?php echo $appInformation['unique_id']; ?>" name="unique_id" id="unique_id" aria-describedby="" placeholder="Enter Unique Id" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Client Reference Number</label>
                              <input type="text" name="crn" value="<?php echo $appInformation['client_ref_number']; ?>" id="crn" aria-describedby="" placeholder="Enter Reference Number" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="">Review Remark:* </label>
                              <h6 <?php echo ($appInformation['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['review_comment']; ?></h6>
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

                            <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <!--CIBIL details end-->
                  </div>

                  <!-- <div class="step-footer">
                    <button data-direction="prev" class="step-btn prev" >Previous</button>
                    <button data-direction="next" class="step-btn next">Next</button>
                    <button data-direction="finish" class="step-btn finish">Finish</button>
                  </div> -->
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
</script>
<!--================= cdn link datatable start===================-->

</body>

</html>