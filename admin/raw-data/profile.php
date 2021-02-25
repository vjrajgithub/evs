<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

function get_customer($mycon, $client_id) {
  $sql_query = "SELECT client FROM `tbl_clients` WHERE id='" . $client_id . "'";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $customer = $row['client'];
    }
  }
  return $customer;
}

function get_customerarray($mycon, $clientsString) {
  if (isset($clientsString) && !empty($clientsString)) {
    $clientName = "";
    $clientsArray = explode(',', $clientsString);
    for ($i = 0; $i < count($clientsArray); $i++) {
      $clientName .= get_customer($mycon, $clientsArray[$i]) . ", ";
    }
    return $clientName .= "";
  } else {
    return $clientName = "NA";
  }
}

function getOrgNameById($mycon, $org_id) {
  $sql_query = "SELECT loc_name FROM `tbl_location` WHERE loc_id='" . $org_id . "'";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $location = $row['loc_name'];
    }
  }
  return $location;
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
  $contact = $_POST['contact'];
  $email = $_POST['email'];

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

$locationquery = "select * from  tbl_location  where isDeleted = '0'";
$locationResult = mysqli_query($mycon, $locationquery);

function mysqli_fetch_alll($qslObj, $s) {
  while ($row = $qslObj->fetch_assoc()) {
    $dataArray[] = $row;
  }
  return $dataArray;
}

//echo '<pre>';
//print_r($userdata);
//die;
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

        margin: 0 20px 20px 0;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
      }
      .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        width: 110px;
        vertical-align: middle;
      }
      #profile_edit .form-group.row label {
        border-bottom: 1px solid #cccccc42 !important;
        padding: 10px;
        font-size: 14px;
        font-weight: 600;
        /*display: inline-block;*/
      }
      .profile_hdr {
        font-size: 21px;
        margin-bottom: 10px;
        font-weight: 500;
        text-align: center;
        padding-top: 20px;
      }
      #profile_edit .form-group.row .col-lg-9 div {
        border-bottom: 1px solid #cccccc42 !important;
        padding: 10px;

      }
      img.mx-auto.img-fluid.img-circle.d-block {
        width: 48%;
      }

      }
      @media (max-width: 991px) {
        .rofile_phoptp img {
          width:20%;

        }
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
          <div class="page-content" style="min-height: 868px">

            <div class="row">
              <div class="col-md-12">
              </div>

              <!DOCTYPE html>
              <html>
                <head>
                  <title>Profile Information</title>
                </head>
                <body>

                  <h1 class="profile_hdr" >Profile Information</h1>




                  <!-- profile page -->
                  <div class="container">
                    <div style="text-align: right;">
                      <a href="dashboard.php">
                        <button style="border: 0;
                                padding: 5px 10px;
                                margin-bottom: 18px;" type="button" class="btn-success">Back</button>
                      </a>
                    </div>
                    <div class="row my-2">
                      <div class="col-lg-3 order-lg-1 profile_phoptp" style="text-align: right;">
                        <img src="../assets/layouts/layout/img/avatar6.png" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                        <!-- <h6 class="mt-2">Upload a different photo</h6> -->
                        <!--  <label class="custom-file">
                             <input type="file" id="file" class="custom-file-input">
                             <span class="custom-file-control">Choose file</span>
                         </label> -->
                      </div>
                      <div class="col-lg-9 order-lg-2">
                        <ul class="nav nav-tabs">
                          <!-- <li class="nav-item">
                              <a href="" data-target="#profile" data-toggle="tab" class="nav-link">Profile</a>
                          </li> -->
                          <!--   <li class="nav-item">
                                <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#edit" data-toggle="tab" class="nav-link active show">Edit</a>
                            </li> -->
                        </ul>
                        <div class="tab-content py-4">

                          <div class="tab-pane active show" id="profile_edit">

                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">User Name</label>
                              <div class="col-lg-9 ">
                                <div><?php echo $userdata['username'] ?></div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">First name</label>
                              <div class="col-lg-9">
                                <div ><?php echo $userdata['first_name'] ?></div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                              <div class="col-lg-9">
                                <div > &nbsp;<?php echo $userdata['last_name'] ?></div>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Department</label>
                              <div class="col-lg-9">
                                <div> &nbsp;<?php echo $userdata['department'] ?></div>
                              </div>
                            </div>
<?php if ($userdata['role'] == 2 || $userdata['role'] == 3) { ?>
                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">customer</label>
                                <div class="col-lg-9">
                                  <div> &nbsp; <?php echo get_customerarray($mycon, $userdata['client_id']); ?></div>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Ware House Location</label>
                                <div class="col-lg-9">
                                  <div> &nbsp;<?php echo getOrgNameById($mycon, $userdata['org_id']) ?></div>
                                </div>
                              </div>
<?php } ?>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Contact No.</label>
                              <div class="col-lg-9">
                                <div> &nbsp;<?php echo $userdata['contact'] ?></div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label form-control-label">Email</label>
                              <div class="col-lg-9">
                                <div> &nbsp;<?php echo $userdata['email'] ?></div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--page_content end ke niche footer lagna h-->
<?php include 'footer.php'; ?>
    <!-- profile page -->

  </body>
  <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</html>


