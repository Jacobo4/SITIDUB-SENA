
<?php

$person = new Person;

class Person
{
    public function insertStudent($con) {

      $nombres = "NULL" ;
      $apellidos = "NULL" ;

      if(!empty($_POST['nombres'])){
        $nombres = $_POST['nombres'];
        $nombre = explode(" ", $nombres,2);
        if(empty($nombre[1])){
          $nombre[1] = "NULL" ;
        }

      }
      if(!empty($_POST['apellidos'])){
        $apellidos   = $_POST['apellidos'];
        $apellido = explode(" ", $apellidos,2);

        if(empty($apellido[1])){
          $apellido[1] = "NULL" ;
        }

      }

      $numIdent    = (!empty($_POST['numIdent']))      ?  "'".$_POST['numIdent']."'"      : "NULL" ;
      $tipoIdent   = (!empty($_POST['tipoIdent']))     ?  "'".$_POST['tipoIdent']."'"     : "NULL" ;
      $direccion   = (!empty($_POST['direccion']))     ?  "'".$_POST['direccion']."'"     : "NULL" ;
      $email       = (!empty($_POST['email']))         ?  "'".$_POST['email']."'"         : "NULL" ;
      $telResi     = (!empty($_POST['telResi']))       ?  "'".$_POST['telResi']."'"       : "NULL" ;
      $lugarExpe   = (!empty($_POST['lugarExpe']))     ?  "'".$_POST['lugarExpe']."'"     : "NULL" ;
      $fechaNaci   = (!empty($_POST['fechaNaci']))     ?  "'".$_POST['fechaNaci']."'"     : "NULL" ;
      $lugarNaci   = (!empty($_POST['lugarNaci']))     ?  "'".$_POST['lugarNaci']."'"     : "NULL" ;
      $eps         = (!empty($_POST['eps']))           ?  "'".$_POST['eps']."'"           : "NULL" ;
      $rh          = (!empty($_POST['rh']))            ?  "'".$_POST['rh']."'"            : "NULL" ;
      $estrato     = (!empty( $_POST['estrato']))      ?  "'".$_POST['estrato']."'"       : "NULL" ;

      $sql = " insert into personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps) VALUES
      (null, ".$numIdent.", ".$tipoIdent.", 'estudiante', '$nombre[0]', '$nombre[1]', '$apellido[0]', '$apellido[1]', ".$lugarExpe.", ".$lugarNaci.", ".$fechaNaci.", ".$direccion.", ".$email.", null, ".$telResi.", null, null, null, null, ".$rh.", ".$estrato.", ".$eps.") ";

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
    public function editPerson($con,$person) {
      $nombres = "NULL" ;
      $apellidos = "NULL" ;
      $nombre1 = "";
      $nombre2 = "";
      $apellido1 = "";
      $apellido2= "";


      if(!empty($_POST['nombres'])){
        $nombres = $_POST['nombres'];
        $nombre = explode(" ", $nombres,2);
        if(empty($apellido[1])){
          $nombre[1] = "NULL" ;
        }

        $nombre1 = $nombre[0];
        $nombre2 = $nombre[1];
      }
      if(!empty($_POST['apellidos'])){
        $apellidos   = $_POST['apellidos'];
        $apellido = explode(" ", $apellidos,2);

        if(empty($apellido[1])){
          $apellido[1] = "NULL" ;
        }

        $apellido1 = $apellido[0];
        $apellido2 = $apellido[1];

      }
      $idStudent    = (!empty($_POST['idStudent']))     ?  $_POST['idStudent']      : "" ;
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

      $sql = " UPDATE personas SET
      ndoc = ".$numIdent.",
      tdoc_persona = ".$tipoIdent.",
      nombre1 = '$nombre1',
      nombre2 = '$nombre2',
      apellido1 = '$apellido1',
      apellido2 = '$apellido2',
      lugar_expedicion = ".$lugarExpe.",
      lugar_nacimiento = ".$lugarNaci.",
      fecha_nacimiento = ".$fechaNaci.",
      direccion = ".$direccion.",
      email = ".$email.",
      id_observacion = null,
      tel1 = ".$telResi.",
      tel2 = ".$celular.",
      tel3 = null,
      ocupacion = ".$ocupacion.",
      profesion = ".$profesion.",
      rh = ".$rh.",
      estrato = ".$estrato.",
      eps = ".$eps."

      WHERE id ='$idStudent'
      ";

      $con->query($sql);
      $result = $con->query($sql);
      $error = $con->error;

      if ($result == TRUE) {
        echo json_encode(array('success' => 'Cool'));
      }else{
          echo json_encode(array('success' => 'Error',
                                  'error' => $error));
      }


    }
    public function showStudentInfo($con,$rol){

      $idStudent    = !empty($_POST['idStudent'])     ?  $_POST['idStudent']      : "" ;

      $sql = "SELECT * from personas where id = '$idStudent' ";

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



    public function deleteStudent($con){

      $idStudent    = !empty($_POST['idStudent'])     ?  $_POST['idStudent']      : "" ;

      $sql = "DELETE FROM personas WHERE id = '$idStudent'";

      $con->query($sql);
      $result = $con->query($sql);
      $error = $con->error;
         if ($result == TRUE) {
        echo json_encode(array('success' => 'Cool'));
      }else{
          echo json_encode(array('success' => 'Error',
                                  'error' => $error));
      }

    }
    public function searchStudent($con,$rol){


      $search = !empty($_POST['searchAll']) ? RTRIM($_POST['searchAll']) : "";


      $sql = "SELECT personas.id,ndoc,tipos_documentos.descripcion_tdoc,nombre1,nombre2,apellido1,apellido2
              from personas
              inner join tipos_documentos
              ON tdoc_persona = tipos_documentos.id
              where
               (ndoc like '%$search%' or
               tipos_documentos.descripcion_tdoc like '%$search%' or
               nombre1 like '%$search%' or
               nombre2 like '%$search%' or
               apellido1 like '%$search%'or
               apellido2 like '%$search%' )and
               tipo_persona = 'estudiante'
               ORDER BY apellido1 ASC";

               // concat(nombre1,nombre2) as nombres
               //
               // nombres like

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
    public function insertRelative($con){

      $nombres = "NULL" ;
      $apellidos = "NULL" ;

      if(!empty($_POST['nombres'])){
        $nombres = $_POST['nombres'];
        $nombre = explode(" ", $nombres,2);
        if(empty($apellido[1])){
          $apellido[1] = "NULL" ;
        }

      }
      if(!empty($_POST['apellidos'])){
        $apellidos   = $_POST['apellidos'];
        $apellido = explode(" ", $apellidos,2);

        if(empty($apellido[1])){
          $apellido[1] = "NULL" ;
        }

      }
      $numIdent    = (!empty($_POST['numIdent']))      ?  "'".$_POST['numIdent']."'"      : "NULL" ;
      $tipoIdent   = (!empty($_POST['tipoIdent']))     ?  "'".$_POST['tipoIdent']."'"     : "NULL" ;
      $direccion   = (!empty($_POST['direccion']))     ?  "'".$_POST['direccion']."'"     : "NULL" ;
      $email       = (!empty($_POST['email']))         ?  "'".$_POST['email']."'"         : "NULL" ;
      $telResi     = (!empty($_POST['telResi']))       ?  "'".$_POST['telResi']."'"       : "NULL" ;
      $celular     = (!empty($_POST['celular']))       ?  "'".$_POST['celular']."'"       : "NULL" ;
      $ocupacion   = (!empty($_POST['ocupacion']))     ?  "'".$_POST['ocupacion']."'"     : "NULL" ;
      $profesion   = (!empty($_POST['profesion']))     ?  "'".$_POST['profesion']."'"     : "NULL" ;

      $parentesco  = (!empty($_POST['parentesco']))    ?  "'".$_POST['parentesco']."'"    : "NULL" ;


      $sql = " insert into personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps) VALUES
      (null, ".$numIdent.", ".$tipoIdent.", 'responsable', '$nombre[0]', '$nombre[1]', '$apellido[0]', '$apellido[1]', null, null, null, ".$direccion.", ".$email.", null, ".$telResi.", ".$celular.", null,".$ocupacion.", ".$profesion.",null, null, null) ";

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
    public function insertMatricula($con){
      $idStudent        = (!empty($_POST['idStudent']))             ?  $_POST['idStudent']                      : "" ;
      $numMatri         = (!empty($_POST['numMatri']))              ?  "'".$_POST['numMatri']."'"               : "NULL" ;
      $fechaIniMatri    = (!empty($_POST['fechaInicialMatri']))     ?  "'".$_POST['fechaInicialMatri']."'"      : "NULL" ;
      $grade            = (!empty($_POST['grado']))                 ?  "'".$_POST['grado']."'"                  : "NULL" ;

      $sql = "insert into matriculas (id, descripcion_matricula, fecha_inicial, fecha_final, estado, grado, id_persona) VALUES
      (null, ".$numMatri.",".$fechaIniMatri.", null, '1', ".$grade.", ".$idStudent.")
      ";

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




}
?>