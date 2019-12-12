$(document).ready(function() {
  //VAlidar si el navegador es IE. Si lo es, direccionarlo a otra pagina
  if (navigator.userAgent.indexOf("Trident/") > -1) {
    window.location.href = 'https://www.google.com.mx/chrome/?brand=CHBF&ds_kid=43700034632748694&utm_source=bing&utm_medium=cpc&utm_campaign=1005992%20%7C%20Chrome%20Win10%20%7C%20DR%20%7C%20ESS01%20%7C%20NA%20%7C%20NA%20%7C%20es%20%7C%20Desk%20%7C%20BING%20SEM%20%7C%20BKWS%20~%20Top%20KWDS%20-%20Exact&utm_term=descargar%20chrome&utm_content=Download%20Chrome%20-%20Exact&gclid=CO70m6TT-eUCFUTCDQodmiwDRQ&gclsrc=ds'
  }
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

  ////Editar usueario
  $('#editUser').click(function() {
    $('#modalEditUser').fadeIn().css({
      "display": "flex"
    });
  });


  ////NUEVO ESTUDIANTE
  $('#newStudent').click(function() {

    let modal = $('#modalNewStudent');

    let closestModal = $(this).closest('.modal');


    closestModal.css({"z-index": "10"})

    modal.fadeIn().css({
      "display": "flex",
    });


  });


  ////Cerrar modales
  $('.btn-cancel').click(function() {
    $(this).closest('.modal,.modal-tittle').fadeOut();
    // $('.loading').fadeOut();
    $('.alert-container').fadeOut();
  });


  $('#btn-editStudent').click(function(){
    let modal = $(this).closest('.modal');
    let inputs = modal.find('select,input');

    modal.find('.btn-submitModal').fadeIn('500');
    inputs.attr('disabled', false);
  });









  //Tablas
  $(window).resize(function() {
    if (window.innerWidth <= 520) {
      $('table,.container-payment').css({
        "overflow-x": "scroll"
      });
    }else{
      $('table,.container-payment').css({
        "overflow-x": "hidden"
      });
    }
  });




});
