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



$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, filters) {
        $.ajax({
            url: "/lista-novedades?page=" + page + "&" + $.param(filters), // Usamos $.param() para pasar todos los filtros como parámetros
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#TablaNovedades").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real en todos los campos
    $(document).on("change keyup", "#BusNoveProducto, #BusNoveProfesional, #BusNoveFecha, #BusNoveTipo, #BusNoveEstado", function () {
        var filters = {
            BusNoveProducto: $("#BusNoveProducto").val(),
            BusNoveProfesional: $("#BusNoveProfesional").val(),
            BusNoveFecha: $("#BusNoveFecha").val(),
            BusNoveTipo: $("#BusNoveTipo").val(),
            BusNoveEstado: $("#BusNoveEstado").val(),
        };

        fetch_data(1, filters); // Llamada AJAX para obtener la primera página con todos los filtros
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];

        var filters = {
            BusNoveProducto: $("#BusNoveProducto").val(),
            BusNoveProfesional: $("#BusNoveProfesional").val(),
            BusNoveFecha: $("#BusNoveFecha").val(),
            BusNoveTipo: $("#BusNoveTipo").val(),
            BusNoveEstado: $("#BusNoveEstado").val(),
        };

        fetch_data(page, filters);
    });
});
