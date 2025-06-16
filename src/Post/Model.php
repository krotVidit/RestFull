<?php

require '../Core/AbstractModel.php';

class Model extends AbstractModel
{
    public function getAll(mysqli $connect): string
    {
        $stmt = $connect->prepare('
            SELECT *
            FROM Posts
            ');
        if (! $stmt) {
            http_response_code(500);

            return json_encode(['error' => 'Ошибка получение постов']);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);

        return json_encode($posts);
    }

    public function get(mysqli $connect, int $id): string
    {
        $stmt = $connect->prepare('
            SELECT *
            FROM Posts
            WHERE id = ?
        ');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        if (! $post) {
            http_response_code(400);

            return json_encode(['error' => 'Пост с данным id не найден']);
        }

        return json_encode($post);
    }

    public function add(mysqli $connect, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];

        $stmt = $connect->prepare('
            INSERT INTO Posts (title, body)
            VALUE (?, ?)
        ');
        $stmt->bind_param('ss', $title, $body);

        if (! $stmt->execute()) {
            http_response_code(500);

            return json_encode([
                'status' => false,
                'error' => ' Ошибка добавления поста',
            ]);
        }

        http_response_code(201);

        return json_encode([
            'status' => true,
            'post_id' => mysqli_insert_id($connect),
            'message' => 'Запись добавлена',
        ]);
    }

    public function patch(mysqli $connect, int $id, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];

        $stmt = $connect->prepare('
            UPDATE Posts
            SET title = ?, body = ?
            WHERE id = ?
            ');
        $stmt->bind_param('ssi', $title, $body, $id);
        if (! $stmt->execute()) {
            http_response_code(500);

            return json_encode([
                'status' => false,
                'error' => 'Ошибка обновления записи',
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись обновленна',
        ]);
    }

    public function put(mysqli $connect, int $id, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];

        $stmt = $connect->prepare('
            UPDATE Posts
            SET title = ?, body = ?
            WHERE id = ?
        ');
        $stmt->bind_param('ssi', $title, $body, $id);

        if (! $stmt->execute()) {
            http_response_code(500);

            return json_encode([
                'status' => false,
                'error' => 'Запись не обновлена',
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись обновленна полностью',
        ]);
    }

    public function delete(mysqli $connect, int $id): string
    {
        $stmt = $connect->prepare('
            DELETE FROM Posts
            WHERE id = ?
        ');
        $stmt->bind_param('i', $id);

        if (! $stmt->execute()) {
            http_response_code(500);

            return json_encode([
                'status' => false,
                'error' => 'Ошибка удаление записи',
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись удаленна',
        ]);
    }
}
