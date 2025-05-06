Часы, затраченные на проект - примерно 50

[Техническое задание](https://htmlacademy.notion.site/ReadMe-ed8f0d8b58414c7ba6cd23699977fbf1) 

Развертывание: laravel sail
Docker desktop + wsl

Папку с проектом необходимо перенести в директорию wsl /home/user/...

Прописать в консоли wsl, находясь в папке с проектом, тем самым установив зависимости
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs
```
Создать файл .env, скопировать в него все из .env.example

Заполнить поля по умолчанию на: 
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=academy_proj
DB_USERNAME=sail
DB_PASSWORD=password

TEST_DB_DATABASE=testing
TEST_DB_USERNAME=sail
TEST_DB_PASSWORD=password

FILESYSTEM_DISK=public
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=ваш_email
MAIL_PASSWORD=ваш_ключ_приложения
MAIL_FROM_ADDRESS="ваш_email"
MAIL_FROM_NAME="${APP_NAME}"

SCOUT_DRIVER=database
```

Установить js зависимости
``npm i``
Билд css 
``npm run build``

В шаблоне layouts.app.blade.php установить сгенерируемый css файл в head

Запуск проекта
``vendor/bin/sail up``

При необходимости сгенерировать ключ приложения
``vendor/bin/sail artisan key:generate``

Создать симлинк
``vendor/bin/sail artisan storage:link``

Запустить миграции 
``vendor/bin/sail artisan migrate``

Генерация сидов
``vendor/bin/sail artisan db:seed``

Запуск очереди
``vendor/bin/sail artisan queue:work``

Запуск тестирования ``vendor/bin/sail artisan test``




