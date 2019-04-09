$(document).ready(function () {

    $.get('../php/login.php', function (res) {
        if (res == 1) {
            window.location = '../views/admin_view.html';
        } else {
            console.log("Please login");
        }
    });

    $('#btn-login').on('click', function (e) {
        e.preventDefault();

        let login_data = {
            Email: $('#input-email').val(),
            Password: $('#input-password').val()
        }

        $.post('../php/login.php', login_data, function (res) {
            if (res == 1) {
                window.location = '../views/admin_view.html';
            } else {
                console.log('Error al iniciar sesion: ' + res);
            }
        });
    });

});