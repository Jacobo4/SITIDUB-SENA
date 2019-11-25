<?php

  include "conexion.php";

  session_start();

  if ($_GET['logIn'] == true){


    $user = $_POST['username'];
    $pwd = $_POST['password'];

    //
    // if($data = $query -> fetch_array()){
    //   header('location:home.php');
    // }else{
    //   echo "no";
    // }
    $sql1 = "SELECT username,password,desc_rol
             FROM users
             INNER JOIN rol
             ON users.id_rol = rol.id
             WHERE username = '$user' and password = '$pwd' ";
    $query = $con->query($sql1);

    if ($data = $query -> fetch_array()) {

      $_SESSION['username'] = $user;
      $_SESSION['rol'] = $data['desc_rol'];

        echo json_encode(array('success' => 1));
    } else {
        echo json_encode(array('success' => 0));
    }

  }

  else if ($_GET['logOut'] == true){

    session_destroy();
    header("location: index.php")

  }



?>
