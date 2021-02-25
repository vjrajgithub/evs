<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

$delete = $_GET['delete'];

$msg = '';
$msgcolor = "";

delete_all_dummy($mycon);

function delete_all_dummy($mycon) {
  $sql_query = "DELETE FROM tbl_emp_dept_matrix WHERE (delivery = '' OR delivery IS NULL) AND (part_number = '' OR part_number IS NULL)";
  $result = mysqli_query($mycon, $sql_query);
}

if ($delete != "") {
  //echo $delete; die('checkkkk');
  $sql = "DELETE FROM tbl_emp_dept_matrix WHERE fileRefno=" . $delete . "";
  if (mysqli_query($mycon, $sql)) {
    $msg = "Records were deleted successfully.";
    $msgcolor = "green";
  } else {
    $msg = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    $msgcolor = "Red";
  }
}

if ($_POST['fileRefno'] != '') {
  $srcitem = "AND fileRefno = " . $_POST['fileRefno'];
} else {
  $srcitem = '';
}

if ($_POST['todt'] != '') {
  $srcfrom = "AND created_at BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
} else {
  $srcfrom = '';
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
        <style>
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
            #sample_3_wrapper table th {
                text-align: center;
                background-color: #63B54F !important;
                color: #fff;
                font-size: 13px;
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

                            <div class="row">

                                <h2 style="font-size: 14px;font-weight: bold;text-align: center;color: #282A2C;margin-top: 48px;">Matrix Uploaded Files</h2>
                                <div class="col-md-12">
                                    <!-- Begin: life time stats -->
                                    <div class="portlet light portlet-fit portlet-datatable bordered">


                                        <div class="portlet-title">
                                            <div class="col-md-6">
                                                <?php if ($userRole == 2 || $userRole == 3) { ?>
                                                  <div class="tabbable-line">
                                                      <a href="upload-matrix-data.php">
                                                          <button type="button" class="btn btn-success">Upload File</button>
                                                      </a>
                                                  </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                            <!-- <div class="caption">
                                                 <i class="icon-settings font-green"></i>
                                                 <span class="caption-subject font-green sbold uppercase">Trigger Tools From Dropdown Menu</span>
                                             </div> -->
                                            <div class="col-md-2">
                                                <!--<ul class="nav nav-tabs">
                                                 <li class="active"><a  href="unloading_data.php">Vehicle Unloading</a></li>
                                                  <li><a  class="pokman" href="lr_unloading.php">LR Base</a></li>
                                                   </ul> -->
                                                <div id="header">
                                                    <div id="menu">
                                                        <ul class="current_page_itemm">
                                                            <!---<li class="current_page_item"><a href="unloading_data.php">Vehicle Unloading</a>

                                                             </li>
                                                             <li style="background:green !important;" ><a  href="lr_unloading.php">LR Base</a>

                                                                </li>-->

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="actions" style="    margin-top: -27px;">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">




                                                </div>
                                                <span data-tooltip title="Export" class="cursor"><div class="btn-group">
                                                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                            <i class="fa fa-share"></i>
                                                            <span class="hidden-xs">Tools</span>
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
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="home" class="portlet-body ">

                                        <!--***** Tab_from advance search  start *******-->
                                        <div class="wrapper advance_search_excel">
                                        <!-- <span><strong>*</strong>Default entries in the page : 20. </span> -->
                                            <div class="tabs">
                                                <div class="tab">
                                                    <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                                                    <label for="tab-1" class="tab-label">Advance Search</label>
                                                    <div class="tab-content">

                                                        <!--***** Advance search form Start *-->



                                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="submitForm()" method="POST" style="display: flex; align-items: center;justify-content: center;">
                                                            <div class="form-group">
                                                            </div>

                                                            <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px; " >
                                                                <input type="text" name="fileRefno" id="colunmData1" class="form-control" placeholder="Please Enter file Ref. No." style="margin-left: 5px;" required>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> From : </label>
                                                                <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; To :</label>
                                                                <input type="date" id="bday" name="todt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="buttons">
                                                                <button class="btn btn-primary" onclick="validateme('msg');" style="background-color:#63B54F; border-color: #63B54F;max-width: 132px;width: 100%; margin-left: 5px; margin-left: 5px; margin-top: -16px;" type="submit">Advance Search</button>

                                                            </div>
                                                        </form>

                                                        <!--***** Advance search form END *-->

                                                    </div>
                                                </div>
                                                <div class="tab">
                                                    <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
                                                    <label for="tab-2" class="tab-label">Download report in excel
                                                    </label>
                                                    <div class="tab-content">
                                                        <!--***** Download report in excel start *-->

                                                        <!-- <h3>Download report in excel</h3> -->
                                                        <form action="" onsubmit="submitForm()" method="POST" style="display: flex; justify-content: center; align-items: center;">
                                                            <div class="form-group">

                                                            </div>

                                                            <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                                <input type="text" name="fileRefno" id="colunmData2" class="form-control" placeholder="Please Enter..." style="margin-left: 5px;"required>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> From : </label>
                                                                <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; To :</label>
                                                                <input type="date" id="bday" name="todt"s pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="buttons">
                                                                <input type="hidden" name="department" id="department" value="department">
                                                                <button class="btn btn-primary" onclick="validateme2('msg');" style="background-color:#63B54F; border-color:#63B54F;max-width: 132px;width: 100%;    margin-left: 5px;margin-top: -16px;" type="submit">Excel download</button>
                                                            </div>
                                                        </form>

                                                        <!-- excel search end -->


                                                    </div>
                                                </div>

                                            </div>

                                            <!--====== Pie_chart Start ===-->
                                            <div id='myDiv'></div>
                                            <!--====== Pie_chart End =====-->

                                        </div>
                                        <!--***** Tab_from advance search  end *******-->

                                        <div class="table-container matrix_data_table">
                                            <!--serch data show-->
                                            <p class="details_table">
                                                <?php if ($_POST['item'] == '') { ?>
                                                  <span><b>Searched values : </b> Default Search</span> | <span><b>No. of data :</b> 20 (By default)</span>

                                                <?php } else { ?>
                                                  <span><b>Searched values : </b> <?php echo $_POST['item'] . " - " . $_POST['colunmData']; ?></span> | <span><b>No. of data :</b> <?php echo get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item); ?></span>
                                                <?php } ?>
                                            </p>
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="sample_3" role="grid" aria-describedby="sample_3_info" style="width:100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th>File Ref. No.</th>
                                                        <th>Number Of Data</th>
                                                        <th>Date</th>
                                                        <th>File Uploaded Date & Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($_POST['item'] != '') {
                                                      $sql_query = "SELECT fileRefno, updatedDate, created_at, COUNT(fileRefno) AS no_of_data FROM `tbl_emp_dept_matrix` WHERE created_at !='' " . $srcitem . " " . $srcfrom . " group by fileRefno order by id DESC";
                                                    } else {
                                                      $sql_query = "SELECT fileRefno, updatedDate, created_at, COUNT(fileRefno) AS no_of_data FROM `tbl_emp_dept_matrix` group by fileRefno order by id DESC";
                                                    }
                                                    $result = mysqli_query($mycon, $sql_query);
                                                    //echo $sql_query;
                                                    if (mysqli_num_rows($result) > 0) {
                                                      $i = 0;
                                                      $j = 0;
                                                      $k = 0;
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <tr>
                                                            <td><a href="matrix-uploaded-data.php?file_refNum=<?php echo $row['fileRefno']; ?>"><?php echo $row['fileRefno']; ?></a></td>
                                                            <td><?php echo $row['no_of_data']; ?></td>
                                                            <td><?php echo $row['updatedDate']; ?></td>
                                                            <td><?php
                                                                $time = strtotime($row['created_at']);
                                                                $myFormatForView = date("m/d/y g:i A", $time);
                                                                echo $myFormatForView;
                                                                ?></td>
                                                            <td><a onclick="return confirm('Are you sure?')" href="matrix-uploaded-file.php?delete=<?php echo $row['fileRefno']; ?>"><span data-tooltip="" title="" class="cursor" data-tooltip-id="0"><i class="fa fa-trash" aria-hidden="true" style="color:orange; font-size:17px;    margin-left: 12px; font-weight:bold;"></i></span></a></td>
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

        <!-- BEGIN CORE PLUGINS -->
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
        <script src="../assets/pages/scripts/table-datatables-buttons.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <?php include'footer.php'; ?>
        <!--Js for session expire-->
       <!-- <script src="../assets/session-expire.js" type="text/javascript"></script> -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
                                                          $(document).ready(function () {
                                                              $('#menu ul li a').click(function (ev) {
                                                                  $('#menu ul li').removeClass('selected');
                                                                  $(ev.currentTarget).parent('li').addClass('selected');
                                                              });
                                                          })
        </script>

        <script src="js/Tooltip.js" type="text/javascript"></script>
    </body>

</html>