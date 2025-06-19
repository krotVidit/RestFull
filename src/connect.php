<?php

namespace App;

use mysqli;

$host = 'mariadb';
$user = 'root';
$password = '2705';
$dbname = 'API';

$connect = new mysqli($host, $user, $password, $dbname);

if ($connect->connect_error) {
    echo 'Ошибка Подключения' . $connect->connect_error;
}
