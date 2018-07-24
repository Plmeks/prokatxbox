<?php

$getHeaderMeta = function() {
    $header['title'] = "Корзина товаров Prokatit - выгодный прокат приставок и техники в Беларуси.";
    $header['description'] = "Корзина вещей для клиентов Prokatit. Оформить товар, выбрать товар в каталоге. Отменить заказ.";
    $header['keyWords'] = "корзина, заказ, оформление, дата заказа, стоимость, товары, техника, приставки, беларусь, велосипеды, палатки, go pro камеры.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL ."socials/cart.jpg";
    $header['type'] = "product.group";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        "datepicker/js/bootstrap-datepicker-custom.js",
        "datepicker/locales/bootstrap-datepicker.ru.min.js",
        "jsDate/date.js",
        "mask/mask.js",
        "moment/moment-with-locales.js",
        "bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js",
    );

    $resources["styles"] = array(
        "bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css"
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
    );

    return $partials;
};