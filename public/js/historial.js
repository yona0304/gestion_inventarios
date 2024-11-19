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


$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, filters) {
        $.ajax({
            url: "/historial-computo?page=" + page + "&" + $.param(filters), // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#HistorialComputador").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#Equipo", function () {
        var filters = {
            Equipo: $("#Equipo").val(),
            FechaHistorial: $("#FechaHistorial").val(),
        };
        console.log(filters);
        fetch_data(1, filters); // Siempre empieza desde la página 1 al buscar
    });

    $(document).on("change", "#FechaHistorial", function () {
        var filters = {
            Equipo: $("#Equipo").val(),
            FechaHistorial: $("#FechaHistorial").val(),
        };
        console.log(filters);
        fetch_data(1, filters); // Siempre empieza desde la página 1 al buscar
    });


    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];

        var filters = {
            Equipo: $("#Equipo").val(),
            FechaHistorial: $("#FechaHistorial").val()
        }

        fetch_data(page, filters);
    });
});
