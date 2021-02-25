<?php
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
 print date("m/d/y G.i:s<br>", time()); ;
 ?>
<!DOCTYPE html>

<html lang="en">
    
        <meta charset="utf-8" />
        <title><?php echo $header_project_name; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for edit product" name="description" />
        <meta content="Vikas Singh" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
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
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
         <style>
		 .select2-container--bootstrap .select2-selection{
			 border:none;
			 border-bottom:2px solid #27a4b0;
		 }
		 .poke{
			     background: navy;
                color: white;
		 }
		 
		 </style>
		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-md">
        <div class="page-wrapper">
             <?php include 'top_menu.php';?>
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                 <?php include 'sidebar.php';?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                       <div class="row">
					   <h2 style="color:#2b3643; font-size:18; font-weight:bold; text-align:center;"> Dispatch Process
                             </h2>
					   </div>                                    
                    <div class="row">
					 <div class="col-md-6">
							<h2 style="color:#2b3643; font-size:15px; font-weight:bold; text-align:center;"> Order Details				
                             </h2>
							 <div class="col-md-12" style="margin-top:27px;">
							<div class="col-md-3">
	                         <div class="form-group form-md-line-input form-md-floating-label has-success">
                             <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
                             <label for="">Search Vehicle</label>
                             </div>
                             </div>
						<div class="col-md-3">
	                    <div class="form-group form-md-line-input form-md-floating-label has-success">
                        <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
                        <label for="">GatePass Number
						</label>
                         </div>
						 </div>
                         <div class="col-md-3">
	                     <div class="form-group form-md-line-input form-md-floating-label has-success">
                         <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
                          <label for="">Customer Name</label>
                           </div>
						   </div>			
						<div class="col-md-3">
						<button type="button" class="btn btn-success" style="    margin: 20px 8px;">Genrate Slip No</button>
						</div>	
						</div>	
						<div class="col-md-12 alert">
						<div class="table-wrapper-scroll-y">
		                 <table class="table table-bordered">
     <thead>
      <tr>
        <th>Loading Slip</th>
        <th>Vehicle Number</th>
        <th>Transporter Name</th>
		 <th>GatePass No</th>
		 <th>Total Boxes QTY</th>
		  <th>Action</th>
      </tr>
    </thead>
    <tbody>
	
	
 
  
      <tr>
        <td></td>
        <td></td>
        <td></td>
		 <td></td>
		 <td></td>
		  <td>
		  <span>
		  <i onclick="set_lr_data_id(,,)" class="fa fa-play" aria-hidden="true" style="color:green; font-size:16px;"></i>
		  </span>
		   <span>
		   <i class="fa fa-print" aria-hidden="true" style="color:navy; font-size:16px;"></i>
		   </span>
		    <span>
			<i class="fa fa-minus-circle" onclick="delete_all_lr_data()" aria-hidden="true" style="color:red; font-size:16px;"></i>
			
			</span>
		  </td>
      </tr>
	  
		
     
     
	 
	 
    </tbody>
  </table>
  </div>
						
			
						
						</div>
							</div>
<div class="col-md-6">
							<h2 style="color:#2b3643; font-size:15px; font-weight:bold; text-align:center;"> Box  Summary
                             </h2>
							<div class="col-md-12 alert" style="margin-top:27px;">
										
						<div class="col-md-4">
	   <div class="form-group form-md-line-input form-md-floating-label has-success">
       <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
        <label for="">Search Invoice</label>
           </div>
            </div>
<div class="col-md-4">
	 <div class="form-group form-md-line-input form-md-floating-label has-success">
      <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
       <label for="">Start Loading</label>
        </div>
	    </div>		
		<div class="col-md-4">
	 <button type="button" class="btn btn-success" style="    margin: 20px 8px;">Load
</button>
	</div>
	</div>			
	<div class="col-md-12 alert">
	<div class="table-wrapper-scroll-y">
	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Select Box</th>
        <th>Packed Box Code</th>
        <th>Product Code</th>
		 <th>Product Desc</th>
		  <th>Customer Name</th>
		 <th>Customer Location</th>
		  
      </tr>
    </thead>
    <tbody>
	
	
 
  
      <tr>
        <td></td>
        <td></td>
        <td></td>
		 <td></td>
		  <td></td>
		  <td></td>
		 
      </tr>
	  
    </tbody>
  </table>
  </div>
						
		
						</div>		
							
							</div>
					   </div> 
					   <div class="clearfix"></div>
					   <div class="row">
					    <div class="col-md-12">
					   <div class="col-md-3">
					   <div class="form-group form-md-line-input form-md-floating-label has-success" style="    margin-bottom: 12px;">
                                                                        <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
                                                                 <label for="">Search Box or Product bar code	</label>
                                                                             </div>
					   </div>
					   </div>
					   <div class="col-md-12">
					   <table class="table table-bordered">
    <thead>
      <tr class="poke">
        <th>Load  Slip No</th>
        <th>Order No</th>
        <th>Refrence No</th>
		 <th>Invoice Number</th>
		 <th>Box Code</th>
		  <th>Product Code</th>
		 <th>Product Des</th>
		 <th>Customer Name</th>
		 <th>Customer Location</th>
		 <th>LR Number</th>
		 <th>Vehicle Number</th>
		 <th>Action</th>
		  
      </tr>
    </thead>
    <tbody>
	
	
 
  
      <tr>
        <td></td>
        <td></td>
        <td></td>
		 <td></td>
		 <td></td>
		  <td></td>
		  <td></td>
		 <td></td>
		  <td></td>
		 <td></td>
		 <td></td>
		  <td><span>
			<i class="fa fa-trash" onclick="delete_all_lr_data()" aria-hidden="true" style="color:red; font-size:16px;"></i>
			
			</span></td>
      </tr>
	  
		
     
     
	 
	 
    </tbody>
  </table>
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					    </div>
					  </div> 
                    </div>
                    <!-- END CONTENT BODY -->
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
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>