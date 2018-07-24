$(document).ready(function(){

    var firstCity = $('#content-cities button')[0];
    var currentCoords = {
        lat: parseFloat($(firstCity).attr('lat')),
        lng: parseFloat($(firstCity).attr('lng'))
    };

    $(firstCity).addClass('selected');

    var standartZoom = 17;
    var noAddressZoom = 12;

    var cityMap = new GMaps({
        div: '#city-map',
        zoom: standartZoom,
        click: function(e) {
            cityMap.setOptions({scrollwheel: true});
            cityMap.hideInfoWindows();
        },
        drag: function(e) {
            cityMap.setOptions({scrollwheel: true});
            cityMap.hideInfoWindows();
        },
        mouseout: function(e) {
            cityMap.setOptions({scrollwheel: false});
            cityMap.hideInfoWindows();
        },
        scrollwheel: false,
        lat: currentCoords.lat,
        lng: currentCoords.lng
    });

    cityMap.addMarker({
        lat: currentCoords.lat,
        lng: currentCoords.lng,
        title: 'Prokatit ' + $(firstCity).text().trim(),
        infoWindow: {
            content: '<p class="marker">Выгодный прокат приставок, снаряжения для туризма и велосипедов в городе ' +
                $(firstCity).text().trim() + ', Республика Белурсь.</p>'
        }
    });

    $( window ).resize(function() {
        cityMap.setCenter({
            lat: currentCoords.lat,
            lng: currentCoords.lng
        });
    });



    $('#content-cities button').click(function(e){
        var button = e.target;
        $('#content-cities .item').each(function(index, element) {
            $(element).removeClass('show');
        });
        $("#" + button.name).addClass('show');

        $('#content-cities button').each(function(index, element) {
            $(element).removeClass('selected');
        });
        $(button).addClass('selected');

        currentCoords = {
            lat: parseFloat($(button).attr('lat')),
            lng: parseFloat($(button).attr('lng'))
        };


        if(currentCoords) {
            cityMap.addMarker({
                lat: currentCoords.lat,
                lng: currentCoords.lng,
                title: 'Prokatit ' + $(button).text().trim(),
                infoWindow: {
                    content: '<p class="marker">Выгодный прокат приставок, снаряжения для туризма и велосипедов в городе ' +
                        $(button).text().trim() + ', Республика Белурсь.</p>'
                }
            });

            if($(button).attr('no-address')) {
                cityMap.setZoom(noAddressZoom);
            } else {
                cityMap.setZoom(standartZoom);
            }

            cityMap.setCenter({
                lat: currentCoords.lat,
                lng: currentCoords.lng
            });
        }
    });

});