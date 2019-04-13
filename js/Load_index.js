$(document).ready(function () {
    
    /* Se pide todo el contenido de la pagina a la Base de datos relacional con MySQL en el lado del servidor */
    $.get('php/load_index.php', 'aplication/json', (res) => {
        
        res = JSON.parse(res);

        /* Landing Section */
        $('#landing_subtitle').text(res.landing_subtitle);

        /* About Section */

        /* Aqui se carga la imagen de la seccion About */
        let about_image_type_1 = JSON.parse(res.about_image_type_1);
        $('#show_about_image_1').attr('src', 'data:' + about_image_type_1['Type'] + ';base64,' + res.about_image_file_1);

        $('#about_description').html(res.about_description);
        
        let social_media_links = JSON.parse(res.social_media_links);
        $('#about_social_media_link_facebook').attr('href', social_media_links.Facebook);
        $('#about_social_media_link_instagram').attr('href', social_media_links.Instagram);
        $('#about_social_media_link_whatsapp').attr('href', social_media_links.Whatsapp);

        /* Services Section */
        let services_description = JSON.parse(res.services_description);
        $('#service_contabilidad_description').text(services_description.F_description);
        $('#service_administracion_description').text(services_description.S_description);
        $('#service_reclutamiento_description').text(services_description.T_description);

        /* Portfolio Section */
        let portfolio_titles = JSON.parse(res.portfolio_titles);
        $('#portfolio_first_title').text(portfolio_titles.F_title);
        $('#portfolio_second_title').text(portfolio_titles.S_title);
        $('#portfolio_third_title').text(portfolio_titles.T_title);

        let portfolio_subtitles = JSON.parse(res.portfolio_subtitles);
        $('#portfolio_first_subtitle').text(portfolio_subtitles.F_subtitle);
        $('#portfolio_second_subtitle').text(portfolio_subtitles.S_subtitle);
        $('#portfolio_third_subtitle').text(portfolio_subtitles.T_subtitle);

        let portfolio_descriptions = JSON.parse(res.portfolio_descriptions);
        $('#portfolio_first_description').text(portfolio_descriptions.F_description);
        $('#portfolio_second_description').text(portfolio_descriptions.S_description);
        $('#portfolio_third_description').text(portfolio_descriptions.T_description);

        let portfolio_links = JSON.parse(res.portfolio_links);
        $('#portfolio_first_link').attr('href', portfolio_links.F_link);
        $('#portfolio_second_link').attr('href', portfolio_links.S_link);
        $('#portfolio_third_link').attr('href', portfolio_links.T_link);

        /* Aqui se cargan las imagenes de la seccion Portfolio */
        let portfolio_image_type_1 = JSON.parse(res.portfolio_image_type_1);
        $('#show_portfolio_image_1').attr('src', 'data:' + portfolio_image_type_1['Type'] + ';base64,' + res.portfolio_image_file_1);

        let portfolio_image_type_2 = JSON.parse(res.portfolio_image_type_2);
        $('#show_portfolio_image_2').attr('src', 'data:' + portfolio_image_type_2['Type'] + ';base64,' + res.portfolio_image_file_2);

        let portfolio_image_type_3 = JSON.parse(res.portfolio_image_type_3);
        $('#show_portfolio_image_3').attr('src', 'data:' + portfolio_image_type_3['Type'] + ';base64,' + res.portfolio_image_file_3);

    });

});