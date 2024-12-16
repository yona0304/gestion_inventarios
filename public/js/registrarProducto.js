document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categoria');
    const inputs = document.querySelectorAll('button[type="submit"]');
    const prefijoCategoria = document.getElementById('prefijo_categoria');

    // Habilitar o deshabilitar el botón de enviar
    categorySelect.addEventListener('change', function () {
        inputs.forEach(input => input.disabled = !categorySelect.value);
        const categoriaId = categorySelect.value;

        // Hacer una petición AJAX para obtener el prefijo y el contador
        if (categoriaId) {
            fetch(`/obtener-codigo-interno/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.prefijo) {
                        prefijoCategoria.textContent = data.prefijo;
                    } else {
                        prefijoCategoria.textContent = 'Error al generar código';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    prefijoCategoria.textContent = 'Error al generar código';
                });
        } else {
            prefijoCategoria.textContent = ''; // Limpia el contenido si no hay categoría seleccionada
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
