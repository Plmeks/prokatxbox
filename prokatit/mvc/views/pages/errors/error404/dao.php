<?php

$getHeaderMeta = function() {
    $header['title'] = "Home"; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = "Description";
    $header['keyWords'] = "Key words";

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
        array("name" => "navigations/navbar"),
        array("simpleView" => true),
        array("name" => "footers/stickyFooter"),
    );

    return $partials;
};