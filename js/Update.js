$(document).ready(function () {

    $('#update_landing').on('click', function (e) {

        e.preventDefault();

        let landing_section = {
            "landing_subtitle": $('#input_landing_subtitle').val(),
            "landing_submit" : true
        }

        $.post('../php/update_content.php?section=landing', { landing_section } , function (res) {

            res = JSON.parse(res);

            if (res.Status) {

                swal({
                    title: "¡Actualizado con exito!",
                    text: res.Message,
                    icon: "success"
                }).then(function() {
                    $('#landing').collapse('hide');

                    setTimeout(function(){
                        window.location.reload(1);
                     }, 500);
                });

                

            } else {

                swal({
                    title: "Error al actualizar",
                    text: res.Message,
                    icon: "error"
                });

            }
        });
    })

    $('#update_about').on('click', function (e) {
        
        e.preventDefault();
        let frmData = new FormData;

        let input_social_media_link_facebook = $('#input_social_media_link_facebook').val();
        let input_social_media_link_instagram = $('#input_social_media_link_instagram').val();
        let input_social_media_link_whatsapp = $('#input_social_media_link_whatsapp').val();
        
        $('#input_about_image_content_1').val() ? frmData.append("about_image_content_1", $('#input_about_image_content_1')[0].files[0]) : "";
        var quill = new Quill('#input_about_description', {
            theme: 'snow'
        });
        frmData.append("about_description", quill.root.innerHTML);
        frmData.append("facebook", input_social_media_link_facebook);
        frmData.append("instagram", input_social_media_link_instagram);
        frmData.append("whatsapp", input_social_media_link_whatsapp);
        frmData.append("about_submit", true);

        $.ajax({
            url: '../php/update_content.php?section=about',
            type: 'POST',
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {

                res = JSON.parse(res);

                if (res.Status) {

                    swal({
                        title: "¡Actualizado con exito!",
                        text: res.Message,
                        icon: "success"
                    }).then(function() {
                        $('#about').collapse('hide');
    
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 500);
                    });
    
                } else {
    
                    swal({
                        title: "Error al actualizar",
                        text: res.Message,
                        icon: "error"
                    });
    
                }
            }
        })

    });

    $('#update_services').on('click', function (e) {

        e.preventDefault();

        let services = {
            "Contabilidad": $('#input_service_accounting').val(),
            "Administracion": $('#input_service_administration').val(),
            "Reclutamiento": $('#input_service_recruitment').val()
        }

        let services_submit = true;

        $.post('../php/update_content.php?section=services', {
            services, services_submit
        }, function (res) {

            res = JSON.parse(res);

            if (res.Status) {

                swal({
                    title: "¡Actualizado con exito!",
                    text: res.Message,
                    icon: "success"
                }).then(function() {
                    $('#services').collapse('hide');

                    setTimeout(function(){
                        window.location.reload(1);
                     }, 500);
                });

            } else {

                swal({
                    title: "Error al actualizar",
                    text: res.Message,
                    icon: "error"
                });

            }
        });
    });

    $('#update_portfolio').on('click', function (e) {

        e.preventDefault();
        let frmData = new FormData;

        frmData.append("first_portfolio_title", $('#input_first_portfolio_title').val());
        frmData.append("second_portfolio_title", $('#input_second_portfolio_title').val());
        frmData.append("third_portfolio_title", $('#input_third_portfolio_title').val());

        frmData.append("first_portfolio_subtitle", $('#input_first_portfolio_subtitle').val());
        frmData.append("second_portfolio_subtitle", $('#input_second_portfolio_subtitle').val());
        frmData.append("third_portfolio_subtitle", $('#input_third_portfolio_subtitle').val());

        frmData.append("first_portfolio_description", $('#input_first_portfolio_description').val());
        frmData.append("second_portfolio_description", $('#input_second_portfolio_description').val());
        frmData.append("third_portfolio_description", $('#input_third_portfolio_description').val());

        frmData.append("first_portfolio_link", $('#input_first_portfolio_link').val());
        frmData.append("second_portfolio_link", $('#input_second_portfolio_link').val());
        frmData.append("third_portfolio_link", $('#input_third_portfolio_link').val());

        $('#input_portfolio_image_content_1').val() ? frmData.append("portfolio_image_content_1", $('#input_portfolio_image_content_1')[0].files[0]) : "";
        $('#input_portfolio_image_content_2').val() ? frmData.append("portfolio_image_content_2", $('#input_portfolio_image_content_2')[0].files[0]) : "";
        $('#input_portfolio_image_content_3').val() ? frmData.append("portfolio_image_content_3", $('#input_portfolio_image_content_3')[0].files[0]) : "";

        frmData.append("portfolio_submit", true);

        $.ajax({
            url: '../php/update_content.php?section=portfolio',
            type: 'POST',
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (res) {

                res = JSON.parse(res);

                if (res.Status) {

                    swal({
                        title: "¡Actualizado con exito!",
                        text: res.Message,
                        icon: "success",
                    }).then(function() {
                        $('#portfolio').collapse('hide');
    
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 500);
                    });
    
                } else {
    
                    swal({
                        title: "Error al actualizar",
                        text: res.Message,
                        icon: "error"
                    });
    
                }
            }
        });
    });
});