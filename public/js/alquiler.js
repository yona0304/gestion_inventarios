$(document).ready(function () {
    $('#FormAlquiler').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estas seguro que deseas alquilar este equipo.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, alquilar',
            cancelButtonText: 'Cancelar'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/alquiler-equipo/registro',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: 'Alquiler exitoso!',
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
