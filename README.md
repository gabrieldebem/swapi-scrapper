<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## To run this application you will need:
 - [Docker](https://www.docker.com)
 - [Docker Compose](https://docs.docker.com/compose/install/)

## Running the application:
- Run `cp .env.example .env`
- Run to install all dependencies:
```bash
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs
```
- Run to start the application:
```bash
./vendor/bin/sail up -d
```
- Run `./vendor/bin/sail key:generate` to generate a new application key
- Run `./vendor/bin/sail migrate` to migrate the database

## 
## Documentation
Access the swagger documentation on `http://localhost:8000/api/docs`
