<?php
/*************************************************************/
/* Archivo:  index.php
 * Objetivo: página inicial de manejo de catálogo,
 *           incluye manejo de sesiones y plantillas
 *************************************************************/
session_start();
$bodyClass = "body-con-imagen"; 
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");

// Mostrar errores desde la sesión si existen
$mensaje = "";
if (isset($_SESSION['login_error'])) {
    $mensaje = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<br><br><br>
<!DOCTYPE html>
<html lang="es">
<h1>Bienvenido al sistema de agenda</h1>
<title>Login</title>
<section>
    <form id="frm" method="post" action="login.php">
        Usuario <input type="text" name="usuario" required />
        <br/>
        Contraseña <input type="password" name="clave" required />
        <br/>
        <input type="submit" value="Enviar" />
    </form>

    <?php if (!empty($mensaje)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>
</section>
</body>


<?php include_once("pie.html"); ?>
