Agri API Demo
-------------

This an api demo built with Lumen

## Requirements

PHP 7.1.3 and later.
[Composer](http://getcomposer.org/)

## Getting Started

```bash
git clone glenntenorio/agri-api-demo
cd agri-api-demo
composer install
cp .env.example .env
```

Then setup your database credentials in the `.env` file

```bash
php artisan key:generate
php artisan migrate --seed
php -S localhost:8000 -t public
```

## Documentation

Please see the generated api documentation inside `public/docs` folder.


