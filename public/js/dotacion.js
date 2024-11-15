$(document).ready(function () {
    // Función para cargar datos con AJAX
    function fetch_data(page, BusDota) {
        $.ajax({
            url: "/Dotacion-Registro?page=" + page + "&BusDota=" + BusDota, // Asegúrate de que esta ruta sea correcta
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
