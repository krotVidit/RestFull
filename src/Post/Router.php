<?php

namespace App\Post;

use App\Core\AbstractRouter;
use mysqli;

class Router extends AbstractRouter
{
    protected mysqli $connect;

    private Model $model;

    public function __construct(mysqli $connect)
    {
        parent::__construct($connect);
        $this->model = new Model($connect);
    }

    public function handler(string $method, string $path): void
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

    protected function handleGet(string $type, ?int $id = null): void
    {
        if ($type === 'posts') {
            echo $this->model->getAll();
        } elseif ($type === 'post') {
            echo $this->model->get($id);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Страница не найдена']);
        }
    }

    protected function handlePost(string $type): void
    {

        if ($type === 'post') {
            echo $this->model->add($_POST);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не добавлена']);
        }
    }

    protected function handlePatch(string $type, int $id): void
    {
        if ($type === 'post') {
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $this->model->patch($id, $dataJSON);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обновлена']);
        }
    }

    protected function handlePut(string $type, int $id): void
    {
        if ($type === 'post') {
            $data = file_get_contents('php://input');
            $dataJSON = json_decode($data, true);
            echo $this->model->put($id, $dataJSON);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Запись не обновлена']);
        }
    }

    protected function handleDelete(string $type, int $id): void
    {
        if ($type === 'post') {
            echo $this->model->delete($id);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Запись не удалена']);
        }
    }
}
