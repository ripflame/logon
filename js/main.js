$(document).ready(function() {
  $('input[type=password]').keyup(function() {
    var pswd = $(this).val();
    if ( pswd.length < 8 ) {
      $('#length').removeClass('valid').addClass('invalid');
    } else {
      $('#length').removeClass('invalid').addClass('valid');
    }
    //validate letter
    if ( pswd.match(/[A-Za-z]/) ) {
      $('#letter').removeClass('invalid').addClass('valid');
    } else {
      $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $('#capital').removeClass('invalid').addClass('valid');
    } else {
      $('#capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if ( pswd.match(/\d/) ) {
      $('#number').removeClass('invalid').addClass('valid');
    } else {
      $('#number').removeClass('valid').addClass('invalid');
    }
  }).focus(function() {
    $('#pswd_info').show();
    console.log( $(this).attr('id') );
    if ($(this).attr('id') == 'password') {
      $('#pswd_info').css('top', '230px');
    } else {
      $('#pswd_info').css('top', '270px');
    }
  }).blur(function() {
    $('#pswd_info').hide();
  });
});
