
 <?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
   
$startHour = "00:00:00";
$endHour = "23:55:55";

if($_POST['item'] == 'customer_code'){ $srcitem = "AND customer_code = ".$_POST['colunmData']; } else if($_POST['item'] == 'cust_name'){ $srcitem = "AND cust_name LIKE '%" . $_POST['colunmData'] . "%'"; } else if($_POST['item'] == 'invoice_no'){ $srcitem = "AND invoice_no = ".$_POST['colunmData']; } else if($_POST['item'] == 'lrgcNo'){ $srcitem = "AND lrgcNo LIKE '%" . $_POST['colunmData'] . "%'"; } else if($_POST['item'] == 'transporterName'){ $srcitem = "AND transporterName LIKE '%" . $_POST['colunmData'] . "%'"; } else if($_POST['item'] == 'ewaybillNo'){ $srcitem = "AND ewaybillNo LIKE '%" . $_POST['colunmData'] . "%'"; }

if($_POST['todt'] != ''){ $srcfrom = "AND created_at BETWEEN '".$_POST['fromdt']." $startHour' AND '".$_POST['todt']." $endHour'"; } else { $srcfrom = ''; }
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
			 background:#2b3643;
			 color:white;
			 border-radius:24px;
		 }
		 .nav-tabs{
			 border:none !important;
		 }
		 .form-group.form-md-line-input.has-warning .form-control{
		      border-bottom: 1px solid #327ad5 !important;
		 }
     .portlet.light.portlet-fit>.portlet-title {
    padding: 0px 20px 10px !important;
}
		 #sample_3_wrapper table th {
    text-align: center;
    background-color: #63B54F !important;
    color: #fff;
    font-size: 13px;
}
.Red_box{
  width: 40px;
  height: 40px;
  border-radius: 100%;
  margin:0 auto;
  background-color: red;
 display: block;
 line-height:40px;
 color:#000;
 font-weight:700;
 
}
.green_box {
   width: 40px;
  height: 40px;
  border-radius: 100%;
  margin:0 auto;
  background-color: #00B050;
 display: block;
 line-height:40px;
 color:#000;
 font-weight:700;
}
.Yellow_box {
   width: 40px;
  height: 40px;
  border-radius: 100%;
  margin:0 auto;
  background-color: #FFFF00;
 display: block;
 color:#000;
 font-weight:700;
}
.matrix_data_table {
	 overflow-x: scroll;
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
     var f_type = document.getElementById('f_type').value;
	  var binning_desc = document.getElementById('binning_desc').value;
	   var width = document.getElementById('width').value;
	    var height = document.getElementById('height').value;
		 var binning_code = document.getElementById('binning_code').value;
     var location_type = document.getElementById('location_type').value;
	 var minimum_qty = document.getElementById('minimum_qty').value;
	 var maximum_qty = document.getElementById('maximum_qty').value;
	
	 var binning_type = document.getElementById('binning_type').value;
	 var length = document.getElementById('length').value;	 
	  var id_master = document.getElementById('id_master').value;
	  
		 
		/*if(f_type=="" || f_type=="0")
		{
			alert('Select  Floor Type');
			
		}else*/ 
		if(binning_desc=="")
		{
			alert('Enter Binning Description');
			
		}
		/*else if(width=="")
		{
			alert('Enter Width');
		}*/
		/*else if(height=="")
		{
			alert('Enter Height');
		}*/
		
		/* else
		 if(minimum_qty=="" || minimum_qty=="0")
		{
			alert('Select Minimum Qty');
			
		} */
		else if(binning_code=="")
		{
			alert('Enter Binning Code');
		}
		
		/*else if(binning_type=="" || binning_type=="0")
		{
			alert('Select Binning Type');
		}*/
		/*else if(length=="")
		{
			alert('Enter Length');
		}*/
		else
		 if(location_type=="" || location_type=="0")
		{
			alert('Select Location Type');
			
		}/* else
		if(maximum_qty=="" || maximum_qty=="0")
		{
			alert('Select Maximum Qty');
			
		}  */
		
		
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
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <h2 style="font-size: 14px;font-weight: bold;text-align: center;color: #282A2C;margin-top: 48px;">MASTER DATA</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Begin: life time stats -->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
									

                                       <!--<div class="col-md-2">-->
                                          
                                       <!--   &nbsp-->
                                       <!-- </div> -->

								<div class="col-md-10">
										  
									
										 
										</div>
                                        <span data-tooltip title="Export Table Data" class="cursor"><div class="actions">
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
                                            </div></span>
                                        </div>
										</div>
                                    </div>
									
                                    <div id="home" class="portlet-body ">
                                    	
                                        <!--******** Advance Search Start ************-->
                                            <form action="/admin/location_batch_product_wise_details.php" method="POST" style="display: flex;justify-content: center;text-align: center;">
                                          
										   <div class="form-group">
										  
                                            <select class="Select_Items form-control" id="sel1" name="item">
                                              <option value="Emp_Id">Emp Id</option>
                                              <option value="Name">Name</option>
                                              <option value="Designation">Designation</option>
                            
                                           <option value="all"> All Data</option>
                                            </select>
                                          </div>
										  
										    <div class="form-group Select_Items" style="max-width: 450px; display: flex;margin-bottom: 15px; margin-right: 7px">
                                              <input type="text" name="colunmData" id="" class="form-control" placeholder="Please Enter.." style="margin-left: 5px;">
                                            </div>
                                         
											<div class="buttons">
                                              <button class="btn btn-primary" style="background-color:rgb(40, 42, 44);max-width: 125px;width: 100%;    margin-left: 5px;" type="submit">Add New</button>
                                              
                                            </div>
                                    </form>
                                        <!--******** Advance Search End ************-->
                                          <div class="table-container matrix_data_table">
                                           <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="" role="grid" aria-describedby="sample_3_info" style="width: 1767px;">
                                            <thead>
                                                <tr role="row">
                                                	<th class="sorting_asc" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 60px;" aria-sort="ascending" aria-label="Emp Id : activate to sort column descending">Emp Id 
                                                	</th>
                                                	<th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 53px;" aria-label="Name : activate to sort column ascending">Name 
                                                	</th>
                                                	<th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 97px;" aria-label="Designation : activate to sort column ascending">Designation </th>
                                                	<th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 99px;" aria-label=" Department : activate to sort column ascending"> Department
                                                	 </th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 72px;" aria-label="Location: activate to sort column ascending">Location</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 82px;" aria-label="Customer: activate to sort column ascending">Customer</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 87px;" aria-label="Inward Documnet Checking: activate to sort column ascending">Inward <br>Documnet<br> Checking</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label="Inward  Documnet Checking: activate to sort column ascending">Inward <br> Documnet <br>Checking</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 90px;" aria-label=" Inward Documnet Checking : activate to sort column ascending"> Inward<br> Documnet <br>Checking </th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Binning System Process: activate to sort column ascending">Binning<br> System <br>Process</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 73px;" aria-label="Outdoor Process: activate to sort column ascending">Outdoor<br> Process</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process : activate to sort column ascending">Picking <br> Process </th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 67px;" aria-label="Picking  Process: activate to sort column ascending">Picking <br> Process</th>
                                                	 <th class="sorting" tabindex="0" aria-controls="sample_3" rowspan="1" colspan="1" style="width: 78px;" aria-label="dispatch  Process: activate to sort column ascending">dispatch <br> Process
                                                	 </th>

                                                	</tr>
                                            </thead>
                                            <tbody>
                                                
                                              
                                               
                                               
                                               
                                               
                                            <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                  
                                                   
                                               </tr><tr style="display: table-row;" role="row" class="even">
                                                     <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                  
                                               </tr><tr style="display: table-row;" role="row" class="odd">
                                                   <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr><tr style="display: table-row;" role="row" class="even">
                                                     <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr>
                                               <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr>
                                                <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr>
                                                <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr>
                                                <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                               </tr>
                                                <tr style="display: table-row;" role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">41</td>
                                                    <td>XYZ</td>
                                                    <td>Software</td>
                                                    <td>IT</td>
                                                    <td>Delhi</td>
                                                    <td>J.K FENNER</td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td> <a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="green_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
                                                    <td><a href="#" class="Red_box"></a></td>
                                                    <td><a href="#" class="Yellow_box"></a></td>
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
		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" style="margin-top:7em;">
        <div class="modal-header">
         
		  <i class="fa fa-times" data-dismiss="modal" aria-hidden="true" style="color:red;font-size:25px; float:right;"></i>
          <h3 class="modal-title" align="center" style="color:red;font-weight:bold;" >Add Binning</h3>
        </div>
        <div class="modal-body">
          <form >
		
	<div class="row" style="padding-top: 25px;"> 
	<div class="col-md-6">
	
	
	 <div class="form-group form-md-line-input form-md-floating-label has-warning">
     
     <select id="f_type" name="f_type" class="form-control select2">
										<option value="0"></option>											
                                              
	<?php

 $sql_query="SELECT * FROM `floor_type` ";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
  ?>
		  <option value="<?php echo  $row['type'] ?>"><?php echo  $row['type'] ?></option>											
                                                       
  <?php } } ?>		
                                                
                                            </select>
											 <label for="pwd"> Floor Type </label>
    </div>
	</div>
	<div class="col-md-6">
	
	
	 <div class="form-group form-md-line-input form-md-floating-label has-warning">
      
      <input type="text" class="form-control" id="binning_code"  name="binning_code" maxlength="13">
	  <label for="pwd">Binning Code &#9734; </label>
    </div>
	</div>
	</div>
	<div class="row"> 
	<div class="col-md-6">
	
	
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
      
      <input type="text" class="form-control" id="binning_desc"  name="binning_desc" maxlength="100">
	  <label for="pwd">Binning Description &#9734;</label>
    </div>
	</div>
	<div class="col-md-6">
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
     
      <select id="binning_type"  name="binning_type" class="form-control select2">
										<option value="0"></option>											
                                              
  <?php

 $sql_query="select * from  binning_type ";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
  ?>
		  <option value="<?php echo  $row['type'] ?>"><?php echo  $row['type'] ?></option>											
                                                       
  <?php } } ?>		
                                                
                                            </select>
											 <label for="pwd">Binning type</label>
    </div>
	
	
	
	</div>
	</div>
		<div class="row"> 
	<div class="col-md-6">
	
	
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
     
	  <input type="hidden" class="form-control" id="id_master"  name="id_master">
      <input type="text" onkeypress="return isNumber(event)" class="form-control" id="width" id="tbNumbers"  name="width"  maxlength="7">
	   <label for="pwd">Width (CM) </label>
    </div>
	</div>
	<div class="col-md-6">
	
	
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
      
      <input type="text" onkeypress="return isNumber(event)" class="form-control" id="length" id="tbNumbers"  name="length" maxlength="7">
	  <label for="pwd">Length (CM)</label>
    </div>
	
	</div>
	<div class="col-md-6">
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
      
      <input type="text" onkeypress="return isNumber(event)" class="form-control" id="height" id="tbNumbers"  name="height" maxlength="7">
	  <label for="pwd">Height (CM)</label>
    </div>
	
	</div>
	<div class="col-md-6">
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
                                                   
 
                                                    
<select id="location_type" name="location_type" class="form-control select2">
		<option value="0"></option>											

		<?php  $sql_query="SELECT * FROM location_type";
				$result = mysqli_query($mycon, $sql_query);
		  if (mysqli_num_rows($result) > 0) {
			
				while ($row = mysqli_fetch_assoc($result)) {    ?>
				
		<option value="<?php echo  $row['location_type'] ?>"><?php echo  $row['location_type'] ?></option>											
															   
		  <?php } } ?>		
													
</select>
<label>Location Type &#9734;</label>
											</div>
	</div>
	
	<div class="col-md-6">
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
      
      <input type="text" onkeypress="return isNumber(event)" class="form-control" id="minimum_qty"  name="minimum_qty" maxlength="7" >
	  <label for="pwd">Minimum Qty</label>
    </div>
	
	</div>
	
	<div class="col-md-6">
	<div class="form-group form-md-line-input form-md-floating-label has-warning">
     
      <input type="text" onkeypress="return isNumber(event)" class="form-control" id="maximum_qty"  name="maximum_qty" maxlength="7" >
	   <label for="pwd">Maximum Qty</label>
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
  
  <!---rahul---validation---start--->
  
<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>

  
  
   <!---rahul---validation---end-> 
  
  
  
       
       <script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>

        <?php include 'shared/footer.php';?>
		<script>
		 setTimeout(function() {

		var input = document.getElementById('f_type');
		setCaretPosition(input, input.value.length);
			
		var input = document.getElementById('binning_code');
		setCaretPosition(input, input.value.length);		
		
		var input = document.getElementById('binning_desc');
		setCaretPosition(input, input.value.length);

		var input = document.getElementById('width');
		setCaretPosition(input, input.value.length);	
			
		var input = document.getElementById('length');
		setCaretPosition(input, input.value.length);
		
         var input = document.getElementById('height');
		setCaretPosition(input, input.value.length);	

         var input = document.getElementById('location_type');
		setCaretPosition(input, input.value.length);	
		
          var input = document.getElementById('minimum_qty');
		setCaretPosition(input, input.value.length);	
          var input = document.getElementById('maximum_qty');
		setCaretPosition(input, input.value.length);			
			
		}, 250);
		
		
		
		
		
		</script>
		<script type="text/javascript">
$(document).ready(function(){
    $(".show-modal").click(function(){
        $("#myModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
</script>
    </body>

</html>