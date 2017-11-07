# Installation

---

Install the latest version with

```
$ composer require electronics-extreme/laravel-monolog
```

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
If you don't use auto-discovery or using Laravel 5.4 and below, add the ServiceProvider to the providers array in config/app.php

```
ElectronicsExtreme\LaravelMonolog\MonologServiceProvider::class
```

Copy package config to local config folder via command

```
php artisan vendor:publish --provider="ElectronicsExtreme\LaravelMonolog\MonologServiceProvider"
```
