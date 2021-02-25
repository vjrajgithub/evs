<?php

error_reporting(1);
session_start();
define('FCPATH', dirname(__DIR__) . '/');
define('ABSPATH', dirname(dirname(__FILE__)) . '/');

function pre($var, $exit = true) {
  echo "<pre>";
  print_r($var);
  echo "</pre>";
  if ($exit) {
    exit;
  }
}

function mysqli_fetch_alll($qslObj, $s) {
  $dataArray = [];
  if (is_object($qslObj) && isset($qslObj) && $qslObj != 0) {
    while ($row = $qslObj->fetch_assoc()) {
      $dataArray[] = $row;
    }
  }
  return $dataArray;
}

function getAllAppInformation($mycon, $app_id) {
  $appQuery = "SELECT * FROM tbl_application WHERE application_ref_id = '" . $app_id . "'";
  $applicationResult = mysqli_query($mycon, $appQuery);
  $applicationRow = [];
//pre($result1);
  if (mysqli_num_rows($applicationResult) > 0) {
    $applicationRow = mysqli_fetch_array($applicationResult, MYSQLI_ASSOC);

    $appQueryCheck = "SELECT * FROM tbl_application_check WHERE application_id = '" . $app_id . "'";
    $applicationResultCheck = mysqli_query($mycon, $appQueryCheck);
    $personalRowCheck = mysqli_fetch_alll($applicationResultCheck, MYSQLI_ASSOC);
    $applicationRow['ApplicationDataCheck'] = (array) $personalRowCheck;
    //pre($applicationRow);
//die;
    $personalQuery = "SELECT * FROM employee_personal_info_tbl WHERE application_id = '" . $app_id . "'";
    $personalQueryResult = mysqli_query($mycon, $personalQuery);
    $personalRow = mysqli_fetch_alll($personalQueryResult, MYSQLI_ASSOC);
    $applicationRow['personalData'] = (array) $personalRow;

    $personalQueryCheck = "SELECT * FROM employee_personal_info_tbl_check WHERE application_id = '" . $app_id . "'";
    $personalQueryCheckResult = mysqli_query($mycon, $personalQueryCheck);
    $personalCheckRow = mysqli_fetch_alll($personalQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['personalDataCheck'] = (array) $personalCheckRow;

    $addressQuery = "SELECT * FROM employee_address WHERE application_id = '" . $app_id . "'";
    $addressQueryResult = mysqli_query($mycon, $addressQuery);
    $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
    $applicationRow['addressData'] = (array) $addressRow;

    $addressQuery = "SELECT * FROM employee_address_check WHERE application_id = '" . $app_id . "'";
    $addressQueryResult = mysqli_query($mycon, $addressQuery);
    $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
    $applicationRow['addressDataCheck'] = (array) $addressRow;
    $applicationRow['addressImages'] = getDocumentsByType($mycon, 'address', $app_id);

    $eduQuery = "SELECT * FROM employee_education_tbl WHERE application_id = '" . $app_id . "'";
    $eduQueryResult = mysqli_query($mycon, $eduQuery);
    $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
    $applicationRow['eduData'] = (array) $eduRow;

    $eduQuery = "SELECT * FROM employee_education_tbl_check WHERE application_id = '" . $app_id . "'";
    $eduQueryResult = mysqli_query($mycon, $eduQuery);
    $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
    $applicationRow['eduDataCheck'] = (array) $eduRow;
    $applicationRow['eduImages'] = getDocumentsByType($mycon, 'education', $app_id);



    $empQuery = "SELECT * FROM employee_employment_info_tbl WHERE application_id = '" . $app_id . "'";
    $empQueryResult = mysqli_query($mycon, $empQuery);
    $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
    $applicationRow['empData'] = (array) $empRow;

    $empQuery = "SELECT * FROM employee_employment_info_tbl_check WHERE application_id = '" . $app_id . "'";
    $empQueryResult = mysqli_query($mycon, $empQuery);
    $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
    $applicationRow['empDataCheck'] = (array) $empRow;
    $applicationRow['empImages'] = getDocumentsByType($mycon, 'employer', $app_id);


    $vrifyQuery = "SELECT * FROM employee_police_verification WHERE application_id = '" . $app_id . "'";
    $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
    $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
    $applicationRow['vrificationData'] = (array) $vrifyRow;

    $vrifyQuery = "SELECT * FROM employee_police_verification_check WHERE application_id = '" . $app_id . "'";
    $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
    $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
    $applicationRow['vrificationDataCheck'] = (array) $vrifyRow;
    $applicationRow['policeImages'] = getDocumentsByType($mycon, 'police', $app_id);

    $referenceQuery = "SELECT * FROM employee_reference WHERE application_id = '" . $app_id . "'";
    $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
    $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
    $applicationRow['referenceData'] = (array) $referenceRow;

    $referenceQuery = "SELECT * FROM employee_reference_check WHERE application_id = '" . $app_id . "'";
    $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
    $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
    $applicationRow['referenceDataCheck'] = (array) $referenceRow;
    $applicationRow['referenceImages'] = getDocumentsByType($mycon, 'reference', $app_id);

    $bankQuery = "SELECT * FROM bank_statement_info WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['bankData'] = (array) $bankRow;

    $bankQueryCheck = "SELECT * FROM bank_statement_info_check WHERE application_id = '" . $app_id . "'";
    $bankQueryCheckResult = mysqli_query($mycon, $bankQueryCheck);
    $bankCheckRow = mysqli_fetch_alll($bankQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['bankDataCheck'] = (array) $bankCheckRow;
    $applicationRow['bankImages'] = getDocumentsByType($mycon, 'bank', $app_id);


    $bankQuery = "SELECT * FROM employee_cibil_info WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['cibilData'] = (array) $bankRow;

    $bankQueryCheck = "SELECT * FROM employee_cibil_info_check WHERE application_id = '" . $app_id . "'";
    $bankQueryCheckResult = mysqli_query($mycon, $bankQueryCheck);
    $bankCheckRow = mysqli_fetch_alll($bankQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['cibilDataCheck'] = (array) $bankCheckRow;
    $applicationRow['cibilImages'] = getDocumentsByType($mycon, 'cibil', $app_id);

    $courtQuery = "SELECT * FROM employee_court_record WHERE application_id = '" . $app_id . "'";
    $courtQueryResult = mysqli_query($mycon, $courtQuery);
    $courtRow = mysqli_fetch_alll($courtQueryResult, MYSQLI_ASSOC);
    $applicationRow['courtData'] = (array) $courtRow;

    $bankQuery = "SELECT * FROM employee_court_record_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['courtDataCheck'] = (array) $bankRow;
    $applicationRow['courtImages'] = getDocumentsByType($mycon, 'court', $app_id);


    $drugQuery = "SELECT * FROM employee_drug_test WHERE application_id = '" . $app_id . "'";
    $drugQueryResult = mysqli_query($mycon, $drugQuery);
    $drugRow = mysqli_fetch_alll($drugQueryResult, MYSQLI_ASSOC);
    $applicationRow['drugData'] = (array) $drugRow;


    $globalQuery = "SELECT * FROM employee_global_base_check WHERE application_id = '" . $app_id . "'";
    $globalQueryResult = mysqli_query($mycon, $globalQuery);
    $globalRow = mysqli_fetch_alll($globalQueryResult, MYSQLI_ASSOC);
    $applicationRow['globalBaseData'] = (array) $globalRow;


    $ssnQuery = "SELECT * FROM employee_socal_security_number WHERE application_id = '" . $app_id . "'";
    $ssnQueryResult = mysqli_query($mycon, $ssnQuery);
    $ssnRow = mysqli_fetch_alll($ssnQueryResult, MYSQLI_ASSOC);
    $applicationRow['ssnData'] = (array) $ssnRow;


    $criminalQuery = "SELECT * FROM employee_criminal_background WHERE application_id = '" . $app_id . "'";
    $criminalQueryResult = mysqli_query($mycon, $criminalQuery);
    $criminalRow = mysqli_fetch_alll($criminalQueryResult, MYSQLI_ASSOC);
    $applicationRow['criminalData'] = (array) $criminalRow;


    $gsQuery = "SELECT * FROM employee_global_sanctions WHERE application_id = '" . $app_id . "'";
    $gsQueryResult = mysqli_query($mycon, $gsQuery);
    $gsRow = mysqli_fetch_alll($gsQueryResult, MYSQLI_ASSOC);
    $applicationRow['gsData'] = (array) $gsRow;


    $nsrQuery = "SELECT * FROM employee_national_sex_registry WHERE application_id = '" . $app_id . "'";
    $nsrQueryResult = mysqli_query($mycon, $nsrQuery);
    $nsrRow = mysqli_fetch_alll($nsrQueryResult, MYSQLI_ASSOC);
    $applicationRow['nsrData'] = (array) $nsrRow;


    $compVerifQuery = "SELECT * FROM employee_company_verifaction WHERE application_id = '" . $app_id . "'";
    $compVerifQueryResult = mysqli_query($mycon, $compVerifQuery);
    $compVerifRow = mysqli_fetch_alll($compVerifQueryResult, MYSQLI_ASSOC);
    $applicationRow['compVerifData'] = (array) $compVerifRow;

    $identityQuery = "SELECT * FROM employee_identity_verif WHERE application_id = '" . $app_id . "'";
    $identityQueryResult = mysqli_query($mycon, $identityQuery);
    $identityRow = mysqli_fetch_alll($identityQueryResult, MYSQLI_ASSOC);
    $applicationRow['identityData'] = (array) $identityRow;

    $identityQueryCheck = "SELECT * FROM employee_identity_verif_tbl_check WHERE application_id = '" . $app_id . "'";
      $identityQueryCheckResult = mysqli_query($mycon, $identityQueryCheck);
      $identityCheckRow = mysqli_fetch_alll($identityQueryCheckResult, MYSQLI_ASSOC);
      $applicationRow['identityDataCheck'] = (array) $identityCheckRow;
      $applicationRow['identityDataImages'] = getDocumentsByType($mycon, 'identity', $app_id);


    $bankQuery = "SELECT * FROM drug_abuse_test_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['drugDataCheck'] = (array) $bankRow;
    $applicationRow['drugImages'] = getDocumentsByType($mycon, 'drug', $app_id);

//$result[] = $applicationRow;
  }

//pre($applicationRow);

  return $applicationRow;
}

function getAllApplicationInformation($mycon) {
  $appQuery = "SELECT * FROM tbl_application ";
  $applicationResult = mysqli_query($mycon, $appQuery);
  $result = [];
  $applicationRow = [];

  if (mysqli_num_rows($applicationResult) > 0) {
    while ($applicationRow = mysqli_fetch_array($applicationResult, MYSQLI_ASSOC)) {
//pre($applicationRow);
      $app_id = $applicationRow['application_ref_id'];
      $appQueryCheck = "SELECT * FROM tbl_application_check WHERE application_id = '" . $app_id . "'";
      $applicationResultCheck = mysqli_query($mycon, $appQueryCheck);
      $personalRowCheck = mysqli_fetch_alll($applicationResultCheck, MYSQLI_ASSOC);
      $applicationRow['ApplicationDataCheck'] = (array) $personalRowCheck;


//die;
      $personalQuery = "SELECT * FROM employee_personal_info_tbl WHERE application_id = '" . $app_id . "'";
      $personalQueryResult = mysqli_query($mycon, $personalQuery);
      $personalRow = mysqli_fetch_alll($personalQueryResult, MYSQLI_ASSOC);
      $applicationRow['personalData'] = (array) $personalRow;

      $personalQueryCheck = "SELECT * FROM employee_personal_info_tbl_check WHERE application_id = '" . $app_id . "'";
      $personalQueryCheckResult = mysqli_query($mycon, $personalQueryCheck);
      $personalCheckRow = mysqli_fetch_alll($personalQueryCheckResult, MYSQLI_ASSOC);
      $applicationRow['personalDataCheck'] = (array) $personalCheckRow;

      $addressQuery = "SELECT * FROM employee_address WHERE application_id = '" . $app_id . "'";
      $addressQueryResult = mysqli_query($mycon, $addressQuery);
      $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
      $applicationRow['addressData'] = (array) $addressRow;

      $addressQuery = "SELECT * FROM employee_address_check WHERE application_id = '" . $app_id . "'";
      $addressQueryResult = mysqli_query($mycon, $addressQuery);
      $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
      $applicationRow['addressDataCheck'] = (array) $addressRow;
      $applicationRow['addressImages'] = getDocumentsByType($mycon, 'address', $app_id);

      $eduQuery = "SELECT * FROM employee_education_tbl WHERE application_id = '" . $app_id . "'";
      $eduQueryResult = mysqli_query($mycon, $eduQuery);
      $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
      $applicationRow['eduData'] = (array) $eduRow;

      $eduQuery = "SELECT * FROM employee_education_tbl_check WHERE application_id = '" . $app_id . "'";
      $eduQueryResult = mysqli_query($mycon, $eduQuery);
      $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
      $applicationRow['eduDataCheck'] = (array) $eduRow;
      $applicationRow['eduImages'] = getDocumentsByType($mycon, 'education', $app_id);



      $empQuery = "SELECT * FROM employee_employment_info_tbl WHERE application_id = '" . $app_id . "'";
      $empQueryResult = mysqli_query($mycon, $empQuery);
      $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
      $applicationRow['empData'] = (array) $empRow;

      $empQuery = "SELECT * FROM employee_employment_info_tbl_check WHERE application_id = '" . $app_id . "'";
      $empQueryResult = mysqli_query($mycon, $empQuery);
      $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
      $applicationRow['empDataCheck'] = (array) $empRow;
      $applicationRow['empImages'] = getDocumentsByType($mycon, 'employer', $app_id);


      $vrifyQuery = "SELECT * FROM employee_police_verification WHERE application_id = '" . $app_id . "'";
      $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
      $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
      $applicationRow['vrificationData'] = (array) $vrifyRow;

      $vrifyQuery = "SELECT * FROM employee_police_verification_check WHERE application_id = '" . $app_id . "'";
      $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
      $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
      $applicationRow['vrificationDataCheck'] = (array) $vrifyRow;
      $applicationRow['policeImages'] = getDocumentsByType($mycon, 'police', $app_id);

      $referenceQuery = "SELECT * FROM employee_reference WHERE application_id = '" . $app_id . "'";
      $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
      $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
      $applicationRow['referenceData'] = (array) $referenceRow;

      $referenceQuery = "SELECT * FROM employee_reference_check WHERE application_id = '" . $app_id . "'";
      $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
      $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
      $applicationRow['referenceDataCheck'] = (array) $referenceRow;
      $applicationRow['referenceImages'] = getDocumentsByType($mycon, 'reference', $app_id);




      $bankQuery = "SELECT * FROM bank_statement_info WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['bankData'] = (array) $bankRow;

      $bankQuery = "SELECT * FROM bank_statement_info_check WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['bankDataCheck'] = (array) $bankRow;
      $applicationRow['bankImages'] = getDocumentsByType($mycon, 'bank', $app_id);

      $bankQuery = "SELECT * FROM employee_cibil_info WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['cibilData'] = (array) $bankRow;

      $bankQuery = "SELECT * FROM employee_cibil_check WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['cibilDataCheck'] = (array) $bankRow;
      $applicationRow['cibilImages'] = getDocumentsByType($mycon, 'cibil', $app_id);

      $bankQuery = "SELECT * FROM employee_court_record_check WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['courtDataCheck'] = (array) $bankRow;
      $applicationRow['courtImages'] = getDocumentsByType($mycon, 'court', $app_id);

      $bankQuery = "SELECT * FROM drug_abuse_test_check WHERE application_id = '" . $app_id . "'";
      $bankQueryResult = mysqli_query($mycon, $bankQuery);
      $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
      $applicationRow['drugDataCheck'] = (array) $bankRow;
      $applicationRow['drugImages'] = getDocumentsByType($mycon, 'drug', $app_id);


      $result[] = $applicationRow;
    }
  }
//pre($result);
  return $result;
}

function getAllAppInformationCheck($mycon, $app_id) {
  $appQuery = "SELECT * FROM tbl_application_check WHERE application_id = '" . $app_id . "'";
  // echo $appQuery; die;
  $applicationResult = mysqli_query($mycon, $appQuery);
  $applicationRow = [];
// pre($result1);
  if (mysqli_num_rows($applicationResult) > 0) {
    $applicationRow = mysqli_fetch_array($applicationResult, MYSQLI_ASSOC);

    $appQueryCheck = "SELECT * FROM tbl_application_check WHERE application_id = '" . $app_id . "'";
    $applicationResultCheck = mysqli_query($mycon, $appQueryCheck);
    $personalRowCheck = mysqli_fetch_alll($applicationResultCheck, MYSQLI_ASSOC);
    $applicationRow['ApplicationDataCheck'] = (array) $personalRowCheck;

// print_r($applicationRow);
// die;
    $personalQuery = "SELECT * FROM employee_personal_info_tbl WHERE application_id = '" . $app_id . "'";
    $personalQueryResult = mysqli_query($mycon, $personalQuery);
    $personalRow = mysqli_fetch_alll($personalQueryResult, MYSQLI_ASSOC);
    $applicationRow['personalData'] = (array) $personalRow;

    $personalQueryCheck = "SELECT * FROM employee_personal_info_tbl_check WHERE application_id = '" . $app_id . "'";
    $personalQueryCheckResult = mysqli_query($mycon, $personalQueryCheck);
    $personalCheckRow = mysqli_fetch_alll($personalQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['personalDataCheck'] = (array) $personalCheckRow;

    $addressQuery = "SELECT * FROM employee_address WHERE application_id = '" . $app_id . "'";
    $addressQueryResult = mysqli_query($mycon, $addressQuery);
    $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
    $applicationRow['addressData'] = (array) $addressRow;

    $addressQuery = "SELECT * FROM employee_address_check WHERE application_id = '" . $app_id . "'";
    $addressQueryResult = mysqli_query($mycon, $addressQuery);
    $addressRow = mysqli_fetch_alll($addressQueryResult, MYSQLI_ASSOC);
    $applicationRow['addressDataCheck'] = (array) $addressRow;
    $applicationRow['addressImages'] = getDocumentsByType($mycon, 'address', $app_id);

    $eduQuery = "SELECT * FROM employee_education_tbl WHERE application_id = '" . $app_id . "'";
    $eduQueryResult = mysqli_query($mycon, $eduQuery);
    $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
    $applicationRow['eduData'] = (array) $eduRow;

    $eduQuery = "SELECT * FROM employee_education_tbl_check WHERE application_id = '" . $app_id . "'";
    $eduQueryResult = mysqli_query($mycon, $eduQuery);
    $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
    $applicationRow['eduDataCheck'] = (array) $eduRow;
    $applicationRow['eduImages'] = getDocumentsByType($mycon, 'education', $app_id);



    $empQuery = "SELECT * FROM employee_employment_info_tbl WHERE application_id = '" . $app_id . "'";
    $empQueryResult = mysqli_query($mycon, $empQuery);
    $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
    $applicationRow['empData'] = (array) $empRow;

    $empQuery = "SELECT * FROM employee_employment_info_tbl_check WHERE application_id = '" . $app_id . "'";
    $empQueryResult = mysqli_query($mycon, $empQuery);
    $empRow = mysqli_fetch_alll($empQueryResult, MYSQLI_ASSOC);
    $applicationRow['empDataCheck'] = (array) $empRow;
    $applicationRow['empImages'] = getDocumentsByType($mycon, 'employer', $app_id);


    $vrifyQuery = "SELECT * FROM employee_police_verification WHERE application_id = '" . $app_id . "'";
    $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
    $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
    $applicationRow['vrificationData'] = (array) $vrifyRow;

    $vrifyQuery = "SELECT * FROM employee_police_verification_check WHERE application_id = '" . $app_id . "'";
    $vrifyQueryResult = mysqli_query($mycon, $vrifyQuery);
    $vrifyRow = mysqli_fetch_array($vrifyQueryResult, MYSQLI_ASSOC);
    $applicationRow['vrificationDataCheck'] = (array) $vrifyRow;
    $applicationRow['policeImages'] = getDocumentsByType($mycon, 'police', $app_id);

    $referenceQuery = "SELECT * FROM employee_reference WHERE application_id = '" . $app_id . "'";
    $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
    $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
    $applicationRow['referenceData'] = (array) $referenceRow;

    $referenceQuery = "SELECT * FROM employee_reference_check WHERE application_id = '" . $app_id . "'";
    $referenceQueryResult = mysqli_query($mycon, $referenceQuery);
    $referenceRow = mysqli_fetch_alll($referenceQueryResult, MYSQLI_ASSOC);
    $applicationRow['referenceDataCheck'] = (array) $referenceRow;
    $applicationRow['referenceImages'] = getDocumentsByType($mycon, 'reference', $app_id);


    $bankQuery = "SELECT * FROM bank_statement_info WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['bankData'] = (array) $bankRow;

    $bankQuery = "SELECT * FROM bank_statement_info_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['bankDataCheck'] = (array) $bankRow;
    $applicationRow['bankImages'] = getDocumentsByType($mycon, 'bank', $app_id);

    $bankQuery = "SELECT * FROM employee_cibil_info WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['cibilData'] = (array) $bankRow;

    $bankQuery = "SELECT * FROM employee_cibil_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['cibilDataCheck'] = (array) $bankRow;
    $applicationRow['cibilImages'] = getDocumentsByType($mycon, 'cibil', $app_id);

    $bankQuery = "SELECT * FROM employee_court_record_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['courtDataCheck'] = (array) $bankRow;
    $applicationRow['courtImages'] = getDocumentsByType($mycon, 'court', $app_id);

    $bankQuery = "SELECT * FROM drug_abuse_test_check WHERE application_id = '" . $app_id . "'";
    $bankQueryResult = mysqli_query($mycon, $bankQuery);
    $bankRow = mysqli_fetch_alll($bankQueryResult, MYSQLI_ASSOC);
    $applicationRow['drugDataCheck'] = (array) $bankRow;
    $applicationRow['drugImages'] = getDocumentsByType($mycon, 'drug', $app_id);

    $courtQuery = "SELECT * FROM employee_court_record WHERE application_id = '" . $app_id . "'";
    $courtQueryResult = mysqli_query($mycon, $courtQuery);
    $courtRow = mysqli_fetch_alll($courtQueryResult, MYSQLI_ASSOC);
    $applicationRow['courtData'] = (array) $courtRow;


    $courtQueryCheck = "SELECT * FROM employee_court_record_check WHERE application_id = '" . $app_id . "'";
    $courtQueryCheckResult = mysqli_query($mycon, $courtQueryCheck);
    $courtCheckRow = mysqli_fetch_alll($courtQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['courtDataCheck'] = (array) $courtCheckRow;


    // NEW FUNCTION FOR NEW TABLES  

    $drugQuery = "SELECT * FROM employee_drug_test WHERE application_id = '" . $app_id . "'";
    $drugQueryResult = mysqli_query($mycon, $drugQuery);
    $drugRow = mysqli_fetch_alll($drugQueryResult, MYSQLI_ASSOC);
    $applicationRow['drugData'] = (array) $drugRow;


    $drugQueryCheck = "SELECT * FROM drug_abuse_test_check WHERE application_id = '" . $app_id . "'";
    $drugQueryCheckResult = mysqli_query($mycon, $drugQueryCheck);
    $drugCheckRow = mysqli_fetch_alll($drugQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['drugDataCheck'] = (array) $drugCheckRow;



    $globalQuery = "SELECT * FROM employee_global_base_check WHERE application_id = '" . $app_id . "'";
    $globalQueryResult = mysqli_query($mycon, $globalQuery);
    $globalRow = mysqli_fetch_alll($globalQueryResult, MYSQLI_ASSOC);
    $applicationRow['globalBaseData'] = (array) $globalRow;

    
    $globalQueryCheck = "SELECT * FROM employee_global_base_check_tbl_check WHERE application_id = '" . $app_id . "'";
    $globalQueryCheckResult = mysqli_query($mycon, $globalQueryCheck);
    $globalCheckRow = mysqli_fetch_alll($globalQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['globalBaseDataCheck'] = (array) $globalCheckRow;



    $ssnQuery = "SELECT * FROM employee_socal_security_number WHERE application_id = '" . $app_id . "'";
    $ssnQueryResult = mysqli_query($mycon, $ssnQuery);
    $ssnRow = mysqli_fetch_alll($ssnQueryResult, MYSQLI_ASSOC);
    $applicationRow['ssnData'] = (array) $ssnRow;

        
    $ssnQueryCheck = "SELECT * FROM employee_socal_security_number_tbl_check WHERE application_id = '" . $app_id . "'";
    $ssnQueryCheckResult = mysqli_query($mycon, $ssnQueryCheck);
    $ssnCheckRow = mysqli_fetch_alll($ssnQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['ssnDataCheck'] = (array) $ssnCheckRow;



    $criminalQuery = "SELECT * FROM employee_criminal_background WHERE application_id = '" . $app_id . "'";
    $criminalQueryResult = mysqli_query($mycon, $criminalQuery);
    $criminalRow = mysqli_fetch_alll($criminalQueryResult, MYSQLI_ASSOC);
    $applicationRow['criminalData'] = (array) $criminalRow;

            
    $criminalQueryCheck = "SELECT * FROM employee_criminal_background_tbl_check WHERE application_id = '" . $app_id . "'";
    $criminalQueryCheckResult = mysqli_query($mycon, $criminalQueryCheck);
    $criminalCheckRow = mysqli_fetch_alll($criminalQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['criminalDataCheck'] = (array) $criminalCheckRow;



    $gsQuery = "SELECT * FROM employee_global_sanctions WHERE application_id = '" . $app_id . "'";
    $gsQueryResult = mysqli_query($mycon, $gsQuery);
    $gsRow = mysqli_fetch_alll($gsQueryResult, MYSQLI_ASSOC);
    $applicationRow['gsData'] = (array) $gsRow;


    $gsQueryCheck = "SELECT * FROM employee_global_sanctions_tbl_check WHERE application_id = '" . $app_id . "'";
    $gsQueryCheckResult = mysqli_query($mycon, $gsQueryCheck);
    $gsCheckRow = mysqli_fetch_alll($gsQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['gsDataCheck'] = (array) $gsCheckRow;




    $nsrQuery = "SELECT * FROM employee_national_sex_registry WHERE application_id = '" . $app_id . "'";
    $nsrQueryResult = mysqli_query($mycon, $nsrQuery);
    $nsrRow = mysqli_fetch_alll($nsrQueryResult, MYSQLI_ASSOC);
    $applicationRow['nsrData'] = (array) $nsrRow;

    $nsrQueryCheck = "SELECT * FROM employee_national_sex_registry_tbl_check WHERE application_id = '" . $app_id . "'";
    $nsrQueryCheckResult = mysqli_query($mycon, $nsrQueryCheck);
    $nsrCheckRow = mysqli_fetch_alll($nsrQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['nsrDataCheck'] = (array) $nsrCheckRow;


    $compVerifQuery = "SELECT * FROM employee_company_verifaction WHERE application_id = '" . $app_id . "'";
    $compVerifQueryResult = mysqli_query($mycon, $compVerifQuery);
    $compVerifRow = mysqli_fetch_alll($compVerifQueryResult, MYSQLI_ASSOC);
    $applicationRow['compVerifData'] = (array) $compVerifRow;

    
    $compVerifQueryCheck = "SELECT * FROM employee_company_verifaction_tbl_check WHERE application_id = '" . $app_id . "'";
    $compVerifQueryCheckResult = mysqli_query($mycon, $compVerifQueryCheck);
    $compVerifCheckRow = mysqli_fetch_alll($compVerifQueryCheckResult, MYSQLI_ASSOC);
    $applicationRow['compVerifDataCheck'] = (array) $compVerifCheckRow;


    $identityQuery = "SELECT * FROM employee_identity_verif WHERE application_id = '" . $app_id . "'";
    $identityQueryResult = mysqli_query($mycon, $identityQuery);
    $identityRow = mysqli_fetch_alll($identityQueryResult, MYSQLI_ASSOC);
    $applicationRow['identityData'] = (array) $identityRow;
    $applicationRow['identityDataImages'] = getDocumentsByType($mycon, 'identity', $app_id);

    $identityQueryCheck = "SELECT * FROM employee_identity_verif_tbl_check WHERE application_id = '" . $app_id . "'";
      $identityQueryCheckResult = mysqli_query($mycon, $identityQueryCheck);
      $identityCheckRow = mysqli_fetch_alll($identityQueryCheckResult, MYSQLI_ASSOC);
      $applicationRow['identityDataCheck'] = (array) $identityCheckRow;



    $drugQuery = "SELECT * FROM drug_abuse_test_check WHERE application_id = '" . $app_id . "'";
    $drugQueryResult = mysqli_query($mycon, $drugQuery);
    $drugRow = mysqli_fetch_alll($drugQueryResult, MYSQLI_ASSOC);
    $applicationRow['drugDataCheck'] = (array) $drugRow;
    $applicationRow['drugImages'] = getDocumentsByType($mycon, 'drug', $app_id);


    // END NEW FUNCTION FOR NEW TABLES  
    

//$result[] = $applicationRow;
  }
// pre($applicationRow);
  return $applicationRow;
}

function getCountries($mycon) {
  $countryQuery = "SELECT * FROM countries where country_id = '100' order by country_name ";
  $result = mysqli_query($mycon, $countryQuery);
  $dataRow = [];
  if (mysqli_num_rows($result) > 0) {
    $dataRow = mysqli_fetch_alll($result, MYSQLI_ASSOC);
  }
  return $dataRow;
}

function getStates($mycon, $country) {
  $where = "";
  if (!empty($country) && $country > 0) {
    $where = " AND country_id = " . $country;
  }
  $query = "SELECT * FROM states where 1 = 1 " . $where . " order by state_name";
  $result = mysqli_query($mycon, $query);
  $dataRow = [];
  if (mysqli_num_rows($result) > 0) {
    $dataRow = mysqli_fetch_alll($result, MYSQLI_ASSOC);
  }
  return $dataRow;
}

function getCities($mycon, $state) {
  $where = "";
  if (!empty($state) && $state > 0) {
    $where = " AND state_id = " . $state;
  }
  $query = "SELECT * FROM cities where 1 = 1 " . $where . " order by city_name";
  $result = mysqli_query($mycon, $query);
  $dataRow = [];
  if (mysqli_num_rows($result) > 0) {
    $dataRow = mysqli_fetch_alll($result, MYSQLI_ASSOC);
  }
  return $dataRow;
}

function getDepartments($mycon) {
  $where = "";

  $query = "SELECT * FROM department where 1 = 1 " . $where . " order by name";
  $result = mysqli_query($mycon, $query);
  $dataRow = [];
  if (mysqli_num_rows($result) > 0) {
    $dataRow = mysqli_fetch_alll($result, MYSQLI_ASSOC);
  }
  return $dataRow;
}

function getAllCustomers($mycon) {

  $query = "SELECT * FROM customer_master where customer_status = '1' order by customer_name";
  $result = mysqli_query($mycon, $query);
  $dataRow = [];
  if (mysqli_num_rows($result) > 0) {
    $dataRow = mysqli_fetch_alll($result, MYSQLI_ASSOC);
  }
  return $dataRow;
}

function getDocumentsByType($mycon, $type, $app_id) {
  $result = [];
  $docQuery = "SELECT *,CONCAT('" . baseUrl() . "images/application/', filename) AS imageUrl FROM document_upload WHERE application_id = '" . $app_id . "' AND  related_to LIKE '%" . $type . "%'";
//die;
// echo "</br>".$docQuery. "</br>"; 
  $eduQueryResult = mysqli_query($mycon, $docQuery);
  $eduRow = mysqli_fetch_alll($eduQueryResult, MYSQLI_ASSOC);
  foreach ($eduRow as $row) {
    $row['imageUrl'] = explode(',', trim($row['filename'], ','));
    //pre(explode(',', trim($row['filename'], ',')));
    $result[] = $row;
  }
  //pre($result);
  return $result;
}

function get_type_of_check_name_by_id($mycon,$typecheck_id){
  $query = "SELECT * FROM type_of_check where id = '" . $typecheck_id . "' AND status = '1' ";
  $result = mysqli_query($mycon, $query);
  if (mysqli_num_rows($result) > 0) {
    $rows= mysqli_fetch_assoc($result);
    return $rows['checkType'];
  }



}


function getTypeOfCheckName($mycon, $typeOfCheck) {
  // $checkRow = "<td> Application Details <br/> Personal Details <br> ";
  $checkRow = "<td> ";
  foreach ($typeOfCheck as $key => $value) {
    $query = "SELECT * FROM type_of_check where id = '" . $value . "' AND status = '1' ";
    $result = mysqli_query($mycon, $query);
    $dataRow = [];
    if (mysqli_num_rows($result) > 0) {
      $dataRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $checkRow .= $dataRow['checkType'] . "<br>";
    }
  }
  $checkRow .= " </td>";
  echo $checkRow;
}

function getTypeOfCheckName_excel($mycon, $typeOfCheck) {
  $checkRow = "";
  foreach ($typeOfCheck as $key => $value) {
    $query = "SELECT * FROM `type_of_check` where id = '" . $value . "' AND `status` = '1' ";
    // echo $query; die;
    $result = mysqli_query($mycon, $query);
    $dataRow = [];
    if (mysqli_num_rows($result) > 0) {
      $dataRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $checkRow .= $dataRow['checkType'] . ", ";
    }
  }
  $checkRow .= "";
  return $checkRow;
}


function getApplicationStatus($status, $mycon) {
  // echo $status;
  //die;
  // $cstatus = "";
  $app_status_desc="";
  $sql_query= "SELECT `descirption` FROM application_status WHERE application_status_no = '".$status."'";
  $result = mysqli_query($mycon, $sql_query );
  if(mysqli_num_rows($result) > 0 ){
    $rows= mysqli_fetch_assoc($result);
    $app_status_desc = $rows['descirption']; 
    // echo $status;
  }
  return $app_status_desc;


}


// function getApplicationStatus($status) {
//   // echo $status;
//   //die;
//   $cstatus = "";
//   if (!empty($status) && $status == '1') {
//     return $cstatus = "under review";
//   }
//   if (!empty($status) && $status == '2') {
//     return $cstatus = "under verification";
//   }
//   if (!empty($status) && $status == '3') {
//     return $cstatus = "verification complete";
//   }
//   if (!empty($status) && ($status == '4' || $status == '8')) {
//     return $cstatus = "wrong form data";
//   }
//   if (!empty($status) && $status == '5') {
//     return $cstatus = "generated verification <br> report";
//   }
//   if (!empty($status) && $status == '6') {
//     return $cstatus = "pending finance approval";
//   }
//   if (!empty($status) && $status == '7') {
//     return $cstatus = "instuff raised";
//   }
//   if (!empty($status) && $status == '8') {
//     return $cstatus = "Under Final QC-Verification Report";
//   }
//   if (!empty($status) && $status == '9') {
//     return $cstatus = "Issue in report";
//   }
//   if (!empty($status) && $status == '10') {
//     return $cstatus = "Generated Verification Report";
//   }
// }
