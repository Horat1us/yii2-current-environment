<?php declare(strict_types=1);

namespace App;

use Horat1us\Yii\CurrentEnvironment;

// Define service that depends on environment
class FooService {
    private CurrentEnvironment\Facade $env;

    public function __construct(CurrentEnvironment\Facade $env) {
        $this->env = $env;
    }

    public function doSomething(): bool {
        // now check environment this way
        if (!$this->env->isProduction()) {
            return false;
        }
        // instead of legacy-way
        if (!YII_ENV_PROD) {
            return false;
        }
        // do something that will be executed only on production here
        return true;
    }
}

// Test this service with no dependencies on constants
class FooServiceTest {
    public function testFooService(): void
    {
        // create development environment facade
        $env = CurrentEnvironment\Facade::mock(CurrentEnvironment\Facade::DEVELOPMENT);
        // inject environment as facade
        $foo = new FooService($env);
        // test how service handle environment
        $result = $foo->doSomething();
        assert($result === false, 'service have to do nothing on development environment');
    }
}
