<?php

  include 'conexion.php';
  include 'session.php';
  include 'crud.php';

  $tipoForm = $_POST['typeForm'];

  $cumple = 0;


switch ($tipoForm) {
// NOTE: STUDENT CRUD
 case 'insertStudent':
   $person->insertStudent($con);
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
   $person->insertRelative($con);
 break;

 case 'insertMatricula':
   $person->insertMatricula($con);
 break;

 case 'getMonth':
   $person->getMonth($con);
 break;

 case 'addPayment':
   $person->addPayment($con);
 break;

 case 'searhPayments':
   $person->searhPayments($con);
 break;







 default:

   // code...
   break;
}


?>
