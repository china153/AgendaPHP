<?php

/*************************************************************/
/* Archivo:  conexion.php
 * Objetivo: Clase para establecer conexión con la base de datos
 * Autor:    
 *************************************************************/

class Conexion {
    public static function conectar() {
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=agenda1", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
