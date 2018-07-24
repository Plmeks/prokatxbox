<?
define("DEFAULT_LAYOUT_VIEW", "landing");

define("BUILD", false);                                  // билд для всего. от этого будет зависеть, будет ли билдиться хоть что-нибудь ниже

define("IS_AUTOMATICALLY_GENERATE_MODEL_FILES", true);

define("IS_GENERATE_VIEW_FILES", true);         // генерация обычных вьюх, берущихся из названий методов в контроллере
define("IS_GENERATE_DAO_PAGE_FILES", true);             // генерация dao-вьюх, берущихся из названий методов в контролере
define("IS_GENERATE_GLOBAL_DAO_PAGE_FILES", true);             // генерация dao-вьюх, берущихся из названий методов в контролере
define("IS_GENERATE_PARTIAL_FILES", true);             // генерация вью-блоков из массива elements в Dao-view-файлах

define("IS_GENERATE_STYLE_LAYOUT_FILES", true);
define("IS_GENERATE_STYLE_VIEW_FILES", true);
define("IS_GENERATE_STYLE_VIEW_GLOBAL_FILES", true);
define("IS_GENERATE_STYLE_PARTIAL_VIEW_FILES", true);            // генерация стилей из массива partials в Dao-view-файлах
define("IS_GENERATE_STYLE_CUSTOM_FILES", true);          // генерация общих стилей: customize, global-mixins, global-styles


define("MINIFY_SCRIPTS", false);
define("IS_GENERATE_SCRIPT_LAYOUT_FILES", true);
define("IS_GENERATE_SCRIPT_VIEW_FILES", true);
define("IS_GENERATE_SCRIPT_PARTIAL_VIEW_FILES", true);
define("IS_GENERATE_SCRIPT_CUSTOM_FILES", true);         //

define("SAMPLE_FOR_GENERATING_SIMPLE_VIEWS", "");       // название генерируемого шаблона для обычных вьюх, находящегося в libs/fileManager/samples
define("SAMPLE_FOR_GENERATING_DAO_VIEWS", "viewDao");   // название генерируемого шаблона для dao-вьюх, находящегося в libs/fileManager/samples
define("SAMPLE_FOR_GENERATING_PARTIAL_VIEWS", "");      // название генерируемого шаблона для вью-блоков, находящегося в libs/fileManager/samples
