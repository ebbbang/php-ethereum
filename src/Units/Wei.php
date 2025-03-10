<?php

namespace Ebbbang\PhpEthereum\Units;

use Brick\Math\BigInteger;
use InvalidArgumentException;

class Wei
{
    private string $amount;

    public function __construct(string $wei)
    {
        if (str_starts_with($wei, '0x')) {
            $wei = substr($wei, 2);
        }

        if (is_numeric($wei)) {
            $this->amount = $wei;
        } elseif (ctype_xdigit($wei)) {
            $this->amount = BigInteger::fromBase($wei, 16)->toBase(10);
        } else  {
            throw new InvalidArgumentException('Wei must be a valid wei');
        }
    }

    public function __toString(): string
    {
        $this->amount;
    }
}