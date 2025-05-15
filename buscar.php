<?php
session_start();
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
?>
<br><br>
<section class="container1">
    <h2>Buscar contacto</h2>
    <form action="resultados.php" method="get">
        <label for="Nombre">Nombre:</label>
        <input type="text" name="Nombre" id="Nombre" required>
        <input type="submit" value="Buscar">
    </form>
</section>
<br><br>
<?php include_once("pie.html"); ?>
