$(document).ready(function () {
    $('#VehiculoEnvio').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/registrar-vehiculo/registro',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        //mostramos la alerta como respuesta del backend.
                        Swal.fire({
                            title: '¡Exito!',
                            text: response.success,
                            icon: 'success',
                            timer: 3000, //tiempo de espera del mensaje.
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            html: 'El producto ya se encuentra registrado en el sistema o hubo un error al momento del cargue, por favor consultar el producto en la lista.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
});
