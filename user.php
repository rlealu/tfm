<?php

$hostname = "localhost";
$username = "webadmin";
$password = "1234";
$db = "app";

$dbconnect = mysqli_connect($hostname, $username, $password, $db);

if ($dbconnect->connect_error) {
    $pagecontents = file_get_contents("result.html");
    $pagecontents = str_replace("!!RESULTADO", "Ha ocurrido un error", $pagecontents);
    $pagecontents = str_replace("!!MENSAJE", "Fallo en la conexión a la base de datos: " . $dbconnect->connect_error, $pagecontents);
    die($pagecontents);
}

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $nif = $_POST['nif'];
    $direccion = $_POST['direccion'];
    $provincia = $_POST['provincia'];
    $cp = $_POST['cp'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];

    if (strlen($nif) != 9 || is_numeric($nif[8])) {
        $pagecontents = file_get_contents("result.html");
        $pagecontents = str_replace("!!RESULTADO", "Ha ocurrido un error", $pagecontents);
        $pagecontents = str_replace("!!MENSAJE", "DNI/NIF incorrecto.", $pagecontents);
        die($pagecontents);
    }
    if (strlen($cp) != 5) {
        $pagecontents = file_get_contents("result.html");
        $pagecontents = str_replace("!!RESULTADO", "Ha ocurrido un error", $pagecontents);
        $pagecontents = str_replace("!!MENSAJE", "Código postal incorrecto.", $pagecontents);
        die($pagecontents);
    }
    if (!is_numeric($telefono)) {
        $pagecontents = file_get_contents("result.html");
        $pagecontents = str_replace("!!RESULTADO", "Ha ocurrido un error", $pagecontents);
        $pagecontents = str_replace("!!MENSAJE", "Teléfono incorrecto.", $pagecontents);
        die($pagecontents);
    }

    $query = "INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, email, nif, direccion, provincia, cp, telefono, sexo)
              VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$email', '$nif', '$direccion', '$provincia', '$cp', '$telefono', '$sexo')";

    if (!mysqli_query($dbconnect, $query)) {
        $pagecontents = file_get_contents("result.html");
        $pagecontents = str_replace("!!RESULTADO", "Ha ocurrido un error", $pagecontents);
        $message = "Fallo en la base de datos durante la creación del usuario: ".mysqli_error($dbconnect);
        $pagecontents = str_replace("!!MENSAJE", $message, $pagecontents);
        die($pagecontents);
    } else {
        $pagecontents = file_get_contents("result.html");
        $pagecontents = str_replace("!!RESULTADO", "Usuario creado correctamente", $pagecontents);
        $pagecontents = str_replace("!!MENSAJE", "", $pagecontents);
        echo $pagecontents;
    }

}

