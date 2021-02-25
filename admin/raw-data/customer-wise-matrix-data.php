<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName) {
  $sql_query = "SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1
    AND roleId IN (2, 3, 4, 13, 14)";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $empid = $row['emp_code'];
    }

    return $empid;
  }
}

function get_name($mycon, $empid) {
  $sql_query = "SELECT name FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $nam = $row['name'];
    }

    return $nam;
  }
}

function get_designation($mycon, $empid) {
  $sql_query = "SELECT designation FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      $desi = $row['designation'];
    }
    return $desi;
  }
}

function get_Customer($mycon, $cust_code) {
  $sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $cust_code . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $clientName = $row1['client'];
    }
  }
  return $clientName;
}

function get_department($mycon, $empid) {
  $sql_query = "SELECT main_department FROM tbl_users WHERE emp_code='" . $empid . "' AND isDeleted != 1";
  $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $depart = $row['main_department'];
    }
  }
  return $depart;
}

function get_loc_name($mycon, $loc_code) {
  $sql_query1 = "SELECT loc_name FROM tbl_location WHERE loc_id='" . $loc_code . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $loc_nm = $row1['loc_name'];
    }
  }
  return $loc_nm;
}

if ($_POST['item'] !== '') {
  $srcitem = "AND tm.cust_code = " . $_POST['item'];
} else {
  $srcitem = '';
}

if ($_POST['todt'] != '') {
  $srcfrom = "AND created_at BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
} else {
  $srcfrom = '';
}

//Fetch data from role wised
if ($userdata['role'] == 2 || $userdata['role'] == 3) {
  $user_client = $userdata['client_id'];
  $role_item = " AND tm.cust_code = '" . $user_client . "'";
} else {
  $role_item = '';
}

function get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
  $sql_query = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";

  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
}

function get_total_no_of_rows($mycon, $srcitem, $srcfrom, $role_item) {
  $sql_query = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code ";
  $result = mysqli_query($mycon, $sql_query);
  return mysqli_num_rows($result);
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

            .portlet.light.portlet-fit>.portlet-title {
                padding-top:0 !important;
            }
            #sample_3_wrapper table th {
                text-align: center;
                background-color: #63B54F !important;
                color: #fff;
                font-size: 13px;
            }
            .Red_box{
                width: 25px;
                height: 25px;
                border-radius: 100%;
                margin:0 auto;
                background-color: red;
                display: block;
                line-height:40px;
                color:#000;
                font-weight:700;

            }
            .green_box {
                width: 25px;
                height: 25px;
                border-radius: 100%;
                margin:0 auto;
                background-color: #00B050;
                display: block;
                line-height:40px;
                color:#000;
                font-weight:700;
            }
            .Yellow_box {
                width: 25px;
                height: 25px;
                border-radius: 100%;
                margin:0 auto;
                background-color: #FFFF00;
                display: block;
                color:#000;
                font-weight:700;
                line-height:40px;
            }

            /*======pie Chart Css Start=======*/


            .slice:nth-child(1) path {
                fill:rgb(0,176,80) !important;

            }
            .slice:nth-child(2) path {
                fill:rgb(255,0,0) !important;

            }
            .slice:nth-child(3) path {
                fill:rgb(255,255,0) !important;
            }

            .traces:nth-child(1) path{
                fill:rgb(0,176,80) !important
            }
            .traces:nth-child(2) path {
                fill:rgb(255,255,0) !important
            }
            .traces:nth-child(3) path {
                fill:rgb(255, 0 ,0) !important
            }
            #pie-chart {
                margin: 0 auto;
                height: 450px;
            }
            .modebar-btn {
                display: none !important;
            }
            .slicetext {
                font-size: 18px !important;
                fill:#000 !important;
            }
            g.slicetext {
                color: #000000 !important;
            }
            .hovertext{
                display: none;
            }
            svg.main-svg {
                background-color: rgb(99, 181, 0 , 0)!important;
            }
            .svg-container {
                /* position: relative; */
                width: 495px;
                height: 338px;
                position: absolute !important;
                right: 0;
                top: -70px;
            }

            /*=======pie Chart Css End==========*/
            .wrapper.advance_search_excel .advance_search {
                display: flex;
                justify-content: left;
                text-align: center;"
                }
                .wrapper.advance_search_excel .download_excel {
                display: flex;
                justify-content: left;
                text-align: center;"

            }
            .wrapper.advance_search_excel .tab {
                padding-left: 195px !important;
            }
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
                                <h2 style="font-size: 14px;font-weight: bold;text-align: center;color: #282A2C;margin-top: 48px;">Customer Wise Department Knowledge</h2>
                                <div class="col-md-12">
                                    <!-- Begin: life time stats -->
                                    <div class="portlet light portlet-fit portlet-datatable bordered">


                                        <div class="portlet-title">

                                            <div class="col-md-6">

                                                <!-- <div class="tabbable-line">
                                                    <a href="upload-matrix-data.php">
                                                     <button type="button" class="btn btn-warning">Upload File</button>
                                                    </a>
                                                 </div>-->

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

                                        </div>
                                    </div>

                                    <div id="home" class="portlet-body ">

                                        <!-- Tab_from advance search  start-->

                                        <div class="wrapper advance_search_excel">
                                            <div class="tabs">
                                                <div class="tab">
                                                    <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                                                    <label for="tab-1" class="tab-label">Advance Search
                                                    </label>
                                                    <div class="tab-content">

                                                        <!--***** Advance search form Start *-->

                                                        <!-- <h3>Advance Search</h3> -->
                                                        <form class="advance_search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                                            <div class="form-group">
                                                                <select class="Select_Items form-control" id="sel1" name="item">
                                                                    <option value="">--All Customer--</option>
                                                                    <?php
                                                                    $sql_query = "SELECT * FROM `tbl_clients` order by client ASC";
                                                                    $result = mysqli_query($mycon, $sql_query);
                                                                    if (mysqli_num_rows($result) > 0) {
                                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['client']; ?></option>
                                                                        <?php
                                                                      }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <!--<div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                            <input type="text" name="employee" id="" class="form-control" placeholder="Enter employee name" style="margin-left: 5px;">
                                                          </div>--->
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; From : </label>
                                                                <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; To :</label>
                                                                <input type="date" id="bday" name="todt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="buttons">
                                                                <button class="btn btn-primary" style="background-color:#63B54F; border-color:#63B54F;max-width: 132px;width: 100%;    margin-left: 5px;" type="submit">Advance Search</button>
                                                            </div>
                                                        </form>
                                                        <!--***** Advance search form End *******-->
                                                    </div>
                                                </div>
                                                <div class="tab">
                                                    <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
                                                    <label for="tab-2" class="tab-label">Download report in excel
                                                    </label>
                                                    <div class="tab-content">
                                                        <!--Advance search Excel data form start *******-->

                                                        <!-- <h3>Download report in excel</h3> -->
                                                        <form class="download_excel" action="customer-wise-matrix-data-report.php" method="POST">
                                                            <div class="form-group">
                                                                <select class="Select_Items form-control" id="sel1" name="item">
                                                                    <option value="">--All Customer--</option>
                                                                    <?php
                                                                    $sql_query = "SELECT * FROM `tbl_clients` order by client ASC";
                                                                    $result = mysqli_query($mycon, $sql_query);
                                                                    if (mysqli_num_rows($result) > 0) {
                                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['client']; ?></option>
                                                                        <?php
                                                                      }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <!-- <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                                                   <input type="text" name="employee" id="" class="form-control" placeholder="Enter employee name" style="margin-left: 5px;">
                                                                                 </div> -->
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; From : </label>
                                                                <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="form-group Date-range">
                                                                <label for="bday"> &nbsp; To :</label>
                                                                <input type="date" id="bday" name="todt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                                <span class="validity"></span>
                                                            </div>
                                                            <div class="buttons">
                                                                <input type="hidden" name="department" id="department" value="department">
                                                                <button class="btn btn-primary" style="background-color:#63B54F;border-color:#63B54F;max-width: 132px;width: 100%;    margin-left: 5px;" type="submit">Excel download</button>
                                                            </div>
                                                        </form>

                                                        <!--download  Excel data form End *-->

                                                    </div>
                                                </div>

                                            </div>

                                            <!--====== Pie_chart Start ===-->
                                            <div id='myDiv'></div>
                                            <!--====== Pie_chart End =====-->

                                        </div>

                                        <!-- Tab_from advance search end -->

                                        <div class="table-container matrix_data_table">
                                            <p class="details_table">
                                                <?php
                                                if ($_POST['item'] == '') {
                                                  $is_defaultshowEntries = get_total_no_of_rows($mycon, $srcitem, $srcfrom, $role_item);
                                                  if ($is_defaultshowEntries > 20) {
                                                    $defaultshowEntries = 20;
                                                  } else {
                                                    $defaultshowEntries = $is_defaultshowEntries;
                                                  }
                                                  ?>
                                                  <span><b>Searched values : </b> Default Search</span> | <span>Showing <?php echo $defaultshowEntries; ?> by default of </span><span> <?php echo $is_defaultshowEntries; ?></span> <b> entries</b>
                                                <?php } else { ?>
                                                  <span><b>Searched values : </b> <?php echo $_POST['item'] . " - " . $_POST['colunmData']; ?></span> | <span><?php echo get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item); ?></span>| <span><b>Total No. of data :</b> <?php echo get_total_no_of_rows($mycon, $srcitem, $srcfrom, $role_item); ?></span>
                                                <?php } ?>
                                            </p>
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="sample_3" role="grid" aria-describedby="sample_3_info" style="width:100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 60px;" aria-sort="ascending" aria-label="Emp Id : activate to sort column descending">Emp Id
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 53px;" aria-label="Name : activate to sort column ascending">Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 97px;" aria-label="Designation : activate to sort column ascending">Designation </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> Department </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> DOJ </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 72px;" aria-label="Location: activate to sort column ascending">Location</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 82px;" aria-label="Customer: activate to sort column ascending">Customer</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 87px;" aria-label="Inward Documnet Checking: activate to sort column ascending"> Inward <br />Document <br />checking <br />Process </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label="Inward  Documnet Checking: activate to sort column ascending">Inward <br />Vehicle <br />unloading <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label=" Inward Documnet Checking : activate to sort column ascending"> Inward <br />Floor <br />Planning </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Binning System Process: activate to sort column ascending">Inward <br />Segregation <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 73px;" aria-label="Outdoor Process: activate to sort column ascending">Inward <br />System <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process : activate to sort column ascending">UC <br />Floor <br />Process </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process: activate to sort column ascending">UC <br />System <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px;" aria-label="dispatch  Process: activate to sort column ascending">Binning <br />System <br />Process
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label="Inward  Documnet Checking: activate to sort column ascending">Inventory <br />Handling <br />Process/<br />Audit</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label=" Inward Documnet Checking : activate to sort column ascending"> Outward <br />System <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Binning System Process: activate to sort column ascending">Picking <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 73px;" aria-label="Outdoor Process: activate to sort column ascending">Packing <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process : activate to sort column ascending">Dispatch <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process: activate to sort column ascending">Dispatch <br />Document <br />Checking <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px;" aria-label="dispatch  Process: activate to sort column ascending">PIV <br />Floor <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process: activate to sort column ascending">PIV <br />System <br />Process</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px;" aria-label="dispatch  Process: activate to sort column ascending">W/H <br />Adminstration <br />Process</th>

                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px;" aria-label="dispatch  Process: activate to sort column ascending">MIS</th>

                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px; background-color: #00b050 !important;" aria-label="100% Knowledge in department: activate to sort column ascending">100% <br />Knowledge<br /> in <br />department<br />(18)</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px; background-color: #ffff00 !important; color: #a09a9a;" aria-label="50% Knowledge in department: activate to sort column ascending">50% <br />Knowledge<br /> in <br />department<br />(18)</th>
                                                        <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px; background-color: #ff0000 !important;" aria-label="0% Knowledge in department: activate to sort column ascending">0% <br />Knowledge<br /> in <br />department <br />(18)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if ($_POST['item'] != '') {
                                                      $sql_query = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code " . $srcitem . " " . $srcfrom . " " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id";
                                                    } else {
                                                      $sql_query = "SELECT tm . *, tu . * FROM `tbl_emp_dept_matrix` tm, `tbl_users` tu WHERE tm.emp_id = tu.emp_code " . $role_item . " AND tu.isDeleted != 1 AND tu.roleId IN (2, 3, 4, 13, 14) group by tm.emp_id order by tm.id LIMIT 0, 20";
                                                    }
                                                    $result = mysqli_query($mycon, $sql_query);
                                                    //echo $sql_query;
                                                    if (mysqli_num_rows($result) > 0) {
                                                      $i = 0;
                                                      $j = 0;
                                                      $k = 0;
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                        //echo mysqli_num_rows($result);

                                                        $loc_name = get_loc_name($mycon, $row['loc_code']);
                                                        $customer = get_Customer($mycon, $row['cust_code']);
                                                        ?>
                                                        <tr style="display: table-row;" role="row" class="odd">
                                                            <td tabindex="0" class="sorting_1"><?php echo $row['emp_code']; ?></td>
                                                            <td><?php echo $row['name']; ?></td>
                                                            <td><?php echo $row['designation']; ?></td>
                                                            <td><?php echo $row['main_department']; ?></td>
                                                            <td><?php echo $row['doj']; ?></td>
                                                            <td><?php echo $loc_name; ?></td>
                                                            <td><?php echo $customer; ?></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inward_document_checking_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inward_document_checking_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"><!--100% --></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inward_vehicle_unloading_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inward_vehicle_unloading_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inward_floor_planning'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inward_floor_planning'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inward_segregation_rocess'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inward_segregation_rocess'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inward_system_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inward_system_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['uc_floor_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['uc_floor_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['uc_system_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['uc_system_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['binning_system_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['binning_system_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['inventory_handling_process_audit'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['inventory_handling_process_audit'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['outward_system_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['outward_system_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['picking_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['picking_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['packing_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['packing_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['dispatch_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['dispatch_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>

                                                            <td><a href="#" class="<?php
                                                                if ($row['dispatch_document_checking_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['dispatch_document_checking_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['piv_floor_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['piv_floor_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['piv_system_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['piv_system_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>
                                                            <td><a href="#" class="<?php
                                                                if ($row['wh_adminstration_process'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['wh_adminstration_process'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>

                                                            <td><a href="#" class="<?php
                                                                if ($row['mis'] == 100) {
                                                                  echo "green_box";
                                                                  $i++;
                                                                } else if ($row['mis'] == 50) {
                                                                  echo "Yellow_box";
                                                                  $j++;
                                                                } else {
                                                                  echo "Red_box";
                                                                  $k++;
                                                                }
                                                                ?>"></a></td>

                                                            <td><strong><?php
                                                                    $hund_percent = round((($i / 18) * 100), 0);
                                                                    echo $hund_percent;
                                                                    ?>% - (<?php
                                                                    echo $i;
                                                                    unset($i);
                                                                    ?>)</strong></td>
                                                            <td><strong><?php
                                                                    $fifty_percent = round((($j / 18) * 100), 0);
                                                                    echo $fifty_percent;
                                                                    ?>% - (<?php
                                                                    echo $j;
                                                                    unset($j);
                                                                    ?>)</strong></td>
                                                            <td><strong><?php
                                                                    $zero_percent = round((($k / 18) * 100), 0);
                                                                    echo $zero_percent;
                                                                    ?>% - (<?php
                                                                    echo $k;
                                                                    unset($k);
                                                                    ?>)</strong></td>
                                                        </tr>
                                                        <?php
                                                        $count_of_hund_percent += $hund_percent;
                                                        $count_of_fifty_percent += $fifty_percent;
                                                        $count_of_zero_percent += $zero_percent;
                                                      }
                                                    }
// echo "totalcount---".$totalcount."<br />count_of_hund_percent---".$count_of_hund_percent."<br />count_of_fifty_percent---".$count_of_fifty_percent."<br />count_of_zero_percent---".$count_of_zero_percent ;
                                                    ?>                </tbody>
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
    <!--pie graphjs-->
    <script type="text/javascript" src="../assets/layouts/layout/scripts/pie_graph.js"></script>
    <!--pie graphjs-->
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

    <!--Js for session expire-->
    <!-- <script src="../assets/session-expire.js" type="text/javascript"></script> -->
    <?php include 'footer.php'; ?>
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
    <script type="text/javascript">

      $(document).ready(function () {
          var table = $('#sample_3').DataTable({
              scrollY: "auto",
              scrollX: true,
              scrollCollapse: false,
              paging: true,
              fixedColumns: {
                  leftColumns: 2
              }
          });
      })

    </script>

    <!--==== Pie_chart Start =====-->
    <script type="text/javascript">
      var data = [{
              values: [<?php echo $count_of_hund_percent; ?>, <?php echo $count_of_zero_percent; ?>, <?php echo $count_of_fifty_percent; ?>],
              labels: ['100% Knoweldge', '0% Knoweldge', '50% Knoweldge'],
              type: 'pie',
              tooltips: {
                  enabled: false
              }

          }];
      var layout = {
          height: 400,
          width: 500
      };
      Plotly.newPlot('myDiv', data, layout);
    </script>
    <!--==== Pie_chart Start =====-->
</body>

</html>