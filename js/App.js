/* Animations and Visual functions are created in this file */

$(document).ready(function () {

    $.post('php/close_session.php', function(res) {
        console.log('Session closed: ' + res);
    });

    let menu_toggler = $('.menu-toggler')[0];
    let sticky = menu_toggler.offsetTop;

    /* Hace que el menu toggler button se ancla en la pantalla al empezar a scrollear */
    $(this).scroll(function () {
        if (window.pageYOffset > sticky) {
            menu_toggler.classList.add("sticky");
        } else {
            menu_toggler.classList.remove("sticky");
        }
    });

    /* Muestra las secciones a las que se puede ir al presionar el menu toggler button */
    $('.menu-toggler').on('click', function () {
        $(this).toggleClass('open');
        $('.top-nav').toggleClass('open');
    });

    /* Oculta el menu al seleccionar algunas de las secciones*/
    $('.top-nav .nav-link').on('click', function () {
        $('.menu-toggler').removeClass('open');
        $('.top-nav').removeClass('open');
    });

    /* Se inicia una animacion dirigida a la seccion que se selecciono ir */
    $('nav a[href*="#"]').on('click', function () {
        $('html, body').animate(keyframes = {
            scrollTop: $($(this).attr('href')).offset().top - 40
        }, options = 2000);
    });

    /* Boton inicial para ir directamente a la seccion About */
    $('#btn-start').on('click', () => {
        $('html, body').animate(keyframes = {
            scrollTop: $('#about').offset().top - 40
        }, options = 2000);
    })

    /* Up botton, Para subir al top de la pagina al llegar al final */
    $('#up').on('click', function () {
        $('html, body').animate(keyframes = {
            scrollTop: 0
        }, options = 2000);
    });

    /* Se inicializa la libreria de animaciones AOS */
    AOS.init({
        easing: 'ease',
        duration: 1800,
        once: true
    });

});