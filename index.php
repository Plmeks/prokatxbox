<?php
    ini_set("display_errors", 1);

	include_once "core/mvc/model.php";
	include_once "core/mvc/view.php";
	include_once "core/mvc/controller.php";
	include_once "core/mvc/route.php";

    include_once "core/libs/dataBase/dataBase.php";
    include_once "core/libs/session/session.php";
    include_once "core/libs/lessCss/less.php";
    //include_once "libs/minifyJs/src/Minify.php";
    include_once "core/libs/mailer/PHPMailerAutoload.php";
    include_once "core/libs/sendMail/sendMail.php";
    include_once "core/libs/fileManager/fileManager.php";
    include_once "core/libs/transliteration/transliteration.php";
    include_once "core/libs/JShrink/src/JShrink/Minifier.php";

    include_once "config.php";

    Route::start();



