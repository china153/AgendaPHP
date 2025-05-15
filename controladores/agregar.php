

<?php
session_start(); // ¡NECESARIO para acceder a $_SESSION!

include_once('../modelo/agenda.php');

$nombre = $_POST['Nombre'] ?? '';
$direccion = $_POST['Direccion'] ?? '';
$telefono = $_POST['Telefono'] ?? '';
$email = $_POST['Email'] ?? '';
$id_usuario = $_SESSION['id_usuario'] ?? 0;

if (Agenda::insertar($nombre, $direccion, $telefono, $email, $id_usuario)) {
    echo 'exito';
} else {
    echo 'error';
}
?>

