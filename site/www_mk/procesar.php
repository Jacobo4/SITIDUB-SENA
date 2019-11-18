 <?php
 include 'conexion.php'
if (isset($_POST['nombresEstu']) && $_POST['apellidosEstu'] && isset($_POST['numIdent']) && isset($_POST['tipoIdent']) && isset($_POST['lugarExpedicion']) && isset($_POST['fechaNaci']) && isset($_POST['lugarNaciEstu']) && isset($_POST['direccion'])) {

    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
?>
