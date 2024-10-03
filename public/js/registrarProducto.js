// document.addEventListener('DOMContentLoaded', function () {
//     const categorySelect = document.getElementById('catgoria');
//     const inputs = document.querySelectorAll('input, textarea, button[type="submit"]');

//     categorySelect.addEventListener('change', function () {
//         if (categorySelect.value) {
//             inputs.forEach(input => input.disabled = false);
//         } else {
//             inputs.forEach(input => input.disabled = true);
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('catgoria');
    const inputs = document.querySelectorAll('button[type="submit"]');

    categorySelect.addEventListener('change', function () {
        if (categorySelect.value) {
            inputs.forEach(input => input.disabled = false);
        } else {
            inputs.forEach(input => input.disabled = true);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const categoriaSelect = document.getElementById('catgoria');
    const codigoInternoDisplay = document.getElementById('codigo_interno');

    categoriaSelect.addEventListener('change', function () {
        const categoriaId = this.value;

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
