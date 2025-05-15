<!--*-
 * @file insertar.php
 * Página para insertar un nuevo contacto en la base de datos.
 * Esta página incluye un formulario para ingresar los datos del contacto y maneja la inserción en la base de datos.
 *-->
<?php
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
session_start();

// Validar sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    echo "Usuario no identificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Contacto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
        
</head>
<body class="body1">

<main class="container1">
    <h1>Insertar Contacto</h1>

    <form id="formularioContacto" class="formulario-contacto">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="Nombre" placeholder="Nombre" required><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="Direccion" placeholder="Dirección" required><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="Telefono" placeholder="Teléfono" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="Email" placeholder="Email" required><br>

       <input type="submit" value="Insertar" class="btn-insertar">
 
    </form>
</main>

<!-- Modal de Éxito -->
<div id="modalExito" class="modal">
    <div class="modal-contenido">
        <img src="img/feliz.png" alt="Éxito" width="80" height="80">
        <p>✅ Contacto insertado correctamente.</p>
        <button onclick="cerrarModal()">Cerrar</button>
    </div>
</div>

<!-- Modal de Error -->
<div id="modalError" class="modal">
    <div class="modal-contenido">
        <img src="img/triste.png" alt="Error" width="80" height="80">
        <p>❌ Error al insertar el contacto.</p>
        <button onclick="cerrarModal()">Cerrar</button>
    </div>
</div>

<?php include_once("pie.html"); ?>

<script src="js/insertar.js"></script>

</body>
</html>
