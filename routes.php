<?php

    namespace Wyesoftware;

    class Route {

        private static $subRoutes = array();

        public static function do($path, $function, $method = 'get') {
            array_push(self::$subRoutes, array(
                'path' => $path,
                'function' => $function,
                'method' => $method
            ));
        }

        public static function export($routePath) {
            $routePath = explode('/', $routePath, 2);
            $parsePath = explode("/", $_SERVER['REQUEST_URI']);
            if($parsePath[2] == $routePath[1]) {
                foreach (self::$subRoutes as $subRoute) {
                    $parseSubRoutePath = explode("/", $subRoute['path']);

                    if($parsePath[3] == $parseSubRoutePath[1]) {

                        if(strtoupper($subRoute['method']) == $_SERVER['REQUEST_METHOD']) {
                            http_response_code(200);
                            preg_match_all('#{(.+?)}#is', $subRoute['path'], $matches);
                            $parseParams = explode("/", $_SERVER['REQUEST_URI'], 5);
                            $url = explode("/", $parseParams[4]);
                            $params = array();
                            if (count($matches[0]) == 1) {
                                array_push($params, $url[0]);
                            }
                            else {
                                for($i = 0; $i < count($matches[0]); $i++){
                                    array_push($params, $url[$i]);
                                }
                            }
    
                            call_user_func_array($subRoute['function'], $params);
                            break;
                        }
                        else {
                            http_response_code(403);
                        }
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

?>