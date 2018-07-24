<?php
    class FileManager {
        public function buildModel($modelName) {
            if(IS_AUTOMATICALLY_GENERATE_MODEL_FILES) {
                $modelFolderPath = PROJECT ."mvc/models/";
                $modelFilePath = $modelFolderPath .$modelName ."Model.php";

                $this->createFolder($modelFolderPath);

                file_put_contents($modelFilePath, "<?php\r\n class " .$modelName ."Model extends Model {\r\n }");
            }
        }

        public function buildViewControl($controllerInfo){
            $viewFolder = PROJECT ."mvc/views/pages/" .$controllerInfo["name"] ."/" .$controllerInfo["action"] ."/";
            $this->createFolder($viewFolder);

            if(IS_GENERATE_VIEW_FILES){
                $viewFile = $viewFolder ."index.php";

                if(!file_exists($viewFile)) {
                    $viewsControlSamplePath = "core/libs/fileManager/samples/views/" .SAMPLE_FOR_GENERATING_SIMPLE_VIEWS .".php";
                    if(file_exists($viewsControlSamplePath))
                        $sample = file_get_contents($viewsControlSamplePath);
                    else
                        $sample = "";
                    file_put_contents($viewFile, $sample);
                }
            }

            if(IS_GENERATE_DAO_PAGE_FILES) {
                /*if(IS_GENERATE_GLOBAL_DAO_PAGE_FILES) {
                    $pageGlobalDaoFile = $viewFolder ."globalDao.php";
                    if(!file_exists($pageGlobalDaoFile)) {
                        $viewsControlDaoSamplePath = "core/libs/fileManager/samples/views/" .SAMPLE_FOR_GENERATING_DAO_VIEWS .".php";
                        if(file_exists($viewsControlDaoSamplePath))
                            $sample = file_get_contents($viewsControlDaoSamplePath);
                        else
                            $sample = "";
                        file_put_contents($pageGlobalDaoFile, $sample);
                    }
                }*/

                $viewDaoFile = $viewFolder ."dao.php";
                if(!file_exists($viewDaoFile)) {
                    $viewsControlDaoSamplePath = "core/libs/fileManager/samples/views/" .SAMPLE_FOR_GENERATING_DAO_VIEWS .".php";
                    if(file_exists($viewsControlDaoSamplePath))
                        $sample = file_get_contents($viewsControlDaoSamplePath);
                    else
                        $sample = "";
                    file_put_contents($viewDaoFile, $sample);
                }
            }
        }

        public function buildPage($partials, $controllerInfo){
            if(IS_GENERATE_PARTIAL_FILES)
                $this->buildViewPartial($partials, $controllerInfo);

            $this->buildStyles($partials, $controllerInfo);
            $this->buildScripts($partials, $controllerInfo);
        }

        public function buildViewPartial($partials, $controllerInfo){
            if(!empty($partials))
                foreach($partials as $val){
                    if(!isset($val["name"]))
                        continue;

                    $partialFolder = PROJECT ."mvc/views/partials/";
                    $partialFileFolder = $partialFolder. dirname($val["name"]);
                    $partialFile = $partialFileFolder ."/" .basename($val["name"]) .".php";

                    if(!file_exists($partialFile)) {
                        $viewPartialSamplePath = "core/libs/fileManager/samples/viewsPartial/" .SAMPLE_FOR_GENERATING_PARTIAL_VIEWS .".php";
                        if(file_exists($viewPartialSamplePath))
                            $sample = file_get_contents($viewPartialSamplePath);
                        else
                            $sample = "";   // не лучшее решение

                        $this->createFolder($partialFileFolder);
                        file_put_contents($partialFile, "<section id='" /*.$val["name"]*/ ."'>\r\n" .$sample ."\r\n</section>");
                    }
                }
        }

        public function buildStyles($styles, $controllerInfo){
            $lessFolder = PROJECT ."content/less/";

            $options = array('compress' => true);
            $parser = new Less_Parser($options);

            // Custom styles
            if(IS_GENERATE_STYLE_CUSTOM_FILES) {
                // if не существует таких, то создаем
                $parser->parseFile("core/content/less/global/mixins.less");
                $parser->parseFile("core/content/less/global/styles.less");
                $parser->parseFile(PROJECT ."content/less/global/main.less");
            }

            // Layout styles
            $layoutStyleFolder = $lessFolder ."views/layouts/";
            $layoutStyleFile = $layoutStyleFolder ."/" .$controllerInfo['layout'] .".less";

            if(file_exists($layoutStyleFile)) {
                $parser->parseFile($layoutStyleFile);
            } else if(IS_GENERATE_STYLE_LAYOUT_FILES){
                $this->createFolder($layoutStyleFolder);
                file_put_contents($layoutStyleFile, "");
                $parser->parseFile($layoutStyleFile);
            }

            // View styles
            $simpleViewStyleFolder = $lessFolder ."views/pages/" .$controllerInfo['name'];
            $simpleViewStyleFile = $simpleViewStyleFolder ."/" .$controllerInfo['action'] .".less";
            $simpleViewStyleFileGlobal = $simpleViewStyleFolder ."/global.less";

            if(file_exists($simpleViewStyleFile)) {
                $parser->parseFile($simpleViewStyleFile);
            } else if(IS_GENERATE_STYLE_VIEW_FILES){
                $this->createFolder($simpleViewStyleFolder);
                file_put_contents($simpleViewStyleFile, "");
                $parser->parseFile($simpleViewStyleFile);
            }

            if(file_exists($simpleViewStyleFileGlobal)) {
                $parser->parseFile($simpleViewStyleFileGlobal);
            }
            else if(IS_GENERATE_STYLE_VIEW_GLOBAL_FILES){
                $this->createFolder($simpleViewStyleFolder);
                file_put_contents($simpleViewStyleFileGlobal, "");
                $parser->parseFile($simpleViewStyleFileGlobal);
            }

            //Parital styles
            if(!empty($styles))
                foreach($styles as $val) {
                    if(!isset($val["name"]))
                        continue;

                    $partialViewStyleFolder = $lessFolder ."views/partials/";
                    $partialViewStyleFileFolder = $partialViewStyleFolder .dirname($val["name"]);
                    $partialViewStyleFile = $partialViewStyleFileFolder ."/" .basename($val["name"]) .".less";

                    if(file_exists($partialViewStyleFile)) {
                        $parser->parseFile($partialViewStyleFile);
                    } else if(IS_GENERATE_STYLE_PARTIAL_VIEW_FILES){
                        $this->createFolder($partialViewStyleFileFolder);
                        file_put_contents($partialViewStyleFile, "/*#" .$val['name'] ." { \r\n }*/");
                        $parser->parseFile($partialViewStyleFile);
                    }
                }

            $cssString = $parser->getCss();

            if(!empty($cssString)) {
                $pathBuildCss = PROJECT ."build/css/" .$controllerInfo["name"];
                $buildCss = $pathBuildCss ."/" .$controllerInfo["action"]. ".css";

                $this->createFolder($pathBuildCss);
                file_put_contents($buildCss, $cssString);
            }
        }



        public function buildScripts($scripts, $controllerInfo){
            $scriptString;
            $scriptFolder = PROJECT ."scripts/";

            if(IS_GENERATE_SCRIPT_CUSTOM_FILES) {
                $customScriptFolder = $scriptFolder ."global/";
                $customScriptFile = $customScriptFolder ."globalize.js";

                if(file_exists($customScriptFile)) {
                    $scriptString .= file_get_contents($customScriptFile) .PHP_EOL;
                } else {
                    $this->createFolder($customScriptFolder);
                    file_put_contents($customScriptFile, "$(document).ready(function(){\r\n});");
                    $scriptString .= file_get_contents($customScriptFile) .PHP_EOL;
                }
            }

            // Layout scripts
            $layoutScriptFolder = $scriptFolder ."views/layouts/";
            $layoutScriptFile = $layoutScriptFolder ."/" .$controllerInfo['layout'] .".js";

            if(file_exists($layoutScriptFile)) {
                $scriptString .= file_get_contents($layoutScriptFile) .PHP_EOL;
            } else if(IS_GENERATE_SCRIPT_LAYOUT_FILES){
                $this->createFolder($layoutScriptFolder);
                file_put_contents($layoutScriptFile, "$(document).ready(function(){\r\n});");
                $scriptString .= file_get_contents($layoutScriptFile) .PHP_EOL;
            }

            // View scripts
            $simpleViewScriptFolder = $scriptFolder ."views/pages/" .$controllerInfo['name'];
            $simpleViewScriptFile = $simpleViewScriptFolder ."/" .$controllerInfo['action'] .".js";

            if(file_exists($simpleViewScriptFile)) {
                $scriptString .= file_get_contents($simpleViewScriptFile) .PHP_EOL;
            } else if(IS_GENERATE_SCRIPT_VIEW_FILES){
                $this->createFolder($simpleViewScriptFolder);
                file_put_contents($simpleViewScriptFile, "$(document).ready(function(){\r\n});");
                $scriptString .= file_get_contents($simpleViewScriptFile) .PHP_EOL;
            }

            // Partial scripts
            if(!empty($scripts))
                foreach($scripts as $val){
                    if(!isset($val["name"]))
                        continue;

                    $partialViewScriptFolder = $scriptFolder ."views/partials/";
                    $partialViewScriptFileFolder = $partialViewScriptFolder .dirname($val["name"]);
                    $partialViewScriptFile = $partialViewScriptFileFolder ."/" .basename($val["name"]) .".js";

                    if(file_exists($partialViewScriptFile)) {
                        $scriptString .= file_get_contents($partialViewScriptFile) .PHP_EOL;
                    } else if(IS_GENERATE_SCRIPT_PARTIAL_VIEW_FILES){
                        $this->createFolder($partialViewScriptFileFolder);
                        file_put_contents($partialViewScriptFile, "$(document).ready(function(){\r\n});");
                        $scriptString .= file_get_contents($partialViewScriptFile) .PHP_EOL;
                    }
                }

            $trimResult = trim($scriptString);
            if(!empty($trimResult)) {
                $pathBuildScripts = PROJECT ."build/scripts/" .$controllerInfo["name"];
                $buildScripts = $pathBuildScripts ."/" .$controllerInfo["action"]. ".js";

                $this->createFolder($pathBuildScripts);

                if(MINIFY_SCRIPTS)
                    $scriptString = JShrink\Minifier::minify($scriptString);

                file_put_contents($buildScripts, $scriptString);
            }
        }

        private function createFile() {

        }

        public function createFolder($path){
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
                return true;
            }
            return false;
        }

        public function removeFolder($path) {
            if (is_dir($path) === true)
            {
                $files = array_diff(scandir($path), array('.', '..'));

                foreach ($files as $file)
                {
                    $this->removeFolder(realpath($path) . '/' . $file);
                }

                return rmdir($path);
            }

            else if (is_file($path) === true)
            {
                return unlink($path);
            }

            return false;
        }
    }