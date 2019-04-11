$(document).ready(function () {
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

        /* let social_media_links = {
            "Facebook": social_media_link_1,
            "Instagram": social_media_link_2,
            "Whatsapp": social_media_link_3
        } */

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

        frmData.append("portfolio_image_1", $('#input_portfolio_image_file_1')[0].files[0]);
        frmData.append("portfolio_image_2", $('#input_portfolio_image_file_2')[0].files[0]);
        frmData.append("portfolio_image_3", $('#input_portfolio_image_file_3')[0].files[0]);

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
                } else if (res === "01") {
                    alertify.success('Seccion actualizada correctamente');
                    location.reload(true);
                } else {
                    alertify.error('Error al actualizar la seccion');
                }
            }
        });
    });
});