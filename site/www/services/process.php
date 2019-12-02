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
 $person->showStudent($con,$rol);
   break;

 case 'showStudentInfo':

 $person->showStudentInfo($con,$rol);
   break;
 default:
   // code...
   break;
}


?>
