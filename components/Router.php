<?php


class Router
{
    private $routes;

    public function __construct() {
        $routespath = 'config/routes.php';
        $this->routes = include($routespath);
    }

    //Return request string
    private function getURL() {
        if ($_SERVER['REQUEST_URI']) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return 0;
    }

    public function run()
    {
        // Получить строку запроса

        $url = $this->getURL();
        //echo $url;

        //Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $urlPattern => $path) {
            if (preg_match("~$urlPattern~", $url)) {
                // Если есть совпадение опредилить какой контроллер и action обрабатывает запрос
                $internal_route = preg_replace("~$urlPattern~", $path, $url);
                $segments = explode('/', $internal_route);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parametres = $segments;


                // Подключить файл класса-контроллера

                $controllerFile = 'controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parametres);
                if ($result != null) {
                    break;
                }

            }
        }
    }
}