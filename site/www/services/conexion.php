<?php
  $host = "localhost:3306";
  $user = "root";
  $password = "";
  $db = "proyecto";

  $con = new mysqli($host,$user,$password,$db);

  if ($con -> connect_errno){
    echo "La conexcion fallo :(";
  }
?>
