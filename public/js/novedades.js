$(document).ready(function () {
    $('#novedad').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/novedad/registro',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                // Verificar si la respuesta tiene una clave 'success'
                if (response.success) {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: response.success,
                        icon: "success",
                        timer: 3000, // Tiempo en milisegundos
                        showConfirmButton: false
                    });

                }

                // Verificar si la respuesta tiene una clave 'error'
                else if (response.error) {
                    Swal.fire({
                        title: 'Error',
                        text: response.error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
                // Verificar si la respuesta tiene una clave 'fail'
                else if (response.exito) {
                    Swal.fire({
                        title: 'Registro exitoso',
                        text: response.exito,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }

                // Esperar dos segundos antes de recargar la página
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    html: "Se presentó un problema al intentar registrar el usuario.",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
