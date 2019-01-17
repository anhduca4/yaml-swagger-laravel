Laravel Swagger - OpenApi or Swagger Specification for your Laravel project made easy read onlye from yaml folder.
==========

Swagger 3.0 for Laravel >=5.7
This package is a wrapper of [swagger-ui](https://github.com/swagger-api/swagger-ui) adapted to work with Laravel 5.

Publish pack config and view files into your project by running:

```bash
$ php artisan vendor:publish --provider "Enda\YamlSwaggerLaravel\YamlSwaggerLaravelServiceProvider"
```
open your `config/app.php` and add this line in `providers` section
```php
Enda\YamlSwaggerLaravel\YamlSwaggerLaravelServiceProvider::class,
```
Edit pack config in 
```php
config/swagger.php
```

Edit and create documents swagger in 
```php
documents/swagger_v1
```
[Document swagger open api 3.0](https://swagger.io/specification/)
[Nexus](https://nexusfrontier.tech/)