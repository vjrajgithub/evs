<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

$msg = '';

if ($_POST) {
  
  //print_r($_POST); die('check');
  
  $user_id = $_SESSION['id'];
  $name = $_POST['name'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $client_id = $_POST['client_id'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  
  $department = departmentdata($_POST['role']);
  
  $secure_check = sanitize_my_email($email);
  
  //echo $department;

  if ($name == "") {
	$msg = " * Name is Required <br />"; 
  } else

  if ($username == "") {
	$msg = " * Username is Required <br />";
  } else

  if ($department == "") {
	$msg = " * Department is Required <br />";
  } else

  if ($contact == "") {
	$msg = " * Contact is Required <br />";
  } else

  if ($email == "") {
	$msg = " * Email Address is Required <br />";
  } else
  
  if ($secure_check == false) {
    echo "Invalid input";
  } else
  
  if ($client_id == "") {
	$msg = " * Customer is Required <br />";
  } else

  if ($password == "") {
	$msg = " * Password is Required <br />";
  } else

  if ($cpassword == "") {
	$msg = " * Conform Password is Required <br />";
  } else
  
  if ($name && $username && $password && $cpassword) {
   //print_r($_POST); die('check');
	if ($password == $cpassword) {
		$newPassword = md5($password);
	  if (userExists($username) === TRUE) {
		$msg = $_POST['username'] . " already exists !!";
	  } else {
		$filename = $_FILES['avatar']['name'];
        $target_dir = "upload/user-profile/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
		if($filename != ''){
			$filename = time() ."-".$filename;
		} else if($_POST['updatedavatar'] != ''){ 
		    $filename = $_POST['updatedavatar'];
		} 
		
		//echo $filename; die('check');
        //print_r($_POST); die('check');
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
          if( in_array($imageFileType,$extensions_arr) ){
			//print_r($_POST); die('check');
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['avatar']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
			
			move_uploaded_file($_FILES['avatar']['tmp_name'],'upload/user-profile/'.$filename);
			}
			if ($admin_edit_id !='') {
			$sql = "UPDATE users SET username = '$username', name = '$name', department = '$department', contact = '$contact', email = '$email', client_id = '$client_id', avatar = '$filename' WHERE id = '$admin_edit_id'";
			} else {
			$sql = "INSERT INTO `users` (`username`, `password`, `name`, `department`, `role`, `contact`, `email`, `avatar`, `active`, `client_id`) VALUES ('$username', '$newPassword', '$name', '$department', '$role', '$contact', '$email', '$filename', '1', '$client_id')";
			}
			//echo $sql;
			//print_r($_POST); die('check');
			$result = mysqli_query($mycon, $sql);
			if ($result) {
				$customerdata = getcustomerById($client_id);
                $client = $customerdata['customer_name'];
				
				$user_message1 ="Dear ".$name.",\n Your account has been successfully completed, The credentials have been given below-\n Link: https://www.himadi.in/evs-client/ ,\n Username:".$username.",\n Password: ".$password."\n \n --\n Thanks,\n Himadi Solution";
				                 
				$user_message ="Dear ".$name.",<br /> 
				                 Your account has been successfully completed, The credentials have been given below-<br />
				                 Link: https://www.himadi.in/evs-client/ ,<br />
				                 Username:".$username.",<br />
				                 Password: ".$password."<br />
				                 <br />
				                 <br />
				                 --<br />
				                 Thanks,<br />
				                 Himadi Solution";
				                 
			    $user_subject = "Thank You for registering with Himadi Solutions";
				
				$admin_message ="New user registration ".$name." with client- ".$client." in the Himadi EVS Portal. \n\n Added new user details:- \n Username :".$username." \n	Password:".$password." \n Client:".$client." \n	Name:".$name." \n Contact:".$contact." \n Email: ".$email." \n ";  
				
				$admin_subject = "New user registration ".$name." with client-". $client." in the Himadi EVS Portal.";
			    
			    $admin_message1 ="Added new user details:- <br />
				Username :".$username." <br />
				Password:".$password." <br />
				Client:".$client." <br />
				Name:".$name." <br />
				Contact:".$contact." <br />
				Email: ".$email."";
			    
				
				$sms_notification_to_user = send_sms_user($contact, $name, $user_message1, $user_subject);
				$email_notification_to_user = send_email_user($client, $himadiData['email'], $email, $user_subject, $user_message);
				$sms_notification_to_admin = send_sms_admin($himadiData['phone_number'], $name, $admin_message, $admin_subject);
				$email_notification_to_admin = send_email_admin($client, $himadiData['email'], $himadiData['email'], $admin_subject, $admin_message1);
				//$notification = send_notification($user_id, $title, $notification_message, $type);
				$msg = "Record Successfully Added | <a href='userlist.php' color='Green'>User List</a>";
				//header("Location: userlist.php");
			} else {
		     $msg = "Error";
		   }
        
	  }
	} else {
	  $msg = " * Password does not match with Conform Password <br />";
	}
  } else {
	  $msg = " * Fill all require fields <br />";
	}
}
?>
<!--************* Css Link **********************-->
<!-- <link rel="icon" href="../assets/images/fav_icon.png" type="image/x-icon"> -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="../assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../assets/icon/feather/css/feather.css">
<link rel="stylesheet" type="text/css" href="../assets/css/component.css">
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">

<!-- cdn css link start ===================-->

<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/keyTable.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/scroller.bootstrap4.min.css" />

<!--********* cdn css link END ******-->
<style>
	.pcoded-inner-content {
		padding: 10px 10px 10px 10px !important;
	}
</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<div class="pcoded-content">
	<div class="pcoded-inner-content">

		<div class="main-body">

			<div class="page-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header table_hdr">
								<!--    <h5 style="text-align:center;"></h5> -->
								<!-- Toolkit html code -->

								<!-- Toolkit html code -->
							</div>

							<div class="card-block">
								<!--======== modal State code in html ================-->

								<form class="login-form" action="" method="POST" enctype="multipart/form-data">
									<!-- <h3 class="form-title font-green"><img src="../assets/pages/img/logo.PNG" alt=""></h3> -->
									<div class="alert alert-danger display-hide" style="border: 0;
										 padding-left: 0;
										 color: #920706;
										 font-weight: 700;
										 letter-spacing: 0.6px;
										 padding-bottom: 0;">
										<button class="close" data-close="alert"></button>
										<h3> Create New User Account </h3>
										<p><?php echo $msg; ?></p>
									</div>

									<div>
										<label for="fname">Full Name: </label>
										<input type="text" class="form-control" style="max-width:50%"  name="name" placeholder="Full Name" autocomplete="off" value="<?php echo $adminInfo['name']; ?>" />
									</div>
									<br>

									<div>
										<label for="department">Role & Department : </label> 
										<select name="role" class="form-control" style="max-width:50%">
										<option value="">--Select--</option>
										<?php if($userRole == 1 || $userRole == 2 || $userRole == 29){
											$sql_query12 = "SELECT * FROM tbl_roles ORDER By priority";
										    } else {
											$sql_query12 = "SELECT * FROM tbl_roles WHERE roleId = 28";
										    }
										   $result12 = mysqli_query($mycon, $sql_query12);
											 if (mysqli_num_rows($result12) > 0) { 
												while ($row12 = mysqli_fetch_assoc($result12)) { 
											    if($row12['description'] != ''){ $description = " - ".$row12['description']; } else { $description = ""; } ?>
											    <option value="<?php echo $row12['roleId']; ?>" <?php if($adminInfo['role'] == $row12['roleId']){ echo "selected"; } ?>><?php echo $row12['role'].$description; ?></option>
											 <?php }   }  ?>
										</select>
									</div>
									<br>

									<div>
										<label for="username">Username: </label>
										<input type="text" name="username" class="form-control" style="max-width:50%" placeholder="Username" autocomplete="off" value="<?php echo $adminInfo['username']; ?>" />
									</div>
									<br>

									<div>
										<label for="password">Password: </label>
										<input type="password" class="form-control"  style="max-width:50%" name="password" placeholder="Password" autocomplete="off" />
									</div>
									<br>

									<div>
										<label for="cpassword">Conform Password: </label>
										<input type="password" name="cpassword"  style="max-width:50%" class="form-control" placeholder="Conform Password" autocomplete="off" />
									</div>
									<br>
									<div>
										<label for="contact">Contact No.: </label>
										<input type="text" name="contact" style="max-width:50%"  class="form-control" placeholder="Contact" autocomplete="off" value="<?php echo $adminInfo['contact']; ?>" />
									</div>
									<br>

									<div>
										<label for="email">Email: </label>
										<input type="text" name="email" style="max-width:50%"  class="form-control" placeholder="Email" autocomplete="off" value="<?php echo $adminInfo['email']; ?>" />
									</div>
									<br>
									<div>
										<label for="email">Profile Picture: </label>
										<input type="file" name="avatar" style="max-width:50%"  class="form-control" />	
										<?php if($adminInfo['client_id'] != ''){ ?>
										<input type="hidden" name="updatedavatar" value="<?php echo $adminInfo['avatar']; ?>">  
										<img src="upload/user-profile/<?php echo $adminInfo['avatar']; ?>" alt="Smiley face" width="100">
										<?php } ?>
									</div>
									<br>
									<div>
										<label for="department">Customer: </label> 
										<select name="client_id" class="form-control" style="max-width:50%">
										<option value="">--Select--</option>
										<?php if($userRole == 1 || $userRole == 2 || $userRole == 29){
											$sql_query1 = "SELECT * FROM customer_master ORDER By customer_name";
										    } else {
											$sql_query1 = "SELECT * FROM customer_master WHERE customer_id = '".$userdata['client_id']."'";
										    }
											//echo $sql_query1;
										   $result1 = mysqli_query($mycon, $sql_query1);
											 if (mysqli_num_rows($result1) > 0) { 
												while ($row1 = mysqli_fetch_assoc($result1)) { ?>
											    <option value="<?php echo $row1['customer_id']; ?>" <?php if($adminInfo['client_id'] == $row1['customer_id']){ echo "selected"; } ?>><?php echo $row1['customer_code']."-".$row1['customer_name']; ?></option>
											 <?php }   }  ?>
										</select>
									</div>
									<br>

									<div style="padding: 20px 0;">
										<button type="submit" class="btn btn-primary">Submit</button>
										<button type="reset" class="btn btn-danger" style="background-color:#010066;  border-color:#010066 !important"><a style="color:#fff;">Reset</a></button>
										<button type="reset" class="btn btn-secondary" style="background-color:#010066;  border-color:#010066 !important"><a style="color:#fff;" href="userlist.php">Back</a></button>
									</div>

								</form>

							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
<?php include 'includes/footer.php'; ?>
</div>
</div>
</div>
</div>

<!--==================== Start Script Link ======================-->

<script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="../assets/js/datatable.js" type="text/javascript"></script> -->
<!-- <script src="../assets/js/datatable.min.js" type="text/javascript"></script> -->
<script src="../assets/js/table-datatables-buttons.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<script src="../assets/js/pcoded.min.js" type="text/javascript"></script>
<script src="../assets/js/vartical-layout.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/modal.js"></script>
<script type="text/javascript" src="../assets/js/modalEffects.js"></script>
<script src="../assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script> -->

<!--================= cdn link datatable start===================-->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> -->

</body>

</html>