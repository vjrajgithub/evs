<?php 
include_once 'helpers/dbconn.php';
$dbConn = new DatabaseConn();
 $conn = $dbConn->getConnection();
 if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
		$qdata="";
		$vehicle_id=$_GET['vehicle_id'];
		if(isset($vehicle_id))
		{
			$qdata=" and s.vehicle_number='".$vehicle_id."'";
		}
			
		
	function get_box_data($relation_id,$conn)
   {
	   $arrayy_new=array();
	     $sql_query="SELECT * FROM `box_data` where relation_id='".$relation_id."'";
      $result = mysqli_query($conn, $sql_query);
     $rows_total=  mysqli_num_rows($result);
	 return $rows_total;
   }
   
   function get_all_data($id,$conn,$qdata)
   {
	   $arrayy_new=array();
	     $sql_query="SELECT s.vehicle_number,t.transporter_name FROM `security_check_details` s join transporter_master t on t.id=s.transporter_name where s.relation_id='".$id."' $qdata";
      $result = mysqli_query($conn, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
         $row = mysqli_fetch_assoc($result);
	
		  return $row;
   }
   }
   
   
		?><!DOCTYPE html>
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
			 border:none !important;
			 	 margin-top:20px;
	 }  
	   
	   .nav>li>a:focus, .nav>li>a:hover{
			 background:#2b3643;
			 color:white;
			 border-radius:24px;
		
	   }
	    .tabbable-line>.nav-tabs>li.active {
    border-bottom: 4px solid green;
}
table.dataTable tbody td {
    padding: 7px 25px !important;
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
                            <h2 style="font-size:14px;  margin-top: -18px; font-weight:bold; text-align:center;  color:#de8d25;">Invoice & LR Summary</h2>
                            <div class="col-md-12">
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
									
									 	<div class="col-md-6">
									
									  <div class="tabbable-line">
                                            <ul class="nav nav-tabs nav-tabs-lg">
                                                <li >
                                                    <a href="lr_unloading.php"  >Unloading Pending  </a>
                                                </li>
                                                <li >
                                                    <a href="lr_unloading.php" >Unloading Summary 
                                                        
                                                    </a>
                                                </li>
                                               <li class="active">
                                                    <a href="box_summary.php" >Invoice & LR Summary 
                                                        
                                                    </a>
                                                </li>
                                            </ul>
									</div>
									
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
                                    </div>
									
                                    <div id="home" class="portlet-body ">
                                        <div class="table-container">
                                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                <thead>
                                                    <tr style="background-color:#2b3643; color:white;">
                                                        <th> Vehicle<br/> No.</th>	
														<th> Transporter <br/> Name</th>		
                                                        <th> LR <br/> No. </th>
                                                        <th>Invoice <br/> Number </th>
													    <th>Supplier <br/> Name </th>
														<th>Warehouse <br/> Client Name </th>
                                                      	<th>Gatepass <br/> Number</th>
                                                        <th>No.Of <br/> Boxes </th>
                                                        <th>Qty(LR)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
																								<?php
//$sql_query="SELECT *,ld.id as n_id FROM lr_details ld join security_check_details sc on sc.gate_pass_number=ld.gate_pass_number";

$sql_query="SELECT bd.*,ld.* FROM `box_data` bd join vehicle_in_out_lr_data ld on ld.id=bd.relation_id ";
    
	$result = mysqli_query($conn, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			
          while ($row = mysqli_fetch_assoc($result)) 
		  {
			$valuu = get_all_data($row['relation_id'],$conn,$qdata);
			if(count($valuu)>0){
  ?> 
			<tr>
				 <td> <?php echo $valuu['vehicle_number']; ?> </td>
				 <td> <?php echo $valuu['transporter_name']; ?> </td>
				 
				 <td> <?php echo $row['lr_number']; ?> </td>				
				  <td> <?php echo $row['invoice_no']; ?> </td>
				  <td> <?php echo $row['vendor_name']; ?> </td>
				  <td> <?php echo $row['customer_name']; ?> </td>
				  
				 <td> <?php echo $row['gate_pass_number']; ?> </td>
				 <td> <?php echo $row['close_noofboxes']; ?> </td>
				  <td> <?php echo $row['qunatity']; ?> </td>
		   
			</tr>
                                                    
			<?php $kk++; }}} ?>                                
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
       
       
 <?php include 'shared/footer.php';?>
		<script>
		$(document).ready(function () {
    $('#menu ul li a').click(function (ev) {
        $('#menu ul li').removeClass('selected');
        $(ev.currentTarget).parent('li').addClass('selected');
    });
});	
		</script>
    </body>

</html>