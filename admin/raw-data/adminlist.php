<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$delete = $_GET['delete'];
if ($delete != '') {
  $sql_query_delete = "Delete FROM `users` where id='" . $delete . "' ";
  mysqli_query($mycon, $sql_query_delete);
}

$edit = $_GET['update'];
if ($edit != '') {
  $sql_query_update = "Update `users` where id='" . $edit . "' ";
  mysqli_query($mycon, $sql_query_update);
}

$logout = $_GET['logout'];
if ($logout != '') {
  $sql_query_logout = "update `users` set is_login = 0 WHERE id='" . $logout . "'";
  mysqli_query($mycon, $sql_query_logout);
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
    $clientName = "<td>";
    $clientsArray = explode(',', $clientsString);
    for ($i = 0; $i < count($clientsArray); $i++) {
      $clientName .= get_customer($mycon, $clientsArray[$i]) . " <br>";
    }
    return $clientName .= "</td>";
  } else {
    return $clientName = "<td> NA </td>";
  }
}

function get_warehouse($mycon, $org_id) {
  $sql_query = "SELECT loc_name FROM `tbl_location` WHERE loc_id='" . $org_id . "'";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
    $k = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $loc = $row['loc_name'];
    }
  }
  return $loc;
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
        <meta content="Seabird Employee Development Matrix Software" name="description" />
        <meta content="Vikas Singh" name="author" />
        <?php include 'shared/header.php'; ?>
        <script>

          $(".js-example-tags").select2({
              tags: true
          });
        </script>


    </head>
    <!-- END HEAD -->
    <style>
        .form-group.form-md-line-input {
            position: relative;
            margin: 0 5px -2px !important;
            padding-top: 19px !important;
        }
        .requestwizard-modal{
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }
        .requestwizard-step p {
            margin-top: 10px;
        }

        .requestwizard-row {
            display: table-row;
        }

        .requestwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .requestwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .requestwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;
        }

        .requestwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .poke{
            background-color: #2b3643;
            color:#fff;
        }
        .table thead tr th{
            font-size:11px !important;
        }
        .table td{
            font-size:11px !important;
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
        .table_hdr h3 {
            text-align: center;
            font-size: 20px;
            font-weight: 500;
        }
    </style>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-md">

        <div class="page-wrapper">
            <?php include 'top_menu.php'; ?>
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <?php include 'sidebar.php'; ?>

                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="min-height: 850px;">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <?php if ($userRole == 1) { ?>
                                              <a href="register.php">
                                                  <button style="background-color:#63B54F!important; border-color:#63B54F" type="button" class="btn btn-info">Add New<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                              </a>
                                            <?php } ?>
                                        </div>

                                        <div class="actions">

                                            <div class="btn-group">
                                                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                    <i class="fa fa-share"></i>
                                                    <span class="hidden-xs">  Tools </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                                    <li>
                                                        <a href="javascript:;" data-action="0" class="tool-action">
                                                            <i class="icon-printer"></i> Print</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="1" class="tool-action">
                                                            <i class="icon-check"></i> Copy</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="2" class="tool-action">
                                                            <i class="icon-doc"></i> PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="3" class="tool-action">
                                                            <i class="icon-paper-clip"></i> Excel</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="4" class="tool-action">
                                                            <i class="icon-cloud-upload"></i> CSV</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-container matrix_data_table">
                                            <div class="table_hdr">
                                                <h3>User List</h3>
                                            </div>
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="sample_3" role="grid" aria-describedby="sample_3_info" style="width:100%">
                                                <thead>
                                                    <tr class="poke">
                                                        <th>Username</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Department</th>
                                                        <th>Customer</th>
                                                        <th>WH Location</th>
                                                        <th>Contact No.</th>
                                                        <th>Email</th>
                                                        <th>Log-In Status</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_query = "SELECT * FROM `users` WHERE role != 1";
                                                    //echo $sql_query;
                                                    $result = mysqli_query($mycon, $sql_query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <tr>
                                                            <td> <?php echo $row['username']; ?> </td>
                                                            <td> <?php echo $row['first_name']; ?> </td>
                                                            <td> <?php echo $row['last_name']; ?> </td>
                                                            <td> <?php echo $row['department']; ?> </td>
                                                            <?php echo get_customerarray($mycon, $row['client_id']); ?>
                                                            <td> <?php echo get_warehouse($mycon, $row['org_id']); ?> </td>
                                                            <td> <?php echo $row['contact']; ?> </td>
                                                            <td> <?php echo $row['email']; ?> </td>
                                                            <td> <?php
                                                                if ($row['is_login'] != 0) {
                                                                  echo 'Lodded-In';
                                                                } else {
                                                                  echo 'Logged-out';
                                                                }
                                                                ?> </td>
                                                            <td> <?php
                                                                if ($row['active']) {
                                                                  echo 'Active';
                                                                } else {
                                                                  echo 'In-active';
                                                                }
                                                                ?> </td>
                                                            <td>
                                                                <?php if ($row['is_login'] != 0) { ?>
                                                                  <a href="adminlist.php?logout=<?php echo $row['id'] ?>"><span data-tooltip title="Logout User" class="cursor">Log out</span></a>

                                                                  |
                                                                <?php } ?>
                                                                <a onclick="return confirm('Are you sure?')" href="adminlist.php?delete=<?php echo $row['id'] ?>"><span data-tooltip title="Delete" class="cursor"><i class="fa fa-trash" aria-hidden="true" style="color:orange; font-size:17px;    margin-left: 12px; font-weight:bold;"></i></span></a>
                                                                <a href="edit-admin.php?adminid=<?php echo $row['id'] ?>"><span data-tooltip title="EDIT" class="cursor"><i class="fa fa-edit" aria-hidden="true" style="color:orange; font-size:17px;    margin-left: 12px; font-weight:bold;"></i></span></a>
                                                            </td>

                                                        </tr>

                                                        <?php
                                                      }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <!-- End: life time stats -->
                            </div>
                        </div>

                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->

            </div>
            <!-- END CONTAINER -->

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal12233" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content" style="margin-top:12em;">
                    <div class="modal-header">
                        <h3 class="modal-title" style="text-align:center; font-size:16px; color:red;" id="lineModalLabel"></h3>
                        <i class="fa fa-times" data-dismiss="modal" aria-hidden="true" style="color:red;font-size:25px; float:right;"></i>

                    </div>
                    <div class="modal-body" id="vikas123">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"  style="margin-top: 21px; visibility:hidden;">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
        <script src="../assets/pages/scripts/table-datatables-buttons.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <!--Js for session expire-->
       <!-- <script src="../assets/session-expire.js" type="text/javascript"></script> -->
        <?php include 'footer.php'; ?>

        <!-- END PAGE LEVEL SCRIPTS -->

        <script type="text/javascript">
                                                                  $(document).ready(function () {
                                                                      $('[data-toggle="tooltip"]').tooltip();
                                                                  });


        </script>
    </body>

</html>