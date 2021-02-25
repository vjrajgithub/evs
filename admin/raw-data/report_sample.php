 <?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
   $d_id=$_GET['d_id'];
   if($d_id!='')
   {
	   $sql_query_validation="Delete FROM `customer_details` where customer_id='".$d_id."' ";
      mysqli_query($mycon, $sql_query_validation);
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
        <meta content="Preview page of Metronic Admin Theme #1 for buttons extension demos" name="description" />
        <meta content="" name="author" />
       <?php include 'shared/header.php';?>
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
	    background-color:#fff !important;
		color:red !important;
		border:1px solid red !important;
}
.poke1{
	color:red;
}
.poke:hover{
	background:red !important;
	color:#fff !important;
}
.table thead tr th{
	font-size:11px !important;
}
.table td{
	font-size:11px !important;
}
		</style>
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
                 <?php include 'sidebar.php';?>
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
                                      <div class="col-md-2">
									  <p class="poke1">From Date</p>
									  </div>
									  <div class="col-md-2">
									   <input type="date" id="" name="" class="form-control" style="margin: 12px -93px;" />
									  </div>
									  <div class="col-md-2">
									   <p class="poke1">To Date</p>
									  </div>
									  <div class="col-md-2">
									   <input type="date" id="" name="" class="form-control" style="  margin: 12px -93px;" />
									  </div>
									  <div class="col-md-2">
									   <button type="button" class="btn btn-circle poke" style="  margin: 12px -93px;">Go</button>
									  </div>
                                        <div class="actions">
                                            
                                            <span data-tooltip title="Export Data" class="cursor"><div class="btn-group">
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
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="5" class="tool-action">
                                                            <i class="icon-refresh"></i> Reload</a>
                                                    </li>
                                                    </li>
                                                </ul>
                                            </div></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-container">
                                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                <thead>
                                                    <tr style="background:black; color:#fff;">
													<th>Customer ID</th>
													<th>Customer Name</th>
													<th>Address</th>
													<th>Phone No.</th>
													<th>Office No</th>
													<th>E-Mail</th>
												    <th>State</th>
                                                    <th>City</th>
													<th>Region </th>
												
													<th>Status</th>
													<th>Action Item </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

													 <td>  </td>
													 
                                                         <td>--- </td>
														 <td>---</td>
                                                         <td> -- </td>
                                                          <td>--</td>
                                                          <td> -- </td>
														  <td>--  </td>
													      <td> -- </td>  
														  <td>--  </td>
														  <td> -- </td>
													     
														  <td> -- </td>
														
														</tr>
                                                    
                                                   
                                                
		
                                            
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
       <?php include 'shared/footer.php';?>
		

		<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS --> 
    </body>

</html>