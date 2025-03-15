<?php

use Ebbbang\PhpEthereum\Ethereum;
use Ebbbang\PhpEthereum\Units\Wei;

test('fetches ether balance', function () {
    $address = '0xf39Fd6e51aad88F6F4ce6aB8827279cffFb92266';

    $network = new Ethereum('http://127.0.0.1:8545');

    expect($network->balanceOf($address))->toEqual(Wei::of('10000000000000000000000'));
});
