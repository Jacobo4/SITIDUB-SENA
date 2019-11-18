$('form').submit(function(event) {
  event.preventDefault();

  var camposObliga = $(this).find('input,select').length;
  var botonSubmit = $(this).find('button[type="submit"]');

  // Desabilitar el boton submit
  if (camposObliga != null) {
    botonSubmit.attr('disabled', true);
    setTimeout(function() {
      botonSubmit.attr('disabled', false);
    }, 3000);
  }


  var total = 0;
  //Arreglo donde almacenará cada campo
  //expresiones Regulares
  const regExpEmail = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  const regExpNumber = /^\d+$/;

  ////Validar los campos
  $(this).find('input,select').each(function(i, e) {

    var id = $(e).attr('id')
    //Poner el id en el name para mandar los datos por serialize
    $(e).attr('name', id);

    var valorInput = $(e).val();
    var valorCheckbox = $(e).prop('checked');
    var valorSelect = $(e).val();
    var customDivCheck = $(e).parent().find('div.custom-checkbox');


    if ($(e).length !== 0) {
      switch ($(e).attr('type')) {

        case "text":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "password":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "date":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "number":
          if ((regExpNumber.test($(e).prop('value'))) & (validarLength(valorInput.length, 10, 10))) {
            pintarStilos($(e), 'valido');
          } else {
            pintarStilos($(e), 'error');
          }
          break;

        case "emailCustom":
          regExpEmail.test($(e).prop('value')) ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "checkbox":
          valorCheckbox !== false ? pintarStilos(customDivCheck, 'valido') : pintarStilos(customDivCheck, 'error');
          break;

        case "select":
          valorSelect != 1 ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;
      }
      total = total + cumple;
    }

  });




  if (total === camposObliga) {

    submitAjax($(this));
    showAlert(true, 500, 3000);
    return true;

  } else {
    showAlert(false, 500, 3000);
    return false;
  }

});

function submitAjax(form) {

  var estudiante = form.serialize();
  console.log('lo que envio' + estudiante);

  $.ajax({
    type: 'POST',
    url: 'procesar.php',
    data: estudiante,
    beforeSend: function() {

    },
    success: function(response) {
      var jsonData = JSON.parse(response);
      if (jsonData.success == "1") {
        alert('insert correcto')
      } else {
        alert('Invalid Credentials!');
      }
    },
    error: function() {
      console.log('ha ocurrido un error');
    }


  });
}

//////////// Pinta estilos de error y valido
function pintarStilos(elem, tipo) {

  if (tipo === 'error') {
    elem.addClass('error');
    elem.removeClass('correcto');
    cumple = 0;

  } else if (tipo === 'valido') {
    elem.addClass('correcto');
    elem.removeClass('error');
    cumple = 1;
  }

}

function showAlert(cumple, timeIn, timeOut) {

  const divAlert = $('div.alert-container');
  const contentAlert = 'div.alert-content';

  divAlert.find('div.alert-content').empty();


  if (cumple) {
    divAlert.removeClass('alert-error');
    divAlert.addClass('alert-check').find(contentAlert).text('Nice !');
  } else {
    divAlert.removeClass('alert-check');
    divAlert.addClass('alert-error').find(contentAlert).text('Hmm, something went wrong');
  }

  divAlert.fadeIn(timeIn, "linear", function() {
    setTimeout(function() {
      divAlert.fadeOut().animate({
        'bottom': '0%'
      }, {
        duration: 'slow',
        queue: false
      });
    }, timeOut);
  }).animate({
    'bottom': '20vh'
  }, {
    duration: 'slow',
    queue: false
  });

}




//////////// Valida longitud
function validarLength(valor, minLength, maxLength) {
  if ((valor >= minLength) & (valor <= maxLength)) {
    return true;
  } else {
    return false;
  }
}


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

  $('#modalNuevo').fadeIn().css({
    "display": "flex"
  });

  $('#btn-nuevo').click(function() {
    $('#modalNuevo').fadeIn().css({
      "display": "flex"
    });
  });


  $('.btn-cerrarModal').click(function() {
    $(this).closest('.modal').fadeOut();
    $('.alert-container').fadeOut();


  });



  //Tablas
  $(window).resize(function() {
    if (window.innerWidth <= 520) {
      $('table').css({
        "overflow-x": "scroll"
      });
    }
  });


});
