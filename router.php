<?php

    namespace Wyesoftware;

    class Router {

        private static $routes = array();

        public static function use($path, $import) {
            array_push(self::$routes, array(
                'path' => $path,
                'import' => $import
            ));
        }

        public static function app($appPath) {
            $appPath = explode('/', $appPath, 2);
            $parsePath = explode("/", $_SERVER['REQUEST_URI'], 4);
            if($parsePath[1] == $appPath[1]) {
                if(!empty($parsePath[2])) {
                    foreach (self::$routes as $route) {
                        $parseRoutePath = explode("/", $route['path'], 2);

                        if ($parsePath[2] == $parseRoutePath[1]) {
                            http_response_code(200);
                            require_once $route['import'];
                            break;
                        }
                        else {
                            http_response_code(400);
                        }
                    }
                }
                else {
                    http_response_code(400);
                }
            }
        }

        public static function render($import, $renderPath = null, $appPath = "api") {

            $parsePath = explode("/", $_SERVER['REQUEST_URI']);

            if ($renderPath == null) {
                if ($parsePath[1] !== $appPath) {
                    require_once $import;
                }
            }
            //add function render not from root
        }
    }

?>