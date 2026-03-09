<?php

namespace Phizz\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Phizz\Phizz
 *
 * @mixin \Phizz\Phizz
 */
class Phizz extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Phizz\Phizz::class;
    }
}
