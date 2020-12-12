# Yii2 Current Environment
Библиотека предоставляющая класс для получения текущего окружения Yii2 приложения.

## Предназначения
Основной целью данной библиотеки является облегчение поддержки и доработки приложений,
написанных с использованием устаревшего фреймворка Yii2.
Не рекомендуется для использования в новых проектах.

Настройка окружения в Yii2 [реализуется с использованием констант](https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide/concept-configurations.md#environment-constants-).
Тестирование кода, который зависит от окружения, является затрудненным: 
невозможно переопределить заданную константу без [дополнительных расширений](https://www.php.net/manual/en/function.runkit7-constant-redefine.php).

Библиотека предлагает простое решение данной проблемы для приложений,
написанных с использованием устаревшего фреймворка Yii2, в виде простого класса
без обязательного задания констант, глобальных переменных и  хранения данных
на статическом уровне классов.


## Установка
С использованием [composer](https://getcomposer.org/)
```bash
composer install horat1us/yii2-current-environment
```

## Настройка
### Для использования внутри библиотек
Рекомендуется использовать класс [CurrentEnvironment\Facade](src/Facade.php)
как зависимость с использованием [DI Container](https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide-ru/concept-di-container.md).

[Пример реализации](./examples/01-example-library.php)

### Для использования внутри приложений
Для автоматической настройки синглтона [CurrentEnvironment\Facade](src/Facade.php) в
Yii2 [DI Container](https://github.com/yiisoft/yii2/blob/master/docs/guide-ru/concept-di-container.md),
а также настройки компонента 'env' в приложении подключите [CurrentEnvironment\Bootstrap](./src/Bootstrap.php)
в ваше приложение.

[Пример реализации](./examples/02-example-application.php)

## Авторы
- [Alexander Letnikow](mailto:reclamme@gmail.com)
