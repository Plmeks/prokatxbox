<?php

$getHeaderMeta = function() {
        $header['title'] = "Контакты Prokatit. Работаем в Гомеле, Минске, Витебске и Жлобине.";
    $header['description'] = "Телефоны проката Prokatit. Пункты в Гомеле, Минске, Витебске и Жлобине. Приставки любого поколения. Xbox, Playstation, игры и телевизоры. Товары туризма, велосипеды, палатки.";
    $header['keyWords'] = "контакты, телефон, группа, сеть, прокат, аренда, приставка, техника, беларусь, гомель, витебск, пинск, жлобин.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL ."socials/home.jpg";
    $header['type'] = "business.business";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        "gmaps/gmaps.js"
    );

    $resources["styles"] = array(
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
        array("name" => "content/email"),
        array("name" => "content/cities"),
    );

    return $partials;
};