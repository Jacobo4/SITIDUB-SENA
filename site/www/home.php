
<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['username']) & !isset($_SESSION['rol'])  ){
    header('Location: index.php');
  }else{
    $user = $_SESSION['username'];
    $rol = $_SESSION['rol'];
  }

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
            <h4><?php echo $user ?></h4>
            <h4><?php echo $rol ?></h4>
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
                <td class="table-options"><span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-plus"></span><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
              </tr>
              <tr class="mostrarEstu">
                <td>2</td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>
                <td class="table-options"><span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-plus"></span><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
              </tr>
              <tr class="mostrarEstu">
                <td>3</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td class="table-options"><span class="icon-eye"></span><?php if($rol === 'Coordinador'){ ?><span class="icon-plus"></span><span class="icon-pencil"></span><span class="icon-bin"></span><?php } ?></td>
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

  <!-- NOTE: MODAL nueva matricula  -->
  <div class="modal" id="modalMatricula">

    <div class="modal-container ">
      <div class="modal-tittle ctn-normal">
        <h1>Nombre del estudiante</h1>
      </div>

      <div class="modal-body  ctn-normal text-center">

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


      </div>
    </div>

  </div>

  <!-- NOTE: MODAL MOSTRAR  -->
  <div class="modal" id="modalShow">

    <div class="modal-container ">

      <div class="modal-tittle ctn-normal">
        <h1>Nombre del estudiante</h1>
      </div>

      <div class="modal-body  ctn-normal">
        <div class="row p-5">

          <div class="col-12 mb-3">
            <h2>Estudiante</h2>
          </div>

          <div class="col-12 col-sm-6">
            <label>Número de matrícula</label>
            <p> ESTU1</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="fechaInialMatri">Fecha inicial</label>
            <p> 28-02-2018</p>
          </div>

          <div class="col-12 mb-3">
            <h2>Datos del estudiante</h2>
          </div>

          <div class="col-12 col-sm-6">
            <label for="nombresEstu">Nombres</label>
            <p> Juan Jacobo</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="apellidosEstu">Apellidos</label>
            <p> Izquierdo</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="numIdentEstu">Número de identidad</label>
            <p> 1001097692 <span> TI</span></p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="lugarExpedicionEstu">Lugar de expedición</label>
            <p> Bogotá</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="fechaNaciEstu">Fecha de nacimiento</label>
            <p> 03-28-2001</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="lugarNaciEstu">Lugar de nacimiento</label>
            <p>Medellín</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="direccionEstu">Direccion</label>
            <p> Calle A</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="emailEstu">Correo electrónico</label>
            <p> jacobo@gmail.com</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="telResidenciaEstu">Teléfono residencia</label>
            <p> 3462116</p>
          </div>

          <div class="col-12 mb-3">
            <h2>Datos Clinicos</h2>
          </div>

          <div class="col-12 col-sm-6">
            <label for="eps">EPS</label>
            <p> Compensar</p>
          </div>

          <div class="col-6 col-sm-2">
            <label for="rh">RH</label>
            <p>O+</p>
          </div>

          <div class="col-6 col-sm-2">
            <label for="estrato">Estrato</label>
            <p>3</p>
          </div>

          <div class="col-12 mb-3">
            <h2>Datos del acudiente</h2>
          </div>

          <div class="col-12 col-sm-6">
            <label for="nombresAcu">Nombres</label>
            <p> Adelaida</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="apellidosAcu">Apellidos</label>
            <p> Becerra Cano</p>
          </div>
          <div class="col-12 col-sm-6">
            <label for="numIdent">Número de identidad</label>
            <p>35468897 <span>CC</span></p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="lugarExpedicionAcu">Lugar de expedición</label>
            <p> Cali</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="fechaNaciAcu">Fecha de nacimiento</label>
            <p> 03-05-1956</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="lugarNaciAcu">Lugar de nacimiento</label>
            <p> Bogotá</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="direccionAcu">Direccion</label>
            <p> Calle A</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="emailAcu">Correo electrónico</label>
            <p> adelaida@gmail.com</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="telResidenciaAcu">Teléfono residencia</label>
            <p> 346216</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="celular1Acu">Celular personal</label>
            <p> 3058139564</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="ocupacion">Ocupación</label>
            <p> Zapatero</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="profesion">Profesión</label>
            <p> Ingeniero</p>
          </div>

          <div class="col-12 col-sm-6">
            <label for="parentesco">Parentesco</label>
            <p>Papá</p>
          </div>

          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </div>
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
              <input id="numIdentEstu" class="input-form numIdent" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentEstu" class="select-form tipoIdent" type="select">
                <option value="TI">TI</option>
                <option value="CC">CC</option>
                <option value="CE">CE</option>
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
              <input id="numIdentAcu" class="input-form numIdent" type="identification" value="" placeholder="1001065497">
              <select id="tipoIdentAcu" class="select-form tipoIdent" type="select">
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
  <div class="modal" id="modalEdit">

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
              <label for="editNumMatri">Número de matrícula</label>
              <input id="editNumMatri" class="input-form" type="text" value="" placeholder="ej: ASAD-01">
            </div>
            <div class="col-12 col-sm-6">
              <label for="editFechaInialMatri">Fecha inicial</label>
              <input id="editFechaInialMatri" class="input-form" type="date" value="">
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
              <label for="editNombresEstu">Nombres</label>
              <input id="editNombresEstu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="editApellidosEstu">Apellidos</label>
              <input id="editApellidosEstu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="editNumIdentEstu">Número de identidad</label>
              <input id="editNumIdentEstu" class="input-form numIdent" type="identification" value="" placeholder="1001065497">
              <select id="editTipoIdentEstu" class="select-form tipoIdent" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="editLugarExpedicionEstu">Lugar de expedición</label>
              <input id="editLugarExpedicionEstu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editFechaNaciEstu">Fecha de nacimiento</label>
              <input id="editFechaNaciEstu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editLugarNaciEstu">Lugar de nacimiento</label>
              <input id="editLugarNaciEstu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editDireccionEstu">Direccion</label>
              <input id="editDireccionEstu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="editEmailEstu">Correo electrónico</label>
              <input id="editEmailEstu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editTelResidenciaEstu">Teléfono residencia</label>
              <input id="editTelResidenciaEstu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 mt-5">
              <h2>Datos Clinicos</h2>
            </div>

            <div class="col-12 col-sm-6">
              <label for="editEps">EPS</label>
              <input id="editEps" class="input-form" type="text" value="" placeholder="EPS">
            </div>

            <div class="col-6 col-sm-2">
              <label for="editRh">RH</label>
              <select id="editRh" class="select-form" type="select" placeholder="RH">
                <option value="">A</option>
                <option value="">C</option>
                <option value="">B</option>
              </select>

            </div>

            <div class="col-6 col-sm-2">
              <label for="editEstrato">Estrato</label>
              <select id="editEstrato" class="select-form" type="select">
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
              <label for="editNombresAcu">Nombres</label>
              <input id="editNombresAcu" class="input-form" type="text" value="" placeholder="Alvaro Paraco">
            </div>
            <div class="col-12 col-sm-6">
              <label for="editApellidosAcu">Apellidos</label>
              <input id="editApellidosAcu" class="input-form" type="text" value="" placeholder="Uribe Velez">
            </div>
            <div class="col-12 col-sm-6">
              <label for="editNumIdent">Número de identidad</label>
              <input id="editNumIdentAcu" class="input-form numIdent" type="identification" value="" placeholder="1001065497">
              <select id="editTipoIdentAcu" class="select-form tipoIdent" type="select">
                <option value="">TI</option>
                <option value="">CC</option>
                <option value="">CE</option>
              </select>
            </div>

            <div class="col-12 col-sm-6">
              <label for="editLugarExpedicionAcu">Lugar de expedición</label>
              <input id="editLugarExpedicionAcu" class="input-form" type="text" value="" placeholder="Lugar de expedición">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editFechaNaciAcu">Fecha de nacimiento</label>
              <input id="editFechaNaciAcu" class="input-form" type="date" value="">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editLugarNaciAcu">Lugar de nacimiento</label>
              <input id="editLugarNaciAcu" class="input-form" type="text" value="" placeholder="Selva">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editDireccionAcu">Direccion</label>
              <input id="editDireccionAcu" class="input-form" type="text" value="" placeholder="Calle A">
            </div>




            <div class="col-12 col-sm-6">
              <label for="editEmailAcu">Correo electrónico</label>
              <input id="editEmailAcu" class="input-form" type="emailCustom" value="" placeholder="ej: jamespapasito@gmail.com">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editTelResidenciaAcu">Teléfono residencia</label>
              <input id="editTelResidenciaAcu" class="input-form" type="text" value="" placeholder="3462116">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editCelular1Acu">Celular personal</label>
              <input id="editCelular1Acu" class="input-form" type="text" value="" placeholder="3132029021">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editOcupacion">Ocupación</label>
              <input id="editOcupacion" class="input-form" type="text" value="" placeholder="Zapatero">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editProfesion">Profesión</label>
              <input id="editProfesion" class="input-form" type="text" value="" placeholder="Ingeniero Industrial">
            </div>

            <div class="col-12 col-sm-6">
              <label for="editParentesco">Parentesco</label>
              <input id="editParentesco" class="input-form" type="text" value="" placeholder="Papá">
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
