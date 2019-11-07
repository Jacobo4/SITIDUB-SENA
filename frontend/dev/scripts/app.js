$('form').submit(function(event) {
      event.preventDefault();
      var camposObliga = $(this).find('input,select').length;
      var botonSubmit = $(this).find('button[type="submit"]');
      console.log(camposObliga);
      // Desabilitar el boton submit
      if (camposObliga != null) {

        botonSubmit.attr('disabled', true);
        setTimeout(function() {
          botonSubmit.attr('disabled', false);
        }, 2000);
      }



      var cumple = 0;
      //Arreglo donde almacenará cada campo
      //expresiones Regulares
      const regExpEmail = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
      const regExpNumber = /^\d+$/;

      ////Validar los campos
      $(this).find('input,select').each(function(i, e) {

        var valorInput = $(e).val();
        var valorCheckbox = $(e).prop('checked');
        var valorSelect = $(e).val();
        var labelCheckBox = $(e).parent().find('label');


        if ($(e).length !== 0) {
          switch ($(e).attr('type')) {
            case "text":
              if (valorInput !== "") {
                pintarStilos($(e), 'valido', true);
              } else {
                pintarStilos($(e), 'error', true);
              }
              break;

            case "number":
              if ((regExpNumber.test($(e).prop('value'))) & (validarLength(valorInput.length, 5, 10))) {
                pintarStilos($(e), 'valido', true);
              } else {
                pintarStilos($(e), 'error', true);
              }
              break;

            case "emailCustom":
              if (regExpEmail.test($(e).prop('value'))) {
                pintarStilos($(e), 'valido', true);
              } else {
                pintarStilos($(e), 'error', true);
              }
              break;

            case "checkbox":
              if (valorCheckbox !== false) {
                pintarStilos(labelCheckBox, 'valido', false);
              } else {
                pintarStilos(labelCheckBox, 'error', false);
              }
              break;

            case "select":
              if (valorSelect != 1) {
                pintarStilos($(e), 'valido', true);

              } else {
                pintarStilos($(e), 'error', true);

              }
              break;

            

          }
        }

      });
    });

    //////////// Pinta estilos de error y valido
    function pintarStilos(elem, tipo) {
       var contenedor = elem.parent();
       //Iconos


       if (tipo === 'error') {
          elem.addClass('error');
          elem.removeClass('correcto');
          cumple = 0;

       } else if (tipo === 'valido') {

          elem.addClass('correcto');
          elem.removeClass('error');
          cumple++;

       }

    }
    // function showAlert(cumple,timeIn,timeOut){
    //
    //    const iconAlertCheck = '<p class="icon-AlertAlertWrong"><span>Ha habido un error, recarga la página y vuelve a intentarlo</span></p>';
    //    const iconAlertWrong = '<div class="icon-AlertAlertCheck"><div class="path1"></div><div class="path2"><span>Tu mensaje ha sido enviado con exito</span></div></div>';
    //    const divAlert = 'div.alertForm-container';
    //
    //    $(divAlert).find('div.alertForm-content').empty();
    //
    //    if(cumple){
    //       $(divAlert).find('div.alertForm-content').removeClass('alertError');
    //       $(divAlert).find('div.alertForm-content').addClass('alertCheck');
    //       $(divAlert).find('div.alertForm-content').append(iconAlertWrong);
    //    }else{
    //       $(divAlert).find('div.alertForm-content').removeClass('alertCheck');
    //       $(divAlert).find('div.alertForm-content').addClass('alertError');
    //       $(divAlert).find('div.alertForm-content').append(iconAlertCheck);
    //    }
    //    $(divAlert).fadeIn(timeIn,"linear",function(){
    //       setTimeout(function(){
    //          $(divAlert).fadeOut().animate({'bottom': '0%'}, {duration: 'slow', queue: false});
    //       }, timeOut);
    //    }).animate({'bottom': '10%'}, {duration: 'slow', queue: false});
    //
    // }
    //

    // //////////// Valida longitud
    // function validarLength(valor, minLength, maxLength) {
    //    if ((valor >= minLength) & (valor <= maxLength)) {
    //       return true;
    //    } else {
    //       return false;
    //    }
    // }
    // //////////// Valida Formulario
    // function validarForm(camposObliga, form) {
    //
    //
    //
    //
    //    });
    //
    //
    //
    //    if (cumple === camposObliga) {
    //       alert('Bien pelado :D')
    //       showAlert(false,500,10000)
    //       return false;
    //
    //    } else {
    //       return false;
    //    }
    //
    //
    //
    // }


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
