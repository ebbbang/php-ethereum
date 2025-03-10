<?php

namespace Ebbbang\PhpEthereum;

use Ebbbang\PhpEthereum\Units\Wei;
use Ebbbang\PhpEthereum\Utilities\Address;
use Ebbbang\PhpEthereum\Utilities\RPC;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Ethereum
{
    private RPC $rpc;

    public function __construct(string $rpcUrl)
    {
        $this->rpc = new RPC($rpcUrl);
    }

    /**
     * @throws GuzzleException
     */
    public function balanceOf(string $address): Wei
    {
        if (Address::isValid($address) === false) {
            throw new InvalidArgumentException('Invalid address');
        }

        $balance = $this->rpc->callMethod('eth_getBalance', [$address, 'latest']);

        return new Wei($balance);
    }
}
