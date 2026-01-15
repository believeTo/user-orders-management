<?php
// Включение отображения ошибок (для разработки)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Определение корневой директории
define('ROOT', __DIR__);
define('APP', ROOT . '\app');

require_once ROOT . '\vendor\autoload.php';

$router = new App\Core\Router();
$router->run();