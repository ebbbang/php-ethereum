<?php

namespace Ebbbang\PhpEthereum\Units;

use Brick\Math\BigDecimal;
use Brick\Math\BigInteger;
use Brick\Math\RoundingMode;
use InvalidArgumentException;

abstract class BaseUnit
{
    protected const MAX_WEI = '115792089237316195423570985008687907853269984665640564039457584007913129639935';

    protected string $value;

    abstract protected static function weiPower(): int;

    protected function __construct(string $value)
    {
        if (str_starts_with($value, '0x')) {
            $value = substr($value, 2);

            if (! ctype_xdigit($value)) {
                throw new InvalidArgumentException(get_class($this).' must be valid hexadecimal string');
            }

            $value = BigInteger::fromBase($value, 16)->toBigDecimal();
        } elseif (is_numeric($value)) {
            if (static::weiPower() === 0 && str_contains($value, '.')) {
                throw new InvalidArgumentException(get_class($this).' must be a whole number');
            }

            $value = BigDecimal::of($value);
        } else {
            throw new InvalidArgumentException(get_class($this).' must be a valid numeric or hexadecimal string');
        }

        if ($value->isLessThan(0)) {
            throw new InvalidArgumentException(get_class($this).' must be a positive number');
        }

        if ($value->isGreaterThan(static::max())) {
            throw new InvalidArgumentException(get_class($this).' cannot be larger than '.static::max());
        }

        $this->value = (string) $value;
    }

    public static function of(string $value): static
    {
        return new static($value);
    }

    public static function max(): string
    {
        return (string) BigDecimal::of(static::MAX_WEI)
            ->dividedBy(BigInteger::of(10)->power(static::weiPower()), scale: static::weiPower(), roundingMode: RoundingMode::HALF_EVEN);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
