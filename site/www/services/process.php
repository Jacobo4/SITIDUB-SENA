<?php

  include 'conexion.php';
  include 'session.php';
  include 'crud.php';

  $tipoForm = $_POST['idForm'];
  $cumple = 0;


switch ($tipoForm) {

 case 'estudiante':
   $person->insertPerson($con,$tipoForm);
  break;
 case 'responsable':
   $person->insertPerson($con,$tipoForm);
 break;

 case 'serachEstu':

 $usera = $_SESSION['username'];
 $person->showPerson($con,$tipoForm,$rol);

   break;
 default:
   // code...
   break;
}


?>
