<?php

namespace Phizz\Enums;

enum ValPlatform: string
{
    /**
     * Asia-Pacific.
     */
    case AP = 'ap';

    /**
     * Brazil.
     */
    case BR = 'br';

    /**
     * Europe.
     */
    case EU = 'eu';

    /**
     * Korea.
     */
    case KR = 'kr';

    /**
     * Latin America.
     */
    case LatAm = 'latam';

    /**
     * North America.
     */
    case NA = 'na';

    /**
     * Special esports platform.
     */
    case Esports = 'esports';

    public function id(): int
    {
        return match ($this) {
            ValPlatform::AP => 64,
            ValPlatform::BR => 65,
            ValPlatform::EU => 66,
            ValPlatform::KR => 70,
            ValPlatform::LatAm => 68,
            ValPlatform::NA => 69,
            ValPlatform::Esports => 95,
        };
    }

    public function description(): string
    {
        return match ($this) {
            ValPlatform::AP => 'Asia-Pacific.',
            ValPlatform::BR => 'Brazil.',
            ValPlatform::EU => 'Europe.',
            ValPlatform::KR => 'Korea.',
            ValPlatform::LatAm => 'Latin America.',
            ValPlatform::NA => 'North America.',
            ValPlatform::Esports => 'Special esports platform.',
        };
    }
}
