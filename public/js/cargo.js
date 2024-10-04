$(document).ready(function () {
    $('#CargoEnvio').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/registrar-cargo/registrado',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                //mostrar la alerta de registrado correctamente.
                Swal.fire({
                    title: "¡Exito!",
                    text: response.success,
                    icon: "success",
                    timer: 3000, //tiempo en milisegundos, que se muestra el mensaje.
                    showConfirmButton: false
                });

                //esperar dos segundos antes de recargar la pagina
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    html: "Se presento problemas al momento de registrar el usuario",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

});

