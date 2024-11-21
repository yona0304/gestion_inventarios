$(document).ready(function () {
    $('#VehiculoEnvio').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/registrar-vehiculo/registro',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        //mostramos la alerta como respuesta del backend.
                        Swal.fire({
                            title: '¡Exito!',
                            text: response.success,
                            icon: 'success',
                            timer: 3000, //tiempo de espera del mensaje.
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error',
                            html: 'El producto ya se encuentra registrado en el sistema o hubo un error al momento del cargue, por favor consultar el producto en la lista.',
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
    function fetch_data(page, vehiculo) {
        $.ajax({
            url: "/lista-vehiculos?page=" + page + "&vehiculo=" + vehiculo, // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#listaVehiculos").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#vehiculo", function () {
        var vehiculo = $(this).val();
        fetch_data(1, vehiculo); // Siempre empieza desde la página 1 al buscar
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var vehiculo = $("#vehiculo").val();
        fetch_data(page, vehiculo);
    });
});


$(document).on('click', '.asignado-vehiculo-btn', function () {

    const id = $(this).data('id');
    const url = `/datos-vehiculo/${id}`;

    $.get(url, function (vehi) {

        $('#NombreVehiculo').text(vehi.usuario.nombres);
        $('#IdentificacionVehiculo').text(vehi.usuario.identificacion);
        $('#VehiculoUbicacion').text(vehi.usuario.ubicacion);
        $('#VehiculoCorreo').text(vehi.usuario.email);
        $('#VehiculoCargo').text(vehi.cargo);


        $('#VehiculoLugar').text(vehi.asignacion.ubicacion);
        $('#VehiculoFechaAsignacion').text(vehi.asignacion.fecha_asignacion);

        //abrir modal
        $('#detalleVehiculoModal').removeClass('hidden');
    });
});

$(document).on('click', '.close-vehiculo-btn', function () {
    $('#detalleVehiculoModal').addClass('hidden');
})
