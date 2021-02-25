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
		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
         
        <style>
		.poke{
			    font-size: 25px;
                text-align: center;
			    font-weight:bold;
				    color: burlywood;
		}
		
	.dashboard-stat .details .number {
    padding-top: 13px;
    text-align: right;
    font-size: 34px;
    line-height: 44px;
    letter-spacing: -1px;
    margin-bottom: 0;
    font-weight: 300;
}
		</style>
		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                         <a href="index.php">
                          <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default"> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                  
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
           
                            
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    
                                    <span class="username username-hide-on-mobile"> Nick </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> My Calendar </a>
                                    </li>
                                   
                                   
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="page_user_lock_1.html">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li>
                                    <li>
                                        <a href="page_user_login_1.html">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                           
                            
                            <li class="nav-item start ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                  
                                    <span class="title">  Dashboard </span>
                                   
                                </a>
                                
                            </li>
                           
					
                        
             
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Sucurity Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="dashboard_security.php" class="nav-link nav-toggle">
                                             Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="vehicle_in_out_data.php" class="nav-link nav-toggle">
                                            Sucurity Data
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="report.php" class="nav-link nav-toggle">
                                          Report
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
							<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">GRN Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="dashboard.php" class="nav-link nav-toggle">
                                             Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="grn_module.php" class="nav-link nav-toggle">
                                           GRN Data
                                            <span class="arrow"></span>
                                        </a>
                                        <li class="nav-item">
                                        <a href="barcode_module.php" class="nav-link nav-toggle">
                                            Generate Bar Code
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    </li>
									<li class="nav-item">
                                        <a href="packing_listing.php" class="nav-link nav-toggle">
                                            Packing Process
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="report.php" class="nav-link nav-toggle">
                                          Report
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
							<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Unloading  Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="dashboard.php" class="nav-link nav-toggle">
                                             Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="unloading_data.php" class="nav-link nav-toggle">
                                            Unloading Data
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="report.php" class="nav-link nav-toggle">
                                          Report
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
								<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Masters</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="dashboard.php" class="nav-link nav-toggle">
                                             Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="bining_master_listing.php" class="nav-link nav-toggle">
                                            Binning Masters
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="box_master_listing.php" class="nav-link nav-toggle">
                                            Box Masters Data
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="master_material_listing.php" class="nav-link nav-toggle">
                                            Material Masters
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="report.php" class="nav-link nav-toggle">
                                          Report
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">                                      
                                        <h1 class="poke"> Dashboard </h1>
                                          <div class="row">
										  <div class="col-md-8"></div>
										   <div class="col-md-4">
										   <button type="button" class="btn-circle" style="border: 6px solid green; background:green; color:white;      margin-right: 12px;  float: right;">Today</button>
										    <button type="button" class="btn-circle" style="border: 6px solid red; background:red; color:white;      margin-right: 12px;  float: right;">Week</button>
										   
										   </div>
										  
										  </div>										
									</div>
									 <div class="container-fluid" style=" margin-top: 30px;">
										    <div class="col-md-4">
										    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                           <div class="visual">
                                            <i class="fa fa-comments"></i>
                                            </div>
                                            <div class="details">
                                            <div class="number">
                                            <span data-counter="counterup" data-value="1349">1349</span>
                                           </div>
                                           <div class="desc"> Total Vehicle In </div>
                                           </div>
                                             </a>
										   </div>
										    <div class="col-md-4">
											
											 <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                            <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                          </div>
                                          <div class="details">
                                           <div class="number">
                                            <span data-counter="counterup" data-value="12,5">12,5</span>M$ </div>
                                          <div class="desc">Total Vehicle out</div>
                                            </div>
                                          </a>
											</div>
											 <div class="col-md-4">
											 
											  <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                            <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                         </div>
                                         <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">549</span>
                                        </div>
                                        <div class="desc"> Pending Vehicle </div>
                                        </div>
                                       </a>
											 </div>
										   </div>
										<div class="container-fluid">
										
										 <div id="columnchart_material" style="width: 110s0px; height: 300px;    margin-top: 50px;"></div>
										
										</div> 
                               </div>	
                    </div> 
                    
                </div>
                <!-- END CONTENT -->
          
            </div>
            <!-- END CONTAINER -->
           
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
        <!-- END THEME LAYOUT SCRIPTS -->
		 <script type="text/javascript">
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Vehicle In ', 'Vehicle Out', 'Pending'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);
  
        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

         var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    </body>

</html>