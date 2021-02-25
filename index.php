<?php
require_once 'init.php';

if (logged_in() === TRUE) {
  header('location: admin/dashboard.php');
}

$errormsgs = array();
// form submiited
if ($_POST) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == "") {
    $errormsgs[] = " * Username Field is Required <br />";
  }

  if ($password == "") {
    $errormsgs[] = " * Password Field is Required <br />";
  }

  if ($username && $password) {
    //$is_login_status = is_login_somewhere($username, $password);
    $is_login_status = 0;
    if ($is_login_status > 0) {
      $errormsgs[] = "User already logged_in";
    } else {
      if (userExists($username) == TRUE) {
        $login = login($username, $password);
        if ($login) {
          $userdata = userdata($username);
          $_SESSION = $userdata;
          $queryupdate = "update users set is_login = 1, login_time = now() WHERE id='" . $_SESSION['id'] . "'";
          $resultupdate = mysqli_query($mycon, $queryupdate);

          header('location: admin/dashboard.php');
          exit();
        } else {
          $errormsgs[] = "Incorrect username/password combination";
        }
      } else {
        $errormsgs[] = "username does not exists";
      }
    }
  }
} // /if
?>
<?php include 'admin/includes/head.php'; ?>
<!--************* Css Link **********************-->
<link rel="icon" href="assets/images/fav_icon.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
<link rel="stylesheet" type="text/css" href="assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="assets/icon/feather/css/feather.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<!-- cdn css link start ===================-->
</head>

<body class="fix-menu">

  <div class="theme-loader">
    <div class="ball-scale">
      <div class='contain'>
        <div class="ring">
          <div class="frame"></div>
        </div>

      </div>
    </div>
  </div>
  <div class="overlay"></div>
  <section class="login-block">

    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <form class="md-float-material form-material" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="text-center">
                <!-- <img src="assets/images/logo.png" alt="logo.png"> -->
            </div>
            <div class="auth-box card">
              <div class="card-block">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center">Sign In</h3>
                    <p style="text-align: center;color: red;"><?php echo @$_GET['session_expired'] . "<br />"; ?></p>
                    <?php foreach ($errormsgs as $errormsg) { ?>
                      <p style="text-align: center;color: red;" style="padding:0;margin:0">
                        <?php echo @$errormsg; ?></p>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group form-primary">
                  <input type="text" name="username" id="username" class="form-control" required="" placeholder="Enter Username">
                  <span class="form-bar"></span>
                </div>
                <div class="form-group form-primary">
                  <input type="password" name="password" id="password" class="form-control" required="" placeholder="Enter Password">
                  <span class="form-bar"></span>
                </div>
                <div class="row m-t-25 text-left">
                  <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                      <label>
                        <input type="checkbox" value="">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">Remember me</span>
                      </label>
                    </div>
                    <div class="forgot-phone text-right f-right">
                      <a href="auth-reset-password.php" class="text-right f-w-600"> Forgot Password?</a>
                    </div>
                  </div>
                </div>
                <div class="row m-t-30">
                  <div class="col-md-12">
                    <button type="submit" name="btnSubmitLogin" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Login</button>
                  </div>
                </div>
                <!--<div class="form-group social-icons_wrapper">
                    <ul class="social-icons">
                        <li>
                            <a class="fa fa-facebook-square" data-original-title="facebook" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="fa fa-twitter-square" data-original-title="Twitter" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="fa fa-google-plus-square" data-original-title="Goole Plus" href="javascript:;"></a>
                        </li>
                        <li>
                            <a class="fa fa-linkedin-square" data-original-title="Linkedin" href="javascript:;"></a>
                        </li>
                    </ul>
                 </div>
                <hr />-->
                <div class="row">

                  <div class="col-md-12" style="text-align: right;">
                    <img class="sign_in_fav" src="assets/images/logo.jpg" alt="small-logo.png">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>

    </div>

  </section>

  <!--==================== Start Script Link ======================-->

  <script type="text/javascript" src="bower_components/jquery/js/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/pages/google-maps/gmaps.js"></script>
  <script type="text/javascript" src="assets/js/script.js"></script>
</body>

</html>