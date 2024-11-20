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

$(document).on('click', '.asignado-btn', function () {

    const id = $(this).data('id');
    const url = `/datos/${id}`;

    $.get(url, function (data) {
        console.log(data); //verificamos que se esten tomando los datos por medio de la consola del navegador

        if (data.producto) {
            $('#DeProducto').text(data.producto.descripcion_equipo);
            $('#DeCodigo').text(data.producto.codigo_interno);
            $('#DeSede').text(data.producto.ubicacion);
            $('#DeEstado').text(data.asignacion.estado)
        } else if (data.vehiculo) {
            $('#DeProducto').text(data.vehiculo.descripcion_vehiculo + ' - Vehículo');
            $('#DeCodigo').text(data.vehiculo.placa);
            $('#DeSede').text('');
            $('#DeEstado').text(data.asignacion.estado)
        }

        $('#DeNombre').text(data.usuario.nombres);
        $('#DeIdentificacion').text(data.usuario.identificacion);
        $('#DeUbicacion').text(data.usuario.ubicacion);
        $('#DeCorreo').text(data.usuario.email);
        $('#DeCargo').text(data.cargo);


        $('#DeLugar').text(data.asignacion.ubicacion);
        $('#DeFechaAsignacion').text(data.asignacion.fecha_asignacion);
        $('#DeFechaDevolucion').text(data.asignacion.fecha_devolucion);

        //abrir modal
        $('#detalleModal').removeClass('hidden');
    });
});

$(document).on('click', '.close-modal-btn', function () {
    $('#detalleModal').addClass('hidden');
})

