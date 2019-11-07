$(document).ready(function() {
  $('section#login').hide();
  setTimeout(function() {
    $('section#login').fadeIn(2000);
  }, 500);

  var wow = new WOW().init();

  $('input[type="checkbox"]').click(function() {


    $(this).prop('checked') ? $(this).parent().toggleClass('checked') : $(this).parent().toggleClass('checked');
    console.log($(this).prop('checked'));
    console.log($(this).parent().before());
  });

});
