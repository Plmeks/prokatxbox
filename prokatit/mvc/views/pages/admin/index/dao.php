<?php

$getHeaderMeta = function() {
    $header['title'] = "Подсказки админки"; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = "Советы и подсказки в админке";
    $header['keyWords'] = "админка, советы, подсказки";

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