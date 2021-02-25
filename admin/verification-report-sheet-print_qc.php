<?php
require_once '../init.php';
include_once 'function.php';

if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}

//pre($mycon);
$allData = getAllApplicationInformation($mycon);
//pre($allData);



$application = getAllAppInformation($mycon, $_GET['appid']);
$typeOfCheckArray = explode(',', $application['type_of_check']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Verification Report Sheet Print</title>
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">

    <!--********* Global Style start End ********-->


</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col-md-12 wrapper table">
                <div class="col-md-12 text-center">

                    <button class="btn btn-success" onclick="set_for_approval_form('<?php echo $_GET['appid'] ?>');" data-toggle="modal" data-target="#revertUpdationModal" style="margin: 30px;" > Please click here to add a remark for report <i aria-hidden="true"></i>
                    </button>

                    <!-- <button class="btn btn-primary" onclick="window.history.back()">Back</button> -->

                </div>

                <table class="table table-bordered" id="printTable">
                    <!--***** style start css ******-->
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
                            border: none !important;
                        }

                        .table thead th {
                            border: 0 !important;
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
                            margin: 0 auto;
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
                */
                            margin: 0 auto;
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
                            margin: 0 auto;
                            padding: 10px;
                            background: #f8f9fa5e;
                            border: 2px solid #dc3545ba !important;
                        }

                        @import url('https://fonts.googleapis.com/css?family=Open+Sans|Roboto:300,400,500,700&display=swap');

                        table {
                            font-family: 'Roboto',
                        }

                        .table-bordered td,
                        .table-bordered th {
                            border: 1px solid #ddd !important;
                            font-size: 14px;
                            font-weight: 500;
                        }

                        span.verified.BIG {
                            width: 70px;
                            height: 45px;
                            display: inline-block;
                            margin: 0 auto;
                            background: green
                        }
                    </style>

                    <!--***** style end css ******-->

                    <!--********* Global Style start *********-->
                    <thead style="border: 1px solid #ccc;">

                        <tr>
                            <th colspan="2" class="hdr_sec">
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
                    </thead>
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
                                        <td colspan="4" style="text-align: center; background-color: #eee;">
                                            <h3 class="table_bodyallhdr">APPLICATION INFORMATION</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HMDS ID </td>
                                        <td><?php echo $application['hmds_id'] ?></td>
                                        <td>CASE REC. DATE </td>
                                        <td><?php echo $application['case_record_date'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>APPLICANT NAME </td>
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
                                        <td colspan="3" style="text-align: center; background-color: #eee;">
                                            <h3 class="table_bodyallhdr">Verification Summary</h3>
                                        </td>
                                    </tr>
                                    <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                                        <td>CHECKS </td>
                                        <td>DETAILS </td>
                                        <td>STATUS </td>

                                    </tr>
                                    <?php if (in_array("4", $typeOfCheckArray)) { ?>
                                        <tr>
                                            <td>EDUCATION </td>
                                            <td> <?php echo $application['eduData']['0']['college_institute'] ?></td>
                                            <td><?php echo ($application['ApplicationDataCheck'][0]['is_education_details_checked']) ? ('VERIFIED CLEAR') : ('PENDING'); ?></td>

                                        </tr>
                                    <?php }
                                    if (in_array("5", $typeOfCheckArray)) { ?>
                                        <tr>
                                            <td>ADDRESS</td>
                                            <td><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?> </td>
                                            <td><?php echo ($application['ApplicationDataCheck'][0]['is_address_details_checked']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>

                                        </tr>
                                    <?php }
                                    if (in_array("5", $typeOfCheckArray)) { ?>
                                        <tr>
                                            <td>IDENTITY </td>
                                            <td><?php echo $application['addressData'][0]['title'] . " - " . $application['addressData'][0]['document_no'] ?> </td>
                                            <td><?php echo ($application['addressDataCheck'][0]['is_verify']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>


                                        </tr>
                                    <?php }
                                    if (in_array("6", $typeOfCheckArray)) { ?>
                                        <tr>
                                            <td>CRIMINAL </td>
                                            <td>HOUSE NO. D-223/4, NEW ASHOK NAGAR, GALI NO.12, DELHI - 110096. </td>
                                            <td>VERIFIED CLEAR</td>

                                        </tr>
                                    <?php }
                                    if (in_array("5", $typeOfCheckArray)) { ?>
                                        <tr>
                                            <td>REFERENCE 1 </td>
                                            <td> <?php echo $application['referenceData']['0']['name'] ?> </td>
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
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">EDUCATION REPORT</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">APPLICANT NAME </td>
                                            <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?> </td>
                                            <td><?php echo ($application['eduDataCheck'][0]['is_emp_name_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">ROLL NO./REG NO. </td>
                                            <td><?php echo $application['eduData'][0]['roll_no']; ?></td>
                                            <td><?php echo ($application['eduDataCheck'][0]['is_rollno_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">QUALIFICATION</td>
                                            <td><?php echo $application['eduData'][0]['qualification']; ?></td>
                                            <td><?php echo ($application['eduDataCheck'][0]['is_verify']) ? ('CORRECT') : ('PENDING'); ?> </td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">INSTITUTE / UNIVERSITY NAME </td>
                                            <td><?php echo $application['eduData'][0]['college_institute']; ?> </td>
                                            <td><?php echo $application['eduData'][0]['university_board']; ?> </td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">PASSING YEAR </td>
                                            <td><?php echo $application['eduData'][0]['passing_year']; ?></td>
                                            <td><?php echo ($application['eduDataCheck'][0]['is_passing_year_correct']) ? ('CORRECT') : ('PENDING'); ?></td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFIER NAME & TITLE </td>
                                            <td colspan="2"><?php echo $application['eduData'][0]['verifier_name'] . '-' . ['eduData'][0]['verifier_designation']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">ADDITIONAL COMMENT</td>
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
                        <?php }
                        if (in_array("8", $typeOfCheckArray)) { ?>
                            <!-- Employment Report start -->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">EMPLOYMENT REPORT</h3>
                                            </td>
                                        </tr>
                                        <tr style="background: #004085; color: #fff;">
                                            <td>APPLICANT DETAILS </td>
                                            <td>APPLICANT INPUT </td>
                                            <td>VERIFIER INPUT</td>

                                        </tr>
                                        <tr>
                                            <td>COMPANY NAME </td>
                                            <td><?php echo $application['empData'][0]['company_name']; ?></td>
                                            <td colspan="2"><?php echo ($application['empDataCheck'][0]['is_verify']) ? ('CORRECT') : ('PENDING'); ?></td>



                                        </tr>
                                        <tr>
                                            <td>DATE OF JOINING </td>
                                            <td><?php echo $application['empData'][0]['date_of_joining']; ?></td>
                                            <td>Same </td>

                                        </tr>
                                        <tr>
                                            <td>DATE OF LEAVING </td>
                                            <td><?php echo $application['empData'][0]['date_of_joining']; ?></td>
                                            <td><?php echo $application['empData'][0]['date_of_relieving']; ?></td>

                                        </tr>
                                        <tr>
                                            <td>DESIGNATION </td>
                                            <td><?php echo $application['empData'][0]['designation']; ?></td>
                                            <td>Same</td>

                                        </tr>
                                        <tr>
                                            <td>EMPLOYEE ID </td>
                                            <td>1916 </td>
                                            <td>2297 </td>
                                        </tr>
                                        <tr>
                                            <td>SALARY WITHDRAWN </td>
                                            <td>Please Confirm </td>
                                            <td><?php echo $application['empData'][0]['salary']; ?> CTC</td>
                                        </tr>
                                        <tr>
                                            <td>REASON FOR LEAVING </td>
                                            <td><?php echo $application['empData'][0]['reason_for_leaving']; ?> </td>
                                            <td><?php echo $application['empData'][0]['reason_for_leaving']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ELIGIBLE FOR RE HIRE </td>
                                            <td>Please Confirm </td>
                                            <td><?php echo $application['empDataCheck'][0]['eligible_for_rehire']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>HOW WAS CANDIDATE CHARACTER DURING TENURE</td>
                                            <td>Please Confirm </td>
                                            <td><?php echo $application['empDataCheck'][0]['how_was_the_candidate_behavior_during_tenure']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>VERIFIER NAME & DESIGNATION </td>
                                            <td colspan="2"><?php echo $application['empDataCheck'][0]['verifier_name'] . '-' . $application['empDataCheck'][0]['verifier_designation']; ?></td>

                                        </tr>
                                        <tr>
                                            <td>ADDITIONAL COMMENT </td>
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
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">IDENTITY REPORT</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">APPLICANT IDENTITY DETAILS </td>
                                            <td><?php echo $application['addressImages'][0]['title'] . " - " . $application['addressImages'][0]['document_no'] ?> </td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFIER AUTHORITY </td>
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
                        <?php }
                        if (in_array("1", $typeOfCheckArray)) { ?>
                            <!-- Address Proof start -->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">ADDRESS REPORT</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php echo $application['addressData'][0]['address'] ?><br> <?php echo $application['addressData'][0]['address'] . ', ' . $application['addressData'][0]['city'] . '<br> ' . $application['addressData'][0]['state'] . '-' . $application['addressData'][0]['pin_code'] ?></td>
                                            <!--<td><?php echo $application['addressData'][1]['address'] ?><br> <?php echo $application['addressData'][1]['address'] . ', ' . $application['addressData'][1]['city'] . '<br> ' . $application['addressData'][1]['state'] . '-' . $application['addressData'][1]['pin_code'] ?></td>-->

                                            <!--<td>V P O SAMLOTI TEH KANGRA,<br> SAMLOTI (691),SAMLOTI KANGRA, <br>HIMACHAL PRADESH-176056  </td>-->

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">PERIOD OF STAY </td>
                                            <td><?php echo $application['addressDataCheck'][0]['how_many_years_candidate_is_residing'] ?></td>


                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">ACCOMODATION STATUS </td>
                                            <td><?php echo $application['addressDataCheck'][0]['accommodation_type'] ?></td>


                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">NEAREST LANDMARK </td>
                                            <td><?php echo $application['addressDataCheck'][0]['land_mark'] ?></td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFIED BY </td>
                                            <td><?php echo $application['addressDataCheck'][0]['verifier_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">RELATIONSHIP WITH APPLICANT </td>
                                            <td><?php echo $application['addressDataCheck'][0]['verifier_relationship'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFIER CONTACT NO. </td>
                                            <td><?php echo $application['addressDataCheck'][0]['contact_of_respondent'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFICATION DATE </td>
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
                        <?php }
                        if (in_array("6", $typeOfCheckArray)) { ?>
                            <!-- criminal record start -->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td colspan="2" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">POLICE VERIFICATION REPORT</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">APPLICANT ADDRESS DETAILS </td>
                                            <td><?php echo $application['vrificationData']['address'] ?><br> <?php echo $application['vrificationData']['address'] . ', ' . $application['vrificationData']['city'] . '<br> ' . $application['vrificationData']['state'] . '-' . $application['vrificationData']['pincode'] ?></td>

                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">NAME OF THE POLICE AUTHORITY </td>
                                            <td><?php echo $application['vrificationDataCheck']['police_authority'] ?></td>


                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">VERIFIER NAME & TITLE </td>
                                            <td><?php echo $application['vrificationDataCheck']['verifier_name'] . '-' . $application['vrificationDataCheck'][0]['verifier_designation'] ?></td>


                                        </tr>
                                        <tr>
                                            <td style="background: #004085; color: #fff;">ADDITIONAL COMMENT </td>
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
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">COURT RECORD CHECK</h3>
                                            </td>
                                        </tr>
                                        <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                                            <td>APPLICANT DETAILS</td>
                                            <td>APPLICANT INPUT </td>
                                            <td>VERIFIER INPUT</td>

                                        </tr>
                                        <tr>
                                            <td>APPLICANT NAME </td>
                                            <td><?php echo $application['personalData']['0']['firstName'] . ' ' . $application['personalData']['0']['lastName'] ?></td>

                                            <td><?php echo ($application['courtDataCheck'][0]['is_applicant_name_correct']) ? ('VERIFIED CLEAR') : ('PENDING'); ?> </td>



                                        </tr>
                                        <tr>
                                            <td>FATHER’S NAME </td>
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
                        <?php }
                        if (in_array("10", $typeOfCheckArray)) { ?>

                            <!-- 1. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  start-->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">1. CIBIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION</h3>
                                            </td>
                                        </tr>
                                        <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                                            <td>Court</td>
                                            <td>Court Name </td>
                                            <td>Results</td>

                                        </tr>
                                        <tr>
                                            <td>DISTRICT COURT/ LOWER COURT/CIVIL COURT & SMALL CAUSES </td>
                                            <td>All India Courts </td>
                                            <td><?php echo $application['courtDataCheck'][0]['found_record_all_india_court_for_civil'] ?></td>


                                        </tr>
                                        <tr>
                                            <td>HIGH COURT </td>
                                            <td>All High Courts of India </td>
                                            <td><?php echo $application['courtDataCheck'][0]['found_record_in_all_high_courts_of_india_for_civil'] ?></td>


                                        </tr>
                                        <tr>
                                            <td>SUPREME COURT </td>
                                            <td>Supreme Court Of India </td>
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
                        <?php }
                        if (in_array("11", $typeOfCheckArray)) { ?>
                            <!-- 2. CIVIL PROCEEDING: ORIGINAL SUIT/ MISCELLANEOUS SUIT/ EXECUTIONPETITION  start-->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">2.CRIMINALPROCEEDINGS : CRIMINALPETITIONS/CRIMINALAPPEAL /SESSIONCASE,<br> / CRIMINALMISCELLANEOUSPETITION /<br> CRIMINAL REVISIONAPPEAL</h3>
                                            </td>
                                        </tr>
                                        <tr style="text-align: center;color: #ffffff;background-color: #004085;">
                                            <td>Court</td>
                                            <td>Court Name </td>
                                            <td>Results</td>

                                        </tr>
                                        <tr>
                                            <td>SESSION COURT </td>
                                            <td>All Session Courts </td>
                                            <td><?php echo $application['courtDataCheck'][0]['found_record_in_all_session_courts_for_criminal'] ?></td>


                                        </tr>
                                        <tr>
                                            <td>HIGH COURT </td>
                                            <td>All High Courts of India </td>
                                            <td><?php echo $application['courtDataCheck'][0]['found_record_all_high_courts_of_india_for_criminal'] ?></td>



                                        </tr>
                                        <tr>
                                            <td>SUPREME COURT </td>
                                            <td>Supreme Court Of India </td>
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
                        <?php }
                        if (in_array("12", $typeOfCheckArray)) { ?>
                            <!-- Drag Test strat -->
                            <tr>
                                <td colspan="4">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td colspan="3" style="text-align: center; background-color: #eee;">
                                                    <h3 class="table_bodyallhdr">DRUG ABUSE TEST REPORT</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background: #004085; color: #fff;">PANEL </td>
                                                <td><?php echo $application['drugDataCheck']['0']['panel']; ?></td>

                                            </tr>
                                            <tr>
                                                <td style="background: #004085; color: #fff;">SAMPLE COLLECTED </td>
                                                <td><?php echo $application['drugDataCheck']['0']['sample_collected']; ?></td>


                                            </tr>
                                            <tr>
                                                <td style="background: #004085; color: #fff;">REPORT STATUS </td>repport_status
                                                <td><?php echo ($application['drugDataCheck'][0]['repport_status']) ? ('Detected') : ('Not Detected'); ?> </td>



                                            </tr>
                                            <tr>
                                                <td style="background: #004085; color: #fff;">COMMENT </td>
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
                                    <tbody>
                                        <tr>
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">DISCLAIMER</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Our reports are submitted in strict confidence and except where required by law, no information provided in our reports may be revealed directly or indirectly to any person except to those whose official duties require them to pass this report on in relation to which the report was requested by the client. </td>


                                        </tr>
                                        <tr>
                                            <td>
                                                Himadi Solutions Pvt. Ltd, Inc. neither warrants, vouches for, or authenticates the reliability of the information contained herein that the records are accurately reported as they were found at the source as of the date and time of this report, whether on a computer information system, retrieved by manual search, or telephonic interviews. The information provided herein shall not be construed to constitute a legal opinion; rather it is a compilation of public records and/or data for your review.

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
                                            <td colspan="3" style="text-align: center; background-color: #eee;">
                                                <h3 class="table_bodyallhdr">About Us</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Himadi Solutions Pvt. Ltd. provides dynamic Customer-Focused IT and BPO solutions that bridge the gap between principals and their prospective / existing customers. We provide a wide spectrum of BPO service including Background Check for Employees, Vendors, Suppliers andothers.</td>


                                        </tr>
                                        <tr>
                                            <td>
                                                We have nationwide networking to meet the ever-growing needs of our customers across all locations covering the entire Indian Subcontinent and US. Outstanding customer service and superior quality of support to our customers is the core motto of existence.


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
                                    <span>Himadi Solutions Pvt Ltd.</span><br>
                                    <a Web : href="#"> www.himadi.com</a>
                                    <a href="mailto: Sales@himadi.com" target="_top">Mail to : Sales@himadi.com</a>
                                </div>

                            </td>
                        </tr>
                    </tfoot>
                </table>

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
                                    <button type="button" class="btn btn-primary" onclick="send_data_toserver_for_approval(10)">QC Done</button>
                                    <button type="button" class="btn btn-primary" onclick="send_data_toserver_for_approval(9)">Issue in Report</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end modal for QC Done remark form -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        function set_for_approval_form(id_tbl_application_check) {
            // alert(id_tbl_application_check);

            // document.getElementById('id_tbl_application_check_for_qc').value =  id_received_letter;
            // $("#view_modal_qc").modal("hide");
            // $("#revertUpdationModal").modal("show");
            document.getElementById('id_tbl_application_check_for_qc').value = id_tbl_application_check;

        }

        function send_data_toserver_for_approval(approval_status) {
            alert(id_tbl_application_check_for_qc);


            var remark_for_qc_done = document.getElementById('remark_for_qc_done').value;
            var id_tbl_application_check_for_qc = document.getElementById('id_tbl_application_check_for_qc').value;




            if (remark_for_qc_done == "" || remark_for_qc_done == "0") {
                alert('Select Remark for QC');

            } else {
                urll = "send_qc_remark_data.php?data=" + remark_for_qc_done + "~" + approval_status + "~" + id_tbl_application_check_for_qc;
                prompt("Copy to clipboard: Ctrl+C, Enter", urll);
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


</body>

</html>