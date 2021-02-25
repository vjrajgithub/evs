<?php
require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}

$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

$allData = getAllApplicationInformation($mycon);

// pre($allData);
//Fetch data from role wised
//echo $ff = $userdata['id']; die;

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
    max-width: 77%;
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
    height: 7.95rem;

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
      padding-left: 0;
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

        <h5 class="page_header_top">Verification Report</h5>
        <!--***** Tab_from advance search  start *******-->
        <div class="wrapper advance_search_excel">
          <div class="portlet-title hdr">
            <div class="caption">
              &nbsp;
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
                <form action="" onsubmit="submitForm()" method="POST" style="display: flex; justify-content: center; align-items: center;">
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



                    <!-- Modal Edit buttons Edit Buttons -->
                    <!--=========== Dat Table List ===========-->
                    <div class="portlet-body"><!-- 
                      <button style="float:right" class="btn btn-success" onclick="window.history.back()">Back</button> -->
                      <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                          <thead>
                            <tr>
                              <th>Employees List</th>
                              <th>Employees Name</th>
                              <th>Employees ID </th>
                              <th>In-Date&Time</th>
                              <th>Out-Date&Time</th>
                              <th>Status</th>
                              <th>Action Item</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($allData as $application) {

                              if ($application['application_status'] == '3') {
                                ?>
                                <tr style="display: table-row;">
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?></td>

                                  <td><?php echo $application['hmds_id'] ?></td>

                                  <td>2019-05-13 06:53:13 </td>
                                  <td>0000-00-00 00:00:00 </td>
                                  <td><?php echo getApplicationStatus($row['application_status'], $mycon) ?></td>

                                  <td>
                                    <a href="#" title="view"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target=".bd-example-modal-lg_view<?php echo $application['hmds_id'] ?>"></i></a>

                                    <button type="button" class="btn btn-success" onclick="set_for_approval_form('<?php  echo $application['ApplicationDataCheck']['0']['id']; ?>');" data-toggle="modal" data-target="#revertUpdationModal"> quality check report <i class="fa fa-plus-circle" aria-hidden="true"></i>
              </button>
                                    <!-- other form template -->
                                    <a  href="#" title="Remark for QC Done"><i class="fa fa-plus-square-o" onclick="set_for_approval_form('<?php echo $application['ApplicationDataCheck']['0']['id']; ?>')" ; aria-hidden="true" data-toggle="modal" data-target="#revertUpdationModal"></i> </a>
                                                                        <!-- end other form template -->
 
                                  </td>
                                </tr>
                                <?php
                                $i++;
                              }
                            }
//}
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
<!-- =====================================modal for QC Done remark form=================================== -->

<div class="modal fade" id="revertUpdationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 620px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> QC Done Remark </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form accept="">
                    <div class="row">
                        <div class="col-md-12">
                            


                            <div class="form-group">
                                <label class="control-label"> Remark
                                </label>
                                <div>
                                    <input type="hidden" id="id_tbl_application_check_for_qc" name="id_tbl_application_check_for_qc">
                                    <input type="text" name="remark_for_qc_done" id="remark_for_qc_done" data-required="1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6"></div> -->
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" onclick="send_data_toserver_for_approval(1)">QC Done</button>
                <button type="button" class="btn btn-primary" onclick="send_data_toserver_for_approval(2)">Issue in Report</button>
                
            </div>
        </div>
    </div>
</div>


<!-- end modal for QC Done remark form -->


<?php
$i = 1;
foreach ($allData as $application) {
  $typeOfCheckArray = explode(',', $application['type_of_check']);
  ?>

  <!--********** Modal popup start for view html code **********-->

  <div class="modal fade bd-example-modal-lg_view<?php echo $application['hmds_id'] ?> modal_views_app" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModalbody">
    <div class="modal-dialog modal-lg">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-content " >
        <!-- wizard start -->
        <div class="vertical_tabs_views">
          <div class="tabordion">
            <section id="section1">
              <input type="radio" name="sections" id="option15" checked>
              <label class="labls" for="option15">Application Details
              </label>
              <article>
                <h2>Application Details </h2>

                <table class="table">
                  <tbody>
                    <tr>
                      <th>HMDS ID</th>
                      <td>:</td>
                      <td><?php echo $application['hmds_id'] ?></td>
                    </tr>
                    <tr>
                      <th>Client Name</th>
                      <td>:</td>
                      <td><?php echo $application['client_name'] ?></td>
                    </tr>
                    <tr>
                      <th>Client Location</th>
                      <td>:</td>
                      <td><?php echo $application['client_location'] ?></td>
                    </tr>
                    <tr>
                      <th>Case Id</th>
                      <td>:</td>
                      <td><?php echo $application['case_id'] ?></td>
                    </tr>

                    <tr>
                      <th>Type of Check</th>
                      <td>:</td>
                      <?php getTypeOfCheckName($mycon, $typeOfCheckArray); ?>
                    </tr>
                    <tr>
                      <th>Application Id</th>
                      <td>:</td>
                      <td><?php echo $application['application_ref_id'] ?></td>
                    </tr>
                    <tr>
                      <th>Case Rec. date</th>
                      <td>:</td>
                      <td>12/05/2019</td>
                    </tr>
                    <tr>
                      <th>Client Relationship Person name</th>
                      <td>:</td>
                      <td><?php echo $application['application_ref_id'] ?></td>
                    </tr>
                    <tr>
                      <th>Client Contact Number</th>
                      <td>:</td>
                      <td><?php echo $application['client_contact_number'] ?></td>
                    </tr>
                    <tr>
                      <th>Unique Id</th>
                      <td>:</td>
                      <td><?php echo $application['client_contact_number'] ?></td>
                    </tr>

                  </tbody>
                </table>

              </article>
            </section>
            <?php //if (in_array("Glenn", $people)) { ?>
            <section id="section2">
              <input type="radio" name="sections" id="option2">
              <label class="labls" for="option2">Personal Details
              </label>
              <article>
                <h2>Personal Details</h2>
                <table class="table">
                  <tbody>
                    <tr>
                      <th>First Name</th>
                      <td>:</td>
                      <td>Mr.<?php echo $application['personalData'][0]['firstName'] ?></td>
                    </tr>
                    <tr>
                      <th>Middle Name</th>
                      <td>:</td>
                      <td><?php echo $application['personalData'][0]['MiddleName'] ?></td>
                    </tr>
                    <tr>
                      <th>Last Name</th>
                      <td>:</td>
                      <td><?php echo $application['personalData'][0]['lastName'] ?></td>
                    </tr>
                    <tr>
                      <th>D.O.B</th>
                      <td>:</td>
                      <td><?php echo $application['personalData'][0]['dob'] ?></td>
                    </tr>



                    <tr>
                      <th>Date of joining</th>
                      <td>:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Phone No.</th>
                      <td>:</td>
                      <td><?php echo $application['personalData'][0]['phoneNo'] ?></td>
                    </tr>
                    <tr>
                      <th>Email Id</th>
                      <td>:</td>
                      <td><?php echo $application['personalData'][0]['email'] ?></td>
                    </tr>

                  </tbody>
                </table>
              </article>
            </section>
            <?php //} ?>
            <?php if (in_array("5", $typeOfCheckArray)) { ?>
              <section id="section3">
                <input type="radio" name="sections" id="option3">
                <label class="labls" for="option3">Identity Proof
                </label>
                <article>
                  <h2>Identity Proof</h2>

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
            <?php } ?>
            <?php if (in_array("1", $typeOfCheckArray)) { ?>
              <section id="section4">
                <input type="radio" name="sections" id="option4">
                <label class="labls" for="option4">Address Proof </label>
                <article>
                  <h2>Address Proof </h2>

                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Address</th>
                        <td>:</td>
                        <td><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?></td>
                      </tr>
                      <tr>
                        <th>Landmark</th>
                        <td>:</td>
                        <td><?php echo $application['addressData'][0]['landmark'] ?></td>
                      </tr>
                      <tr>
                        <th>Post</th>
                        <td>:</td>
                        <td>xyz</td>
                      </tr>
                      <tr>
                        <th>City</th>
                        <td>:</td>
                        <td><?php echo $application['addressData'][0]['city'] ?></td>
                      </tr>



                      <tr>
                        <th>State</th>
                        <td>:</td>
                        <td><?php echo $application['addressData'][0]['state'] ?></td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>:</td>
                        <td><?php echo $application['addressData'][0]['country'] ?></td>
                      </tr>

                    </tbody>
                  </table>

                </article>
              </section>
            <?php } if (in_array("4", $typeOfCheckArray)) { ?>
              <section id="section5">
                <input type="radio" name="sections" id="option5">
                <label class="labls" for="option5">Educational  Document</label>
                <article>
                  <h2>Educational  document</h2>


                  <div class="w3-bar w3-black">
                    <?php
                    foreach ($application['eduData'] as $edu) {
                      ?>

                      <button class="w3-bar-item w3-button" onclick="openCity('<?php echo $edu['id']; ?>')"><?php echo $edu['qualification']; ?></button>


                    <?php } ?>
                  </div>
                  <?php
                  $i = 1;
                  foreach ($application['eduData'] as $edu) {
                    ?>
                    <div id="<?php echo $edu['id']; ?>" class="w3-container city">
                      <h2><?php echo $edu['qualification']; ?></h2>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>School / College Name (with location)</th>
                            <td>:</td>
                            <td><?php echo $edu['college_institute']; ?></td>
                          </tr>
                          <tr>
                            <th>Roll number / Reg. Number</th>
                            <td>:</td>
                            <td><?php echo $edu['roll_no']; ?></td>
                          </tr>
                          <tr>
                            <th>Year Of passing</th>
                            <td>:</td>
                            <td><?php echo $edu['passing_year']; ?></td>
                          </tr>
                          <tr>
                            <th> Board / University</th>
                            <td>:</td>
                            <td><?php echo $edu['university_board']; ?></td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                  <?php } ?>




                </article>
              </section>
            <?php }if (in_array("2", $typeOfCheckArray)) { ?>
              <section id="section6">
                <input type="radio" name="sections" id="option6">
                <label class="labls" for="option6">Employment Details Document</label>
                <article>
                  <h2>Employment details document</h2>


                  <div class="w3-bar w3-black">
                    <?php
                    $i = 1;
                    foreach ($application['empData'] as $emp) {
                      ?>

                      <button class="w3-bar-item w3-button" onclick="openCity('<?php echo $emp['id']; ?>')"><?php echo "Employer " . $i; ?></button>


                      <?php
                      $i++;
                    }
                    ?>
                  </div>
                  <?php
                  $i = 1;
                  foreach ($application['empData'] as $emp) {
                    ?>
                    <div id="<?php echo $emp['id']; ?>" class="w3-container city">
                      <h2><?php echo "Employer " . $i; ?></h2>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Employer Name</th>
                            <td>:</td>
                            <td><?php echo $emp['employer_name']; ?></td>
                          </tr>
                          <tr>
                            <th>Salary (Monthly)</th>
                            <td>:</td>
                            <td><?php echo $emp['salary'] . "k"; ?></td>
                          </tr>
                          <tr>
                            <th>Period of Employment</th>
                            <td>:</td>
                            <td><?php echo $emp['date_of_joining'] . ' to ' . $emp['date_of_relieving']; ?></td>
                          </tr>
                          <tr>
                            <th> Supervisor Name</th>
                            <td>:</td>
                            <td><?php echo $emp['reporting_mngr_name']; ?></td>
                          </tr>
                          <tr>
                            <th> Position</th>
                            <td>:</td>
                            <td><?php echo $emp['designation']; ?></td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                    <?php
                    $i++;
                  }
                  ?>
                </article>
              </section>
            <?php }if (in_array("6", $typeOfCheckArray)) { ?>
              <section id="section7">
                <input type="radio" name="sections" id="option7">
                <label class="labls" for="option7">Police Verification Details </label>
                <article>
                  <h2>Police verification details </h2>
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>First Name</th>
                        <td>:</td>
                        <td>Mr.<?php echo $application['vrificationData']['first_name'] ?></td>
                      </tr>
                      <tr>
                        <th>Middle Name</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['middle_name'] ?></td>
                      </tr>
                      <tr>
                        <th>Last Name</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['last_name'] ?></td>
                      </tr>

                      <tr style="display: none;">
                        <th>Village / Town / City</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['city'] ?></td>
                      </tr>
                      <tr>
                        <th>Pin code</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['pincode'] ?></td>
                      </tr>

                      <tr>
                        <th>State</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['state'] ?></td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['country'] ?></td>
                      </tr>
                      <tr>
                        <th>Police Station Name</th>
                        <td>:</td>
                        <td><?php echo $application['vrificationData']['police_station'] ?></td>
                      </tr>



                    </tbody>
                  </table>


                </article>
              </section>
            <?php }if (in_array("7", $typeOfCheckArray)) { ?>
              <section id="section8">
                <input type="radio" name="sections" id="option8">
                <label class="labls" for="option8">Reference Details Document
                </label>
                <article>
                  <h2>Reference details document</h2>
    <!--                <table class="table">
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
                  </table>-->


                  <div class="w3-bar w3-black">
                    <?php
                    $i = 1;
                    foreach ($application['referenceData'] as $ref) {
                      ?>

                      <button class="w3-bar-item w3-button" onclick="openCity('<?php echo $ref['id']; ?>')"><?php echo "Reference " . $i; ?></button>


                      <?php
                      $i++;
                    }
                    ?>
                  </div>
                  <?php
                  $i = 1;
                  foreach ($application['referenceData'] as $ref) {
                    ?>
                    <div id="<?php echo $ref['id']; ?>" class="w3-container city">
                      <h2><?php echo "Reference " . $i; ?></h2>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Name</th>
                            <td> : </td>
                            <td><?php echo $ref['name'] ?> </td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td> : </td>
                            <td><?php echo $ref['email_address'] ?></td>
                          </tr>
                          <tr>
                            <th>Phone No.</th>
                            <td> : </td>
                            <td><?php echo $ref['phone_no'] ?></td>
                          </tr>
                          <tr>
                            <th>City</th>
                            <td> : </td>
                            <td><?php echo $ref['city'] ?></td>
                          </tr>
                          <tr>
                            <th>State</th>
                            <td> : </td>
                            <td><?php echo $ref['state'] ?></td>
                          </tr>
                          <tr>
                            <th>Country</th>
                            <td> : </td>
                            <td><?php echo $ref['country'] ?></td>
                          </tr>
                          <tr>
                            <th>Pin Code</th>
                            <td> : </td>
                            <td><?php echo $ref['pin_code'] ?></td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                    <?php
                    $i++;
                  }
                  ?>
                </article>
              </section>
            <?php } ?>
          </div>


        </div>
        <!-- wizard end -->
      </div>
    </div>
  </div>
  <!--********** Modal popup start for view html code **********-->



<?php } ?>
<!-- Select Option Start Css -->
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

<script>


  function set_for_approval_form(id_tbl_application_check) {
        // alert(id_received_letter);

        // document.getElementById('id_tbl_application_check_for_qc').value =  id_received_letter;
        document.getElementById('id_tbl_application_check_for_qc').value = id_tbl_application_check;
    }

    function send_data_toserver_for_approval(approval_status) {
        //   alert(id_tbl_application_check_for_qc);
        
        
        var remark_for_qc_done = document.getElementById('remark_for_qc_done').value;
        var id_tbl_application_check_for_qc = document.getElementById('id_tbl_application_check_for_qc').value;



        
        if (remark_for_qc_done == "" || remark_for_qc_done == "0") {
            alert('Select Remark for QC');

        } else {
            urll = "send_qc_remark_data.php?data=" + remark_for_qc_done + "~" + approval_status + "~" + id_tbl_application_check_for_qc;
              // prompt("Copy to clipboard: Ctrl+C, Enter", urll);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1 || this.responseText == '1') {
                        alert('Data has been saved Successfully.');
                        window.location = "verification-reports.php";
                    } else if (this.responseText == 2 || this.responseText == '2') {
                        alert('Sorry Something went Wrong.');

                    }
                }
            };
            xhttp.open("GET", urll, true);
            xhttp.send();
        }

    }


</script>

<script>
  function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    document.getElementById(cityName).style.display = "block";
  }
</script>
</body>

</html>