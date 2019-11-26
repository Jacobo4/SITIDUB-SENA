 <?php
   include 'conexion.php';
   $tipoForm = $_POST['idForm'];
   $cumple = false;
//



//
switch ($tipoForm) {
  case 'estudiante':

  $nombres = $_POST['nombresEstu'];
  $apellidos = $_POST['apellidosEstu'];
  $numIdent = $_POST['numIdentEstu'];
  $tipoIdent = $_POST['tipoIdentEstu'];

    $cumple = true;

    //
    // $sql1 = "INSERT INTO matriculas (id, fecha_inicial, fecha_final, estado, grado, id_persona) VALUES
    //                                 (null, '$fechaInial', null, '1', 'octavo', '90') ";
    // $query = $con->query($sql1);

    break;

  default:
    // code...
    break;
}


  if ($cumple == true) {
      //Lógica para validar lo que sea. El metodo o hash_algos
      echo json_encode(array('success' => 1));
  } else {
      echo json_encode(array('success' => 0));
  }
?>

lugarExpedicionEstu=Bogot%C3%A1&fechaNaciEstu=2019-11-15&lugarNaciEstu=Bogot%C3%A1%20D.C&direccionEstu=Calle%20A&emailEstu=asd%40asd.com&telResidenciaEstu=34625498&eps=Compensar&rh=&estrato=
