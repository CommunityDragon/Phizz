<?php

namespace Phizz\Generator\Objects;

use cebe\openapi\spec\Operation;

class ApiRoute
{
    public function __construct(
        public readonly string $endpoint,
        public readonly string $method,
        public readonly Operation $op,
    ) {}
}
