<?php

namespace Becklyn\Utilities\Enum;

use Illuminate\Support\Collection;
use Symfony\Component\String\UnicodeString;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2020-05-18
 */
abstract class Enum
{
    private function __construct(private string $value)
    {
        $this->assertValue($value);
    }

    private function assertValue(string $value): void
    {
        $className = static::class;
        $reflection = new \ReflectionClass($className);
        $constants = $reflection->getConstants();
        if (!in_array($value, $constants)) {
            throw new \LogicException("Unsupported $className '$value'");
        }
    }

    public static function __callStatic($functionName, $arguments): static
    {
        foreach (static::values() as $constName => $value) {
            $constNameUcFirstCamel = Collection::make((new UnicodeString($constName))->lower()->split('_'))
                ->map(fn(UnicodeString $s) => ucfirst($s->toString()))
                ->join('');
            if (lcfirst($constNameUcFirstCamel) === $functionName) {
                return static::fromString($value);
            }
        }

        throw new \LogicException("Can't do anything with magic method $functionName");
    }

    /**
     * @return string[] Array of constant values keyed by constant names
     */
    private static function values(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    /**
     * @return Collection|static[]
     */
    public static function all(): Collection
    {
        $reflection = new \ReflectionClass(static::class);
        return Collection::make($reflection->getConstants())
            ->map(fn($value) => static::fromString($value));
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function asString(): string
    {
        return $this->value;
    }

    public function equals(Enum $other): bool
    {
        if (get_class($other) !== static::class) {
            return false;
        }

        return $this->value === $other->value;
    }
}
