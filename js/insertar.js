/* insertar.js */

document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('formularioContacto');

    formulario.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita la recarga de la página al enviar el formulario

        const formData = new FormData(formulario);

        fetch('controladores/agregar.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // Se espera la respuesta como texto
        .then(data => {
            if (data.trim() === 'exito') {
                mostrarExito();
                formulario.reset(); // Limpia el formulario

                // ✅ Redirige a contactosListas.php después de mostrar el modal de éxito
                setTimeout(() => {
                    window.location.href = "contactosListas.php";
                }, 2000); // Espera 2 segundos para que el usuario vea el mensaje de éxito

            } else {
                mostrarError();
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarError();
        });
    });
});

// Funciones para mostrar y ocultar los modales
function mostrarExito() {
    document.getElementById('modalExito').style.display = 'flex';
}

function mostrarError() {
    document.getElementById('modalError').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalExito').style.display = 'none';
    document.getElementById('modalError').style.display = 'none';
}
