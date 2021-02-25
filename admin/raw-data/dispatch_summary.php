 <?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}

   function get_invoice_number_dispatch_base($id,$mycon)
   {
	   $sql_query="SELECT om.invoice_number FROM packed_quantity_data pqd join order_management om on om.order_id=pqd.order_id WHERE pqd.dispatched_auto_id='".$id."' group by pqd.outward_packing_box_id";
	   
	
      $result = mysqli_query($mycon, $sql_query);
	  $total_rows=mysqli_num_rows($result);
          if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$invoice_number=$row['invoice_number'];
		  }
		  }
	 return $invoice_number;	 
   } 
  
  function get_total_customer_dispatch_base($id,$mycon)
   {
	   $sql_query="SELECT * FROM `packed_quantity_data` WHERE dispatched_auto_id='".$id."' GROUP BY order_id ";
      $result = mysqli_query($mycon, $sql_query);
	  $total_rows=mysqli_num_rows($result);
        /*  if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$vehicle_name=$row['name'];
		  }
	
		  return $vehicle_name;
   } */
   return $total_rows;
   }
   
   function get_total_boxes_dispatch_base($id,$mycon)
   {
	   $sql_query="SELECT * FROM `packed_quantity_data` WHERE dispatched_auto_id='".$id."'  GROUP BY outward_packing_box_id ";
      $result = mysqli_query($mycon, $sql_query);
	  $total_rows=mysqli_num_rows($result);
   return $total_rows;
   }
   
   function get_total_qty_dispatch_base($id, $mycon)
   {
	   $sql_query="SELECT SUM(picked_qt) AS total_dispatched_qty FROM `packed_quantity_data` WHERE dispatched_auto_id='".$id."'  ";
       $result = mysqli_query($mycon, $sql_query);
	    if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$dispatched_qty= $row['total_dispatched_qty'];
		  }
		}		  
   return $dispatched_qty;
   }
   
   
  function get_total_lr_dispatch_base($id,$mycon)
   {
	$sql_query="SELECT * FROM `packed_quantity_data` WHERE dispatched_auto_id='".$id."' GROUP BY lr_number_out ";
      $result = mysqli_query($mycon, $sql_query);
	  $total_rows=mysqli_num_rows($result);
   return $total_rows;
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
     
 <?php include 'shared/header.php';?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <!-- END THEME LAYOUT STYLES -->
		<style>
	   .table thead tr th{
     	font-size:11px !important;
         }
       .table td{
	   font-size:11px !important;
         }
	     .nav>li>a:focus, .nav>li>a:hover{
			 background:rgb(238, 50, 57);
			 color:white !important;
			 border-radius:24px;
		 }
		 .nav-tabs{
			 border:none !important;
		 }
		 .nav-tabs{
     border-bottom:none;
    margin-top: 22px;
}
	   </style>
	    <link href="css/tooltip.css" rel="stylesheet" type="text/css">
	   <script>
	   /*   
	   function remove_all()
	   {
		    document.getElementById('id_master').value="";
			document.getElementById('location_type').value= 0;
			document.getElementById('f_type').value= 0;
			document.getElementById('binning_code').value=  "";
			document.getElementById('binning_desc').value=  "";
			document.getElementById('binning_type').value= 0;
			document.getElementById('minimum_qty').value= "";
			document.getElementById('maximum_qty').value=   "";
			document.getElementById('length').value=  "";
			document.getElementById('width').value= "";
			document.getElementById('height').value=  "";
		}
	   */
	   </script>
	   
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-md">
        <div class="page-wrapper">
            
           <?php include 'top_menu.php';?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                
               <?php include 'sidebar.php';?>
				
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper"  style="margin-top: 28px;">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <div class="row">
                            <div class="col-md-12">
							<div class="col-md-4">
										     <ul  class="nav nav-tabs">
											 <li  style="background:rgb(238, 50, 57) ;border-radius:24px; "><a  href="dispatch_summary.php" style="color:white;">Dispatch Summary</a></li>
											 <li style="border-radius:24px; "><a  href="dispatch_module.php" style="color:rgb(40, 42, 44);">Dispatch Detail</a></li>
											 </ul>
										</div>
										<div  class="col-md-6">
										<a href="dispatch.php">
										<span data-tooltip title="Load Vehicle" class="cursor"><button  type="button" class="btn btn-circle" style="float:right;margin-top:16px;font-size:16px; color:red;">Add <i class="fa fa-plus-circle"></i>
										</button></span>
										</a>
										</div>
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
									

                                       <!--  <div class="caption">
                                            <i class="icon-settings font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Trigger Tools From Dropdown Menu</span>
                                        </div> -->
										
										
                                        <div class="actions">
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
                                            </div>
                                        </div></span>
										</div>
                                    </div>
									
                                    <div id="home" class="portlet-body ">
                                        <div class="table-container">
                                             <!--*************** Advance Search Start ***************-->
                                             
                                                    <form action="/admin/location_batch_product_wise_details.php" method="POST" style="display: flex;justify-content: center;text-align: center;margin-top:20px;">
        										   <div class="form-group">
                                                    <select class="Select_Items form-control" id="sel1" name="item">
                                                       <option value="Dispatch_Id">Dispatch Id</option>
                                                      <option value="Vechile_Number">Vechile Number</option>
                                                      <option value="Transporter_Name">Transporter Name</option>
                                                      <option value="Total_LRs">Total LRs</option>
                                                      <option value="Invoice_Number">Invoice Number</option>
                                                      <option value="Total_Boxes">Total Boxes</option>
                                                      <option value="Total_Qty">Total Qty.</option>
                                                      <option value="Dispatch_Start_Date">Dispatch Start Date</option>
                                                      <option value="Dispatch_End_Date">Dispatch End Date</option>
                                                      <option value="Total_Customers">Total Customers</option>
        											  <option value="all"> All Data </option>
                                                    </select>
                                                  </div>
        										  
        										    <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                                      <input type="text" name="colunmData" id="" class="form-control" placeholder="Please Enter.." style="margin-left: 5px;">
                                                    </div>
                                                      <div class="form-group Date-range">
                                                        <label for="bday"> From : </label>
                                                        <input type="date" id="bday" name="bday" required="" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                         <span class="validity"></span>
                                                    </div>
                                                    <div class="form-group Date-range">
                                                     <label for="bday"> &nbsp; To :</label>
                                                        <input type="date" id="bday" name="bday" required="" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                        <span class="validity"></span>
                                                    </div>
        											<div class="buttons">
                                                      <button class="btn btn-primary" style="background-color:rgb(40, 42, 44);max-width: 141px;width: 100%;    margin-left: 5px;" type="submit">Advance Search</button>
                                                    </div>
                                               </form>
                                             <!--*************** Advance Search End ***************-->
                                             
                                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                <thead>
                                                  <tr style="background-color:#2b3643; color:white;">
													<th>Dispatch Id</th>
													<th>Vehicle Number</th>
													<th>Transporter Name</th>
													<th>Total LRs</th>
													<th>Invoice Number</th>
													<th>Total Boxes</th>
													<th>Total Qty</th>
                                                    <th>Dispatch Start Date</th>
													<th>Dispatch End Date</th>
													<th>Total Customers</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
												
                                                </thead>
                                                <tbody>
												<?php 
												$cnt=1;
	  $sql_query="SELECT * FROM `dispatch_log`";
	 
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)){  
	     $total_lr_dispatch_base= get_total_lr_dispatch_base($row['id'],$mycon);
		 $total_boxes_dispatch_base= get_total_boxes_dispatch_base($row['id'],$mycon);
		 $total_qty= get_total_qty_dispatch_base($row['id'],$mycon);
		 $total_customer=get_total_customer_dispatch_base($row['id'],$mycon);
		 $get_ivoice=get_invoice_number_dispatch_base($row['id'],$mycon);
		 $iddd=$row['id']; 
		 if($total_qty != 0){ $edit = 1; } else { $edit = 0; }
	  ?>
<tr>
	<td><?php echo $row['id']; ?></td>
	<td><?php echo $row['vehicle_number']; ?></td>
	<td><?php echo $row['transporter_name']; ?></td>
	<td><?php echo $total_lr_dispatch_base; ?></td>
	<td><?php echo $get_ivoice; ?></td>
	<td><?php echo $total_boxes_dispatch_base ?></td>
	<td><?php echo $total_qty ?></td>
	<td><?php echo $row['created_on']; ?></td>
	<td><?php echo $row['closed_on']; ?></td>
	<td><?php echo $total_customer; ?></td>

	
	<td><?php if($row['closed_on']==""){ echo "Dispatch Started";  }else{ echo "Dispatch Closed"; } ?></td>
	<td>

<a href="dispatch_module.php?disp_id=<?php echo $iddd; ?>"><span data-tooltip title="View" class="cursor"><i  class="fa fa-eye" aria-hidden="true"  style="color:orange; font-size:17px; font-weight:bold;"></i></span></a> 

<a href="dispatch.php?vehicle_number=<?php echo $row['vehicle_number']; ?>&transporter_name=<?php echo $row['transporter_name']; ?>&dispatch_id=<?php echo $row['id']; ?>&edit=<?php echo $edit; ?>"><span data-tooltip title="Open Vehicle" class="cursor"><i  class="fas fa-shipping-fast" aria-hidden="true" style="color:red;  font-size:17px; font-weight:bold;"></i></span></a>

	</td>

</tr>
	  
													   
		 <?php $cnt++; }} ?>
                                                    
                                                   
                                                    
                                                    
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
           
        </div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" style="margin-top:10em;">
        <div class="modal-header">
         
		  <i class="fa fa-times" data-dismiss="modal" aria-hidden="true" style="color:red;font-size:25px; float:right;"></i>
          <h3 class="modal-title" align="center" style="color:red;font-weight:bold;" >Add Binning</h3>
        </div>
        <div class="modal-body">
          <form>
		
	<div class="row" style="    padding-top: 25px;"> 
	<div class="col-md-6">
	
	
	 <div class="form-group">
      <label for="pwd"> Floor Type </label>
     <select id="f_type" name="f_type" class="form-control select2">
										<option value="0">Please Select</option>											
                                              
                                                   													<?php

 $sql_query="SELECT * FROM `floor_type ";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
  ?>
		  <option value="<?php echo  $row['id'] ?>"><?php echo  $row['type'] ?></option>											
                                                       
  <?php } } ?>		
                                                
                                            </select>
    </div>
	</div>
	<div class="col-md-6">
	
	
	 <div class="form-group">
      <label for="pwd">Binning Code </label>
      <input type="text" class="form-control" id="binning_code" placeholder="Binning Code" name="binning_code">
    </div>
	</div>
	</div>
	<div class="row"> 
	<div class="col-md-6">
	
	
	<div class="form-group">
      <label for="pwd">Binning Description </label>
      <input type="text" class="form-control" id="binning_desc" placeholder="Binning Description" name="binning_desc">
    </div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
      <label for="pwd">Binning type</label>
      <select id="binning_type"  name="binning_type" class="form-control select2">
										<option value="0">Please Select</option>											
                                              
  <?php

 $sql_query="select * from  binning_type ";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
  ?>
		  <option value="<?php echo  $row['id'] ?>"><?php echo  $row['type'] ?></option>											
                                                       
  <?php } } ?>		
                                                
                                            </select>
    </div>
	
	
	
	</div>
	</div>
		<div class="row"> 
	<div class="col-md-6">
	
	
	<div class="form-group">
      <label for="pwd">Width (CM) </label>
	  <input type="hidden" class="form-control" id="id_master"  name="id_master">
      <input type="number" class="form-control" id="width" placeholder="Width" name="width">
    </div>
	</div>
	<div class="col-md-6">
	
	
	<div class="form-group">
      <label for="pwd">Length (CM)</label>
      <input type="text" class="form-control" id="length" placeholder="Length" name="length">
    </div>
	
	</div>
	<div class="col-md-6">
	<div class="form-group">
      <label for="pwd">Height (CM)</label>
      <input type="text" class="form-control" id="height" placeholder="Height" name="height">
    </div>
	
	</div>
	<div class="col-md-6">
	<div class="form-group">
                                                   
 <label>Location Type</label>
                                                    
													<select id="location_type" name="location_type" class="form-control select2">
											<option value="0">Please Select</option>											
                                              
                                                   													<?php

  $sql_query="SELECT * FROM `location_type";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
  ?>
		  <option value="<?php echo  $row['location_type'] ?>"><?php echo  $row['location_type'] ?></option>											
                                                       
  <?php } } ?>		
                                                
                                            </select>
													
													
													
													
                                                </div>
	</div>
	
	<div class="col-md-6">
	<div class="form-group">
      <label for="pwd">Minimum Qty</label>
      <input type="text" class="form-control" id="minimum_qty" placeholder="Minimum Qty" name="minimum_qty">
    </div>
	
	</div>
	
	<div class="col-md-6">
	<div class="form-group">
      <label for="pwd">Maximum Qty</label>
      <input type="text" class="form-control" id="maximum_qty" placeholder="Maximum Qty" name="maximum_qty">
    </div>
	
	</div>
	
	
	
	
	</div>
	
 

        </div>
        <div class="modal-footer">
	
          <button onclick="send_data_toserver()" type="button" class="btn btn-success" >Save</button>
		  
        </div>
		</form>
		</div>
		
      </div>
      
    </div>
  </div>
       
       

 <?php include 'shared/footer.php';?>
		<script src="js/Tooltip.js" type="text/javascript"></script>
    </body>

</html>