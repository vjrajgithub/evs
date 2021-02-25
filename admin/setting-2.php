<?php
require_once '../init.php';

if (not_logged_in() === TRUE) {
  header('location: ../index.php');
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
<?php include 'includes/head.php';?>
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
    top:5rem;
}
.wrapper.advance_search_excel button {
    padding: 10px 3px;
}

 }

    </style>
<?php include 'includes/header.php';?>
<?php include 'includes/sidebar.php';?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                     <h5 class="page_header_top">Content Management System</h5>
                                     <!--***** Tab_from advance search  start *******-->
                                        <div class="wrapper advance_search_excel">
                                              <div class="portlet-title hdr">
                                                    <div class="caption">
                                                        <a href="javascript:void(0)"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Add New <i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                            <thead>
                                                <tr>
                                                    <th>Employees List</th>
                                                    <th>Employees Name</th>
                                                    <th>Name of the post
                                                    </th>
                                                    <th>Employees ID </th>
                                                    <th>In-Date&Time</th>
                                                    <th>Out-Date&Time</th>
                                                    <th>Status</th>
                                                    <th>Action Item</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="display: table-row;">
                                                    <td>01</td>
                                                    <td>George C P</td>
                                                    <td>XYZ</td>
                                                    <td>ABC</td>
                                                    <td>2019-05-13 06:53:13 </td>
                                                    <td>0000-00-00 00:00:00 </td>
                                                    <td>Pending OUT </td>
                                                     <td>
                                                        <a href="#" title="view"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#mis_view_modal"></i></a>
                                                      
                                                       <a href="#" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#mis_edit_modal"></i>
                                                        </a>
                                                        <a href="#" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> 
                                                    </td>
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
        <h5 class="modal-title" id="exampleModalLabel">Master Data </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept="">
           <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                 <label class="control-label">Name
                 </label> 
                 <div>
                       <input type="text" name="name"                                                  data-required="1" class="form-control">
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
                                                            <label class="control-label input_hdr">Landmark
                                                                            <!-- <span class="required" aria-required="true"> * </span> -->
                                                            </label>
                                                                        <div>
                                                                            <input type="text" name="name" data-required="1" class="form-control">
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
                                                                        <label class="control-label input_hdr">Pin code
                                                                            <!-- <span class="required" aria-required="true"> * </span> -->
                                                                        </label>
                                                                        <div>
                                                                            <input type="number" name="name" data-required="1" class="form-control">
                                                                         </div>
                                                                    </div>
               </div>
           </div>

        </form>       
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary">Save changes</button>
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