## Laravel 11 Article REST API

For authentication using Breeze package.

Install:

- Run Docker
- Run composer install from docker for install all packages
- Copy .env.example in .env and modify environment
- Add key (php artisan key:generate)
- Run database migrations

API Structure:

CRUD[GET, POST, PUT/PATCH, DELETE] for Articles, [POST] Login / Register / ...

###### Note: For email notification need to use command below

`
$php artisan queue:work --queue=emails
`

Best regards.
