## О проекте

ИНФОРМАЦИОННАЯ СИСТЕМА УЧЕТА ДАННЫХ ЦЕНТРА ЗАНЯТОСТИ

## Установка

- Скопировать файл .env.example и переименовать в .env
- Создать БД MySQL
- Указать в файле .env параметры для подключения к БД
- Установить пакеты composer: "composer install"
- Запустить миграцию БД: "php artisan migrate"
- Создать пользователя: "php artisan orchid:admin {nickname} {your@mail.ru} {password}"
- php artisan orchid:admin admin admin@admin.admin admin
