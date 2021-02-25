
$(document).ready(function () {
  //alert(baseURL);
  const Toast = Swal.mixin({

    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })



  var frmInfo = $('#import_form');
  var frmInfoValidator = frmInfo.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      hmds_id: {required: true},
      verification_mode: {required: true},
      client_name: {required: true},
      case_id: {required: true},
      crn: {required: true},
      application_id: {required: true, digits: true},
      case_rec_date: {required: true},
      client_location: {required: true},
      relationship_person_name: {required: true},
      client_contact_number: {required: true, digits: true, maxlength: 10, minlength: 10},
      unique_id: {required: true},

    },
    messages: {
      hmds_id: {required: "Please enter the HMDS id "},
      verification_mode: {required: "Please enter Select Verification Mode"},
      crn: {required: "Please Enter Client Reference Number"},

      client_name: {required: "Select Client"},
      case_id: {required: "Please enter the case id", },
      application_id: {required: "Please enter Application id", digits: "Please enter numbers only"},
      case_rec_date: {required: "Please select date"},
      client_location: {required: "Please enter the client location"},
      relationship_person_name: {required: "Please enter the relation"},
      client_contact_number: {required: "Please enter the contact number", digits: "Please enter numbers only"},
      unique_id: {required: "Please enter the unique Id"}

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      showloading();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(import_form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          console.log(data);
          
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          });
          
          
        }
      });
      //$form.submit();
      // $("#per_detail_link")[0].click();
      // $("#add_new_app")[0].click();
    }

  });

  var frmInfoo = $('#frmInfo');
  var frmInfooValidator = frmInfoo.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      firstname: {required: true},
      email: {required: true, email: true},
      lastname: {required: true},
      dob: {required: true},
      is_eligible: {required: true, digits: true, maxlength: 10, minlength: 10},
      gender: {required: true, digits: true},
      phone: {required: true, digits: true, maxlength: 10, minlength: 10},

    },
    messages: {
      firstname: {required: "Please enter the first name "},
      email: {required: "Please enter valid email id", email: "Please enter valid email address"},
      lastname: {required: "Please enter last name"},
      dob: {required: "Please select dob", },
      is_eligible: {required: "Please select one option"},
      gender: {required: "Please select one option"},
      phone: {required: "Please enter the contact number", digits: "Please enter numbers only"},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  // ========================newAjaxRequestForNewForms==================

  var frmInfo_identity_verif = $('#frmInfo_identity_verif');
  var frmInfo_identity_verifValidator = frmInfo_identity_verif.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      identity_doc_desc: {required: true},

    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      identity_doc_desc: {required: "Please Enter Document No."},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });



  var frmInfoo_court_rec = $('#frmInfo_court_rec');
  var frmInfoo_court_recValidator = frmInfoo_court_rec.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      doc_no: {required: true},

    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var frmInfoo_drug = $('#frmInfo_drug');
  var frmInfoo_drugValidator = frmInfoo_drug.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      doc_no: {required: true},

    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });



  var frmInfoo_gbc = $('#frmInfo_gbc');
  var frmInfoo_gbcValidator = frmInfoo_gbc.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      // doc_no: {required: true},
    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      // doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var frmInfoo_ssn = $('#frmInfo_ssn');
  var frmInfoo_ssnValidator = frmInfoo_ssn.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      ss_no: {required: true,  maxlength: 9},
      doc_no: {required: true},
    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      ss_no: {required: "Please enter a valid Social Security Number", maxlength: "please enter not more than 9"},
      doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var frmInfoo_criminal_back = $('#frmInfo_criminal_back');
  var frmInfoo_criminal_backValidator = frmInfoo_criminal_back.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      doc_no: {required: true},
    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var frmInfoo_global_sanctions = $('#frmInfo_global_sanctions');
  var frmInfoo_global_sanctionsValidator = frmInfoo_global_sanctions.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      doc_no: {required: true},
    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var frmInfoo_national_sex_registry = $('#frmInfo_national_sex_registry');
  var frmInfoo_national_sex_registryValidator = frmInfoo_national_sex_registry.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      verification_mode: {required: true},
      doc_no: {required: true},
    },
    messages: {
      
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });



  var frmInfoo_comp_verif = $('#frmInfo_comp_verif');
  var frmInfoo_comp_verifValidator = frmInfoo_comp_verif.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      company_name: {required: true},
      company_add: {required: true},
      phone: {required: true},
      contact_person_no: {required: true},
      email: {required: true, email: true},
      company_location: {required: true},
      verification_mode: {required: true},
      doc_no: {required: true},
    },
    messages: {
      company_name: {required: "Please enter  Company Name " },
      company_add: {required: "Please enter  Company Address "},
      phone: {required: "Please enter  Phone "},
      contact_person_no: {required: "Please enter  Contact Person No "},
      email: {required: "Please enter  Company Email ", email: "Please enter valid  Company Email"},
      company_location: {required: "Please enter  Company Location "},
      verification_mode: {required: "Please enter Select Verification Mode"},
      doc_no: {required: "Please Enter Document No."},
    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          // $('.next').click();
        }
      });
      //$form.submit();
    }

  });


  // ========================end newAjaxRequestForNewForms==================



  var bankInfo = $('#bankInfo');
  var bankInfoValidator = bankInfo.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      bank_name: {required: true},
      account_holder_name: {required: true},
      account_number: {required: true},
      branch_name: {required: true},

    },
    messages: {
      bank_name: {required: "Please Enter Bank name "},
      account_holder_name: {required: "Please Enter Account Holder Name"},
      account_number: {required: "Please Enter Account Number"},
      branch_name: {required: "Please Enter Branch Name", },

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });


  var cibilInfo = $('#cibilInfo');
  var cibilInfoValidator = cibilInfo.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      pancard_no: {required: true},
      // aadhar_no: {required: true},
      // mobile: {required: true},
      // email: {required: true},
      // occupation: {required: true},
      // monthly_income: {required: true},
      // annual_income: {required: true},
      // net_and_gross_income: {required: true},

    },
    messages: {
      pancard_no: {required: "Please Enter PAN Card Number"},
      // aadhar_no: {required: "Please Enter AAdhar Card Nubmer"},
      // mobile: {required: "Please Enter Mobile Number"},
      // email: {required: "Please Enter Email Address", },
      // occupation: {required: "Please Enter Your Occupation", },
      // monthly_income: {required: "Please Enter Your Monthaly Income", },
      // annual_income: {required: "Please Enter Annual Income", },
      // net_and_gross_income: {required: "Please Enter Net And Gross Income", },

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          // $('.next').click();
          // window.location.href = baseURL + 'application.php';
        }
      });
      //$form.submit();
    }

  });

  var customerAddInfo = $('#customer_add');
  var cibilInfoValidator = customerAddInfo.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      customer_name: {required: true},
      customer_code: {required: true},
      concerned_person: {required: true},
      phone_number: {required: true},
      office_no: {required: true},
      email: {required: true, email: true},
      region: {required: true},
      customer_group: {required: true},
      gst_reg_number: {required: true},
      country: {required: true},
      state: {required: true},
      city: {required: true},
      pincode: {required: true},
      address: {required: true},
      company_name: {required: true},

    },
    messages: {
      customer_name: {required: "Please Enter Customer Name"},
      customer_code: {required: "Please Enter Customer Code"},
      concerned_person: {required: "Please Enter Concerned Person"},
      phone_number: {required: "Please Enter Phone Number", },
      office_no: {required: "Please Enter Office Number", },
      email: {required: "Please Enter Email", email: "Please Enter a valid Email" },
      region: {required: "Please Enter Region", },
      customer_group: {required: "Please Enter Customer Group", },
      gst_reg_number: {required: "Please Enter GST Number", },
      country: {required: "Please Select Country", },
      state: {required: "Please Select State", },
      city: {required: "Please Select City", },
      pincode: {required: "Please Enter Picode", },
      address: {required: "Please Enter Address", },
      company_name: {required: "Please Enter Company Name", },

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          form.reset();
        }
      });
      //$form.submit();
    }

  });



  var addressForm = $('#address_form');
  var addressFormValidator = addressForm.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      address: {required: true},
      landmark: {required: true},
      country: {required: true},
      state: {required: true},
      city: {required: true},
      pincode: {required: true, digits: true},

    },
    messages: {
      address: {required: "Please enter the address "},
      landmark: {required: "Please enter landmark"},
      country: {required: "Please select Country"},
      state: {required: "Please select Satate", },
      city: {required: "Please select City"},
      pincode: {required: "Please enter the Pincode", digits: "Please enter numbers only"},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });
  var frmLogin = $('#frmLogin');
  var frmLoginValidator = frmLogin.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      high_school_school: {required: true},
      high_school_roll_number: {required: true, digits: true},
      high_school_passing_year: {required: true, digits: true},
      high_school_board: {required: true},

      intermediate_school: {required: true},
      intermediate_roll_no: {required: true, digits: true},
      intermediate_passing_year: {required: true, digits: true},
      intermediate_board: {required: true},

    },
    messages: {
      high_school_school: {required: "Please enter  School Name "},
      high_school_roll_number: {required: "Please enter Rolll Number", digits: "Please enter numbers only"},
      high_school_passing_year: {required: "Please Passing Year", digits: "Please enter numbers only"},
      high_school_board: {required: "Please enter Board/Univercity", },

      intermediate_school: {required: "Please enter  School Name "},
      intermediate_roll_no: {required: "Please enter Rolll Number", digits: "Please enter numbers only"},
      intermediate_passing_year: {required: "Please Passing Year", digits: "Please enter numbers only"},
      intermediate_board: {required: "Please enter Board/Univercity", },

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });

  var referenceform = $('#reference_form');
  var referenceformValidator = referenceform.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      name_pr1: {required: true},
      phone_pr1: {required: true, digits: true},
      city_pr1: {required: true, },
      country_pr1: {required: true},
      pincode_pr1: {required: true},
      email_pr1: {required: true, email: true},
      address_pr1: {required: true},
      relation_pr1: {required: true},
      state_pr1: {required: true},
      landmark_pr1: {required: true},

      name_pr2: {required: true},
      phone_pr2: {required: true, digits: true},
      city_pr2: {required: true, },
      country_pr2: {required: true},
      pincode_pr2: {required: true},
      email_pr2: {required: true, email: true},
      address_pr2: {required: true},
      relation_pr2: {required: true},
      state_pr2: {required: true},
      landmark_pr2: {required: true},

    },
    messages: {
      name_pr1: {required: "Please enter Name "},
      phone_pr1: {required: "Please enter phone Number", digits: "Please enter numbers only"},
      city_pr1: {required: "Please Select City"},
      pincode_pr1: {required: "Please enter Pin Code", },
      country_pr1: {required: "Please Select Country", },
      email_pr1: {required: "Please enter Email", email: "Please enter a valid Email" },
      address_pr1: {required: "Please enter Address", },
      relation_pr1: {required: "Please enter relation", },
      state_pr1: {required: "Please Select State", },
      landmark_pr1: {required: "Please enter Landmark", },

      name_pr2: {required: "Please enter Name "},
      phone_pr2: {required: "Please enter phone Number", digits: "Please enter numbers only"},
      city_pr2: {required: "Please Select City"},
      pincode_pr2: {required: "Please enter Pin Code", },
      country_pr2: {required: "Please Sekect Country", },
      email_pr2: {required: "Please enter Email", email: "Please enter a valid Email" },
      address_pr2: {required: "Please enter Address", },
      relation_pr2: {required: "Please enter relation", },
      state_pr2: {required: "Please Select State", },
      landmark_pr2: {required: "Please enter Landmark", },

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });


  var imployerform = $('#imployer_form');
  var imployerformValidator = imployerform.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      "employer_name[]": {required: true},
      "todt[]": {required: true},
      "telephone[]": {required: true},
      "position[]": {required: true},
      "department[]": {required: true},
      "fromdt[]": {required: true},
      "salary[]": {required: true},
      "reason_for_Leaving[]": {required: true},
      "empaddress[]": {required: true},
      "reporting_manager_name[]": {required: true},
      "reporting_manager_email_id[]": {required: true, email: true},
      "company_name[]": {required: true},

    },
    messages: {
      "employer_name[]": {required: "Please enter  Employer Name "},
      "todt[]": {required: "Please enter to Date "},
      "telephone[]": {required: "Please enter  telephone "},
      "position[]": {required: "Please enter  position "},
      "fromdt[]": {required: "Please enter  From Date "},
      "salary[]": {required: "Please enter  Salary "},
      "department[]": {required: "Please enter  depertment "},
      "reason_for_Leaving[]": {required: "Please enter  Reason for leaving "},
      "empaddress[]": {required: "Please enter  Employer Address "},
      "reporting_manager_name[]": {required: "Please enter  Manager Name "},
      "reporting_manager_email_id[]": {required: "Please enter  Manager Email ", email: "Please enter a valid Manager Email"},
      "company_name[]": {required: "Please enter  Company Name "},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });


  var frmMobileform = $('#frmMobile');
  var frmMobileformValidator = frmMobileform.validate({
    errorClass: "invalid",
    highlight: function (element) {
      $(element).addClass("c1");
    },
    unhighlight: function (element) {
      $(element).removeClass("c1");
    },
    rules: {
      "firstname_police": {required: true},
      "address_police": {required: true},
      "landmark_police": {required: true},
      "village_police": {required: true},
      "state_police": {required: true},
      "city_police": {required: true},
      "police_station": {required: true},
      "lastname_police": {required: true},
      "house_no_police": {required: true},
      "streetNo": {required: true},
      "area": {required: true},
      "postoffice": {required: true},
      "district_police": {required: true},
      "pincode_police": {required: true},
      "country_police": {required: true},

    },
    messages: {
      "firstname_police": {required: "Please enter Name "},
      "address_police": {required: "Please enter Address "},
      "landmark_police": {required: "Please enter  Landmarl "},
      "village_police": {required: "Please enter  Village "},
      "state_police": {required: "Please enter State "},
      "city_police": {required: "Please enter  City "},
      "police_station": {required: "Please enter Police Station "},
      "lastname_police": {required: "Please enter Last Name"},
      "house_no_police": {required: "Please enter House No "},
      "streetNo": {required: "Please enter Streat No"},
      "area": {required: "Please enter Area"},
      "postoffice": {required: "Please enter Post Office"},
      "district_police": {required: "Please enter District "},
      "pincode_police": {required: "Please enter Pin Code"},
      "country_police": {required: "Please enter  Country"},

    },
    submitHandler: function (form) {
      hitURL = baseURL + "ajax/application.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(form),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          hideloading();
          Toast.fire({
            icon: 'success',
            title: 'Data submitted successfully.'
          })

          $('.next').click();
        }
      });
      //$form.submit();
    }

  });




});
function showloading() {
  $.LoadingOverlay("show");
}

function hideloading() {
  $.LoadingOverlay("hide");
}




//function appSubmit() {
//  showloading();
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(import_form),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#success_message').show();
//      $('#success_message').html(data.msg);
//      setTimeout(function () {
//        $('#success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function personalSubmit() {
//// showloading();
////alert("jjjjjjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(frmInfo),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      // hideloading();
//      $('#personal_success_message').show();
//      $('#personal_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#personal_success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function addressSubmit() {
//  showloading();
//  //alert("jjjjjjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(address_form),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#address_success_message').show();
//      $('#address_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#address_success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function eduSubmit() {
//  showloading();
//  //alert("jjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(frmLogin),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#edu_success_message').show();
//      $('#edu_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#edu_success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function empSubmit() {
//  showloading();
//  //alert("jjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(imployer_form),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#emp_success_message').show();
//      $('#emp_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#emp_success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function verificationSubmit() {
//  showloading();
//  //alert("jjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(frmMobile),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#verification_success_message').show();
//      $('#verification_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#verification_success_message').fadeOut("slow");
//        $('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}
//function referenceSubmit() {
//  showloading();
//  //alert("jjjj");
//  hitURL = baseURL + "/ajax/application.php",
//          event.preventDefault();
//  $.ajax({
//    url: hitURL,
//    method: "POST",
//    data: new FormData(reference_form),
//    contentType: false,
//    dataType: 'JSON',
//    cache: false,
//    processData: false,
//    success: function (data) {
//      hideloading();
//      $('#reference_success_message').show();
//      $('#reference_success_message').html(data.msg);
//      setTimeout(function () {
//        $('#reference_success_message').fadeOut("slow");
//        //$('.next').click();
//      }, 2000);
//    }
//  })
//  return false;
//}

//function deleteApplication(applicationId) {
//
//  var confirmation = confirm("Are you sure to delete this user ?");
//  hitURL = baseURL + "ajax/application.php";
//  if (confirmation)
//  {
//    showloading();
//    hitURL = baseURL + "ajax/application.php";
//    //event.preventDefault();
//    $.ajax({
//      url: hitURL,
//      type: "POST",
//      dataType: "json",
//      //url: hitURL,
//      async: false,
//      data: {application_id: applicationId, action: "delete"},
//      success: function (data) {
//        hideloading();
//        $('#application_success_message').show();
//        $('#application_success_message').html(data.msg);
//        setTimeout(function () {
//          $('#application_success_message').fadeOut("slow");
//          $(this).parents('tr').remove();
//          //window.location.href = baseURL + "application.php";
//        }, 2000);
//      }
//    })
//  } else {
//    return false;
//  }
//}

function deleteApplication(applicationId) {
  //alert(currentrow);
  //$(".deleteapp").parents('tr').remove();
  // return false;
  var confirmation = confirm("Are you sure to delete this user ?");
  hitURL = baseURL + "ajax/application.php";
  if (confirmation)
  {
    //showloading();
    hitURL = baseURL + "ajax/application.php";
    //event.preventDefault();
    $.ajax({
      url: hitURL,
      type: "POST",
      dataType: "json",
      //url: hitURL,
      async: false,
      data: {application_id: applicationId, action: "delete"},
      success: function (data) {
        //hideloading();
        $('#application_success_message').show();
        $('#application_success_message').html(data.msg);
        setTimeout(function () {
          //$("." + applicationId).remove();
          $('#application_success_message').fadeOut("slow");
          window.location.href = baseURL + "application.php";
        }, 2000);
      }
    })
  } else {
    return false;
  }
}

function deleteCustomer(customerId) {

  var confirmation = confirm("Are you sure to delete this user ?");
  hitURL = baseURL + "ajax/application.php";
  if (confirmation)
  {
    showloading();
    hitURL = baseURL + "ajax/application.php";
    //event.preventDefault();
    $.ajax({
      url: hitURL,
      type: "POST",
      dataType: "json",
      //url: hitURL,
      async: false,
      data: {customer_id: customerId, action: "delete"},
      success: function (data) {
        hideloading();
        Toast.fire({
          icon: 'success',
          title: 'Data submitted successfully.'
        })
      }
    })
  } else {
    return false;
  }
}



