$(document).ready(function() {
  $('section#login').hide();
  setTimeout(function(){
      $('section#login').fadeIn(2000);
  }, 500);

var wow = new WOW().init();

$('input[type="checkbox"]').click(function () {


  $(this).prop('checked') ? $(this).parent().text('a') : $(this).parent().text('b');
  console.log($(this));
});
