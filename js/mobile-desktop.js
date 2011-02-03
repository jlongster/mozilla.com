// FIXME : Need jquery on every locale/firefox/mobile/index.html

$(document).ready(function () {
  
  var phone = $('#phone');
  console.log(phone);
  if (phone.val() == phone.attr('value')) {
    phone.attr('disabled', true);
  }
  
  $('#prefix').change(function(e) {
    var code = $(this).val();
    if (code != "") {
      phone.val(code + " ");
      phone.focus();
      phone.attr('disabled', false);
    } else {
      phone.val(phone.attr('value'));
      phone.attr('disabled', true);
    }
  })
})
