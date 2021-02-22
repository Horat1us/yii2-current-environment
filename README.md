# Yii2 Current Environment
[![codecov](https://codecov.io/gh/Horat1us/yii2-current-environment/branch/master/graph/badge.svg?token=SYWMMUEYTT)](https://codecov.io/gh/Horat1us/yii2-current-environment)


[Русская версия](./README-RU.md)
Library provides class to get current environment (YII_ENV) of Yii2 application.

## Purpose
Main purpose is to make support, adaptation and modification of applications written 
using legacy Yii2 framework more friendly to modern programming trends.

[PHP constants](https://www.php.net/manual/en/language.constants.php) is used for 
[configuring Yii2 applications environment](https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide/concept-configurations.md#environment-constants-).
It makes testing environment-depending code difficult because constant redefining 
is impossible without [external extensions](https://www.php.net/manual/en/function.runkit7-constant-redefine.php).

This library provides simple solution for legacy application written using Yii2 as facade class 
that deals with Yii2 legacy (constant defining in libraries, global variables and static class storage).

## Install
Using [composer](https://getcomposer.org/)
```bash
composer install horat1us/yii2-current-environment
```

## Setup
### For usage inside libraries
Use [CurrentEnvironment\Facade](src/Facade.php)
as dependency for your services in pair with [DI Container](https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide-ru/concept-di-container.md).

[Example](./examples/01-example-library.php)

### For usage inside application
To set up [CurrentEnvironment\Facade](src/Facade.php) singleton inside
Yii2 [DI Container](https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/concept-di-container.md),
both with 'env' application component use [CurrentEnvironment\Bootstrap](./src/Bootstrap.php)
inside your application configuration.

[Example](./examples/02-example-application.php)

## Authors
- [Alexander Letnikow](mailto:reclamme@gmail.com)
