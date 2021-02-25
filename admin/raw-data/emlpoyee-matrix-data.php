<?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}

$startHour = "00:00:00";
$endHour = "23:55:55";

function get_empid($mycon, $employeeName)
   {
	  $sql_query="SELECT emp_code FROM tbl_users WHERE name LIKE '%" . $employeeName . "%' AND isDeleted != 1";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$empid = $row['emp_code'];
	
		  }
	
		  return $empid;
   }
   }

function get_Customer($mycon, $cust_id)
{
	$sql_query1 = "SELECT client FROM tbl_clients WHERE id='" . $cust_id . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {

				while ($row = mysqli_fetch_assoc($result1)) {
					$clientName = $row['client'];	
        }
    }
    return $clientName;
}
   

function get_loc_name($mycon, $loc_code)
{
	$sql_query1 = "SELECT org_name FROM tbl_organization WHERE id='" . $loc_code . "'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$loc_nm = $row1['org_name'];
       
	  }
  }
   return $loc_nm;
}

if($_POST['item'] !== ''){ $srcitem = "AND loc_code = ".$_POST['item']; } else { $srcitem = ''; }

if($_POST['employee'] !== ''){ 

$empid = get_empid($mycon, $_POST['employee']); 
$srcemp = "AND emp_id = ".$empid; 

} else { $srcemp = ''; }

if($_POST['todt'] != ''){ $srcfrom = "AND created_at BETWEEN '".$_POST['fromdt']." $startHour' AND '".$_POST['todt']." $endHour'"; } else { $srcfrom = ''; }
   


//Advance Search
$startHour = "00:00:00";
$endHour = "23:55:55";
$srcitem = "";
if ($_POST['item'] == 'emp_id') {
  $srcitem = " AND tu.emp_code ='" . trim($_POST['colunmData']) . "'";
} else if ($_POST['item'] == 'name') {
  $srcitem = " AND tu.name LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'designation') {
  $srcitem = " AND tu.designation LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'department') {
  $srcitem = " AND tu.main_department LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'email') {
    $srcitem = " AND tu.email LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'mob') {
    $srcitem = " AND tu.mobile LIKE '%" . trim($_POST['colunmData']) . "%'";
} else if ($_POST['item'] == 'loc') {
    $sql_query1 = "SELECT id FROM tbl_organization WHERE org_name LIKE '%" . trim($_POST['colunmData']) . "%'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$loc_id = $row1['id'];
	           }
           }
    $srcitem = " AND tm.loc_code = '" . $loc_id . "'";
} else if ($_POST['item'] == 'customer') {
    $sql_query1 = "SELECT id FROM tbl_clients WHERE client LIKE '%" . trim($_POST['colunmData']) . "%'";
			$result1 = mysqli_query($mycon, $sql_query1);
			if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)) {
					$cust_id = $row1['id'];
	           }
           }
    $srcitem = " AND tm.cust_code = '" . $cust_id . "'";
} else if ($_POST['item'] == 'all') {
  $srcitem = "";
}
$srcfrom = '';
if ($_POST['todt'] != '') {
  $srcfrom = "AND created_on BETWEEN '" . $_POST['fromdt'] . " $startHour' AND '" . $_POST['todt'] . " $endHour'";
} else {
  $srcfrom = '';
}
//Fetch data from role wised
if($userdata['role'] == 2 || $userdata['role'] == 3){
	$user_location = $userdata['org_id'];
	$user_client = $userdata['client_id'];
	$role_item = " AND tm.loc_code = '" . $user_location . "' AND tm.cust_code = '" . $user_client . "'";
} else {
	$role_item = '';
}
// Search Data Show
function get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item){
    $sql_query = "SELECT tu . *, tm.emp_id, tm.cust_code, tm.loc_code  FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
    tm.inward_document_checking_process = 100 AND
    tm.inward_vehicle_unloading_process = 100 AND
    tm.inward_floor_planning = 100 AND
    tm.inward_segregation_rocess = 100 AND
    tm.inward_system_process = 100 AND
    tm.uc_floor_process = 100 AND
    tm.uc_system_process = 100 AND
    tm.binning_system_process = 100 AND
    tm.inventory_handling_process_audit = 100 AND
    tm.outward_system_process = 100 AND
    tm.picking_process = 100 AND
    tm.packing_process = 100 AND
    tm.dispatch_process = 100 AND
    tm.dispatch_document_checking_process = 100 AND
    tm.piv_floor_process = 100 AND
    tm.piv_system_process = 100 AND
    tm.wh_adminstration_process = 100 AND
    tm.mis = 100
    ".$srcitem." ".$srcfrom." ".$role_item." group by tm.emp_id order by tu.name";      
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
.matrix_data_table {
	 overflow-x: scroll;
}
	</style>
        </head>
    <!-- END HEAD -->
	 <link href="css/tooltip.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="css/style.css">
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-md">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <?php include 'top_menu.php';?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                        <?php include 'sidebar.php';?>
                    <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <div class="row">
                            	<h2 style="font-size: 14px;font-weight: bold;text-align: center;color: #282A2C;margin-top: 48px;">Employee with 100% Knowledge in ALL DEPARTMENT</h2>
                            <div class="col-md-12">
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    
                                    
                                    <div class="portlet-title">
									
									<div class="col-md-6">
									
									  
									
									</div>
									
											<div class="col-md-4">
									
										
										</div>
                                       <!--  <div class="caption">
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

                                                   </li>-->
                                                   <!--<li style="background:green !important;" ><a  href="lr_unloading.php">LR Base</a>

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
                                            </div></span>
                                        </div>
										                       </div>
                                    </div>
									
                                    <div id="home" class="portlet-body ">


                                       <!-- Tab_from advance search  start-->

                                          <div class="wrapper advance_search_excel">
                                                <div class="tabs">
                                                  <div class="tab">
                                                      <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                                                          <label for="tab-1" class="tab-label">Advance Search </label>
                                                              <div class="tab-content">

                                                              <!--***** Advance search form Start *-->
                                                       
                                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display: flex;justify-content: center;text-align: center;">
                                           <div class="form-group">
                                                                <select class="Select_Items form-control" id="sel1" name="item">
                           border-color:#63B54F;                                             <option value="">Select</option>
                                                                        <option value="emp_id">Emp id</option>
                                                                        <option value="name">Name</option>
                                                                        <option value="designation">Designation</option>
                                                                        <option value="department">Department</option>
                                                                        <option value="email">Email Address</option>
                                                                        <option value="mob"> Mobile No. </option>
                                                                        <option value="loc">Location</option>
                                                                        <option value="customer"> Customer </option>
                                                                 </select>
                                                              </div>
                                          
                                            <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                                  <input type="text" name="colunmData" id="" class="form-control" placeholder="Please Enter..." style="margin-left: 5px;">
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
                                                                  <button class="btn btn-primary" style="background-color:#63B54F;border-color:#63B54F;max-width: 132px;width: 100%;    margin-left: 5px;" type="submit">Advance Search</button>
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
                                                         
                                              <form action="report-all-department-knowledge.php" method="POST" style="display: flex;justify-content: center;text-align: center;">
                                                   <div class="form-group">
                                                                        <select class="Select_Items form-control" id="sel1" name="item">
                                                                                <option value="">Select</option>
                                                                                <option value="emp_id">Emp id</option>
                                                                                <option value="name">Name</option>
                                                                                <option value="designation">Designation</option>
                                                                                <option value="department">Department</option>
                                                                                <option value="email">Email Address</option>
                                                                                <option value="mob"> Mobile No. </option>
                                                                                <option value="loc">Location</option>
                                                                                <option value="customer"> Customer </option>
                                                                        </select>
                                                                      </div>
                                                  
                                                    <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                                          <input type="text" name="colunmData" id="" class="form-control" placeholder="Please Enter..." style="margin-left: 5px;"required>
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
                                                                          <button class="btn btn-primary" style="background-color:#63B54F;border-color:#63B54F; max-width: 132px;width: 100%;    margin-left: 5px;" type="submit">Excel download</button>
                                                                        </div>
                                                                </form>
                                                           <!--excel  search form End *-->
                                                 </div>
                                        </div>
                                      </div>
                                    </div>
                 
                                       <!-- Tab Search  End -->
									
                                  
                                        <div class="table-container matrix_data_table">
                                        <!--serch data show-->
                                        <p class="details_table">
                                        <?php if($_POST['item'] == ''){ ?>
                                          <span><b>Searched values : </b> Default Search</span> | <span><b>No. of data :</b> 20 (By default)</span>
                                          
                                        <?php } else { ?>
                                          <span><b>Searched values : </b> <?php echo $_POST['item']." - ".$_POST['colunmData']; ?></span> | <span><b>No. of data :</b> <?php echo get_all_no_of_rows($mycon, $srcitem, $srcfrom, $role_item); ?></span>
                                        <?php } ?>
                                        </p>
                                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="sample_3" role="grid" aria-describedby="sample_3_info" style="width: 1767px;">
                                            <thead>
                                                <tr role="row">
                                                  <th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 60px;" aria-sort="ascending" aria-label="Emp Id : activate to sort column descending">Emp Id 
                                                  </th>
                                                  <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 53px;" aria-label="Name : activate to sort column ascending">Name 
                                                  </th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 97px;" aria-label="Designation : activate to sort column ascending">Designation </th>
                                               <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> Department</th>
										   <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> DOJ</th>
                                               <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 97px;" aria-label="Designation : activate to sort column ascending">Email Address </th>
                                               <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> Mobile No.</th>
                                               <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 72px;" aria-label="Location: activate to sort column ascending">Location</th>
                                                       <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 82px;" aria-label="Customer: activate to sort column ascending">Customer</th>
                                                  </tr>
                                            </thead>
                                            <tbody>
                                                
                                           <?php
											   if($_POST['item'] != ''){
												$sql_query = "SELECT tu . *, tm.emp_id, tm.cust_code, tm.loc_code  FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
                                                    tm.inward_document_checking_process = 100 AND
                                                    tm.inward_vehicle_unloading_process = 100 AND
                                                    tm.inward_floor_planning = 100 AND
                                                    tm.inward_segregation_rocess = 100 AND
                                                    tm.inward_system_process = 100 AND
                                                    tm.uc_floor_process = 100 AND
                                                    tm.uc_system_process = 100 AND
                                                    tm.binning_system_process = 100 AND
                                                    tm.inventory_handling_process_audit = 100 AND
                                                    tm.outward_system_process = 100 AND
                                                    tm.picking_process = 100 AND
                                                    tm.packing_process = 100 AND
                                                    tm.dispatch_process = 100 AND
                                                    tm.dispatch_document_checking_process = 100 AND
                                                    tm.piv_floor_process = 100 AND
                                                    tm.piv_system_process = 100 AND
                                                    tm.wh_adminstration_process = 100 AND
                                                    tm.mis = 100 
                                                    ".$srcitem." ".$srcfrom." ".$role_item." group by tm.emp_id order by tu.name";
												
											   } else {
												$sql_query = "SELECT tu . *, tm.emp_id, tm.cust_code, tm.loc_code FROM tbl_users tu, tbl_emp_dept_matrix tm WHERE tu.emp_code = tm.emp_id AND
                                                    tm.inward_document_checking_process = 100 AND
                                                    tm.inward_vehicle_unloading_process = 100 AND
                                                    tm.inward_floor_planning = 100 AND
                                                    tm.inward_segregation_rocess = 100 AND
                                                    tm.inward_system_process = 100 AND
                                                    tm.uc_floor_process = 100 AND
                                                    tm.uc_system_process = 100 AND
                                                    tm.binning_system_process = 100 AND
                                                    tm.inventory_handling_process_audit = 100 AND
                                                    tm.outward_system_process = 100 AND
                                                    tm.picking_process = 100 AND
                                                    tm.packing_process = 100 AND
                                                    tm.dispatch_process = 100 AND
                                                    tm.dispatch_document_checking_process = 100 AND
                                                    tm.piv_floor_process = 100 AND
                                                    tm.piv_system_process = 100 AND
                                                    tm.wh_adminstration_process = 100 AND 
                                                    tm.mis = 100 
                                                    ".$role_item." group by tm.emp_id order by tu.name LIMIT 0, 20";
                                               }
                                               //echo $sql_query."<br />srcitem---".$srcitem."<br />srcfrom---".$srcfrom."<br />item--".$_POST['item']."<br />colunmData--".$_POST['colunmData'];
                                              $result = mysqli_query($mycon, $sql_query);
                                               if (mysqli_num_rows($result) > 0) {   
		                                           while ($row = mysqli_fetch_assoc($result)) {
                                                         
												                 $loc_name = get_loc_name($mycon, $row['loc_code']);
																 $customer = get_Customer($mycon, $row['cust_code']);
												                 ?>  
                                            <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1"><?php echo $row['emp_code']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['designation']; ?></td>
                                                    <td><?php echo $row['main_department']; ?></td>
                                                    <td><?php echo $row['doj']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['mobile']; ?></td>
													<td><?php echo $loc_name; ?></td>
                                                    <td><?php echo $customer; ?></td>
                                               </tr>
										  <?php } } ?>
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
	
  </div>
       
  <footer>
            <div class="container-fluid">
                <div class="row">
                     <div class="col-sm-12 footer_copy_logo">
                         <div style=" margin-top: 22px; color: #fff;">
                              2019 © Seabird Logisolutions Limited 
                         </div>
                         
                     </div>
                </div>
            </div>
        </footer>

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
    </body>

</html>