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



let ProductoId = null;

$(document).on('click', '.actualizar-btn', function () {

    const ProductoId = $(this).data('producto');
    const url3 = $(this).data('url3');
    $('#actualizarProductoEdita').attr('action', url3);


    // Construir la URL de edición
    const url = `/lista-productos/${ProductoId}`;

    // Cargar los datos del producto
    $.get(url, function (data) {
        $('#codigo_interno').val(data.codigo_interno);
        $('#descripcion_equipo').val(data.descripcion_equipo);
        $('#ubicacion').val(data.ubicacion);
        $('#referencia').val(data.codigo_equipo_referencia);

        $('#editarProductos').removeClass('hidden');
        // Mostrar el modal
    }).fail(function () {
        Swal.fire('Error', 'Error al cargar los datos. Por favor, inténtalo de nuevo.', 'error');
    });
});

$(document).on('click', '[data-modal-product]', function () {
    $('#editarProductos').addClass('hidden');
})

$('#actualizarProductoEdita').on('submit', function (e) {
    e.preventDefault();

    const url3 = $(this).attr('action');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Estas seguro que deseas actualizar los datos del producto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, actualizar',
        cancelButtonText: 'Cancelar'
    }).then((resultado) => {
        if (resultado.isConfirmed) {
            $.ajax({
                url: url3,
                type: 'PUT',
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        title: '¡Actualización de datos realizado!',
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
