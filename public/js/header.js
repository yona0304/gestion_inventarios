document.getElementById('toggle-registros').addEventListener('click', function () {
    const dropdown = document.getElementById('dropdown-example');
    dropdown.classList.toggle('hidden');
});

//para desplegar lo de asignaciones
document.getElementById('toggle-asignacion').addEventListener('click', function () {
    const dropdown = document.getElementById('dropdown-asignacion');
    dropdown.classList.toggle('hidden');
});

//para desplegar lo de lista
document.getElementById('toggle-lista').addEventListener('click', function () {
    const dropdown = document.getElementById('dropdown-lista');
    dropdown.classList.toggle('hidden');
});

document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector("[data-drawer-toggle='logo-sidebar']");
    const sidebar = document.getElementById("logo-sidebar");

    toggleButton.addEventListener("click", function () {
        event.stopPropagation();
        sidebar.classList.toggle("-translate-x-full");
    });

    // Cerrar el sidebar al hacer clic fuera de él
    document.addEventListener("click", function (event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickInsideButton = toggleButton.contains(event.target);

        if (!isClickInsideSidebar && !isClickInsideButton && !sidebar.classList.contains("-translate-x-full")) {
            sidebar.classList.add("-translate-x-full");
        }
    });
});
