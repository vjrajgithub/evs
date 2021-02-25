 <?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
   
  $mm_id= $_GET['mm_id'];
  if($mm_id!='' && $mm_id!=0)
  {
	  $query="Delete from binning_master WHERE id='".$mm_id."'";
	   mysqli_query($mycon, $query);
	  
  }
  $disp_id= $_GET['disp_id'];
  
  function get_data_invoice($mycon,$order_id){
	    $sql_query_validation="SELECT invoice_number FROM `order_management` WHERE order_id='".$order_id."'";
		$result = mysqli_query($mycon, $sql_query_validation);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			 $array_data=$row['invoice_number'];
		  }
		 }
	return $array_data;
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
          border-bottom:none;
          margin-top: 22px;
                 }
	   </style>
	   <script>
	  
	  
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
	   
	
	   function set_all_data_new(id,location_type,floor_type,bnning_code,bnning_desc,bnning_type,minimum_qty,maximum_qty,length,weight,height)
	   {
		  
			document.getElementById('id_master').value=id;
			document.getElementById('location_type').value= location_type;
			document.getElementById('f_type').value= floor_type;
			document.getElementById('binning_code').value=  bnning_code;
			document.getElementById('binning_desc').value=  bnning_desc;
			document.getElementById('binning_type').value= bnning_type;
			document.getElementById('minimum_qty').value= minimum_qty;
			document.getElementById('maximum_qty').value=   maximum_qty;
			document.getElementById('length').value=  length;
			document.getElementById('width').value= weight;
			document.getElementById('height').value=  height;
		
	   }
	    function send_data_toserver()
	   {
     var location_type = document.getElementById('location_type').value;
	 var minimum_qty = document.getElementById('minimum_qty').value;
	 var maximum_qty = document.getElementById('maximum_qty').value;
	 var f_type = document.getElementById('f_type').value;
	 var binning_code = document.getElementById('binning_code').value;
	 var binning_desc = document.getElementById('binning_desc').value;
	 var binning_type = document.getElementById('binning_type').value;
	 var width = document.getElementById('width').value;
	 var length = document.getElementById('length').value;
	 var height = document.getElementById('height').value;	 
	  var id_master = document.getElementById('id_master').value;
		 
		 if(maximum_qty=="" || maximum_qty=="0")
		{
			alert('Select Maximum Qty');
			
		}else
		 if(minimum_qty=="" || minimum_qty=="0")
		{
			alert('Select Minimum Qty');
			
		}else
		 if(location_type=="" || location_type=="0")
		{
			alert('Select Location Type');
			
		}else
		if(f_type=="" || f_type=="0")
		{
			alert('Select Floor Type');
			
		}else if(binning_code=="")
		{
			alert('Enter Binning Code');
		} 
		else if(binning_desc=="")
		{
			alert('Enter Binning Description');
			
		}else if(binning_type=="" || binning_type=="0")
		{
			alert('Select Binning Type');
		}
		else if(width=="")
		{
			alert('Enter Width');
		}
		else if(length=="")
		{
			alert('Enter Length');
		}
		else if(height=="")
		{
			alert('Enter Height');
		}
		else
		{
			urll="send_material_data_to_server.php?data="+f_type+"~"+binning_code+"~"+binning_desc+"~"+binning_type+"~"+width+"~"+length+"~"+height+"~"+location_type+"~"+minimum_qty+"~"+maximum_qty+"~"+id_master;
			//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		if(this.responseText==1)
		{
			alert('Data has been saved Successfully..');
			window.location = "bining_master_listing.php";
		}
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
		}
		
	   }
	   </script>
	     <link href="css/tooltip.css" rel="stylesheet" type="text/css">
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
                <div class="page-content-wrapper" style="margin-top: 28px;">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <div class="row">
                            <div class="col-md-12">
							<div class="col-md-4">
										     <ul  class="nav nav-tabs">
											 <li ><a  href="dispatch_summary.php" style="color:rgb(40, 42, 44)">Dispatch Summary</a></li>
										          <li style="background:rgb(238, 50, 57) ;border-radius:24px; "><a  href="dispatch_module.php" style="color:white;">Dispatch Detail</a></li>
                                             
											
                                             
                                               </ul>
										
										</div>
										<div class="col-md-6">
										<span style="display:none;" data-tooltip title="Open Dispatch Process" class="cursor"><a  href="dispatch.php"<button  type="button" class="btn btn-circle" style="float:right; margin-top:16px;   font-size: 16px; color:red;">Add <i class="fa fa-plus-circle"></i></button></a></span>
										</div>
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
									

										
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
                                            </div></span>
                                        </div>
										</div>
                                    </div>
									
                                    <div id="home" class="portlet-body ">
                                        <div class="table-container">
                                                 <!--******** Advance Search Start ************-->
                                                     
                                                    <form action="/admin/location_batch_product_wise_details.php" method="POST" style="display: flex;justify-content: center;text-align: center;margin-top:20px;">
            										   <div class="form-group">
                                                        <select class="Select_Items form-control" id="sel1" name="item">
                                                           <option value="LR_Number">LR Number</option>
                                                          <option value="Order_No">Order No</option>
                                                          <option value="Invoice_Number">Invoice Number</option>
                                                          <option value="Box_Code">Box Code</option>
                                                          <option value="Product_Code">Product Code</option>
                                                          <option value="Dispatch_Date">Dispatch Date</option>
                                                          <option value="Vechile_Number">Vechile Number</option>
                                                          <option value="Transporter_Name">Transporter Name</option>
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
                                                 <!--********** Advance Search End **************-->
                                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                <thead>
                                                    <tr style="background-color:#2b3643; color:white;">
                                                        <th>LR Number</th>
                                                        <th>Order No</th>
                                                        <th>Invoice Number</th>
		                                                <th>Box Code</th>
		                                                <th>Product Code</th>
		                                                <th>Dispatch Date</th>
		                                                <th>Vehicle Number</th>
		                                                <th>Transporter Name</th>
		                                              </tr>
                                                </thead>
                                                <tbody>
												<?php 
												$cnt=1;
	 if($disp_id=='')
	{
	 $sql_query="SELECT * FROM packed_quantity_data WHERE lr_number_out<>'' group by outward_packing_box_id";
	}
	else
	{
		$sql_query="SELECT * FROM packed_quantity_data WHERE lr_number_out<>'' AND dispatched_auto_id='".$disp_id."' group by outward_packing_box_id";
	}
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
	  ?>
       <tr>
        <td><?php echo $row['lr_number_out']; ?></td>
        <td><?php echo $row['order_id']; ?></td>
        <td><?php echo get_data_invoice($mycon,$row['order_id']); ?></td>
		<td><?php echo $row['outward_packing_box_id']; ?></td>
		<td><?php echo $row['product_code']; ?></td>
		<td><?php echo $row['dispatched_at']; ?></td>
		<td><?php echo $row['vehicle_number']; ?></td>
		<td><?php echo $row['transporter_name']; ?></td>
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