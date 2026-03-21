<?php

use Phizz\Retry;

it('exponential strategy doubles the delay on each attempt', function () {
    $retry = Retry::exponential();

    expect($retry->delay(0))->toBe(1)
        ->and($retry->delay(1))->toBe(2)
        ->and($retry->delay(2))->toBe(4)
        ->and($retry->delay(3))->toBe(8);
});

it('exponential strategy respects a custom base', function () {
    $retry = Retry::exponential(base: 2);

    expect($retry->delay(0))->toBe(2)
        ->and($retry->delay(1))->toBe(4)
        ->and($retry->delay(2))->toBe(8);
});

it('fixed strategy always returns the configured delay', function () {
    $retry = Retry::fixed(seconds: 5);

    expect($retry->delay(0))->toBe(5)
        ->and($retry->delay(1))->toBe(5)
        ->and($retry->delay(10))->toBe(5);
});

it('fixed strategy defaults to two seconds', function () {
    $retry = Retry::fixed();

    expect($retry->delay(0))->toBe(2);
});
