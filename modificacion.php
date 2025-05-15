<?php
/*************************************************************/
/* Archivo:  modificacion.php
 * Objetivo: Procesar la modificación de un contacto existente 
 *           en la base de datos. Recibe datos mediante POST, 
 *           ejecuta la actualización y redirige con el resultado.
 *************************************************************/

include_once("modelo/conexion.php");
$conexion = Conexion::conectar(); // Debe retornar un objeto PDO

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_contacto = $_POST['id_contacto'];
    $nombre = $_POST['NombreNuevo'];
    $direccion = $_POST['Direccion'];
    $telefono = $_POST['Telefono'];
    $email = $_POST['Email'];

    session_start();
    $id_usuario = $_SESSION['id_usuario'];

    try {
        $sql = "UPDATE contactos 
                SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email 
                WHERE id = :id_contacto";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_contacto', $id_contacto, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: modificar.php?id=$id_contacto&resultado=exito");
        } else {
            header("Location: modificar.php?id=$id_contacto&resultado=fallo");
        }
    } catch (PDOException $e) {
        // Manejo de errores más robusto si quieres depurar
        echo "Error al modificar el contacto: " . $e->getMessage();
    }
} else {
    header("Location: contacto.php");
}
?>
