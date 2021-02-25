<div class="step-tab-panel" id="tab1">
  <h3 class="employer_one">Personal Details</h3>
  <form method="post" id="import_form" enctype="multipart/form-data">
    <input type="hidden" name="form_type" value="application">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="input_hdr" for="">HMDS ID</label>
          <input type="text" name="hmds_id" id="hmds_id" aria-describedby="" value="<?php echo "HMDS-" . time(); ?>" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="select">Client Name</label>
          <select class="form-control" name="client_name" id="client_name">
            <option>--Select--</option>
            <?php
            $sql_query = "SELECT customer_name, customer_code FROM `customer_master` WHERE customer_status = 1";
            $result = mysqli_query($mycon, $sql_query);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?php echo $row['customer_code'] ?>"><?php echo $row['customer_code'] . " - " . $row['customer_name']; ?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Client Location</label>
          <input type="text" name="client_location"  id="client_location" aria-describedby="" placeholder="Enter Client Location" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Case ID</label>
          <input type="text" name="case_id" id="case_id" aria-describedby="" placeholder="Enter Case ID" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="select">Type Of Check</label>
          <select name="type_of_check" multiple="multiple" id="type_of_check" class="form-control">
            <?php
            $sql_querycheck = "SELECT checkType FROM type_of_check WHERE status = 1";
            $resultcheck = mysqli_query($mycon, $sql_querycheck);
            if (mysqli_num_rows($resultcheck) > 0) {
              while ($rowcheck = mysqli_fetch_assoc($resultcheck)) {
                ?>
                <option value="<?php echo $rowcheck['id']; ?>"><?php echo $rowcheck['checkType']; ?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>

      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="input_hdr" for="">Application Id</label>
          <input type="text" name="application_id" id="application_id" aria-describedby="" value="<?php echo time(); ?>" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Case Rec. date</label>
          <input type="date" name="case_rec_date" id="case_rec_date" aria-describedby="" placeholder="dd-mm-yyyy" class="form-control" style="width: 220px;">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Client Relationship Person Name</label>
          <input type="text" name="relationship_person_name" id="relationship_person_name" aria-describedby="" placeholder="Enter Client Relationship Person Name" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Client Contact Number</label>
          <input type="number" name="client_contact_number" id="client_contact_number" aria-describedby="" placeholder="Enter Client Contact Number" class="form-control">
        </div>
        <div class="form-group">
          <label class="input_hdr" for="">Unique Id</label>
          <input type="text" name="unique_id" id="unique_id" aria-describedby="" placeholder="Enter Unique Id" class="form-control">
        </div>
      </div>

    </div>
    <br/><br/>
    <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <div ></div>
    </div>

                        <!--<p id="success_message"></p>-->
    <div class="row">
      <div class="col text-center">
        <button onclick="appSubmit()" type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
</div>