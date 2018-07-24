<?php

$getHeaderMeta = function() {
    $header['title'] = "Авторизация"; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = "авторизация, прокат";
    $header['keyWords'] = "авторизация";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        //"validator/js/validator.js",
    );

    $resources["styles"] = array(
        //"animate/animate.css",
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
        //array("name" => "first"),
    );

    return $partials;
};