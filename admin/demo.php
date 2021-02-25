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
                    <li><a href="#tab6">Police Verification Details</a></li>
                    <li><a href="#tab7">Reference Details</a></li>
                  </ul>
                  <form class="cmxform" id="commentForm" method="get" action="">
                    <fieldset>
                      <legend>Please provide your name, email address (won't be published) and a comment</legend>
                      <p>
                        <label for="cname">Name (required, at least 2 characters)</label>
                        <input id="name" name="name"  type="text" >
                      </p>

                      <p>
                        <input class="submit" type="submit" value="Submit">
                      </p>
                    </fieldset>
                  </form>


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

<!--validation end-->

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

<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script>
<script type="text/javascript" src="../assets/js/page/application.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script type="text/javascript" src="../assets/js/custom.js"></script>

<script type="text/javascript">
  $(".chosen").chosen();
</script>
<!--================= cdn link datatable start===================-->

</body>
</html>