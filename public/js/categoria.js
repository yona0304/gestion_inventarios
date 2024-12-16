const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

$(document).ready(function () {
    $('#CategoriaEnvio').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/registrar-categoria/registrado',
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
                    html: "Error al registrar, consultar existencia.",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

});


$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, BusCategoria) {
        $.ajax({
            url: "/registrar-categoria?page=" + page + "&BusCategoria=" + BusCategoria, // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#divTable").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#BusCategoria", function () {
        var BusCategoria = $(this).val();
        fetch_data(1, BusCategoria); // Siempre empieza desde la página 1 al buscar
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var BusCategoria = $("#BusCategoria").val();
        fetch_data(page, BusCategoria);
    });
});


function deleteCategoria(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/registrar-categoria/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Alerta de éxito
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: data.message,
                            icon: 'success',
                            timer: 3000, // tiempo de espera del mensaje
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        // Si la categoría está relacionada con productos
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }).catch((xhr) => {
                    // Manejo de errores de red o cualquier otro tipo de error
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo conectar con el servidor.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });

        }
    });
}
