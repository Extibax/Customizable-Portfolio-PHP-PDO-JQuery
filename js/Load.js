$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-center');

    $.get('../php/load_content.php', 'aplication/json', (res) => {

        if (res === "403") {
            window.location = "../views/login_view.html";
        }

        let content = JSON.parse(res);
        console.log(content);

        /* Landing Section */
        $('#landing_subtitle').val(content['landing_subtitle']);

        /* About Section */
        let about_image_type_1 = JSON.parse(content['about_image_type_1']);
        let about_image_file_1 = content['about_image_file_1'];
        $('#h5_about_img_name').text(about_image_type_1['Name']);
        $('#src_about_img').attr('src', 'data:' + about_image_type_1['Type'] + ';base64,' + about_image_file_1);
        $('#textarea_about_description').val(content['about_description']);
        let social_media_links = JSON.parse(content['social_media_links']);
        $('#social_media_link_facebook').val(social_media_links['Facebook']);
        $('#social_media_link_instagram').val(social_media_links['Instagram']);
        $('#social_media_link_whatsapp').val(social_media_links['Whatsapp']);

        /* Services Section */
        



        /* let about_img_name_type = content[3];
        let portfolio_image_type_1 = content[23];
        let portfolio_image_type_2 = content[24];
        let portfolio_image_type_3 = content[25];
        let about_img = content[26];
        let portfolio_image_1 = content[27];
        let portfolio_image_2 = content[28];
        let portfolio_image_3 = content[29];


        $('#about_img_info').val(about_img_name_type['Name']);

        $('#port_img_info_1').text(portfolio_image_type_1['Name']);
        $('#port_img_info_2').text(portfolio_image_type_2['Name']);
        $('#port_img_info_3').text(portfolio_image_type_3['Name']);

        $('#first_show_port_img').attr('src', 'data:' + portfolio_image_type_1['F_img'] + ';base64,' + portfolio_image_1);
        $('#sec_show_port_img').attr('src', 'data:' + portfolio_image_type_2['F_img'] + ';base64,' + portfolio_image_2);
        $('#third_show_port_img').attr('src', 'data:' + portfolio_image_type_3['F_img'] + ';base64,' + portfolio_image_3); */

    });

    $('#update_landing').on('click', function (e) {
        e.preventDefault();

        $landing_section = {
            "landing_subtitle": $('#landing_subtitle').val()
        }

        $.post('../php/update_content.php?section=landing', $landing_section, function (res) {
            if (res == 1) {
                alertify.success("Se actualizo la seccion del inicio");
                $('#landing').collapse('hide');
            } else {
                alertify.error('Error al actualizar la seccion del inicio');
            }
        });
    })

    $('#update_about').on('click', function (e) {
        e.preventDefault();
        let frmData = new FormData;

        let social_media_link_1 = $('#social_media_link_1').val();
        let social_media_link_2 = $('#social_media_link_2').val();
        let social_media_link_3 = $('#social_media_link_3').val();

        let social_media_links = {
            "Facebook": social_media_link_1,
            "Instagram": social_media_link_2,
            "Whatsapp": social_media_link_3
        }

        frmData.append("about_img", $('#input_about_img')[0].files[0]);
        frmData.append("about_description", $('#about_description').val());
        frmData.append("facebook", social_media_link_1);
        frmData.append("instagram", social_media_link_2);
        frmData.append("whatsapp", social_media_link_3);

        $.ajax({
            url: '../php/update_content.php?section=about',
            type: 'post',
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                if (res === "1") {
                    alertify.success("Seccion actualizada correctamente");
                    $('#about').collapse('hide');
                } else if (res === "01") {
                    location.reload(true);
                } else {
                    alertify.error("Error al actualizar la seccion");
                }
            }
        })

    });

    $('#update_services').on('click', function (e) {
        e.preventDefault();

        let services = {
            'Contabilidad': $('#service_contabilidad').val(),
            'Administracion': $('#service_administration').val(),
            'Reclutamiento': $('#service_recruitment').val()
        }

        $.post('../php/update_content.php?section=services', {
            services
        }, function (res) {
            console.log(res);
            if (res == "1") {
                alertify.success('Seccion actualizada correctamente');
                $('#services').collapse('hide');
            } else {
                alertify.error('Error al actualizar la seccion');
            }
        });
    });

    $('#update_portfolio').on('click', function (e) {
        e.preventDefault();
        let frmData = new FormData;

        frmData.append("first_port_title", $('#first_port_title').val());
        frmData.append("sec_port_title", $('#sec_port_title').val());
        frmData.append("third_port_title", $('#third_port_title').val());

        frmData.append("first_port_subtitle", $('#first_port_title').val());
        frmData.append("sec_port_subtitle", $('#sec_port_title').val());
        frmData.append("third_port_subtitle", $('#third_port_title').val());

        frmData.append("first_port_description", $('#first_port_description').val());
        frmData.append("sec_port_description", $('#sec_port_description').val());
        frmData.append("third_port_description", $('#third_port_description').val());

        frmData.append("first_port_link", $('#first_port_link').val());
        frmData.append("sec_port_link", $('#sec_port_link').val());
        frmData.append("third_port_link", $('#third_port_link').val());

        frmData.append("portfolio_image_1", $('#first_port_img')[0].files[0]);
        frmData.append("portfolio_image_2", $('#sec_port_img')[0].files[0]);
        frmData.append("portfolio_image_3", $('#third_port_img')[0].files[0]);

        $.ajax({
            url: '../php/update_content.php?section=portfolio',
            type: 'post',
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {
                console.log(res);
                if (res === "1") {
                    alertify.success('Seccion actualizada correctamente');
                } else if(res === "01") {
                    alertify.success('Seccion actualizada correctamente');
                    location.reload(true);
                } else {
                    alertify.error('Error al actualizar la seccion');
                }
            }
        });
    });

});