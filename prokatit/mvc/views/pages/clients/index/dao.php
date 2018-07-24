<?php

$getHeaderMeta = function() {
//    $header['title'] = "Статьи для клиентов. Правила проката, договор аренды, скидки и акции. Условия проката и гарантии. Быстрая доставка.";
//    $header['description'] = "Статьи для клиентов проката Prokatit. Правовая оферта, условия аренды и правила поведения.
//    Условия проката, безопасность и наши гарантии клиентам. Условия доставки. Скидки и акции";
//    $header['keyWords'] = "правила, статьи, клиенты, доставка, договор аренды, скидки, акции, гарантии, безопасность, условия.";

    $header['title'] = $this->viewBag['clients']['paper']["name"] .". Информация для наших клиентов. Prokatit - доступный прокат в Беларуси." ; // or $this->viewConfig["action"] or $this->viewBag['product']['name'];
    $header['description'] = $this->viewBag['clients']['paper']["name"] ." - статья для клиентов проката Prokatit. Раздел полезных статей.";
    $header['keyWords'] = mb_strtolower($this->viewBag['clients']['paper']["name"], 'utf8') .", правила, статьи, клиенты, прокат, гомель, prokatit, доставка, договор аренды, гарантии, безопасность, условия.";

    $header['url'] = FULL_URL;
    $header['image'] = IMG_URL ."socials/articles.jpg";
    $header['type'] = "article";

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
