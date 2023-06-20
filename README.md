<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Задание
PHP (Laravel)
Создать API для следующих сущностей – получить все (с фильтрами), получить одно, создать, удалить, обновить. Получение со всеми связанными сущностями и их количеством, создание или обновление со связанными сущностями или без них. Приложить файл коллекции для postman с запросами.
Сущности:
1. Поставщик
2. Производитель 3. Файл
Связки сущностей:
1. Поставщик + Файл
2. Поставщик + Производитель (через таблицу привязки)
3. Производитель + Файл
В Поставщике поле типа массив - адрес (фактический и юридический).




В задании не указано нужен ли отдельный endpoint для получения связи производителя и поставщика, поэтому чтобы увидеть что производитель и поставщик свзяаны нужно отправить запрос api/suppliers/[id] или api/manufacturers/[id]

# Установка

Этот проект был разработан с использованием Docker и Sail.

## Порядок действий

1. **Клонирование репозитория.** Скопируйте репозиторий на локальную машину с помощью команды `git clone`.
2. **Запуск Docker.** Запустите Docker на локальной машине.
3. **Запуск Sail.** Используйте команду `vendor/bin/sail up -d` для запуска проекта.
4. **Выполнение миграций.** Примените миграции базы данных с помощью команды `vendor/bin/sail migrate`.
5. **Наполнение тестовыми данными.** Используйте следующие команды для наполнения базы данных тестовыми данными:
    - `vendor/bin/sail artisan db:seed --class=SupplierSeeder`
    - `vendor/bin/sail artisan db:seed --class=ManufacturerSeeder`
    - `vendor/bin/sail artisan db:seed --class=FileSeeder`
6. **Тестирование с помощью Postman.** Используйте MeTestApi.postman_collection.json коллекцию для Postman для проверки API.
7. **Остановка Sail.**  используйте команду `vendor/bin/sail down` для остановки Sail и освобождения ресурсов.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
