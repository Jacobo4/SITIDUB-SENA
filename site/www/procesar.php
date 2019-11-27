 <?php
   include 'conexion.php';
   $tipoForm = $_POST['idForm'];
   $cumple = false;

switch ($tipoForm) {
  case 'estudiante':

  $nombres = $_POST['nombresEstu'];
  $apellidos = $_POST['apellidosEstu'];
  $numIdent = $_POST['numIdentEstu'];

  $tipoIdent = $_POST['tipoIdentEstu'];
  $lugarExpe = $_POST['lugarExpedicionEstu'];

  $fechaNaci = $_POST['fechaNaciEstu'];
  $lugarNaci = $_POST['lugarNaciEstu'];
  $direccion = $_POST['direccionEstu'];

  $email = $_POST['emailEstu'];
  $telResi = $_POST['telResidenciaEstu'];

  $eps = $_POST['eps'];
  $rh = $_POST['rh'];
  $estrato = $_POST['estrato'];

  $sql1 = " insert into personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps_des_eps) VALUES
  (null, '$numIdent', '$tipoIdent', 'estudiante', '$nombres', null, '$apellidos', null, '$lugarExpe', '$lugarNaci', '$fechaNaci', '$direccion', '$email', null, '$telResi', null, null, null, null, '$rh', '$estrato', '$eps') ";

  if ($con->query($sql1) === TRUE) {
    $cumple = true;
  } else {
    $error = $con->error;
    $cumple = false;
  }

    break;

  default:
    // code...
    break;
}


  if ($cumple == true) {
      //Lógica para validar lo que sea. El metodo o hash_algos
      echo json_encode(array('success' => 1));
  } else {
      echo json_encode(array('success' => 0,
                              'error' => $error));
  }

?>
