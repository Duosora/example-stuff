$(document).ready(function () { 
    //Tooltip 
    $('[data-toggle="tooltip"]').tooltip(); 
 
    //Image Lazy Load 
    $('.lazy').Lazy({ 
        // your configuration goes here 
        scrollDirection: 'vertical', 
        effect: 'fadeIn', 
        visibleOnly: true, 
        afterLoad: function (element) { 
            element.removeClass("lazy"); 
        }, 
        onError: function (element) { 
            console.log('Error loading ' + element.data('src')); 
            element.removeClass("lazy");
            element.addClass("error-image");
            element.attr("src",'/assets/img/image-missing.png'); 
        }, 
    }); 
    $(".lazy").Lazy(); 
 
    //Copy current url 
    $('#url_post_detail').val(document.location.href); 
 
    //Carousel Buttons 
    $('.responsive-featured').slick({ 
        dots: true, 
        infinite: false, 
        speed: 300, 
        slidesToShow: 4, 
        slidesToScroll: 4, 
        prevArrow: $(".prev-0"), 
        nextArrow: $(".next-0"), 
        responsive: [{ 
                breakpoint: 1024, 
                settings: { 
                    slidesToShow: 3, 
                    slidesToScroll: 3, 
                    infinite: true, 
                    dots: true 
                } 
            }, 
            { 
                breakpoint: 600, 
                settings: { 
                    slidesToShow: 2, 
                    slidesToScroll: 2, 
                    swipe: true, 
                    dots: true 
                } 
            }, 
            { 
                breakpoint: 480, 
                settings: { 
                    slidesToShow: 1, 
                    slidesToScroll: 1, 
                    swipe: true, 
                    dots: true 
                } 
            } 
        ] 
    }); 
    $('.prev').on('click touchstart', function (e) { 
        e.preventDefault(); 
        $('.responsive-featured').slick('slickPrev'); 
    }) 
 
    $('.next').on('click touchstart', function (e) { 
        e.preventDefault(); 
        $('.responsive-featured').slick('slickNext'); 
    }) 
 
    $('#text-body').find('a').each(function() { 
        if($(this).attr('href') !== window.location.origin){ 
            $(this).attr('rel', 'noopener noreferrer nofollow'); 
            $(this).attr('target', '_blank'); 
        } 
    }); 
 
}); 
 
//Copy current url 
var copy = function copy(elementId) { 
 
    var input = document.getElementById(elementId); 
    var isiOSDevice = navigator.userAgent.match(/ipad|iphone/i); 
 
    if (isiOSDevice) { 
 
        var editable = input.contentEditable; 
        var readOnly = input.readOnly; 
 
        input.contentEditable = true; 
        input.readOnly = false; 
 
        var range = document.createRange(); 
        range.selectNodeContents(input); 
 
        var selection = window.getSelection(); 
        selection.removeAllRanges(); 
        selection.addRange(range); 
 
        input.setSelectionRange(0, 999999); 
        input.contentEditable = editable; 
        input.readOnly = readOnly; 
 
        document.execCommand('copy'); 
    } else { 
        input.select(); 
        document.execCommand('copy'); 
    } 
    $('#copy-link-button').parent().append("<div class='alert alert-success alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Copied to clipboard.</div>"); 
} 