$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, filters) {
        $.ajax({
            url: "/lista-productos?page=" + page + "&" + $.param(filters), // Usamos $.param() para pasar todos los filtros como parámetros
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#TablaProduct").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real en todos los campos
    $(document).on("keyup", "#BuProducto, #BuCategoria, #BuInterno, #BuEquipo, #BuUbicacion, #BuReferencia, #BuEstado", function () {
        var filters = {
            BuProducto: $("#BuProducto").val(),
            BuCategoria: $("#BuCategoria").val(),
            BuInterno: $("#BuInterno").val(),
            BuEquipo: $("#BuEquipo").val(),
            BuUbicacion: $("#BuUbicacion").val(),
            BuReferencia: $("#BuReferencia").val(),
            BuEstado: $("#BuEstado").val(),
        };

        fetch_data(1, filters); // Llamada AJAX para obtener la primera página con todos los filtros
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];

        var filters = {
            BuProducto: $("#BuProducto").val(),
            BuCategoria: $("#BuCategoria").val(),
            BuInterno: $("#BuInterno").val(),
            BuEquipo: $("#BuEquipo").val(),
            BuUbicacion: $("#BuUbicacion").val(),
            BuReferencia: $("#BuReferencia").val(),
            BuEstado: $("#BuEstado").val(),
        };

        fetch_data(page, filters);
    });
});

$(document).on('click', '.asignado-producto-btn', function () {

    const id = $(this).data('id');
    const url = `/datos-producto/${id}`;

    $.get(url, function (asign) {

        $('#NombreAsignacion').text(asign.usuarios.nombres);
        $('#IdentificacionAsignacion').text(asign.usuarios.identificacion);
        $('#AsignacionUbicacion').text(asign.usuarios.ubicacion);
        $('#AsignacionCorreo').text(asign.usuarios.email);
        $('#AsignacionCargo').text(asign.cargo);


        $('#AsinacionLugar').text(asign.asignacion.ubicacion);
        $('#AsignacionFechaAsignacion').text(asign.asignacion.fecha_asignacion);

        //abrir modal
        $('#detalleProductoModal').removeClass('hidden');
    });
});

$(document).on('click', '.close-producto-btn', function () {
    $('#detalleProductoModal').addClass('hidden');
})
