<?php

interface InterfaceModel
{
  public function getAll(mysqli $connect);

  public function get(mysqli $connect, int $id);

  public function add(mysqli $connect, array $data);

  public function patch(mysqli $connect, int $id, array $data);

  public function put(mysqli $connect, int $id, array $data);

  public function delete(mysqli $connect, int $id);
}
