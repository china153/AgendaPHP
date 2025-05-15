<?php
session_start();

if (!isset($_SESSION["usuario"], $_SESSION["tipo"], $_SESSION["id_usuario"])) {
    header("Location: error.php?sErr=" . urlencode("Debe estar firmado"));
    exit();
}

require_once __DIR__ . "/../modelo/contacto.php";

$sNom = $_SESSION["usuario"];
$sTipo = $_SESSION["tipo"];
$id_usuario = $_SESSION["id_usuario"];

try {
    $conexion = new PDO("mysql:host=localhost;dbname=agenda1", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Acción eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_contacto'])) {
    $id_contacto = (int)$_POST['id_contacto'];
    if (Contacto::eliminarPorID($conexion, $id_contacto)) {
        $_SESSION['mensaje'] = "Contacto eliminado correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar contacto";
    }
    header("Location: ../contactosListas.php");
    exit();
}

// Obtener lista de contactos y guardar en sesión
$esAdmin = ($sTipo === 'admin');
$contactos = Contacto::obtenerContactos($conexion, $id_usuario, $esAdmin);

// Guardar datos para la vista
$_SESSION['contactos'] = $contactos;
$_SESSION['sNom'] = $sNom;

// Redireccionar a la vista
header("Location: ../contactosListas.php");
exit();
?>
