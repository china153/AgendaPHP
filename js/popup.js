// popup.js

// Crear overlay (fondo gris)
function crearOverlay() {
    const overlay = document.createElement('div');
    overlay.id = 'overlayPopup';
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;
    return overlay;
}

// Crear el cuadro blanco centrado
function crearPopup() {
    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
    popup.style.width = '300px';
    return popup;
}

// Crear un botón con estilo
function crearBoton(texto, colorFondo, onClick) {
    const btn = document.createElement('button');
    btn.textContent = texto;
    btn.style.margin = '10px';
    btn.style.backgroundColor = colorFondo;
    btn.style.color = '#fff';
    btn.style.padding = '8px 16px';
    btn.style.border = 'none';
    btn.style.borderRadius = '5px';
    btn.style.cursor = 'pointer';
    btn.onclick = onClick;
    return btn;
}

// Cierra cualquier popup anterior
function cerrarPopup() {
    const overlay = document.getElementById('overlayPopup');
    if (overlay) {
        overlay.remove();
    }
}

// Mostrar popup genérico
function mostrarPopup(mensaje, redireccion, cancelar, aceptar) {
    cerrarPopup(); // Asegura que no haya otro popup abierto

    const overlay = crearOverlay();
    const popup = crearPopup();

    const message = document.createElement('div');
    message.innerHTML = mensaje;

    const btnAceptar = crearBoton('Aceptar', '#4CAF50', () => {
        cerrarPopup();
        if (typeof aceptar === 'function') aceptar();
        else if (redireccion) window.location.href = redireccion;
    });

    const btnCancelar = crearBoton('Cancelar', '#f44336', () => {
        cerrarPopup();
        if (typeof cancelar === 'function') cancelar();
    });

    popup.appendChild(message);
    popup.appendChild(btnAceptar);
    popup.appendChild(btnCancelar);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}


// Mostrar confirmación antes de eliminar
function confirmarEliminacion(id, nombre, direccion, telefono, email, fila) {
    const mensaje = `
        <h3>¿Seguro que deseas eliminar a:</h3>
        <p><strong>${nombre}</strong></p>
        <p><strong>Dirección:</strong> ${direccion}</p>
        <p><strong>Teléfono:</strong> ${telefono}</p>
        <p><strong>Email:</strong> ${email}</p>
    `;

    const confirmar = () => {
        fetch(`eliminacion.php?id=${id}`)
            .then(response => response.text())
            .then(resultado => {
                cerrarPopup();
                if (resultado.trim() === 'ok') {
                    // Elimina la fila del DOM
                    if (fila && fila.remove) fila.remove();

                    mostrarPopup(`
                        <img src="img/feliz.png" style="max-width: 100px; display: block; margin: 0 auto;">
                        <h3>¡Eliminación con éxito!</h3>
                        <p>El contacto fue eliminado correctamente.</p>
                    `, '');
                } else {
                    mostrarPopup(`
                        <img src="img/triste.png" style="max-width: 100px; display: block; margin: 0 auto;">
                        <h3>Error al eliminar</h3>
                        <p>Intenta de nuevo.</p> `, '', null);
                }
            })
            .catch(error => {
                cerrarPopup();
                mostrarPopup(`<h3>Error en la petición</h3><p>${error}</p>`, '', null);
            });
    };

    mostrarPopup(mensaje, '', () => {}, confirmar);
}
