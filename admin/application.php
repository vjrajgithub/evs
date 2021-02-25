<?php
require_once '../init.php';
include_once 'function.php';
if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$colunmData = $_POST['colunmData'];
$item = $_POST['item'];
$fromdt = $_POST['fromdt'];
$todt = $_POST['todt'];

$startHour = "00:00:00";
$endHour = "23:55:55";

if (isset($_POST['fileRefno'])) {
  $srcitem = "AND application_ref_id ='" . trim($_POST['fileRefno']) . "'";
} else {
  $srcitem = "";
}

if ($_GET['wip'] == 'wip') {
  $dashredirection = "AND application_status != 10";
} else if ($_GET['completed'] == 'completed') {
  $dashredirection = "AND application_status = 10";
} else if ($_GET['underVerification'] == 'underVerification') {
  $dashredirection = "AND application_status IN (3,4,5,6,7)";
} else if ($_GET['newCases'] == 'newCases') {
  $dashredirection = "AND application_status = 1";
} else if ($_GET['underQC'] == 'underQC') {
  $dashredirection = "AND application_status IN (8,9)";
} else if ($_GET['insuffRaised'] == 'insuffRaised') {
  $dashredirection = "AND application_status IN (2,7)";
} else if ($_GET['totalCases'] == 'totalCases') {
  $dashredirection = "AND application_status != 0";
} else {
  $dashredirection = "AND application_status != 0";
}



$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

//Fetch data from role wised
//echo $ff = $userdata['id']; die;

if ($userdata['client_id'] == '0' || $userdata['client_id'] == '1') {
  $role_item = '';
} else {
  $role_item = " AND tp.client_id = '" . $userdata['client_id'] . "'";
}

function get_checkType($mycon, $type_id) {
  $sql_query1 = "SELECT checkType FROM type_of_check WHERE id='" . $type_id . "'";
  $result1 = mysqli_query($mycon, $sql_query1);
  if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
      $type_of_check = $row['checkType'];
    }
  }
  return $type_of_check;
}

// function getApplicationStatus($status, $mycon) {
//   // echo $status;
//   //die;
//   // $cstatus = "";
//   $app_status_desc="";
//   $sql_query= "SELECT `descirption` FROM application_status WHERE application_status_no = '".$status."'";
//   $result = mysqli_query($mycon, $sql_query );
//   if(mysqli_num_rows($result) > 0 ){
//     $rows= mysqli_fetch_assoc($result);
//     $app_status_desc = $rows['descirption']; 
//     // echo $status;
//   }
//   return $app_status_desc;


// }


?>
<?php include 'includes/head.php'; ?>

<!--************* Css Link **********************-->
<script>
  var baseURL = "<?php echo baseUrl(); ?>";
</script>
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
<link rel="stylesheet" type="text/css" href="../assets/css/jquery-steps.css">
<!-- cdn css link start ===================-->
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/buttons.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/keyTable.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/responsive.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/scroller.bootstrap4.min.css"/>

<!--********* cdn css link END ******-->
<style type="text/css">



  .page_header_top {
    text-align: center;
    padding: 18px 0 18px 0;
    text-transform: uppercase;
    color: #010066;
    font-weight: 600;
  }
  .vertical_tabs_views {
    padding: 16px 0 133px !important;
  }
  .step-app > .step-footer {
    margin-top: 26px;
    margin-bottom: 15px !important;
    text-align: center;
  }
  .portlet-title.hdr .caption {
    position: relative;
    z-index: 12;
  }
  .portlet-title.hdr .actions{
    position: relative;
    z-index: 12;
  }
  /*tabform advance style*/
  .wrapper.advance_search_excel form{
    display: flex;
    align-content: center;
    align-items: center;
  }
  .form-group.Date-range input {
    max-width: 73%;
  }
  .form-group.Date-range {
    margin-left: 10px;
  }
  input#colunmData1 {
    background: #fff;

  }
  .pcoded-inner-content {
    padding-top: 0;
  }

  .wrapper.advance_search_excel .tabs {
    position: relative;
    margin: -3rem 0 0 0;
    /*background: #63B54F;*/
    height: 8.95rem;

  }
  .wrapper.advance_search_excel {
    background: #ccc;
    padding: 12px 12px 0 12px;
    border-radius: 10px 10px 0px 0px;

  }
  .wrapper.advance_search_excel .tabs::before,
  .wrapper .advance_search_excel .tabs::after {
    content: "";
    display: table;
  }
  .wrapper.advance_search_excel .tabs::after {
    clear: both;
  }
  .wrapper.advance_search_excel .tab {
    float: left;
  }
  .wrapper.advance_search_excel .tab-switch {
    display: none;
  }
  .wrapper.advance_search_excel .tab-label {
    position: relative;
    display: block;
    line-height: 2.5em;
    /*height: 3em;*/
    padding: 0 1.618em;
    /*background: #63B54F;*/
    /*border-right: 0.125rem solid #63B54F;*/
    color: #000;
    cursor: pointer;
    top: 0;
    transition: all 0.25s;
    border: 1px solid #010066;
  }
  .wrapper.advance_search_excel .tab-label:hover {
    /*top: -0.25rem;*/
    transition: top 0.25s;
  }
  .wrapper.advance_search_excel .tab-content {
    height: 3rem;
    position: absolute;
    z-index: 1;
    top: 1.75em;
    left: 0;
    right: 0;
    padding: 1.618rem;
    /* background: #fff; */
    color: #2c3e50;
    /* border-bottom: 0.25rem solid #bdc3c7; */
    opacity: 0;
    transition: all 0.35s;
  }
  .wrapper.advance_search_excel .tabs .tab {
    padding-left: 346px;
  }
  .wrapper.advance_search_excel .tab-switch:checked + .tab-label {
    background: #010066;
    color: #fff;
    /*border-bottom: 0;*/
    border-right: 0.125rem solid #010066;
    transition: all 0.35s;
    z-index: 1;
    /*top: -0.0625rem;*/
    /*border: 1px solid #63B54F;*/
  }
  .wrapper.advance_search_excel button {
    padding: 9px 10px;
    border: 1px solid #eee;
    border-radius: 5px;
    margin-top: -3px;
  }
  input#colunmData2 {
    background-color: #fff;
  }

  .wrapper.advance_search_excel .tab:last-child{
    padding-left: 0 !important;
  }

  .wrapper.advance_search_excel .tab-switch:checked + label + .tab-content {
    z-index: 2;
    opacity: 1;
    transition: all 0.35s;

  }
  .portlet-title.hdr {
    display: flex;
    justify-content: space-between;
    padding: 13px 0;
  }


  @media (max-width: 991.98px) {
    .wrapper.advance_search_excel .actions .btn-group {
      display: none !important;
    }

    .wrapper.advance_search_excel .tabs .tab {
      padding-left: 200px;
    }

  }

  @media (max-width: 767.98px) {
    .wrapper.advance_search_excel form {
      display: block !important;
      text-align: center;
    }
    .wrapper.advance_search_excel .tabs .tab {
      padding-left: 134px;
    }
    .wrapper.advance_search_excel .tabs {
      height: 20.95rem;
    }
    input#colunmData1 {
      background: #fff;
      /* max-width: 74%; */
      /* margin: 0 auto; */
      /* text-align: center; */
      /* margin-left: 98px !important; */
      border-radius: 5px;
    }
    .wrapper.advance_search_excel button {
      margin-top: 10px;
    }

  }

  @media (max-width: 575.98px) {
    .wrapper.advance_search_excel .tab {
      float: none;
    }
    .wrapper.advance_search_excel .tab-label {
      padding: 1px 5px;
    }
    .wrapper.advance_search_excel .tabs .tab {
      padding-left: 102px;
    }
    input#colunmData1 {
      /* max-width: 75%; */
      /* margin-left: 77px !important; */
      border-radius: 5px;
    }
    .wrapper.advance_search_excel .tab-label {
      line-height: 2.5em;
      height: 3em;
    }
    .wrapper.advance_search_excel .tab-content {
      top:5rem;
    }

  }


</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <h5 class="page_header_top">Application Details</h5>
        <!--***** Tab_from advance search  start *******-->
        <div class="wrapper advance_search_excel">
          <div class="portlet-title hdr">
            <div class="caption">
              <a href="add-new-applications.php?new_application=<?php echo 1;?>"><button class="btn btn-success" data-toggle="modal" data-target="#Item_MasterAdd_modal">ADD New <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </button>
              </a>
            </div>

            <div class="actions">

              <div class="btn-group">
                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                  <i class="fa fa-share"></i>
                  <span class="hidden-xs"> Trigger Tools </span>
                  <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right" id="sample_3_tools">
                  <li>
                    <a href="javascript:;" data-action="0" class="tool-action">
                      <i class="fa fa-print"></i> Print</a>
                  </li>

                  <li>
                    <a href="javascript:;" data-action="1" class="tool-action">
                      <i class="fa fa-clone"></i> Copy</a>
                  </li>
                  <li>
                    <a href="javascript:;" data-action="2" class="tool-action">
                      <i class="icon-doc"></i> PDF</a>
                  </li>
                  <li>
                    <a href="javascript:;" data-action="3" class="tool-action">
                      <i class="icon-paper-clip"></i> Excel</a>
                  </li>
                  <!-- <li>
                      <a href="javascript:;" data-action="4" class="tool-action">
                          <i class="icon-cloud-upload"></i> CSV</a>
                  </li>
                  <li class="divider"> </li>
                  <li>
                      <a href="javascript:;" data-action="5" class="tool-action">
                          <i class="icon-refresh"></i> Reload</a>
                  </li> -->

                </ul>
              </div>
            </div>
          </div>
 <!-- <span><strong>*</strong>Default entries in the page : 20. </span> -->
          <div class="tabs">
            <div class="tab">
              <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
              <label for="tab-1" class="tab-label">Advance Search</label>
              <div class="tab-content">

                <!--***** Advance search form Start *-->

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="submitForm()" method="POST" style="display: flex; justify-content: center; align-items: center;">
                  <div class="form-group">
                  </div>

                  <div class="form-group Select_Items" >
                    <input type="text" name="fileRefno" id="colunmData1" class="form-control" placeholder="Please Enter file Ref. No." style="margin-left: 5px;" required>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> From : </label>
                    <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="validity"></span>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> &nbsp; To :</label>
                    <input type="date" id="bday" name="todt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="validity"></span>
                  </div>
                  <div class="buttons">
                    <button class="btn btn-primary" onclick="validateme('msg');" style="" type="submit">Advance Search</button>

                  </div>
                </form>

                <!--***** Advance search form END *-->

              </div>
            </div>
            <div class="tab">
              <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
              <label for="tab-2" class="tab-label">Download report in excel
              </label>
              <div class="tab-content">
                <!--***** Download report in excel start *-->

                <!-- <h3>Download report in excel</h3> -->
                <form action="report_application.php" onsubmit="submitForm()" method="POST" style="display: flex; justify-content: center; align-items: center;">
                  <div class="form-group">

                  </div>

                  <div class="form-group Select_Items">
                    <input type="text" name="fileRefno" id="colunmData2" class="form-control" placeholder="Please Enter..." style="margin-left: 5px;"required>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> From : </label>
                    <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="validity"></span>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> &nbsp; To :</label>
                    <input type="date" id="bday" name="todt"s pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="validity"></span>
                  </div>
                  <div class="buttons">
                    <input type="hidden" name="department" id="department" value="department">
                    <button class="btn btn-primary" onclick="validateme2('msg');" style="" type="submit">Excel download</button>
                  </div>
                </form>

                <!-- excel search end -->


              </div>
            </div>

          </div>



        </div>
        <!--***** Tab_from advance search  end *******-->

        <div class="page-body">
          <div class="card">
            <div class="card-block application_dtls">
              <div class="row">
                <div class="col-md-12 ">
                  <div class="portlet light portlet-fit portlet-datatable bordered">

                    <div class="alert alert-success alert-dismissable" id="application_success_message" style="display :none">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <div ></div>
                    </div>

                    <!-- Modal Edit buttons Edit Buttons -->

                    <!--=========== Dat Table List ===========-->
                    <div class="portlet-body"><!-- 
                      <button style="float:right" class="btn btn-success" onclick="window.history.back()">Back</button> -->
                      <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                          <thead>
                            <tr>
                              <th>HMDS id</th>
                              <th>Application id</th>
                              <th>Client Code</th>
                              <th>Applicant Name </th>
                              <th>Types of Checks</th>
                              <th>Case id</th>
                              <th>Case Record <br/>Date</th>
                              <th>Status</th>
                              <th>Action Item</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql_query = "SELECT tp . * , ep . * FROM `tbl_application` tp, employee_personal_info_tbl ep WHERE tp.application_ref_id = ep.application_id ".$role_item."".$srcitem." ".$dashredirection." order by tp.id DESC";

                           //echo $sql_query;
//                            die;

                            $result = mysqli_query($mycon, $sql_query);
                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                //print_r($row);
                                //die;
                                ?>
                                <tr style="display: table-row;" class="<?php echo $row['application_ref_id']; ?>">
                                  <td><?php echo $row['hmds_id']; ?></td>
                                  <td><?php echo $row['application_ref_id']; ?></td>
                                  <td><?php echo $row['client_name']; ?></td>
                                  <td><?php echo $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']; ?></td>
                                  <?php getTypeOfCheckName($mycon, explode(',', $row['type_of_check'])); ?>
                                  <td><?php echo $row['case_id']; ?></td>
                                  <td><?php echo $row['case_record_date']; ?></td>
                                  <td><?php echo getApplicationStatus($row['application_status'],$mycon) ?></td>
                                  <td>
                                    <a href="<?php echo baseUrl() . "application-view.php?appid=" . $row['application_ref_id'] ?>" title="view"><i class="fa fa-eye" aria-hidden="true" ></i></a>
                                    <?php
                                    if (in_array($row['application_status'], ['0', '1', '2'])) {
                                      ?>
                                      <a href="<?php echo baseUrl() . "edit-new-applications.php?appid=" . $row['application_ref_id'] ?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>

                                      <a href="<?php echo baseUrl() . "edit-new-applications.php?appid=" . $row['application_ref_id'] ?>"  title="Add Information" ><i class="fa fa-plus-square-o" aria-hidden="true"></i> </a>
                                      <a href="#" title="Delete" onclick="deleteApplication('<?php echo $row['application_ref_id']; ?>', this)"><i class="fa fa-trash-o deleteapp" aria-hidden="true"></i> </a>
                                    <?php } ?>
                                    <?php  // if ($userRole == 8 || $userRole == 9 || $userRole == 10) { ?>
                                    <a href="<?php echo baseUrl() . "form-data-review.php?appid=" . $row['application_ref_id'] ?>"  title="form data review (raise a query for insuff)" ><i class="fa fa-check-square-o" style="font-size:18px;" aria-hidden="true"></i> </a>
                                    <?php // } ?>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                            ?>

                          </tbody>
                        </table>
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
</div>

<!--********** Modal popup start for view html code **********-->

<div class="modal fade bd-example-modal-lg_view modal_views_app" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModalbody">
  <div class="modal-dialog modal-lg">
    <div class="modal-header">
      <!-- <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4> -->
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-content">
      <!-- wizard start -->
      <div class="vertical_tabs_views">
        <div class="tabordion">
          <section id="section1">
            <input type="radio" name="sections" id="option1" checked="">
            <label class="labls" for="option1">Application Details Document
            </label>
            <article>
              <h2>Application Details Document</h2>

              <table class="table">
                <tbody>
                  <tr>
                    <th>HMDS ID</th>
                    <td>:</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <th>Client Name</th>
                    <td>:</td>
                    <td>1002</td>
                  </tr>
                  <tr>
                    <th>Client Location</th>
                    <td>:</td>
                    <td>Delhi</td>
                  </tr>
                  <tr>
                    <th>Case Id</th>
                    <td>:</td>
                    <td>9896642</td>
                  </tr>

                  <tr>
                    <th>Type of Check</th>
                    <td>:</td>
                    <td>pending</td>
                  </tr>
                  <tr>
                    <th>Application Id</th>
                    <td>:</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <th>Case Rec. date</th>
                    <td>:</td>
                    <td>12/05/2019</td>
                  </tr>
                  <tr>
                    <th>Client Relationship Person name</th>
                    <td>:</td>
                    <td>Brother</td>
                  </tr>
                  <tr>
                    <th>Client Contact Number</th>
                    <td>:</td>
                    <td>9865656565</td>
                  </tr>
                  <tr>
                    <th>Unique Id</th>
                    <td>:</td>
                    <td>124</td>
                  </tr>

                </tbody>
              </table>

            </article>
          </section>
          <section id="section2">
            <input type="radio" name="sections" id="option2">
            <label class="labls" for="option2">Personal Details Document
            </label>
            <article>
              <h2>Personal Details Documnet</h2>
              <table class="table">
                <tbody>
                  <tr>
                    <th>First Name</th>
                    <td>:</td>
                    <td>Mr.</td>
                  </tr>
                  <tr>
                    <th>Middle Name</th>
                    <td>:</td>
                    <td>Ravi</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>:</td>
                    <td>Singh</td>
                  </tr>
                  <tr>
                    <th>D.O.B</th>
                    <td>:</td>
                    <td>12/04/990</td>
                  </tr>



                  <tr>
                    <th>Date of joining</th>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Phone No.</th>
                    <td>:</td>
                    <td>879898978</td>
                  </tr>
                  <tr>
                    <th>Email Id</th>
                    <td>:</td>
                    <td>abc@gmail.com</td>
                  </tr>

                </tbody>
              </table>
            </article>
          </section>
          <section id="section3">
            <input type="radio" name="sections" id="option3">
            <label class="labls" for="option3">Identity Proof Documents
            </label>
            <article>
              <h2>Identity Proof Documents</h2>

              <table class="table">
                <tbody>
                  <tr>
                    <th>Adhar Card No.</th>
                    <td>:</td>
                    <td>1085822</td>
                  </tr>
                  <tr>
                    <th>Pan Card</th>
                    <td>:</td>
                    <td>xyz</td>
                  </tr>

                  <tr>
                    <th>Employees Id</th>
                    <td>:</td>
                    <td>9896642</td>
                  </tr>




                </tbody>
              </table>

            </article>
          </section>
          <section id="section4">
            <input type="radio" name="sections" id="option4">
            <label class="labls" for="option4">Address Proof Documents</label>
            <article>
              <h2>Address Proof Documents</h2>

              <table class="table">
                <tbody>
                  <tr>
                    <th>Address</th>
                    <td>:</td>
                    <td>S 10/9 Jankpuri west</td>
                  </tr>
                  <tr>
                    <th>Landmark</th>
                    <td>:</td>
                    <td>xyz</td>
                  </tr>
                  <tr>
                    <th>Post</th>
                    <td>:</td>
                    <td>xyz</td>
                  </tr>
                  <tr>
                    <th>City</th>
                    <td>:</td>
                    <td>Delhi</td>
                  </tr>



                  <tr>
                    <th>State</th>
                    <td>:</td>
                    <td>Delhi</td>
                  </tr>
                  <tr>
                    <th>Country</th>
                    <td>:</td>
                    <td>India</td>
                  </tr>

                </tbody>
              </table>

            </article>
          </section>
          <section id="section5">
            <input type="radio" name="sections" id="option5">
            <label class="labls" for="option5">Educational  Document</label>
            <article>
              <h2>Educational  document</h2>

              <table class="table">
                <tbody>
                  <tr>
                    <th>School / College Name (with location)</th>
                    <td>:</td>
                    <td>abc</td>
                  </tr>
                  <tr>
                    <th>Roll number / Reg. Number</th>
                    <td>:</td>
                    <td>1234</td>
                  </tr>
                  <tr>
                    <th>Year Of passing</th>
                    <td>:</td>
                    <td>2004</td>
                  </tr>
                  <tr>
                    <th> Board / University</th>
                    <td>:</td>
                    <td>V.B.U</td>
                  </tr>


                </tbody>
              </table>

            </article>
          </section>
          <section id="section6">
            <input type="radio" name="sections" id="option6">
            <label class="labls" for="option6">Employment Details Document</label>
            <article>
              <h2>Employment details document</h2>


              <table class="table">
                <tbody>

                  <tr>
                    <th>Employees Name</th>
                    <td>:</td>
                    <td>Ravi</td>
                  </tr>
                  <tr>
                    <th>Salary (Monthly)</th>
                    <td>:</td>
                    <td>40k</td>
                  </tr>
                  <tr>
                    <th>Period of Employment</th>
                    <td>:</td>
                    <td>9896642</td>
                  </tr>



                  <tr>
                    <th>Supervisor Name</th>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Position</th>
                    <td>:</td>
                    <td>Developer</td>
                  </tr>

                </tbody>
              </table>
            </article>
          </section>
          <section id="section7">
            <input type="radio" name="sections" id="option7">
            <label class="labls" for="option7">Police Verification Details Document</label>
            <article>
              <h2>Police verification details document</h2>
              <table class="table">
                <tbody>
                  <tr>
                    <th>First Name</th>
                    <td>:</td>
                    <td>Mr.</td>
                  </tr>
                  <tr>
                    <th>Middle Name</th>
                    <td>:</td>
                    <td>Ravi</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>:</td>
                    <td>Singh</td>
                  </tr>
                  <tr style="display: none;">
                    <th>D.O.B</th>
                    <td>:</td>
                    <td>12/04/990</td>
                  </tr>
                  <tr style="display: none;">
                    <th>Village / Town / City</th>
                    <td>:</td>
                    <td>abc</td>
                  </tr>
                  <tr>
                    <th>Pin code</th>
                    <td>:</td>
                    <td>123458</td>
                  </tr>

                  <tr>
                    <th>State</th>
                    <td>:</td>
                    <td>Haryana</td>
                  </tr>
                  <tr>
                    <th>Country</th>
                    <td>:</td>
                    <td>India</td>
                  </tr>
                  <tr>
                    <th>Police Station Name</th>
                    <td>:</td>
                    <td>Abc</td>
                  </tr>



                </tbody>
              </table>


            </article>
          </section>
          <section id="section8">
            <input type="radio" name="sections" id="option8">
            <label class="labls" for="option8">Reference Details Document
            </label>
            <article>
              <h2>Reference details document</h2>
              <table class="table">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <td>:</td>
                    <td>abc</td>
                  </tr>
                  <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>Ravi@gmail.com</td>
                  </tr>
                  <tr>
                    <th>Phone No.</th>
                    <td>:</td>
                    <td>8565656565</td>
                  </tr>
                  <tr>
                    <th>Employees Id</th>
                    <td>:</td>
                    <td>9896642</td>
                  </tr>



                  <tr>
                    <th>Address </th>
                    <td>:</td>
                    <td>abc </td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td>Pending</td>
                  </tr>
                  <tr>
                    <th>City</th>
                    <td>:</td>
                    <td>Punjab</td>
                  </tr>
                  <tr>
                    <th>State</th>
                    <td>:</td>
                    <td>Haryana</td>
                  </tr>
                  <tr>
                    <th>Country</th>
                    <td>:</td>
                    <td>India</td>
                  </tr>

                </tbody>
              </table>

            </article>
          </section>
        </div>


      </div>
      <!-- wizard end -->
    </div>
  </div>
</div>
<!--********** Modal popup start for view end html code **********-->

<!--********* modal popup start for edit html code *********-->

<div class="modal fade bd-example-modal-lg modal_views_app" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModalbody">
  <div class="modal-dialog modal-lg">
    <div class="modal-header">
      <!-- <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4> -->
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-content">
      <!--******** Wizard_new Start HTML ***********-->
      <div id="demo">
        <div class="step-app">
          <ul class="step-steps">
            <li><a href="#tab1">Application Details</a></li>
            <li><a href="#tab2">Personal Details</a></li>
            <li><a href="#tab3">Address Details</a></li>
            <li><a href="#tab4">Educational Details</a></li>
            <li><a href="#tab5">Employment Details</a></li>
            <li><a href="#tab6">Police Verification Details</a></li>
            <li><a href="#tab7">Reference Details</a></li>
          </ul>
          <div class="step-content">
            <div class="step-tab-panel" id="tab1">
              <h3 class="employer_one">Application Details</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="input_hdr" for="">HMDS ID</label>
                    <input type="text" name="" aria-describedby="" placeholder="Please enter HMDS id " class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="select">Client Name</label>
                    <select name="select" class="form-control">
                      <option>SMART DATA PROCESSING </option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="select">Client Location</label>
                    <select name="select" class="form-control">
                      <option>Pune </option>
                      <option>Delhi</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="">Case ID</label>
                    <input type="Number" name="" aria-describedby="" placeholder="" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="select">Type Of Check</label>
                    <select name="select" class="form-control">
                      <option>Education </option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="input_hdr" for="">Application Id</label>
                    <input type="text" name="" aria-describedby="" placeholder="Please enter application id" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="">Case Rec. date</label>
                    <input type="text" name="" aria-describedby="" placeholder="dd-mm-yyyy" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="">Client Relationship Person Name</label>
                    <input type="text" name="" aria-describedby="" placeholder=" " class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="">Client Contact Number</label>
                    <input type="Number" name="" aria-describedby="" placeholder="" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="">Unique Id</label>
                    <input type="Number" name="" aria-describedby="" placeholder="" class="form-control">
                  <!--   <small id="" class="form-text text-muted">(First 2 letter of client location + First 2 letter of type of check + MMYY-Sequence no.)</small> -->
                  </div>

                </div>
              </div>

            </div>
            <div class="step-tab-panel" id="tab2">
              <h3 class="employer_one">Personal Details</h3>

              <form name="frmInfo" id="frmInfo">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label input_hdr">First Name
                      </label>
                      <div>
                        <input type="text" name="name" data-required="1" class="form-control">
                      </div>

                    </div>
                    <div class="form-group">
                      <label class="control-label input_hdr">Last Name
                      </label>
                      <div><input type="text" name="name" data-required="1" class="form-control"></div>
                    </div>
                    <div class="form-group">
                      <label class="control-label input_hdr">Phone No.
                      </label>
                      <div>
                        <input type="text" name="name" data-required="1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group"><label class="control-label  input_hdr">Alternate Contact Details
                      </label> <div><input type="Number" name="name" data-required="1" class="form-control"></div>
                    </div>
                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Are you legally eligible for employment in the India? (Yes/No)
                        <span aria-required="true" class="required"> * </span></label>
                      <label class="radio  input_hdr"><input type="radio" name="r" value="1" checked="checked"> <span>Yes</span></label>
                      <label class="radio  input_hdr"><input type="radio" name="r" value="2"> <span>No</span></label></div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label input_hdr">Middle Name
                      </label>
                      <div>
                        <input type="text" name="name" data-required="1" class="form-control">
                      </div>

                    </div>
                    <div class="form-group">
                      <label class="control-label input_hdr ">D.O.B
                      </label>
                      <div>
                        <input type="text" name="input" placeholder="YYYY-MM-DD" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" title="Enter a date in this format YYYY/MM/DD" class="form-control">
                      </div>
                    </div>
                    <div class="form-group"><label class="control-label input_hdr">Email Id
                      </label> <div><input type="mail" name="name" data-required="1" class="form-control"></div>
                    </div>
                    <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Your Gender
                        <span aria-required="true" class="required"> * </span></label> <br>
                      <label class="radio  input_hdr"><input type="radio" name="m" value="1" checked="checked"> <span>Male</span></label>
                      <label class="radio  input_hdr"><input type="radio" name="m" value="2"> <span>Female</span></label>
                    </div>

                  </div>
                  <!-- file_upload start -->
                  <div class="file-upload">

                    <div class="image-upload-wrap">
                      <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
                      <div class="drag-text">
                        <h3>Drag and drop a file or select add Image</h3>
                      </div>
                    </div>
                    <div class="file-upload-content">
                      <img class="file-upload-image" src="#" alt="your image">
                      <div class="image-title-wrap">
                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                      </div>
                    </div>
                  </div>
                  <!-- file_upload start -->
                </div>
              </form>
            </div>
            <div class="step-tab-panel" id="tab3">
              <h3 class="employer_one">Address Details</h3>
              <div class="row">

                <div class="col-md-6">
                  <div class="present_adress">
                    <label class="input_hdr">Present Address</label>
                  </div>

                  <div class="form-group">
                    <label class="control-label input_hdr"> Address
                            <!-- <span class="required" aria-required="true"> * </span> -->
                    </label>
                    <div>
                      <textarea type="text" data-required="1" class="form-control" name="homeaddress" id="homeaddress"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label input_hdr">Landmark
                        <!-- <span class="required" aria-required="true"> * </span> -->
                    </label>
                    <div>
                      <input type="text" name="name" data-required="1" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="select">City</label>
                    <select name="select" class="form-control">
                      <option>Delhi</option>
                      <option>Kolkata</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="input_hdr" for="select">State</label>
                    <select name="select" class="form-control">
                      <option>Delhi</option>
                      <option>Haryana</option>
                      <option>West Bengal</option>

                    </select>
                  </div>

                  <div class="form-group">
                    <label class="input_hdr" for="select">Country</label>
                    <select name="select" class="form-control">
                      <option>India</option>


                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label input_hdr">Pin code
                      <span class="required" aria-required="true"> * </span>
                    </label>
                    <div>
                      <input type="number" name="name" data-required="1" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="present_adress">
                    <label class="input_hdr">Permanent Address
                      <input type="checkbox" name="vehicle1" value="Bike" id="vehicle1">
                      Same as Present Address
                    </label>
                  </div>

                  <div class="form-group">
                    <label class="control-label input_hdr"> Address
                            <!-- <span class="required" aria-required="true"> * </span> -->
                    </label>
                    <div>
                      <textarea type="text" data-required="1" class="form-control" name="homeaddress" id="homeaddress"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label input_hdr">Landmark
                        <!-- <span class="required" aria-required="true"> * </span> -->
                    </label>
                    <div>
                      <input type="text" name="name" data-required="1" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="input_hdr" for="select">City</label>
                    <select name="select" class="form-control">
                      <option>Delhi</option>
                      <option>Kolkata</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="input_hdr" for="select">State</label>
                    <select name="select" class="form-control">
                      <option>Delhi</option>
                      <option>Haryana</option>
                      <option>West Bengal</option>

                    </select>
                  </div>

                  <div class="form-group">
                    <label class="input_hdr" for="select">Country</label>
                    <select name="select" class="form-control">
                      <option>India</option>


                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label input_hdr">Pin code
                      <span class="required" aria-required="true"> * </span>
                    </label>
                    <div>
                      <input type="number" name="name" data-required="1" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="step-tab-panel" id="tab4">
              <h3 class="employer_one">Educational Details</h3>
              <form name="frmLogin" id="frmLogin">
                <div>

                  <!-- vertical tab -->
                  <div class="vertical_tabs_views">
                    <div class="tabordion">
                      <section id="section11">
                        <input type="radio" name="sections" id="option11" checked>
                        <label class="labls" for="option11">High School (10th)
                        </label>
                        <article>
                          <h4 class="employer_one">High School (10th)</h4>
                          <div class="form-group">
                            <label class="control-label">School / College Name (with location)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Roll number / Reg. Number
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Year Of passing
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label ">Board / University
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                        </article>
                      </section>
                      <section id="section12">
                        <input type="radio" name="sections" id="option12">
                        <label class="labls" for="option12">Intermediate (12th)
                        </label>
                        <article>
                          <h4 class="employer_one">Intermediate (12th) </h4>
                          <div class="form-group">
                            <label class="control-label">School / College Name (with location)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Roll number / Reg. Number
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Year Of passing
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Board / University
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                        </article>
                      </section>
                      <section id="section13">
                        <input type="radio" name="sections" id="option13">
                        <label class="labls" for="option13">Degree Graduation
                        </label>
                        <article>
                          <h4 class="employer_one">Graduation Degree </h4>
                          <div class="form-group">
                            <label class="control-label">Degree (Please Specify)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">School / College Name (with location)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Roll number / Reg. Number
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Year Of passing
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Board / University
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                        </article>
                      </section>
                      <section id="section14">
                        <input type="radio" name="sections" id="option14">
                        <label class="labls" for="option14">Post Graduation</label>
                        <article>
                          <h4 class="employer_one">Post Graduation</h4>
                          <div class="form-group">
                            <label class="control-label">Degree (Please Specify)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">School / College Name (with location)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Roll number / Reg. Number
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Year Of passing
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Board / University
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                        </article>
                      </section>
                      <section id="section15">
                        <input type="radio" name="sections" id="option15">
                        <label class="labls" for="option15">If Any Other Qualification</label>
                        <article>
                          <h4 class="employer_one">If Any Other Qualification</h4>
                          <div class="form-group">
                            <label class="control-label">Degree/ Diploma/ Professional Courses
                            <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Year Of passing
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Board / University
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group" >
                            <label class="control-label">School / College Name (with location)
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="text" name="name" data-required="1" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Roll number / Reg. Number
                                <!-- <span class="required" aria-required="true"> * </span> -->
                            </label>
                            <div>
                              <input type="Number" name="name" data-required="1" class="form-control">
                            </div>
                          </div>

                        </article>
                      </section>

                    </div>

                  </div>
                  <!-- vertical tab -->

                </div>
              </form>
            </div>
            <div class="step-tab-panel" id="tab5">
              <h3 class="employer_one">Employer Details</h3>
              <!--  form employment end -->

              <div class="customer_records" style="width: 100%">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group"><label class="control-label">Employer Name
                    <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="number" name="name" data-required="1" class="form-control" value="Please Enter employer name"></div>
                    </div>
                    <div class="form-group"><label class="control-label">Period of Employment
                   <!--  <span aria-required="true" class="required"> * </span> --></label> <div><span class="form-group Date-range"><label for="bday"> From : </label> <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"> <span class="validity"></span></span> <span class="form-group Date-range"><label for="bday"> To :</label> <input type="date" id="bday" name="todt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"> <span class="validity"></span></span></div></div>
                    <div class="form-group"><label class="control-label">Telephone
                   <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="number" name="name" data-required="1" class="form-control"></div></div>
                    <div class="form-group"><label for="select">Position</label> <select name="select" class="form-control"><option>Data Entry </option> <option>2</option> <option>3</option> <option>4</option> <option>5</option></select></div>
                    <div class="form-group"><label for="select">Department</label> <select name="select" class="form-control"><option>IT</option> <option>2</option> <option>3</option> <option>4</option> <option>5</option></select></div>
                    <div class="form-group"><label class="control-label">Reason for Leaving
                        <span aria-required="true" class="required"> * </span></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div>


                  </div>
                  <div class="col-md-6">

                    <div class="form-group"><label class="control-label"> Address
                      </label> <div><textarea type="text" data-required="1" name="homeaddress" id="homeaddress" class="form-control"></textarea></div></div>
                    <div class="form-group"><label for="select">Salary</label> <select name="select" class="form-control"><option>20k-30K</option> <option>2</option> <option>3</option> <option>4</option> <option>5</option></select></div>
                    <div class="form-group"><label class="control-label">Supervisor Name
                   <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div>
                    <div class="form-group"><label class="control-label">Supervisor Email Id
                     <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div>
                    <div class="form-group"><label class="control-label">Company or Branch Address
                    <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div>

                  </div>


                  <a class="extra-fields-customer" href="#">Add More Employer <span class="fa fa-plus-circle"></span></a>
                </div>
              </div>


              <div class="customer_records_dynamic"></div>

            </div>
            <!--  form employment end -->
            <div class="step-tab-panel" id="tab6">
              <h3 class="employer_one">Police Verification Details</h3>
              <form name="frmMobile" id="frmMobile">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"><label class="control-label">Last Name
        <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label">Middle Name
      <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label">Address: C/o () D/o () W/o () H/o
    <!-- <span aria-required="true" class="required"> * </span> --></label> <div><textarea type="text" data-required="1" name="billingaddress" id="billingaddress" class="form-control"></textarea></div></div> <div class="form-group"><label class="control-label">Landmark
    <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label"> Village / Town / City
        <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label">City
    <!--  <span aria-required="true" class="required"> * </span> --></label> <select name="select" class="form-control"><option>Rampur </option> <option>2</option> <option>3</option> <option>4</option> <option>5</option></select></div> <div class="form-group"><label for="select">State</label> <select name="select" class="form-control"><option>Delhi </option> <option>Kolkata</option> <option>3</option> <option>4</option> <option>5</option></select></div> <div class="form-group"><label class="control-label">Police Station Name
  <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div></div> <div class="col-md-6"><div class="form-group"><label class="control-label">First Name
     <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label">House No/Bldg./ Apt.
    <!--  <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div> <div class="form-group"><label class="control-label">Street No / Road / Lane
      <!-- <span aria-required="true" class="required"> * </span> --></label> <div><input type="text" name="name" data-required="1" class="form-control"></div></div>

                    <div class="form-group">
                      <label class="control-label">Area / Locality / Sector
               <!-- <span aria-required="true" class="required"> * </span> --></label>
                      <div>
                        <input type="text" name="name" data-required="1" class= "form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Post Office
                 <!-- <span aria-required="true" class="required"> * </span> --></label>
                      <div>
                        <input type="Number" name="name" data-required="1" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="select">Distic</label>
                      <select name="select" class="form-control">
                        <option>Delhi </option>
                        <option>Kolkata</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Pin Code
             <!-- <span aria-required="true" class="required"> * </span> -->

                      </label>
                      <div>
                        <input type="number" name="name" data-required="1" class="form-control">
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="select">Country</label>
                      <select name="select" class="form-control">
                        <option>India </option>

                      </select>
                    </div>
                  </div>
                </div>

              </form>
            </div>

            <!--******** refrence details  start **********-->

            <div class="step-tab-panel" id="tab7">
              <h3 class="employer_one">Reference Details</h3>
              <form name="frmMobile" id="frmMobile">


                <!-- vertical tab -->
                <div class="vertical_tabs_views">
                  <div class="tabordion">
                    <section id="section66">
                      <input type="radio" name="sections" id="option66" checked="">
                      <label class="labls" for="option66">Professional Reference-1
                      </label>
                      <article>
                        <h4 class="employer_one">Professional Reference-1</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Name
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Phone No.
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">City</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Kolkata</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">Country</label>
                              <select name="select" class="form-control">
                                <option>India</option>


                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Pin code
                                  <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email
                              </label>
                              <div>
                                <input type="mail" name="" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Address
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">State</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Haryana</option>
                                <option>West Bengal</option>

                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Landmark
                                              <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>

                          </div>
                        </div>
                      </article>
                    </section>
                    <section id="section77">
                      <input type="radio" name="sections" id="option77">
                      <label class="labls" for="option77">
                        professional Reference-2
                      </label>
                      <article>
                        <h4 class="employer_one">Professional Reference-2</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Name
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Phone No.
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">City</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Kolkata</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">Country</label>
                              <select name="select" class="form-control">
                                <option>India</option>


                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Pin code
                                  <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email
                              </label>
                              <div>
                                <input type="mail" name="" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Address
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">State</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Haryana</option>
                                <option>West Bengal</option>

                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Landmark
                                              <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>

                          </div>
                        </div>
                      </article>
                    </section>
                    <section id="section88">
                      <input type="radio" name="sections" id="option88">
                      <label class="labls" for="option88">
                        Personal Reference-1
                      </label>
                      <article>
                        <h4 class="employer_one"> Personal Reference-1</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Name
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Phone No.
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">City</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Kolkata</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">Country</label>
                              <select name="select" class="form-control">
                                <option>India</option>


                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Pin code
                                  <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email
                              </label>
                              <div>
                                <input type="mail" name="" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Address
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">State</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Haryana</option>
                                <option>West Bengal</option>

                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Landmark
                                              <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>

                          </div>
                        </div>
                      </article>
                    </section>
                    <section id="section9">
                      <input type="radio" name="sections" id="option99">
                      <label class="labls" for="option99">  Personal Reference-2</label>
                      <article>
                        <h4 class="employer_one"> Personal Reference-2</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Name
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Phone No.
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">City</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Kolkata</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">Country</label>
                              <select name="select" class="form-control">
                                <option>India</option>


                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Pin code
                                  <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="number" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email
                              </label>
                              <div>
                                <input type="mail" name="" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Address
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="input_hdr" for="select">State</label>
                              <select name="select" class="form-control">
                                <option>Delhi</option>
                                <option>Haryana</option>
                                <option>West Bengal</option>

                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label input_hdr">Landmark
                                              <!-- <span class="required" aria-required="true"> * </span> -->
                              </label>
                              <div>
                                <input type="text" name="name" data-required="1" class="form-control">
                              </div>
                            </div>

                          </div>
                        </div>
                      </article>
                    </section>
                  </div>
                </div>
                <!-- vertical tab -->
              </form>
            </div>
            <!--******** refrence details  end **********-->
          </div>

          <div class="step-footer">
            <button data-direction="prev" class="step-btn" >Previous</button>
            <button data-direction="save" class="step-btn">Save</button>
            <button data-direction="next" class="step-btn">Next</button>
            <button data-direction="finish" class="step-btn">Finish</button>
          </div>
        </div>
      </div>

      <!--******** Wizard_new End HTML *************-->
    </div>
  </div>
</div>
<!--********* modal popup for edit end html code   *********-->
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
<script type="text/javascript" src="../assets/js/custom.js"></script>
<script type="text/javascript" src="../assets/js/page/application.js"></script>

<!--==================== Start Script Link ======================-->
<script type="text/javascript" src="../assets/js/jquery-steps.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>




</body>

</html>