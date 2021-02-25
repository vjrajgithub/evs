
$(document).ready(function () {


});
function showloading() {
  //$.LoadingOverlay("show");
}

function hideloading() {
  //$.LoadingOverlay("hide");
}

function appCheckSubmit() {
  //alert("hjhjjh");
  showloading();
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(import_form),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#success_message').show();
      $('#success_message').html(data.msg);
      setTimeout(function () {
        $('#success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}

function personalCheckSubmit() {
// showloading();
//alert("jjjjjjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(frmInfo),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      // hideloading();
      $('#personal_success_message').show();
      $('#personal_success_message').html(data.msg);
      setTimeout(function () {
        $('#personal_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}


function addressCheckSubmit() {
  showloading();
  //alert("jjjjjjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(address_form),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#address_success_message').show();
      $('#address_success_message').html(data.msg);
      setTimeout(function () {
        $('#address_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}
function eduCheckSubmit() {
  showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(frmLogin),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#edu_success_message').show();
      $('#edu_success_message').html(data.msg);
      setTimeout(function () {
        $('#edu_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}
function empCheckSubmit() {
  showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(imployer_form),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#emp_success_message').show();
      $('#emp_success_message').html(data.msg);
      setTimeout(function () {
        $('#emp_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}
function verificationCheckSubmit() {
  showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(frmMobile),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#verification_success_message').show();
      $('#verification_success_message').html(data.msg);
      setTimeout(function () {
        $('#verification_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}

function bankCheckSubmit() {
  //showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(formBank),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#verification_success_message').show();
      $('#verification_success_message').html(data.msg);
      setTimeout(function () {
        $('#verification_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}

function cibilCheckSubmit() {
  //showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(formcibil),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#verification_success_message').show();
      $('#verification_success_message').html(data.msg);
      setTimeout(function () {
        $('#verification_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}
function drugCheckSubmit() {
  //showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(formdrug),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#verification_success_message').show();
      $('#verification_success_message').html(data.msg);
      setTimeout(function () {
        $('#verification_success_message').fadeOut("slow");
        //$('.next').click();
      }, 2000);
      window.location.href = baseURL + 'verification-check.php';
    }
  })
  return false;
}

function cortCheckSubmit() {
  //showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(formcort),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#verification_success_message').show();
      $('#verification_success_message').html(data.msg);
      setTimeout(function () {
        $('#verification_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}
function referenceCheckSubmit() {
  showloading();
  //alert("jjjj");
  hitURL = baseURL + "ajax/application-check.php",
          event.preventDefault();
  $.ajax({
    url: hitURL,
    method: "POST",
    data: new FormData(reference_form),
    contentType: false,
    dataType: 'JSON',
    cache: false,
    processData: false,
    success: function (data) {
      hideloading();
      $('#reference_success_message').show();
      $('#reference_success_message').html(data.msg);
      setTimeout(function () {
        $('#reference_success_message').fadeOut("slow");
        $('.next').click();
      }, 2000);
    }
  })
  return false;
}


function court_verifCheckSubmit() {
  // showloading();
  //alert("jjjjjjjj");
    hitURL = baseURL + "ajax/application-check.php",
            event.preventDefault();
    $.ajax({
      url: hitURL,
      method: "POST",
      data: new FormData(frmInfo_court),
      contentType: false,
      dataType: 'JSON',
      cache: false,
      processData: false,
      success: function (data) {
        // hideloading();
        $('#court_verif_success_message').show();
        $('#court_verif_success_message').html(data.msg);
        setTimeout(function () {
          $('#court_verif_success_message').fadeOut("slow");
           $('.next').click();
        }, 2000);
      }
    })
    return false;
  }
  

function drug_verifCheckSubmit() {
  // showloading();
  //alert("jjjjjjjj");
    hitURL = baseURL + "ajax/application-check.php",
            event.preventDefault();
    $.ajax({
      url: hitURL,
      method: "POST",
      data: new FormData(frmInfo_drug),
      contentType: false,
      dataType: 'JSON',
      cache: false,
      processData: false,
      success: function (data) {
        // hideloading();
        $('#drug_verif_success_message').show();
        $('#drug_verif_success_message').html(data.msg);
        setTimeout(function () {
          $('#drug_verif_success_message').fadeOut("slow");
           $('.next').click();
        }, 2000);
      }
    })
    return false;
  }
  

function gcbCheckSubmit() {
  // showloading();
  //alert("jjjjjjjj");
    hitURL = baseURL + "ajax/application-check.php",
            event.preventDefault();
    $.ajax({
      url: hitURL,
      method: "POST",
      data: new FormData(frmInfo_gcb),
      contentType: false,
      dataType: 'JSON',
      cache: false,
      processData: false,
      success: function (data) {
        // hideloading();
        $('#gcb_success_message').show();
        $('#gcb_success_message').html(data.msg);
        setTimeout(function () {
          $('#gcb_success_message').fadeOut("slow");
           $('.next').click();
        }, 2000);
      }
    })
    return false;
  }
  

 
function ssnCheckSubmit() {
  // showloading();
  //alert("jjjjjjjj");
    hitURL = baseURL + "ajax/application-check.php",
            event.preventDefault();
    $.ajax({
      url: hitURL,
      method: "POST",
      data: new FormData(frmInfo_ssn),
      contentType: false,
      dataType: 'JSON',
      cache: false,
      processData: false,
      success: function (data) {
        // hideloading();
        $('#ssn_success_message').show();
        $('#ssn_success_message').html(data.msg);
        setTimeout(function () {
          $('#ssn_success_message').fadeOut("slow");
           $('.next').click();
        }, 2000);
      }
    })
    return false;
  }
 
 
  function criminalCheckSubmit() {
    // showloading();
    //alert("jjjjjjjj");
      hitURL = baseURL + "ajax/application-check.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(frmInfo_criminal),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          // hideloading();
          $('#criminal_success_message').show();
          $('#criminal_success_message').html(data.msg);
          setTimeout(function () {
            $('#criminal_success_message').fadeOut("slow");
            $('.next').click();
          }, 2000);
        }
      })
      return false;
    }
     
 
  function gsCheckSubmit() {
    // showloading();
    //alert("jjjjjjjj");
      hitURL = baseURL + "ajax/application-check.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(frmInfo_gs),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          // hideloading();
          $('#gs_success_message').show();
          $('#gs_success_message').html(data.msg);
          setTimeout(function () {
            $('#gs_success_message').fadeOut("slow");
            $('.next').click();
          }, 2000);
        }
      })
      return false;
    }
     
    
  function nsrCheckSubmit() {
    // showloading();
    //alert("jjjjjjjj");
      hitURL = baseURL + "ajax/application-check.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(frmInfo_nsr),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          // hideloading();
          $('#nsr_success_message').show();
          $('#nsr_success_message').html(data.msg);
          setTimeout(function () {
            $('#nsr_success_message').fadeOut("slow");
            $('.next').click();
          }, 2000);
        }
      })
      return false;
    }
     


    
// function nsrCheckSubmit() {
//     // showloading();
//     //alert("jjjjjjjj");
//       hitURL = baseURL + "ajax/application-check.php",
//               event.preventDefault();
//       $.ajax({
//         url: hitURL,
//         method: "POST",
//         data: new FormData(frmInfo_nsr),
//         contentType: false,
//         dataType: 'JSON',
//         cache: false,
//         processData: false,
//         success: function (data) {
//           // hideloading();
//           $('#nsr_success_message').show();
//           $('#nsr_success_message').html(data.msg);
//           setTimeout(function () {
//             $('#nsr_success_message').fadeOut("slow");
//             // $('.next').click();
//           }, 2000);
//         }
//       })
//       return false;
// }
     

    
function comp_verifCheckSubmit() {
    // showloading();
    //alert("jjjjjjjj");
      hitURL = baseURL + "ajax/application-check.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(frmInfo_comp_verif),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          // hideloading();
          $('#comp_verif_success_message').show();
          $('#comp_verif_success_message').html(data.msg);
          setTimeout(function () {
            $('#comp_verif_success_message').fadeOut("slow");
            // $('.next').click();
          }, 2000);
        }
      })
      return false;
}
     
    
function identity_verifCheckSubmit() {
    // showloading();
    //alert("jjjjjjjj");
      hitURL = baseURL + "ajax/application-check.php",
              event.preventDefault();
      $.ajax({
        url: hitURL,
        method: "POST",
        data: new FormData(frmInfo_identity),
        contentType: false,
        dataType: 'JSON',
        cache: false,
        processData: false,
        success: function (data) {
          // hideloading();
          $('#identity_verif_success_message').show();
          $('#identity_verif_success_message').html(data.msg);
          setTimeout(function () {
            $('#identity_verif_success_message').fadeOut("slow");
            $('.next').click();
          }, 2000);
        }
      })
      return false;
}
     

function deleteApplicationCheck(applicationId) {

  var confirmation = confirm("Are you sure to delete this user ?");
  hitURL = baseURL + "ajax/application-check.php";
  if (confirmation)
  {
    showloading();
    hitURL = baseURL + "ajax/application-check.php";
    //event.preventDefault();
    $.ajax({
      url: hitURL,
      type: "POST",
      dataType: "json",
      //url: hitURL,
      async: false,
      data: {application_id: applicationId, action: "delete"},
      success: function (data) {
        hideloading();
        $('#application_success_message').show();
        $('#application_success_message').html(data.msg);
        setTimeout(function () {
          $('#application_success_message').fadeOut("slow");
          window.location.href = baseURL + "verification-check.php";
        }, 2000);
      }
    })
  } else {
    return false;
  }
}