 <?php
   // include 'conexion.php'
  // header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);

  $nombreFormulario =  $_POST['idForm'];

  if ($nombreFormulario == 'matricul') {
      //Lógica para validar lo que sea. El metodo o hash_algos
      echo json_encode(array('success' => 1));
  } else {
      echo json_encode(array('success' => 0));
  }
?>
