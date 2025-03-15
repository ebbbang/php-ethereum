<?php

use Ebbbang\PhpEthereum\Units\Wei;

describe('Wei', function () {
    it('can handle hexadecimal values', function () {
        expect(Wei::of('0x0')->toString())->toBe('0')
            ->and(Wei::of('0x1')->toString())->toBe('1')
            ->and(Wei::of('0x7b')->toString())->toBe('123');
    });

    it('can handle numeric values', function () {
        expect(Wei::of('0')->toString())->toBe('0')
            ->and(Wei::of('1')->toString())->toBe('1')
            ->and(Wei::of('123')->toString())->toBe('123')
            ->and(Wei::of(0)->toString())->toBe('0')
            ->and(Wei::of(1)->toString())->toBe('1')
            ->and(Wei::of(123)->toString())->toBe('123');
    });

    it('only accepts positive numbers', function () {
        expect(fn () => Wei::of('-1')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a positive number')
            ->and(fn () => Wei::of(-1)->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a positive number')
            ->and(fn () => Wei::of('-0x1')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a valid numeric or hexadecimal string');
    });

    it('only accepts whole numbers', function () {
        expect(fn () => Wei::of('0.1')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a whole number')
            ->and(fn () => Wei::of(0.1)->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a whole number')
            ->and(fn () => Wei::of('7B.6C')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei must be a valid numeric or hexadecimal string');
    });

    it('can handle largest Wei number', function () {
        expect(Wei::of(Wei::max())->toString())
            ->toBe('115792089237316195423570985008687907853269984665640564039457584007913129639935')
            ->and(Wei::of('0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff')->toString())
            ->toBe(Wei::max())
            ->and(fn () => Wei::of('115792089237316195423570985008687907853269984665640564039457584007913129639936')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei cannot be larger than '.Wei::max())
            ->and(fn () => Wei::of('0x10000000000000000000000000000000000000000000000000000000000000000')->toString())
            ->toThrow(InvalidArgumentException::class, 'Wei cannot be larger than '.Wei::max());
    });

    it('can return max value', function () {
        expect(Wei::max())->toBe('115792089237316195423570985008687907853269984665640564039457584007913129639935');
    });
});
