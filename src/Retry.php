<?php

namespace Phizz;

class Retry
{
    private function __construct(
        private readonly string $strategy,
        private readonly int $value,
    ) {}

    public function delay(int $attempt): int
    {
        return match ($this->strategy) {
            'exponential' => $this->value * (2 ** $attempt),
            default => $this->value,
        };
    }

    public static function exponential(int $base = 1): self
    {
        return new self('exponential', $base);
    }

    public static function fixed(int $seconds = 2): self
    {
        return new self('fixed', $seconds);
    }
}
