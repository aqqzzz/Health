/**
 * Created by st0001 on 2016/10/17 0017.
 */



(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    $('.sports-sidebar').affix({
        offset: {
            top: 580
        }
    })

    $('.card').affix({
        offset: {
            top: 300
        }
    })

    /*$('.edit-message').affix({
        offset: {
            top:100
        }
    })*/
    // Initialize and Configure Scroll Reveal Animation
    window.sr = ScrollReveal();
    sr.reveal('.sr-icons', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 200);
    sr.reveal('.sr-button', {
        duration: 1000,
        delay: 200
    });
    sr.reveal('.sr-contact', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 300);

    // Initialize and Configure Magnific Popup Lightbox Plugin
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });

})(jQuery); // End of use strict

/*
/*隐藏侧边栏
$(function () {
    $('.toggle-nav').click(function(){
        toggleNavigation();
    })
})

function toggleNavigation(){
    if($('.interest').hasClass('display-nav')){
        $('.interest').removeClass('display-nav');
    } else {
        $('.interest').addClass('display-nav');
    }

    if($('.user').hasClass('display-nav')){
        $('.user').removeClass('display-nav');
    } else{
        $('.user').addClass('display-nav');
    }
}
*/

/**
 * 鼠标划过就展开子菜单，免得需要点击才能展开
 */
function dropdownOpen() {

    var $dropdownLi = $('li.dropdown');

    $dropdownLi.mouseover(function() {
        $(this).addClass('open');
    }).mouseout(function() {
        $(this).removeClass('open');
    });
}

$(document).ready(function () {
    $(document).off('click.bs.dropdown.data-api');
    dropdownOpen();
})

$(function () {
    $('.time-charts').highcharts({
        title: {
            text: '本周运动距离',
            x: -20 //center
        },
        subtitle: {
            text: '来自：追踪器',
            x: -20
        },
        xAxis: {
            categories: ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六',
                '星期天']
        },
        yAxis: {
            title: {
                text: '跑步距离(km)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'km'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name:'跑步距离',
            data: [7.0, 6.9, 9.5, 10.5, 3.2, 2.5, 0]
        }]
    });
});

$(function () {
    $('.calorie-charts').highcharts({
        chart: {
            type:'area'
        },
        title: {
            text: '本周运动燃烧热量',
            x: -20 //center
        },
        subtitle: {
            text: '来自：追踪器',
            x: -20
        },
        xAxis: {
            categories: ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六',
                '星期天']
        },
        yAxis: {
            title: {
                text: '燃烧热量(cal)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'cal'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name:'卡路里',
            data: [453, 655, 690, 755, 453 , 433, 366]
        }]
    });
});

$(function () {
    $('.body-charts').highcharts({
        title: {
            text: 'BMI变化表',
            x: -20 //center
        },
        xAxis: {
            categories: ['2016/10/01', '2016/10/08', '2016/10/15', '2016/10/21']
        },
        yAxis: {
            title: {
                text: 'BMI'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name:'BMI',
            data: [18.4, 18.7, 19.1, 19.1]
        }]
    });
});



