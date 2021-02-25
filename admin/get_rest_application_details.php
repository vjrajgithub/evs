<?php
require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
    header('location: ../index.php');
}

$application_id = $_GET['application_id'];


if($application_id != ""){


  
    $sql_query_validation = "SELECT ca.*, ca.id as case_allocation_id, ca.application_id as allocated_application_id,ca.user_id as allocated_user_id, ca.created_at as allocated_case_rec_date, ta.*,ta.client_name as client_code,ta.client_relationship_person_name as application_name,ta.case_id as case_id, ep.*, CONCAT(ep.firstName,ep.middleName, ep.lastName) as applicant_full_name  FROM case_allocate ca, tbl_application ta , employee_personal_info_tbl ep WHERE ca.application_id=ta.application_ref_id AND ta.application_ref_id = ep.application_id  order by ca.user_id";
    $allocate_data['firstName'] . ' ' . $allocate_data['middleName'] . ' ' . $allocate_data['lastName']; 
    
    // $sql_query_validation = "SELECT ta.case_record_date, ta.client_name, ta.case_id, ta.client_relationship_person_name FROM tbl_application ta, case_allocate ca  WHERE ca.application_id=ta.application_ref_id  AND ta.application_ref_id = '" . $application_id . "'";

    // echo $sql_query_validation; 
                $result = mysqli_query($mycon, $sql_query_validation);
                 if (mysqli_num_rows($result) > 0){
                     $res = mysqli_fetch_array($result);
                     $data = $res;
echo json_encode($data);
exit; 
            //  echo $res['case_record_date'];
?>
<!-- 

<div class="row">
            <div id="prother_app_details">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label"> Case Rec. date
                  </label>
                  <div>
                    <input type="Date" id="case_rec_date" name="case_rec_date" data-required="1" value="<?php $res['case_record_date']; ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label"> Client Code
                  </label>
                  <div>
                    <input type="text" id="client_code" name="client_code" value="<?php $res['client_name']; ?>" data-required="1" class="form-control">
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label"> Case Id
                  </label>
                  <div>
                    <input type="text" id="case_id" name="case_id" data-required="1" value="<?php $res['case_id']; ?>"  class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label"> Applicant name
                  </label>
                  <div>
                    <input type="text" id="client_code" name="client_code"  value="<?php $res['client_relationship_person_name']; ?>" data-required="1" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
 -->

          <?php
          
        }
    }
    
    ?>