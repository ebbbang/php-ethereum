<?php

namespace Ebbbang\PhpEthereum\Units;

class Kwei extends BaseUnit
{
    protected static function weiPower(): int
    {
        return 3;
    }
}
