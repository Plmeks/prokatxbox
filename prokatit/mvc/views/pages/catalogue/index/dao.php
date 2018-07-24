<?php

$getHeaderMeta = function() {
    $header['title'] = "Раздел " .mb_strtolower($this->viewBag['catalogue']['currentBranch']["name"], 'utf8') .". Каталог Prokatit - выгодный прокат в Беларуси." ; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = $this->viewBag['catalogue']['currentBranch']["description"] .". Прокат товаров из раздела " .mb_strtolower($this->viewBag['catalogue']['currentBranch']["name"], 'utf8') .".";
    $header['keyWords'] = mb_strtolower($this->viewBag['catalogue']['currentBranch']["name"], 'utf8') .", каталог, категория, раздел, прокат, аренда, prokatit, приставки, отдых, палатки, велосипеды, гомель, минск, витебск, жлобин, доставка.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL .$this->viewBag['catalogue']['currentBranch']["image"];
    $header['type'] = "product";

    return $header;
};

$getResources = function() {
    $resources["scripts"] = array(
        "vk/openapi.js",
        "bootstrapTree/js/bootstrap-treeview.js"
    );

    $resources["styles"] = array(
        "bootstrapTree/css/bootstrap-treeview.css"
    );

    return $resources;
};

$getPartials = function() {
    $partials = array(
    );

    return $partials;
};