<?php declare(strict_types=1);

namespace Horat1us\Yii\CurrentEnvironment\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Yii\CurrentEnvironment;

/**
 * Class FacadeTest
 * @package Horat1us\Yii\CurrentEnvironment\Tests
 * @coversDefaultClass \Horat1us\Yii\CurrentEnvironment\Facade
 */
class FacadeTest extends TestCase
{
    public function valueProvider(): \Generator
    {
        // ensure correct constant value returning
        yield [new CurrentEnvironment\Facade, CurrentEnvironment\Facade::PRODUCTION,];

        // ensure using protected constantValue method if no test value set
        $mock = $this->createPartialMock(CurrentEnvironment\Facade::class, ['constantValue']);
        $mock->expects($this->atLeastOnce())->method('constantValue')
            ->willReturn('mocked');
        yield [$mock, 'mocked'];

        // ensure using test value instead of constantValue when set
        $test = CurrentEnvironment\Facade::mock(CurrentEnvironment\Facade::TEST);
        yield [$test, CurrentEnvironment\Facade::TEST];
    }

    /**
     * @dataProvider valueProvider
     */
    public function testValue(CurrentEnvironment\Facade $env, string $expectedValue): void
    {
        $this->assertEquals($expectedValue, $env->value());
    }

    public function matchesProvider(): \Generator
    {
        yield [new CurrentEnvironment\Facade, [], false];

        foreach ($this->valueProvider() as [$facade, $value]) {
            yield [$facade, [$value,], true,];
            yield [$facade, [$value, 'anotherOne',],true,];
            yield [$facade, ['anotherOne',], false];
        }
    }

    /**
     * @dataProvider matchesProvider
     */
    public function testMatches(CurrentEnvironment\Facade $env, array $arguments, bool $expectedValue): void
    {
        $this->assertEquals($expectedValue, $env->matches(...$arguments));
    }

    public function testToString(): void
    {
        $value =__METHOD__;
        $facade = CurrentEnvironment\Facade::mock($value);
        $this->assertSame($value, (string)$facade);
    }

    public function testJsonSerialize(): void
    {
        $value = __METHOD__;
        $debug = true;
        $facade = CurrentEnvironment\Facade::mock($value, $debug);
        $this->assertEquals(compact('value', 'debug'), $facade->jsonSerialize());
    }

    public function mutationsProvider(): \Generator
    {
        $value = __METHOD__;
        $isDebug = true;
        $facade = CurrentEnvironment\Facade::mock($value, $isDebug);

        yield [$facade, $value, $isDebug];

        $resetFacade = CurrentEnvironment\Facade::mock($value, $isDebug);
        ;
        $resetFacade->reset();

        $defaultValue = CurrentEnvironment\Facade::PRODUCTION;
        $defaultIsDebug = false;
        yield [$resetFacade, $defaultValue,  $defaultIsDebug];
    }

    /**
     * @dataProvider mutationsProvider
     */
    public function testTestMutations(CurrentEnvironment\Facade $facade, string $value, bool $isDebug): void
    {
        $this->assertEquals($value, $facade->value());
        $this->assertEquals($isDebug, $facade->isDebug());
    }
}
