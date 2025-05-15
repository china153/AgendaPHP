function mostrarConfirmacion() {
    document.getElementById('modalConfirmacion').style.display = 'block';
}

function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
}

function enviarFormulario() {
    cerrarModal('modalConfirmacion');
    document.getElementById('formularioModificar').submit();
}

// Mostrar modal de resultado después de redirección
document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const resultado = params.get("resultado");

    if (resultado) {
        const modal = document.getElementById("modalResultado");
        const mensaje = document.getElementById("mensajeResultado");
        const icono = document.getElementById("iconoResultado");

        if (resultado === "exito") {
            mensaje.textContent = "¡Modificación realizada con éxito!";
            icono.src = "img/feliz.png";
        } else {
            mensaje.textContent = resultado === "fallo"
                ? "No se pudo modificar el contacto."
                : "Faltan datos para realizar la modificación.";
            icono.src = "img/triste.png";
        }

        modal.style.display = "block";

        // Limpia la URL
        const newUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
    }
});
