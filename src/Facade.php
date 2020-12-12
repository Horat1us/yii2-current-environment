<?php declare(strict_types=1);

namespace Horat1us\Yii\CurrentEnvironment;

class Facade implements \Stringable, \JsonSerializable
{
    public const PRODUCTION = 'prod';
    public const TEST = 'test';
    public const DEVELOPMENT = 'dev';

    private ?string $testValue = null;
    private ?bool $testIsDebug = null;

    // region Basic getters
    public function value(): string
    {
        return $this->testValue ?? $this->constantValue();
    }

    public function isDebug(): bool
    {
        return $this->testIsDebug ?? $this->constantIsDebug();
    }
    // endregion

    // region Helpers
    public function matches(string ...$environments): bool
    {
        return in_array($this->value(), $environments);
    }

    /**
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/framework/BaseYii.php#L36
     */
    public function isProduction(): bool
    {
        return $this->value() === static::PRODUCTION;
    }

    /**
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/framework/BaseYii.php#L40
     */
    public function isDevelopment(): bool
    {
        return $this->value() === static::DEVELOPMENT;
    }

    /**
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/framework/BaseYii.php#L44
     */
    public function isTesting(): bool
    {
        return $this->value() === static::TEST;
    }

    // endregion

    // region Interfaces implementation
    public function __toString(): string
    {
        return $this->value();
    }

    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value(),
            'debug' => $this->isDebug(),
        ];
    }
    // endregion

    // region Test mutation methods
    public function replace(string $value, bool $isDebug = false): void
    {
        $this->testValue = $value;
        $this->testIsDebug = $isDebug;
    }

    public function reset(): void
    {
        $this->testValue = null;
        $this->testIsDebug = null;
    }

    public static function mock(string $value, bool $isDebug = false): self
    {
        $instance = new self;
        $instance->replace($value, $isDebug);
        return $instance;
    }
    // endregion

    // region Yii2-support layer
    /**
     * Return value from YII_ENV constant or 'prod' if constant is not defined
     * Fallback value is same with default value in Yii2 Framework
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/framework/BaseYii.php#L32
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide/concept-configurations.md#environment-constants-
     *
     * Note: implementing separate method instead of direct using of YII_ENV constant to:
     *  - handle undefined constants (for usage this library as a part of other)
     *  - make testing this class easier using method mock
     */
    protected function constantValue(): string
    {
        if (defined('YII_ENV')) {
            return constant('YII_ENV');
        }
        return 'prod';
    }

    /**
     * Return value from YII_DEBUG constant or 'false' if constant is not defined
     * Fallback value is same with default value in Yii2 Framework
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/framework/BaseYii.php#L27
     * @link https://github.com/yiisoft/yii2/blob/2.0.39.3/docs/guide/concept-configurations.md#environment-constants-
     */
    protected function constantIsDebug(): bool
    {
        if (defined('YII_DEBUG')) {
            return (bool)constant('YII_DEBUG');
        }
        return false;
    }
    // endregion
}
