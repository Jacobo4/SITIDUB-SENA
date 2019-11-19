
$(document).ready(function() {
  //Fade in de la página Login al iniciar el navegador

  setTimeout(function() {
    $('section#login').fadeIn(1500).css({
      "display": "flex"
    });
  }, 500);
  //Inicializar las animaciones de la libreria WOW (animaciones)
  var wow = new WOW().init();

  // Hacer que los checkbox con estilos funcionen
  $('input[type="checkbox"]').click(function() {
    let customCheck = $(this).parent().find('div.custom-checkbox');
    $(this).prop('checked') ? customCheck.text('✔') : customCheck.text('');
  });

  // Efectos menu burguer
  $('div.icon-menu').click(function() {
    let menu = $('div.menu-container');
    if (menu.css('display') == "none") {
      menu.slideDown();
    } else {
      menu.slideUp();
    }
  });

  $('#acountbtn').click(function() {
    let acountContainer = $('.account-container');
    if (acountContainer.css('display') == "none") {
      acountContainer.slideDown();
    } else {
      acountContainer.slideUp();
    }
  });

  //Modales


  $('#btn-nuevo').click(function() {

    $('#modalNuevo').fadeIn().css({
      "display": "flex"
    });
  });


  $('.btn-cancel').click(function() {
    $(this).closest('.modal,.modal-tittle').fadeOut();
    // $('.loading').fadeOut();
    $('.alert-container').fadeOut();
  });

$('span.icon-bin').click(function(){
  $('#modalElminar').fadeIn().css({
    "display": "flex"
  });
})



  //Tablas
  $(window).resize(function() {
    if (window.innerWidth <= 520) {
      $('table').css({
        "overflow-x": "scroll"
      });
    }
  });


});
