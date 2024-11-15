// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#mostrarModal', function () {
    $('#modalRegistar').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-hide]', function () {
    $('#modalRegistar').addClass('hidden');
});
