<?php

namespace Phizz\Enums;

enum Regional: string
{
    /**
     * North and South America.
     */
    case Americas = 'americas';

    /**
     * Asia, used for LoL matches (`match-v5`) and TFT matches (`tft-match-v1`).
     */
    case Asia = 'asia';

    /**
     * Europe.
     */
    case Europe = 'europe';

    /**
     * South East Asia, used for LoR, LoL matches (`match-v5`), and TFT matches (`tft-match-v1`).
     */
    case SEA = 'sea';

    /**
     * Asia-Pacific, deprecated, for some old matches in `lor-match-v1`.
     *
     * @deprecated
     */
    case APAC = 'apac';

    /**
     * Special esports platform for `account-v1`. Do not confuse with the `esports` Valorant platform route.
     */
    case Esports = 'esports';

    /**
     * Special Europe esports platform for `account-v1`. Do not confuse with the `esports` Valorant platform route.
     */
    case EsportsEU = 'esportseu';

    public function id(): int
    {
        return match ($this) {
            Regional::Americas => 1,
            Regional::Asia => 2,
            Regional::Europe => 3,
            Regional::SEA => 4,
            Regional::APAC => 10,
            Regional::Esports => 11,
            Regional::EsportsEU => 12,
        };
    }

    public function description(): string
    {
        return match ($this) {
            Regional::Americas => 'North and South America.',
            Regional::Asia => 'Asia, used for LoL matches (`match-v5`) and TFT matches (`tft-match-v1`).',
            Regional::Europe => 'Europe.',
            Regional::SEA => 'South East Asia, used for LoR, LoL matches (`match-v5`), and TFT matches (`tft-match-v1`).',
            Regional::APAC => 'Asia-Pacific, deprecated, for some old matches in `lor-match-v1`.',
            Regional::Esports => 'Special esports platform for `account-v1`. Do not confuse with the `esports` Valorant platform route.',
            Regional::EsportsEU => 'Special Europe esports platform for `account-v1`. Do not confuse with the `esports` Valorant platform route.',
        };
    }

    public function deprecated(): bool
    {
        return match ($this) {
            Regional::Americas => false,
            Regional::Asia => false,
            Regional::Europe => false,
            Regional::SEA => false,
            Regional::APAC => true,
            Regional::Esports => false,
            Regional::EsportsEU => false,
        };
    }
}
