<?php
/*************************************************************/
/* Archivo:  mostrar.php
 * Objetivo: Mostrar contactos filtrados por usuario.
 * 
 *************************************************************/
include_once('modelo/agenda.php'); 

session_start();

$sErr = "";
$sNom = "";
$sTipo = "";
$id_usuario = 0;

// Verificar si el usuario inició sesión correctamente
if (isset($_SESSION["usuario"]) && isset($_SESSION["tipo"]) && isset($_SESSION["id_usuario"])) {
    $sNom = $_SESSION["usuario"];
    $sTipo = $_SESSION["tipo"];
    $id_usuario = $_SESSION["id_usuario"];
} else {
    $sErr = "Debe estar firmado";
}

if ($sErr !== "") {
    header("Location: error.php?sErr=" . urlencode($sErr));
    exit();
}

// Conexión a la base de datos usando PDO
try {
    $conexion = new PDO("mysql:host=localhost;dbname=agenda1", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta según tipo de usuario
if ($sTipo === 'admin') {
    $sql = "SELECT * FROM contactos";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
} else {
    $sql = "SELECT * FROM contactos WHERE id_usuario = :id_usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
}

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Contactos - Agenda</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <?php 
        include_once("cabecera.html"); 
        include_once("menu.php");       
        include_once("aside.html"); 
    ?>
    <br><br>
    <section class="container1">
        <h1>Bienvenido <?php echo htmlspecialchars($sNom); ?> </h1>
        <h2>Lista de Contactos</h2>

        <?php if (count($resultado) > 0): ?>
            <table class="tabla-contactos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td><?= htmlspecialchars($fila['telefono']) ?></td>
                            <td><?= htmlspecialchars($fila['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron contactos.</p>
        <?php endif; ?>
    </section>
    <br><br>
    <?php 
        include_once("pie.html"); 
    ?>
</body>
</html>
