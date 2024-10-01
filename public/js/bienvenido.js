// Obtener referencias a los elementos
const modal = document.getElementById('authentication-modal');
const showModalButton = document.getElementById('mostrar');
const closeButton = document.querySelector('[data-modal-hide]');

// Función para mostrar el modal
function showModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Función para cerrar el modal
function closeModal() {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
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
