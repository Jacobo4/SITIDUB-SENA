
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
            <button id="newStudent" class="alerta" type="button" name="button">New Student</button>

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

    <!-- NOTE: MODAL EDITAR DATOS USER  -->
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
                <input id="newUsername" class="input-form" type="text" name="newUsername" placeholder="Avoid Alvaro Uribe as username">
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
                <input id="newPassword" class="input-form" type="password" name="newPassword">
              </div>
              <div class="col-12 col-lg-6">
                <label for="oldPassword">Old Password .___.</label>
                <input id="oldPassword" class="input-form" type="password" name="oldPassword">
              </div>
              <div class="col-12 col-lg-6">
                <label for="secretWord">Secret Word ;)</label>
                <input id="secretWord" class="input-form" type="password" name="secretWord">
              </div>

            </div>
            <button class="btn-submitModal" type="submit" name="button">Send</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>

          </form>
        </div>
      </div>

    </div>

    <!-- NOTE: MODAL ELIMINAR  -->
    <div class="modal" id="modalDelete">

      <div class="modal-container ">

        <div class="modal-body  ctn-normal text-center">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>

          <h2>Are you sure?</h2>
          <form id="delete" action="index.html" method="post">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-6">
                <label for="idDelete">Please digit again the student's id</label>
                <input id="idDelete" class="input-form" type="text" name="idDelete">
              </div>
            </div>
            <button class="btn-submitModal" type="submit" name="button">Delete</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>

        </div>
      </div>

    </div>

    <!-- NOTE: MODAL NUEVA MATRICULA  -->
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
                <input id="numMatri" class="input-form" type="text" name="numMatri" placeholder="ej: ASAD-01">
              </div>
              <div class="col-12 col-sm-6">
                <label for="fechaInialMatri">Fecha inicial</label>
                <input id="fechaInialMatri" class="input-form" type="date" name="fechaInicialMatri">
              </div>
            </div>

            <button class="btn-submitModal" type="submit" name="button">Next</button>
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

          <form class="person" action="index.html" method="post">

            <div class="row">


              <div class="col-12">
                <h2 id="tittle-person"></h2>
              </div>


              <div class="col-12 col-sm-6">
                <label for="nombres">Names</label>
                <input id="nombres" class="input-form" type="text" name="nombres" placeholder="Alvaro Paraco">
              </div>
              <div class="col-12 col-sm-6">
                <label for="apellidos">Last names</label>
                <input id="apellidos" class="input-form" type="text" name="apellidos" placeholder="Uribe Velez">
              </div>
              <div class="col-12 col-sm-6">
                <label for="numIdent">Identification number</label>
                <input id="numIdent" class="input-form numIdent" type="identification" name="numIdent" placeholder="1001065497">
                <select id="tipoIdent" class="select-form tipoIdent" type="select" name="tipoIdent">
                  <option value="TI">TI</option>
                  <option value="CC">CC</option>
                  <option value="CE">CE</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="lugarExpe">Expedition place</label>
                <input id="lugarExpe" class="input-form" type="text" name="lugarExpe" placeholder="Lugar de expedición">
              </div>

              <div class="col-12 col-sm-6">
                <label for="fechaNaci">Birthdate</label>
                <input id="fechaNaci" class="input-form" type="date" name="fechaNaci">
              </div>

              <div class="col-12 col-sm-6">
                <label for="lugarNaci">Birthplace</label>
                <select id="lugarNaci" class="select-form citys "type="select" name="lugarNaci">
                  <option value="1">asd</option>
                  <option value="2">asd</option>
                  <option value="3">asd</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="direccion">Address</label>
                <input id="direccion" class="input-form" type="text" name="direccion" placeholder="Calle A">
              </div>




              <div class="col-12 col-sm-6">
                <label for="email">Email</label>
                <input id="email" class="input-form" type="emailCustom" name="email" placeholder="ej: jamespapasito@gmail.com">
              </div>

              <div class="col-12 col-sm-6">
                <label for="telResi">Home's phone number</label>
                <input id="telResi" class="input-form" type="text" name="telResi" placeholder="3462116">
              </div>

              <div class="col-12 col-sm-6">
                <label for="celular">cell phone number</label>
                <input id="celular" class="input-form relative" type="text" name="celular" placeholder="3132029021">
              </div>

              <div class="col-12 col-sm-6">
                <label for="ocupacion">Employment</label>
                <input id="ocupacion" class="input-form relative" type="text" name="ocupacion" placeholder="Zapatero">
              </div>

              <div class="col-12 col-sm-6">
                <label for="profesion">Profession</label>
                <input id="profesion" class="input-form relative" type="text" name="profesion" placeholder="Ingeniero Industrial">
              </div>

              <div class="col-12 col-sm-6">
                <label for="parentesco">Parentesco</label>
                <input id="parentesco" class="input-form relative" type="text" name="parentesco" placeholder="Papá">
              </div>


              <div class="col-12 mt-5">
                <h2 class="student">Clinic info</h2>
              </div>

              <div class="col-12 col-sm-6">
                <label for="eps">EPS</label>
                <input id="eps" class="input-form student" type="text" name="eps" placeholder="EPS">
              </div>

              <div class="col-6 col-sm-2">
                <label for="rh">Blood type</label>
                <select id="rh" class="select-form student" type="select" name="rh">
                  <option value="">A</option>
                  <option value="">C</option>
                  <option value="">B</option>
                </select>

              </div>

              <div class="col-6 col-sm-2">
                <label for="estrato">Income Class</label>
                <select id="estrato" class="select-form student" type="select" name="estrato">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>



            </div>
            <button class="btn-submitModal" type="submit" name="button">Save</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>


        </div>


      </div>
    </div>


    <!-- NOTE: MODAL PARA MOSTRAR Y EDITAR -->
    <div class="modal" id="modalEditShow">

      <div class="modal-container ">

        <div class="modal-tittle ctn-normal">
          <h1 id="personName">Student's name</h1>
          <div class="showOptions">
            <button id="btn-editStudent" class="btn" type="button" name="button">Edit student's info</button>
            <button id="addRelative" type="button" name="button">Add relative</button>
          </div>
        </div>

        <div class="modal-body  ctn-normal">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>


          <form class="edit" id="editStudent" action="index.html" method="post">

            <div class="row">


              <div class="col-12">
                <h2>Datos del estudiante</h2>
              </div>


              <div class="col-12 col-sm-6">
                <label for="editNombresEstu">Nombres</label>
                <input id="editNombresEstu" class="input-form" type="text" name="editNombresEstu" placeholder="Alvaro Paraco">
              </div>
              <div class="col-12 col-sm-6">
                <label for="editApellidosEstu">Apellidos</label>
                <input id="editApellidosEstu" class="input-form" type="text" name="editApellidosEstu" placeholder="Uribe Velez">
              </div>
              <div class="col-12 col-sm-6">
                <label for="editNumIdentEstu">Número de identidad</label>
                <input id="editNumIdentEstu" class="input-form numIdent" type="identification" name="editNumIdentEstu" placeholder="1001065497">
                <select id="editTipoIdentEstu" class="select-form tipoIdent" type="select" name="editNumIdentEstu">
                  <option value="">TI</option>
                  <option value="">CC</option>
                  <option value="">CE</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="editLugarExpedicionEstu">Lugar de expedición</label>
                <input id="editLugarExpedicionEstu" class="input-form" type="text" name="editLugarExpedicionEstu" placeholder="Lugar de expedición">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editFechaNaciEstu">Fecha de nacimiento</label>
                <input id="editFechaNaciEstu" class="input-form" type="date" name="editFechaNaciEstu">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editLugarNaciEstu">Lugar de nacimiento</label>
                <input id="editLugarNaciEstu" class="input-form" type="text" name="editLugarNaciEstu" placeholder="Selva">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editDireccionEstu">Direccion</label>
                <input id="editDireccionEstu" class="input-form" type="text" name="editDireccionEstu" placeholder="Calle A">
              </div>




              <div class="col-12 col-sm-6">
                <label for="editEmailEstu">Correo electrónico</label>
                <input id="editEmailEstu" class="input-form" type="emailCustom" name="editEmailEstu" placeholder="ej: jamespapasito@gmail.com">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editTelResidenciaEstu">Teléfono residencia</label>
                <input id="editTelResidenciaEstu" class="input-form" type="text" name="editTelResidenciaEstu" placeholder="3462116">
              </div>

              <div class="col-12 mt-5">
                <h2>Datos Clinicos</h2>
              </div>

              <div class="col-12 col-sm-6">
                <label for="editEps">EPS</label>
                <input id="editEps" class="input-form" type="text" name="editEps" placeholder="EPS">
              </div>

              <div class="col-6 col-sm-2">
                <label for="editRh">RH</label>
                <select id="editRh" class="select-form" type="select" name="editRh" placeholder="RH">
                  <option value="">A</option>
                  <option value="">C</option>
                  <option value="">B</option>
                </select>

              </div>

              <div class="col-6 col-sm-2">
                <label for="editEstrato">Estrato</label>
                <select id="editEstrato" class="select-form" type="select" name="editEstrato">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>



            </div>
            <button class="btn-submitModal" type="submit" name="button">Save</button>

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
