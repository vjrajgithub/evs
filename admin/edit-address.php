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
// pre($appInformation);

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

              <!--******** Wizard_new Start HTML ***********-->
              <div id="demo">
                <div class="step-app">
                  <ul class="step-steps">
                    <li><a href="edit-new-applications.php?appid=<?php echo $app_id; ?>">Application Details</a></li>
                    <li><a href="edit-personal.php?appid=<?php echo $app_id; ?>">Personal Details</a></li>
                    <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?> class="active"><a href="edit-address.php?appid=<?php echo $app_id; ?>">Address Details</a></li>
                    <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="edit-education.php?appid=<?php echo $app_id; ?>">Educational Details</a></li>
                    <li <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?>><a href="edit-identity_verif.php?appid=<?php echo $app_id; ?>">Identity Verification</a></li>
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

                  <div class="step-tab-panel" id="tab3">
                    <h3 class="employer_one">Address Details</h3>
                    <form method="post" id="address_form" enctype="multipart/form-data">
                      <input type="hidden" name="form_type" value="address">

                      <div class="row">

                        <div class="col-md-6">
                          <div class="present_adress">
                            <label class="input_hdr">Present Address</label>
                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr"> Address </label>
                            <div>
                              <textarea type="text" data-required="1" class="form-control" name="address" id="address"><?php echo $appInformation['addressData']['0']['address'] ?></textarea>
                              <input type="hidden" name="address_type" id="address_type" value="1">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr">Landmark </label>
                            <div>
                              <input type="text" name="landmark" value="<?php echo $appInformation['addressData']['0']['landmark'] ?>" id="landmark" data-required="1" placeholder="Enter Landmark" class="form-control">
                            </div>
                          </div>

                          <!-- area for auto filling address -->
                          <div class="form-group">
                                          <label class="control-label input_hdr">Area</label>
                                          <div>
                                             <input type="text" name="area" value="<?php echo $appInformation['addressData']['0']['area'] ?>" id="area" onchange="get_pincode()"  data-required="1" placeholder="Enter area" class="form-control">
                                          </div>
                                       </div>
                                       <!-- area for auto filling address -->

                          <div class="form-group">
                            <label class="input_hdr" for="country">Country</label>
                            <select name="country" id="country" onchange="change_country('country','state','city');" class="form-control">
                              <option value="">Select</option>
                              <?php
                              foreach ($countries as $country) {
                                $selected = "";
                                if ($country['country_name'] == $appInformation['addressData']['0']['country']) {
                                  $selected = " selected ";
                                }
                              ?>
                                <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="input_hdr" for="state">State</label>
                            <select name="state" id="state" class="form-control">
                              <!-- state  -->
                              <option value="">Select</option>
                              <?php
                              $country_id = get_country_id($mycon, $appInformation['addressData']['0']['state']);
                              $state_id = get_state_id($mycon, $appInformation['addressData']['0']['state']);
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
                            <input type="text" name="city" value="<?php echo $appInformation['addressData']['0']['city']; ?>" id="city" placeholder="Enter city" data-required="1" class="form-control">

                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr">Pincode
                              <span class="required" aria-required="true"> * </span>
                            </label>
                            <div>
                              <input type="number" name="pincode" value="<?php echo $appInformation['addressData']['0']['pin_code'] ?>" id="pincode"  placeholder="Enter Pincode" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="input_hdr" for="">Review Remark:*</label>
                            <h6 <?php echo ($appInformation['addressData'][0]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['addressData']['0']['review_comment']; ?></h6>
                          </div>
                          <!---Start upload documents code--->
                          <br /><br />
                          <p style="color:#c51b1b;">Upload Documents</p>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="address_doc_type" id="address_doc_type" class="form-control">
                              <option value="aadhaar_card">Adhar card </option>
                              <option value="pan_card">Pan card </option>
                              <option value="voter_card">Voter card</option>
                              <option value="passport">Passport no.</option>
                              <option value="other">Other</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                                <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="address_doc_desc" id="address_doc_desc"  data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <div class="form-group">
                            <div>
                              <input type="file" name="address_doc[]" id="address_doc_file"  aria-describedby="" class="form-control" style="width: 220px;" multiple>
                            </div>
                          </div>
                          <!---End upload documents code--->
                        </div>
                        <div class="col-md-6">
                          <div class="present_adress">
                            <input id="sameadd" name="sameadd" type="checkbox" value="Sameadd" onchange="CopyAdd();" />
                            <label class="input_hdr">Permanent Address
                              <!--                                <input type="checkbox" name="permanent_address" value="permanent_address" id="permanent_address">
                                Same as Present Address-->
                            </label>
                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr"> Address
                              <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <textarea type="text" data-required="1" class="form-control" name="homeaddress" id="homeaddress"><?php echo $appInformation['addressData']['1']['address'] ?></textarea>
                              <input type="hidden" name="address_type" id="address_type" value="2">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr">Landmark
                              <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="home_landmark" value="<?php echo $appInformation['addressData']['1']['landmark'] ?>" id="home_landmark" data-required="1" class="form-control">
                            </div>
                          </div>

<!-- area field added for auto fill pincode -->
<div class="form-group">
                                          <label class="control-label input_hdr">
                                          Area
                                             <!-- <span class="required" aria-required="true"> * </span> -->
                                          </label>
                                          <div>
                                             <input type="text" name="home_area" value="<?php echo $appInformation['addressData']['1']['area']; ?>" id="home_area" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <!-- END area field added for auto fill pincode -->

                          <div class="form-group">
                            <label class="input_hdr" for="country">Country</label>
                            <select name="homecountry" id="homecountry" onchange="change_country('homecountry','homestate','homecity')" class="form-control">
                              <option value="">Select</option>
                              <?php
                              foreach ($countries as $country) {
                                $selected = "";
                                if ($country['country_name'] == $appInformation['addressData']['1']['country']) {
                                  $selected = " selected ";
                                }
                              ?>
                                <option <?php echo $selected ?> value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="input_hdr" for="state">State</label>
                            <select name="homestate" id="homestate"  class="form-control">

                              <!-- state  -->
                              <option value="">Select</option>
                              <?php
                              $country_id = get_country_id($mycon, $appInformation['addressData']['1']['state']);
                              $state_id = get_state_id($mycon, $appInformation['addressData']['1']['state']);
                              $sql_query = "SELECT * FROM `states` WHERE country_id = '" . $country_id . "' order by state_name";
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

                            <input type="text" name="homecity" value="<?php echo $appInformation['addressData']['1']['city']; ?>" id="homecity" placeholder="Enter city" data-required="1" class="form-control">

                          </div>

                          <div class="form-group">
                            <label class="control-label input_hdr">Pincode
                              <span class="required" aria-required="true"> * </span>
                            </label>
                            <div>
                              <input type="number" name="homepincode" value="<?php echo $appInformation['addressData']['1']['pin_code'] ?>" id="homepincode" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="input_hdr" for="">Review Remark:* </label>
                            <h6 <?php echo ($appInformation['addressData'][1]['is_completed'] != '1') ? "style='color:red'" : "style='color:green'" ?>><?php echo $appInformation['addressData']['1']['review_comment']; ?></h6>
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
                            <select name="home_address_doc_type" id="home_address_doc_type" class="form-control">
                              <option value="aadhaar_card">Adhar card </option>
                              <option value="pan_card">Pan Card </option>
                              <option value="voter_card">Voter Card</option>
                              <option value="passport">Passport No.</option>
                              <option value="other">Other</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                                <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="home_address_doc_desc" id="home_address_doc_desc" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <div class="form-group">
                            <div>
                              <input type="file" name="home_address_doc[]" id="home_address_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple>
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
        //  $(".homecountry").change();
        $( "#homecountry" ).change();
         homestate.value = state.value;
         homecity.value = city.value;
         homepincode.value = pincode.value;
         home_area.value = area.value;
         home_address_doc_type.value = address_doc_type.value;
         home_address_doc_desc.value = address_doc_desc.value;
        //  home_address_doc_file.value = address_doc_file.value;
         document.getElementById("doc_upload").style.display = "none";

      } else {
         al1.value = '';
         home_landmark.value = '';
         homecountry.value = '';
         homestate.value = '';
         homecity.value = '';
         homepincode.value = '';
         home_area.value = '';
         document.getElementById("doc_upload").style.display = "block";
      }


  }
</script>
<script>

  
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

<script>


function get_pincode(){
  // console.log("rkljkljkljkljkl");
  var area = $('#area').val();
  if(area==''){
    // $('#city').value('');
    // $('#state').value('');
  }else{
    $.ajax({
      url: 'get_pincode.php',
      type:'post',
      data:'area='+area,
      success: function(data){

if(data == 'no'){
  console.log('No record found for current Area Name');
}else{

        
        var getData= $.parseJSON(data);
        console.log(getData['pincode']);
        // an drop down should be available to chose the correct pincode related to that area name  
        // $('#pincode').val(getData.pincode);
        
}

      }
    })
  }
}

function get_details(){
  var pincode = $('#pincode').val();
  if(pincode==''){
    // $('#city').value('');
    // $('#state').value('');
  }else{
    $.ajax({
      url: 'get.php',
      type:'post',
      data:'pincode='+pincode,
      success: function(data){

if(data == 'no'){
  console.log('No record found for current pincode');
}else{

        
        var getData= $.parseJSON(data);
        // console.log(getData);
        $('#city').val(getData.city);
        $('#state').val(getData.state);
}

      }
    })
  }
}

</script>


</body>

</html>