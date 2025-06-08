<?php

class Model
{
    public function getPosts(mysqli $connect): string
    {
        $posts = mysqli_query($connect, '
            SELECT *
            FROM Posts
            ')->fetch_all();

        return json_encode($posts);
    }

    public function getPost(mysqli $connect, int $id): string
    {
        $post = mysqli_query($connect, "
            SELECT *
            FROM Posts
            WHERE id = '{$id}'
        ")->fetch_all();

        if (empty($post)) {
            http_response_code(400);

            return json_encode(['error' => 'Поста по данному id - не найденно']);
        }

        return json_encode($post);
    }

    /**
     * @param mysqli $connect
     * @param $data
     * @return string
     */
    public function addPost(mysqli $connect, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];
        $add = mysqli_query($connect, "
            INSERT INTO Posts (id, title, body)
            VALUE (NULL,'{$title}','{$body}')
            ");
        $result = [
            'status' => true,
            'post_id' => mysqli_insert_id($connect),
            'message' => 'Запись добавлена',
        ];
        http_response_code(201);

        return json_encode($result);
    }

    /**
     * @param mysqli $connect
     * @param int $id
     * @param $data
     * @return string
     */
    public function updatePost(mysqli $connect, int $id, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];
        $update = mysqli_query($connect, "
            UPDATE Posts
            SET title = '{$title}', body ='{$body}'
            WHERE id ='{$id}'
        ");
        $result = [
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись обновленна',
        ];
        http_response_code(200);

        return json_encode($result);
    }

    /**
     * @param mysqli $connect
     * @param int $id
     * @param $data
     * @return string
     */
    public function updateAllPost(mysqli $connect, int $id, $data): string
    {
        $title = $data['title'];
        $body = $data['body'];
        $update = mysqli_query($connect, "
            UPDATE Posts
            SET title = '{$title}', body ='{$body}'
            WHERE id ='{$id}'
        ");
        $result = [
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись обновленна полностью',
        ];
        http_response_code(200);

        return json_encode($result);
    }

    public function deletePost(mysqli $connect, int $id): string
    {
        $delete = mysqli_query($connect, "
            DELETE FROM Posts
            WHERE id = '{$id}'
        ");

        $result = [
            'status' => true,
            'post_id' => $id,
            'message' => 'Запись удаленна',
        ];
        http_response_code(200);

        return json_encode($result);
    }
}
