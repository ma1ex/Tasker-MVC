<?php

/**
 * Project: Tasker MVC;
 * File: index.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.04.2019, 17:08
 * Comment: Front Controller
 */

// Debug (for develop mode)
ini_set('display_errors', 1);

// Запрет прямого вызова скрипта
define('ROOT_ACCESS', 1);

if(file_exists('config.php')) {
    require_once 'config.php';
} else {
    exit('Config is not found!');
}

session_start();

// Автозагрузка классов ядра с помощью загрузчика.
spl_autoload_register(function($class) {
    // Порядок путей поиска классов формируется в этом массиве
    $pathFile = array(
        PATH_APP_CONTROLLERS,
        PATH_APP_MODELS,
        PATH_APP_LIBRARIES,
        PATH_SYSTEM_CORE
    );
    $count = 0;
    foreach($pathFile as $path) {
        $count++;
        $classFile = $path . $class . '.php';
        if(file_exists($classFile) && is_readable($classFile)) {
            require_once $classFile;
            break;
        } elseif($count >= sizeof($pathFile)) {
            exit('Called class "' . $class . '" not Found!<br />' . "\n");
        }
    }
});

// App Init
Router::start();