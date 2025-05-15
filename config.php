<?php

/*************************************************************/
/* Archivo:  config.php
 * Objetivo: Establecer y devolver una conexión activa a la 
 *           base de datos 'agenda1' utilizando MySQLi.
 * Autor:    
 *************************************************************/
function conectarDB() {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=agenda1", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error al conectar: " . $e->getMessage());
    }
}

?>



