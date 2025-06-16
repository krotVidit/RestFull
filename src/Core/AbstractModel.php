<?php

abstract class AbstractModel
{
  abstract protected function getAll(mysqli $connect);

  abstract protected function get(mysqli $connect, int $id);

  abstract protected function add(mysqli $connect, array $data);

  abstract protected function patch(mysqli $connect, int $id, array $data);

  abstract protected function put(mysqli $connect, int $id, array $data);

  abstract protected function delete(mysqli $connect, int $id);
}
