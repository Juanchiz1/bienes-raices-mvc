document.addEventListener('DOMContentLoaded', function() {
    console.log('Documento cargado, iniciando scripts...');
    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    if (botonDarkMode) {
        botonDarkMode.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
        });
    }
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    if (mobileMenu) {
        mobileMenu.addEventListener('click', navegacionResponsive);
    }

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    if (metodoContacto.length > 0) {
        console.log('Botones de contacto encontrados:', metodoContacto.length);
        metodoContacto.forEach(input => {
            input.addEventListener('click', mostrarMetodosContacto);
        });
    } else {
        console.log('No se encontraron botones de contacto.');
    }
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarMetodosContacto(e) {
    console.log('Clic en método de contacto:', e.target.value);
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Número Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" required>

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="contacto[hora]" min="09:00" max="18:00" required>
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}
