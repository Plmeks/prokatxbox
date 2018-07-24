<?
$style = PROJECT. "build/css/" .$this->viewConfig["contentPath"] .".css";
$script = PROJECT. "build/scripts/" .$this->viewConfig["contentPath"] .".js";

if(file_exists($style))
    echo "<link rel='stylesheet' type='text/css' href=" .URL .$style .">";

if(file_exists($script))
    echo "<script type='text/javascript' src='" .URL .$script ."'></script>";

if(isset($this->resources["styles"]))
    foreach($this->resources["styles"] as $styles)
        echo "<link rel=stylesheet type=text/css href=" .URL ."core/scripts/frameworks/" .$styles ." />";

if(isset($this->resources["scripts"]))
    foreach($this->resources["scripts"] as $scripts)
        echo "<script type=text/javascript src=" .URL ."core/scripts/frameworks/" .$scripts ." /></script>";

?>
