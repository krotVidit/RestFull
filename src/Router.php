<?php

class Router
{
    private $connect;
    private Model $model;

    public function __construct($connect)
    {
        $this->connect = $connect;
        $this->model = new Model;

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Credentials: true');
        header('Content-Type: application/json');
    }

    public function handler($method, $path): void
    {
        $segments = explode('/', $path);
        $type = $segments[0] ?? '';
        $id = $segments[1] ?? null;

        switch ($method) {
            case 'GET':
                $this->handleGet($type, $id);
                break;
            case 'POST':
                $this->handlePost($type);
                break;
            case 'PATCH':
                $this->handlePatch($type, $id);
                break;
            case 'PUT':
                $this->handlePut($type, $id);
                break;
            case 'DELETE':
                $this->handleDelete($type, $id);
                break;
            default:
                http_response_code('405');
                echo json_encode(['error' => 'Метод не найден']);
                break;
        }
    }

    private function handleGet($type, $id): void
    {
        if ($type === 'posts') {
            echo $this->model->getPosts($this->connect);
        } elseif ($type === 'post') {
            echo $this->model->getPost($this->connect, $id);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Страница не найдена']);
        }
    }

    private function handlePost($type): void
    {

        if ($type === 'post') {
            echo $this->model->addPost($this->connect, $_POST);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не добавлена']);
        }
    }

    private function handlePatch($type, $id): void
    {
        if ($type === 'post') {
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $this->model->updatePost($this->connect, $id, $dataJSON);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обнавлена']);
        }
    }

    private function handlePut($type, $id): void
    {
        if ($type === 'post') {
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $this->model->updateAllPost($this->connect, $id, $dataJSON);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обнавлена']);
        }
    }

    private function handleDelete($type, $id): void
    {
        if ($type === 'post') {
            echo $this->model->deletePost($this->connect, $id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Запись не удалена']);
        }
    }
}
