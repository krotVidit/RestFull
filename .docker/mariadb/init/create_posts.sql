CREATE TABLE IF NOT EXISTS Posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  body TEXT NOT NULL
);

INSERT INTO
  Posts (title, body)
VALUES
  (
    'Первый тестовый пост',
    'Это содержимое первого поста'
  ),
  (
    'Второй тестовый пост',
    'Это содержимое второго поста'
  ),
  (
    'Третий тестовый пост',
    'Пример данных для проверки API'
  )
