<?php
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
  
 function get_doneputway($location,$mycon)
   {
	  $total=0;
	  $sql_query1="SELECT sum(quantity) as sum FROM temp_split_quantity_putway WHERE location='".$location."' group by location";
	  
      $result1 = mysqli_query($mycon, $sql_query1);
         $rows_total1=  mysqli_num_rows($result1);
		 if (mysqli_num_rows($result1) > 0) {
		   while ($row1 = mysqli_fetch_assoc($result1)){  
      		  $tabledata = $row1['sum']; 
                 }  }
     
     if($tabledata > 0){ $tabledata = $tabledata ; } else { $tabledata = 0 ; } 
	 
    return $tabledata;
   }
   
   function get_lockedqty($location,$mycon)
   {
	  $sql_query="SELECT sum(pick_qty) as sumqut FROM `putway_batch_wise_qty` WHERE location='".$location."' group by location";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
		  while ($row = mysqli_fetch_assoc($result)) 
		  {
			 $total1 = $row['sumqut'];
			 
			 }
		 }
        
	if($total1 > 0){ $total = $total1 ; } else { $total = 0 ; }
		
    return $total;
   }
   
   function get_totalbatch($location,$mycon)
   {
	   $total=0;
	   $sql_query2="SELECT * FROM temp_split_quantity_putway WHERE location='".$location."' group by relation_id";
       $result2 = mysqli_query($mycon, $sql_query2);
	   $total2=  mysqli_num_rows($result2);
	   
	   $sql_query1="SELECT * FROM putway_batch_wise_qty WHERE location='".$location."' group by batch_location";
       $result1 = mysqli_query($mycon, $sql_query1);
	   $total1=  mysqli_num_rows($result1);
       $total = $total2 + $total1 ;
	   
    return $total;
   }
   
    function get_totalpro($location,$mycon){
	   $total=0;
	   $sql_query2="SELECT * FROM temp_split_quantity_putway WHERE location='".$location."' group by product_code";
       $result2 = mysqli_query($mycon, $sql_query2);
	   $total2=  mysqli_num_rows($result2);
	   
	   $sql_query1="SELECT * FROM putway_batch_wise_qty WHERE location='".$location."' group by pro_code";
       $result1 = mysqli_query($mycon, $sql_query1);
	   $total1=  mysqli_num_rows($result1);
       $total = $total2 + $total1 ;
	   
    return $total;
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
			 background:rgb(238, 50, 57);
			 color:white !important;
			 border-radius:24px;
 }
		</style>
		
<script>
function gradebatchNum(location) {
	 //alert('vikas123');
     $("#vikas123").load("batch_data.php?location="+location);
	}
	
function gradetProduct(location) {
	 //alert('vikas12345');
     $("#aarv").load("putway_product_data.php?location="+location);
	}	
	
</script>
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
                    <div class="page-content" style="margin-top:25px">
                        
                        <div class="row">
                            <div class="col-md-12">
							<div class="col-md-6">
										     <ul class="nav nav-tabs">
										     <li style="border-radius:24px;"><a href="product_wise_detail.php" style="color:rgb(40, 42, 44);">Products Wise Detail</a></li>
                                             <li style="background-color:rgb(238, 50, 57); border-radius:30px;"><a href="location_wise_detail.php" style="color:white;">Location Wise Detail</a> </li>
											 <li style="border-radius:24px;"><a href="batch_wise_detail.php" style="color:rgb(40, 42, 44);">Batch Wise Detail</a></li>
											 <li style="border-radius:24px;"><a href="location_batch_product_wise_details.php" style="color:rgb(40, 42, 44);">All Stock Detail</a> </li>
											</ul>
										
										</div>
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
                                       <!--  <div class="caption">
                                            <i class="icon-settings font-green"></i>
                                            <span class="caption-subject font-green sbold uppercase">Trigger Tools From Dropdown Menu</span>
                                        </div> -->
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
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;" data-action="5" class="tool-action">
                                                            <i class="icon-refresh"></i> Reload</a>
                                                    </li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        
                                        <div class="table-container">
                                            
                                            <!--****** advance search start *********-->
                                               <form action="/admin/location_batch_product_wise_details.php" method="POST" style="display: flex;justify-content: center;text-align: center;margin-top:20px;">
            										   <div class="form-group">
                                                        <select class="Select_Items form-control" id="sel1" name="item">
                                                           <option value="Binning_Location">Binning Location</option>
                                                          <option value="Avaiable_Quantity">Avaiable Quantity</option>
                                                          <option value="Locked_Quantity">Locked Quantity</option>
                                                          <option value="Total_Summary">Total Summary</option>
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
                                            <!--****** advance search end   *********-->
                                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                <thead>
                                                    <tr class="poke">
                                                         <th>Binning Location</th>
                                                         <!--<th>Total Batch</th>
                                                         <th>Total Product</th>-->
														 <th>Available Quantity</th>
														 <th>Locked Quantity</th>
														 <th>Total Summary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
     //$sql_query="SELECT * FROM `packing_data` WHERE putway_status = 1 group by location order by location";
	 $sql_query="SELECT * FROM `temp_split_quantity_putway`  group by location order by location LIMIT 0, 20";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 $k=0;
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
	//echo '<pre>';
	//print_r($row);
	//echo '</pre>';
	   $tlocked1 = get_lockedqty($row['location'],$mycon);
	   //echo $tlocked1 ;die('check');
	   if($tlocked1 > 0){ $tlocked = $tlocked1 ; } else { $tlocked = 0 ; }
	   $avaible1 = get_doneputway($row['location'],$mycon) - $tlocked ;
	   if($avaible1 > 0){ $avaible = $avaible1 ; } else { $avaible = 0 ; }
	  ?>
                                                    <tr>
														<td> <?php echo $row['location']; ?> </td>
														
														
														<!--<td><button class="btn btn-lg"  data-toggle="modal" data-target="#myModal12233" onclick="gradebatchNum('<?php echo $row['location']; ?>')"><?php echo get_totalbatch($row['location'],$mycon); ?></button></td>
														
														<td><button class="btn btn-lg" data-toggle="modal" data-target="#myModal90" onclick="gradetProduct('<?php echo $row['location']; ?>')"> <?php echo get_totalpro($row['location'],$mycon); ?> </button></td>-->
														
														<td> <?php echo $avaible; ?> </td>
														<td> <?php echo $tlocked; ?> </td>
														<td> <?php $tsum = $avaible + $tlocked;
														
														echo $tsum; ?> </td>
														
                                                       </tr>
                                                    
                                                   
		 <?php }} 
		 //} ?>        
                                                    
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
  
  
  
  
  
  
    <!-- Modal -->
  <div class="modal fade" id="myModal90" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content" style="margin-top:12em;">
        <div class="modal-header">
		<h3 class="modal-title" style="text-align:center; font-size:16px; color:red;" id="lineModalLabel"></h3>
          <i class="fa fa-times" data-dismiss="modal" aria-hidden="true" style="color:red;font-size:25px; float:right;"></i>
          
        </div>
        <div class="modal-body" id="aarv">
             
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default"  style="margin-top: 21px; visibility:hidden;">Close</button>
        </div>
      </div>
      
    </div>
  </div>
       
	   <?php include 'shared/footer.php';?>
		
		
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS --> 
					<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
    </body>

</html>