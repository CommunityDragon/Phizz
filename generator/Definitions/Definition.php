<?php

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Path;

/**
 * @template T
 */
abstract class Definition
{
    protected function resolveNamespace(?string $namespace = null): string
    {
        $result = 'Phizz';

        if (! blank($namespace)) {
            $result .= '\\'.Str::replaceStart('\\', '', $namespace);
        }

        return $result;
    }

    protected function resolvePath(?string $path = null): string
    {
        $result = Path::join(__DIR__, '../../src');

        if (! blank($path)) {
            $result = Path::join($result, $path);
        }

        return $result;
    }

    /**
     * @return T
     */
    abstract public function definition();
}
