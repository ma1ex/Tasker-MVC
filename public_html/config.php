<?php

/**
 * Project: Tasker MVC;
 * File: config.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 08.04.2019, 10:21
 * Comment:
 */

// Запрет прямого вызова скрипта
defined('ROOT_ACCESS') or die('Access forbidden!');

// PATHs
// Разделитель каталогов, специфичный для каждой ОС
define('DS' , DIRECTORY_SEPARATOR);
// Абсолютный (системный) путь к директории с приложением
define('PATH_SYSTEM_ABSOLUTE', dirname(__FILE__) . DS);
// Путь к директории с ядром системы
define('PATH_SYSTEM_CORE', PATH_SYSTEM_ABSOLUTE . 'core' . DS);
// Корневой HTTP-путь
define('PATH_SYSTEM_REQUEST', $_SERVER['REQUEST_URI']);
// Путь к директории с приложением
define('PATH_APPLICATION', PATH_SYSTEM_ABSOLUTE . 'app' . DS);
// Путь к контроллерам внутри директории приложения
define('PATH_APP_CONTROLLERS', PATH_APPLICATION . 'controllers' . DS);
// Путь к моделям внутри директории приложения
define('PATH_APP_MODELS', PATH_APPLICATION . 'models' . DS);
// Путь к представлениям внутри директории приложения
define('PATH_APP_VIEWS', PATH_APPLICATION . 'views' . DS);
// Путь к сторонним библиотекам
define('PATH_APP_LIBRARIES', PATH_APPLICATION . 'libraries' . DS);

// Class settings
// Префикс для контроллеров в системе
define('CONTROLLER_PREFIX', 'Controller_');
// Префикс для моделей в системе
define('MODEL_PREFIX', 'Model_');
// Префикс для представлений в системе
define('VIEW_PREFIX', 'View_');
// Имя контроллера по умолчанию
define('CONTROLLER_DEFAULT_NAME', 'Main');
// Имя метода по умолчанию у вызываемого контроллера без параметров
define('CONTROLLER_DEFAULT_ACTION', 'index');
// Имя действия по умолчанию у контроллеров
//define('CONTROLLER_DEFAULT_ACTION', 'action_');

// DB
define('DB_HOST', 'localhost');
define('DB_CHARSET' , 'utf8');
define('DB_NAME', 'tasks_mvc');
define('DB_USER_NAME', 'root');
define('DB_USER_PASS', '');
