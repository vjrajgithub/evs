<?php
require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}
//pre($mycon);
$allData = getAllApplicationInformation($mycon);
// pre($allData);
$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];

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


  .table-bordered {
    border: 1px solid #ddd !important;
  }


  table caption {
    padding: .5em 0;
  }

  .col-xs-12.wrapper {
    padding: 15px;
    background: #eeeeee1a;
    border: 2px solid #e2a1a1;
  }

  .table_bodyallhdr {
    font-family: sans-serif;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 600;
    color: #010066;
    text-align: center;
    letter-spacing: 0.6px
  }

  /*@media (max-width: 39.9375em) {
    .tablesaw-stack tbody tr:not(:last-child) {
      border-bottom: 2px solid #0B0B0D;
    }
  }*/

  .p {
    text-align: center;
    padding-top: 140px;
    font-size: 14px;
  }

  .tablesaw-stack td {
    font-size: 14px;
  }
  .table-bordered {
    border:none !important;
  }

  .table thead th {
    border:0 !important;
    border-bottom: 5px solid #010066;
  }
  .hdr_sec h3 {
    font-size: 21px;
    color: #000;
    margin-bottom: 2px;
    margin-top: 12px;
  }
  th.hdr_sec img {
    max-width: 138px;
  }
  .hdr_sec span {
    color: #ad3632;
    text-transform: capitalize;
    font-size: 13px;
  }
  .hdr_sec_2 {
    vertical-align: middle !important;
  }
  .hdr_cont_add {
    padding: 12px;
    float: right;
  }
  .hdr_cont_add p {
    line-height: 5px;
    color: #000000a8;
    font-size: 14px;
    letter-spacing: 0.6px;
    text-align: justify;
  }
  tr.body_hdr_dtls {
    font-weight: 500;
    font-size: 15px;
  }
  .body_hdr_dtls.color_boxes td {
    text-align: center;
  }
  .color_boxes span {
    width: 30px;
    height: 30px;
    display: block;
    vertical-align: middle;
    margin:0 auto;
  }
  .verified {
    background-color: #00af50 !important;
  }
  .major {
    background-color: #ff0000;
  }
  .minor {
    background-color: #e26c09;
  }
  .unable_ver {
    background-color: #ffff00;
  }
  .certificate_img img {
    max-width: 100%;
    display: block;
    width: 100%;
    object-fit: contain;
  }

  .verified.BIG {
    width: 70px;
    height: 45px;
    /*          display: inline-block;
    */          margin: 0 auto;
  }
  .Annexure {
    display: block;
    text-align: center;
    font-weight: 600
  }


  table caption {
    padding: .5em 0;
    text-transform: uppercase;
    color: #000;
    font-weight: 500;
    font-size: 14px;
  }
  .verifi_hdr th {
    text-align: center;
    color: #8a0a01;
    font-size: 15px;
    background-color: #eeeeee87
  }
  .footer_area span a {
    color: #01006b;
  }
  .compnay_slogan {
    font-size: 20px;
    color: #010066;
  }
  .compnay_slogan_para {
    padding: 10px 0;
  }
  .compnay_slogan_para p {
    line-height: 8px;
    color: #000;
  }

  .table_bodyallhdr span {
    border-bottom: 2px solid #010066;
  }
  #printTable {
    max-width: 750px;
    margin:0 auto;
    padding: 10px;
    background: #f8f9fa5e;
    border: 2px solid #dc3545ba !important;
  }
  .modal-content.report_sheet {
    padding: 17px 0;
    /* overflow: scroll; */
    overflow-y: scroll;
    height: 876px;
  }
  .modal-dialog.modal-lg .close {
    position: absolute;
    right: -2px;
    color: #920706;
    font-size: 43px;
    z-index: 12;
    top: -26px;
  }
  @import url('https://fonts.googleapis.com/css?family=Open+Sans|Roboto:300,400,500,700&display=swap');
  table {
    font-family: 'Roboto',
  }
  .table-bordered td, .table-bordered th {
    border: 1px solid #ddd  !important;
    font-size: 14px;
    font-weight: 500;
  }

  span.verified.BIG    {
    width: 70px;
    height: 45px;
    display: inline-block;
    margin: 0 auto;
    background: green
  }

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

        <h5 class="page_header_top">Verification Final Report</h5>
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
                            <th>HMDS id</th>
                              <th>Application id</th>
                              <th>Client Code</th>
                              <th>Applicant Name </th>
                              <th>Types of Checks</th>
                              <th>Case id</th>
                              <th>Case Record <br />Date</th>
                              <th>Status</th>
                              <th>Action Item</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($allData as $application) {

                              if ($application['application_status'] == '10') {
                                ?>

                                <tr style="display: table-row;">
                                <td><?php echo $application['hmds_id']; ?></td>
                                  <td><?php echo $application['application_ref_id']; ?></td>
                                  <td><?php echo $application['client_name']; ?></td>
                                  <td><?php echo $application['personalData']['0']['firstName']; ?></td>
                                  <?php getTypeOfCheckName($mycon, explode(',', $application['type_of_check'])); ?>
                                  <td><?php echo $application['case_id']; ?></td>
                                  <td><?php echo $application['case_record_date']; ?></td>
                                  <td><?php echo getApplicationStatus($application['application_status'], $mycon); ?></td>


                                  <td>
                                    <a href="#" title="view report" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $application['hmds_id'] ?>"><i class="fa fa-eye" aria-hidden="true" ></i>
                                    </a>
                                    <a title="Report Download" href="<?php echo baseUrl() . "verification-report-sheet-print.php?appid=" . $application['application_ref_id'] ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" data-toggle="modal" data-target="#"></i></a>
 
                                    <a title="Email" href="<?php echo baseUrl() . "email_verification_report.php?appid=" . $application['application_ref_id']."&hmds_id=".$application['hmds_id']."&client_name=".$application['client_name']."&personalData=".$application['personalData']['0']['firstName']."&type_of_check=".$application['type_of_check']."&case_id=".$application['case_id']."&case_record_date=".$application['case_record_date']."&application_status=".$application['application_status']."&client_id=".$application['client_id'] ?>" target="_blank"><i class="fa fa-envelope" aria-hidden="true" data-toggle="modal" data-target="#"></i></a>

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
</div>
</div>
</div>

<?php
foreach ($allData as $application) {
  $typeOfCheckArray = explode(',', $application['type_of_check']);
  ?>
  <!--********** Modal popup start for view html code **********-->
  <div class="modal fade bd-example-modal-lg<?php echo $application['hmds_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

      <!-- <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4> -->
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>

      <div class="modal-content report_sheet" style="padding: 17px 0">

        <table class="table table-bordered"  id="printTable">
          <thead style="border: 1px solid #ccc;">

            <tr>
              <th colspan="2"  class="hdr_sec">
                <img src="../assets/images/logo.jpg">
                <h3>Himadi Solutions Pvt Ltd </h3>
                <span style="display: block;">ISO Certified & Nasscom Member </span>
              </th>
              <th colspan="2" class="hdr_sec_2">
                <div class="hdr_cont_add">
                  <p>M5/302, Gupta Plaza 3rd Floor</p>
                  <p> Vikaspuri New Delhi 110018</p>
                  <p> Ph: 011 –+91- 47702200 - 229</p>
                  <p>Fax: + 91 – 011 – 47510 337 </p>

                </div>

              </th>
            </tr>
          <tbody>
            <tr class="body_hdr_dtls">
              <td colspan="2">Confidential BGV Report Of Payal Bhardwaj</td>
              <td colspan="2"><b>Client Name :</b> NATH OUTSOUCRING</td>
            </tr>
            <tr class="body_hdr_dtls color_boxes">
              <td>VERIFIED CLEAR <span class="verified"></span></td>
              <td>MAJOR DISCREPANCY<span class="major"></span></td>
              <td>MINOR DISCREPANCY<span class="minor"></span></td>
              <td>UNABLE TO VERIFY<span class="unable_ver"></span></td>
            </tr>

            <!-- **** application Information start ***** -->

            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td colspan="4" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">APPLICATION INFORMATION</h3></td>
                  </tr>
                  <tr>
                    <td>HMDS ID </td>
                    <td><?php echo $application['hmds_id'] ?></td>
                    <td>CASE REC. DATE  </td>
                    <td><?php echo $application['case_record_date'] ?></td>
                  </tr>
                  <tr>
                    <td>APPLICANT NAME  </td>
                    <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?></td>
                    <td>REPORT DATE </td>
                    <td>16th - Jul- 2019</td>
                  </tr>
                  <tr>
                    <td>DATE OF BIRTH </td>
                    <td> <?php echo $application['personalData']['0']['firstName'] ?></td>
                    <td>APPLICANT ID </td>
                    <td><?php echo $application['application_ref_id'] ?></td>
                  </tr>
                  <tr>
                    <td>ADDRESS</td>
                    <td><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?></td>
                    <td>COMPLETE STATUS </td>
                    <td>
                      <span class="verified BIG"></span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <!-- **** application Information end ***** -->

            <!-- Verification Summmary start -->
            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">Verification Summary</h3></td>
                  </tr>
                  <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                    <td>CHECKS </td>
                    <td>DETAILS  </td>
                    <td>STATUS  </td>

                  </tr>
                  <?php if (in_array("4", $typeOfCheckArray)) { ?>
                    <tr>
                      <td>EDUCATION    </td>
                      <td> <?php echo $application['eduData']['0']['college_institute'] ?></td>
                      <td><?php echo ($application['ApplicationDataCheck'][0]['is_education_details_checked']) ? ('VERIFIED CLEAR') : ('PENDING'); ?></td>

                    </tr>
                  <?php } if (in_array("5", $typeOfCheckArray)) { ?>
                    <tr>
                      <td>ADDRESS</td>
                      <td><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?> </td>
                      <td><?php echo ($application['ApplicationDataCheck'][0]['is_address_details_checked']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>

                    </tr>
                  <?php }if (in_array("5", $typeOfCheckArray)) { ?>
                    <tr>
                      <td>IDENTITY   </td>
                      <td><?php echo $application['addressData'][0]['title'] . " - " . $application['addressData'][0]['document_no'] ?>   </td>
                      <td><?php echo ($application['addressDataCheck'][0]['is_verify']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>


                    </tr>
                  <?php }if (in_array("6", $typeOfCheckArray)) { ?>
                    <tr>
                      <td>CRIMINAL  </td>
                      <td>HOUSE NO. D-223/4, NEW ASHOK NAGAR, GALI NO.12, DELHI - 110096. </td>
                      <td>VERIFIED CLEAR</td>

                    </tr>
                  <?php } if (in_array("5", $typeOfCheckArray)) { ?>
                    <tr>
                      <td>REFERENCE 1   </td>
                      <td> <?php echo $application['referenceData']['0']['name'] ?>    </td>
                      <td><?php echo ($application['ApplicationDataCheck'][0]['is_relation_details_checked']) ? ('VERIFIED CLEAR') : ('PENDING'); ?></td>

                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
            <!-- Verification Summmary end -->

            <?php if (in_array("4", $typeOfCheckArray)) { ?>
              <!-- Education Report start -->
              <!-- Education Report start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">EDUCATION REPORT</h3></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">APPLICANT NAME     </td>
                      <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?>     </td>
                      <td><?php echo ($application['eduDataCheck'][0]['is_emp_name_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">ROLL NO./REG NO. </td>
                      <td><?php echo $application['eduData'][0]['roll_no']; ?></td>
                      <td><?php echo ($application['eduDataCheck'][0]['is_rollno_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;" >QUALIFICATION</td>
                      <td><?php echo $application['eduData'][0]['qualification']; ?></td>
                      <td><?php echo ($application['eduDataCheck'][0]['is_verify']) ? ('CORRECT') : ('PENDING'); ?> </td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;" >INSTITUTE / UNIVERSITY NAME </td>
                      <td><?php echo $application['eduData'][0]['college_institute']; ?> </td>
                      <td><?php echo $application['eduData'][0]['university_board']; ?> </td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;" >PASSING YEAR    </td>
                      <td><?php echo $application['eduData'][0]['passing_year']; ?></td>
                      <td><?php echo ($application['eduDataCheck'][0]['is_passing_year_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIER NAME & TITLE </td>
                      <td colspan="2"><?php echo $application['eduData'][0]['verifier_name'] . '-' . ['eduData'][0]['verifier_designation']; ?></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;" >ADDITIONAL COMMENT</td>
                      <td colspan="2"><?php echo $application['eduData'][0]['verifier_remark']; ?></td>
                    </tr>

                    <?php
                    foreach ($application['eduImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                    <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>

                  </table>
                </td>
              </tr>
              <!-- Education Report end -->
            <?php }if (in_array("8", $typeOfCheckArray)) { ?>
              <!-- Employment Report start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">EMPLOYMENT REPORT</h3></td>
                    </tr>
                    <tr style="background: #004085; color: #fff;">
                      <td >APPLICANT DETAILS      </td>
                      <td>APPLICANT INPUT     </td>
                      <td>VERIFIER INPUT</td>

                    </tr>
                    <tr>
                      <td >COMPANY NAME     </td>
                      <td><?php echo $application['empData'][0]['company_name']; ?></td>
                      <td colspan="2"><?php echo ($application['empDataCheck'][0]['is_verify']) ? ('CORRECT') : ('PENDING'); ?></td>



                    </tr>
                    <tr>
                      <td >DATE OF JOINING </td>
                      <td><?php echo $application['empData'][0]['date_of_joining']; ?></td>
                      <td>Same </td>

                    </tr>
                    <tr>
                      <td>DATE OF LEAVING  </td>
                      <td><?php echo $application['empData'][0]['date_of_joining']; ?></td>
                      <td><?php echo $application['empData'][0]['date_of_relieving']; ?></td>

                    </tr>
                    <tr>
                      <td >DESIGNATION    </td>
                      <td><?php echo $application['empData'][0]['designation']; ?></td>
                      <td>Same</td>

                    </tr>
                    <tr>
                      <td >EMPLOYEE ID </td>
                      <td>1916  </td>
                      <td>2297  </td>
                    </tr>
                    <tr>
                      <td >SALARY WITHDRAWN    </td>
                      <td >Please Confirm  </td>
                      <td><?php echo $application['empData'][0]['salary']; ?> CTC</td>
                    </tr>
                    <tr>
                      <td >REASON FOR LEAVING     </td>
                      <td ><?php echo $application['empData'][0]['reason_for_leaving']; ?>  </td>
                      <td><?php echo $application['empData'][0]['reason_for_leaving']; ?></td>
                    </tr>
                    <tr>
                      <td >ELIGIBLE FOR RE HIRE        </td>
                      <td >Please Confirm   </td>
                      <td><?php echo $application['empDataCheck'][0]['eligible_for_rehire']; ?></td>
                    </tr>
                    <tr>
                      <td>HOW WAS CANDIDATE CHARACTER DURING TENURE</td>
                      <td >Please Confirm   </td>
                      <td><?php echo $application['empDataCheck'][0]['how_was_the_candidate_behavior_during_tenure']; ?></td>
                    </tr>
                    <tr>
                      <td >VERIFIER NAME & DESIGNATION </td>
                      <td colspan="2"><?php echo $application['empDataCheck'][0]['verifier_name'] . '-' . $application['empDataCheck'][0]['verifier_designation']; ?></td>

                    </tr>
                    <tr>
                      <td >ADDITIONAL COMMENT  </td>
                      <td colspan="2"><?php echo $application['empDataCheck'][0]['verifier_remark'] ?></td>
                    </tr>
                    <?php
                    foreach ($application['empImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                    <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </table>
                </td>
              </tr>
              <!-- Employment Report end -->
              <?php
            }
            if (in_array("5", $typeOfCheckArray)) {
              ?>
              <!-- Id Proof start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">IDENTITY REPORT</h3></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">APPLICANT IDENTITY DETAILS      </td>
                      <td><?php echo $application['addressImages'][0]['title'] . " - " . $application['addressImages'][0]['document_no'] ?>   </td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIER AUTHORITY  </td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_designation'] ?> </td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIER NAME </td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_name'] ?> </td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">COMMENT </td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_remark'] ?></td>


                    </tr>

                    <?php
                    foreach ($application['addressImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                      <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </table>
                </td>
              </tr>
              <!-- Id Proof end -->
            <?php }if (in_array("1", $typeOfCheckArray)) { ?>
              <!-- Address Proof start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">ADDRESS REPORT</h3></td>
                    </tr>
                    <tr>
                      <td colspan="2"><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?></td>
                      <!--<td><?php echo $application['addressData'][1]['address'] ?><br> <?php echo $application['addressData'][1]['address'] . ', ' . $application['addressData'][1]['city'] . '<br> ' . $application['addressData'][1]['state'] . '-' . $application['addressData'][1]['pin_code'] ?></td>-->

                                                                                                                                                                                                                                                                                                                                                                                                                                          <!--<td>V P O SAMLOTI TEH KANGRA,<br> SAMLOTI (691),SAMLOTI KANGRA, <br>HIMACHAL PRADESH-176056  </td>-->

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">PERIOD OF STAY   </td>
                      <td><?php echo $application['addressDataCheck'][0]['how_many_years_candidate_is_residing'] ?></td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">ACCOMODATION STATUS    </td>
                      <td><?php echo $application['addressDataCheck'][0]['accommodation_type'] ?></td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">NEAREST LANDMARK     </td>
                      <td><?php echo $application['addressDataCheck'][0]['land_mark'] ?></td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIED BY </td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_name'] ?></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">RELATIONSHIP WITH APPLICANT  </td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_relationship'] ?></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIER CONTACT NO.     </td>
                      <td><?php echo $application['addressDataCheck'][0]['contact_of_respondent'] ?></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFICATION DATE        </td>
                      <td>16th Jul 2019</td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">COMMENT</td>
                      <td><?php echo $application['addressDataCheck'][0]['verifier_remark'] ?></td>
                    </tr>

                    <?php
                    foreach ($application['addressImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                        <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </table>
                </td>
              </tr>
              <!-- Address Proof end -->
            <?php }if (in_array("6", $typeOfCheckArray)) { ?>
              <!-- criminal record start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="2" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">POLICE VERIFICATION REPORT</h3></td>
                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">APPLICANT ADDRESS DETAILS  </td>
                      <td><?php echo $application['vrificationData']['address'] ?><br> <?php echo $application['vrificationData']['address'] . ', ' . $application['vrificationData']['city'] . '<br> ' . $application['vrificationData']['state'] . '-' . $application['vrificationData']['pincode'] ?></td>

                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">NAME OF THE POLICE AUTHORITY  </td>
                      <td><?php echo $application['vrificationDataCheck']['police_authority'] ?></td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">VERIFIER NAME & TITLE      </td>
                      <td><?php echo $application['vrificationDataCheck']['verifier_name'] . '-' . $application['vrificationDataCheck'][0]['verifier_designation'] ?></td>


                    </tr>
                    <tr>
                      <td style="background: #004085; color: #fff;">ADDITIONAL COMMENT     </td>
                      <td><?php echo $application['vrificationDataCheck']['verifier_remark'] ?></td>

                    </tr>



                    <?php
                    foreach ($application['policeImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                          <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>


                  </table>
                </td>
              </tr>
              <!-- criminal record end -->
            <?php } ?>
            <!-- criminal report2 start -->
  <!--            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">CRIMINAL REPORT</h3></td>
                  </tr>
                  <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                    <td>S. NO.    </td>
                    <td>PARTICULARS</td>
                    <td>REMARKS</td>

                  </tr>
                  <tr>
                    <td>1</td>
                    <td>ADDRESS  </td>
                    <td>B-1/2 77 NEW ASHOK NAGAR GAI NO-12 DELHI 110096</td>


                  </tr>
                  <tr>
                    <td>2</td>
                    <td>NAME OF REFERENCE   </td>
                    <td>DEEPA MANDAL</td>


                  </tr>
                  <tr>
                    <td>3</td>
                    <td>PHONE NUMBER       </td>
                    <td>8860826012</td>


                  </tr>
                  <tr>
                    <td>4</td>
                    <td>DATE AND TIME CONTACTED       </td>
                    <td>15-EPTEMBER19 &03:15 PM</td>


                  </tr>

                </table>
              </td>
            </tr>-->
            <!-- criminal report2 end -->


            <!-- criminal report3 start -->
  <!--            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">CRIMINAL REPORT</h3></td>
                  </tr>
                  <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                    <td>S. NO.    </td>
                    <td>PARTICULARS</td>
                    <td>RESPONDENT’S REMARK</td>

                  </tr>
                  <tr>
                    <td>1</td>
                    <td>HOW LONG HAVE YOU KNOWN THIS PERSON?      </td>
                    <td>SINCE CHILDHOOD</td>


                  </tr>
                  <tr>
                    <td>2</td>
                    <td>WHAT IS YOUR RELATIONSHIP WITH THIS APPLICANT?     </td>
                    <td>SCHOOL FRIEND</td>


                  </tr>
                  <tr>
                    <td>3</td>
                    <td>IN YOUR EXPERIENCE WITH THIS INDIVIDUAL, <br> HAVE YOU FOUND HIM/HER TO BE    </td>
                    <td>GOOD BEHAVE</td>


                  </tr>
                  <tr>
                    <td>4</td>
                    <td>COMMENTS OF THE RESPONDENT ON THE<br> SINCERITY,INTEGRITY <br>AND GENERAL REPUTATION ABOUT THE PERSON      </td>
                    <td>KIND HEART</td>


                  </tr>
                  <tr>
                    <td>5</td>
                    <td>IS THERE ANYTHING ELSE YOU MIGHT BE ABLE <br>TO TELL US ABOUT HIS INDIVIDUAL      </td>
                    <td>LOVELY</td>


                  </tr>
                  <tr>
                    <td colspan="3">ADDITIONAL COMMENTS : NA
                    </td>
                  </tr>

                </table>
              </td>
            </tr>-->
            <!-- criminal report3 end -->
            <?php if (in_array("11", $typeOfCheckArray)) { ?>
              <!-- Court Check Record start -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">COURT RECORD CHECK</h3></td>
                    </tr>
                    <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                      <td>APPLICANT DETAILS</td>
                      <td>APPLICANT INPUT </td>
                      <td>VERIFIER INPUT</td>

                    </tr>
                    <tr>
                      <td>APPLICANT NAME  </td>
                      <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?></td>

                      <td><?php echo ($application['courtDataCheck'][0]['is_applicant_name_correct']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>



                    </tr>
                    <tr>
                      <td>FATHER’S NAME   </td>
                      <td><?php echo $application['personalData']['0']['fatherName']; ?></td>

                      <td><?php echo ($application['courtDataCheck'][0]['is_father_name_correct']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>



                    </tr>
                    <tr>
                      <td>ADDRESS</td>
                      <td><?php echo $application['vrificationData']['address'] ?><br> <?php echo $application['vrificationData']['address'] . ', ' . $application['vrificationData']['city'] . '<br> ' . $application['vrificationData']['state'] . '-' . $application['vrificationData']['pincode'] ?></td>

                      <td>Correct</td>


                    </tr>


                    <?php
                    foreach ($application['courtImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                          <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>

                  </table>
                </td>
              </tr>
              <!-- Court Check Record end -->
            <?php } if (in_array("10", $typeOfCheckArray)) { ?>

              <!-- 1. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  start-->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">1. CIBIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION</h3></td>
                    </tr>
                    <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                      <td>Court</td>
                      <td>Court Name   </td>
                      <td>Results</td>

                    </tr>
                    <tr>
                      <td>DISTRICT COURT/ LOWER COURT/CIVIL COURT & SMALL CAUSES    </td>
                      <td>All India Courts          </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_all_india_court_for_civil'] ?></td>


                    </tr>
                    <tr>
                      <td>HIGH COURT     </td>
                      <td>All High Courts of India        </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_in_all_high_courts_of_india_for_civil'] ?></td>


                    </tr>
                    <tr>
                      <td>SUPREME COURT   </td>
                      <td>Supreme Court Of India         </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_in_supreme_court_of_india_for_civil'] ?></td>


                    </tr>


                    <?php
                    foreach ($application['courtImages'] as $image) {
                      if ($image['filename'] != '') {
                        ?>
                        <tr>
                          <td colspan="3">
                            <span class="Annexure"><?php echo $image['title'] ?></span>
                            <?php
                            $Imagecount = count($image['imageUrl']);
                            //die;
                            for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                              //echo $image['imageUrl'][$i];
                              //die;
                              ?>
                              <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                              <?php
                            }
                            ?>
                          <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>

                  </table>
                </td>
              </tr>
              <!-- 1. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  end-->
            <?php }if (in_array("11", $typeOfCheckArray)) { ?>
              <!-- 2. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  start-->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">2.CRIMINALPROCEEDINGS : CRIMINALPETITIONS/CRIMINALAPPEAL /SESSIONCASE,<br> / CRIMINALMISCELLANEOUSPETITION /<br> CRIMINAL REVISIONAPPEAL</h3></td>
                    </tr>
                    <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                      <td>Court</td>
                      <td>Court Name   </td>
                      <td>Results</td>

                    </tr>
                    <tr>
                      <td>SESSION COURT      </td>
                      <td>All Session Courts          </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_in_all_session_courts_for_criminal'] ?></td>


                    </tr>
                    <tr>
                      <td>HIGH COURT     </td>
                      <td>All High Courts of India        </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_all_high_courts_of_india_for_criminal'] ?></td>



                    </tr>
                    <tr>
                      <td>SUPREME COURT   </td>
                      <td>Supreme Court Of India         </td>
                      <td><?php echo $application['courtDataCheck'][0]['found_record_in_supreme_court_of_india_for_criminal'] ?></td>



                    </tr>
                    <tr>
                      <td colspan="3">
                        Remark : <?php echo $application['courtDataCheck'][0]['verifier_remark'] ?>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="3">
                          <!-- <span class="Annexure">ANNEXURE “L”</span> -->
                        <div class="certificate_img"><img src="../assets/images/table_list/advocate_proof.png"></div>
                      </td>
                    </tr>


                  </table>
                </td>
              </tr>
              <!-- 2. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  end-->
            <?php }if (in_array("12", $typeOfCheckArray)) { ?>
              <!-- Drag Test strat -->
              <tr>
                <td colspan="4">
                  <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                        <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">DRUG ABUSE TEST REPORT</h3></td>
                      </tr>
                      <tr>
                        <td style="background: #004085; color: #fff;">PANEL  </td>
                        <td><?php echo $application['drugDataCheck']['0']['panel']; ?></td>

                      </tr>
                      <tr>
                        <td style="background: #004085; color: #fff;">SAMPLE COLLECTED      </td>
                        <td><?php echo $application['drugDataCheck']['0']['sample_collected']; ?></td>


                      </tr>
                      <tr>
                        <td style="background: #004085; color: #fff;">REPORT STATUS      </td>repport_status
                        <td><?php echo ($application['drugDataCheck'][0]['repport_status']) ? ('Detected') : ('Not Detected'); ?> </td>



                      </tr>
                      <tr>
                        <td style="background: #004085; color: #fff;">COMMENT    </td>
                        <td><?php echo $application['drugDataCheck']['0']['verifier_remark']; ?></td>

                      </tr>

                      <?php
                      foreach ($application['drugImages'] as $image) {
                        if ($image['filename'] != '') {
                          ?>
                          <tr>
                            <td colspan="3">
                              <span class="Annexure"><?php echo $image['title'] ?></span>
                              <?php
                              $Imagecount = count($image['imageUrl']);
                              //die;
                              for ($i = 0; $i <= ($Imagecount - 1); $i++) {
                                //echo $image['imageUrl'][$i];
                                //die;
                                ?>
                                <div class="certificate_img"><img src="<?php echo baseUrl() . 'images/application/' . $image['imageUrl'][$i] ?>"></div>
                                <?php
                              }
                              ?>
                            <!--                            <div class="certificate_img"><img src="<?php echo $image['imageUrl'] ?>"></div>-->
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!-- Drag Test end -->
            <?php } ?>
            <!-- Drag Test end -->
            <!-- Discliamer -->
            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">DISCLAIMER</h3></td>
                    </tr>
                    <tr>
                      <td >
                        Our reports are submitted in strict confidence<br> and except where required by law, no information <br>provided in our reports may be revealed directly or indirectly to any person<br> except to those whose official duties require <br>them to pass this report on in relation to which the report was requested by the client.
                      </td>

                    </tr>
                    <tr>
                      <td>
                        Himadi Solutions Pvt. Ltd, Inc.<br> neither warrants, vouches for, or authenticates<br> the reliability of the information contained herein that the records<br> are accurately reported as they were found at the source as of the date and time of this report,<br> whether on a computer information system, <br>retrieved by manual search, or telephonic interviews.<br> The information provided herein shall not be construed to constitute a legal opinion; <br>rather it is a compilation of public records and/or data for your review.

                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <!-- Discliamer -->
            <!-- about us -->
            <tr>
              <td colspan="4">
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td colspan="3" style="text-align: center; background-color: #eee;"><h3 class="table_bodyallhdr">About Us</h3></td>
                    </tr>
                    <tr>
                      <td>
                        Himadi Solutions Pvt. Ltd. provides dynamic Customer-Focused <br> IT and BPO solutions that bridge the gap between principals and their prospective / existing customers.<br> We provide a wide spectrum of BPO service including Background <br>Check for Employees, Vendors, Suppliers andothers.
                      </td>

                    </tr>
                    <tr>
                      <td>
                        We have nationwide networking to meet the ever-growing needs of<br> our customers across all locations covering the entire <br>Indian Subcontinent and US.<br> Outstanding customer service and superior quality of support to <br>our customers is the core motto of existence.
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h3 class="compnay_slogan">Himadi Solutions Pvt Ltd.</h3>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="compnay_slogan_para">
                          <p>M-5/302,IIIrdfloor,GuptaPlaza,MBlock,VikasPuri,New Delhi-110018 </p>
                          <p>Contact Number- <a href="tel:011-47510331-36">011-47510331-36 &amp; 011-47702200-32</a></p>
                          <p>Mob :-<a href="tel : 8826697339">8826697339</a> </p>
                          <p>Fax : 011-47510337</p>
                          <p><a href="mailto : sales@himadi.com "></a>E-mail: sales@himadi.com | website : www.himadi.com</p>
                        </div>
                        <div>
                          <img src="../assets/images/table_list/logo_foot.png">
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>


          </tbody>


          <tfoot class="footer_area">
            <tr>
              <td colspan="4">
                <div style="text-align: center;">
                  <span >Himadi Solutions Pvt Ltd.</span><br>
                  <a Web : href="#"> www.himadi.com</a>
                  <a href="mailto: Sales@himadi.com" target="_top">Mail to : Sales@himadi.com</a>
                </div>

              </td>
            </tr>
            <!-- Verification Summmary start -->


          </tfoot>

          </thead>
        </table>
      </div>
    </div>
  </div>


  <!--************  Modla View End Popup   *****************-->
<?php }include 'includes/footer.php'; ?>
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
</body>

</html>