$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, filters) {
        $.ajax({
            url: "/lista-asignaciones?page=" + page + "&" + $.param(filters),
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#TablaAsignado").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real en todos los campos y change oara los input tipo date
    $(document).on("change keyup", "#BusProducto, #BusProfesional, #BusFecha, #BusUbicacion, #BusEstado, #BusDevolucion", function () {
        var filters = {
            BusProducto: $("#BusProducto").val(),
            BusProfesional: $("#BusProfesional").val(),
            BusFecha: $("#BusFecha").val(),
            BusUbicacion: $("#BusUbicacion").val(),
            BusEstado: $("#BusEstado").val(),
            BusDevolucion: $("#BusDevolucion").val(),
        };

        fetch_data(1, filters);
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];

        var filters = {
            BusProducto: $("#BusProducto").val(),
            BusProfesional: $("#BusProfesional").val(),
            BusFecha: $("#BusFecha").val(),
            BusUbicacion: $("#BusUbicacion").val(),
            BusEstado: $("#BusEstado").val(),
            BusDevolucion: $("#BusDevolucion").val(),
        };

        fetch_data(page, filters);
    });
});
