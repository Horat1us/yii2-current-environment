<?php declare(strict_types=1);

namespace Horat1us\Yii\CurrentEnvironment\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Horat1us\Yii\CurrentEnvironment;
use yii\base;

/**
 * Class BootstrapTest
 * @package Horat1us\Yii\CurrentEnvironment\Tests
 * @coversDefaultClass \Horat1us\Yii\CurrentEnvironment\Bootstrap
 */
class BootstrapTest extends TestCase
{
    public function testBootstrap(): void
    {
        /** @var base\Application|MockObject $app */
        $app = $this->getMockForAbstractClass(base\Application::class, [], '', false, true, true, [
            'set', 'setContainer',
        ]);
        $app
            ->expects($this->once())
            ->method('set')
            ->with('env', CurrentEnvironment\Facade::class);
        $app->expects($this->once())
            ->method('setContainer')
            ->with([
                'singleton' => CurrentEnvironment\Facade::class,
            ]);

        $instance = new CurrentEnvironment\Bootstrap();
        $instance->bootstrap($app);
    }
}
