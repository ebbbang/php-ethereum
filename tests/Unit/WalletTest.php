<?php

use Ebbbang\PhpEthereum\Wallet;

test('it creates random wallets', function () {
    $wallet = new Wallet;

    expect($wallet->address())
        ->toStartWith('0x')
        ->toHaveLength(42)
        ->and($wallet->address(prefix: false))
        ->toHaveLength(40)
        ->toBeHexadecimal()
        ->and($wallet->publicKey())
        ->toHaveLength(128)
        ->toBeHexadecimal()
        ->and($wallet->privateKey())
        ->toHaveLength(64)
        ->toBeHexadecimal();
});

test('it creates wallet for given privateKey', function () {
    $privateKey = '3d592f1a05870605e2e1e37546ff89fec9659067f429ebb8f4026c9c52f1e82c';

    $wallet = new Wallet($privateKey);

    expect($wallet->address())
        ->toBe('0x95ea00e09217c7522a18a12676e2448de71d2990')
        ->and($wallet->publicKey())
        ->toBe('6bbe0ee383f51e1e82e8e461b248f9f3ed4b8eef7d51178c90047c612988f94c05ed09d4246f71a792d5197e7997ae37915ee493580a00cf68eba0a167b45ae8')
        ->and($wallet->privateKey())
        ->toBe($privateKey);
});

test('it returns address with prefix', function () {
    $wallet = new Wallet;

    expect($wallet->address())
        ->toStartWith('0x')
        ->toHaveLength(42);
});

test('it returns address without prefix', function () {
    $wallet = new Wallet;

    expect($wallet->address(prefix: false))
        ->toHaveLength(40)
        ->toBeHexadecimal();
});

test('it returns publicKey', function () {
    $wallet = new Wallet;

    expect($wallet->publicKey())
        ->toHaveLength(128)
        ->toBeHexadecimal();
});

test('it returns privateKey', function () {
    $wallet = new Wallet;

    expect($wallet->privateKey())
        ->toHaveLength(64)
        ->toBeHexadecimal();
});
