<?php

$getHeaderMeta = function() {
    $header['title'] = "Спасибо за покупку - прокат Prokatit. Заказ успешно выполнен.";
    $header['description'] = "Заказ успешно выполнен. Благодарность prokatit - прокат приставок, отдыха и туризма по Беларуси.";
    $header['keyWords'] = "оформлено, успешно, заказ, prokatit, приставки, отдых, палатки, велосипеды.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL ."socials/cart.jpg";
    $header['type'] = "website";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        //"validator/js/validator.js",
    );

    $resources["styles"] = array(
        //"animate/animate.css",
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
    );

    return $partials;
};