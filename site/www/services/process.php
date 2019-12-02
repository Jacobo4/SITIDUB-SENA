<?php

  include 'conexion.php';
  include 'session.php';
  include 'crud.php';

  $tipoForm = $_POST['idForm'];

  $cumple = 0;


switch ($tipoForm) {
// NOTE: STUDENT CRUD
 case 'insertStudent':
   $person->insertPerson($con,$tipoForm);
  break;
 case 'editStudent':
   $person->editPerson($con,$tipoForm);
  break;
 case 'showStudentInfo':
   $person->showStudentInfo($con,$rol);
  break;
 case 'deleteStudent':
   $person->deleteStudent($con);
  break;
 case 'searchStudent':
   $person->searchStudent($con,$rol);
  break;


 case 'insertRelative':
   $person->insertPerson($con,$tipoForm);
 break;







 default:

   // code...
   break;
}


?>
