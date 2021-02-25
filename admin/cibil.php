<?php
   require_once '../init.php';
   include_once 'function.php';
   
   
   if (not_logged_in() === TRUE) {
     header('location: ../index.php');
   }
   
   $userdata = getUserDataByUserId($_SESSION['id']);
   $userRole = $userdata['role'];
   
   $countries = getCountries($mycon);
   $states = getStates($mycon, $country = 100);
   $cities = getCities($mycon, $state = 0);
   $departments = getDepartments($mycon);
   
   //pre($departments);
   
   
   if ($userdata['role'] == '2' || $userdata['role'] == '3') {
     $user_location = $userdata['org_id'];
     $user_client = $userdata['client_id'];
     $role_item = " AND organization_id = '" . $user_location . "'";
     $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
   } else {
     $role_item = '';
     $loc_item = '';
   }





// code to ALLOW only SELECTED TABS
$app_id = $_SESSION['application_ref_id'];
// echo $app_id;

function get_type_of_verification($mycon, $app_id)
{

   $sql = "select type_of_check from tbl_application where application_ref_id = '" . $app_id . "' limit 1";
   $result =  mysqli_query($mycon, $sql);
   if (mysqli_num_rows($result) >  0) {
      $row = mysqli_fetch_assoc($result);
      return $row['type_of_check'];
   }
}
$type_of_verification = get_type_of_verification($mycon, $app_id);
$type_of_verification_array = explode(',', $type_of_verification);

// print_r($type_of_verification_array);
// echo gettype($type_of_verification_array);
// if (in_array('2', $type_of_verification_array)) {
//    echo "The 'Employment Details' element is in the array";
// }

$appInformation = getAllAppInformation($mycon, $app_id);
// pre($appInformation);


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
                     <div id="demo">
                        <div class="step-app">
                           <ul class="step-steps">
                              <li><a href="add-new-applications.php">Application Details</a></li>
                              <li><a href="personal.php">Personal Details</a></li>
                              <li <?php echo is_visble_verification_tab_multi(array('1','5'), $type_of_verification_array); ?> ><a href="address.php"> Address Details</a></li>
                              <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?> ><a href="education.php">Educational Details</a></li>
                              <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?> ><a href="employment.php">Employment Details</a></li>
                              <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?> ><a href="police.php">Police Verification</a></li>
                              <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?> ><a href="reference.php">Reference Details</a></li>
                              <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?> ><a href="bank.php">Bank Details</a></li>
                              <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?> class="active" ><a href="cibil.php">CIBIL Details</a></li>
                              <li  <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?>><a href="court_record.php">Court Records Check</a></li>
                               <li  <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?>><a href="drug_test.php">Drug Test Screening</a></li>
                              <li  <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?>><a href="global_base_check.php">Global data base check</a></li>
                              <li  <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?>><a href="socal_security_number.php">Social Security Number (SSN) Verification</a></li>
                               <li  <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?>><a href="criminal_background_check.php">Criminal background check (Federal and Local)</a></li>
                                <li  <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="global_sanctions.php">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                                  <li  <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="national_sex_registry.php">National Sex Offender Registry (NSO)</a></li>
                              <li  <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="company_verifaction.php">Company Verification</a></li>
                           </ul>
                     <div class="step-tab-panel" id="tab9">
                        <h3 class="employer_one">CIBIL Details</h3>
                        <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                        <form method="post" id="cibilInfo" enctype="multipart/form-data">
                           <input type="hidden" name="form_type" value="cibil">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label input_hdr">Pancard Number</label>
                                    <div>
                                       <input type="text" autocomplete="off" name="pancard_no" value="<?php echo $appInformation['cibilData'][0]['pancard_no'] ?>"  id="pancard_no" placeholder="Enter Pancard Number" onkeypress="toupper()" data-required="1" class="form-control">
                                    </div>
                                 </div>
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label input_hdr">Aadhar Number</label>-->
                              <!--      <div><input type="text" name="aadhar_no" value="<?php echo $appInformation['cibilData'][0]['aadhar_no'] ?>"  id="account_holder_name" placeholder="Enter Aadhar Number" data-required="1" class="form-control"></div>-->
                              <!--   </div>-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label input_hdr">Mobile</label>-->
                              <!--      <div>-->
                              <!--         <input type="number" name="mobile" value="<?php echo $appInformation['cibilData'][0]['mobile'] ?>"  id="mobile" placeholder="Enter Mobile Number" data-required="1" class="form-control">-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label  input_hdr">Email</label>-->
                              <!--      <div>-->
                              <!--         <input type="email" name="email" value="<?php echo $appInformation['cibilData'][0]['email'] ?>"  id="email"  data-required="1" placeholder="john@xyz.com" class="form-control">-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label  input_hdr">Occupation</label>-->
                              <!--      <div>-->
                              <!--         <input type="text" name="occupation" value="<?php echo $appInformation['cibilData'][0]['occupation'] ?>"  id="occupation"  data-required="1" placeholder="Enter Occupation" class="form-control">-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--</div>-->
                              <!--<div class="col-md-6">-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label  input_hdr">Monthly Income</label>-->
                              <!--      <div>-->
                              <!--         <input type="text" name="monthly_income" value="<?php echo $appInformation['cibilData'][0]['monthly_income'] ?>"  id="monthly_income"  data-required="1" placeholder="Enter Monthly Income" class="form-control">-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label  input_hdr">Annual Income</label>-->
                              <!--      <div>-->
                              <!--         <input type="text" name="annual_income" value="<?php echo $appInformation['cibilData'][0]['annual_income'] ?>"  id="annual_income"  data-required="1" placeholder="Enter Annual Income" class="form-control">-->
                              <!--      </div>-->
                              <!--   </div>-->
                              <!--   <div class="form-group">-->
                              <!--      <label class="control-label  input_hdr">Net And Gross Income</label>-->
                              <!--      <div>-->
                              <!--         <input type="text" name="net_and_gross_income" value="<?php echo $appInformation['cibilData'][0]['net_and_gross_income'] ?>"  id="net_and_gross_income"  data-required="1" placeholder="Net And Gross Income" class="form-control">-->
                              <!--      </div>-->
                                 <!--</div>-->
                                 <!---Start upload documents code--->
                                 
                                 <p style="color:#c51b1b;">Upload  PANCARD</p>
                                 <div class="form-group">
                                    <div>
                                       <input type="file" name="cibil_doc" id="cibil_doc" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                    </div>
                                 </div>
                                 
                                 <!---End upload documents code--->
                                  <div class="form-group">
                                     <label class="input_hdr" for="select">Verification Mode</label>
                                     <select name="verification_mode" id="verification_mode" required="" class="form-control">
                                        <option value="">Select</option>
                                        <option <?php echo ($appInformation['cibilData'][0]['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                        <option <?php echo ($appInformation['cibilData'][0]['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                        <option <?php echo ($appInformation['cibilData'][0]['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                     </select>
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
                                 <button class="btn btn-primary" onclick="window.history.back()">Back</button>
                                 <button  type="submit" class="btn btn-primary">Save</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="step-footer"></div>
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
<script type="text/javascript" src="../assets/js/script.js"></script><!-- 
<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script> -->
<script type="text/javascript" src="../assets/js/page/application.js"></script>
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script type="text/javascript" src="../assets/js/custom.js"></script>

<script>
$(document).ready(function(){
    $('#pancard_no').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});
</script>
