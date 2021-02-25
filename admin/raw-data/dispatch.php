<?php

require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
		$invoice_nmr=$_GET['id'];
		$c_name=$_GET['c_name'];
		$vehicle_number=$_GET['vehicle_number'];
		$transporter_name=$_GET['transporter_name'];
		$dispatch_id=$_GET['dispatch_id'];
		$edit=$_GET['edit'];
		
       /* $sql_query_close="SELECT * FROM packed_quantity_data WHERE order_id='".$invoice_nmr."' AND lr_number_out = ''";
         $result_close = mysqli_query($mycon, $sql_query_close);
		  $count_close_lr = mysqli_num_rows($result_close);
		 	
           if ($count_close_lr == 0) {
			 $sql_query_close_lr="SELECT vehicle_number FROM `packed_quantity_data` WHERE order_id='".$invoice_nmr."' LIMIT 0,1";
              $result_close_lr = mysqli_query($mycon, $sql_query_close_lr);
                   if (mysqli_num_rows($result_close_lr) > 0) {
			          while ($rowcloselr = mysqli_fetch_assoc($result_close_lr)){  
                      $query ="Update dispatch_log set closed_on = now() WHERE vehicle_number='".$rowcloselr['vehicle_number']."'";
			          mysqli_query($mycon, $query);	
                  			  
		        }
		     }
		  } */

function get_of_packed($mycon,$order_id,$pro_code)
		{
			$sql_query_validation="SELECT * FROM `packed_quantity_data` where order_id='".$order_id."' and product_code='".$pro_code."'   ";
      $result = mysqli_query($mycon, $sql_query_validation);
       $total_packed=  mysqli_num_rows($result);
	return $total_packed;
		}
		function get_total_boxes($mycon,$order_id,$pro_code)
		{
			$sql_query_validation="SELECT * FROM `packed_quantity_data` where order_id='".$order_id."' and product_code='".$pro_code."' and outward_packing_box_id<>'' group by outward_packing_box_id  ";
      $result = mysqli_query($mycon, $sql_query_validation);
       $total_packed=  mysqli_num_rows($result);
	return $total_packed;
		}
		
		
		function get_data_invoice($mycon,$invoice_nmr)
		{
			$array_data=array();
			$sql_query_validation="SELECT order_id FROM `order_management` where invoice_number='".$invoice_nmr."'  ";
      $result = mysqli_query($mycon, $sql_query_validation);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			 $array_data[0]=$row['order_id'];
			 $array_data[1]=$row['picking_id'];
			
		  }
		 }
	return $array_data;
		}
		if($invoice_nmr!='')
		{
	$o_id=get_data_invoice($mycon,$invoice_nmr);
		}
		function get_invoice_number($mycon,$order_id)
   {
	  $sql_query="SELECT invoice_number FROM order_management where order_id='".$order_id."' " ;
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {  
			$invoice_number=$row['invoice_number'];
	
		  }
	
		  return $invoice_number;
   }
   }
?>
<?php
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
} ?>
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
		 .chosen-container{
	        width: 170px !important;
		    MARGIN-TOP: -25px;
              }
          label{
             font-size:11px !important;
             }
		  
		  .page-content {
              margin-top: 0;
              padding: 0;
              background-color: #fff;
              min-height: 700px !important;
             }
		 </style>
		 
		 <script>
		 
		 function close_vehicle(dispatch_id)
		 {
			
				 urll="close_dispatch.php?dispatch_id="+dispatch_id;
				//prompt("Copy to clipboard: Ctrl+C, Enter", urll);

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) 
				{
					
					if(this.responseText==1 )
					{
							alert('Closed');
						 window.location = "dispatch_module.php";
					}
					else
					{
						alert('ERROR');
					}
				}
				};
				xhttp.open("GET", urll, true);
				xhttp.send();
			
		 }
		 
		 function close_vehiclesccd(dispatch_id)
		 {
			urll="close_dispatch.php?dispatch_id="+dispatch_id;

			prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					if(this.responseText==1)
					{
						alert('Closed');
						 window.location = "dispatch_module.php";
					}
					else{
						alert('ERROR');
					}
				}
			}
		 
		 }
		 
		 function deletebox(box_id,p_code,order_id)
		 {
			 //urll="update_lr_to_box.php?box_id="+boxall_id+"&lr_no="+lr_number;
				
		  urll="delete_lr_to_box.php?box_id="+box_id;
	 
		//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		if(this.responseText==1)
		{
        $.ajax({
				type: 'GET',
				url: 'get_all_boxes_table.php',
				data: { p_code: p_code,order_id:order_id },
				success: function(data)
				{
				$('#reee').html(data);
				}
			});
			
			
			
				$.ajax({
				type: 'GET',
				url: 'get_all_details_table.php',
				data: { p_code: p_code,order_id:master_id_order },
				success: function(data)
				{
				$('#setall_data_div').html(data);
				}
			}); 
			
	
		}
		
		
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
		 }
		 
		 function scan_set_box_code(order_id,dispatch_id)
		 {
			 var lr_number_set= document.getElementById('lr_number_set').value;
			  var vehicle_number= document.getElementById('vehicle_number').value;
			 var transporter_name = document.getElementById('transporter_name').value;
			  var box_code_n= document.getElementById('box_code_n').value;
			  if(lr_number_set=='' || lr_number_set=='0')
			  {
				  alert('First Start Lr ');
				  
			  }else
			 if(vehicle_number=='' || vehicle_number=='0' || transporter_name=='' || transporter_name=='0' )
			 {
				 alert("Vehicle Number and Transporter Name Can not be left Blank");
			 }
			 else if(box_code_n=="" || box_code_n=='0') 
			 {
				 
			 }
			 else
			 {
			urll="update_lr_to_box.php?box_id="+box_code_n+"&lr_no="+lr_number_set+"&vehicle_number="+vehicle_number+"&transporter_name="+transporter_name+"&dispatch_id="+dispatch_id;

						//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) 
						{
							if(this.responseText==1)
							{
								$.ajax({
								type: 'GET',
								url: 'get_all_boxes_table.php',
								data: { order_id:order_id },
								success: function(data)
								{
								$('#reee').html(data);
								}
								});
								
								get_box_data_all(order_id);
								document.getElementById('box_code_n').value="";
							}
							else
							{
								alert('Invalid Box Code');
							}
						}
					};
					xhttp.open("GET", urll, true);
					xhttp.send();
			 }
			 
		 }
		 
		  function set_lr_number()
		 {
			var lr_number= document.getElementById('lr_number').value;
			if(lr_number=='' || lr_number==0 )
			{
				alert('Enter LR Number First');
			}
			else
			{
				document.getElementById('lr_number_set').value=lr_number;
				document.getElementById("start_btn").style.display = "none";
				document.getElementById("close_btn").style.display = "block";
				//start_btn
				//close_btn
			}
		 
		 }
		 
		 function close_lr_number()
		 {
			 document.getElementById('lr_number').value="";
			 document.getElementById('lr_number_set').value="";
			 document.getElementById("close_btn").style.display = "none";
				document.getElementById("start_btn").style.display = "block";
		 }
	/* 	
		 function get_all_checked_id_old(order_id)
		 {
			 var lr_number= document.getElementById('lr_number').value;
			  var p_code=document.getElementById('procode').value;
			  
			   if(p_code=='')
			 {
				 alert("Kndly Select Product First");
			 }else
			 if(lr_number=="" || lr_number=="0")
			 {
				 alert('Lr Number Can not be left Blank');
				 
			 }else
			 {
				 var count=0;
				 $boxall_id="";
			 
				 $("input:checkbox").each(function(){
					var $this = $(this);

					if($this.is(":checked")){
						
						if(count==0)
						{
							boxall_id=$this.attr("id")
						}
						else
						{
							boxall_id=boxall_id+"','"+$this.attr("id")
						}
						
						
						
						//someObj.fruitsGranted.push($this.attr("id"));
						count++;
						
					}else{
						//someObj.fruitsDenied.push($this.attr("id"));
					}
				});
				
				if(count==0)
				{
					alert("Kindly Check Alreast one CheckBox");
				}
				else
				{
				//urll="update_lr_to_box.php?box_id="+boxall_id+"&lr_no="+lr_number;
				
		  urll="update_lr_to_box.php?box_id="+boxall_id+"&lr_no="+lr_number;
	 
	//	prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		if(this.responseText==1)
		{
				$.ajax({
				type: 'GET',
				url: 'get_all_boxes_table.php',
				data: { p_code: p_code,order_id:order_id },
				success: function(data)
				{
				$('#reee').html(data);
				}
			});
	
		}
		
		
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
  	
				}
			 }
		 } */
		 function save_vehicle_transporter(invoice_number,master_id_order)
		 {
			 var vehicle_number= document.getElementById('vehicle_number').value;
			 var transporter_name = document.getElementById('transporter_name').value;
			 var p_code=document.getElementById('procode').value;
			 
			  $("#vikspan").text(vehicle_number);
			  document.getElementById('vikspan').value = vehicle_number;
			 
			 if(vehicle_number=='' || vehicle_number=='0' || transporter_name=='' || transporter_name=='0' )
			 {
				 alert("Vehicle Number and Transporter Name Can not be left Blank");
				 $("#vikspan").text(vehicle_number);
			     document.getElementById('vikspan').value = vehicle_number;
			 }
			 else
			 {
				 urll="insert_dispatch_auto_id.php?vehicle_number="+vehicle_number+"&transporter_name="+transporter_name;
				//prompt("Copy to clipboard: Ctrl+C, Enter", urll);

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) 
				{
					if(this.responseText!="0" )
					{
						 window.location = "dispatch.php?vehicle_number="+vehicle_number+"&transporter_name="+transporter_name+"&dispatch_id="+this.responseText;
						 $("#vikspan").text(vehicle_number);
			             document.getElementById('vikspan').value = vehicle_number;
					}
					else
					{
						alert('ERROR');
						$("#vikspan").text(vehicle_number);
			            document.getElementById('vikspan').value = vehicle_number;
					}
				}
				};
				xhttp.open("GET", urll, true);
				xhttp.send();
				
				
			 }
		
		 }
		 
		 function get_invoive_data(vehicle_number,transporter_name,dispatch_id,edit){
			 if(edit==1)
			 {
			   var search_invoice= document.getElementById('choose_select').value;
			 }
			 else
			 {
			   var search_invoice= document.getElementById('search_invoice').value;
			 }
			 var customer_name = document.getElementById('customer_name').value;
			 //alert(edit);
			 if(edit==1)
			 {
			 window.location = "dispatch.php?id="+search_invoice+"&c_name="+customer_name+"&vehicle_number="+vehicle_number+"&transporter_name="+transporter_name+"&dispatch_id="+dispatch_id+"&edit=1";
			 }
			 else
			 {
			 window.location = "dispatch.php?id="+search_invoice+"&c_name="+customer_name+"&vehicle_number="+vehicle_number+"&transporter_name="+transporter_name+"&dispatch_id="+dispatch_id;				 
			 }
		 }
		 
		 function getcustomer_name(edit)
		 {
			 
			 if(edit== 1)
			 {
			 search_invoice= document.getElementById('choose_select').value;
			 }
			 else
			 {
		     search_invoice= document.getElementById('search_invoice').value;
			 }
			 
			 //alert(search_invoice);
			 
			 if(search_invoice==""){
				
			 }else{
			
				urll="get_customer_name.php?data="+search_invoice;
				//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200){
		        if(this.responseText=="" || this.responseText=="0"){
			      alert("Invalid Invoice Number");
			   } else {
			var idm=this.responseText;
			if(idm =='-5')
			{
				alert('Kindly Map Invoice Details with Order ID');
				
			} else if(idm!='')
			{
				
			document.getElementById('customer_name').value=idm;
			
			 setTimeout(function() {
			
				var input = document.getElementById('customer_name');
				
				setCaretPosition(input, input.value.length);	
				
				document.getElementById("customer_name").disabled = true;
			 }, 25);
			 
			}
		}
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
  	
			}
			
		 }
		
function get_box_data_all_new(p_code,master_id_order)
{
	
 	 document.getElementById('procode').value=p_code;
	//alert("get_all_boxes_table.php?p_code="+p_code+"&order_id="+master_id_order);
			$.ajax({
				type: 'GET',
				url: 'get_all_boxes_table.php',
				data: { p_code: p_code,order_id:master_id_order },
				success: function(data)
				{
				$('#reee').html(data);
				}
			}); 
			
			//alert("get_all_details_table.php?p_code="+p_code+"&order_id="+master_id_order);
			 
				$.ajax({
				type: 'GET',
				url: 'get_all_details_table.php',
				data: {p_code: p_code,order_id:master_id_order  },
				success: function(data)
				{
				$('#setall_data_div').html(data);
				}
			}); 
		
}
function get_vehicle_set_transport()
{
	var vehicle_number=document.getElementById('vehicle_number').value;
	
				urll="get_tranporter_name.php?vehicle_number="+vehicle_number;
				//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		if(this.responseText=="" || this.responseText=="0")
		{
					
		}else 
		{
			 
			 
			document.getElementById('transporter_name').value=this.responseText;
			
				var input = document.getElementById('transporter_name');
				
				setCaretPosition(input, input.value.length);
					
				document.getElementById("transporter_name").disabled = true;
		}
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
	
	
}
function get_box_data_all(master_id_order)
{
	
/* 	 document.getElementById('procode').value=p_code;
	
			$.ajax({
				type: 'GET',
				url: 'get_all_boxes_table.php',
				data: { p_code: p_code,order_id:master_id_order },
				success: function(data)
				{
				$('#reee').html(data);
				}
			});  */
			 
				$.ajax({
				type: 'GET',
				url: 'get_all_details_table.php',
				data: {order_id:master_id_order },
				success: function(data)
				{
				$('#setall_data_div').html(data);
				}
			}); 
		
}

		 
		 </script>
		 <link rel="stylesheet" href="css/style.css">
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
                       <div class="col-md-12">
					   <h2 style="color:#2b3643; font-size:18; font-weight:bold; text-align:center; margin-top: -10px;"> Dispatch Process
                             </h2>
					   </div> 
                       <div class="col-md-12">
					   <div class="col-md-4">
					   <a href="dispatch_module.php"><button style="margin: 29px 15px;color:white;background:green;" type="button">Back</button></a>
					   
					   </div>
					   <div class="col-md-2" style="margin-left: -26px;">
	   <div class="form-group form-md-line-input form-md-floating-label has-success">
	  <label for="">Vehicle No</label>
	   
	   <?php if($vehicle_number != ''){ ?>
       
	   <input type="text" required value="<?php echo $vehicle_number; ?>" name="vehicle_number" class="form-control" id="vehicle_number"> 
	     
		 <?php } else { ?> 
	   
	   <select class="chosen" onchange="get_vehicle_set_transport()" id="vehicle_number" name="vehicle_number" style="width:500px;" data-placeholder="Choose Option...">
													      <option value="0" id="changeval" Selected="selected">Choose Option...</option>
																<?php

 $sql_query="SELECT scd.vehicle_number FROM `unloading_data` ud JOIN security_check_details scd on ud.relation_id=scd.relation_id where ud.process_type=2
 ";

        $result = mysqli_query($mycon, $sql_query);

  if (mysqli_num_rows($result) > 0) {
	 
	    while ($row = mysqli_fetch_assoc($result)) {  
		

  ?>
		  <option value="<?php echo  $row['vehicle_number'] ?>"><?php echo  $row['vehicle_number'] ?></option>											
                                                       
  <?php } }  ?>	

                                               </select>
											  <?php } ?>
											   
       
           </div>
            </div>
				<div class="col-md-2">
	 <div class="form-group form-md-line-input form-md-floating-label has-success">
      <input type="text" required value="<?php echo $transporter_name; ?>" <?php if($edit==1){?> disabled<?php } ?>  name="transporter_name" class="form-control" id="transporter_name">
    
 

											   <label for="" style="font-size: 15px;">Transporter Name</label>
        </div>
	    </div>	   
					<div class="col-md-3">
					
					<?php if($dispatch_id==''){ ?>
	 <button onclick="save_vehicle_transporter('<?php echo $invoice_nmr; ?>','<?php echo $o_id[0]; ?>')" type="button" class="btn btn-success" style="margin: 20px -5px;">Start Loding
	 
					<?php }else{ ?>
					 <button onclick="close_vehicle('<?php echo $dispatch_id; ?>')" type="button" class="btn btn-success" style="margin: 20px -5px;">Stop Loding
					<?php } ?>
</button>
	</div>   
	
					   
					   </div>	
					 
		<?php if($vehicle_number!='' && $transporter_name!=''){
			$style="display:block;";
		}else{
			$style="display:none;";
		} ?>
					      <div style="<?php echo $style; ?>" class="col-md-12">
                    <div class="col-md-12">
					 <div class="col-md-6">
							<h2 style="color:#2b3643; font-size:15px; font-weight:bold; text-align:center;"> Order Details				
                             </h2>
							 <div class="col-md-12 alert" style="height: 83px;">
							<div class="col-md-3">
	                         <div class="form-group form-md-line-input form-md-floating-label has-success">
							 <label for="" style="position: relative;top: -11px;"> Order Id </label>
							 <?php
							 if($edit ==1 ){
							 ?>
								<select class="chosen" onchange="getcustomer_name('<?php echo $edit ?>')" id="choose_select" name="choose_select" style="width:500px;" >
									<option value=""></option>
									<?php
                                    $sql_query="SELECT order_id FROM packed_quantity_data WHERE dispatched_auto_id='".$dispatch_id."' Group by order_id ";
                                    $result = mysqli_query($mycon, $sql_query);

									if (mysqli_num_rows($result) > 0) {

									while ($row = mysqli_fetch_assoc($result)) {  
                                    ?>
									<option value="<?php echo  $row['order_id'] ?>"><?php echo  $row['order_id'] ?></option>											

									<?php } }  ?>	

								</select>
                                        
							 <?php } else { ?>
                             <input type="text" value="<?php echo $invoice_nmr ?>" onchange="getcustomer_name('<?php echo $edit ?>')" name="search_invoice" class="form-control" id="search_invoice" style="margin-top:-22px;">
							 <?php } ?>
                             
                             </div>
                             </div>
	
                         <div class="col-md-7">
	                     <div class="form-group form-md-line-input form-md-floating-label has-success">
                         <input type="text"  value="<?php echo $c_name ?>" name="customer_name" class="form-control" id="customer_name">
                          <label for="">Customer Name</label>
                           </div>
						   </div>						   
						<div class="col-md-2">
						<button onclick="get_invoive_data('<?php echo $vehicle_number ?>','<?php echo $transporter_name; ?>','<?php echo $dispatch_id; ?>','<?php echo $edit ?>')" type="button" class="btn btn-success" style="margin: 20px 8px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
						</div>	
						</div>	
<div class="col-md-12 alert">
<div class="table-wrapper-scroll-y">
  <table class="table table-bordered">
     <thead>
      <tr>
	    <th>Product Code</th>
        <th>Product Desc</th>
		<th>Invoice Qty</th>
        <th>Packed Qty</th>
		<th>Total Boxes</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
	
	
 <?php 
 $sql_query_validation="SELECT *,sum(qty) as qty FROM `order_material`  WHERE order_id='".$invoice_nmr."' group by product_code  ";
      $result = mysqli_query($mycon, $sql_query_validation);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {   ?>
  
      <tr>
        <td><?php echo $row['product_code']; ?></td>
        <td><?php echo $row['product_desc']; ?></td>
        <td><?php echo $row['qty']; ?></td>
		<td><?php echo get_of_packed($mycon,$invoice_nmr,$row['product_code']); ?></td>
		<td><?php echo get_total_boxes($mycon,$invoice_nmr,$row['product_code']); ?></td>
		<td>
		<span>
		  <i onclick="get_box_data_all_new('<?php echo $row['product_code']; ?>','<?php echo $invoice_nmr; ?>')" class="fa fa-play" aria-hidden="true" style="color:green; font-size:16px;"></i>
		  </span>
		    <span style="display:none;">
			<i class="fa fa-minus-circle" onclick="delete_all_lr_data()" aria-hidden="true" style="color:red; font-size:16px;"></i>
			</span>
		  </td>
      </tr>
		 <?php }} ?>
    </tbody>
  </table>
  </div>
						
</div>
	</div>
<div class="col-md-6">
<h2 style="color:#2b3643; font-size:15px; font-weight:bold; text-align:center;"> Box Summary </h2>	
 <div class="col-md-12 alert" style="margin-top:0px;">
	<div class="col-md-5" >
	 <div class="form-group form-md-line-input form-md-floating-label has-success">
      <input type="text" value="" name="lr_number" class="form-control" id="lr_number">
	   <input type="hidden" name="lr_number_set" class="form-control" id="lr_number_set">
       <label for="">Enter LR No</label>
        </div>
	    </div>
		
			<div id="start_btn" class="col-md-2">
	        <button onclick="set_lr_number()" type="button" class="btn btn-success" style="margin-top: 19px"><i class=""></i>Start 
       </button>
	</div>
	<div style='display:none;' id="close_btn" class="col-md-2">
	        <button onclick="close_lr_number()" type="button" class="btn btn-success" style="margin-top: 19px"><i class=""></i>Close LR 
       </button>
	</div>
	<div class="col-md-5" >
	 <div class="form-group form-md-line-input form-md-floating-label has-success">
      <input type="text" value="" name="box_code_n" class="form-control" onchange="scan_set_box_code('<?php echo $invoice_nmr; ?>','<?php echo $dispatch_id; ?>')" id="box_code_n">
       <label for="">Search Box Code</label>
        </div>
	    </div>
	</div>	

	<div class="col-md-12 alert">
	<div class="table-wrapper-scroll-y">
	<table id="reee" class="table table-hover table-bordered table-striped">
	 <thead>
      <tr>
        <th style="display:none;"><input  name="check_all" id="check_all" type="checkbox"></th>
        <th>Packed Box Code</th>
        <th>Product Code</th>
		<th>Invoice Number</th>
	  </tr>
    </thead>
    <tbody>
	
	<?php   $sql_query="SELECT pqd.*,om.invoice_number FROM packed_quantity_data pqd join order_management om on om.order_id=pqd.order_id where pqd.order_id='$invoice_nmr' group by pqd.outward_packing_box_id";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result)) 
		  {    
	  if($row['outward_packing_box_id']==''){}else{
	  ?>
 
      <tr>
        <td style="display:none;">
		<input  id="<?php echo $row['outward_packing_box_id'] ?>" name="<?php echo $row['outward_packing_box_id'] ?>" type="checkbox">
		</td>
        <td><?php echo $row['outward_packing_box_id']; ?></td>
        <td><?php echo $row['product_code']; ?></td>
		
		  <td><?php echo $row['invoice_number']; ?></td>
		 
      </tr>
	  <?php } } } ?>
    </tbody>

																	  
    </table>
																	  
																	  
	
  </div>
		</div>		
			</div>
				</div> 
					   <div class="clearfix"></div>
					   <div class="col-md-12">
					    <div class="col-md-12">
					   <div class="col-md-3">
					   <div class="form-group form-md-line-input form-md-floating-label has-success" style="margin-bottom: 12px; display:none;">
                            <input type="text" value="" name="t_name" class="form-control" id="form_control_1">
							  <label for="">Search Box or Product bar code</label>
                                </div>
					   </div>
					   </div>
					   <div class="col-md-12">
					
					   <table id="setall_data_div" class="table table-hover table-bordered table-striped">
					     <thead>
      <tr class="poke">
         <th>LR Number</th>
         <th>Order No</th>
         <th>Invoice Number</th>
		 <th>Box Code</th>
		 <th>Product Code</th>
		 <th style="display:none">Customer Name</th>
		 <th>Dispatch Date</th>
		 <th>Vehicle Number</th>
		 <th>Transporter Name</th>
		 <th style="display:none">Action</th>
	  </tr>
    </thead>
    <tbody>
  
 <?php   //$sql_query="SELECT * FROM generate_vehicle_code where pro_code='$p_code' and order_id='$order_id' and lr_number_out<>'' group by outward_packing_box_id";
 $sql_query="SELECT * FROM packed_quantity_data WHERE order_id='$invoice_nmr' and lr_number_out<>'' group by outward_packing_box_id";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 
          while ($row = mysqli_fetch_assoc($result))  {    ?>
  
      <tr>
           <td><?php echo $row['lr_number_out']; ?></td>
           <td><?php echo $row['order_id']; ?></td>
           <td><?php echo get_invoice_number($mycon,$row['order_id']); ?></td>
		   <td><?php echo $row['outward_packing_box_id']; ?></td>
		   <td><?php echo $row['product_code']; ?></td>
		   <td style="display:none"><?php echo ""; ?></td>
		   <td><?php echo $row['dispatched_at']; ?></td>
		   <td><?php echo $row['vehicle_number']; ?></td>
		   <td><?php echo $row['transporter_name']; ?></td>
		   <td style="display:none"><span>
		   <i onclick="deletebox('<?php echo $row['outward_packing_box_id']; ?>','<?php echo $row['product_code']; ?>','<?php echo $row['order_id']; ?>')" class="fa fa-trash"  aria-hidden="true" style="color:red; font-size:16px;"></i>
		   </span></td>
      </tr>
	  
		
     <?php } } ?>
     
	 
	 
    </tbody>  
																	  
    </table>
					
					
	 <input type="hidden" name="procode" class="form-control" id="procode">
	 
					    </div>
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
			  </div>
			
        </div>
		
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->

<script>
	
 function setCaretPosition(ctrl, pos) {

  // Modern browsers
  if (ctrl.setSelectionRange) {
    ctrl.focus();
    ctrl.setSelectionRange(pos, pos);
  
  // IE8 and below
  } else if (ctrl.createTextRange) {
    var range = ctrl.createTextRange();
    range.collapse(true);
    range.moveEnd('character', pos);
    range.moveStart('character', pos);
    range.select();
  }
}
</script>
<script>
		 $("#check_all").click(function () {
			
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 </script>
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
		 <script src="js/choosen.js"></script>
  <script type="text/javascript">
$(".chosen").chosen();
</script>
    </body>

</html>