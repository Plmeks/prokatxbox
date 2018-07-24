<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" type="image/png" href="<?= URL .PROJECT; ?>favicon.png" />

    <title><?php echo $this->header['title'];?></title>

    <script type="text/javascript" src="<?= URL .PROJECT;?>core/scripts/frameworks/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?= URL .PROJECT;?>core/scripts/frameworks/bootstrap/js/bootstrap.js"></script>

    <link href="<?= URL .PROJECT;?>core/scripts/frameworks/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

    <?php
    $style = "content/css/" .$this->viewConfig["contentPath"] .".css";
    $script = "scripts/build/" .$this->viewConfig["contentPath"] .".js";

    if(file_exists($style))
        echo "<link rel='stylesheet' type='text/css' href=" .URL .$style .">";

    if(file_exists($script))
        echo "<script type='text/javascript' src='" .URL .$script ."'></script>";

    if(isset($this->resources["styles"]))
        foreach($this->resources["styles"] as $styles)
            echo "<link rel=stylesheet type=text/css href=" .URL ."scripts/frameworks/" .$styles ." />";

    if(isset($this->resources["scripts"]))
        foreach($this->resources["scripts"] as $scripts)
            echo "<script type=text/javascript src=" .URL ."scripts/frameworks/" .$scripts ." /></script>";

    if(isset($this->header['description'])){
        echo "<meta name='description' content='" .$this->header['description'] ."'>";
        echo "<meta name='abstract' content='" .$this->header['description'] ."'>";
    } else {
        echo "<meta name='description' content='description'>";
        echo "<meta name='abstract' content='abstract'>";
    }

    if(isset($this->header['keyWords'])){
        echo "<meta name='keywords' content='" .$this->header['keyWords'] ."'>";
    } else {
        echo "<meta name='keywords' content='keywords'>";
    }
    ?>

    <meta name = "robots" content = "index,follow" />
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php $this->generateBody(); ?>
    </div>
</div>
</body>
</html>