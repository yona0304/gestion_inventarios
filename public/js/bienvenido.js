// Obtener referencias a los elementos
const modal = document.getElementById('authentication-modal');
const showModalButton = document.getElementById('mostrar');
const closeButton = document.querySelector('[data-modal-hide]');
const content = document.getElementById('content');
const overlay = document.getElementById('overlay');

// Función para mostrar el modal
function showModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    content.classList.add('blur-background');
    overlay.style.display = 'block';
}

// Función para cerrar el modal
function closeModal() {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    content.classList.remove('blur-background');
    overlay.style.display = 'none';
}

// Mostrar el modal al hacer clic en el botón de "Registrar"
showModalButton.addEventListener('click', function () {
    showModal();
});

// Cerrar el modal al hacer clic en la X
closeButton.addEventListener('click', function () {
    closeModal();
});

// Cerrar el modal al hacer clic fuera del contenido del modal
modal.addEventListener('click', function (e) {
    if (e.target === modal) {
        closeModal();
    }
});


document.getElementById('ver_contraseña').addEventListener('change', function (e) {
    const passwordFields = document.querySelectorAll('input[type="password"], input[type="text"]');
    passwordFields.forEach(field => {
        field.type = e.target.checked ? 'text' : 'password';
    });
});

const cambioFormulario = document.getElementById('cambio-form-link');
const volverInicio = document.getElementById('volver-inicio');
const formularioInicio = document.getElementById('form-inicio');
const formularioRecuperar = document.getElementById('form-recuperar');
const titulo = document.getElementById('modal-title');

cambioFormulario.addEventListener('click', function (e) {
    e.preventDefault();
    formularioInicio.classList.add('hidden');
    formularioRecuperar.classList.remove('hidden');
    titulo.textContent = 'Recuperar contraseña';
});

volverInicio.addEventListener('click', function () {
    formularioRecuperar.classList.add('hidden');
    formularioInicio.classList.remove('hidden');
    titulo.textContent = 'Iniciar sesión en nuestra plataforma';
});
