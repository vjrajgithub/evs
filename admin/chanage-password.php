<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

function changePassworddata($id, $currentpassword, $username, $mycon) {
  $total = 0;
  $password = md5($currentpassword);
  $sql = "SELECT * FROM users WHERE password = '$password' AND username = '$username' AND id = '$id'";
  $result = mysqli_query($mycon, $sql);
  $total = mysqli_num_rows($result);
  return $total;
}

$errorMsg = array();

if ($_POST) {
  $currentpassword = $_POST['currentpassword'];
  $newpassword = $_POST['password'];
  $conformpassword = $_POST['conformpassword'];

  $is_valid_data = changePassworddata($userdata['id'], $currentpassword, $userdata['username'], $mycon);

  //echo $is_valid_data;
  //die;
  if ($currentpassword == "") {
	$errorMsg[] = "<span>Current Password field is required </span><br />";
  } else

  if ($newpassword == "") {
	$errorMsg[] = "<span>New Password field is required </span><br />";
  } else

  if ($conformpassword == "") {
	$errorMsg[] = "<span>Conform Password field is required </span><br />";
  } else
  if ($currentpassword && $newpassword && $conformpassword) {
	if ($is_valid_data > 0) {

	  if ($newpassword != $conformpassword) {
		$errorMsg[] = "<span>New password does not match confirm password </span><br />";
	  } else {
		if ($is_valid_data > 0) {
		  $passwordmd5 = md5($newpassword);
		  $usrIds = $userdata['id'];
		  $update = "UPDATE users SET password = '$passwordmd5' WHERE id = '$usrIds'";
		  $result123 = mysqli_query($mycon, $update);
		  if ($result123) {
			$errorMsg[] = "Successfully updated";
		  } else {
			$errorMsg[] = "Error while updating the information <br />";
		  }
		} else {
		  $errorMsg[] = "Error while updating the information <br />";
		}
	  }
	} else {
	  $errorMsg[] = "Current Password is incorrect <br />";
	  //echo "currentpassword-" . $currentpassword . "<br/>newpassword-" . $newpassword . "<br/>conformpassword-" . $conformpassword;
	  //echo $errorMsg . "<br/>";
	  //die('check-1');
	}
  }
}
?>
<?php include 'includes/head.php'; ?>

<!--************* Css Link **********************-->
<!-- <link rel="icon" href="../assets/images/fav_icon.png" type="image/x-icon"> -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bower_components/sweetalert/css/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="../assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../assets/icon/feather/css/feather.css">
<!-- <link rel="stylesheet" type="text/css" href="files/../assets/css/component.css"> -->
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
<!-- cdn css link start ===================-->
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/buttons.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/keyTable.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/responsive.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/scroller.bootstrap4.min.css"/>

<!--********* cdn css link END ******-->
<style type="text/css">
	.pcoded-inner-content {
		padding:15px 10px 10px 10px;
	}
	.main_footer {
		margin-top: 191px;
	}

</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">

				<div class="page-content">


					<div class="col-md-12">
						<div class="container change_passwordN">
							<div class="col-md-6" style="text-align: right;" >
								<a href="dashboard.php">
									<button class="btn btn-primary" type="button">Back</button>
								</a>
							</div>
							<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
								<ul style="list-style-type:none;">
									<?php foreach ($errorMsg as $errors) { ?>
  									<li class="pass_reqd"><?php echo $errors; ?></li>
									<?php } ?>
								</ul>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">

											<div class="form-group">
												<label for="">Current Password : </label>
												<input type="password" class="form-control" name="currentpassword" autocomplete="off" placeholder="Current Password">
											</div>
											<div class="form-group">
												<label for="">New Password : </label>
												<input type="password" name="password" class="form-control"  autocomplete="off" placeholder="New Password">
											</div>

											<div class="form-group">
												<label for="">Conform Password : </label>
												<input type="password" name="conformpassword" autocomplete="off" placeholder="Confrom Password" class="form-control"  >
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-success">Change Password</button>

											</div>
										</div>

									</div>
								</div>

							</form>
						</div>

					</div>
					<!-- END CONTENT BODY -->
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/buttons.print.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="../assets/toolkit_table/js/dataTables.scroller.min.js"></script>
<!--==================== Start Script Link ======================-->
<script type="text/javascript">
  document.getElementById('output').innerHTML = location.search;
  $(".chosen-select").chosen();
</script>
</body>

</html>