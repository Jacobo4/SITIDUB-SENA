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

  if (cumple === "nice") {
    divAlert.addClass('alert-check').find(contentAlert).text('Nice !');

  } else if (cumple === "error") {
    divAlert.addClass('alert-error').find(contentAlert).text('Hmm, something went wrong');

  } else if (cumple === "serverDown") {
    divAlert.addClass('alert-server').find(contentAlert).text('Maybe the server is down :(');

  } else if (cumple === "entryDuplicate") {
    divAlert.addClass('alert-duplicate').find(contentAlert).text('This user already exists');

  } else if (cumple === "dontExists") {
    divAlert.addClass('alert-dontExists').find(contentAlert).text("This user don't exists");
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
function emptyClass(form){

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
          if ((regExpNumber.test($(e).prop('value'))) & (validateLength(valorInput.length, 5, 10))) {
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
    console.log('response', response);
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
    let data = 'idForm=searchStudent&' + input.serialize();

    console.log(data);
    $.post("services/process.php", data, function(response) {
      // console.log(response);
      var students = JSON.parse(response);

      if (students.success == "Error") {
        showAlert("error", 1000, 3000);
      } else if (students.success == "Don't exists") {
        showAlert("dontExists", 1000, 3000);
      } else {


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
    default:

  }

  // NOTE: Delete the last element of the array cuz it's the rol
  students.pop(-1);

  $('#showStudents').empty();
  $.each(students.slice(0), function(id, student) {


    $.each(student, function(campo, value) {
      if (value == null) {

        value = " ";
      }
    });


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

function changeNullValue(string){
  if (string === "NULL") {
    return "";
  }else{
    return string;
  }
}

function optionsStudents() {
  ////Eliminar ESTUDIANTE

  $('span.icon-bin').click(function() {

    let modalDelete = $('#modalDelete');
    let inputModal = modalDelete.find('input');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');
    let numDocStudent = $(this).closest('tr').find('td[data-ndoc]').attr('data-ndoc');;

    inputModal.attr('data-student', idStudent);
    inputModal.attr('data-ndoc', numDocStudent);

    modalDelete.fadeIn().css({
      "display": "flex"
    });
    // modalDelete.find('input').attr('data-student',)
  });

  ////Mostrar INFO / EDITAR
  $('span.icon-eye').click(function() {

    let modalShow = $('#modalEditShow');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');

    let data = `idForm=showStudentInfo&idStudent=${idStudent}`;

    console.log('lo que envio ', data);
    $.post("services/process.php", data, function(response) {
      console.log('response student', response);
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

    console.table(studentInfo[0]);

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
  $('span.icon-plus').click(function() {

    let modalMatri = $('#modalMatricula');
    let inputModal = modalMatri.find('input#numMatri');
    let idStudent = $(this).closest('tr').find('td[data-student]').attr('data-student');
    let numDocStudent = $(this).closest('tr').find('td[data-ndoc]').attr('data-ndoc');

    modalMatri.fadeIn().css({
      "display": "flex"
    });


    inputModal.attr('data-student', idStudent);
    inputModal.attr('data-ndoc', numDocStudent);

  });
}



// NOTE: CONSULTA EDIT
$('form.edit').submit(function(event) {
  let form = this;
  let modal = $(form).closest('.modal');
  let idForm = $(form).attr('id');
  let idStudent = $('#personName').attr('data-student');
  let inputs = $(form).find('input');
  let selects = $(form).find('select');
  var data = $(form).serialize();


  if (validateForm(form)) {

    let data = `idForm=${idForm}&idStudent=${idStudent}&${$(form).serialize()}`;

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
// NOTE: CONSULTA NUEVA MATRICULA
$('form#insertMatricula').submit(function(event) {
  event.preventDefault();
  let form = this;
  let modal = $(this).closest('.modal');
  let idForm = $(this).attr('id');
  let input = $(this).find('input');
  let idStudent = input.attr('data-student');

  if (validateForm(this)) {
    let data = `idForm=${idForm}&idStudent=${idStudent}&${$(form).serialize()}`;

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
}); // NOTE: CONSULTA NUEVO RESPONSABLE
$('form#insertRelative').submit(function(event) {
  insertPerson(this);
});
// NOTE: CONSULTA ELIMINAR
$('form#deleteStudent').submit(function(event) {
  event.preventDefault();
  let form = this;
  let modal = $(this).closest('.modal');
  let idForm = $(this).attr('id');
  let input = $(this).find('input');
  let idStudent = input.attr('data-student');
  let ndocStudent = input.attr('data-ndoc');
  let trStudent = $('#showStudents').find(`td[data-student="${idStudent}"]`).closest('tr');


  if (input.val() !== ndocStudent) {
    pintarStilos($(input), 'error');
  } else {

    pintarStilos($(input), 'valido');

    let data = `idForm=${idForm}&idStudent=${idStudent}&${$(form).serialize()}`;

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
          console.log(trStudent);

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


function insertPerson(form, closeModal = true) {

  let idForm = $(form).attr('id');


  if (validateForm(form)) {

    var data = `idForm=${idForm}&${$(form).serialize()}`;
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

          showAlert("entryDuplicate", 1000, 3000);
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
