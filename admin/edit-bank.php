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
                     <!-- 
                        <button style="float:right" class="btn btn-success" onclick="window.history.back()">Back</button> -->
                     <!--******** Wizard_new Start HTML ***********-->
                     <div id="demo">
                        <div class="step-app">
                           <ul class="step-steps">
                              <li><a href="edit-new-applications.php?appid=<?php echo $app_id; ?>">Application Details</a></li>
                              <li><a href="edit-personal.php?appid=<?php echo $app_id; ?>">Personal Details</a></li>
                              <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?> ><a href="edit-address.php?appid=<?php echo $app_id; ?>">Address Details</a></li>
                              <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>  ><a href="edit-education.php?appid=<?php echo $app_id; ?>">Educational Details</a></li>
                              <li  <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?>><a href="edit-identity_verif.php?appid=<?php echo $app_id; ?>">Identity Verification</a></li>
                              <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>  ><a href="edit-employment.php?appid=<?php echo $app_id; ?>">Employment Details</a></li>
                              <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?>  ><a href="edit-police.php?appid=<?php echo $app_id; ?>">Police Verification</a></li>
                              <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?>  ><a href="edit-reference.php?appid=<?php echo $app_id; ?>">Reference Details</a></li>
                              <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?>   class="active"><a href="edit-bank.php?appid=<?php echo $app_id; ?>">Bank Details</a></li>
                              <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>  ><a href="edit-cibil.php?appid=<?php echo $app_id; ?>">CIBIL Details</a></li>
                              <li <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?>><a href="edit-court_record.php?appid=<?php echo $app_id; ?>">Court Records Check</a></li>
                    <li <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?>><a href="edit-drug_test.php?appid=<?php echo $app_id; ?>">Drug Test Screening</a></li>
                    <li <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?>><a href="edit-global_base_check.php?appid=<?php echo $app_id; ?>">Global data base check</a></li>
                    <li <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?>><a href="edit-socal_security_number.php?appid=<?php echo $app_id; ?>">Social Security Number (SSN) Verification</a></li>
                    <li <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?>><a href="edit-criminal_background_check.php?appid=<?php echo $app_id; ?>">Criminal background check (Federal and Local)</a></li>
                    <li <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="edit-global_sanctions.php?appid=<?php echo $app_id; ?>">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                    <li <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="edit-national_sex_registry.php?appid=<?php echo $app_id; ?>">National Sex Offender Registry (NSO)</a></li>
                    <li <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="edit-company_verifaction.php?appid=<?php echo $app_id; ?>">Company Verification</a></li>
                           </ul>
                           <div class="step-tab-panel" id="tab8">
                              <h3 class="employer_one">Bank Statement Details</h3>
                              <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                              <form method="post" id="bankInfo" enctype="multipart/form-data">
                                 <input type="hidden" name="form_type" value="bank">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Bank Name</label>
                                          <div>
                                             <input type="text" name="bank_name" value="<?php echo $appInformation['bankData'][0]['bank_name'] ?>" id="bank_name" placeholder="Enter Bank Name" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Account Holder Name</label>
                                          <div><input type="text" name="account_holder_name" value="<?php echo $appInformation['bankData'][0]['bank_holder_name'] ?>" id="account_holder_name" placeholder="Enter Account Holder Name" data-required="1" class="form-control"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Account Nunmer</label>
                                          <div>
                                             <input type="text" name="account_number" value="<?php echo $appInformation['bankData'][0]['account_no'] ?>" id="phone" placeholder="Enter Account Nunmer" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label  input_hdr">Bank Branch Name</label>
                                          <div>
                                             <input type="text" name="branch_name" value="<?php echo $appInformation['bankData'][0]['bank_branch'] ?>" id="branch_name" data-required="1" placeholder="Enter Branch Name" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                    <label class="control-label  input_hdr">Period of Verification</label>
                                    <div>
                                       <input type="text"  name="period_of_verif"  value="<?php echo $appInformation['bankData'][0]['period_of_verif'] ?>"  id="period_of_verif"  data-required="1" placeholder="Enter Period of Verification" class="form-control">
                                    </div>
                                 </div>
                                  <div class="form-group">
                                           <label class="input_hdr" for="select">Verification Mode</label>
                                           <select name="verification_mode" id="verification_mode" required="" class="form-control">
                                              <option value="">Select</option>
                                              <option <?php echo ($appInformation['bankData']['0']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                              <option <?php echo ($appInformation['bankData']['0']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                              <option <?php echo ($appInformation['bankData']['0']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                           </select>
                                          </div>
                                          
                                       <div class="form-group">
                                          <label class="input_hdr" for="">Review Remark:* </label>
                                          <h6 <?php echo ($appInformation['bankData']['0']['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['bankData']['0']['review_comment']; ?></h6>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <!---Start upload documents code--->
                                       <br /><br />
                                       <p style="color:#c51b1b;">Upload Bank Statement</p>
                                       <div class="form-group">
                                          <div>
                                             <input type="file" name="bank_statement_doc[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                          </div>
                                       </div>
                                       <!---End upload documents code--->
                                    </div>
                                 </div>
                                 <br /><br />
                                 <div class="alert alert-success alert-dismissable" id="personal_success_message" style="display :none">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div></div>
                                 </div>
                                 <div class="row">
                                    <div class="col text-center">
                                       <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                                       <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
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