$(document).ready(function() {

    $.get('../php/load_content.php', 'aplication/json', (res) => {
        console.log(res);
    });

});