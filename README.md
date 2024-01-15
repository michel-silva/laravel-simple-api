<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Laravel Simple API

This objective of this project is demonstrate some resources of Laravel. The above resources are useds in project:

- [Pagination](https://laravel.com/docs/10.x/eloquent-resources#pagination)
- [Authentication with Sanctum cookie based](https://laravel.com/docs/10.x/sanctum#spa-authentication)
- [Create command to import products](https://laravel.com/docs/10.x/artisan#writing-commands)
- [Create JOB to process import async](https://laravel.com/docs/10.x/queues)
- [Use resources to filter response](https://laravel.com/docs/10.x/eloquent-resources#writing-resources)
- [Use requests to validating form data](https://laravel.com/docs/10.x/validation#form-request-validation)
- [Use Softdelete](https://laravel.com/docs/10.x/eloquent#soft-deleting)
- [Handle custom error on NotFoundHttpException](https://laravel.com/docs/10.x/errors#rendering-exceptions)
- [Doc builded with swagger](https://swagger.io/)

If you have any suggestion of resource of laravel to I add in this project let me know (silva.michel.b@gmail.com).

## To run this project

It's so easy to run this project. Here you have some steps to test all resources:

1 - Clone the repository
```
git clone https://github.com/michel-silva/laravel-simple-api.git && cd laravel-simple-api
```

2 - Copy .env.exemple
```
cp .env.example .env
```

3 - Create a new MySQL database (laravel_simple_api) and update mysql connection config

4 - Run composer install
```
composer install
```

5 - Generate key
```
php artisan key:generate
```

6 - Run migrate
```
php artisan migrate
```

7 - Run import command, this will import products from [fakestoreapi](https://fakestoreapi.com/products)
```
php artisan app:import-products
```

8 - Generate Swagger doc
```
php artisan l5-swagger:generate
```

9 - Run local server
```
php artisan serve
```

10 - [Access Swagger doc](http://localhost:8000/api/documentation)

## Overview
This project have three groups of routes. 
The first is the auth routes, is use to register, login and logout:
```
POST - http://localhost:8000/api/auth/register
POST - http://localhost:8000/api/auth/login
POST - http://localhost:8000/api/auth/logout
```

The second is the public routes. This routes is public and can be accessed by anyone:
```
GET - http://localhost:8000/api/public/products

```

The third is the private routes. This routes is private and only can be accessed by logged users:
```
GET - http://localhost:8000/api/private/user
GET - http://localhost:8000/api/private/products
GET - http://localhost:8000/api/private/products/{id}
POST - http://localhost:8000/api/private/products
PUT - http://localhost:8000/api/private/products/{id}
DELETE - http://localhost:8000/api/private/products/{id}
```