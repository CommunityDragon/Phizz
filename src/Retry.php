<?php

namespace Phizz;

use Closure;

class Retry
{
    private function __construct(private readonly Closure $delay) {}

    public function delay(int $attempt): int
    {
        return ($this->delay)($attempt);
    }

    public static function exponential(int $base = 1): self
    {
        return new self(fn (int $attempt) => $base * (2 ** $attempt));
    }

    public static function fixed(int $seconds = 2): self
    {
        return new self(fn () => $seconds);
    }
}
