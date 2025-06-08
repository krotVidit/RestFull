<?php

/* $response = file_get_contents('https://jsonplaceholder.typicode.com/posts'); */
/* $posts = json_decode($response, true); */
global $connect;

require 'connect.php';
require 'Model.php';
require 'Router.php';


$path = isset($_GET['q']) ? ltrim($_GET['q'], '/') : '';
$router = new Router($connect);
$router->handler($_SERVER['REQUEST_METHOD'], $path);
