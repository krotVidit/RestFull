<?php

namespace App;

use mysqli;

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$connect = new mysqli($host, $user, $password, $dbname);

if ($connect->connect_error) {
    echo 'Ошибка Подключения' . $connect->connect_error;
}
