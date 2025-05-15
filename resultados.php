<?php
session_start();
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
?>
<br><br>
<section class="container1">
<?php
require 'config.php';

if (isset($_GET["Nombre"]) && !empty(trim($_GET["Nombre"]))) {
    $nombreBuscar = trim($_GET["Nombre"]);
    $pdo = conectarDB();  // Asegúrate de que esta función retorna un objeto PDO

    $query = "SELECT * FROM contactos WHERE nombre = :nombre";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nombre', $nombreBuscar, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Resultados de la búsqueda</h2>";

    if (count($resultados) === 0) {
        echo "<p>No se encontró ningún contacto con ese nombre.</p>";
    } else {
        echo "<table class='tabla-contactos' border='1'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Email</th></tr></thead><tbody>";
        foreach ($resultados as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["direccion"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
} else {
    echo "<p>Por favor, ingrese un nombre para buscar.</p>";
}
?>
</section>
<br><br>

<?php include_once("pie.html"); ?>
