<?php declare(strict_types=1);

namespace Horat1us\Yii\CurrentEnvironment;

use yii\base;

class Bootstrap implements base\BootstrapInterface
{
    public function bootstrap($app): void
    {
        $app->setContainer([
            'singleton' => Facade::class,
        ]);
        $app->set('env', Facade::class);
    }
}
