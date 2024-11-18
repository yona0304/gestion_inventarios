// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#mostrarModal', function () {
    $('#modalRegistar').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-hide]', function () {
    $('#modalRegistar').addClass('hidden');
});


$(document).ready(function () {
    $('#formRegistrarHistorial').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción actualizará la asignación.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/historial-computo/registro',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: '¡Historial realizado!',
                            text: response.success,
                            icon: 'success',
                            timer: 3000, //tiempo de espera del mensaje.
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (xhr) {
                        let message = xhr.responseJSON.message || 'Ocurrió un error.';
                        Swal.fire({
                            title: 'Error',
                            text: message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
});
