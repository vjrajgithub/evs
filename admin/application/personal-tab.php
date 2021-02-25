<div class="step-tab-panel" id="tab2">
  <h3 class="employer_one">Personal Details</h3>
  <!--<form method="post" id="personalForm" enctype="multipart/form-data">-->
  <form method="post" id="frmInfo" enctype="multipart/form-data">
    <input type="hidden" name="form_type" value="personal">

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label input_hdr">First Name</label>
          <div>
            <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" data-required="1" class="form-control">
          </div>

        </div>
        <div class="form-group">
          <label class="control-label input_hdr">Last Name</label>
          <div><input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" data-required="1" class="form-control"></div>
        </div>
        <div class="form-group">
          <label class="control-label input_hdr">Phone Number</label>
          <div>
            <input type="number" name="phone" id="phone" placeholder="Enter Phone Number" data-required="1" class="form-control">
          </div>
        </div>
        <div class="form-group"><label class="control-label  input_hdr">Alternate Contact Number </label>
          <div>
            <input type="number" name="alternate_contact_no" id="alternate_contact_no"  data-required="1" placeholder="Enter Alternate Contact Number" class="form-control"></div>
        </div>
        <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Are you legally eligible for employment in the India?
            <span aria-required="true" class="required"> * </span></label>
          <label class="radio  input_hdr">
            <input type="radio" name="is_eligible" value="1" checked="checked"> <span>Yes</span></label>
          <label class="radio  input_hdr">
            <input type="radio" name="is_eligible" value="2"> <span>No</span></label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label input_hdr">Middle Name</label>
          <div>
            <input type="text" name="middlename" id="middlename" placeholder="Enter Middle Name" data-required="1" class="form-control">
          </div>

        </div>
        <div class="form-group">
          <label class="control-label input_hdr ">D.O.B
          </label>
          <div>
            <input type="date" name="dob" id="dob" aria-describedby="" placeholder="dd-mm-yyyy" class="form-control" style="width: 220px;">
          </div>
        </div>
        <div class="form-group"><label class="control-label input_hdr">Email Id </label> <div>
            <input type="email" name="email" id="email" placeholder="Enter Email Address" data-required="1" class="form-control">
          </div>
        </div>
        <div class="form-group eligibility_ind"><label class=" input_hdr check_box">Your Gender
            <span aria-required="true" class="required"> * </span></label> <br>
          <label class="radio  input_hdr"><input type="radio" name="gender" value="1" checked="checked"> <span>Male</span></label>
          <label class="radio  input_hdr"><input type="radio" name="gender" value="2"> <span>Female</span></label>
        </div>

        <div class="form-group">
          <label class="control-label input_hdr ">Passport Photo
          </label>
          <div>
            <input type="file" name="passport_photo" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;">
            <!--<input type="hidden" name="passport_photo" id="passport_photo" aria-describedby="" class="form-control" style="width: 220px;">-->
          </div>
        </div>

      </div>

      <!--  <div class="file-upload">

        <div class="image-upload-wrap">
          <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
          <div class="drag-text">
            <h3>Drag and drop a file or select add Image</h3>
          </div>
           </div>
            <div class="file-upload-content">
              <img class="file-upload-image" src="#" alt="your image">
              <div class="image-title-wrap">
                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
              </div>
            </div>
           </div>-->

    </div>

    <br/><br/>
    <div class="alert alert-success alert-dismissable" id="success_message" style="display :none">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <div ></div>
    </div>
    <div class="row">
      <div class="col text-center">
        <button onclick="personalSubmit()" type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
</div>