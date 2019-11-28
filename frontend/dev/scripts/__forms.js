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

//////////// Muestra alerta de los formularios
function showAlert(cumple, timeIn, timeOut) {

  const divAlert = $('div.alert-container');
  const contentAlert = 'div.alert-content';

  divAlert.find('div.alert-content').empty();
  divAlert.removeClass();
  divAlert.addClass('alert-container');
  if (cumple === 1) {

    divAlert.addClass('alert-check').find(contentAlert).text('Nice !');

  } else if (cumple === 2) {

    divAlert.addClass('alert-error').find(contentAlert).text('Hmm, something went wrong');
  } else if (cumple === 3) {
    divAlert.addClass('alert-server').find(contentAlert).text('Maybe the server is down :(');
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

function validateForm(form) {

  event.preventDefault();
  let inputs = $(form).find('input,select');
  let camposObliga = $(form).find('input:visible,select:visible').length;
  let botonSubmit = $(form).find('button[type="submit"]');

  //Variable para comprar los inputs que estan bien con la cantidad de inputs del formulario
  let total = 0;
  //expresiones Regulares
  const regExpEmail = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  const regExpNumber = /^\d+$/;




  ////Validar los campos
  $(form).find('input,select').each(function(i, e) {


    let valorInput = $(e).val();
    let valorCheckbox = $(e).prop('checked');
    let valorSelect = $(e).val();
    let customDivCheck = $(e).parent().find('div.custom-checkbox');


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

        case "identification":
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
    return true;
  } else {
    return false;
  }

}
// NOTE: CONFIG CONSULTAS
$.ajaxSetup({
  url: 'procesar.php',
  type: 'POST',
  async: true,
  error: function(response) {
    console.log('response', response);
    showAlert(3, 1000, 3000);
  }
});

//// NOTE: BUSCADOR

var peticion;
$('#searchAll').keypress(function() {
  clearTimeout(peticion);
  peticion = setTimeout(function() {
    let data = $(this).serialize();

    $.post("procesar.php", data, function(response) {

      var jsonData = JSON.parse(response);
      if (jsonData.success == "1") {

        showAlert(1, 1000, 3000);


      } else {
        showAlert(2, 1000, 3000);
      }
    });


  }, 1000);

});



// NOTE: CONSULTA LOGIN
$('form#login').submit(function(event) {
  event.preventDefault();

  var formulario = $(this);
  var data = formulario.serialize();
  console.log(data);

  $.post("login.php?log=true", data, function(response) {

    var jsonData = JSON.parse(response);
    if (jsonData.success == "1") {

      showAlert(1, 1000, 3000);
      location.href = 'home.php';

    } else {
      showAlert(2, 1000, 3000);
    }
  });

});

// NOTE: LOG OUT
$('#logOut').click(function() {
  $.post("login.php?log=false", function(response) {
    var jsonData = JSON.parse(response);
    if (jsonData.success == "1") {
      location.href = 'index.php';
    } else {
      showAlert(2, 1000, 3000);
    }
  });
});




// NOTE: CONSULTA EDIT
$('form.edit').submit(function(event) {
  sendForm(this, false);
});

// NOTE: CONSULTA EDITAR USERNAME
$('form#editUsername').submit(function(event) {
  sendForm(this, false);
});

// NOTE: CONSULTA EDITAR PASSWORD
$('form#editPassword').submit(function(event) {
  sendForm(this, false);
});

// NOTE: CONSULTA NUEVO ESTUDIANTE
$('form#estudiante').submit(function(event) {
  sendForm(this);
}); // NOTE: CONSULTA NUEVO RESPONSABLE
$('form#responsable').submit(function(event) {
  sendForm(this);
});
// NOTE: CONSULTA ELIMINAR
$('form#delete').submit(function(event) {
  sendForm(this);
});
// NOTE: CONSULTA NUEVA MATRICULA
$('form#matricula').submit(function(event) {
  sendForm(this);
});

function sendForm(form, closeModal = true) {

  let idForm = $(form).attr('id');
  let inputs = $(form).find('input,select');

  if (validateForm(form)) {

    var data = 'idForm=' + idForm + '&' + $(form).serialize();
    console.log(data);

    $.ajax({
      data: data,
      beforeSend: function() {
        $(form).parent().find('.loading').show();
      },
      success: function(response) {
        $(form).parent().find('.loading').fadeOut(1000);
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {

          if (closeModal) {
            $(form).closest('.modal').fadeOut();
          }
          inputs.val('').removeClass('correcto');
          showAlert(1, 1000, 3000);

        } else {
          showAlert(2, 1000, 3000);
        }
      },
    });
  }
}




$.getJSON('assets/json/citys.json', function(data) {
  // var jsonData = JSON.parse(data);
  var options = [];
  let select = $('select.citys');

  for (var i = 0; i < data.length; i++) {
    for (var z = 0; z < data[i].ciudades.length; z++) {
      options.push("<option value='" + data[i].ciudades[z] + "'>" + data[i].departamento + '-' + data[i].ciudades[z] + "</option>");
    }
  }
  for (var i = 0; i < options.length; i++) {
    select.append(options[i]);
  }

});

$.getJSON('assets/json/bloodTypes.json', function(data) {

  var options = [];
  let select = $('select.bloodTypes');

  $.each(data, function(key) {
    options.push("<option value='" + key + "'>" + key + "</option>");
  })

  for (var i = 0; i < options.length; i++) {
    select.append(options[i]);
  }

});
