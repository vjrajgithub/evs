<?php
require_once '../init.php';
include_once 'function.php';
include_once 'city_state_country_functions.php';

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
if(isset($_SESSION['application_ref_id'])){
$app_id = $_SESSION['application_ref_id'];
// echo $app_id; die;
}

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

   foreach ($tab_no_array as $tab_no) {
      if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
      else $status = false;
   }

   if ($status == false) {
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
   <div class="col-md-1 pull-right mt-2">
      <span data-tooltip="" title="Close" class="cursor " data-tooltip-id="0">
         <a href="application.php" class="btn btn-success">Close</a>
      </span>
   </div>
   <div class="col-md-1 pull-right mt-2">
      <span data-tooltip="" title="Close" class="cursor " data-tooltip-id="0">
         <a href="add-new-applications.php?new_application=<?php echo 1; ?>" class="btn text-light" style="background-color: #920706;">New</a>
      </span>
   </div>

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
                              <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?> class="active"><a href="address.php"> Address Details</a></li>
                              <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="education.php">Educational Details</a></li>
                              <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?>><a href="employment.php">Employment Details</a></li>
                              <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?>><a href="police.php">Police Verification</a></li>
                              <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?>><a href="reference.php">Reference Details</a></li>
                              <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?>><a href="bank.php">Bank Details</a></li>
                              <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?>><a href="cibil.php">CIBIL Details</a></li>
                              <li  <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?>><a href="court_record.php">Court Records Check</a></li>
                               <li  <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?>><a href="drug_test.php">Drug Test Screening</a></li>
                              <li  <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?>><a href="global_base_check.php">Global data base check</a></li>
                              <li  <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?>><a href="socal_security_number.php">Social Security Number (SSN) Verification</a></li>
                               <li  <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?>><a href="criminal_background_check.php">Criminal background check (Federal and Local)</a></li>
                                <li  <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="global_sanctions.php">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                                  <li  <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="national_sex_registry.php">National Sex Offender Registry (NSO)</a></li>
                              <li  <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="company_verifaction.php">Company Verification</a></li>
                           </ul>
                           <div class="step-tab-panel" id="tab3">
                              <h3 class="employer_one">Address Details</h3>
                              <form method="post" id="address_form" enctype="multipart/form-data">
                                 <input type="hidden" name="form_type" value="address">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <?php $sql = "select * from employee_address where application_id =  '" . $app_id . "' and address_type = 1";
                                       $result = mysqli_query($mycon, $sql);
                                       $row24 = mysqli_fetch_assoc($result);
                                       //echo  $sql ; //die('dfgdgdf');
                                       ?>

                                       <div class="present_adress">
                                          <label class="input_hdr">Permanent Address </label>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr"> Address </label>
                                          <div>
                                             <textarea autocomplete="off" data-required="1" class="form-control" name="address" id="address">
                                       <?php echo $appInformation['addressData']['0']['address'] ?>
                                       </textarea>
                                             <input type="hidden" name="address_type" id="address_type" value="1">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Landmark </label>
                                          <div>
                                             <input type="text" autocomplete="off" name="landmark" value="<?php echo $appInformation['addressData']['0']['landmark'] ?>" id="landmark" data-required="1" placeholder="Enter Landmark" class="form-control">
                                          </div>
                                       </div>
                                       <!-- area for auto filling address -->
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Area</label>
                                          <div>
                                             <input type="text" autocomplete="off" name="area" value="<?php echo $appInformation['addressData']['0']['area'] ?>" id="area" data-required="1" placeholder="Enter area" class="form-control">
                                          </div>
                                       </div>
                                       <!-- area for auto filling address -->
                                       <div class="form-group">
                                          <label class="input_hdr" for="country">Country</label>
                                          <select chosen name="country" id="country" class="form-control" onchange="change_country('country','state','city');">
                                             <option value="" selected> select </option>
                                             <?php
                                             foreach ($countries as $country) {
                                                $selected = "";
                                                if ($country['country_name'] == $appInformation['addressData']['0']['country']) {
                                                   $selected = " selected ";
                                                }
                                             ?>
                                                <option <?php echo $selected; ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label class="input_hdr" for="state">State &#9734; </label>
                                          <select name="state" id="state"   class="form-control">
                                             
                                             <!-- state  -->
                                             <option value="">Select</option>
                                             <?php
                                             $country_id = get_country_id($mycon, $appInformation['addressData']['0']['state']);
                                             $state_id = get_state_id($mycon, $appInformation['addressData']['0']['state']);
                                             $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "'  order by state_name ";
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
                                          <label class="input_hdr" for="city">City</label>
                                          <input type="text" autocomplete="off" name="city" value="<?php echo $appInformation['addressData']['0']['city']; ?>" id="city" placeholder="Enter city" data-required="1" class="form-control">
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Pincode
                                             <span class="required" aria-required="true"> * </span>
                                          </label>
                                          <div>
                                             <input type="number" autocomplete="off" name="pincode" value="<?php echo $appInformation['addressData']['0']['pin_code']; ?>" id="pincode" placeholder="Enter Pincode" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <!---Start upload documents code--->
                                       <br /><br />
                                       <p style="color:#c51b1b;">Upload Documents</p>
                                       <div class="form-group">
                                          <label class="input_hdr" for="select">Select Documents</label>
                                          <select name="address_doc_type" class="form-control">
                                             <option value="Adhar card">Aadhar card </option>
                                             <option value="Pan card">Pan card </option>
                                             <option value="Voter card">Voter card</option>
                                             <option value="Passport">Passport no.</option>
                                             <option value="Other">Other</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <!--   <label class="control-label">Telephone
                                       <span aria-required="true" class="required"> * </span></label>  -->
                                          <div><input type="text" name="address_doc_desc" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                       </div>
                                       <div class="form-group">
                                          <div>
                                             <input type="file" name="address_doc[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                          </div>
                                       </div>
                                       <!---End upload documents code--->
                                    </div>
                                    <div class="col-md-6">

                                       <?php $sql = "select * from employee_address where application_id =  '" . $app_id . "' and address_type = 2";
                                       $result = mysqli_query($mycon, $sql);
                                       $row24 = mysqli_fetch_assoc($result);
                                       //echo  $sql ; //die('dfgdgdf');
                                       ?>
                                       <div class="present_adress">
                                          <input id="sameadd" name="sameadd" type="checkbox" onchange="CopyAdd();" />
                                          <label class="input_hdr">Present Address
                                          </label>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">
                                             Address
                                             <!-- <span class="required" aria-required="true"> * </span> -->
                                          </label>
                                          <div>
                                             <textarea type="text" autocomplete="off" data-required="1" class="form-control" name="homeaddress" id="homeaddress"><?php echo $appInformation['addressData']['1']['address']; ?> </textarea>
                                             <input type="hidden" name="address_type" id="address_type" value="2">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">
                                             Landmark
                                             <!-- <span class="required" aria-required="true"> * </span> -->
                                          </label>
                                          <div>
                                             <input type="text" autocomplete="off" name="home_landmark" value="<?php echo $appInformation['addressData']['1']['landmark']; ?>" id="home_landmark" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <!-- area field added for auto fill pincode -->
                                       <div class="form-group">
                                          <label class="control-label input_hdr">
                                          Area
                                             <!-- <span class="required" aria-required="true"> * </span> -->
                                          </label>
                                          <div>
                                             <input type="text" autocomplete="off" name="home_area" value="<?php echo $appInformation['addressData']['1']['area']; ?>" id="home_area" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <!-- END area field added for auto fill pincode -->
                                       <div class="form-group">
                                          <label class="input_hdr" for="country">Country</label>
                                          <select name="homecountry" id="homecountry" onchange="change_country('homecountry','homestate','homecity');" class="form-control">
                                             <option value="" selected>Select</option>
                                             <?php
                                             foreach ($countries as $country) {
                                                $selected = "";
                                                if ($country['country_name'] == $appInformation['addressData']['1']['country']) {
                                                   $selected = " selected ";
                                                }
                                             ?>
                                                <option <?php echo $selected; ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label class="input_hdr" for="state">State</label>
                                          <select name="homestate" id="homestate"   class="form-control">
                                             
                              <!-- state  -->
                              <option value="">Select</option>
                              <?php
                              $country_id = get_country_id($mycon, $appInformation['addressData']['1']['state']);
                              $state_id = get_state_id($mycon, $appInformation['addressData']['1']['state']);
                              $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' order by state_name ";
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
                                          <label class="input_hdr" for="city">City</label>

                                          <input type="text" autocomplete="off" name="homecity" value="<?php echo $appInformation['addressData']['1']['city']; ?>" id="homecity" placeholder="Enter city" data-required="1" class="form-control">
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Pincode
                                             <span class="required" aria-required="true"> * </span>
                                          </label>
                                          <div>
                                             <input type="number" autocomplete="off" name="homepincode" value="<?php echo $appInformation['addressData']['1']['pin_code'] ?>" id="homepincode" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                        <div class="form-group">
                                           <label class="input_hdr" for="select">Verification Mode</label>
                                           <select name="verification_mode" id="verification_mode" required="" class="form-control">
                                              <option value="">Select</option>
                                              <option <?php echo ($appInformation['addressData']['1']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                              <option <?php echo ($appInformation['addressData']['1']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                              <option <?php echo ($appInformation['addressData']['1']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                           </select>
                                          </div>
                                       
                                       <!---Start upload documents code--->
                                       <div id="doc_upload">
                                       <br /><br />
                                       <p style="color:#c51b1b;">Upload Documents</p>
                                       <div class="form-group">
                                          <label class="input_hdr" for="select">Select Documents</label>
                                          <select name="home_address_doc_type" class="form-control">
                                             <option value="Adhar card">Aadhar card </option>
                                             <option value="Pan card">Pan card </option>
                                             <option value="voter card">Voter card</option>
                                             <option value="Passport no">Passport no.</option>
                                             <option value="Other">Other</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <!--   <label class="control-label">Telephone
                                       <span aria-required="true" class="required"> * </span></label>  -->
                                          <div><input type="text" name="home_address_doc_desc" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                       </div>
                                       <div class="form-group">
                                          <div>
                                             <input type="file" name="home_address_doc[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                          </div>
                                       </div>
                                       </div>
                                       <!---End upload documents code--->
                                    </div>
                                 </div>
                                 <br /><br />
                                 <div class="alert alert-success alert-dismissable" id="address_success_message" style="display :none">
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
<script type="text/javascript" src="../assets/js/script.js"></script>
<!-- 
<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script> -->
<script type="text/javascript" src="../assets/js/page/application.js"></script>
<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script type="text/javascript" src="../assets/js/custom.js"></script>

<script type="text/javascript">
   function CopyAdd() {

      var cb1 = document.getElementById('sameadd');
      var a1 = document.getElementById('address');
      var al1 = document.getElementById('homeaddress');
      var landmark = document.getElementById('landmark');
      var home_landmark = document.getElementById('home_landmark');
      var country = document.getElementById('country');
      var homecountry = document.getElementById('homecountry');
      var state = document.getElementById('state');
      var homestate = document.getElementById('homestate');
      var city = document.getElementById('city');
      var homecity = document.getElementById('homecity');
      var pincode = document.getElementById('pincode');
      var homepincode = document.getElementById('homepincode');
      var area = document.getElementById('area');
      var home_area = document.getElementById('home_area');

      // DOC RELATED
      var address_doc_type = document.getElementById('address_doc_type');
      var home_address_doc_type = document.getElementById('home_address_doc_type');
      var address_doc_desc = document.getElementById('address_doc_desc');
      var home_address_doc_desc = document.getElementById('home_address_doc_desc');
      // var address_doc_file = document.getElementById('address_doc_file');
      // var home_address_doc_file = document.getElementById('home_address_doc_file');
      
      //END DOC RELATED

      
      if (cb1.checked) {
         al1.value = a1.value;
         home_landmark.value = landmark.value;
         homecountry.value = country.value;
         $( "#homecountry" ).change();
         homestate.value = state.value;
         homecity.value = city.value;
         homepincode.value = pincode.value;
         home_area.value = area.value;
         home_address_doc_type.value = address_doc_type.value;
         home_address_doc_desc.value = address_doc_desc.value;

document.getElementById("doc_upload").style.display = "none";

      } else {
         al1.value = '';
         home_landmark.value = '';
         homecountry.value = '';
         homestate.value = '';
         homecity.value = '';
         homepincode.value = '';
         document.getElementById("doc_upload").style.display = "block";
      }
   }


   // CHANGE COUNTRY AND STATE INTITIALY

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
      // alert("abcd efgh");

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "customer_management_stateback.php?state=" + document.getElementById(state_search).value, false);
      xmlhttp.send(null);
      // alert(xmlhttp.responseText);
      document.getElementById(city_search).innerHTML = xmlhttp.responseText;

      // if(document.getElementById(state_search).value == ""){
      //    document.getElementById(city_Search).innerHTML = "<select><option value=''>Select</option></select>";
      // }

   }


   function check_state(state_search, city_search) {
      
      var state_name = document.getElementById(state_search).value;
      if(state_name == ""){
         document.getElementById(city_search).value = ""; 
      }

      // if(document.getElementById(state_search).value == ""){
      //    document.getElementById(city_Search).innerHTML = "<select><option value=''>Select</option></select>";
      // }

   }


   // $(document).ready(function () {
   //    change_country('country','state','city');
   //    change_country('homecountry','homestate','homecity');
   //    // change_state('state','city');
   //    // change_state('homestate','homecity');

   //  });
</script>