<?php
session_start(); // Inicia o reanuda la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al login o página principal
header("Location: index.php");
exit();
?>
