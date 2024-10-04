$(document).ready(function () {
    $('#CategoriaEnvio').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/registrar-categoria/registrado',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                //mostrar la alerta de registrado correctamente.
                Swal.fire({
                    title: "¡Exito!",
                    text: response.success,
                    icon: "success",
                    timer: 3000, //tiempo en milisegundos, que se muestra el mensaje.
                    showConfirmButton: false
                });

                //esperar dos segundos antes de recargar la pagina
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    html: "Se presento problemas al momento de registrar el usuario",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

});


$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, BusCategoria) {
        $.ajax({
            url: "/registrar-categoria?page=" + page + "&BusCategoria=" + BusCategoria, // Asegúrate de que esta ruta sea correcta
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#divTable").html(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    // Evento keyup para búsqueda en tiempo real
    $(document).on("keyup", "#BusCategoria", function () {
        var BusCategoria = $(this).val();
        fetch_data(1, BusCategoria); // Siempre empieza desde la página 1 al buscar
    });

    // Evento click para paginación
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        var BusCategoria = $("#BusCategoria").val();
        fetch_data(page, BusCategoria);
    });
});
