$(document).ready(function () {
    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Buscar producto por id_producto y mostrar en el formulario
    $('#id_producto, #identificacion').on('change', function () {
        var id_producto = $('#id_producto').val();
        var identificacion = $('#identificacion').val();
        console.log("mostrando", id_producto, identificacion)
        if (id_producto && identificacion) {
            $.ajax({
                type: 'GET',
                url: `/retirar-asignacion/${id_producto}/${identificacion}`,
                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    if (response) {
                        // Actualiza los campos con los datos recibidos
                        $('#nombre_producto').text(response.descripcion_equipo);
                        $('#categoria').text(response.categoria || '');
                        $('#f_asignacion').text(response.fecha_asignacion);
                    }
                },
                error: function (xhr) {
                    console.log('Error en la solicitud:', xhr.responseText);

                    Swal.fire({
                        title: 'Error',
                        text: 'El equipo no esta asignado, o ya esta devuelto.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    });

});
// Debounce de 500ms

// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $('#formDevo').on('submit', function (e) {
//         e.preventDefault();

//         // Mostrar alerta de confirmación
//         Swal.fire({
//             title: '¿Estás seguro?',
//             text: "Esta acción actualizará la asignación.",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Sí, actualizar',
//             cancelButtonText: 'Cancelar'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     type: 'PUT',
//                     url: '/retirar-asignacion/update',
//                     data: $('#formDevo')
//                         .serialize(), // Serializa los datos del formulario
//                     success: function (response) {
//                         Swal.fire(
//                             '¡Actualizado!',
//                             'La devolución se ha registrado correctamente.',
//                             'success'
//                         ).then(() => {
//                             location.reload();
//                         });
//                     },
//                     error: function (xhr) {
//                         Swal.fire(
//                             'Error',
//                             'Ocurrió un error al procesar la solicitud.',
//                             'error'
//                         );
//                     }
//                 });
//             }
//         });
//     });
// });
