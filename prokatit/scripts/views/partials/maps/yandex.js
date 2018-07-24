﻿$(document).ready(function(){
    var myMap, placeMark;
    if ($('#yandexMap').length) {
        ymaps.ready(function () {
            myMap = new ymaps.Map("yandexMap", {
                center: [52.43023, 31.014311],
                zoom: 17
            });
            myMap.controls.add('zoomControl');

            placeMark = new ymaps.Placemark([52.43002, 31.014885], {
                hintContent: 'Prokatit Гомель',
                balloonContent: 'Прокат игровых приставок Xbox | PlayStation в Гомеле.'
            }, {
                preset: "twirl#redIcon"
            });

            myMap.geoObjects.add(placeMark);
        });
    }
});