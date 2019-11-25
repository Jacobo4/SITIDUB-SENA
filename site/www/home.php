
<!DOCTYPE html>
<?php
  session_start();

  $user = $_SESSION['username'];
  $rol = $_SESSION['rol'];

 ?>
<html>

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="title" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/vendors.css">


</head>

<body>
  <nav class="ctn-normal">
    <div class="row">
      <div class="col-6">
        <h1>SITIDOB</h1>
      </div>
      <div class="col-6">
        <div class="icon-menu"></div>
      </div>
      <div class="col-12">
        <div class="menu-container">
          <div class="menu-content">
            <ul>
              <li><a href="">Home</a></li>
              <li><a href="">Pagina 2</a></li>
              <li><a href="">Pagina 3</a></li>
              <li><button id="acountbtn">Acount</button></li>
            </ul>
          </div>

          <div class="account-container">
            <img src="assets/images/melosCaramelos.jpeg" alt="">
            <h4>Juan Jacobo Izquierdo</h4>
            <h4>Coordinador</h4>
            <button id="editUser" class="btn" type="button" name="button">Editar datos</button>
            <button id="logOut" class="btn" type="button" name="button">Cerrar sesion</button>

          </div>
        </div>

      </div>


    </div>
  </nav>
  <div class="container-fluid">

    <section id="home">


      <div class="container">

        <div class="ctn-normal options-container">
          <?php if( $rol == 'Coordinador'){?>
            <div class="options-content">
              <button id="btn-nuevo" class="alerta" type="button" name="button">Nuevo</button>
            </div>
          <?php } ?>
          <div class="search-container icon-search">
            <input class="input-form " type="text" name="" value="" placeholder="">
          </div>
        </div>


        <div class="table-container ctn-normal">
          <table class="">
            <thead>
              <tr>
                <th>#</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Curso</th>
                <th>Acudiente</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              <tr class="mostrarEstu">
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
              </tr>
              <tr class="mostrarEstu">
                <td>2</td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>
                <span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
              </tr>
              <tr class="mostrarEstu">
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </section>
  </div>

  <!-- NOTE: MODAL EDITAR DATOS  -->
  <div class="modal" id="modalEditUser">

    <div class="modal-container ">

      <div class="modal-tittle ctn-normal">
        <h1>Edit login info</h1>
      </div>

      <div class="modal-body  ctn-normal text-center">

        <div class="loading">
          <img src="assets/images/loader.gif" alt="loading..">
        </div>


        <form id="editUsername" action="index.html" method="post">

          <div class="row justify-content-center">

            <div class="col-12">
              <h2>Username</h2>
            </div>
            <div class="col-12 col-lg-6">
              <label for="newUsername">New Username</label>
              <input id="newUsername" class="input-form" type="text" name="" value="" placeholder="Avoid Alvaro Uribe as username">
            </div>

          </div>
          <button class="btn-submitModal" type="submit" name="button">Send</button>


        </form>

        <form id="editPassword" action="index.html" method="post">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2>Password</h2>
            </div>

            <div class="col-12 col-lg-6">
              <label for="newPassword">New Password</label>
              <input id="newPassword" class="input-form" type="password" name="" value="">
            </div>
            <div class="col-12 col-lg-6">
              <label for="oldPassword">Old Password .___.</label>
              <input id="oldPassword" class="input-form" type="password" name="" value="">
            </div>
            <div class="col-12 col-lg-6">
              <label for="secretWord">Secret Word ;)</label>
              <input id="secretWord" class="input-form" type="password" name="" value="">
            </div>

          </div>
          <button class="btn-submitModal" type="submit" name="button">Send</button>
          <button class="btn-cancel" type="button" name="button">Cancel</button>

        </form>
      </div>
    </div>

  </div>

  <!-- NOTE: MODAL ELIMINAR  -->
  <div class="modal" id="modalElminar">

    <div class="modal-container ">

      <div class="modal-body  ctn-normal text-center">

        <div class="loading">
          <img src="assets/images/loader.gif" alt="loading..">
        </div>

        <h2>Are you sure?</h2>
        <form id="eliminar" action="index.html" method="post">
          <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
              <label for="idEliminar">Please digit again the student's id</label>
              <input id="idEliminar" class="input-form" type="text" name="" value="">
            </div>
          </div>
          <button class="btn-submitModal" type="submit" name="button">Delete</button>
          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </form>

      </div>
    </div>

  </div>

  <!-- NOTE: MODAL NUEVO  -->
  <div class="modal" id="modalNuevo">

    <div class="modal-container">

      <div class="modal-tittle ctn-normal">
        <h1>Matricula</h1>
      </div>

      <div class="modal-body ctn-normal">

        <div class="loading">
          <img src="assets/images/loader.gif" alt="loading..">
        </div>

        <form id="matricula" action="index.html" method="post">

          <div class="row">
            <div class="col-12">
              <h2>Datos matrícula</h2>
            </div>

            <div class="col-12 col-sm-6">
              <label for="numMatri">Número de matrícula</label>
              <input id="numMatri" class="input-form" type="text" value="" placeholder="ej: ASAD-01">
            </div>
            <div class="col-12 col-sm-6">
              <label for="fechaInialMatri">Fecha inicial</label>
              <input id="fechaInialMatri" class="input-form" type="date" value="">
            </div>
          </div>

          <button class="btn-submitModal" type="submit" name="button">Next</button>
          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </form>

        <form id="estudiante" action="index.html" method="post">

          <div class="row">


            <div class="col-12">
              <h2>Datos del estudiante</h2>
            </div>


            <div class="col-12 col-sm-6">
              <label for="nombresEstu">Nombres</label>
              <input id="nombresEstu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="apellidosEstu">Apellidos</label>
              <input id="apellidosEstu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="numIdentEstu">Número de identidad</label>
              <input id="numIdentEstu" class="input-form" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentEstu" class="select-form" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarExpedicionEstu">Lugar de expedición</label>
              <input id="lugarExpedicionEstu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="fechaNaciEstu">Fecha de nacimiento</label>
              <input id="fechaNaciEstu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarNaciEstu">Lugar de nacimiento</label>
              <input id="lugarNaciEstu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="direccionEstu">Direccion</label>
              <input id="direccionEstu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="emailEstu">Correo electrónico</label>
              <input id="emailEstu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="telResidenciaEstu">Teléfono residencia</label>
              <input id="telResidenciaEstu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 mt-5">
              <h2>Datos Clinicos</h2>
            </div>

            <div class="col-12 col-sm-6">
              <label for="eps">EPS</label>
              <input id="eps" class="input-form" type="text" value="" placeholder="EPS">
            </div>

            <div class="col-6 col-sm-2">
              <label for="rh">RH</label>
              <select id="rh" class="select-form" type="select" placeholder="RH">
                <option value="">A</option>
                <option value="">C</option>
                <option value="">B</option>
              </select>

            </div>

            <div class="col-6 col-sm-2">
              <label for="estrato">Estrato</label>
              <select id="estrato" class="select-form" type="select">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
                <option value="">4</option>
                <option value="">5</option>
                <option value="">6</option>
              </select>
            </div>



          </div>
          <button class="btn-submitModal" type="submit" name="button">Next</button>
          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </form>

        <form id="acudiente" action="index.html" method="post">

          <div class="row">


            <div class="col-12">
              <h2>Datos del acudiente</h2>
            </div>


            <div class="col-12 col-sm-6">
              <label for="nombresAcu">Nombres</label>
              <input id="nombresAcu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="apellidosAcu">Apellidos</label>
              <input id="apellidosAcu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="numIdent">Número de identidad</label>
              <input id="numIdentAcu" class="input-form" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentAcu" class="select-form" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarExpedicionAcu">Lugar de expedición</label>
              <input id="lugarExpedicionAcu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="fechaNaciAcu">Fecha de nacimiento</label>
              <input id="fechaNaciAcu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarNaciAcu">Lugar de nacimiento</label>
              <input id="lugarNaciAcu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="direccionAcu">Direccion</label>
              <input id="direccionAcu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="emailAcu">Correo electrónico</label>
              <input id="emailAcu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="telResidenciaAcu">Teléfono residencia</label>
              <input id="telResidenciaAcu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 col-sm-6">
              <label for="celular1Acu">Celular personal</label>
              <input id="celular1Acu" class="input-form" type="text" value="" placeholder="3132029021">
            </div>

            <div class="col-12 col-sm-6">
              <label for="ocupacion">Ocupación</label>
              <input id="ocupacion" class="input-form" type="text" value="" placeholder="Zapatero">
            </div>

            <div class="col-12 col-sm-6">
              <label for="profesion">Profesión</label>
              <input id="profesion" class="input-form" type="text" value="" placeholder="Ingeniero Industrial">
            </div>

            <div class="col-12 col-sm-6">
              <label for="parentesco">Parentesco</label>
              <input id="parentesco" class="input-form" type="text" value="" placeholder="Papá">
            </div>



          </div>
          <button class="btn-submitModal" type="submit" name="button">Next</button>
          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </form>

      </div>



    </div>
  </div>


  <!-- NOTE: MODAL PARA MOSTRAR Y EDITAR -->
  <div class="modal" id="modalEditMostrar">

    <div class="modal-container ">

      <div class="modal-tittle ctn-normal">
        <h1>Nombre del estudiante</h1>
      </div>

      <div class="modal-body  ctn-normal">

        <div class="loading">
          <img src="assets/images/loader.gif" alt="loading..">
        </div>

        <form class="edit" id="editMatricula" action="index.html" method="post">

          <div class="row">
            <div class="col-12">
              <h2>Datos matrícula</h2>
            </div>

            <div class="col-12 col-sm-6">
              <label for="numMatri">Número de matrícula</label>
              <input id="numMatri" class="input-form" type="text" value="" placeholder="ej: ASAD-01">
            </div>
            <div class="col-12 col-sm-6">
              <label for="fechaInialMatri">Fecha inicial</label>
              <input id="fechaInialMatri" class="input-form" type="date" value="">
            </div>
          </div>

          <button class="btn-submitModal" type="submit" name="button">Edit</button>

        </form>

        <form class="edit" id="editEstudiante" action="index.html" method="post">

          <div class="row">


            <div class="col-12">
              <h2>Datos del estudiante</h2>
            </div>


            <div class="col-12 col-sm-6">
              <label for="nombresEstu">Nombres</label>
              <input id="nombresEstu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="apellidosEstu">Apellidos</label>
              <input id="apellidosEstu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="numIdentEstu">Número de identidad</label>
              <input id="numIdentEstu" class="input-form" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentEstu" class="select-form" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarExpedicionEstu">Lugar de expedición</label>
              <input id="lugarExpedicionEstu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="fechaNaciEstu">Fecha de nacimiento</label>
              <input id="fechaNaciEstu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarNaciEstu">Lugar de nacimiento</label>
              <input id="lugarNaciEstu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="direccionEstu">Direccion</label>
              <input id="direccionEstu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="emailEstu">Correo electrónico</label>
              <input id="emailEstu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="telResidenciaEstu">Teléfono residencia</label>
              <input id="telResidenciaEstu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 mt-5">
              <h2>Datos Clinicos</h2>
            </div>

            <div class="col-12 col-sm-6">
              <label for="eps">EPS</label>
              <input id="eps" class="input-form" type="text" value="" placeholder="EPS">
            </div>

            <div class="col-6 col-sm-2">
              <label for="rh">RH</label>
              <select id="rh" class="select-form" type="select" placeholder="RH">
                <option value="">A</option>
                <option value="">C</option>
                <option value="">B</option>
              </select>

            </div>

            <div class="col-6 col-sm-2">
              <label for="estrato">Estrato</label>
              <select id="estrato" class="select-form" type="select">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
                <option value="">4</option>
                <option value="">5</option>
                <option value="">6</option>
              </select>
            </div>



          </div>
          <button class="btn-submitModal" type="submit" name="button">Edit</button>

        </form>

        <form class="edit" id="editAcudiente" action="index.html" method="post">

          <div class="row">


            <div class="col-12">
              <h2>Datos del acudiente</h2>
            </div>


            <div class="col-12 col-sm-6">
              <label for="nombresAcu">Nombres</label>
              <input id="nombresAcu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="apellidosAcu">Apellidos</label>
              <input id="apellidosAcu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="numIdent">Número de identidad</label>
              <input id="numIdentAcu" class="input-form" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentAcu" class="select-form" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarExpedicionAcu">Lugar de expedición</label>
              <input id="lugarExpedicionAcu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="fechaNaciAcu">Fecha de nacimiento</label>
              <input id="fechaNaciAcu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="lugarNaciAcu">Lugar de nacimiento</label>
              <input id="lugarNaciAcu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="direccionAcu">Direccion</label>
              <input id="direccionAcu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="emailAcu">Correo electrónico</label>
              <input id="emailAcu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="telResidenciaAcu">Teléfono residencia</label>
              <input id="telResidenciaAcu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 col-sm-6">
              <label for="celular1Acu">Celular personal</label>
              <input id="celular1Acu" class="input-form" type="text" value="" placeholder="3132029021">
            </div>

            <div class="col-12 col-sm-6">
              <label for="ocupacion">Ocupación</label>
              <input id="ocupacion" class="input-form" type="text" value="" placeholder="Zapatero">
            </div>

            <div class="col-12 col-sm-6">
              <label for="profesion">Profesión</label>
              <input id="profesion" class="input-form" type="text" value="" placeholder="Ingeniero Industrial">
            </div>

            <div class="col-12 col-sm-6">
              <label for="parentesco">Parentesco</label>
              <input id="parentesco" class="input-form" type="text" value="" placeholder="Papá">
            </div>



          </div>
          <button class="btn-submitModal" type="submit" name="button">Edit</button>

        </form>
        <button class="btn-cancel" type="button" name="button">Cancel</button>
      </div>
    </div>

  </div>




  <div class="alert-container">
    <div class="alert-content">
    </div>
  </div>

  <script src="assets/js/vendors.js"></script>
  <script src="assets/js/app.js"></script>
</body>

</html>
