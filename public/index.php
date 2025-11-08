<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/connect.php';

use App\Post\Router;

global $connect;

$path = isset($_GET['q']) ? ltrim($_GET['q'], '/') : '';
$router = new Router($connect);
$router->handler($_SERVER['REQUEST_METHOD'], $path);
