<?php

use App\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Controller\StatsController;
use App\Controller\ProductsController;

require __DIR__ . '/../config/config.php';
require __DIR__ . '/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
$twig = new Twig_Environment($loader);

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . '/../var/logs/main.log', Logger::DEBUG));

Log::$instance  = $log;

try {
    $type = $_GET['type'] ?? 'product';
    switch ($type) {
        case 'stats':
            $controller = new StatsController($twig);
            break;
        default:
            $controller = new ProductsController($twig);
    }

    $controller->render();
} catch (\Throwable $e) {
    Log::critical($e->getMessage());
    echo $twig->render('error.html');
}

