<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: login.php');
}

function changePassworddata($id, $currentpassword, $username, $mycon) {
  $total = 0;
  $password = md5($currentpassword);
  $sql = "SELECT * FROM users WHERE password = '$password' AND username = '$username' AND id = '$id'";
  $result = mysqli_query($mycon, $sql);
  $total = mysqli_num_rows($result);
  return $total;
}

$errorMsg = array();

if ($_POST) {
  $currentpassword = $_POST['currentpassword'];
  $newpassword = $_POST['password'];
  $conformpassword = $_POST['conformpassword'];

  $is_valid_data = changePassworddata($userdata['id'], $currentpassword, $userdata['username'], $mycon);

  //echo $is_valid_data;
  //die;
  if ($currentpassword == "") {
    $errorMsg[] = "<span>Current Password field is required </span><br />";
  }

  if ($newpassword == "") {
    $errorMsg[] = "<span>New Password field is required </span><br />";
  }

  if ($conformpassword == "") {
    $errorMsg[] = "<span>Conform Password field is required </span><br />";
  }
  if ($currentpassword && $newpassword && $conformpassword) {
    if ($is_valid_data > 0) {

      if ($newpassword != $conformpassword) {
        $errorMsg[] = "<span>New password does not match confirm password </span><br />";
      } else {
        if ($is_valid_data > 0) {
          $passwordmd5 = md5($newpassword);
          $usrIds = $userdata['id'];
          $update = "UPDATE users SET password = '$passwordmd5' WHERE id = '$usrIds'";
          $result123 = mysqli_query($mycon, $update);
          if ($result123) {
            $errorMsg[] = "Successfully updated";
          } else {
            $errorMsg[] = "Error while updating the information <br />";
          }
        } else {
          $errorMsg[] = "Error while updating the information <br />";
        }
      }
    } else {
      $errorMsg[] = "Current Password is incorrect <br />";
      //echo "currentpassword-" . $currentpassword . "<br/>newpassword-" . $newpassword . "<br/>conformpassword-" . $conformpassword;
      //echo $errorMsg . "<br/>";
      //die('check-1');
    }
  }
}
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
        <meta content="Employee Development Matrix Software" name="description" />
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
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <style type="text/css">


            .pokman{
                color: #555;
                background-color: #fff;
                border: 1px solid #ddd;
                border-bottom-color: transparent;
                cursor: default;
            }

            .table thead tr th{
                font-size:11px !important;
            }

            .table td{
                font-size:11px !important;
            }

            #menu ul li.selected {
                background: #910000;
                color:#FFFFFF;
            }
            #menu ul {
                margin: 0;
                padding: 25px 0 0 20px;
                list-style: none;
                line-height: normal;
            }
            #menu li {
                display: block;
                float: left;
                background: #524949;
                border-radius: 5px;
                margin-right: 7px;
            }
            #menu a {
                display: block;
                float: left;
                margin-right: 17px;
                padding: 5px 12px;
                text-decoration: none;
                font: 15px Georgia, "Times New Roman", Times, serif;
                color: #FFFFFF;
            }
            #menu a:hover {
                text-decoration: underline;
                background: #910000;
                color:#FFFFFF;
            }
            #menu a:active {
                background: #910000;
                color:black;
            }
            .nav-tabs{
                border-bottom:none;
                margin-top: 22px;
            }
            .nav>li>a:focus, .nav>li>a:hover{
                background:#2b3643;
                color:white;
                border-radius:24px;
            }
            .tabbable-line>.nav-tabs>li.active {
                border-bottom: 4px solid rgb(238, 50, 57) !important;
            }
            .tabbable-line>.nav-tabs>li.open, .tabbable-line>.nav-tabs>li:hover {
                border-bottom:4px solid rgb(40, 42, 44) !important;
            }

            .portlet.light.portlet-fit>.portlet-title {
                padding-top:0 !important;
            }
            #sample_3_wrapper table th {
                text-align: center;
                background-color: #63B54F !important;
                color: #fff;
                font-size: 13px;
            }
            p.details_table {
                text-align: center;
            }
            .change_passwordN {
                padding-top: 30px;
            }
            .pass_reqd {
                text-align: center;
                max-width: 50%;
                width: 100%;
                display: inline-block;
                line-height: 19px;
                color: red;
            }
            /*.matrix_data_table {
               overflow-x: scroll;
            }*/
        </style>
    </head>
    <!-- END HEAD -->
    <link href="css/tooltip.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
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
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <?php include 'sidebar.php'; ?>
                    <!-- END SIDEBAR -->
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content">


                            <div class="col-md-12">
                                <div class="container change_passwordN">
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <ul style="list-style-type:none;">
                                            <?php foreach ($errorMsg as $errors) { ?>
                                              <li class="pass_reqd"><?php echo $errors; ?></li>
                                            <?php } ?>
                                        </ul>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Current Password : </label>
                                                        <input type="password" class="form-control" name="currentpassword" autocomplete="off" placeholder="Current Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">New Password : </label>
                                                        <input type="password" name="password" class="form-control"  autocomplete="off" placeholder="New Password">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Conform Password : </label>
                                                        <input type="password" name="conformpassword" autocomplete="off" placeholder="Confrom Password" class="form-control"  >
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Change Password</button>

                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="text-align: left;" >
                                                    <a href="dashboard.php">
                                                        <button class="btn btn-primary" type="button">Back</button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->

                    </div>
                    <!-- END CONTAINER -->

                </div>

                <!-- BEGIN CORE PLUGINS -->
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
                <!-- END PAGE LEVEL SCRIPTS -->
                <!-- BEGIN THEME LAYOUT SCRIPTS -->
                <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
                <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
                <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
                <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

                <?php include'footer.php'; ?>
                <!-- END THEME LAYOUT SCRIPTS -->
                <script>
                  $(document).ready(function () {
                      $('#menu ul li a').click(function (ev) {
                          $('#menu ul li').removeClass('selected');
                          $(ev.currentTarget).parent('li').addClass('selected');
                      });
                  });
                </script>

                <script src="js/Tooltip.js" type="text/javascript"></script>
                </body>

                </html>