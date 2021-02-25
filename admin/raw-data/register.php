<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
// form is submitted
if ($_POST) {

  //print_r($_POST); die('check');

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  $client_id = $_POST['customer_name'];
  $wh_loc = $_POST['warehouse_location'];

  //print_r($wh_loc);die;

  if ($role == 2) {
    $department = 'WH Manager';
  } else if ($role == 3) {
    $department = 'WH Admin';
  } else if ($role == 4) {
    $department = 'EDM Admin';
  }

  if ($fname == "") {
    echo " * First Name is Required <br />";
  }

  if ($username == "") {
    echo " * Username is Required <br />";
  }

  if ($department == "") {
    echo " * Department is Required <br />";
  }

  if ($client_id == "") {
    echo " * Customer is Required <br />";
  }

  if ($wh_loc == "") {
    echo " * Warehouse/WH Location is Required <br />";
  }

  if ($password == "") {
    echo " * Password is Required <br />";
  }

  if ($cpassword == "") {
    echo " * Conform Password is Required <br />";
  }
  if ($fname && $lname && $username && $password && $cpassword) {

    if ($password == $cpassword) {
      if (userExists($username) === TRUE) {
        echo $_POST['username'] . " already exists !!";
      } else {
        if (registerUser() === TRUE) {
          //	echo "Successfully Registered <a href='adminlist.php'>Admin List</a>";
          header("Location: adminlist.php");
        } else {
          echo "Error";
        }
      }
    } else {
      echo " * Password does not match with Conform Password <br />";
    }
  }
}


$locationquery = "SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1";
$locationResult = mysqli_query($mycon, $locationquery);
if (mysqli_num_rows($locationResult) > 0) {

  while ($rowlocationResult = mysqli_fetch_assoc($locationResult)) {
    $locationArray = $rowlocationResult['emp_code'];
  }
}

function mysqli_fetch_alll($qslObj, $s) {
  while ($row = $qslObj->fetch_assoc()) {
    $dataArray[] = $row;
  }
  return $dataArray;
}

$locationquery = "select * from  tbl_organization  where isDeleted = '0'";
$locationResult = mysqli_query($mycon, $locationquery);

//  $customer_namequery = "select * from  tbl_clients";
//  $customer_nameResult = mysqli_query($mycon, $customer_namequery);
//  $customer_nameArray = mysqli_fetch_alll($customer_nameResult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <!--<![endif]-->
  <!-- BEGIN HEAD -->

  <head>
    <meta charset="utf-8" />
    <title><?php echo $header_project_name; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Seabird Employee Development Matrix Software" name="description" />
    <meta content="Vikas Singh" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="../assets/global/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon" />

    <style type="text/css">
      multi-input {
        width: 50%;
        margin: 0 20px 20px 0;
      }


    </style>
  </head>
  <!-- END HEAD -->

  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-md">
    <div class="page-wrapper">
      <!-- BEGIN HEADER -->
<?php include 'top_menu.php'; ?>
      <!-- END HEADER -->
      <!-- BEGIN HEADER & CONTENT DIVIDER -->
      <div class="clearfix"> </div>
      <!-- END HEADER & CONTENT DIVIDER -->
      <!-- BEGIN CONTAINER -->
      <div class="page-container">
        <!-- BEGIN SIDEBAR -->
<?php include 'sidebar.php'; ?>
        <!-- END SIDEBAR -->

        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
          <!-- BEGIN CONTENT BODY -->
          <div class="page-content">

            <div class="row">
              <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                  <div class="portlet-title">
                    <h3> Add New User </h3>
                    <!-- BEGIN LOGIN FORM -->
                    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
                      <h3 class="form-title font-green"><img src="assets/pages/img/logo.PNG" alt="" /></a></h3>
                      <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span> Seabird Logisolutions Admin Registration </span>

                      </div>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div>
                          <label for="fname">First Name: </label>
                          <input type="text" class="form-control" style="max-width:50%"  name="fname" placeholder="First Name" autocomplete="off" value="<?php
                          if ($_POST) {
                            echo $_POST['fname'];
                          }
                          ?>" />
                        </div>
                        <br />

                        <div>
                          <label for="lname">Last Name: </label>
                          <input type="text" name="lname" style="max-width:50%"  class="form-control" placeholder="Last Name" autocomplete="off" value="<?php
                          if ($_POST) {
                            echo $_POST['lname'];
                          }
                          ?>" />
                        </div>
                        <br />

                        <div>
                          <label for="department">Department: </label>
                          <select name="role" class="form-control" style="max-width:50%" >
                            <option value="2">WH Manager</option>
                            <option value="3">WH Admin</option>
                            <option value="4">EDM Admin</option>
                          </select>
                        </div>
                        <br />

                        <div>
                          <label for="username">Username: </label>
                          <input type="text" name="username" class="form-control" style="max-width:50%" placeholder="Username" autocomplete="off" value="<?php
                          if ($_POST) {
                            echo $_POST['username'];
                          }
                          ?>" />
                        </div>
                        <br />

                        <div>
                          <label for="password">Password: </label>
                          <input type="password" class="form-control"  style="max-width:50%" name="password" placeholder="Password" autocomplete="off" />
                        </div>
                        <br />

                        <div>
                          <label for="cpassword">Conform Password: </label>
                          <input type="password" name="cpassword"  style="max-width:50%" class="form-control" placeholder="Conform Password" autocomplete="off" />
                        </div>
                        <br />

                        <div>
                          <label for="warehouse_location">Warehouse Location: </label>
                          <select name="warehouse_location" class="form-control" style="max-width:50%">
                            <?php
                            $locationquery = "SELECT * FROM tbl_location WHERE isDeleted != '1'";
                            $locationResult = mysqli_query($mycon, $locationquery);
                            if (mysqli_num_rows($locationResult) > 0) {

                              while ($rowlocationResult = mysqli_fetch_assoc($locationResult)) {
                                ?>
                                <option value="<?php echo $rowlocationResult['loc_id']; ?>"><?php echo $rowlocationResult['loc_name']; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <br />

                        <div>

                          <label for="customer_name">Customer Name: </label>
                          <select class="chosen-select form-control" name="customer_name[]"  style="max-width:50%" id="client_id" multiple="multiple" >
                            <?php
                            $locationquery2 = "SELECT * FROM  tbl_clients";
                            $locationResult2 = mysqli_query($mycon, $locationquery2);
                            if (mysqli_num_rows($locationResult2) > 0) {

                              while ($rowlcustomer = mysqli_fetch_assoc($locationResult2)) {
                                ?>
                                <option value="<?php echo $rowlcustomer['id']; ?>"><?php echo $rowlcustomer['client']; ?></option>
                                <?php
                              }
                            }
                            ?>

                          </select>
                        </div>
                        <br/>

                        <div>
                          <button type="submit" class="btn btn-primary">Register</button>
                          <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>

                      </form>
                      <!-- custom_multiple_select start-->
                      <div>
                        <label>Customer name:</label> </br>
                        <multi-input  >
                          <input list="speakers" class="form-control" style="max-width: 50%; width:50%">
                          <datalist id="speakers">

                            <option value="Banquo"></option>
                            <option value="Bishop Stokesly of London"></option>
                            <option value="Caesar’s Second Watchman"></option>
                            <option value="Celia"></option>
                            <option value="Cleopatra"></option>
                            <option value="Dogberry"></option>
                            <option value="Falstaff"></option>
                            <option value="First Servant"></option>
                            <option value="Hamlet"></option>
                            <option value="Juliet"></option>
                            <option value="Macbeth"></option>
                          </datalist>
                        </multi-input>

                      </div>


                      <!-- custom_multiple_select end-->

                  </div>
                </div>

              </div>
              <!-- END CONTENT BODY -->
            </div>
          </div>
          <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

      </div>

      <!-- End Multiple Dropdown -->

    </div><!-- .wrap -->


    <!-- BEGIN CORE PLUGINS -->
    <script src="../assets/global/scripts/select2.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/multi-input.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <script>

      $("#client_id").select2({
        tags: true,
        placeholder: 'Select Clients',
        tokenSeparators: [',']
      });
    </script>
    <!--Js for session expire-->
   <!-- <script src="../assets/session-expire.js" type="text/javascript"></script> -->
<?php include 'footer.php'; ?>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript">

      const getButton = document.getElementById('get');
      const multiInput = document.querySelector('multi-input');
      const values = document.querySelector('#values');

      getButton.onclick = () => {
        if (multiInput.getValues().length > 0) {
          values.textContent = `Got ${multiInput.getValues().join(' and ')}!`;
        } else {
          values.textContent = 'Got noone  :`^(.';
        }
      }

      document.querySelector('input').focus();

    </script>

  </body>

</html>