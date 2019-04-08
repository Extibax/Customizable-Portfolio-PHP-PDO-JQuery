let menu_toggler = $('.menu-toggler')[0];
let sticky = menu_toggler.offsetTop;

$(document).ready(function () {

    $(this).scroll(function () {
        if (window.pageYOffset > sticky) {
            menu_toggler.classList.add("sticky");
        } else {
            menu_toggler.classList.remove("sticky");
        }
    });

    $('.menu-toggler').on('click', function () {
        $(this).toggleClass('open');
        $('.top-nav').toggleClass('open');
    });

    $('.top-nav .nav-link').on('click', function() {
        $('.menu-toggler').removeClass('open');
        $('.top-nav').removeClass('open');
    });

    $('nav a[href*="#"]').on('click', function() {
        $('html, body').animate(keyframes = {
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, options = 2000);
    });

    $('#btn-start').on('click', () => {
        $('html, body').animate(keyframes = {
            scrollTop: $('#about').offset().top - 100
        }, options = 2000);
    })

    $('#up').on('click', function() {
        $('html, body').animate(keyframes = {
            scrollTop: 0
        }, options = 2000);
    });

    AOS.init({
        easing: 'ease',
        duration: 1800,
        once: true
    });

});