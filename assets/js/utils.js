$(document).ready(function () {
    document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            swal("Peringatan", "Aksi ini tidak diperbolehkan, demi keamanan data.", "warning");
        } else if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
            e.preventDefault();
            swal("Peringatan", "Aksi ini tidak diperbolehkan, demi keamanan data.", "warning");
        } else if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            swal("Peringatan", "Aksi ini tidak diperbolehkan, demi keamanan data.", "warning");
        } else if (e.key === 'F12') {
            e.preventDefault();
            swal("Peringatan", "Aksi ini tidak diperbolehkan, demi keamanan data.", "warning");
        }
    });

    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
});