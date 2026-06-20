document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll(".taller-item");

    if (!items.length) return;

    const perPage = 6;
    let currentPage = 1;

    const pageNumber = document.getElementById("pageNumber");
    const prev = document.getElementById("prev");
    const next = document.getElementById("next");

    function showPage(page) {

        const start = (page - 1) * perPage;
        const end = start + perPage;

        items.forEach((item, index) => {
            item.style.display = (index >= start && index < end)
                ? "block"
                : "none";
        });

        if (pageNumber) pageNumber.textContent = page;

        if (prev) prev.parentElement.classList.toggle("disabled", page === 1);
        if (next) next.parentElement.classList.toggle("disabled", end >= items.length);
    }

    if (next) {
        next.addEventListener("click", function (e) {
            e.preventDefault();

            if (currentPage * perPage < items.length) {
                currentPage++;
                showPage(currentPage);
            }
        });
    }

    if (prev) {
        prev.addEventListener("click", function (e) {
            e.preventDefault();

            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });
    }

    showPage(currentPage);

});

// Mostrar / ocultar contraseña
function togglePassword() {

    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
    }
}