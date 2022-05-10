jQuery(document).ready(function ($) {

    function scrollNav() {
        if ($(window).scrollTop() >= 500) {
            $('.fixed-bar').removeClass('fadeOutUp').show().addClass('fadeInDown')

        } else {
            $('.fixed-bar').removeClass('fadeInDown').addClass('fadeOutUp')
        }


        if ($(window).scrollTop() <= 50) {
            $('.fixed-bar').css('z-index', '-1');
        } else {
            $('.fixed-bar').css('z-index', '9999');
        }
    }

    $(window).scroll(function () {
        scrollNav()
    })


    $("html").on("click", ".anchor_link", function (event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });


    $('#hamb_button').click(function () {
        if ($(this).hasClass('is-active')) {
            $('.bg').removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
        } else {
            $('.bg').addClass('active')
            $('.mobile_menu').addClass('active')
            $('#hamb_button').addClass('is-active')
        }
    })
    $(window).resize(function () {

        if ($(window).width() >= 768) {
            $('.bg').removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
        } else {
            $('#menu-header-menu .parent span').html('<i class="fal fa-angle-left"></i>')
        }
    })


    $('.bg').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
        }

    })

    $('li.has-child span').click(function () {
        if (
            $(this).closest("li.has-child").hasClass("active")) {
            $(this).closest("li.has-child").removeClass("active");
            $(this).closest("li.has-child").find(".sub-menu").slideUp();
        } else {
            $('li.has-child').removeClass("active");
            $(this).closest("li.has-child").toggleClass("active");
            $('li.has-child span').closest("li.has-child").find(".sub-menu").slideUp();
            $(this).closest("li.has-child").find(".sub-menu").slideDown();
        }
    })

    $('.btn_main.btn_orange, .btn_main.btn_white').append('<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M9.75 1.03125V7.59375C9.75 7.97656 9.44922 8.25 9.09375 8.25C8.71094 8.25 8.4375 7.97656 8.4375 7.59375V2.61719L2.12109 8.93359C1.98438 9.07031 1.82031 9.125 1.65625 9.125C1.46484 9.125 1.30078 9.07031 1.19141 8.93359C0.917969 8.6875 0.917969 8.27734 1.19141 8.03125L7.50781 1.6875H2.53125C2.14844 1.6875 1.875 1.41406 1.875 1.03125C1.875 0.675781 2.14844 0.375 2.53125 0.375H9.09375C9.44922 0.375 9.75 0.675781 9.75 1.03125Z"/>\n' +
        '</svg>');
});

//Scrip for Snazzy Map
function new_map($el, snazzystyles) {
    var $markers = $el.find('.marker');
    var args = {
        zoom: zooms,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: snazzystyles
    };
    var map = new google.maps.Map($el[0], args);
    map.markers = [];
    $markers.each(function () {
        add_marker(jQuery(this), map);
    });
    center_map(map);
    return map;
}

function add_marker($marker, map) {
    var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
    var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
    });
    var pinColor = "176883";
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
    });
    marker.setIcon(pinImage);
    // add to array
    map.markers.push(marker);
    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function () {

            infowindow.open(map, marker);

        });
    }

}

function center_map(map) {
    var bounds = new google.maps.LatLngBounds();
    jQuery.each(map.markers, function (i, marker) {
        var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
        bounds.extend(latlng);
    });
    if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());
        map.setZoom(zooms);
    } else {
        map.fitBounds(bounds);
    }
}

//end script for Snazzy map



