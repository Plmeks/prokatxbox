<?php

$getHeaderMeta = function() {
    $header['title'] = "Прокат " .$this->viewBag['product'][0]['name'] ." в Беларуси." ; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = $this->viewBag['product'][0]['shortDescription'];
    $header['keyWords'] = $this->viewBag['product'][0]['name'] .", прокат, аренда, prokatit, гомель, минск, витебск, жлобин, доставка.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL .$this->viewBag['product'][0]['image'];
    $header['type'] = "product";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        "angularUtils/src/directives/pagination/dirPagination.js",
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