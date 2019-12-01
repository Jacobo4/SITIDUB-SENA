<?php
  session_start();
  if(!isset($_SESSION['username']) & !isset($_SESSION['rol'])  ){
    header('Location: index.php');
  }else{
    $user = $_SESSION['username'];
    $rol = $_SESSION['rol'];
  }

 ?>
