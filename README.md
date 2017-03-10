Buuum - DBSync package for your app
=======================================

[![Packagist](https://poser.pugx.org/buuum/dbsync/v/stable)](https://packagist.org/packages/buuum/dbsync)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](#license)

## Simple and extremely flexible PHP event class

## Getting started

You need PHP >= 5.5 to use Buuum.

- [Install Buuum DBSync](#install)
- [Initialize Config](#initialize-config)
- [Generate Backup](#generate-backup)
- [Get diff between databases](#get-diff-between-databases)

## Install

### System Requirements

You need PHP >= 5.5.0 to use Buuum\DBSync but the latest stable version of PHP is recommended.

### Composer

Buuum is available on Packagist and can be installed using Composer:

```
composer require buuum/dbsync
```

### Manually

You may use your own autoloader as long as it follows PSR-0 or PSR-4 standards. Just put src directory contents in your vendor directory.

## Initialize Config

```php
php vendor/bin/dbsync init
```
file generated dbsync.yml
```yaml
paths:
  backup: backup
  migrations: migrations
environments:
  local.dev:
    database: databasename
    host: localhost
    username: root
    password:
    adapter: mysql
    port: 3306
    charset: utf8
  dev.local.com:
    database: databasename
    host: localhost
    username: root
    password:
    adapter: mysql
    port: 3306
    charset: utf8
```

## Generate Backup

```php
php vendor/bin/dbsync backup
```

## Get diff between databases

```php
php vendor/bin/dbsync diff
```

## LICENSE

The MIT License (MIT)

Copyright (c) 2017 alfonsmartinez

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.