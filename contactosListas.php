<?php
session_start();

include_once("modelo/conexion.php");
include_once("modelo/agenda.php");

if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['sNom'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$sNom = $_SESSION['sNom'];

$contactos = Agenda::obtenerContactosPorUsuario($id_usuario);


$mensaje = "";
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<?php include_once("cabecera.html"); ?>
<?php include_once("menu.php"); ?>

<div class="contenido">
    <!-- Aquí se incluye el aside -->
    <?php include_once("aside.html"); ?>

    <main class="container1">
        <h1>Bienvenido <?php echo htmlspecialchars($sNom); ?></h1>
        <h2>Lista de Contactos</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje-exito" id="mensajeExito">
                <span class="cerrar" onclick="this.parentElement.style.display='none'">×</span>
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($row["direccion"]); ?></td>
                        <td><?php echo htmlspecialchars($row["telefono"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td>
                            <button
                                onclick="confirmarEliminacion(
                                    <?= $row['id'] ?>,
                                    <?= json_encode($row['nombre']) ?>,
                                    <?= json_encode($row['direccion']) ?>,
                                    <?= json_encode($row['telefono']) ?>,
                                    <?= json_encode($row['email']) ?>,
                                    this.closest('tr')
                                )"
                                style="background-color: #f44336; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;"
                            >
                                Eliminar
                            </button>
                            <br>
                            <a href="modificar.php?
                                id=<?= urlencode($row['id']) ?>
                                &nombre=<?= urlencode($row['nombre']) ?>
                                &direccion=<?= urlencode($row['direccion']) ?>
                                &telefono=<?= urlencode($row['telefono']) ?>
                                &email=<?= urlencode($row['email']) ?>"
                                style="text-decoration: none;">
                                <button style="background-color: #2196F3; color: white;">Modificar</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="insertar.php" style="text-decoration: none;">
                <button style="background-color: #4CAF50; color: white;">Insertar Contacto</button>
            </a>
        </div>
    </main>
</div>

<?php include_once("pie.html"); ?>

<script src="js/eliminar.js"></script>

</body>
</html>
