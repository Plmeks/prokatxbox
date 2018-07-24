<?php

$getHeaderMeta = function() {
    $header['title'] = "Home"; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = "Description";
    $header['keyWords'] = "Key words";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "formValidator/js/formValidation.js",
        "formValidator/js/framework/bootstrap.js"   // для валидатора
    );

    $resources["styles"] = array(
        "formValidator/css/formValidation.css",
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
        //array("name" => "first"),
    );

    return $partials;
};
