/*
|--------------------------------------------------------------------------
| Desplegar formulario de registro de historial
|--------------------------------------------------------------------------
|
| Se despliega contenido de formulario de registro de historial-
|
*/

// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#mostrarModal', function () {
    $('#modalRegistar').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-hide]', function () {
    $('#modalRegistar').addClass('hidden');
});

/*
|--------------------------------------------------------------------------
| Alertas de respuesta de registrar historial
|--------------------------------------------------------------------------
|
| Aca se diseña la respuesta que se obtiene, por parte del servidor
| cuando se registra un historial de forma inividual.
|
*/

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

/*
|--------------------------------------------------------------------------
| Filtro y pagina de la tabla de historial computo
|--------------------------------------------------------------------------
|
| Aqui se maneja lo que son los filtros de busqueda y paginación, de la tabla
| de historial de computo, donse los filtros se hacen busqueda por el producto
| y por la fecha.
|
*/

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

/*
|--------------------------------------------------------------------------
| Codigo de despliegue, para marcación rapida, para botones de importar y descargar
|--------------------------------------------------------------------------
|
| Codigo para despliegue de marcación, para importar y descargar,
| donde tambien se muestra un mensajito breve de la función que tiene el boton
|
*/

// Obtener el botón de toggling y el menú de opciones
const dialToggleButton = document.querySelector('[data-dial-toggle="speed-dial-menu-default"]');
const dialMenu = document.getElementById('speed-dial-menu-default');

// Añadir un event listener al botón para alternar la visibilidad del menú
dialToggleButton.addEventListener('click', function () {
    const isExpanded = dialToggleButton.getAttribute('aria-expanded') ===
        'true'; // Verifica si el menú está expandido

    // Alternar la visibilidad del menú
    if (isExpanded) {
        dialMenu.classList.add('hidden'); // Ocultar el menú
        dialToggleButton.setAttribute('aria-expanded', 'false'); // Actualizar el estado
    } else {
        dialMenu.classList.remove('hidden'); // Mostrar el menú
        dialToggleButton.setAttribute('aria-expanded', 'true'); // Actualizar el estado
    }
});

// Funcionalidad para mostrar las tooltips al pasar el ratón por encima
const buttons = document.querySelectorAll('[data-tooltip-target]');

buttons.forEach(button => {
    button.addEventListener('mouseenter', function () {
        const tooltipId = button.getAttribute('data-tooltip-target');
        const tooltip = document.getElementById(tooltipId);
        tooltip.classList.remove('opacity-0', 'invisible'); // Hacer visible la tooltip
        tooltip.classList.add('opacity-100',
            'visible'); // Asegurarse de que esté completamente visible
    });

    button.addEventListener('mouseleave', function () {
        const tooltipId = button.getAttribute('data-tooltip-target');
        const tooltip = document.getElementById(tooltipId);
        tooltip.classList.remove('opacity-100', 'visible'); // Ocultar la tooltip
        tooltip.classList.add('opacity-0', 'invisible'); // Hacerla invisible
    });
});

/*
|--------------------------------------------------------------------------
| Modal de formulario de importación de archivo CSV
|--------------------------------------------------------------------------
|
| Codigo de despliegue de modal en historial omputo.
|
*/

// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#modalHistori', function () {
    $('#importarHistorial').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-historial]', function () {
    $('#importarHistorial').addClass('hidden');
});


/*
|--------------------------------------------------------------------------
| Alertas de respuesta de formulario import historial
|--------------------------------------------------------------------------
|
| Aca se diseñara el codigo, que contendra las respuesta y envio del formulario,
| que contiene el archivo de importación CSV a la base de datos.
|
*/

$('#formImportarHistorial').on('submit', function (e) {
    e.preventDefault();

    Swal.fire({
        title: '¿Estás seguro?',
        text: "Estas a punto de importar un archivo CSV, tener en cuenta que solo se registrara, si el producto esta registrado en el sistema por favor verificar que se encuentra registrado los productos antes de cargar documento.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, importar',
        cancelButtonText: 'Cancelar'
    }).then((resultado) => {
        if (resultado.isConfirmed) {

            var formData = new FormData(this);

            $.ajax({
                url: '/historial-computo/importacion',
                type: 'POST',
                data: formData,
                contentType: false, // No especificar el tipo de contenido
                processData: false, // No procesar los datos
                success: function (response) {
                    Swal.fire({
                        title: '¡Éxito!',
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
                        icon: 'error',
                        title: 'Error',
                        text: message,
                    });
                }
            });
        }
    });
});


// Mostrar el modal al hacer clic en el botón de importar
$(document).on('click', '#modalHistorialExperto', function () {
    $('#ExportHistorial').removeClass('hidden');
});

// Ocultar el modal al hacer clic en el botón de cerrar
$(document).on('click', '[data-modal-export]', function () {
    $('#ExportHistorial').addClass('hidden');
});
