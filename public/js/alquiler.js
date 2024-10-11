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

$(document).on('click', '.finalizar-btn', function () {
    const url = $(this).data('url');  // Obtener la URL directamente desde el botón
    $('#finalizarForm').attr('action', url);  // Asignar la URL al formulario
    $('#finalizardiv').removeClass('hidden');  // Mostrar el modal
});

$(document).on('click', '[data-modal-hide]', function () {
    $('#finalizardiv').addClass('hidden');
})



$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, BuscarAlquiler) {
        $.ajax({
            url: "/equipos-alquilados?page=" + page + "&BuscarAlquiler=" + BuscarAlquiler, // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#Tablalquilados").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#BuscarAlquiler", function () {
        var BuscarAlquiler = $(this).val();
        fetch_data(1, BuscarAlquiler); // Siempre empieza desde la página 1 al buscar
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var BuscarAlquiler = $("#BuscarAlquiler").val();
        fetch_data(page, BuscarAlquiler);
    });
});


$('#finalizarForm').on('submit', function (e) {
    e.preventDefault();

    const url = $(this).attr('action');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Estas seguro que deseas finalizar el alquiler del equipo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, alquilar',
        cancelButtonText: 'Cancelar'
    }).then((resultado) => {
        if (resultado.isConfirmed) {
            $.ajax({
                url: url,
                type: 'PUT',
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        title: '¡Finalización de equipo alquilado exitoso!',
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


// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#modalmport', function () {
    $('#modalImportarCSV').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-hide]', function () {
    $('#modalImportarCSV').addClass('hidden');
});
