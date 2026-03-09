<?php

namespace Phizz\Generator\Interfaces;

interface Writable
{
    public function namespace(): string;

    public function directory(): string;

    public function imports(): array;

    public function filename(): string;

    public function path(): string;

    public function write(): void;
}
