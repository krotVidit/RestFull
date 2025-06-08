<?php

class Model
{
    public function getPosts($connect)
    {
        $posts = mysqli_query($connect, "
            SELECT *
            FROM Posts
            ")->fetch_all();

        return json_encode($posts);
    }

    public function getPost($connect, $id)
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

    public function addPost($connect, $data)
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

    public function updatePost($connect, $id, $data)
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
            'post_id' => mysqli_insert_id($connect),
            'message' => 'Запись обновленна',
        ];
        http_response_code(200);

        return json_encode($result);
    }

    public function updateAllPost($connect, $id, $data)
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
            'post_id' => mysqli_insert_id($connect),
            'message' => 'Запись обновленна полностью',
        ];
        http_response_code(200);

        return json_encode($result);
    }

    public function deletePost($connect, $id)
    {
        $delete = mysqli_query($connect, "
            DELETE FROM Posts
            WHERE id = '{$id}'
        ");

        $result = [
            'status' => true,
            'post_id' => mysqli_insert_id($connect),
            'message' => 'Запись удаленна',
        ];
        http_response_code(200);

        return json_encode($result);
    }
}
