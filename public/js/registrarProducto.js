// document.addEventListener('DOMContentLoaded', function () {
//     const categorySelect = document.getElementById('catgoria');
//     const inputs = document.querySelectorAll('button[type="submit"]');

//     categorySelect.addEventListener('change', function () {
//         if (categorySelect.value) {
//             inputs.forEach(input => input.disabled = false);
//         } else {
//             inputs.forEach(input => input.disabled = true);
//         }
//     });
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const categoriaSelect = document.getElementById('catgoria');
//     const codigoInternoDisplay = document.getElementById('codigo_interno');

//     categoriaSelect.addEventListener('change', function () {
//         const categoriaId = this.value;

//         // Hacer una petición AJAX para obtener el prefijo y el contador
//         if (categoriaId) {
//             fetch(`/obtener-codigo-interno/${categoriaId}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.codigo_interno) {
//                         codigoInternoDisplay.textContent = data.codigo_interno;
//                     } else {
//                         codigoInternoDisplay.textContent = 'Error al generar código';
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                     codigoInternoDisplay.textContent = 'Error al generar código';
//                 });
//         } else {
//             codigoInternoDisplay.textContent = ''; // Limpia el contenido si no hay categoría seleccionada
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('catgoria');
    const inputs = document.querySelectorAll('button[type="submit"]');
    const codigoInternoDisplay = document.getElementById('codigo_interno');

    // Habilitar o deshabilitar el botón de enviar
    categorySelect.addEventListener('change', function () {
        inputs.forEach(input => input.disabled = !categorySelect.value);
        const categoriaId = categorySelect.value;

        // Hacer una petición AJAX para obtener el prefijo y el contador
        if (categoriaId) {
            fetch(`/obtener-codigo-interno/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.codigo_interno) {
                        codigoInternoDisplay.textContent = data.codigo_interno;
                    } else {
                        codigoInternoDisplay.textContent = 'Error al generar código';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    codigoInternoDisplay.textContent = 'Error al generar código';
                });
        } else {
            codigoInternoDisplay.textContent = ''; // Limpia el contenido si no hay categoría seleccionada
        }
    });
});

$(document).ready(function () {
    $('#ProductoEnvio').on('submit', function (e) {
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
                    url: '/registrar-producto/registrado',
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
