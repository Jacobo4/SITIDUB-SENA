 <?php
   include 'conexion.php';
   $tipoForm = $_POST['typeForm'];
   $cumple = false;

switch ($tipoForm) {

  case 'estudiante':
  case 'responsable':

  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $numIdent = $_POST['numIdent'];
  $tipoIdent = $_POST['tipoIdent'];
  $direccion = $_POST['direccion'];
  $email = $_POST['email'];
  $telResi = $_POST['telResi'];

  $celular = null;
  $ocupacion = null;
  $profesion = null;
  $parentesco = null;

  $celular = null;
  $lugarExpe = null;
  $fechaNaci = null;
  $lugarNaci = null;
  $eps = null;
  $rh = null;
  $estrato = null;

  if($tipoForm == 'responsable'){
    $celular = $_POST['celular'];
    $ocupacion = $_POST['ocupacion'];
    $profesion = $_POST['profesion'];
    $parentesco = $_POST['parentesco'];
  }
  else if($tipoForm == 'estudiante'){
    $celular = $_POST['celular'];
    $lugarExpe = $_POST['lugarExpe'];
    $fechaNaci = $_POST['fechaNaci'];
    $lugarNaci = $_POST['lugarNaci'];
    $eps = $_POST['eps'];
    $rh = $_POST['rh'];
    $estrato = $_POST['estrato'];
  }

  $sql1 = " insert into personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps_des_eps) VALUES
  (null, '$numIdent', '$tipoIdent', '$tipoForm', '$nombres', null, '$apellidos', null, '$lugarExpe', '$lugarNaci', '$fechaNaci', '$direccion', '$email', null, '$telResi', $celular, null, $ocupacion, $profesion, '$rh', '$estrato', '$eps') ";

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
