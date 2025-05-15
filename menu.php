<nav style="background-color: #333; padding: 10px;">
    <?php if (isset($_SESSION['usuario'])): ?>
        <p style="margin: 0;">
            <a class="menu" href="buscar.php" style="color: white; margin-right: 15px;">Buscar</a>
            <a class="menu" href="insertar.php" style="color: white; margin-right: 15px;">Insertar</a>
            <a class="menu" href="contactosListas.php" style="color: white; margin-right: 15px;">Contactos</a>
            <a class="menu" href="logout.php" style="color: white;">Cerrar sesión</a>
        </p>
    <?php endif; ?>
</nav>
