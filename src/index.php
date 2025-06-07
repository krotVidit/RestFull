<?php

/* $response = file_get_contents('https://jsonplaceholder.typicode.com/posts'); */
/* $posts = json_decode($response, true); */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

require 'connect.php';
require 'Model.php';

$metod = $_SERVER['REQUEST_METHOD'];
$model = new Model;

$path = isset($_GET['q']) ? ltrim($_GET['q'], '/') : '';
$segments = explode('/', $path);

$type = $segments[0] ?? '';
$id = $segments[1] ?? null;

if ($metod === 'GET') {
    switch ($type) {
        case 'posts':
            echo $model->getPosts($connect);
            break;
        case 'post':
            echo $model->getPost($connect, $id);
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Страница не найдена']);
            break;
    }
} elseif ($metod === 'POST') {
    switch ($type) {
        case 'post':
            echo $model->addPost($connect, $_POST);
            break;
        default:
            http_response_code(500);
            echo json_encode(['error' => 'Запись не добавлена']);
            break;
    }
} elseif ($metod === 'PATCH') {
    switch ($type) {
        case 'post':
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $model->updatePost($connect, $id, $dataJSON);
            break;
        default:
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обнавлена']);
            break;
    }
} elseif ($metod === 'PUT') {
    switch ($type) {
        case 'post':
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $model->updateAllPost($connect, $id, $dataJSON);
            break;
        default:
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обнавлена']);
            break;
    }
} elseif ($metod === 'DELETE') {
    switch ($type) {
        case 'post':
            echo $model->deletePost($connect, $id);
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Запись не удалена']);
            break;
    }
}
