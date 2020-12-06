# Simple TODO Laravel 8 + Livewire 2

<p align="center">
    <img src="https://user-images.githubusercontent.com/62506582/101281780-bd7bda00-3803-11eb-9d37-6a5bc620aec2.png" width="100%" height="auto" />
</p>

[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/Zzzul/livewire-todo/issues)

## What inside?

-   Laravel ^8.x - [laravel.com/docs/8.x](https://laravel.com/docs/8.x)
-   Laravel UI ^3.x - [laravel-ui](https://github.com/laravel/ui/tree/3.x)
-   Livewire ^2.x - [laravel-livewire.com](https://laravel-livewire.com)

## What next?

After clone or download this repository, next step is install all dependency required by laravel and laravel-mix.

```shell
# install composer-dependency
$ composer install
# install npm package
$ npm install
# build dev
$ npm run dev
```

Before we start web server make sure we already generate app key, configure `.env` file and do migration.

```shell
# create copy of .env
$ cp .env.example .env
# create laravel key
$ php artisan key:generate
# laravel migrate
$ php artisan migrate
# start local server
$ php artisan serve
```
