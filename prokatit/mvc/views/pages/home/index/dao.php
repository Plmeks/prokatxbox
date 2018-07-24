<?php

$getHeaderMeta = function() {
    $header['title'] = "Сайт выгодного проката приставок, товаров отдыха и туризма в Беларуси.";
    $header['description'] = "Prokatit - дешевый прокат приставок Xbox 360 + Kinect, Ps4 Pro + PlayStation VR. Аренда телевизора с проектором. Прокат велосипедов, палаток, Go Pro. Доставка до двери.";
    $header['keyWords'] = "прокат, аренда, приставка, техника, Xbox 360 Kinect, Ps4 PRO, PlayStation VR, велосипед, палатка, go pro, телевизор, проектор, беларусь, гомель, витебск, минск, жлобин.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL ."socials/prokatit.png";
    $header['type'] = "website";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        "gmaps/gmaps.js",
        "validator/js/validator.js",
        "owl.carousel/owl.carousel.js",
        "mask/mask.js",
        "moment/moment-with-locales.js",
        "bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js",
    );

    $resources["styles"] = array(
        "animate/animate.css",
        "owl.carousel/assets/owl.carousel.css",
        "bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
        array("name" => "modals/fastOrder"),
        array("name" => "content/landing"),
        array("name" => "content/modal"),
        array("name" => "content/popular"),
        array("name" => "content/info"),
        array("name" => "content/email"),
        array("name" => "content/cities"),
        array("name" => "content/reviews"),
    );

    return $partials;
};
