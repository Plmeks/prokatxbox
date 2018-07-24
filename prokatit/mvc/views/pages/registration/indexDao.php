<?php

function getHeaderMeta() {
    $header['title'] = "Home";
    $header['description'] = "Description";
    $header['keyWords'] = "Key words";

    return $header;
}

function getResources() {
    $resources["scripts"] = array(
        "formValidator/js/formValidation.js",
        "formValidator/js/framework/bootstrap.js"   // для валидатора

    );

    $resources["styles"] = array(
        "formValidator/css/formValidation.css",
    );

    return $resources;
}

function getPartials() {
    $partials = array(
        //array("name" => "first"),
    );

    return $partials;
}

