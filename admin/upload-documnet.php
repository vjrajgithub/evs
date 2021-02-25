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
  div.input_hdr {
    text-align: left !important;
    font-family: auto;
  }
</style>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper">
        <div class="page-body">
          <div class="card">
            <div class="card-block application_dtls">
              <div class="row">
                <div class="col-md-12">
                  <div class="vertical_tabs_views">
                    <div class="tabordion">
                      <section id="section1">
                        <input type="radio" name="sections" id="option1" checked>
                        <label class="labls" for="option1">Application Details Document
                        </label>
                        <article>
                          <h2>Application Details Document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;     margin-top: 28px;">
                            <button class="btn btn-success">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section2">
                        <input type="radio" name="sections" id="option2">
                        <label class="labls" for="option2">Personal Details Document
                        </label>
                        <article>
                          <h2>Personal Details Document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section3">
                        <input type="radio" name="sections" id="option3">
                        <label class="labls" for="option3">Identity Proof Documents
                        </label>
                        <article>
                          <h2>Identity Proof Documents</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section4">
                        <input type="radio" name="sections" id="option4">
                        <label class="labls" for="option4">Address Proof Documents</label>
                        <article>
                          <h2>Address Proof Documents</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section5">
                        <input type="radio" name="sections" id="option5">
                        <label class="labls" for="option5">Educational  Document</label>
                        <article>
                          <h2>Educational  document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section6">
                        <input type="radio" name="sections" id="option6">
                        <label class="labls" for="option6">Employment Details Document</label>
                        <article>
                          <h2>Employment details document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section7">
                        <input type="radio" name="sections" id="option7">
                        <label class="labls" for="option7">Police Verification Details Document</label>
                        <article>
                          <h2>Police verification details document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
                      <section id="section8">
                        <input type="radio" name="sections" id="option8">
                        <label class="labls" for="option8">Reference Details Document
                        </label>
                        <article>
                          <h2>Reference details document</h2>
                          <div class="form-group">
                            <label class="input_hdr" for="select">Select Documents</label>
                            <select name="select" class="form-control">
                              <option>Adhar card </option>
                              <option>Pan card </option>
                              <option>Voter card</option>
                              <option>Passport no.</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <!--   <label class="control-label">Telephone
                              <span aria-required="true" class="required"> * </span></label>  -->
                            <div><input type="text" name="name" data-required="1" class="form-control" placeholder="Please enter Document no."></div>
                          </div>
                          <!-- upload Signaturesign start-->
                          <div class="file-upload">


                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>
                          <!-- upload Signaturesign end-->
                          <div class="form-group " style="text-align: center;    margin-top: 28px;">
                            <button class="btn btn-success  upload_doc_btn">Upload documnet </button>
                          </div>
                        </article>
                      </section>
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
<!--==================== Start Script Link ======================-->


</body>

</html>