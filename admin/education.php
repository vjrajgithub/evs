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
   if(isset($_SESSION['application_ref_id'])){
   $app_id = $_SESSION['application_ref_id'];
   // echo $app_id; die;
   }
   
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
                              <li <?php echo is_visble_verification_tab_multi(array('1','5'), $type_of_verification_array); ?> ><a href="address.php"> Address Details</a></li>
                              <li <?php echo is_visble_verification_tab(4, $type_of_verification_array); ?> class="active" ><a href="education.php">Educational Details</a></li>
                              <li <?php echo is_visble_verification_tab(8, $type_of_verification_array); ?> ><a href="employment.php">Employment Details</a></li>
                              <li <?php echo is_visble_verification_tab(6, $type_of_verification_array); ?> ><a href="police.php">Police Verification</a></li>
                              <li <?php echo is_visble_verification_tab(7, $type_of_verification_array); ?> ><a href="reference.php">Reference Details</a></li>
                              <li <?php echo is_visble_verification_tab(9, $type_of_verification_array); ?> ><a href="bank.php">Bank Details</a></li>
                              <li <?php echo is_visble_verification_tab(10, $type_of_verification_array); ?> ><a href="cibil.php">CIBIL Details</a></li>
                              <li  <?php echo is_visble_verification_tab(11, $type_of_verification_array); ?>><a href="court_record.php">Court Records Check</a></li>
                              <li  <?php echo is_visble_verification_tab(12, $type_of_verification_array); ?>><a href="drug_test.php">Drug Test Screening</a></li>
                              <li  <?php echo is_visble_verification_tab(15, $type_of_verification_array); ?>><a href="global_base_check.php">Global data base check</a></li>
                              <li  <?php echo is_visble_verification_tab(16, $type_of_verification_array); ?>><a href="socal_security_number.php">Social Security Number (SSN) Verification</a></li>
                              <li  <?php echo is_visble_verification_tab(17, $type_of_verification_array); ?>><a href="criminal_background_check.php">Criminal background check (Federal and Local)</a></li>
                              <li  <?php echo is_visble_verification_tab(18, $type_of_verification_array); ?>><a href="global_sanctions.php">Global Sanctions (OFAC,OIG,SAM,GSA,DEA and FDA)</a></li>
                              <li  <?php echo is_visble_verification_tab(19, $type_of_verification_array); ?>><a href="national_sex_registry.php">National Sex Offender Registry (NSO)</a></li>
                              <li  <?php echo is_visble_verification_tab(20, $type_of_verification_array); ?>><a href="company_verifaction.php">Company Verification</a></li>
                           </ul>
                           <div class="step-tab-panel" id="tab4">
                              <h3 class="employer_one">Educational Details</h3>
                              <form name="frmLogin" id="frmLogin" method="post" enctype="multipart/form-data">
                                 <input type="hidden" name="form_type" value="education">
                                 <div>
                                    <div class="alert alert-success alert-dismissable" id="edu_success_message" style="display :none">
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                       <div ></div>
                                    </div>
                                    <!--<p id="success_message"></p>-->
                                    <!-- vertical tab -->
                                    <div class="vertical_tabs_views" style="height: 601px;">
                                       <div class="tabordion">
                                          <section id="section1">
                                             <?php
                                                $sql= "select * from employee_education_tbl where application_id =  '".$app_id."' and order_no = 1";
                                                        $result = mysqli_query($mycon, $sql);
                                                       $row24= mysqli_fetch_assoc($result);
                                                       //echo  $sql ; //die('dfgdgdf');
                                                ?>
                                             <input type="radio" name="sections" id="option1" checked>
                                             <label class="labls" for="option1">High School (10th)
                                             </label>
                                             <article>
                                                <h4 class="employer_one">High School (10th)</h4>
                                                <input type="hidden" name="high_school" id="high_school" value="High School" data-required="1" class="form-control">
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      School / College Name (with location)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="high_school_school" value="<?php echo $appInformation['eduData']['0']['college_institute'] ?>" id="high_school_school" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Roll number / Reg. Number
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="number" name="high_school_roll_number" value="<?php echo $appInformation['eduData']['0']['roll_no'] ?>" id="high_school_roll_number" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Year Of passing
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input minlength="4" maxlength="4" type="number" name="high_school_passing_year" value="<?php echo $appInformation['eduData']['0']['passing_year'] ?>" id="high_school_passing_year" data-required="1"  class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label ">
                                                      Board / University
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="Text" name="high_school_board" value="<?php echo $appInformation['eduData']['0']['university_board'] ?>" id="high_school_board" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="input_hdr" for="select">Verification Mode</label>
                                                   <select name="verification_mode" id="verification_mode" required="" class="form-control">
                                                      <option value="">Select</option>
                                                      <option <?php echo ($appInformation['eduData']['0']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                      <option <?php echo ($appInformation['eduData']['0']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                      <option <?php echo ($appInformation['eduData']['0']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                                   </select>
                                                </div>
                                                <!---Start upload documents code--->
                                                <br/><br />
                                                <p style="color:#c51b1b;">Upload Documents</p>
                                                <div class="form-group">
                                                   <div><input type="text" name="high_school_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                      <input type="file" name="high_school_doc_file[]" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                                   </div>
                                                </div>
                                                <!---End upload documents code--->
                                             </article>
                                          </section>
                                          <section id="section2">
                                             <?php 
                                                $sql = "select * from employee_education_tbl where application_id =  '".$app_id."' and order_no = 2";
                                                         $result = mysqli_query($mycon, $sql);
                                                        $row24= mysqli_fetch_assoc($result);
                                                        //echo  $sql ; //die('dfgdgdf');
                                                 ?>
                                             <input type="radio" name="sections" id="option2">
                                             <label class="labls" for="option2">Intermediate (12th)
                                             </label>
                                             <article>
                                                <h4 class="employer_one">Intermediate (12th) </h4>
                                                <input type="hidden" name="intermediate" id="intermediate" value="Intermediate" data-required="1" class="form-control">
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      School / College Name (with location)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="intermediate_school" value="<?php echo $appInformation['eduData']['1']['college_institute'] ?>" id="intermediate_school" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Roll number / Reg. Number
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="number" name="intermediate_roll_no" value="<?php echo $appInformation['eduData']['1']['roll_no'] ?>" id="intermediate_roll_no" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Year Of passing
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input minlength="4" maxlength="4" type="number" name="intermediate_passing_year" value="<?php echo $appInformation['eduData']['1']['passing_year'] ?>" id="intermediate_passing_year"  class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Board / University
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="Text" name="intermediate_board" value="<?php echo $appInformation['eduData']['1']['university_board']; ?>" id="intermediate_board" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="input_hdr" for="select">Verification Mode</label>
                                                   <select name="verification_mode_inter" id="verification_mode" required="" class="form-control">
                                                      <option value="">Select</option>
                                                      <option <?php echo ($appInformation['eduData']['1']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                      <option <?php echo ($appInformation['eduData']['1']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                      <option <?php echo ($appInformation['eduData']['1']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                                   </select>
                                                </div>
                                                <!---Start upload documents code--->
                                                <br/><br />
                                                <p style="color:#c51b1b;">Upload Documents</p>
                                                <div class="form-group">
                                                   <div><input type="text" name="intermediate_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                      <input type="file" name="intermediate_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                                   </div>
                                                </div>
                                                <!---End upload documents code--->
                                             </article>
                                          </section>
                                          <section id="section3">
                                             <?php
                                                $sql= "select * from employee_education_tbl where application_id =  '".$app_id."' and order_no = 3";
                                                         $result = mysqli_query($mycon, $sql);
                                                        $row24= mysqli_fetch_assoc($result);
                                                        //echo  $sql ; //die('dfgdgdf');
                                                 ?>
                                             <input type="radio" name="sections" id="option3">
                                             <label class="labls" for="option3">Degree Graduation
                                             </label>
                                             <article>
                                                <h4 class="employer_one">Graduation Degree </h4>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Degree (Please Specify)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="graduation_degree" value="<?php echo $appInformation['eduData']['2']['course'] ?>" id="graduation_degree" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      School / College Name (with location)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="graduation_school" value="<?php echo $appInformation['eduData']['2']['college_institute'] ?>" id="graduation_school" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Roll number / Reg. Number
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="graduation_roll_no" value="<?php echo $appInformation['eduData']['2']['roll_no'] ?>" id="graduation_roll_no" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Year Of passing
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input minlength="4" maxlength="4" type="number" name="graduation_passing_year"  id="graduation_passing_year" value="<?php echo $appInformation['eduData']['2']['passing_year']; ?>" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Board / University
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="graduation_board" value="<?php echo $appInformation['eduData']['2']['university_board'] ?>" id="graduation_board" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="input_hdr" for="select">Verification Mode</label>
                                                   <select name="verification_mode_grad" id="verification_mode" required="" class="form-control">
                                                      <option value="">Select</option>
                                                      <option <?php echo ($appInformation['eduData']['2']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                      <option <?php echo ($appInformation['eduData']['2']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                      <option <?php echo ($appInformation['eduData']['2']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                                   </select>
                                                </div>
                                                <!---Start upload documents code--->
                                                
                                                <p style="color:#c51b1b;">Upload Documents</p>
                                                <div class="form-group">
                                                   <div><input type="text" name="graduation_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                      <input type="file" name="graduation_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                                   </div>
                                                </div>
                                                <!---End upload documents code--->
                                             </article>
                                          </section>
                                          <section id="section4">
                                             <?php 
                                                $sql= "select * from employee_education_tbl where application_id =  '".$app_id."' and order_no = 4";
                                                         $result = mysqli_query($mycon, $sql);
                                                        $row24= mysqli_fetch_assoc($result);
                                                      //   echo  $sql ; //die('dfgdgdf');
                                                 ?>
                                             <input type="radio" name="sections" id="option4">
                                             <label class="labls" for="option4">Post Graduation</label>
                                             <article>
                                                <h4 class="employer_one">Post Graduation</h4>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Degree (Please Specify)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="post_graduation_degree" value="<?php echo $appInformation['eduData']['3']['course']; ?>"  id="post_graduation_degree" data-required="1" class="form-control" placeholder="">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      School / College Name (with location)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="post_graduation_school" value="<?php echo $appInformation['eduData']['3']['college_institute'] ?>" id="post_graduation_school" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Roll number / Reg. Number
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="Number" name="post_graduation_roll_no" value="<?php echo $appInformation['eduData']['3']['roll_no'] ?>" id="post_graduation_roll_no" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Year Of passing
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input minlength="4" maxlength="4" type="Number" name="post_graduation_passing_year"  id="post_graduation_passing_year" value="<?php echo $appInformation['eduData']['3']['passing_year'] ?>" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Board / University
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="Text" name="post_graduation_board" value="<?php echo $appInformation['eduData']['3']['university_board'] ?>" id="post_graduation_board" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="input_hdr" for="select">Verification Mode</label>
                                                   <select name="verification_mode_pg" id="verification_mode" required="" class="form-control">
                                                      <option value="">Select</option>
                                                      <option <?php echo ($appInformation['eduData']['3']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                      <option <?php echo ($appInformation['eduData']['3']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                      <option <?php echo ($appInformation['eduData']['3']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                                   </select>
                                                </div>
                                                <!---Start upload documents code--->
                                                
                                                <p style="color:#c51b1b;">Upload Documents</p>
                                                <div class="form-group">
                                                   <div><input type="text" name="post_graduation_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                      <input type="file" name="post_graduation_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                                   </div>
                                                </div>
                                                <!---End upload documents code--->
                                             </article>
                                          </section>
                                          <section id="section5">
                                             <?php $sql_dip= "SELECT * from employee_education_tbl WHERE application_id = '".$app_id."' AND order_no = 5 ORDER BY id DESC LIMIT 1
                                                ";
                                                                                             $result_dip = mysqli_query($mycon, $sql_dip);
                                                                                            $row24_dip= mysqli_fetch_assoc($result_dip);
                                                                                            //echo  $sql ; //die('dfgdgdf');
                                                                                     ?>
                                             <input type="radio" name="sections" id="option5">
                                             <label class="labls" for="option5">If Any Other Qualification</label>
                                             <article>
                                                <h4 class="employer_one">If Any Other Qualification</h4>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Degree/ Diploma/ Professional Courses
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="diploma" value="<?php echo $appInformation['eduData']['4']['course'] ?>" id="diploma" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group" >
                                                   <label class="control-label">
                                                      School / College Name (with location)
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="text" name="diploma_school" value="<?php echo $appInformation['eduData']['4']['college_institute'] ?>" id="diploma_school" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Roll number / Reg. Number
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input value="<?php echo $appInformation['eduData']['4']['roll_no'] ?>" type="Number" name="diploma_roll_no" id="diploma_roll_no" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Year Of passing
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input minlength="4" maxlength="4" type="Number" value="<?php echo $appInformation['eduData']['4']['passing_year'] ?>"   name="diploma_passing_year"  id="diploma_passing_year" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label">
                                                      Board / University
                                                      <!-- <span class="required" aria-required="true"> * </span> -->
                                                   </label>
                                                   <div>
                                                      <input type="Text" value="<?php echo $appInformation['eduData']['4']['university_board'] ?>" name="diploma_board" id="diploma_board" data-required="1" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="input_hdr" for="select">Verification Mode</label>
                                                   <select name="verification_mode_diploma" id="verification_mode" required="" class="form-control">
                                                      <option value="">Select</option>
                                                      <option <?php echo ($appInformation['eduData']['4']['verification_mode'] == "both") ? "selected" : "" ?>  value="both">Both</option>
                                                      <option <?php echo ($appInformation['eduData']['4']['verification_mode'] == "verbally") ? "selected" : "" ?> value="verbally">Verbal</option>
                                                      <option <?php echo ($appInformation['eduData']['4']['verification_mode'] == "written") ? "selected" : "" ?> value="written">Written</option>
                                                   </select>
                                                </div>
                                                <!---Start upload documents code--->
                                                
                                                <p style="color:#c51b1b;">Upload Documents</p>
                                                <div class="form-group">
                                                   <div><input type="text" name="diploma_doc_number" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                                                </div>
                                                <div class="form-group">
                                                   <div>
                                                      <input type="file" name="diploma_doc_file[]" id="intermediate_doc_file" aria-describedby="" class="form-control" style="width: 220px;" multiple>
                                                   </div>
                                                </div>
                                                <!---End upload documents code--->
                                             </article>
                                          </section>
                                       </div>
                                    </div>
                                    <!-- vertical tab -->
                                 </div><br>
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