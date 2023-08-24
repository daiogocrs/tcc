$(document).ready(function() {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 2,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    $('.category-buttons .nav-link').on('click', function() {
        $('.category-buttons .nav-link').removeClass('active');
        $(this).addClass('active');

        var target = $(this).attr('href');
        $('.tab-pane').removeClass('show active');
        $(target).addClass('show active');
    });
});