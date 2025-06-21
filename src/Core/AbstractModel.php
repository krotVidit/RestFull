<?php

namespace App\Core;

use mysqli;

abstract class AbstractModel
{
  abstract protected function getAll();

  abstract protected function get(int $id);

  abstract protected function add(array $data);

  abstract protected function patch(int $id, array $data);

  abstract protected function put(int $id, array $data);

  abstract protected function delete(int $id);
}
