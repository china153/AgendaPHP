<?php
/*************************************************************/
/* Archivo:  login.php
 * Objetivo: Iniciar sesión para los dos usuarios usando PDO.
 *************************************************************/
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=agenda1", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $stmt = $pdo->prepare("SELECT id, usuario, tipo FROM usuario WHERE usuario = :usuario AND clave = :clave");
        $stmt->execute([
            ':usuario' => $usuario,
            ':clave' => $clave
        ]);

        if ($stmt->rowCount() === 1) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['id_usuario'] = $fila['id'];
            $_SESSION['tipo'] = $fila['tipo'];

            header("Location: controladores/contactosController.php");
            exit();
        } else {
            echo "Usuario o clave incorrecta.";
        }
    }
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
