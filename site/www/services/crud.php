
<?php

$person = new Person;

class Person
{
    public function insertPerson($con,$tipoForm) {
      $nombres     = (!empty($_POST['nombres']))       ?  "'".$_POST['nombres']."'"       : "NULL" ;
      $apellidos   = (!empty($_POST['apellidos']))     ?  "'".$_POST['apellidos']."'"     : "NULL" ;
      $numIdent    = (!empty($_POST['numIdent']))      ?  "'".$_POST['numIdent']."'"      : "NULL" ;
      $tipoIdent   = (!empty($_POST['tipoIdent']))     ?  "'".$_POST['tipoIdent']."'"     : "NULL" ;
      $direccion   = (!empty($_POST['direccion']))     ?  "'".$_POST['direccion']."'"     : "NULL" ;
      $email       = (!empty($_POST['email']))         ?  "'".$_POST['email']."'"         : "NULL" ;
      $telResi     = (!empty($_POST['telResi']))       ?  "'".$_POST['telResi']."'"       : "NULL" ;

      $celular     = (!empty($_POST['celular']))       ?  "'".$_POST['celular']."'"       : "NULL" ;
      $ocupacion   = (!empty($_POST['ocupacion']))     ?  "'".$_POST['ocupacion']."'"     : "NULL" ;
      $profesion   = (!empty($_POST['profesion']))     ?  "'".$_POST['profesion']."'"     : "NULL" ;
      $parentesco  = (!empty($_POST['parentesco']))    ?  "'".$_POST['parentesco']."'"    : "NULL" ;

      $lugarExpe   = (!empty($_POST['lugarExpe']))     ?  "'".$_POST['lugarExpe']."'"     : "NULL" ;
      $fechaNaci   = (!empty($_POST['fechaNaci']))     ?  "'".$_POST['fechaNaci']."'"     : "NULL" ;
      $lugarNaci   = (!empty($_POST['lugarNaci']))     ?  "'".$_POST['lugarNaci']."'"     : "NULL" ;
      $eps         = (!empty($_POST['eps']))           ?  "'".$_POST['eps']."'"           : "NULL" ;
      $rh          = (!empty($_POST['rh']))            ?  "'".$_POST['rh']."'"            : "NULL" ;
      $estrato     = (!empty( $_POST['estrato']))      ?  "'".$_POST['estrato']."'"       : "NULL" ;

      $sql = " insert into personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps_des_eps) VALUES
      (null, ".$numIdent.", ".$tipoIdent.", '$tipoForm', ".$nombres.", null, ".$apellidos.", null, ".$lugarExpe.", ".$lugarNaci.", ".$fechaNaci.", ".$direccion.", ".$email.", null, ".$telResi.", ".$celular.", null, ".$ocupacion.", ".$profesion.", ".$rh.", ".$estrato.", ".$eps.") ";

      $con->query($sql);

      $rowsAfectadas = $con->affected_rows;

      if ($rowsAfectadas > 0) {
        echo json_encode(array('success' => 'Cool',
                                'cumple' => $rowsAfectadas));
      } else {
        $error = $con->error;
        if( strstr($error, 'Duplicate entry')){
          echo json_encode(array('success' => 'Entry duplicate',
                                  'error' => $error,
                                  'Rows afectadas' => $rowsAfectadas));
        }else{
          echo json_encode(array('success' => 'Error',
                                  'error' => $error,
                                  'Rows afectadas' => $rowsAfectadas));
        }
      }

    }
    public function showStudent($con,$rol){


      $search = !empty($_POST['searchAll']) ? RTRIM($_POST['searchAll']) : "";


      $sql = "SELECT ndoc,tdoc_persona,nombre1,nombre2,apellido1,apellido2 from personas where
               (ndoc like '%$search%' or
               tdoc_persona like '%juan%' or
               nombre1 like '%$search%' or
               nombre2 like '%$search%' or
               apellido1 like '%$search%'or
               apellido2 like '%$search%' )and
               tipo_persona = 'estudiante'
               ORDER BY apellido1 ASC";

       $con->query($sql);
       $result = $con->query($sql);
       $numRows = $result->num_rows;
       $error = $con->error;




       if($numRows > 0) {
         while( $row = $result->fetch_assoc()){
            $students[] = $row;
         }


         $permiso = array('rol' => $rol );

         $students[] = $permiso;
         echo json_encode($students);


       } else if($numRows == 0){
         echo json_encode(array('success' => "Don't exists"));
       } else {
         echo json_encode(array('success' => "error",
                                'desc'=> $error));
       }


    }
    public function showStudentInfo($con,$rol){



      $numIdent    = !empty($_POST['numIdent'])     ?  $_POST['numIdent']      : "" ;
      $tipoIdent   = !empty($_POST['tipoIdent'])    ?  $_POST['tipoIdent']     : "" ;


      $sql = "SELECT * from personas where ndoc = '$numIdent' and tdoc_persona = '$tipoIdent' ";

             $con->query($sql);
             $result = $con->query($sql);
             $numRows = $result->num_rows;
             $error = $con->error;




             if($numRows > 0) {
               while( $row = $result->fetch_assoc()){
                  $students[] = $row;
               }


               $permiso = array('rol' => $rol );

               $students[] = $permiso;
               echo json_encode($students);


             } else if($numRows == 0){
               echo json_encode(array('success' => "Don't exists"));
             } else {
               echo json_encode(array('success' => "error",
                                      'desc'=> $error));
             }




    }
}
?>
