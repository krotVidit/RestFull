<?php

abstract class AbstractRouter {
  
  protected mysqli $connect;

  public function __construct(mysqli $connect)
  {
        $this->connect = $connect;
        $this->connectApi();
  }

  protected function connectApi () : void
  {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Credentials: true');
        header('Content-Type: application/json');
  }

  abstract protected function handler (string $method, string $path);

  abstract protected function handleGet (string $type, ?int $id = null);

  abstract protected function handlePost (string $type);

  abstract protected function  handlePatch(string $type, int $id);

  abstract protected function handlePut(string $type, int $id);

  abstract protected function handleDelete(string $int, int $id);

}
