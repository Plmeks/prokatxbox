<?php

$getHeaderMeta = function() {
    $header['title'] = "Админка - товары"; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = "Добавление товаров в админке";
    $header['keyWords'] = "админка, товары";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "kendoUi/js/kendo.all.min.js"
        //"validator/js/validator.js",
    );

    $resources["styles"] = array(
        "kendoUi/styles/kendo.common-office365.min.css",
        "kendoUi/styles/kendo.rtl.min.css",
        "kendoUi/styles/kendo.office365.min.css",
        "kendoUi/styles/kendo.office365.mobile.min.css"
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