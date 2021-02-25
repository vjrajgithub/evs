<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

if ($_POST) {
  
  //print_r($_POST); die('check');
  
  $user_id = $_SESSION['id'];
  $name = $_POST['name'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $client_id = $_POST['client_id'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  
  $department = departmentdata($_POST['role']);
  $secure_check = sanitize_my_email($email);
  
  //echo $department;

  if ($name == "") {
	$msg = " * Full Name is Required <br />"; 
  } else

  if ($username == "") {
	$msg = " * Username is Required <br />";
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

  if ($name && $username) {

	//if ($password == $cpassword) {
		//$newPassword = md5($password);
	  if (userExistsupdate($username) === TRUE) {
		$msg = $_POST['username'] . " already exists !!";
	  } else {
		$filename = $_FILES['avatar']['name'];
        $target_dir = "upload/user-profile/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
		if($filename != ''){
			$filename = time() ."-".$filename;
		} else { 
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
		$sql = "UPDATE users SET username = '$username', name = '$name', contact = '$contact', email = '$email',  avatar = '$filename' WHERE id = '$user_id'";
			
			//echo $sql;
			//print_r($_POST); 
			//die('check');
			
			$result = mysqli_query($mycon, $sql);
	        if ($result) {
				$msg123 = "Record Successfully Updated";
		       header("Location: user-profile.php?msgprt=$msg123");
		   } else {
		     $msg = "Error";
		   }
	  }
	
  } else {
	  $msg = " * Fill all require fields <br />";
	}
}



if ($userdata['role'] == '2' || $userdata['role'] == '3') {
  $user_location = $userdata['org_id'];
  $user_client = $userdata['client_id'];
  $role_item = " AND organization_id = '" . $user_location . "'";
  $loc_item = " AND loc_code = '" . $user_location . "' AND cust_code IN (" . $client_ids . ")";
} else {
  $role_item = '';
  $loc_item = '';
}
?>
<?php include 'includes/head.php'; ?>
<!--************* Css Link **********************-->
<!-- <link rel="icon" href="files/../assets/images/fav_icon.png" type="image/x-icon"> -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="../assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../assets/icon/feather/css/feather.css">
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
<!-- cdn css link start ===================-->

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>


<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<div class="d-inline">
									<h4>My Profile</h4>
									<span></span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="page-header-breadcrumb">
								<!-- <ul class="breadcrumb-title">
								   <li class="breadcrumb-item">
									  <a href="dashboard.html"> <i class="feather icon-home"></i> </a>
								   </li>
								   <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
								   <li class="breadcrumb-item"><a href="#!">User Profile</a></li>
								</ul> -->
							</div>
						</div>
					</div>
				</div>
				<div class="page-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="cover-profile">
								<div class="profile-bg-img">
									<img class="profile-bg-img img-fluid" src="../assets/images/user-profile/bg-img.jpg" alt="bg-img">
									<div class="card-block user-info">
										<div class="col-md-12">
											<div class="media-left">
												<a href="#" class="profile-image">
													<img class="user-img img-radius" src="upload/user-profile/<?php 
													if ($userdata['avatar'] != '') {
													  $avatar_image = $userdata['avatar'];
													} else {
													  $avatar_image = 'Profile-icon.jpg';
													}
													echo $avatar_image; ?>" alt="user-img" style="width: 100px;">
												</a>
											</div>
											<div class="media-body row">
												<div class="col-lg-12">
													<div class="user-title">
														<h2><?php echo $userdata['name']; ?></h2>
														<span class="text-white"><?php 
														    if ($customername == '') {
															  $customername = 'Himadi';
															  $customercode = 'Super-Admin';
															} 
														echo $userdata['department'].' @'.$customername.' ('. $customercode.')'; ?> </span>
													</div>
												</div>
												<div>
													<div class="pull-right cover-btn">
														<a href="dashboard.php"><button type="button" class="btn btn-primary m-r-10 m-b-5">Back</button></a>
														<button type="button" class="btn btn-primary"><i class="icofont icofont-ui-messaging"></i> Message</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personal Info</a>
									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">User's Services</a>
									<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">User's Contacts</a>
									<a class="nav-item nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-contact" aria-selected="false">Reviews</a>

								</div>
							</nav>
							<div class="tab-content"  id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									<div class="card">
										<div class="card-header">
											<h5 class="card-header-text">About Me</h5>
											<button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
												<i class="icofont icofont-edit"></i>
											</button>
										</div>
										<div class="card-block">
											<div class="view-info">
												<div class="row">
													<div class="col-lg-12">
														<div class="general-info">
															<div class="row">
																<div class="col-lg-12 col-xl-6">
																	<div class="table-responsive">
                                                                        <table class="table m-0">
																			<tbody>
																				<tr>
																					<th scope="row">Full Name</th>
																					<td>
																						<?php echo $userdata['name']; ?>
																					</td>
																				</tr>
																				<tr>
																					<th scope="row">Phone</th>
																					<td><?php echo $userdata['contact']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Department</th>
																					<td><?php echo $userdata['department']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Name</th>
																					<td><?php echo $customerdata['customer_name']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Code</th>
																					<td><?php echo $customerdata['customer_code']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Address</th>
																					<td><?php echo $customerdata['address1'].' '.$customerdata['address2']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company City</th>
																					<td><?php echo $customerdata['city']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Contact Number</th>
																					<td><?php echo $customerdata['phone_number']; ?></td>
																				</tr>

																			</tbody>
                                                                        </table>
																	</div>
																</div>
																<div class="col-lg-12 col-xl-6">
																	<div class="table-responsive">
                                                                        <table class="table">
																			<tbody>
																				<tr>
																					<th scope="row">Username</th>
																					<td>
																						<?php echo $userdata['username']; ?>
																					</td>
																				</tr>
																				<tr>
																					<th scope="row">Email</th>
																					<td><a href="mailto:<?php echo $userdata['email']; ?>"><?php echo $userdata['email'] ?></a></td>
																				</tr>
																				<tr>
																					<th scope="row">Last Login</th>
																					<td>
																						<?php echo $userdata['login_time']; ?>
																					</td>
																				</tr>
																				<tr>
																					<th scope="row">Company Concerned Person</th>
																					<td>
																						<?php echo $customerdata['concerned_person']; ?>
																					</td>
																				</tr>
																				<tr>
																					<th scope="row">Company Country</th>
																					<td><?php echo $customerdata['country']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company State</th>
																					<td><?php echo $customerdata['state']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Pincode</th>
																					<td><?php echo $customerdata['pincode']; ?></td>
																				</tr>
																				<tr>
																					<th scope="row">Company Email</th>
																					<td><?php echo $customerdata['email']; ?></td>
																				</tr>
																			</tbody>
                                                                        </table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="edit-info">
												<div class="row">
													<div class="col-lg-12">
													<form class="login-form" action="" method="POST" enctype="multipart/form-data">
														<div class="general-info">
															<div class="row">
																<div class="col-lg-6">
																	<table class="table">
                                                                        <tbody>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon">
																							<i class="icofont icofont-user"></i></span>
																						<input type="text" name="name" class="form-control" placeholder="Full Name" autocomplete="off" value="<?php echo $userdata['name']; ?>"/>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon">
																							<i class="icofont icofont-user"></i></span>
																						<input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $userdata['username']; ?>">
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon"><i class="icofont icofont-email"></i></span>
																						<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $userdata['email']; ?>">
																					</div>
																				</td>
																			</tr>
																			
                                                                        </tbody>
																	</table>
																</div>
																<div class="col-lg-6">
																	<table class="table">
                                                                        <tbody>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon">
																							<i class="icofont icofont-user"></i></span>
																						<input type="text" name="status" class="form-control" placeholder="Active" value="<?php echo 'Active'; ?>">
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
																						<input type="text" name="contact" class="form-control" placeholder="Mobile Number" value="<?php echo $userdata['contact']; ?>">
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon">
																							<i class="icofont icofont-user"></i></span>
																						<input type="file" class="form-control" name="avatar" placeholder="Avatar">
																						<input type="hidden" name="updatedavatar" value="<?php echo $adminInfo['avatar']; ?>">
																					</div>
																				</td>
																			</tr>
                                                                        </tbody>
																	</table>
																</div>
															</div>
															<div class="text-center">
																<button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Update My Details</button>
										                        <button type="reset" class="btn btn-default waves-effect">Reset</button>
															</div>
														</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="card">
										<div class="card-header">
											<h5 class="card-header-text">User Services</h5>
										</div>
										<div class="card-block">
											<div class="row">
												<div class="col-md-6">
													<div class="card b-l-success business-info services m-b-20">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">Shivani Hero</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card b-l-danger business-info services">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">Dress and Sarees</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card b-l-info business-info services">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">Shivani Auto Port</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card b-l-warning business-info services">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">Hair stylist</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card b-l-danger business-info services">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">BMW India</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card b-l-success business-info services">
														<div class="card-header">
															<div class="service-header">
																<a href="#">
																	<h5 class="card-header-text">Shivani Hero</h5>
																</a>
															</div>
															<span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip">
															</span>
															<div class="dropdown-menu dropdown-menu-right b-none services-list">
																<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i> Edit</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i> Delete</a>
																<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i> View</a>
															</div>
														</div>
														<div class="card-block">
															<div class="row">
																<div class="col-sm-12">
																	<p class="task-detail">Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod temp or incidi dunt ut labore et.Lorem ipsum dolor sit amet, consecte.</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="card">
												<div class="card-header">
													<h5 class="card-header-text">Profit</h5>
												</div>
												<div class="card-block">
													<div id="main" style="height:300px;width: 100%;"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
									<div class="row">
										<div class="col-xl-3">
											<div class="card">
												<div class="card-header contact-user">
													<img class="img-radius img-40" src="../assets/images/avatar-4.jpg" alt="contact-user">
													<h5 class="m-l-10">John Doe</h5>
												</div>
												<div class="card-block">
													<ul class="list-group list-contacts">
														<li class="list-group-item active"><a href="#">All Contacts</a></li>
														<li class="list-group-item"><a href="#">Recent Contacts</a></li>
														<li class="list-group-item"><a href="#">Favourite Contacts</a></li>
													</ul>
												</div>
												<div class="card-block groups-contact">
													<h4>Groups</h4>
													<ul class="list-group">
														<li class="list-group-item justify-content-between">
															Project
															<span class="badge badge-primary badge-pill">30</span>
														</li>
														<li class="list-group-item justify-content-between">
															Notes
															<span class="badge badge-success badge-pill">20</span>
														</li>
														<li class="list-group-item justify-content-between">
															Activity
															<span class="badge badge-info badge-pill">100</span>
														</li>
														<li class="list-group-item justify-content-between">
															Schedule
															<span class="badge badge-danger badge-pill">50</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Contacts<span class="f-15"> (100)</span></h4>
												</div>
												<div class="card-block">
													<div class="connection-list">
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-1.jpg" alt="f-1" data-toggle="tooltip" data-placement="top" data-original-title="Airi Satou">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-2.jpg" alt="f-2" data-toggle="tooltip" data-placement="top" data-original-title="Angelica Ramos">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-3.jpg" alt="f-3" data-toggle="tooltip" data-placement="top" data-original-title="Ashton Cox">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-4.jpg" alt="f-4" data-toggle="tooltip" data-placement="top" data-original-title="Cara Stevens">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-5.jpg" alt="f-5" data-toggle="tooltip" data-placement="top" data-original-title="Garrett Winters">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-1.jpg" alt="f-6" data-toggle="tooltip" data-placement="top" data-original-title="Cedric Kelly">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="images/user-profile/follower/f-3.jpg" alt="f-7" data-toggle="tooltip" data-placement="top" data-original-title="Brielle Williamson">
														</a>
														<a href="#"><img class="img-fluid img-radius" src="../assets/images/user-profile/follower/f-5.jpg" alt="f-8" data-toggle="tooltip" data-placement="top" data-original-title="Jena Gaines">
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-9">
											<div class="row">
												<div class="col-sm-12">
													<div class="card">
														<div class="card-header">
															<h5 class="card-header-text">Contacts</h5>
														</div>
														<div class="card-block contact-details">
															<div class="data_table_main table-responsive dt-responsive">
																<table id="simpletable" class="table  table-striped table-bordered nowrap">
																	<thead>
                                                                        <tr>
																			<th>Name</th>
																			<th>Email</th>
																			<th>Mobileno.</th>
																			<th>Favourite</th>
																			<th>Action</th>
                                                                        </tr>
																	</thead>
																	<tbody>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="afcecdcc9e9d9cefc8c2cec6c381ccc0c2">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="1071727321222350777d71797c3e737f7d">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="7312111042414033141e121a1f5d101c1e">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="65040706545756250208040c094b060a08">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="1776757426252457707a767e7b3974787a">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="5736353466656417303a363e3b7934383a">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="e7868584d6d5d4a7808a868e8bc984888a">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="8aebe8e9bbb8b9caede7ebe3e6a4e9e5e7">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="2a4b48491b18196a4d474b434604494547">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="ea8b8889dbd8d9aa8d878b8386c4898587">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="5332313062616013343e323a3f7d303c3e">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="2d4c4f4e1c1f1e6d4a404c4441034e4240">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="7f1e1d1c4e4d4c3f18121e1613511c1012">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="a6c7c4c5979495e6c1cbc7cfca88c5c9cb">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="fc9d9e9fcdcecfbc9b919d9590d29f9391">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="24454647151617644349454d480a474b49">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="81e0e3e2b0b3b2c1e6ece0e8edafe2eeec">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="9bfaf9f8aaa9a8dbfcf6faf2f7b5f8f4f6">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="85e4e7e6b4b7b6c5e2e8e4ece9abe6eae8">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="38595a5b090a0b785f55595154165b5755">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="8eefecedbfbcbdcee9e3efe7e2a0ede1e3">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td>abc1<a href="#" class="__cf_email__" data-cfemail="c9fbfa89aea4a8a0a5e7aaa6a4">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="9cfdfeffadaeafdcfbf1fdf5f0b2fff3f1">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star-o" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="8eefecedbfbcbdcee9e3efe7e2a0ede1e3">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="1372717022212053747e727a7f3d707c7e">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="24454647151617644349454d480a474b49">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="90f1f2f3a1a2a3d0f7fdf1f9fcbef3fffd">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="3b5a59580a09087b5c565a525715585456">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="7213101143404132151f131b1e5c111d1f">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="f9989b9ac8cbcab99e94989095d79a9694">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="1776757426252457707a767e7b3974787a">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="2140434210131261464c40484d0f424e4c">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="09686b6a383b3a496e64686065276a6664">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="8aebe8e9bbb8b9caede7ebe3e6a4e9e5e7">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="86e7e4e5b7b4b5c6e1ebe7efeaa8e5e9eb">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="2041424311121360474d41494c0e434f4d">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="e1808382d0d3d2a1868c80888dcf828e8c">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="6e0f0c0d5f5c5d2e09030f0702400d0103">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="aacbc8c99b9899eacdc7cbc3c684c9c5c7">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="0b6a69683a39384b6c666a626725686466">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="58393a3b696a6b183f35393134763b3735">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="fd9c9f9ecccfcebd9a909c9491d39e9290">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="38595a5b090a0b785f55595154165b5755">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="d7b6b5b4e6e5e497b0bab6bebbf9b4b8ba">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="a3c2c1c0929190e3c4cec2cacf8dc0ccce">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="34555657050607745359555d581a575b59">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="fb9a9998cac9c8bb9c969a9297d5989496">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="24454647151617644349454d480a474b49">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="d0b1b2b3e1e2e390b7bdb1b9bcfeb3bfbd">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="81e0e3e2b0b3b2c1e6ece0e8edafe2eeec">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
                                                                        <tr>
																			<td>Garrett Winters</td>
																			<td><a href="#" class="__cf_email__" data-cfemail="5d3c3f3e6c6f6e1d3a303c3431733e3230">[email&#160;protected]</a></td>
																			<td>9989988988</td>
																			<td><i class="fa fa-star" aria-hidden="true"></i></td>
																			<td class="dropdown">
																				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
																				<div class="dropdown-menu dropdown-menu-right b-none contact-menu">
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Edit</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Delete</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>View</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-tasks-alt"></i>Project</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-ui-note"></i>Notes</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-eye"></i>Activity</a>
																					<a class="dropdown-item" href="#!"><i class="icofont icofont-badge"></i>Schedule</a>
																				</div>
																			</td>
                                                                        </tr>
																	</tbody>
																	<tfoot>
                                                                        <tr>
																			<th>Name</th>
																			<th>Email</th>
																			<th>Mobileno.</th>
																			<th>Favourite</th>
																			<th>Action</th>
                                                                        </tr>
																	</tfoot>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="nav-review" role="tabpanel">
									<div class="card">
										<div class="card-header">
											<h5 class="card-header-text">Review</h5>
										</div>
										<div class="card-block">
											<ul class="media-list">
												<li class="media">
													<div class="media-left">
														<a href="#">
                                                            <img class="media-object img-radius comment-img" src="../assets/images/avatar-1.jpg" alt="Generic placeholder image">
														</a>
													</div>
													<div class="media-body">
														<h6 class="media-heading">Sortino media<span class="f-12 text-muted m-l-5">Just now</span></h6>
														<div class="stars-example-css review-star">
															<i class="icofont icofont-star"></i>
															<i class="icofont icofont-star"></i>
															<i class="icofont icofont-star"></i>
															<i class="icofont icofont-star"></i>
															<i class="icofont icofont-star"></i>
														</div>
														<p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
														<div class="m-b-25">
															<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
														</div>
														<hr>
														<div class="media mt-2">
															<a class="media-left" href="#">
																<img class="media-object img-radius comment-img" src="../assets/images/avatar-2.jpg" alt="Generic placeholder image">
															</a>
															<div class="media-body">
																<h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span></h6>
																<div class="stars-example-css review-star">
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																</div>
																<p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
																<div class="m-b-25">
																	<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
																</div>
																<hr>
																<div class="media mt-2">
																	<div class="media-left">
                                                                        <a href="#">
																			<img class="media-object img-radius comment-img" src="../assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                                        </a>
																	</div>
																	<div class="media-body">
                                                                        <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                                                        <div class="stars-example-css review-star">
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
                                                                        </div>
                                                                        <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                                        <div class="m-b-25">
																			<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                                                        </div>
																	</div>
																	<hr>
																</div>
															</div>
														</div>
														<div class="media mt-2">
															<div class="media-left">
																<a href="#">
																	<img class="media-object img-radius comment-img" src="../assets/images/avatar-1.jpg" alt="Generic placeholder image">
																</a>
															</div>
															<div class="media-body">
																<h6 class="media-heading">Cedric Kelly<span class="f-12 text-muted m-l-5">Just now</span></h6>
																<div class="stars-example-css review-star">
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																</div>
																<p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
																<div class="m-b-25">
																	<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
																</div>
																<hr>
															</div>
														</div>
														<div class="media mt-2">
															<a class="media-left" href="#">
																<img class="media-object img-radius comment-img" src="../assets/images/avatar-4.jpg" alt="Generic placeholder image">
															</a>
															<div class="media-body">
																<h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span></h6>
																<div class="stars-example-css review-star">
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																</div>
																<p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
																<div class="m-b-25">
																	<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
																</div>
																<hr>
																<div class="media mt-2">
																	<div class="media-left">
                                                                        <a href="#">
																			<img class="media-object img-radius comment-img" src="../assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                                        </a>
																	</div>
																	<div class="media-body">
                                                                        <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                                                        <div class="stars-example-css review-star">
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
																			<i class="icofont icofont-star"></i>
                                                                        </div>
                                                                        <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                                        <div class="m-b-25">
																			<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                                                        </div>
																	</div>
																	<hr>
																</div>
															</div>
														</div>
														<div class="media mt-2">
															<div class="media-left">
																<a href="#">
																	<img class="media-object img-radius comment-img" src="../assets/images/avatar-2.jpg" alt="Generic placeholder image">
																</a>
															</div>
															<div class="media-body">
																<h6 class="media-heading">Mark Doe<span class="f-12 text-muted m-l-5">Just now</span></h6>
																<div class="stars-example-css review-star">
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																	<i class="icofont icofont-star"></i>
																</div>
																<p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
																<div class="m-b-25">
																	<span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
																</div>
																<hr>
															</div>
														</div>
													</div>
												</li>
											</ul>
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Right addon">
												<span class="input-group-addon"><i class="icofont icofont-send-mail"></i></span>
											</div>
										</div>
									</div>
								</div>
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
<!-- <script type="text/javascript" src="files/../bower_components/sweetalert/js/sweetalert.min.js"></script> -->
<!-- <script type="text/javascript" src="files/../assets/js/modal.js"></script> -->
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<script src="../assets/js/pcoded.min.js" type="text/javascript"></script>
<script src="../assets/js/vartical-layout.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="files/../assets/js/classie.js"></script> -->
<script src="../assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="files/../assets/js/modalEffects.js"></script> -->
<script type="text/javascript" src="../assets/js/classie.js"></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>
<!--================= cdn link datatable start===================-->


</html>