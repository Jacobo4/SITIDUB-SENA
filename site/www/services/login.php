<?php

  include "conexion.php";



  if($_REQUEST['log'] == 'true'){


  $user = $_POST['username'];
  $pwd = $_POST['password'];

  $sql1 = "SELECT username,password,desc_rol
           FROM users
           INNER JOIN rol
           ON users.id_rol = rol.id
           WHERE username = '$user' and password = '$pwd' ";
  $query = $con->query($sql1);
  $data = $query -> fetch_array();

  if ($data != "") {
    session_start();

    $_SESSION['username'] = $user;
    $_SESSION['rol'] = $data['desc_rol'];
    
      echo json_encode(array('success' => "Cool"));
  } else {
      echo json_encode(array('success' => "Error"));
  }

} else if($_REQUEST['log'] == 'false'){

    session_start();
    session_destroy();
    echo json_encode(array('success' => "Cool"));

  }

?>
