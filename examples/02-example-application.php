<?php

use yii\console\Application;
use Horat1us\Yii\CurrentEnvironment;

// configure your Yii2 application
$app = new Application([
    // your config file may be located in different places depends on your application
    'bootstrap' => [
        'currentEnvironment' => CurrentEnvironment\Bootstrap::class,
    ],
]);

// then you can use Yii2 Application ServiceLocator
\Yii::$app->env->value();
\Yii::$app->env->isDebug();
\Yii::$app->env->isProduction();
