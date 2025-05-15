<?php
/*************************************************************/
/* Archivo:  Contacto.php
 * Objetivo: Clase que representa un contacto con métodos
 *           para insertar, modificar, eliminar y obtener contactos
 *************************************************************/
class Contacto {
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
    private $id_usuario;

    // Constructor
    public function __construct($nombre, $direccion, $telefono, $email, $id_usuario) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->id_usuario = $id_usuario;
    }

    // Guardar nuevo contacto en la base de datos (PDO)
    public function guardar(PDO $conexion) {
        $sql = "INSERT INTO contactos (Nombre, Direccion, Telefono, Email, id_usuario) 
                VALUES (:nombre, :direccion, :telefono, :email, :id_usuario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Modificar contacto existente por ID (PDO)
    public function modificar(PDO $conexion, int $id_contacto) {
        $sql = "UPDATE contactos 
                SET Nombre = :nombre, Direccion = :direccion, Telefono = :telefono, Email = :email 
                WHERE id = :id_contacto";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_contacto', $id_contacto, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Obtener contactos según si es admin o no (método estático)
    public static function obtenerContactos(PDO $conexion, int $id_usuario, bool $esAdmin): array {
        if ($esAdmin) {
            $sql = "SELECT * FROM contactos";
            $stmt = $conexion->prepare($sql);
        } else {
            $sql = "SELECT * FROM contactos WHERE id_usuario = :id_usuario";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar contacto por ID (método estático)
    public static function eliminarPorID(PDO $conexion, int $id_contacto): bool {
        $sql = "DELETE FROM contactos WHERE id = :id_contacto";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_contacto', $id_contacto, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
