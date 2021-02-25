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

// code to ALLOW only SELECTED TABS
$app_id = "";
if(isset($_SESSION['application_ref_id'])){
   $app_id = $_SESSION['application_ref_id'];
   // echo $app_id;
}

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



$appInformation = getAllAppInformation($mycon, $app_id);
// pre($appInformation);

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
      <a href="add-new-applications.php?new_application=<?php echo 1;?>" class="btn text-light" style="background-color: #920706;">New</a>
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
                              <li <?php echo is_visble_verification_tab_multi(array('1', '5'), $type_of_verification_array); ?>><a href="address.php"> Address Details</a></li>
                              <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?>><a href="education.php?appid=<?php echo $app_id; ?>">Educational Details</a></li>
                              <li  <?php echo is_visble_verification_tab(5, $type_of_verification_array); ?>><a href="identity_verif.php">Identity Verification</a></li>
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
                                <li  class="active" <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="global_sanctions.php">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                                  <li  <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="national_sex_registry.php">National Sex Offender Registry (NSO)</a></li>
                              <li  <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="company_verifaction.php">Company Verification</a></li>
                           </ul>
                           <div class="step-tab-panel" id="tab2">
                              <h3 class="employer_one">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</h3>
                              <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
                              <form method="post" id="frmInfo_global_sanctions" enctype="multipart/form-data">
                                 <input type="hidden" name="form_type" value="global_sanctions">
                                 <div class="row">
                                 

                                    <div class="col-md-6">
                                    <?php $sql= "select * from employee_global_sanctions where application_id =  '".$app_id."'";
                                             $result = mysqli_query($mycon, $sql);
                                            $row24= mysqli_fetch_assoc($result);
                                          //   echo  $sql ; //die('dfgdgdf');
                                     ?>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">First Name</label>
                                          <div>
                                             <input type="text" name="firstname" id="firstname" value="<?php echo $appInformation['personalData']['0']['firstName']; ?>" placeholder="Enter First Name" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Last Name</label>
                                          <div><input type="text" name="lastname" id="lastname" value="<?php echo $appInformation['personalData']['0']['lastName']; ?>" placeholder="Enter Last Name" data-required="1" class="form-control"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Phone Number</label>
                                          <div>
                                             <input type="number" name="phone" id="phone" placeholder="Enter Phone Number" value="<?php echo $appInformation['personalData']['0']['phoneNo']; ?>" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label  input_hdr">Alternate Contact Number </label>
                                          <div>
                                             <input type="number" name="alternate_contact_no" id="alternate_contact_no" value="<?php echo $appInformation['personalData']['0']['alternateContact']; ?>" data-required="1" placeholder="Enter Alternate Contact Number" class="form-control">
                                          </div>
                                       </div>
                                      
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Middle Name</label>
                                          <div>
                                             <input type="text" value="<?php echo $appInformation['personalData']['0']['middleName']; ?>" name="middlename" id="middlename" placeholder="Enter Middle Name" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Father Name</label>
                                          <div>
                                             <input type="text" name="fathername" id="fathername" value="<?php echo $appInformation['personalData']['0']['fatherName']; ?>" placeholder="Father Name" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr ">D.O.B
                                          </label>
                                          <div>
                                             <input type="date" name="dob" id="dob" aria-describedby="" value="<?php echo $appInformation['personalData']['0']['dob']; ?>" placeholder="dd-mm-yyyy" class="form-control" style="width: 220px;">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="control-label input_hdr">Email Id </label>
                                          <div>
                                             <input value="<?php echo $appInformation['personalData']['0']['email']; ?>" type="email" name="email" id="email" placeholder="Enter Email Address" data-required="1" class="form-control">
                                          </div>
                                       </div>
                                        <div class="form-group">
                                             <label class="input_hdr" for="select">Verification Mode</label>
                                             <select name="verification_mode" id="verification_mode" required="" class="form-control">
                                                <option value="">Select</option>
                                                <option <?php echo ($row24['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                <option <?php echo ($row24['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                <option <?php echo ($row24['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                             </select>
                                          </div>
                                       <!---Start upload documents code--->
                                       <br /><br />
                                       <p style="color:#c51b1b;">Upload Documents</p>
                                       <div class="form-group">
                                          <label class="input_hdr" for="select">Select Document</label>
                                          <select name="doc_type" class="form-control">
                                             <option value="Pan card">Pan card </option>
                                             <option value="Voter card">Voter card</option>
                                             <option value="driver_licence">Driver Licence</option>
                                             <option value="other">Other</option>
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <!--   <label class="control-label">Telephone
                                       <span aria-required="true" class="required"> * </span></label>  -->
                                          <div><input type="text" name="doc_no" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                       </div>
                                       <div class="form-group">
                                          <div>
                                             <input type="file" name="doc[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                          </div>
                                       </div>
                                       <!---End upload documents code--->
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
                             <?php  //} ?>
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
                        <div class="step-footer"></div>
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
<script type="text/javascript" src="js/personal_info_disabled.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
      $('ul li a').click(function() {
         $('li a').removeClass("active");  
         $(this).addClass("active");
      });
   });
</script>
