// modal window
document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos
    var modal = document.getElementById("uploadModal");
    var btn = document.getElementById("openModalBtn");
    var span = document.getElementsByClassName("closeBtn")[0];

    // Cuando el usuario hace clic en el botón, abre la ventana modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario hace clic en <span> (x), cierra la ventana modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario hace clic fuera de la ventana modal, la cierra
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});