<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requirements

- Node
- NPM
- Composer
- Laravel (PHP Framework)
- MAMP or XAMPP
- Angular
- IDE or Code Editor

## Install & Configure JWT Authentication Package

Tymondesigns/jwt-auth, It is a third-party JWT package and allows user authentication using JSON Web Token in Laravel & Lumen securely.
Command: composer require tymon/jwt-auth

## Generate a secret key
Generate a secret key by executing the following command:
- php artisan jwt:secret

## Run laravel
- php artisan serve

## Admin account

To add a user admin account, you have to run seeders 

- php artisan db:seed --class=UserSeeder
- php artisan migrate

### Admin login access:

- Email: admin@blog.com
- password: secret


