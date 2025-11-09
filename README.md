## Простая API

### API
```
GET /posts — получить все посты
GET /post/{id} — получить пост по ID
POST /post — создать пост (title, body)
PATCH /post/{id} — частично обновить
PUT /post/{id} — полностью обновить
DELETE /post/{id} — удалить пост
```
### Структура Проекта 
```
── composer.json
├── composer.lock
├── .docker
│   ├── mariadb
│   │   └── init
│   │       └── create_posts.sql
│   ├── nginx
│   │   └── default.conf
│   └── php-fpm
│       ├── Dockerfile
│       └── entrypoint.sh
├── docker-compose.yml
├── .env
├── .gitignore
├── public
│   └── index.php
├── README.md
├── src
│   ├── connect.php
│   ├── Core
│   │   ├── AbstractModel.php
│   │   └── AbstractRouter.php
│   └── Post
│       ├── Model.php
│       └── Router.php
└── vendor
      ├── autoload.php
      ...
```

### Запуск 
#### Создать .env в корне проекта
```.env
MYSQL_ROOT_PASSWORD=pass
MYSQL_DATABASE=db
MYSQL_USER=user
MYSQL_PASSWORD=pass
```
#### Запустить Docker 
```bash
docker compose up -d
```
### Первый запуск
- В корне проекта появится директория vendor
- Скрипт по пути `.docker/mariadb/init/create_posts.sql` - создаст таблицу с постами для проверки работы
