<?php

namespace Ebbbang\PhpEthereum\Utilities;

class Address
{
    public static function isValid(string $address): bool
    {
        if (str_starts_with($address, '0x')) {
            $address = substr($address, 2); // Remove '0x' prefix for validation
        }

        if (strlen($address) !== 40) {
            return false;
        }

        return ctype_xdigit($address);
    }
}