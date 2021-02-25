<?php
require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}


// DELETE
$d_id = $_GET['d_id'];
if ($d_id != '' && $d_id != 0) {
  $query = "DELETE FROM `send_letter` WHERE id='" . $d_id . "'";
  // echo $query; die;
  mysqli_query($mycon, $query);
}



$colunmData = $_POST['colunmData'];
$item = $_POST['item'];
$fromdt = $_POST['fromdt'];
$todt = $_POST['todt'];

$startHour = "00:00:00";
$endHour = "23:55:55";

if (isset($_POST['fileRefno'])) {
  if(trim(strtolower($_POST['fileRefno'])) == "all" || trim(strtolower($_POST['fileRefno'])) == ""){
  $srcitem = "";      
  }else{
      $srcitem = "AND application_id ='" . trim($_POST['fileRefno']) . "'";
  }
} else {
  $srcitem = "";
}





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

                <h5 class="page_header_top">Postal Dispatch</h5>
                <!--***** Tab_from advance search  start *******-->
                <div class="wrapper advance_search_excel">
                    <div class="portlet-title hdr">
                        <div class="caption">
                            <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="reset();"> Add New <i class="fa fa-plus-circle" aria-hidden="true"></i>
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

                                    <div class="form-group Select_Items">
                                        <input type="text" name="fileRefno" id="colunmData1" class="form-control" placeholder="Please Enter Application ID" style="margin-left: 5px;" required>
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
                                <form action="report_postal_dispatch.php" onsubmit="submitForm()" method="POST" style="display: flex; justify-content: center; align-items: center;">
                                    <div class="form-group">

                                    </div>

                                    <div class="form-group Select_Items">
                                        <input type="text" name="fileRefno" id="colunmData2" class="form-control" placeholder="Please Enter Application Id" style="margin-left: 5px;" required>
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
                                                            <th>Letter Send Date</th>
                                                            <th>Client Name</th>
                                                            <th>Type of Checks
                                                            </th>
                                                            <th>Candidate Name </th>
                                                            <th>Case ID</th>
                                                            <th>Application ID</th>
                                                            <th>To</th>
                                                            <th>Document details</th>
                                                            <th>Letter Sender Name</th>
                                                            <th>Consignment No.</th>
                                                            <th>Charges</th>
                                                            <th>Consignment Date</th>
                                                            <th>Sender Remark</th>
                                                            <th>Created At</th>
                                                            <!-- <th>Delivered Status</th>
                                                            <th>Delievered Date</th>
                                                            <th>Receiver's Name </th>
                                                            <th>Receiver's Phone</th>
                                                            <th>Receiver's Post</th>
                                                            <th>Receiver Remark</th>
                                                            <th>created_at</th> -->
                                                            <th>Action</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                            //$customers = getAllCustomers($mycon);
                            $query = "SELECT * FROM `send_letter` WHERE 1=1 ".$role_item."".$srcitem." ORDER BY id DESC";
                            // echo $query;
                            $result = mysqli_query($mycon, $query);
                            if (mysqli_num_rows($result) > 0) {
                              while ($rows = mysqli_fetch_assoc($result)) {
                            ?>   
                                                    <tr style="display: table-row;">
                                                            <td><?php echo $rows['letter_send_date']; ?></td>
                                                            <td><?php echo $rows['client_name']; ?></td>
                                                            <?php echo getTypeOfCheckName($mycon, explode(',', $rows['Type_of_Checks'])); ?>
                                                            <td><?php echo $rows['candidate_name']; ?></td>
                                                            <td><?php echo $rows['case_id']; ?></td>
                                                            <td><?php echo $rows['application_id']; ?></td>
                                                            <td><?php  echo $rows['to_address']; ?></td>
                                                            <td><?php  echo $rows['document_details']; ?></td>
                                                            <td><?php  echo $rows['letter_sender_name']; ?></td>
                                                            <td><?php  echo $rows['consignment_no']; ?></td>
                                                            <td><?php  echo $rows['postal_charges']; ?></td>
                                                            <td><?php  echo $rows['consignment_date']; ?></td>
                                                            <td><?php  echo $rows['sender_remark']; ?></td>
                                                            <td><?php  echo $rows['created_at']; ?></td>
                                                            
                                                            <td>
                                                                <a href="#" title="view"><i class="fa fa-eye" onclick="set_all_data_new('<?php echo $rows['letter_send_date']; ?>', '<?php echo $rows['client_name']; ?>', '<?php echo getTypeOfCheckName($mycon, explode(',', $rows['Type_of_Checks'])); ?>', '<?php echo $rows['candidate_name']; ?>', '<?php echo $rows['case_id'];  ?>','<?php echo $rows['application_id']; ?>', '<?php echo $rows['to_address']; ?>', '<?php echo $rows['document_details']; ?>', '<?php echo $rows['letter_sender_name']; ?>', '<?php echo $rows['consignment_no']; ?>', '<?php echo $rows['postal_charges']; ?>', '<?php echo $rows['consignment_date']; ?>', '<?php echo $rows['sender_remark']; ?>', '<?php echo $rows['delivered_status']; ?>', '<?php echo $rows['delievered_date']; ?>', '<?php echo $rows['receivers_name']; ?>', '<?php echo $rows['receivers_phone']; ?>', '<?php echo $rows['receivers_post']; ?>', '<?php echo $rows['receiver_remark']; ?>', '<?php echo $rows['created_at']; ?>')" aria-hidden="true" data-toggle="modal" data-target="#mis_view_modal"></i></a>

                                                                <a href="#" title="Edit"><i class="fa fa-pencil-square-o" onclick="set_all_data_new_edit('<?php echo $rows['id']; ?>','<?php echo $rows['letter_send_date']; ?>', '<?php echo $rows['client_name']; ?>', '<?php echo getTypeOfCheckName($mycon, explode(',', $rows['Type_of_Checks'])); ?>', '<?php echo $rows['candidate_name']; ?>', '<?php echo $rows['case_id'];  ?>','<?php echo $rows['application_id']; ?>', '<?php echo $rows['to_address']; ?>', '<?php echo $rows['document_details']; ?>', '<?php echo $rows['letter_sender_name']; ?>', '<?php echo $rows['consignment_no']; ?>', '<?php echo $rows['postal_charges']; ?>', '<?php echo $rows['consignment_date']; ?>', '<?php echo $rows['sender_remark']; ?>', '<?php echo $rows['delivered_status']; ?>', '<?php echo $rows['delievered_date']; ?>', '<?php echo $rows['receivers_name']; ?>', '<?php echo $rows['receivers_phone']; ?>', '<?php echo $rows['receivers_post']; ?>', '<?php echo $rows['receiver_remark']; ?>', '<?php echo $rows['created_at']; ?>')"; aria-hidden="true" data-toggle="modal" data-target="#exampleModal"></i>
                                                                </a>
                                                                <a href="postal-dispatch.php?d_id=<?php echo $rows['id']; ?>" title="Delete" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o" aria-hidden="true"></i> </a>

                                                                <a href="#" title="POD updation form"  ><i class="fa fa-plus-square-o"  onclick="set_pod_updation_form('<?php echo $rows['id']; ?>')"; aria-hidden="true" data-toggle="modal" data-target="#PodUpdationModal"></i> </a>

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

<!--********** Modal popup start for view html code **********-->

<!-- Modal -->
<div class="modal fade" id="mis_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0; padding-bottom: 0;">
                <h5 class="modal-title" id="exampleModalLabel">Mis Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 28px;
    color: #920706;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mis_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0; padding-bottom: 0;">
                <h5 class="modal-title" id="exampleModalLabel">Mis Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 28px;
    color: #920706;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Letter Send Date</th>
                            <td>:</td>
                            <td id="letter_send_date_view"></td>
                        </tr>
                        <tr>
                            <th>Client Name</th>
                            <td>:</td>
                            <td id="client_name_view"></td>
                        </tr>
                        <tr>
                            <th>Type of Checks</th>
                            <td>:</td>
                            <td id="type_of_check_view"></td>
                        </tr>
                        <tr>
                            <th>Candidate Name</th>
                            <td>:</td>
                            <td id="candidate_name_view"></td>
                        </tr>

                        <tr>
                            <th>Case ID</th>
                            <td>:</td>
                            <td id="case_id_view"></td>
                        </tr>
                        <tr>
                            <th>Application ID</th>
                            <td>:</td>
                            <td id="application_id_view"></td>
                        </tr>
                        <tr>
                            <th>To</th>
                            <td>:</td>
                            <td id="to_address_view"></td>
                        </tr>
                        <tr>
                            <th>Document details</th>
                            <td>:</td>
                            <td id="document_details_view"></td>
                        </tr>
                        <tr>
                            <th>Letter Sender Name</th>
                            <td>:</td>
                            <td id="sender_name_view"></td>
                        </tr>
                        <tr>
                            <th>Consignment No</th>
                            <td>:</td>
                            <td id="consignment_no_view"></td>
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


<!-- modal for add from -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 620px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Postal Dispatch Information </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form accept="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Letter Send Date
                                </label>
                                <div>
                                    <input type="date" name="letter_send_date" id="letter_send_date"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Application ID
                                </label>
                                <div>
                                    <select name="applicationIdDD" id="applicationIdDD" onchange="changed_application_id('applicationIdDD','type_of_check');" class="form-control">
                                    <option value="">Select</option>
                                        <?php
                                        $sql_all_app_id = "select application_ref_id from tbl_application";
                                        // echo $sql_all_app_id; die;
                                        $result_all_app_id = mysqli_query($mycon, $sql_all_app_id);
                                        if (mysqli_num_rows($result_all_app_id) > 0) {
                                            while ($application = mysqli_fetch_assoc($result_all_app_id)) {
                                        ?>
                                                <option value="<?php echo $application['application_ref_id']; ?>"><?php echo $application['application_ref_id']; ?></option>
                                        <?php }
                                        } ?>


                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input_hdr" for="select">Case ID </label>
                                <input type="text" id="case_id" name="case_id" class="form-control">
                                <!-- <select name="case_id" id="case_id" class="form-control" >
                                    
                                </select> -->
                            </div>
                            <div class="form-group">
                                <label class="input_hdr" for="select">Client Name </label>
                                <input type="text" id="client_name" name="client_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label input_hdr">Candidate Name
                                    <!-- <span class="required" aria-required="true"> * </span> -->
                                </label>
                                <div>
                                    <input type="text" name="candidate_name" id="candidate_name" data-required="1" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type_of_check"> Type of Check &#9734; </label>
                                <select name="type_of_check" id="type_of_check" multiple="multiple" class="form-control" style="height: 200px">

                                    <option value=""> Select </option>


                                </select>
                            </div>


                            <div class="form-group">
                                <label class="control-label">To :
                                </label>
                                <div>
                                    <input type="text" name="to_address" id="to_address" data-required="1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label" for="select">Document details</label>
                                <input type="textbox" name="document_details" id="document_details" class="form-control">
                                        <i>*Note:(Eg: Document- DD, DD number- 2763512)</i>
                            </div>
                            <div class="form-group">
                                <label class="control-label input_hdr">Letter Sender Name
                                </label>
                                <div>
                                    <input type="text" name="sender_name" id="sender_name" class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label input_hdr">Consignment No
                                </label>
                                <div>
                                    <input type="text" name="consignment_no" id="consignment_no" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Postal Charges
                                </label>
                                <div>
                                <input type="hidden" class="form-control" id="id_sent_letter" name="id_sent_letter">
                                    <input type="text" name="postal_charges" id="postal_charges" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Consignment Date
                                </label>
                                <div>
                                    <input type="date" name="consignment_date" id="consignment_date" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Sender Remark
                                </label>
                                <div>
                                    <!-- <input type="text" name="sender_remark" id="sender_remark"  class="form-control"> -->

                                    <textarea type="text" class="form-control" name="sender_remark" id="sender_remark" cols="40" rows="5"></textarea>

                                </div>
                            </div>


                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" onclick="send_data_toserver();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal for add from -->

<!-- =====================================model for pod updattion form=================================== -->

<div class="modal fade" id="PodUpdationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 620px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Pod Updation Information </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form accept="">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label class="control-label">Delievered Date
                                </label>
                                <div>
                                    <input type="date" name="delivery_date" id="delivery_date"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Receiver's Name
                                </label>
                                <input type="text" id="reciver_name" name="reciver_name" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label class="input_hdr" for="select">Receiver's Phone </label>
                                <input type="text" id="receiver_phone" name="receiver_phone" onkeypress=" var result =  isNumber(event); return result; " maxlength="10" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label input_hdr">Receiver's Post
                                    <!-- <span class="required" aria-required="true"> * </span> -->
                                </label>
                                <div>
                                    <input type="text" name="receiver_post" id="receiver_post" data-required="1" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Receiver Remark 
                                </label>
                                <div>
                                    <input type="hidden" id="id_sent_letter_pod" name="id_sent_letter_pod">
                                    <input type="text" name="reciver_remark" id="reciver_remark" data-required="1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6"></div> -->
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary" onclick="send_data_toserver_pod_updation()">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- end modal for pod updation form -->


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
<!-- =====================================functionality js================================================ -->
<script>

  function isNumber(evt) {
			var iKeyCode = (evt.which) ? evt.which : evt.keyCode
			if ( iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
				// blockSpecialCharwithMessage(evt);
				alert("Only Numbers are allowed.");
				return false;
			}
				


			return true;
		}
  // changed_application_id
  function changed_application_id(application_dd, type_check_dd) {
    change_case_id(application_dd);
    change_client_name(application_dd);
    var xmlhttp = new XMLHttpRequest();
    // alert(document.getElementById("countrydd").value);
    // state back is for geting state and city list present in database for state list we require country_id and for city list we require state_id
    xmlhttp.open("GET", "type_of_check_back_postal.php?application_id=" + document.getElementById(application_dd).value, false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById(type_check_dd).innerHTML = xmlhttp.responseText;

    if (document.getElementById(application_dd).value == "") {
      document.getElementById(type_check_dd).innerHTML = "<select><option value=''>Select</option></select>";
      // document.getElementById(city_Search).innerHTML = "<select><option  value=''>Select</option></select>";
    }



  }

 function change_case_id(application_id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "case_id_back.php?application_id=" + document.getElementById(application_id).value +"&status=" + 1 , false);
    xmlhttp.send(null);
    document.getElementById('case_id').value  = xmlhttp.responseText;
 } 

 function change_client_name(application_id){

            $.post("case_id_back.php?application_id=" + document.getElementById(application_id).value +"&status=" + 2, function(data) {
              var res = $.parseJSON(data); 
              document.getElementById('client_name').value = ""+ res['client_code'] +"-"+ res['client_name'];
            document.getElementById('candidate_name').value = res['candidate_name'];

          
        });
 
 } 

function reset(){
  
			document.getElementById('letter_send_date').value = "";
			document.getElementById('applicationIdDD').value = "";
			document.getElementById('case_id').innerHTML = "";
			document.getElementById('client_name').value = "";
			document.getElementById('candidate_name').value = "";
			document.getElementById('type_of_check').innerHTML = "<option value=''> Select </option>";
			document.getElementById('to_address').value = "";
			document.getElementById('document_details').value = "";
			document.getElementById('sender_name').value = "";
			document.getElementById('consignment_no').value = "";
			document.getElementById('postal_charges').value = "";
			document.getElementById('consignment_date').value = "";
			document.getElementById('sender_remark').value = "";
            document.getElementById('id_sent_letter').value =  "";


    
}

function set_all_data_new (letter_send_date,  client_name, type_of_check, candidate_name, case_id, application_id, to_address, document_details, sender_name, consignment_no) {
// alert(type_of_check_view);
document.getElementById('letter_send_date_view').innerHTML = letter_send_date;
document.getElementById('client_name_view').innerHTML = client_name;
document.getElementById('type_of_check_view').innerHTML = type_of_check;
document.getElementById('candidate_name_view').innerHTML =  candidate_name;
document.getElementById('case_id_view').innerHTML =  case_id;
document.getElementById('application_id_view').innerHTML =  application_id;
document.getElementById('to_address_view').innerHTML =  to_address;
document.getElementById('document_details_view').innerHTML =  document_details;
document.getElementById('sender_name_view').innerHTML =  sender_name;
document.getElementById('consignment_no_view').innerHTML =  consignment_no;

}

function set_all_data_new_edit (id_sent_letter, letter_send_date,  client_name, type_of_check, candidate_name, case_id, application_id, to_address, document_details, sender_name, consignment_no, postal_charges, consignment_date, sender_remark) {
    

document.getElementById('letter_send_date').value = letter_send_date;
document.getElementById('applicationIdDD').value =  application_id;
changed_application_id('applicationIdDD','type_of_check');
// document.getElementById('client_name').value = client_name;
// document.getElementById('type_of_check').value = type_of_check;
// document.getElementById('candidate_name').value =  candidate_name;
// document.getElementById('case_id').value =  case_id;
document.getElementById('to_address').value =  to_address;
document.getElementById('document_details').value =  document_details;
document.getElementById('sender_name').value =  sender_name;
document.getElementById('consignment_no').value =  consignment_no;
document.getElementById('postal_charges').value =  postal_charges;
document.getElementById('id_sent_letter').value =  id_sent_letter;
document.getElementById('consignment_date').value =  consignment_date;
document.getElementById('sender_remark').value =  sender_remark;

}



  function send_data_toserver() {
    var letter_send_date = document.getElementById('letter_send_date').value;
    var application_id = document.getElementById('applicationIdDD').value;
    var case_id = document.getElementById('case_id').value;
    var client_name = document.getElementById('client_name').value;
    var candidate_name = document.getElementById('candidate_name').value;
    var postal_type_of_check = Array.from(document.getElementById("type_of_check").options).filter(option => option.selected).map(option => option.value);
    var to_address = document.getElementById('to_address').value;
    var document_details = document.getElementById('document_details').value;
    var sender_name = document.getElementById('sender_name').value;
    var consignment_no = document.getElementById('consignment_no').value;
    var postal_charges = document.getElementById('postal_charges').value;
    var consignment_date = document.getElementById('consignment_date').value;
    var sender_remark = document.getElementById('sender_remark').value;
    var id_sent_letter = document.getElementById('id_sent_letter').value;
    // var allocated_type_of_check = document.getElementById('type_of_check').value;

    

    if (letter_send_date == "" || letter_send_date == "") {
      alert('Enter letter send date');
    } else if (application_id == "" || application_id == "0") {
      alert('Select  application Id');
    } else if (case_id == "" || case_id == "0") {
      alert('Select  case Id');
    } else if (client_name == "" || client_name == "0") {
      alert('Select  client Name');
    } else if (candidate_name == "" || candidate_name == "0") {
      alert('Select  candidate name');
    } else if (postal_type_of_check == "" || postal_type_of_check == "0") {
      alert('Select  Type of Check');
    } else if (to_address == "" || to_address == "0") {
      alert('Select  To Address');
    } else if (document_details == "" || document_details == "0") {
      alert('Select  Document Details');
    } else if (sender_name == "" || sender_name == "0") {
      alert('Select letter sender Name');
    } else if (consignment_no == "" || consignment_no == "0") {
      alert('Select letter Consignment No');
    } else if (postal_charges == "" || postal_charges == "0") {
      alert('Select letter Postal Charges');
    } else if (consignment_date == "" || consignment_date == "0") {
      alert('Select Consignment Date');
    } else if (sender_remark == "" || sender_remark == "0") {
      alert('Select letter sender Remark');
    } else {
      urll = "send_postal_dispatch_data_to_server.php?data=" + letter_send_date + "~" + application_id + "~" + case_id + "~" + client_name + "~" + candidate_name + "~" + postal_type_of_check + "~" + to_address + "~" + document_details + "~" + sender_name + "~" + consignment_no + "~" + postal_charges + "~" + consignment_date + "~" + sender_remark + "~" + id_sent_letter;
      // prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {
            alert('Data has been saved Successfully.');
            window.location = "postal-dispatch.php";
          } else if (this.responseText == 2 || this.responseText == '2') {
            alert('Sorry Something went Wrong.');

          }
        }
      };
      xhttp.open("GET", urll, true);
      xhttp.send();
    }

  }
function set_pod_updation_form(id_sent_letter_pod){
document.getElementById('id_sent_letter_pod').value =  id_sent_letter_pod;

}
  function send_data_toserver_pod_updation(){
    //   alert("id_sent_letter_pod");
    var delivery_date = document.getElementById('delivery_date').value;
    var reciver_name = document.getElementById('reciver_name').value;
    var receiver_phone = document.getElementById('receiver_phone').value;
    var receiver_post = document.getElementById('receiver_post').value;
    var reciver_remark = document.getElementById('reciver_remark').value;
    var id_sent_letter_pod = document.getElementById('id_sent_letter_pod').value;
    
    

    if (delivery_date == "" || delivery_date == "") {
      alert('Enter Delivery Date');
    } else if (reciver_name == "" || reciver_name == "0") {
      alert('Select  Reciver Name');
    } else if (receiver_phone == "" || receiver_phone == "0") {
      alert('Select  Reciver Phone');
    } else if (receiver_post == "" || receiver_post == "0") {
      alert('Select  Reciver Post');
    } else if (reciver_remark == "" || reciver_remark == "0") {
      alert('Select  Reciver Remark');

    } else {
      urll = "send_pod_updation_data_to_server.php?data=" + delivery_date + "~" + reciver_name + "~" + receiver_phone + "~" + receiver_post + "~" + reciver_remark + "~" + id_sent_letter_pod ;
    //   prompt("Copy to clipboard: Ctrl+C, Enter", urll);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == 1 || this.responseText == '1') {
            alert('Data has been saved Successfully.');
            window.location = "postal-dispatch.php";
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
<!--==================== Start Script Link ======================-->
<script type="text/javascript">
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>
</body>

</html>