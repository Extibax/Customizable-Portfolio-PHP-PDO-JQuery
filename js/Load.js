$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-center');

    /* Se cierra la sesion al presionar el #btn_close_session */
    $('#btn_close_session').click(() => {
        $.get('../php/close_session.php', (res) => {

            if (res == '1') {

                alertify.success('¡Hasta Luego!');
                window.location = '../index.html';

            }
        });
    });

    /* Se optiene los datos de la Base de datos para cargar la pagina que permite 
        editar el contenido de la pagina principal */
    $.get('../php/load_content.php', 'aplication/json', (res) => {

        /* Si la respuesta del servidor es 403 entonces se redirigira a loguearse */
        if (res === "403") {

            window.location = "../views/login.html";

        } else {

            let content = JSON.parse(res);

            console.log(content);

            /* Title Admin Page */
            $('#admin_name').text("Bienvenida: " + content['Admin_name']);

            /* Landing Section */
            $('#input_landing_subtitle').val(content['landing_subtitle']);

            /* About Section */
            $('#input_about_description').html(content['about_description']);

            /* Aqui se activa la libreria Quill el cual ofrece un editor de texto genial! */
            var quill = new Quill('#input_about_description', {
                theme: 'snow'
            });

            let social_media_links = JSON.parse(content['social_media_links']);
            $('#input_social_media_link_facebook').val(social_media_links['Facebook']);
            $('#input_social_media_link_instagram').val(social_media_links['Instagram']);
            $('#input_social_media_link_whatsapp').val(social_media_links['Whatsapp']);

            /* Services Section */
            let services_description = JSON.parse(content['services_description']);

            $('#input_service_accounting').val(services_description['F_description']);
            $('#input_service_administration').val(services_description['S_description']);
            $('#input_service_recruitment').val(services_description['T_description']);

            /* Portfolio Section */
            let portfolio_titles = JSON.parse(content['portfolio_titles']);

            $('#input_first_portfolio_title').val(portfolio_titles['F_title']);
            $('#input_second_portfolio_title').val(portfolio_titles['S_title']);
            $('#input_third_portfolio_title').val(portfolio_titles['T_title']);

            let portfolio_subtitles = JSON.parse(content['portfolio_subtitles']);

            $('#input_first_portfolio_subtitle').val(portfolio_subtitles['F_subtitle']);
            $('#input_second_portfolio_subtitle').val(portfolio_subtitles['S_subtitle']);
            $('#input_third_portfolio_subtitle').val(portfolio_subtitles['T_subtitle']);

            let portfolio_descriptions = JSON.parse(content['portfolio_descriptions']);

            $('#input_first_portfolio_description').val(portfolio_descriptions['F_description']);
            $('#input_second_portfolio_description').val(portfolio_descriptions['S_description']);
            $('#input_third_portfolio_description').val(portfolio_descriptions['T_description']);

            let portfolio_links = JSON.parse(content['portfolio_links']);

            $('#input_first_portfolio_link').val(portfolio_links['F_link']);
            $('#input_second_portfolio_link').val(portfolio_links['S_link']);
            $('#input_third_portfolio_link').val(portfolio_links['T_link']);

            /* Aqui se bajan y cargan las imagenes de la seccion About & Portfolio */

            let about_image_file_1 = content['about_image_file_1'];

            let portfolio_image_file_1 = content['portfolio_image_file_1'];
            let portfolio_image_file_2 = content['portfolio_image_file_2'];
            let portfolio_image_file_3 = content['portfolio_image_file_3'];

            let about_image_type_1 = JSON.parse(content['about_image_type_1']);

            let portfolio_image_type_1 = JSON.parse(content['portfolio_image_type_1']);
            let portfolio_image_type_2 = JSON.parse(content['portfolio_image_type_2']);
            let portfolio_image_type_3 = JSON.parse(content['portfolio_image_type_3']);

            $('#show_about_image_1').attr('src', 'data:' + about_image_type_1['Type'] + ';base64,' + about_image_file_1);

            $('#show_portfolio_image_1').attr('src', 'data:' + portfolio_image_type_1['Type'] + ';base64,' + portfolio_image_file_1);
            $('#show_portfolio_image_2').attr('src', 'data:' + portfolio_image_type_2['Type'] + ';base64,' + portfolio_image_file_2);
            $('#show_portfolio_image_3').attr('src', 'data:' + portfolio_image_type_3['Type'] + ';base64,' + portfolio_image_file_3);
        }

    });

});