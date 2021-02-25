//********** Wizar start Js
$(document).ready(function () {
//  var frmInfo = $('#frmInfo');
//  var frmInfoValidator = frmInfo.validate();

//  var frmLogin = $('#frmLogin');
//  var frmLoginValidator = frmLogin.validate();
//
//  var frmMobile = $('#frmMobile');
//  var frmMobileValidator = frmMobile.validate();

  $('#demo').steps({
    onChange: function (currentIndex, newIndex, stepDirection) {
      // step2
//      if (currentIndex === 1) {
//        if (stepDirection === 'forward') {
//          return frmInfo.valid();
//        }
//        if (stepDirection === 'backward') {
//          frmInfoValidator.resetForm();
//        }
//      }
      // step4
//      if (currentIndex === 3) {
//        if (stepDirection === 'forward') {
//          return frmLogin.valid();
//        }
//        if (stepDirection === 'backward') {
//          frmLoginValidator.resetForm();
//        }
//      }
      // step5
//      if (currentIndex === 4) {
//        if (stepDirection === 'forward') {
//          return frmMobile.valid();
//        }
//        if (stepDirection === 'backward') {
//          frmMobileValidator.resetForm();
//        }
//      }
      return true;
    },
    onFinish: function () {
      alert('Wizard Completed');
    }
  });

})
//********** Wizar End Js end

// Upload File Images  Start Js

function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function (e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
  $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function () {
  $('.image-upload-wrap').removeClass('image-dropping');
});


// add more employemnt form
// $('.extra-fields-customer').click(function() {
//   $('.customer_records').clone().appendTo('.customer_records_dynamic');
//   $('.customer_records_dynamic .customer_records').addClass('single remove');
//   $('.single .extra-fields-customer').remove();
//   $('.single').append('<a href="#" class="remove-field btn-remove-customer" >Remove Fields <i class="fa fa-minus-circle" aria-hidden="true"></i></a>');
//   $('.customer_records_dynamic > .single').attr("class", "remove");

//   $('.customer_records_dynamic input').each(function() {
//     var count = 0;
//     var fieldname = $(this).attr("name");
//     $(this).attr('name', fieldname + count);
//     count++;
//   });

// });

// $(document).on('click', '.remove-field', function(e) {
//   $(this).parent('.remove').remove();
//   e.preventDefault();
// });

// add more employemnt form
