$(document).ready(function () {

    $('.slider-row').slick({
        infinite: true,
        slidesToShow: 2,
        centerMode: true,
        centerPadding: '60px',
        slidesToScroll: 1,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 760,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    

    
})
