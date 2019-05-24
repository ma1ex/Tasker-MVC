<?php

/**
 * Project: Tasker MVC;
 * File: Router.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 08.04.2019, 10:52
 * Comment:
 */

/**
 * Class Router
 */

class Router {

    /**
     * Init routes
     */
    public static function start() {

        // Default controller/action
        $controller_name = CONTROLLER_DEFAULT_NAME; // Main
        $action_name = CONTROLLER_DEFAULT_ACTION;   // index
        $action_parameters = null;                  // $_GET array

        // Получение введенного запроса (адреса)
        $uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        // Разбиваем адрес на составляющие для дальнейшего анализа
        $routes = explode('/', $uri);


        // Controller Name
        if(!empty($routes[1])) {
            // Если идет обращение к реальному файлу 'index.php', 'testimonials.php'...,
            // то имя до точки (расширения) - контроллер
            if(stripos($routes[1], '.') !== false) {
                $temp = explode('.', $routes[1]);
                $controller_name = ($temp[0] == 'index') ? CONTROLLER_DEFAULT_NAME : ucfirst($temp[0]);
            } else {
                $controller_name = ucfirst($routes[1]);
            }
        }

        // Action Name
        if(!empty($routes[2])) {
            $action_name = $routes[2];
        }

        // Параметры экшена, если есть
        if(isset($_GET) && !empty($_GET)) {
            foreach($_GET as $key => $item) {
                $action_parameters[$key] = $item;
            }
        }

        // Prefixes
        //$model_name = MODEL_PREFIX . $controller_name;
        $controller_name = CONTROLLER_PREFIX . $controller_name;
        $action_name = 'action_' . $action_name;

        // Make Controller
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)) {
            // Exec Controller action
            $controller->$action($action_parameters);
        } else {
            // Exeption or Redirect
            self::ErrorPage404();
        }

    }

    /**
     * Error Page 404
     */
    public static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}