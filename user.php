<?php

$hostname = "localhost";
$username = "webadmin";
$password = "1234";
$db = "app";

$dbconnect = mysqli_connect($hostname, $username, $password, $db);

if ($dbconnect->connect_error) {
    die("Fallo en la conexión a la base de datos: " . $dbconnect->connect_error);
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
        $pagecontents = str_replace("!!MENSAJE", "DNI/NIF incorrecto", $pagecontents);
        echo $pagecontents;
    }
    if (strlen($cp) != 5) {
        die('Código postal incorrecto.');
    }
    if (!is_numeric($telefono)) {
        die('Teléfono incorrecto.');
    }

    $query = "INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, email, nif, direccion, provincia, cp, telefono, sexo)
              VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$email', '$nif', '$direccion', '$provincia', '$cp', '$telefono', '$sexo')";

    if (!mysqli_query($dbconnect, $query)) {
        die('Ha ocurrido un error al crear el usuario.');
    } else {
        echo "Usuario creado correctamente.";
    }

}

