$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-center');

    $('#btn_close_session').click(() => {
        $.get('../php/close_session.php', (res) => {
            console.log(res);
            if (res == '1') {
                alertify.success('¡Hasta Luego!');
                window.location = '../index.html';
            } else {
                alertify.error('¡No se pudo cerrar la sesion!');
            }
        });
    });

    $.get('../php/load_content.php', 'aplication/json', (res) => {

        if (res === "403") {
            window.location = "../views/login.html";
        } else {

            let content = JSON.parse(res);

            console.log(content);

            /* Landing Section */
            $('#landing_subtitle').val(content['landing_subtitle']);

            /* About Section */
            $('#textarea_about_description').html(content['about_description']);
            var quill = new Quill('#textarea_about_description', {
                theme: 'snow'
            });
            
            let social_media_links = JSON.parse(content['social_media_links']);
            $('#social_media_link_facebook').val(social_media_links['Facebook']);
            $('#social_media_link_instagram').val(social_media_links['Instagram']);
            $('#social_media_link_whatsapp').val(social_media_links['Whatsapp']);

            /* Services Section */
            let services_descriptions = JSON.parse(content['services_description']);
            $('#service_accounting').val(services_descriptions['Contabilidad']);
            $('#service_administration').val(services_descriptions['Administracion']);
            $('#service_recruitment').val(services_descriptions['Reclutamiento']);

            /* Portfolio Section */
            let portfolio_titles = JSON.parse(content['portfolio_titles']);
            $('#first_port_title').val(portfolio_titles['F_title']);
            $('#sec_port_title').val(portfolio_titles['S_title']);
            $('#third_port_title').val(portfolio_titles['T_title']);
            let portfolio_subtitles = JSON.parse(content['portfolio_subtitles']);
            $('#first_port_subtitle').val(portfolio_subtitles['F_subtitle']);
            $('#sec_port_subtitle').val(portfolio_subtitles['S_subtitle']);
            $('#third_port_subtitle').val(portfolio_subtitles['T_subtitle']);
            let portfolio_descriptions = JSON.parse(content['portfolio_descriptions']);
            console.log(portfolio_descriptions['T_description']);
            $('#first_port_description').val(portfolio_descriptions['F_description']);
            $('#sec_port_description').val(portfolio_descriptions['S_description']);
            $('#third_port_description').val(portfolio_descriptions['T_description']);
            let portfolio_links = JSON.parse(content['portfolio_links']);
            $('#first_port_link').val(portfolio_links['F_link']);
            $('#sec_port_link').val(portfolio_links['S_link']);
            $('#third_port_link').val(portfolio_links['T_link']);

            /* Load Images of About & Portfolio Section */

            let about_image_file_1 = content['about_image_file_1'];

            let portfolio_image_file_1 = content['portfolio_image_file_1'];
            let portfolio_image_file_2 = content['portfolio_image_file_2'];
            let portfolio_image_file_3 = content['portfolio_image_file_3'];

            let about_image_type_1 = JSON.parse(content['about_image_type_1']);

            let portfolio_image_type_1 = JSON.parse(content['portfolio_image_type_1']);
            let portfolio_image_type_2 = JSON.parse(content['portfolio_image_type_2']);
            let portfolio_image_type_3 = JSON.parse(content['portfolio_image_type_3']);

            $('#show_about_image_1').attr('src', 'data:' + about_image_type_1['Type'] + ';base64,' + about_image_file_1);

            $('#show_portfolio_image_1').attr('src', 'data:' + portfolio_image_type_1['F_img'] + ';base64,' + portfolio_image_file_1);
            $('#show_portfolio_image_2').attr('src', 'data:' + portfolio_image_type_2['F_img'] + ';base64,' + portfolio_image_file_2);
            $('#show_portfolio_image_3').attr('src', 'data:' + portfolio_image_type_3['F_img'] + ';base64,' + portfolio_image_file_3);
        }

    });

});