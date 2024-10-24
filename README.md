часы, затраченные на проект - примерно 50

Развертывание: laravel sail
Docker desktop + wsl

Папку с проектом необходимо перенести в директорию wsl .../home/user/

Прописать в консоли wsl, находясь в папке с проектом, тем самым установив зависимости

docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs

создать файл .env, скопировать в него все из .env.example

Заполнить поля по умолчанию на: 

``DB_CONNECTION=mysql
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

SCOUT_DRIVER=database``

Установите js зависимости npm i
билдим css npm run build
в шаблоне layouts.app.blade.php установим наш сгенерируемый css файл в head

запуск проекта vendor/bin/sail up

При необходимости сгенерируйте ключ приложения vendor/bin/sail artisan key:generate

Создайте симлинк vendor/bin/sail artisan storage:link

Запустите миграции vendor/bin/sail artisan migrate

Cгенерируем некоторые записи в бд, необходимые для работы проекта vendor/bin/sail artisan db:seed

Запустим очередь vendor/bin/sail artisan queue:work

Не сделано: функционал личных сообщений, некоторые тесты не дописаны

Замечания: не работала библиотка dropzone, приложенная с исходниками проекта, спросил в дискорде у вас, наставник
ответил, что можно сделать обычную отправку файла;

С приложенными js файлами не работали кнопки переключения добавления разных форм создания поста, наставник
сказал сделать отдельные шаблоны под каждый пост;

также не смог разобраться с gulp, сделал билд css через vite;

запуск тестирования vendor/bin/sail artisan test




