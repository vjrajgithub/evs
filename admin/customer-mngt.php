<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
  header('location: ../index.php');
}



// DELETE
$mm_id = $_GET['mm_id'];
if ($mm_id != '' && $mm_id != 0) {
  $query = "Delete from `customer_master` where customer_id='" . $mm_id . "'";
  mysqli_query($mycon, $query);
}


$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];


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
<!-- cdn css link start ===================-->
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/keyTable.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/toolkit_table/css/scroller.bootstrap4.min.css" />

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

  .step-app>.step-footer {
    margin-top: 26px;
    margin-bottom: 15px !important;
    text-align: center;
  }

  .portlet-title.hdr .caption {
    position: relative;
    z-index: 12;
  }

  .portlet-title.hdr .actions {
    position: relative;
    z-index: 12;
  }

  /*tabform advance style*/
  .wrapper.advance_search_excel form {
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

  .wrapper.advance_search_excel .tab-switch:checked+.tab-label {
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

  .wrapper.advance_search_excel .tab:last-child {
    padding-left: 0 !important;
  }

  .wrapper.advance_search_excel .tab-switch:checked+label+.tab-content {
    z-index: 2;
    opacity: 1;
    transition: all 0.35s;

  }

  .portlet-title.hdr {
    display: flex;
    justify-content: space-between;
    padding: 13px 0;
  }

  .modal-dialog {
    max-width: 650px;
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
      top: 5rem;
    }

    .wrapper.advance_search_excel button {
      padding: 10px 3px;
    }

  }
</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">

        <h5 class="page_header_top">Costomer Management System</h5>
        <!--***** Tab_from advance search  start *******-->
        <div class="wrapper advance_search_excel">
          <div class="portlet-title hdr">
            <div class="caption">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Add New <i class="fa fa-plus-circle" aria-hidden="true"></i>
              </button>

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

                  <div class="form-group Select_Items">
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
                    <input type="text" name="fileRefno" id="colunmData2" class="form-control" placeholder="Please Enter..." style="margin-left: 5px;" required>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> From : </label>
                    <input type="date" id="bday" name="fromdt" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                    <span class="validity"></span>
                  </div>
                  <div class="form-group Date-range">
                    <label for="bday"> &nbsp; To :</label>
                    <input type="date" id="bday" name="todt" s pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
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
                    <div class="portlet-body">
                      <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Code</th>
                              <th>Phone Number</th>
                              <th>Official Email</th>
                              <th>Address</th>
                              <th>Action Item</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            //$customers = getAllCustomers($mycon);
                            $query = "SELECT * FROM customer_master where customer_status = '1' order by customer_name";
                            $result = mysqli_query($mycon, $query);
                            if (mysqli_num_rows($result) > 0) {
                              while ($custdata = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr style="display: table-row;">
                                  <td><?php echo $custdata['customer_name'] ?></td>
                                  <td><?php echo $custdata['customer_code'] ?></td>
                                  <td><?php echo $custdata['phone_number'] ?></td>
                                  <td><?php echo $custdata['email'] ?></td>
                                  <td><?php echo $custdata['address1'].' ,'.$custdata['address2'].' ,'.$custdata['city'].' ,'.$custdata['state'].' ,'.$custdata['country'].'- '.$custdata['pincode'] ?></td>

                                  <td>
                                    <a href="#" title="view"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#mis_view_modal<?php echo $custdata['customer_id'] ?>"></i></a>

                                    <!-- <a href="#" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#mis_edit_modal<?php echo $custdata['customer_id'] ?>"></i>
                                  </a> -->
                                    <a href="customer-mngt.php?mm_id=<?php echo $custdata['customer_id']; ?>" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                                  </td>
                                </tr>
                            <?php }
                            } ?>

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

<?php
$query3 = "SELECT * FROM customer_master where customer_status = '1' order by customer_name";
$result3 = mysqli_query($mycon, $query3);
if (mysqli_num_rows($result3) > 0) {
  while ($customer = mysqli_fetch_assoc($result3)) {
?>
    <!-- Modal -->
    <div class="modal fade" id="mis_view_modal<?php echo $customer['customer_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 0; padding-bottom: 0;">
            <h5 class="modal-title" id="exampleModalLabel">Customer Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span style="font-size: 28px;
                  color: #920706;" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Customer Name</th>
                  <td>:</td>
                  <td><?php echo $customer['customer_name'] ?></td>
                </tr>
                <tr>
                  <th>Customer Code</th>
                  <td>:</td>
                  <td><?php echo $customer['customer_code'] ?></td>
                </tr>
                <tr>
                  <th>State</th>
                  <td>:</td>
                  <td><?php echo $customer['state'] ?></td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>:</td>
                  <td><?php echo $customer['city'] ?></td>
                </tr>

                <tr>
                  <th>Region</th>
                  <td>:</td>
                  <td><?php echo $customer['region'] ?></td>
                </tr>
                <tr style="display: none;">
                  <th>Customer Group</th>
                  <td>:</td>
                  <td><?php echo $customer['customer_group'] ?></td>
                </tr>
                <tr>
                  <th>GST Number</th>
                  <td>:</td>
                  <td><?php echo $customer['gst_reg_number'] ?></td>
                </tr>
                <tr style="display: none;">
                  <th>Company Name</th>
                  <td>:</td>
                  <td><?php echo $customer['company_name'] ?></td>
                </tr>
                <tr>
                  <th>Pincode</th>
                  <td>:</td>
                  <td><?php echo $customer['pincode'] ?></td>
                </tr>
                <tr>
                  <th>Unique Id</th>
                  <td>:</td>
                  <td><?php echo $customer['customer_name'] ?></td>
                </tr>

              </tbody>
            </table>
          </div>
          <div class="modal-footer">

            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <!--********** Modal popup start for view html code **********-->
<?php }
} ?>

<!-- modal for add from -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 620px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="customer_add">
          <input type="hidden" name="form_type" value="add_customer">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Customer Name &#9734;
                </label>
                <div>
                  <input type="text" id="customer_name" name="customer_name" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Customer Code &#9734;
                </label>
                <div>
                  <input type="text" id="customer_code" name="customer_code" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Concerned Person &#9734;
                </label>
                <div>
                  <input type="text" id="concerned_person" name="concerned_person" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Phone Number &#9734;
                </label>
                <div>
                  <input type="number" id="phone_number" name="phone_number" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Office Number
                </label>
                <div>
                  <input type="number" id="office_no" name="office_no" data-required="1" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Email
                </label>
                <div>
                  <input type="email" id="email" name="email" data-required="1" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Region</label>
                <div>
                  <input type="text" id="region" name="region" data-required="1" class="form-control">
                </div>
              </div>
              <div class="form-group" style="display: none;">
                <label class="control-label">Customer Group</label>
                <div>
                  <input type="text" id="customer_group" name="customer_group" data-required="1" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label class="control-label">GST Number</label>
                <div>
                  <input type="text" id="gst_reg_number" name="gst_reg_number" data-required="1" class="form-control">
                </div>
              </div>
              <div class="form-group" style="display: none;">
                <label class="control-label">Company Name</label>
                <div>
                  <input type="text" id="company_name" name="company_name" required class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="input_hdr" for="country">Country &#9734; </label>
                <select chosen name="country" id="country" onchange="change_country('country','state','city');" class="form-control">
                  <!-- <option value="India"><?php echo 'India'; ?></option> -->
                  <option value="" > Select  </option>
                  
                  <?php
                  $query5 = "SELECT * FROM countries";
                  $result5 = mysqli_query($mycon, $query5);
                  if (mysqli_num_rows($result5) > 0) {
                    while ($country = mysqli_fetch_assoc($result5)) {
                  ?>
                      <option value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name'] ?></option>
                  <?php }
                  } ?>
    
                </select>
              </div>
              <div class="form-group">
                <label class="input_hdr" for="state">State &#9734; </label>
                <select name="state" id="state" class="form-control">
                  <option value="">--Please Select--</option>
                  
                </select>
              </div>
              <div class="form-group">
                <label class="input_hdr" for="city">City &#9734; </label>
                <!-- <select name="city" id="city" class="form-control">
                  <option value="0">--Please select State first--</option>
                  <?php
                  $query4 = "SELECT * FROM cities";
                  $result4 = mysqli_query($mycon, $query4);
                  if (mysqli_num_rows($result4) > 0) {
                    while ($city = mysqli_fetch_assoc($result4)) {
                  ?>
                      <option value="<?php echo $city['city_name']; ?>"><?php echo $city['city_name'] ?></option>
                  <?php }
                  } ?>  
                </select> -->
                <!-- city -->
                <input type="text" name="city"  id="city" placeholder="Enter city" data-required="1" class="form-control">



              </div>
              <div class="form-group">
                <label class="control-label input_hdr">pincode
                  <!-- <span class="required" aria-required="true"> * </span> -->
                </label>
                <div>
                  <input type="text" id="pincode" name="pincode" data-required="1" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Address
                </label>
                <div>
                  <input type="text" id="address" name="address" data-required="1" class="form-control">
                </div>
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" onclick="send_data_toserver()" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- modal for add from -->

<!-- Footer area start -->
<footer class="main_footer" style="">
  <p>
    &copy2019 Himadi Solutions Pvt Ltd. All rights reserved.
  </p>
</footer>
<!-- Footer area end -->
</div>
</div>
</div>
</div>
<script>
  // CHANGE COUNTRY AND STATE INTITIALY

  function change_country(country_Search, state_Search, city_Search) {

    var xmlhttp = new XMLHttpRequest();
    // alert(document.getElementById("countrydd").value);
    // state back is for geting state and city list present in database for state list we require country_id and for city list we require state_id
    xmlhttp.open("GET", "customer_management_stateback.php?country=" + document.getElementById(country_Search).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(state_Search).innerHTML = xmlhttp.responseText;

    if (document.getElementById(country_Search).value == "") {
      document.getElementById(state_Search).innerHTML = "<select><option value=''>Select</option></select>";
      // document.getElementById(city_Search).innerHTML = "<select><option  value=''>Select</option></select>";
    }



  }




  function change_state(state_search, city_search) {
    // alert("abcd efgh");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "customer_management_stateback.php?state=" + document.getElementById(state_search).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(city_search).innerHTML = xmlhttp.responseText;

    // if(document.getElementById(state_search).value == ""){
    //    document.getElementById(city_Search).innerHTML = "<select><option value=''>Select</option></select>";
    // }

  }

  function send_data_toserver() {
    var customer_name = document.getElementById('customer_name').value;
    var customer_code = document.getElementById('customer_code').value;
    var concerned_person = document.getElementById('concerned_person').value;
    var phone_number = document.getElementById('phone_number').value;
    var office_no = document.getElementById('office_no').value;
    var email = document.getElementById('email').value;
    var region = document.getElementById('region').value;
    var customer_group = document.getElementById('customer_group').value;
    var gst_reg_number = document.getElementById('gst_reg_number').value;
    var company_name = document.getElementById('company_name').value;
    var country = document.getElementById('country').value;
    var state = document.getElementById('state').value;
    var city = document.getElementById('city').value;
    var pincode = document.getElementById('pincode').value;
    var address = document.getElementById('address').value;


    if (customer_name == "" || customer_name == "") {
      alert('Enter Customer Name');
    } else if (customer_code == "" || customer_code == "0") {
      alert('Select  Customer Code');
    } else if (concerned_person == "" || concerned_person == "0") {
      alert('Select  Concerned  person');
    } else {
      urll = "send_customer_data_to_server.php?data=" + customer_name + "~" + customer_code + "~" + concerned_person + "~" + phone_number + "~" + office_no + "~" + email + "~" + region + "~" + customer_group + "~" + gst_reg_number + "~" + company_name + "~" + country + "~" + state + "~" + city + "~" + pincode + "~" + address;
      //prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {
            alert('Data has been saved Successfully.');
            window.location = "customer-mngt.php";
          } else if (this.responseText == 2 || this.responseText == '2') {
            alert('Sorry Something went Wrong.');

          }
        }
      };
      xhttp.open("GET", urll, true);
      xhttp.send();
    }

  }


  function update_date_toserver() {
    var customer_name = document.getElementById('customer_name1').value;
    var customer_code = document.getElementById('customer_code1').value;
    var concerned_person = document.getElementById('concerned_person1').value;
    var phone_number = document.getElementById('phone_number1').value;
    var office_no = document.getElementById('office_no1').value;
    var email = document.getElementById('email1').value;
    var region = document.getElementById('region1').value;
    var customer_group = document.getElementById('customer_group1').value;
    var gst_reg_number = document.getElementById('gst_reg_number1').value;
    var company_name = document.getElementById('company_name1').value;
    var country = document.getElementById('country1').value;
    var state = document.getElementById('state1').value;
    var city = document.getElementById('city1').value;
    var pincode = document.getElementById('pincode1').value;
    var address = document.getElementById('address1').value;
    var edit_id = document.getElementById('edit_id').value;
    alert(edit_id);

    if (customer_name == "" || customer_name == "") {
      alert('Enter Customer Name');
    } else if (customer_code == "" || customer_code == "0") {
      alert('Select  Customer Code');
    } else if (concerned_person == "" || concerned_person == "0") {
      alert('Select  Concerned  person');
    } else if (phone_number == "" || phone_number == "0") {
      alert('Select  phone number');
    } else {
      urll = "send_customer_data_to_server.php?data=" + customer_name + "~" + customer_code + "~" + concerned_person + "~" + phone_number + "~" + office_no + "~" + email + "~" + region + "~" + customer_group + "~" + gst_reg_number + "~" + company_name + "~" + country + "~" + state + "~" + city + "~" + pincode + "~" + address + "~" + edit_id;
      //prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {
            alert('Data has been saved Successfully.');
            window.location = "customer-mngt.php";
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
<!-- <script type="text/javascript" src="../assets/js/page/application.js"></script> -->
<!--<script type="text/javascript" src="../assets/dist/sweetalert2.all.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/choosen.js"></script>
<!-- <script src="jquery-1.9.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<!--==================== Start Script Link ======================-->

</body>

</html>