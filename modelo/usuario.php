<?php
/*************************************************************/
/* Archivo: usuario.php
 * Objetivo: Clase para manejar los datos del usuario
 *************************************************************/

class Usuario {
    private $usuario;
    private $clave;
    private $tipo;

    public function __construct($usuario = "", $clave = "", $tipo = "") {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->tipo = $tipo;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
?>
