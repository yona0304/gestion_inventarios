document.getElementById('mostrar_contrase').addEventListener('change', function (e) {
    const campo_contrase = document.querySelectorAll('input[type="password"], input[type="text"]');
    campo_contrase.forEach(field => {
        field.type = e.target.checked ? 'text' : 'password';
    });
});


document.getElementById('Cambio_contrase').addEventListener('submit', function (e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submit-Btn');
    submitBtn.disabled = true;

    const nuevaContrase = document.getElementById('nueva_contrase').value;
    const ConfirmarContrase = document.getElementById('nueva_contrase_confirmation').value;

    if (nuevaContrase !== ConfirmarContrase) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las nuevas contraseñas no coinciden.',
            timer: 3000,
            showConfirmButton: false
        });
        submitBtn.disabled = false;
        return;
    }

    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(response => {
            submitBtn.disabled = false;
            if (!response.ok) {
                throw response;
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.success,
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        })
        .catch(error => {
            error.json().then(errorData => {
                let errorMessage = 'Hubo un problema al procesar tu solicitud.';
                if (errorData.errors) {
                    errorMessage = Object.values(errorData.errors).flat().join(' ');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        });
});
