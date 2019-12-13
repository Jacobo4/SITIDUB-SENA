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
function showAlert(type, timeIn, timeOut, message) {

  const divAlert = $('div.alert-container');
  const contentAlert = 'div.alert-content';

  divAlert.find('div.alert-content').empty();
  divAlert.removeClass();
  divAlert.addClass('alert-container');

  if (type === "nice") {
    divAlert.addClass('alert-check').find(contentAlert).text('Nice !');

  } else if (type === "error") {
    divAlert.addClass('alert-error').find(contentAlert).text('Hmm, something went wrong');

  } else if (type === "serverDown") {
    divAlert.addClass('alert-server').find(contentAlert).text('Maybe the server is down :(');

  } else if (type === "entryDuplicate") {
    divAlert.addClass('alert-duplicate').find(contentAlert).text(message);

  } else if (type === "dontExists") {
    divAlert.addClass('alert-dontExists').find(contentAlert).text("We couldn't find it :(");
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
function validateLength(valor, minLength, maxLength) {
  if ((valor >= minLength) & (valor <= maxLength)) {
    return true;
  } else {
    return false;
  }
}

//////////// remove class corecto on formularios
function emptyClass(form) {

  let selects = $(form).find('select');
  let inputs = $(form).find('input');


  selects.val('default').removeClass('correcto');
  inputs.val('').removeClass('correcto');

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
          if ((regExpNumber.test($(e).prop('value'))) & (validateLength(valorInput.length, 5, 14))) {
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
          valorSelect != "default" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;
        case "year":
          if ((regExpNumber.test($(e).prop('value'))) & (validateLength(valorInput.length, 4, 5))) {
            pintarStilos($(e), 'valido');
          } else {
            pintarStilos($(e), 'error');
          }
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
  url: 'services/process.php',
  type: 'POST',
  async: true,
  error: function(response) {
    // console.log('response', response);
    showAlert("serverDown", 1000, 3000);
  }
});
// NOTE: LOG OUT
$('#logOut').click(function() {
  $.post("services/login.php?log=false", function(response) {
    var jsonData = JSON.parse(response);
    if (jsonData.success == "Cool") {
      location.href = 'index.php';
    } else {
      showAlert("error", 1000, 3000);
    }
  });
});

// NOTE: CONSULTA LOGIN
$('form#login').submit(function(event) {
  event.preventDefault();

  let formulario = $(this);
  let data = formulario.serialize();
  console.log(data);

  formulario.parent().find('.loading').show();

  $.post("services/login.php?log=true", data, function(response) {
    formulario.parent().find('.loading').hide();
    let jsonData = JSON.parse(response);
    if (jsonData.success == "Cool") {

      showAlert("nice", 1000, 3000);
      location.href = 'home.php';

    } else {
      showAlert("error", 1000, 3000);
    }
  });

});


//// NOTE: BUSCADOR

var peticion;
var buttonSearch = $('#searchAll');


buttonSearch.keypress(function() {
  let buttonValue = buttonSearch.val();

  if (buttonValue.length > 0) {
    searchStudent(buttonSearch);
  }
});
$('span.icon-search').click(function() {
  let buttonValue = buttonSearch.val();
  if (buttonValue.length > 0) {

    searchStudent(buttonSearch);
  }
});

function searchStudent(button) {


  let value = button.val();
  let input = button;


  clearTimeout(peticion);
  peticion = setTimeout(function() {
    let data = 'typeForm=searchStudent&' + input.serialize();

    console.log(data);
    $.post("services/process.php", data, function(response) {
      // console.log(response);
      var students = JSON.parse(response);

      if (students.success == "Error") {
        showAlert("error", 1000, 3000);
      } else if (students.success == "Don't exists") {
        showAlert("dontExists", 1000, 3000);
      } else {

        $('table#students').fadeIn(500);
        showStudents(students);
      }
    });

  }, 1000);

}

function showStudents(students) {
  let rol = students.slice(-1)[0].rol;
  let roleOptions = null;


  switch (rol) {
    case 'Administrador':
      roleOptions = `<span class="icon-eye"></span><span class="icon-coin-dollar"></span><span class="icon-plus"></span><span class="icon-bin"></span>`;
      break;
    case 'Coordinador':
      roleOptions = `<span class="icon-eye"></span>`;
      break;
    case 'Tesorero':
      roleOptions = `<span class="icon-eye"></span><span class="icon-coin-dollar"></span>`;
      break;
    default:

  }

  // NOTE: Delete the last element of the array cuz it's the rol
  students.pop(-1);

  $('#showStudents').empty();
  $.each(students.slice(0), function(id, student) {



    $('#showStudents').append(
      `
      <tr>
        <td data-student="${changeNullValue(student.id)}">${id+1}</td>
        <td>${changeNullValue(student.descripcion_tdoc)}</td>
        <td data-ndoc="${changeNullValue(student.ndoc)}">${changeNullValue(student.ndoc)}</td>
        <td>${changeNullValue(student.nombre1)} ${changeNullValue(student.nombre2)}</td>
        <td>${changeNullValue(student.apellido1)} ${changeNullValue(student.apellido2)}</td>
        <td class="table-options">${roleOptions}</td>
      </tr>
      `
    );

  });

  optionsStudents();

}

function changeNullValue(string) {
  return string === "NULL" ? "" : string;
}

function optionsStudents() {


  $('span.icon-coin-dollar').click(function() {

    let modalPayments = $('#modalPayments');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');



    modalPayments.fadeIn().css({
      "display": "flex"
    });


    $('div.month span.icon-IconArrowPurple').click(function() {


      let purpleArrow = $(this);
      let paymentContainer = purpleArrow.closest('li').find('div.container-payment');
      let month = purpleArrow.parent().attr('data-month');
      let year = purpleArrow.closest('.modal').find('#searchPayments').val();
      let data = `typeForm=searhPayments&idStudent=${idStudent}&year=${year}&month=${month}`;
      console.log(data);

      $.post("services/process.php", data, function(response) {

        var payments = JSON.parse(response);
        console.table(payments);

        if (payments.success == "Error") {
          showAlert("error", 1000, 3000);
        } else if (payments.success == "Don't exists") {
          showAlert("dontExists", 1000, 3000);
        } else {

          showPayments(payments, paymentContainer);
          paymentContainer.slideToggle();
        }
      });

      function showPayments(payments, paymentContainer) {
        let row = $(paymentContainer).find('tbody.showPayments')
        $(row).empty();
        $.each(payments, function(index, payment) {

          $(row).append(
            `
            <tr>
              <td>${index+1}</td>
              <td>${payment.consecutivo}</td>
              <td>${payment.fecha_pago}</td>
              <td>${payment.periodo_inicial}</td>
              <td>${payment.periodo_final}</td>
              <td>${payment.valor_cancelado}</td>
              <td class="table-options"><span class="icon-bin"></span></td>
            </tr>
            `
          );

        });

      }


    });
    $('div.month span.icon-plus').click(function() {
      let plusButton = $(this);
      let month = plusButton.parent().attr('data-month');
      let year = plusButton.closest('.modal').find('#searchPayments').val();




      let data = `typeForm=getMonth&idStudent=${idStudent}&year=${year}&month=${month}`;
      console.log(data);


      $.post("services/process.php", data, function(response) {

        var cuota = JSON.parse(response);
        console.log(cuota[0].id);


        if (cuota.success == "Error") {
          showAlert("error", 1000, 3000);
        } else {
          plusButton.closest('li').find('div.month').attr('data-cuota', cuota[0].id);
          plusButton.closest('li').find('.container-addPayment').slideToggle();
        }
      });

      var locki = false;

      $('form.addPayment').submit(function(event) {


        let form = this;
        let typeForm = $(form).attr('class');
        let cuota = $(form).closest('li').find('div.month').attr('data-cuota');

        if (!locki) {
          if (validateForm(this)) {

            let data = `typeForm=${typeForm}&cuota=${cuota}&${$(form).serialize()}`;

            console.log(data);
            $.ajax({
              data: data,
              beforeSend: function() {
                $(form).parent().find('.loading').show();
              },
              success: function(response) {
                locki = true;

                $(form).parent().find('.loading').fadeOut(1000);
                var jsonData = JSON.parse(response);

                if (jsonData.success == "Cool") {

                  emptyClass(form);
                  showAlert("nice", 1000, 3000);

                } else if (jsonData.success == "Error") {
                  showAlert("error", 1000, 3000);

                } else if (jsonData.success == "Entry duplicate") {

                  showAlert("entryDuplicate", 1000, 3000, 'This relative already exists');
                }
              },
            });
          }
        }


      });

    });

  });


  ////Eliminar ESTUDIANTE

  $('span.icon-bin').click(function() {

    let modalDelete = $('#modalDelete');
    let inputModal = modalDelete.find('input');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');
    let numDocStudent = $(this).closest('tr').find('td[data-ndoc]').attr('data-ndoc');;

    inputModal.attr('data-student', idStudent);

    modalDelete.fadeIn().css({
      "display": "flex"
    });

    // NOTE: CONSULTA ELIMINAR
    $('form#deleteStudent').submit(function(event) {
      event.preventDefault();
      let form = this;
      let modal = $(this).closest('.modal');
      let typeForm = $(this).attr('id');
      let input = $(this).find('input');
      let trStudent = $('#showStudents').find(`td[data-student="${idStudent}"]`).closest('tr');


      if (input.val() !== numDocStudent) {
        pintarStilos($(input), 'error');
      } else {

        pintarStilos($(input), 'valido');

        let data = `typeForm=${typeForm}&idStudent=${idStudent}&${$(form).serialize()}`;

        console.log(data);
        $.ajax({
          data: data,
          beforeSend: function() {
            $(form).parent().find('.loading').show();
          },
          success: function(response) {

            $(form).parent().find('.loading').fadeOut(1000);
            var jsonData = JSON.parse(response);

            if (jsonData.success == "Cool") {
              // console.log(trStudent);

              trStudent.remove();
              modal.fadeOut();
              emptyClass(form);
              showAlert("nice", 1000, 3000);
            } else if (jsonData.success == "Error") {
              showAlert("error", 1000, 3000);
            }
          },
        });

      }


    });

  });

  ////Mostrar INFO / EDITAR
  $('span.icon-eye').click(function() {

    let modalShow = $('#modalEditShow');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');

    let data = `typeForm=showStudentInfo&idStudent=${idStudent}`;

    // console.log('lo que envio ', data);
    $.post("services/process.php", data, function(response) {
      // console.log('response student', response);
      var studentInfo = JSON.parse(response);

      if (studentInfo.success == "Error") {
        showAlert("error", 1000, 3000);
      } else if (studentInfo.success == "Don't exists") {
        showAlert("dontExists", 1000, 3000);
      } else {
        showStudentInfo(studentInfo, modalShow);
      }
    });



  });

  function showStudentInfo(studentInfo, modalShow) {

    // console.table(studentInfo[0]);

    let inputs = modalShow.find('select,input');
    let saveButtons = modalShow.find('.btn-submitModal');

    var studentInputs = {
      tittle: $('#personName'),
      names: $('#editNombresEstu'),
      surnames: $('#editApellidosEstu'),
      numIdent: $('#editNumIdentEstu'),
      tdoc: $('#editTipoIdentEstu'),
      expeditionPlace: $('#editLugarExpe'),
      birthdate: $('#editFechaNaci'),
      birthplace: $('#editLugarNaci'),
      address: $('#editDireccionEstu'),
      email: $('#editEmailEstu'),
      tel1: $('#editTelResiEstu'),
      eps: $('#editEps'),
      rh: $('#editRh'),
      income: $('#editEstrato')
    }
    modalShow.fadeIn().css({
      "display": "flex"
    });
    inputs.attr('disabled', true);
    saveButtons.hide();
    studentInputs.tittle.attr(`data-student`, studentInfo[0].id);
    studentInputs.tittle.text(`${changeNullValue(studentInfo[0].nombre1)} ${changeNullValue(studentInfo[0].nombre2)} ${changeNullValue(studentInfo[0].apellido1)} ${changeNullValue(studentInfo[0].apellido2)}`);
    studentInputs.names.val(`${changeNullValue(studentInfo[0].nombre1)} ${changeNullValue(studentInfo[0].nombre2)}`);
    studentInputs.surnames.val(`${changeNullValue(studentInfo[0].apellido1)} ${changeNullValue(studentInfo[0].apellido2)}`);
    studentInputs.numIdent.val(`${changeNullValue(studentInfo[0].ndoc)}`);
    studentInputs.tdoc.val(`${changeNullValue(studentInfo[0].tdoc_persona)}`);
    studentInputs.expeditionPlace.val(`${changeNullValue(studentInfo[0].lugar_expedicion)}`);
    studentInputs.birthdate.val(`${changeNullValue(studentInfo[0].fecha_nacimiento)}`);
    studentInputs.birthplace.val(`${changeNullValue(studentInfo[0].lugar_nacimiento)}`);
    studentInputs.address.val(`${changeNullValue(studentInfo[0].direccion)}`);
    studentInputs.email.val(`${changeNullValue(studentInfo[0].email)}`);
    studentInputs.tel1.val(`${changeNullValue(studentInfo[0].tel1)}`);
    studentInputs.eps.val(`${changeNullValue(studentInfo[0].eps)}`);
    studentInputs.rh.val(`${changeNullValue(studentInfo[0].rh)}`);
    studentInputs.income.val(`${changeNullValue(studentInfo[0].estrato)}`);

  }


  ////NUEVA MATRICULA
  $('#showStudents span.icon-plus').click(function() {

    let modalMatri = $('#modalMatricula');
    let inputModal = modalMatri.find('input#numMatri');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');
    let nameStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');

    modalMatri.fadeIn().css({
      "display": "flex"
    });

    modalMatri.find('h1').text('juan');


    // NOTE: CONSULTA NUEVA MATRICULA
    $('form#insertMatricula').submit(function(event) {
      event.preventDefault();
      let form = this;
      let modal = $(this).closest('.modal');
      let typeForm = $(this).attr('id');


      if (validateForm(this)) {
        let data = `typeForm=${typeForm}&idStudent=${idStudent}&${$(form).serialize()}`;

        console.log(data);
        $.ajax({
          data: data,
          beforeSend: function() {
            $(form).parent().find('.loading').show();
          },
          success: function(response) {
            $(form).parent().find('.loading').fadeOut(1000);
            var jsonData = JSON.parse(response);
            if (jsonData.success == "Cool") {
              modal.fadeOut();
              emptyClass(form);
              showAlert("nice", 1000, 3000);
            } else if (jsonData.success == "Error") {
              showAlert("error", 1000, 3000);
            } else if (jsonData.success == "Entry duplicate") {
              showAlert("entryDuplicate", 1000, 3000, 'This student already exists');
            }

          },
        });
      }
    });

  });
}



// NOTE: CONSULTA EDIT
$('form.edit').submit(function(event) {
  let form = this;
  let modal = $(form).closest('.modal');
  let typeForm = $(form).attr('id');
  let idStudent = $('#personName').attr('data-student');
  let inputs = $(form).find('input');
  let selects = $(form).find('select');
  var data = $(form).serialize();


  if (validateForm(form)) {

    let data = `typeForm=${typeForm}&idStudent=${idStudent}&${$(form).serialize()}`;

    console.log(data);
    $.ajax({
      data: data,
      beforeSend: function() {
        $(form).parent().find('.loading').show();
      },
      success: function(response) {
        $(form).parent().find('.loading').fadeOut(1000);
        var jsonData = JSON.parse(response);
        if (jsonData.success == "Cool") {
          modal.fadeOut();
          emptyClass(form);
          searchStudent(buttonSearch);
          showAlert("nice", 1000, 3000);


        } else if (jsonData.success == "Error") {
          showAlert("error", 1000, 3000);

        }
      },
    });
  }
});

// NOTE: CONSULTA EDITAR USERNAME
$('form#editUsername').submit(function(event) {
  insertPerson(this, false);
});

// NOTE: CONSULTA EDITAR PASSWORD
$('form#editPassword').submit(function(event) {
  insertPerson(this, false);
});

// NOTE: CONSULTA NUEVO ESTUDIANTE
$('form#insertStudent').submit(function(event) {

  insertPerson(this);
});

// NOTE: CONSULTA NUEVO RESPONSABLE
$('#addRelative').click(function() {

  let modal = $('#modalNewRelative');
  let closestModal = $(this).closest('.modal');
  let idStudent = closestModal.find('#personName').attr('data-student');


  closestModal.css({
    "z-index": "10"
  })

  modal.fadeIn().css({
    "display": "flex",
  });

  var lock = false;
  $('form#insertRelative').submit(function(event) {
    let form = $(this);
    let typeForm = form.attr('id');
    let button = form.find('button[type="submit"]');


    if (validateForm(form)) {
      if (!lock) {
        let data = `typeForm=${typeForm}&idStudent=${idStudent}&${form.serialize()}`;
        console.log(data);

        $.ajax({
          data: data,
          beforeSend: function() {
            form.parent().find('.loading').show();

          },
          success: function(response) {
            lock = true;
            form.parent().find('.loading').fadeOut(1000);
            var jsonData = JSON.parse(response);

            if (jsonData.success == "Cool") {



              form.closest('.modal').fadeOut();

              emptyClass(form);
              showAlert("nice", 1000, 3000);

            } else if (jsonData.success == "Error") {
              showAlert("error", 1000, 3000);

            } else if (jsonData.success == "Entry duplicate") {

              showAlert("entryDuplicate", 1000, 3000, 'This relative already exists');
            }
          },
        });
      }

    }
  });



});




function insertPerson(form, closeModal = true) {

  let typeForm = $(form).attr('id');


  if (validateForm(form)) {

    var data = `typeForm=${typeForm}&${$(form).serialize()}`;
    console.log(data);

    $.ajax({
      data: data,
      beforeSend: function() {
        $(form).parent().find('.loading').show();
      },
      success: function(response) {
        $(form).parent().find('.loading').fadeOut(1000);
        var jsonData = JSON.parse(response);
        if (jsonData.success == "Cool") {

          if (closeModal) {
            $(form).closest('.modal').fadeOut();
          }
          emptyClass(form);
          showAlert("nice", 1000, 3000);

        } else if (jsonData.success == "Error") {
          showAlert("error", 1000, 3000);

        } else if (jsonData.success == "Entry duplicate") {

          showAlert("entryDuplicate", 1000, 3000, 'This student already exists');
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

$.getJSON('assets/json/eps.json', function(data) {

  var options = [];
  let select = $('select.epss');

  $.each(data, function(key, eps) {

    options.push("<option value='" + eps.name + "'>" + eps.name + "</option>");
  })

  for (var i = 0; i < options.length; i++) {
    select.append(options[i]);
  }

});

$.getJSON('assets/json/grades.json', function(data) {

  var options = [];
  let select = $('select.grades');

  $.each(data, function(key, eps) {

    options.push("<option value='" + eps.name + "'>" + eps.name + "</option>");
  })

  for (var i = 0; i < options.length; i++) {
    select.append(options[i]);
  }

});
