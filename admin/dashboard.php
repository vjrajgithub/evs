<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

//Fetch data from role wised
//echo $ff = $userdata['id']; die;

if ($userdata['client_id'] == '0' || $userdata['client_id'] == '1') {
  $role_item = '';
} else {
  $role_item = " AND client_id = '" . $userdata['client_id'] . "'";
}

function get_users($mycon, $role_item) {
  $total_data = 0;
  $sql_query = "SELECT id FROM users WHERE role != 1 ".$role_item."";
  $result = mysqli_query($mycon, $sql_query);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_wip($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status != 10 ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_completed($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status = 10 ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_underVerification($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status IN (3,4,5,6,7) ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_newCases($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status = 1 ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_underQC($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status IN (8,9) ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_insuffRaised($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status IN (2,7) ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

function get_totalCases($mycon, $role_item) {
  $total_data = 0;
  $sql_query1 = "SELECT id FROM tbl_application WHERE application_status != 0 ".$role_item."";
  $result = mysqli_query($mycon, $sql_query1);
  $total_data = mysqli_num_rows($result);
  return $total_data;
}

?>
<?php include 'includes/head.php'; ?>
<!--************* Css Link **********************-->
<!--************* Css Link **********************-->
<!-- <link rel="icon" href="files/assets/images/fav_icon.png" type="image/x-icon">  -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/ion-icon/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">
<link rel="stylesheet" href="../assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="../assets/icon/feather/css/feather.css">
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
<!--************* Css Link **********************-->
<style type="text/css">
  .bar_line {
    float: right;
    width: 40px;
    margin: 0px 13px 0 auto;
    /* padding: 3px; */
    position: relative;
  }
  .bar_line span {
    width: 31px;
    height: 2px;
    background: red;
    margin: 0px auto;
    text-align: center;
    display: inline-block;

  }
  #myChart {
    display: block;
    width: 600px;

    /*object-fit: contain !important;*/
  }

  /*chart graph*/
  /* Important styles */


  #toggle {
    display: block;
    width: 28px;
    height: 30px;
    margin: 19px;
  }

  #toggle span:after,
  #toggle span:before {
    content: "";
    position: absolute;
    left: 0;
    top: -9px;
  }
  #toggle span:after{
    top: 9px;
  }
  #toggle span {
    position: relative;
    display: block;
  }

  #toggle span,
  #toggle span:after,
  #toggle span:before {
    width: 100%;
    height: 5px;
    background-color: #888;
    transition: all 0.3s;
    backface-visibility: hidden;
    border-radius: 2px;
  }

  /* on activation */
  #toggle.on span {
    background-color: transparent;
  }
  #toggle.on span:before {
    transform: rotate(45deg) translate(5px, 5px);
  }
  #toggle.on span:after {
    transform: rotate(-45deg) translate(7px, -8px);
  }
  #toggle.on + #menu {
    opacity: 1;
    visibility: visible;
  }
  .wrapper_data_sq {
    background-color: #fff;
    padding: 15px 11px;
    box-shadow: -1px -1px 6px 0px rgba(0,0,0,0.75);
    border-radius: 5px;
  }
  h5.totl_cases_hdr {
    padding-bottom: 12px;
  }
  h3.totl_cases_hdr {
    color: #fff;
    font-weight: bold;
    letter-spacing: 0.6px;
    padding-top: 17px;
    text-align: left;
  }
  .total_cases {
    min-height: 200px;
    background-color: #eee;
    text-align: center;

  }
  .totl_cases_hdr {
    z-index: 20;
    font-size: 16px;
    color: #404e67;
    text-align: center;
    padding: 3px 10px;
  }
  .total_cases span {
    max-width: 250px;
    height: 250px;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 100%;
    margin: 0 auto;
    color: #000;
    display: inline-block;
    display: inline-grid;
    align-items: center;
    margin: 10px auto;
    text-align: center !important;
    width: 100%;
    font-size: 19px;
  }
  @import url(https://fonts.googleapis.com/css?family=Lato:300,700,300italic);
  html, body {
    height: 100%;
  }

  .total_cases {
    align-items: center;
    background-image: linear-gradient(to right, #054f7d, #00a7cf, #efe348, #861a54, #054f7d);
    background-size: 600%;
    background-position: 0 0;
    box-shadow: inset 0 0 5em rgba(0, 0, 0, 0.5);
    /* Animation */
    animation-duration: 20s;
    animation-iteration-count: infinite;
    animation-name: gradients;
  }

  .data_case span {
    color: #000;
    font-size: 13px;
    font-family: cursive;
    letter-spacing: 0.6px;
  }
  .data_case {
    padding: 17px 0;
  }

  @media (max-width: 830px) {
    h1 {
      font-size: 2em;
    }
  }
  @keyframes gradients {
    0% {
      background-position: 0 0;
    }
    25% {
      background-position: 50% 0;
    }
    50% {
      background-position: 90% 0;
    }
    60% {
      background-position: 60%;
    }
    75% {
      background-position: 40%;
    }
    100% {
      background-position: 0 0;
    }
  }

  /* menu appearance*/
  #menu {
    position: absolute;
    left: 56px;
    color: #999;
    width: 200px;
    padding: 10px;
    text-align: center;
    border-radius: 4px;
    background: white;
    box-shadow: 0 1px 8px rgba(0,0,0,0.05);
    /* just for this demo */
    opacity: 0;
    visibility: hidden;
    transition: opacity .4s;
  }
  #menu:after {
    position: absolute;
    top: -15px;
    left: 95px;
    content: "";
    display: block;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 20px solid white;
  }
  #menu ul, li, li a {
    list-style: none;
    display: block;
    margin: 0;
    padding: 0;
  }
  #menu li a {
    padding: 5px;
    color: #888;
    text-decoration: none;
    transition: all .2s;
  }

  #menu li a:hover,
  #menu li a:focus {
    background: #1ABC9C;
    color: #fff;
  }


  /* demo styles */

</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">
          <div class="row">

            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-yellow text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">User Account</p>
                      <h4 class="m-b-0"><?php echo get_users($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-user"></i>
                    </div>

                  </div>

                </div>
                <?php if ($userRole == 1 || $userRole == 2 || $userRole == 28) { ?>
                <div class="view_details"><a href="userlist.php">View Details</a></div>
                <?php } ?>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-green text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">Total Cases</p>
                      <h4 class="m-b-0"><?php echo get_totalCases($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?totalCases=totalCases">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-pink text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">New Cases</p>
                      <h4 class="m-b-0"><?php echo get_newCases($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?newCases=newCases">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-blue text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">WIP Cases</p>
                      <h4 class="m-b-0"><?php echo get_wip($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?wip=wip">View Details</a></div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-yellow text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">Completed</p>
                      <h4 class="m-b-0"><?php echo get_completed($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?completed=completed">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-green text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">Insuff raised</p>
                      <h4 class="m-b-0"><?php echo get_insuffRaised($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?insuffRaised=insuffRaised">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-pink text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">Under Verification</p>
                      <h4 class="m-b-0"><?php echo get_underVerification($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                <div class="view_details"><a href="application.php?underVerification=underVerification">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-pink text-white">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="m-b-5">Under QC</p>
                      <h4 class="m-b-0"><?php echo get_underQC($mycon, $role_item); ?></h4>
                    </div>
                    <div class="col col-auto text-right padingall">
                      <i class="fa fa-file-text"></i>
                    </div>
                  </div>
                </div>
                 <div class="view_details"><a href="application.php?underQC=underQC">View Details</a></div>
              </div>
            </div>
            <div class="col-xl-6 col-md-12">

              <div class="card feed-card">
                <div class="container-fluid">
                  <div class="row">
                    <canvas id="myChart1" style="height: 325px !important"></canvas>
                  </div>

                </div>
              </div>


            </div>

            <div class="col-xl-6 col-md-12">
              <div class="card feed-card">

                <div class="container-fluid">
                  <div class="row">
                    <a href="#menu" id="toggle"><span></span></a>

                    <div id="menu">
                      <ul>
                        <li><a href="javascript:void(0)">2015</a></li>
                        <li><a href="javascript:void(0)">2016</a></li>
                        <li><a href="javascript:void(0)">2017</a></li>
                        <li><a href="javascript:void(0)">2018</a></li>
                        <li><a href="javascript:void(0)">2019</a></li>
                        <li><a href="javascript:void(0)">2020</a></li>
                      </ul>
                    </div>


                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-xl-6 col-md-12">
              <div class="wrapper_data_sq">
                <h5 class="totl_cases_hdr"><b>Completed Cases</b></h5>
                <div class="total_cases">
                  <h3 class="totl_cases_hdr">50,000
                    <b>Out of TAT</b>
                  </h3>
                  <span class="totlcases">
                    <b>30,000+ <br>Within TAT</b>

                  </span>
                </div>
                <h5 class="totl_cases_hdr" style=" margin-top: 15px;"><b>Total Completed Cases :</b> 80,000</h5>
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

<!-- Js link start -->
<script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
<script type="text/javascript" src="../bower_components/chart.js/js/Chart.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="../assets/pages/google-maps/gmaps.js"></script>
<script src="../assets/js/pcoded.min.js" type="text/javascript"></script>
<script src="../assets/js/vartical-layout.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/crm-dashboard.min.js"></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<script type="text/javascript" src="../assets/js/custom.js"></script>
<script type="text/javascript" src="../assets/js/bar_graph_M.js"></script>
<script type="text/javascript" src="../assets/js/bar_graph.js"></script>


<!--****** Js link End **********-->
<script type="text/javascript">
  // Days Wise Report
  var ctx = document.getElementById("myChart1").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"],
      datasets: [{

          label: 'Daily Wise Report of Employees',
          data: [12, 30, 25, 10, 5, 27, 15, 4],
          backgroundColor: "rgba(145, 4, 4, 1)"

        }]

    }
  });
</script>
<script type="text/javascript">
  // monthly_wise_report

  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Jan", "Feb", "March", "April", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{

          label: 'Monthly Wise Report of Employees',
          data: [12, 39, 25, 33, 10, 27, 15, 21, 18, 15, 12, 9, , 6, 3],
          backgroundColor: "rgba(1,0,102,1)"

        }]

    }
  });
</script>
<!--================= bar_graph end =================-->
<script type="text/javascript">
  var theToggle = document.getElementById('toggle');

// based on Todd Motto functions
// https://toddmotto.com/labs/reusable-js/

// hasClass
  function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
  }
// addClass
  function addClass(elem, className) {
    if (!hasClass(elem, className)) {
      elem.className += ' ' + className;
    }
  }
// removeClass
  function removeClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
    if (hasClass(elem, className)) {
      while (newClass.indexOf(' ' + className + ' ') >= 0) {
        newClass = newClass.replace(' ' + className + ' ', ' ');
      }
      elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
  }


// toggleClass for Grpah

  function toggleClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, " ") + ' ';
    if (hasClass(elem, className)) {
      while (newClass.indexOf(" " + className + " ") >= 0) {
        newClass = newClass.replace(" " + className + " ", " ");
      }
      elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
      elem.className += ' ' + className;
    }
  }

  theToggle.onclick = function () {
    toggleClass(this, 'on');
    return false;
  }
</script>



</body>
</html>