<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\Definition;
use Phizz\Generator\Objects\Configuration;

abstract class Generator
{
    public function __construct(protected readonly Configuration $config) {}

    /**
     * @return Definition[]
     */
    abstract public function definitions(): array;
}
