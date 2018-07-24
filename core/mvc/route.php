<?php
class Route {
    // Возможны урлы:
    // visitka.loc/home
    // visitka.loc/home/index (this is the same)
    // visitka.loc/about
    // visitka.loc/home/about (this is the same)
    // visitka.loc/home?id=3
    // visitka.loc/home?id=3&name=max
    // visitka.loc/home/about?id=3&name=max
    // visitka.loc/home/about/id/3/name/max (the same)

    private static $fileManager;

    static function start(){
        $urlParent = "home";
        $urlChild = "index";

        self::$fileManager = new FileManager();

        $routes = explode("/", $_SERVER["REQUEST_URI"]);

        if(!empty($routes[1])) {
            $urlParent = strrpos($routes[1], "?") ? substr($routes[1], 0, strrpos($routes[1], "?")) : $routes[1];

            if(!empty($routes[2])){
                // Чтобы get-запросы работали
                $urlChild = strrpos($routes[2], "?") ? substr($routes[2], 0, strrpos($routes[2], "?")) : $routes[2];
            }
        }



        $checkMethod = self::methodCheck($urlParent, $urlChild);

        if($checkMethod["success"]) {
            self::allowGetResponses($routes, 3);
            $checkMethod["object"] ->$checkMethod["method"]();
        } else {
            $checkMethod = self::methodCheck("home", $urlParent);
            if($checkMethod["success"]) {
                self::allowGetResponses($routes, 3);
                $checkMethod["object"] ->$checkMethod["method"]();
            } else {
                $checkMethod = self::methodCheck($urlParent, "index");
                if($checkMethod["success"]) {
                    self::allowGetResponses($routes, 2);
                    $checkMethod["object"] ->$checkMethod["method"]();
                } else {
                    self::error404();
                }
            }
        }
//            if(self::methodCheck("home", $urlParent)["success"])
//                self::error404();
    }

    private static function allowGetResponses($routes, $startIndex) {
        for($i = $startIndex; $i < count($routes); $i++) {
            $_GET[$routes[$i]] = $routes[++$i];
        }
    }

    private static function loadModel($model) {
        $modelName = $model ."Model";
        $modelPath = PROJECT ."mvc/models/" .$modelName  .".php";

        if(!file_exists($modelPath)){
            self::$fileManager->buildModel($model);
        }

        if(file_exists($modelPath)){
            include_once $modelPath;
        }
    }

    private static function methodCheck($controller, $method) {
        $controllerName = $controller ."Controller";
        $controllerPath = PROJECT ."mvc/controllers/" .$controllerName .".php";

        if(file_exists($controllerPath)){
            self::loadModel($controller);

            include_once $controllerPath;

            $methodName = $method;
            $controllerObject = new $controllerName();
            $controllerObject->setActionName($methodName);

            if(method_exists($controllerObject, $methodName)){
                $reflection = new ReflectionMethod($controllerName, $methodName);
                if (!$reflection->isPrivate()) {
                    return array("success" => true, "object" => $controllerObject, "method" => $methodName);
//                    $controllerObject->$methodName();
//                    return true;
                }
            }
        }

        return array("success" => false);
    }

    private static function error404(){
        header('Location: /errors/error404');
    }


}