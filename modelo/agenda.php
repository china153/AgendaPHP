
<?php

/*************************************************************/
/* Archivo:  agenda.php
 * Objetivo: Clase que maneja las operaciones CRUD de la agenda
 * Autor:    
 *************************************************************/

include_once('conexion.php');

class Agenda {

    // Función para insertar un nuevo contacto
    public static function insertar($nombre, $direccion, $telefono, $email, $id_usuario) {
    $conexion = Conexion::conectar();
    $sql = "INSERT INTO contactos (nombre, direccion, telefono, email, id_usuario)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([$nombre, $direccion, $telefono, $email, $id_usuario]);
}


    // Función para eliminar un contacto por nombre
    /*public static function eliminar($nombre) {
        $conexion = Conexion::conectar();
        $query = "DELETE FROM contactos WHERE nombre = '$nombre'";
        return $conexion->query($query);
    }*/

 public static function eliminarPorID($id) {
    $conexion = new PDO("mysql:host=localhost;dbname=agenda1", "root", "");
    $stmt = $conexion->prepare("DELETE FROM contactos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}


    // Función para modificar un contacto
    public static function modificar($nombreBuscar, $nombreNuevo, $direccion, $telefono, $email) {
        $conexion = Conexion::conectar();
        $query = "UPDATE contactos SET nombre='$nombreNuevo', direccion='$direccion', telefono='$telefono', email='$email' WHERE nombre='$nombreBuscar'";
        return $conexion->query($query);
    }

    // Función para mostrar todos los contactos
    public static function mostrar() {
        $conexion = Conexion::conectar();
        $query = "SELECT * FROM contactos";
        return $conexion->query($query);
    }

    // Función para buscar un contacto por nombre
    public static function buscar($nombre) {
        $conexion = Conexion::conectar();
        $query = "SELECT * FROM contactos WHERE nombre LIKE '%$nombre%'";
        return $conexion->query($query);
    }

   // Función para obtener contactos según el usuario
public static function obtenerContactosPorUsuario($id_usuario) {
    $conexion = Conexion::conectar();

    // Si el usuario es el admin (id_usuario = 1), muestra todos
    if ($id_usuario == 1) {
        $sql = "SELECT * FROM contactos";
        $stmt = $conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Solo muestra los contactos del usuario logueado
        $sql = "SELECT * FROM contactos WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

    
    
}
?>


