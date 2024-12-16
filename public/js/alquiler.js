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
    function fetch_data_1(page, BusAlquiler) {
        $.ajax({
            url: "/equipos-alquilados?page=" + page + "&BusAlquiler=" + BusAlquiler,
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#TablaEquiposAlquilados").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#BusAlquiler", function () {
        var BusAlquiler = $(this).val();
        fetch_data_1(1, BusAlquiler);
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var BusAlquiler = $("#BusAlquiler").val();
        fetch_data_1(page, BusAlquiler);
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
        confirmButtonText: 'Sí, finalizar',
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

$('#formImportarCSV').on('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        title: '¿Estás seguro?',
        text: "Estas a punto de importar un archivo CSV.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, importar',
        cancelButtonText: 'Cancelar'
    }).then((resultado) => {
        if (resultado.isConfirmed) {

            var formData = new FormData(this);

            $.ajax({
                url: '/equipos-alquilados/importacion',
                type: 'POST',
                data: formData,
                contentType: false, // No especificar el tipo de contenido
                processData: false, // No procesar los datos
                success: function (response) {
                    Swal.fire({
                        title: '¡Éxito!',
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
                        icon: 'error',
                        title: 'Error',
                        text: message,
                    });
                }
            });
            // this.submit();  // Enviar el formulario si se confirma
        }
    });
});
