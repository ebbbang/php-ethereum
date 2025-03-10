<?php

namespace Ebbbang\PhpEthereum;

use kornrunner\Ethereum\Address;

class Wallet
{
    private string $address;

    private string $publicKey;

    private string $privateKey;

    public function __construct(string $privateKey = '')
    {
        $address = new Address($privateKey);

        $this->address = $address->get();
        $this->publicKey = $address->getPublicKey();
        $this->privateKey = $address->getPrivateKey();
    }

    public function address(bool $prefix = true): string
    {
        return $prefix ? "0x$this->address" : $this->address;
    }

    public function publicKey(): string
    {
        return $this->publicKey;
    }

    public function privateKey(): string
    {
        return $this->privateKey;
    }
}
