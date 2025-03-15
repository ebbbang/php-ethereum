<?php

use Ebbbang\PhpEthereum\Units\Kwei;

describe('Kwei', function () {
    it('can handle hexadecimal values', function () {
        expect(Kwei::of('0x0')->toString())->toBe('0')
            ->and(Kwei::of('0x1')->toString())->toBe('1')
            ->and(Kwei::of('0x7b')->toString())->toBe('123');
    });

    it('can handle numeric values', function () {
        expect(Kwei::of('0')->toString())->toBe('0')
            ->and(Kwei::of('1')->toString())->toBe('1')
            ->and(Kwei::of('123')->toString())->toBe('123')
            ->and(Kwei::of(0)->toString())->toBe('0')
            ->and(Kwei::of(1)->toString())->toBe('1')
            ->and(Kwei::of(123)->toString())->toBe('123');
    });

    it('can handle decimal numbers', function () {
        expect(Kwei::of('0.1')->toString())
            ->toBe('0.1')
            ->and(Kwei::of(0.1)->toString())
            ->toBe('0.1')
            ->and(fn () => Kwei::of('7B.6C')->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei must be a valid numeric or hexadecimal string');
    });

    it('only accepts positive numbers', function () {
        expect(fn () => Kwei::of('-1')->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei must be a positive number')
            ->and(fn () => Kwei::of(-1)->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei must be a positive number')
            ->and(fn () => Kwei::of('-0x1')->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei must be a valid numeric or hexadecimal string');
    });

    it('can handle largest Kwei number', function () {
        expect(Kwei::of(Kwei::max())->toString())
            ->toBe('115792089237316195423570985008687907853269984665640564039457584007913129639.935')
            ->and(Kwei::of('0x4189374BC6A7EF9DB22D0E5604189374BC6A7EF9DB22D0E5604189374BC6A7')->toString())
            ->toBe('115792089237316195423570985008687907853269984665640564039457584007913129639')
            ->and(fn () => Kwei::of('115792089237316195423570985008687907853269984665640564039457584007913129639.936')->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei cannot be larger than '.Kwei::max())
            ->and(fn () => Kwei::of('0x4189374BC6A7EF9DB22D0E5604189374BC6A7EF9DB22D0E5604189374BC6A8')->toString())
            ->toThrow(InvalidArgumentException::class, 'Kwei cannot be larger than '.Kwei::max());
    });

    it('can return max value', function () {
        expect(Kwei::max())->toBe('115792089237316195423570985008687907853269984665640564039457584007913129639.935');
    });
});
