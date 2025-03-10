<?php

namespace Ebbbang\PhpEthereum;

use kornrunner\Ethereum\Address;

class Wallet
{
    protected function __construct(
        protected string $address,
        protected string $publicKey,
        protected string $privateKey
    ) {}

    public static function create(string $privateKey = ''): Wallet
    {
        $address = new Address($privateKey);

        return new self(
            $address->get(),
            $address->getPublicKey(),
            $address->getPrivateKey()
        );
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
