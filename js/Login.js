$(document).ready(function () {

    function postData() {
        let login_data = {
            Email: $('#input-email').val(),
            Password: $('#input-password').val()
        }

        $.post('../php/login.php', login_data, function (res) {
            if (res == 1) {
                window.location = '../views/admin.html';
            } else {
                console.log('Error al iniciar sesion: ' + res);
            }
        });
    }

    $.get('../php/login.php', function (res) {
        if (res == 1) {
            window.location = '../views/admin.html';
        } else {
            console.log("Please login");
        }
    });

    $('#btn-login').on('click', function (e) {
        e.preventDefault();
        postData();
    });

    $('#login_form').keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            postData();
        }
    });

});