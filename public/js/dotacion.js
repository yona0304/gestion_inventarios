$(document).ready(function () {
    $('#DotacionReg').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, asignar',
            cancelButtonText: 'Cancelar'
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                $.ajax({
                    url: '/Dotacion-Registro/regitrado',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.success,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (xhr) {
                        // Verifica si el error es un conflicto (dotación ya registrada)
                        let message = xhr.responseJSON.fail || 'Ocurrió un error inesperado.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: message,
                        });
                    }
                });
            }
        });
    });
});


$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, BusDota) {
        $.ajax({
            url: "/Dotacion-Registro?page=" + page + "&BusDota=" + BusDota, // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#tablaDonaciones").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#BusDota", function () {
        var BusDota = $(this).val();
        fetch_data(1, BusDota); // Siempre empieza desde la página 1 al buscar
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var BusDota = $("#BusDota").val();
        fetch_data(page, BusDota);
    });
});
