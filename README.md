# Installation

---

Install the latest version with

```
$ composer require electronics-extreme/laravel-monolog
```

Add new service provider

```
ElectronicsExtreme\LaravelMonolog\MonologServiceProvider::class
```

Copy package config to local config folder via command

```
php artisan vendor:publish --provider="ElectronicsExtreme\LaravelMonolog\MonologServiceProvider"
```
