$('.wrapper').on('click', '.remove', function() {
  $('.remove').closest('.wrapper').find('.element').not(':first').last().remove();
});
$('.wrapper').on('click', '.clone', function() {
  $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results');
});