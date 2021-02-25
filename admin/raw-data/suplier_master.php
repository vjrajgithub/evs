 <?php 
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
   
   $mm_id= $_GET['mm_id'];
   function get_supplier_details($id,$mycon)
   {
	   $data_array=array();
	    $sql_query="SELECT * FROM `unloading_sender_details` where id='".$id."'";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 $row = mysqli_fetch_assoc($result);
            $data_array=$row;
		  return  $data_array;
   }
   }
   
  $get_all_data=get_supplier_details($mm_id,$mycon);
  
   ?>

<!DOCTYPE html>

<html lang="en">
    
        <meta charset="utf-8" />
        <title><?php echo $header_project_name; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for edit product" name="description" />
        <meta content="Vikas Singh" name="author" />
        <?php include 'shared/header.php';?>
         <style>
		 .select2-container--bootstrap .select2-selection{
			 border:none;
			 border-bottom:2px solid #27a4b0;
		 }
		 </style>
		 <script>
		 function add_suplier(m_id)
		 {
			 
			var suplier_code = document.getElementById('suplier_code').value;
			var company_name = document.getElementById('company_name').value;
			var add1 = document.getElementById('add1').value;
			var add2 = document.getElementById('add2').value;
			var city = document.getElementById('city').value;
			var state = document.getElementById('state').value;
			var state_code = document.getElementById('state_code').value;
			var country = document.getElementById('country').value; 
			var region = document.getElementById('region').value; 
			var phone_no = document.getElementById('phone_no').value; 
			var office_no = document.getElementById('office_no').value;
			var e_mail = document.getElementById('e_mail').value;
			var Product_supply = document.getElementById('Product_supply').value;
			var person_name = document.getElementById('person_name').value;
			var client_status = document.getElementById('client_status').value;
			var pint_code = document.getElementById('pint_code').value;
			var gst_resistration_no = document.getElementById('gst_resistration_no').value;
			
			 /* if(suplier_code=="" || suplier_code=="0")
		      {
			 alert('Select Suplier Code');
			
		     }else */
		     if(company_name=="" || company_name=="0")
		     {
			 alert('Select Company Name');
			
		     }else
		     if(add1=="" || add1=="0")
		     {
			 alert('Select Address1');
			
		     }else
		     if(add2=="" || add2=="0")
		     {
			 alert('Select Address2');
			
		     }else
		     if(city=="" || city=="0")
		     {
			 alert('Select City');
			
		     }else
		     if(state=="" || state=="0")
		     {
			 alert('Select State');
			
		     }/* else if(state_code=="" || state_code=="0")
		     {
			 alert('Select  select State Code');
			
		     } else
		     if(country=="" || country=="0")
		     {
			 alert('Select  Country');
			
		    else
		     if(region=="" || region=="0")
		     {
			 alert('Select  Region');
			
		     } }*/
		     /*else
		     if(phone_no=="" || phone_no=="0")
		     {
			 alert('Select  Phone Number');
			
		     }

			 else if(office_no=="" || office_no=="0")
		     {
			 alert('Select  Office Number');
			
		     }else
		     if(e_mail=="" || e_mail=="0")
		     {
			 alert('Select  E-Mail Address');
			
		     }*//* else  if(Product_supply=="" || Product_supply=="0")
		     {
			 alert('Select  Product Supply');
			
		     } else
		     if(person_name=="" || person_name=="0")
		     {
			 alert('Select  Person Name');
			
		     }else
		     if(client_status=="" || client_status=="0")
		     {
			 alert('Select  Suplier Status');
			
		     }else
		     if(pint_code=="" || pint_code=="0")
		     {
			 alert('Select  Pin Code');
			
		     }else
		     if(gst_resistration_no=="" || gst_resistration_no=="0")
		     {
			 alert('Select  GST Registration/VAT');
			
		     }*/
	    else{
	   
	 
         /*   urll="send_suplier_data_to_server.php?data="+suplier_code+"~"+company_name+"~"+add1+"~"+add2+"~"+city+"~"+state+"~"+state_code+"~"+country+"~"+region+"~"+phone_no+"~"+office_no+"~"+e_mail+"~"+Product_supply+"~"+person_name+"~"+client_status+"~"+pint_code+"~"+gst_resistration_no+"~"+<?php echo $mm_id; ?>;
			 */
			 
urll="send_suplier_data_to_server.php?data="+suplier_code+"~"+company_name+"~"+add1+"~"+add2+"~"+city+"~"+state+"~"+state_code+"~"+country+"~"+region+"~"+phone_no+"~"+office_no+"~"+e_mail+"~"+Product_supply+"~"+person_name+"~"+client_status+"~"+pint_code+"~"+gst_resistration_no+"~"+m_id;
			
			
			
			//prompt("Copy to clipboard: Ctrl+C, Enter", urll);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
	{
		if(this.responseText==1)
		{
			alert('Data has been saved Successfully..');
			window.location = "master_suplier.php";
		}
    }
  };
  xhttp.open("GET", urll, true);
  xhttp.send();
				 
			 }
				 
		 }
		 
		   
	  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

		 </script>
		 
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
                        <!-- BEGIN PAGE HEADER-->                                     
                        <!-- END PAGE HEADER-->
                        <div class="row">
                             <div class="col-md-12">
                              <a href="master_suplier.php"><button type="button" class="btn btn-info pull-right">Back</button></a>
                           </div> 
                            <div class="col-md-12">
                                <form  action="#">                                 
							   <div class="col-md-6">
								 <div style="display:none" class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input type="text" class="form-control" id="suplier_code" name="suplier_code">
                                                    <label for="form_control_1">Suplier Code</label>
                                                </div>
								 <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['company_name']; ?>" type="text" class="form-control" id="company_name" name="company_name">
                                                    <label for="form_control_1">Company Name</label>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['sender_address1']; ?>" type="text" class="form-control" id="add1" name="add1">
                                                    <label for="form_control_1">Address1 </label>
                                                </div> 
												
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['sender_address']; ?>" type="text" class="form-control" id="add2" name="add2">
                                                    <label for="form_control_1">Address 2</label>
                                                </div>
												
								 
								<div class="form-group form-md-line-input form-md-floating-label has-info">
                                                 
													 <div class="form-group form-md-line-input form-md-floating-label has-info">
                                                    <select onchange="change_state()" class="form-control edited" id="state">
                                                        <option value="0">Please Select</option>
														
														<?php 
														
														   $sql_query="SELECT * FROM `state_master`";
														  $result = mysqli_query($mycon, $sql_query);
															 if (mysqli_num_rows($result) > 0) {
																 
															  while ($row = mysqli_fetch_assoc($result)) {
																    if($get_all_data['state']==$row['state_id']){
															  ?>
														  
                                                        <option selected value="<?php echo $row['state_id']; ?>"><?php echo $row['state_name']; ?></option>
                                                   
														
																	<?php }else{?>
   <option value="<?php echo $row['state_id']; ?>"><?php echo $row['state_name']; ?></option>
															 <?php }}} ?>
                                                    </select>
                                                    <label for="form_control_1">State</label>
                                                </div>
												
                                                 
                                                </div>
												
												
												
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    			<div id="district">
<label for="form_control_1">City</label>
		<select class="form-control edited" id="city">
			 <option value="0">Please Select</option>
			 <?php 
			
			   $sql_query="SELECT * FROM `city_master` where state_id='".$get_all_data['state']."'";
			  $result = mysqli_query($mycon, $sql_query);
				 if (mysqli_num_rows($result) > 0) {
					 
				  while ($row = mysqli_fetch_assoc($result)) {  
				  if($row['city_id']==$get_all_data['city'])
				  {

				  ?>
			  
			<option selected value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
	   
			
				  <?php }else{ ?>
				  
			<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
	   
				  <?php } }} ?>
		  
		</select>
</div>
                                                </div>
												
												
												 <div style="display:none" class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input type="text" class="form-control" id="state_code" name="state_code">
                                                    <label for="form_control_1">State Code</label>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-info">
                                                   <select class="form-control edited" id="country" name="country">
												    <option value="1">INDIA</option>
                                  </select>
                                                    <label for="form_control_1">Country</label>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-info">
                                                    <select class="form-control edited" id="region" name="region">
                                                       
                                                                                                 <?php

 $sql_query="SELECT * FROM  region ";
        $result = mysqli_query($mycon, $sql_query);
  if (mysqli_num_rows($result) > 0) {
	
	    while ($row = mysqli_fetch_assoc($result)) {  
		
		if($get_all_data['region']==$row['id'])
		{
		
  ?>
		  <option selected value="<?php echo  $row['id'] ?>"><?php echo  $row['region'] ?></option>											
                                                       
		<?php }else{ ?>
		 <option value="<?php echo  $row['id'] ?>"><?php echo  $row['region'] ?></option>											
		
		<?php } }} ?>
                                                    </select>
                                                    <label for="form_control_1">Region</label>
                                                </div>
													 <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['pin_code']; ?>" onkeypress="return isNumberKey(event)" type="text" class="form-control" id="pint_code" name="pin_code">
                                                    <label for="form_control_1">Pin Code</label>
                                                </div>
												
								 </div>							 
								 <div class="col-md-6">
								 <div class="form-group ">
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['phone_no']; ?>" onkeypress="return isNumberKey(event)" type="text" class="form-control" id="phone_no" name="phone_no">
                                                    <label for="form_control_1">Phone No.</label>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['office_no']; ?>" onkeypress="return isNumberKey(event)" type="text" class="form-control" id="office_no" name="office_no">
                                                    <label for="form_control_1">Office No</label>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['e_mail']; ?>" type="email" class="form-control" id="e_mail" name="e_mail">
                                                    <label for="form_control_1">E-Mail</label>
                                                </div>
                                           <div class="portlet  ">                               
                                    <div class="portlet-body">                                    
                                  <div style="display:none" class="form-group form-md-line-input form-md-floating-label has-info">
                                                                          <select class="form-control edited" id="Product_supply" name="Product_supply">
                                                        <option value=""></option>
                                                       
                                                    </select>
                                                    <label for="form_control_1">Product Supply</label>
                                                </div>
                                        
                                    </div>
                                </div>
                                                </div>
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['contact_person']; ?>" type="text" class="form-control" id="person_name" name="person_name">
                                                    <label for="form_control_1">Contact Person Name</label>
                                                </div>
								 <div class="form-group form-md-line-input form-md-floating-label has-info">
                                                    <select class="form-control edited" id="client_status" name="client_status">
													
													<?php if($get_all_data['client_status']==1) {?>
													
                                                        <option selected value="1">ACTIVE</option>
														 <option value="2">IN-ACTIVE</option>
														 
													<?php }else if($get_all_data['client_status']==2){ ?>
													<option  value="1">ACTIVE</option>
													<option selected value="2">IN-ACTIVE</option>
                                                    <?php }else { ?>   
													<option  value="1">ACTIVE</option>
													<option  value="2">IN-ACTIVE</option>
													<?php } ?>   
													
                               
                                                    </select>
                                                    <label for="form_control_1">Suplier Status</label>
                                                </div>
								
								 
								
											
												 
												
												<div class="form-group form-md-line-input form-md-floating-label has-success">
                                                    <input value="<?php echo $get_all_data['gst_registration']; ?>" type="text" class="form-control" id="gst_resistration_no" name="gst_resistration_no">
                                                    <label for="form_control_1">GST Registration/VAT Number</label>
                                                </div>
												
												
								 
								 </div>	
                               <button type="button" onclick="add_suplier('<?php echo $mm_id; ?>')" class="btn btn-success pull-right" style="margin:11px 16px;">save</button>								 
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
         
            </div>
            <!-- END CONTAINER -->
            
			
			
        </div>
		
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
		<script>
		function change_state()
	  {
		 
		  var state = document.getElementById('state').value;
		  
		 $("#district").load("get_data_location.php?state="+state+"&type=state");
		// alert("get_data_location.php?state="+state+"&type=state");
	  }
	  </script>
	  
        <?php include 'shared/footer.php';?>
    </body>

</html>