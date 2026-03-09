<?php

namespace Phizz\Enums;

enum Platform: string
{
    /**
     * Brazil.
     */
    case BR = 'br1';

    /**
     * Europe, Northeast.
     */
    case EUNE = 'eun1';

    /**
     * Europe, West.
     */
    case EUW = 'euw1';

    /**
     * Japan.
     */
    case JP = 'jp1';

    /**
     * Korea.
     */
    case KR = 'kr';

    /**
     * Latin America, North.
     */
    case LAN = 'la1';

    /**
     * Latin America, South.
     */
    case LAS = 'la2';

    /**
     * Middle East and North Africa.
     */
    case MENA = 'me1';

    /**
     * North America.
     */
    case NA = 'na1';

    /**
     * Oceania.
     */
    case OCE = 'oc1';

    /**
     * Philippines, moved into `sg2` on 2025-01-08.
     *
     * @deprecated
     */
    case PH = 'ph2';

    /**
     * Russia
     */
    case RU = 'ru';

    /**
     * Singapore, Thailand, Philippines
     */
    case SG = 'sg2';

    /**
     * Thailand, moved into `sg2` on 2025-01-08.
     *
     * @deprecated
     */
    case TH = 'th2';

    /**
     * Turkey
     */
    case TR = 'tr1';

    /**
     * Taiwan
     */
    case TW = 'tw2';

    /**
     * Vietnam
     */
    case VN = 'vn2';

    /**
     * Public Beta Environment, special beta testing platform. Located in North America.
     */
    case PBE = 'pbe1';

    public function id(): int
    {
        return match ($this) {
            Platform::BR => 16,
            Platform::EUNE => 17,
            Platform::EUW => 18,
            Platform::JP => 19,
            Platform::KR => 20,
            Platform::LAN => 21,
            Platform::LAS => 22,
            Platform::MENA => 37,
            Platform::NA => 23,
            Platform::OCE => 24,
            Platform::PH => 32,
            Platform::RU => 25,
            Platform::SG => 33,
            Platform::TH => 34,
            Platform::TR => 26,
            Platform::TW => 35,
            Platform::VN => 36,
            Platform::PBE => 31,
        };
    }

    public function description(): string
    {
        return match ($this) {
            Platform::BR => 'Brazil.',
            Platform::EUNE => 'Europe, Northeast.',
            Platform::EUW => 'Europe, West.',
            Platform::JP => 'Japan.',
            Platform::KR => 'Korea.',
            Platform::LAN => 'Latin America, North.',
            Platform::LAS => 'Latin America, South.',
            Platform::MENA => 'Middle East and North Africa.',
            Platform::NA => 'North America.',
            Platform::OCE => 'Oceania.',
            Platform::PH => 'Philippines, moved into `sg2` on 2025-01-08.',
            Platform::RU => 'Russia',
            Platform::SG => 'Singapore, Thailand, Philippines',
            Platform::TH => 'Thailand, moved into `sg2` on 2025-01-08.',
            Platform::TR => 'Turkey',
            Platform::TW => 'Taiwan',
            Platform::VN => 'Vietnam',
            Platform::PBE => 'Public Beta Environment, special beta testing platform. Located in North America.',
        };
    }

    public function tournamentRegion(): ?string
    {
        return match ($this) {
            Platform::BR => 'BR',
            Platform::EUNE => 'EUNE',
            Platform::EUW => 'EUW',
            Platform::JP => 'JP',
            Platform::KR => null,
            Platform::LAN => 'LAN',
            Platform::LAS => 'LAS',
            Platform::MENA => null,
            Platform::NA => 'NA',
            Platform::OCE => 'OCE',
            Platform::PH => null,
            Platform::RU => null,
            Platform::SG => null,
            Platform::TH => null,
            Platform::TR => 'TR',
            Platform::TW => null,
            Platform::VN => null,
            Platform::PBE => 'PBE',
        };
    }

    public function regional(): Regional
    {
        return match ($this) {
            Platform::BR => Regional::Americas,
            Platform::EUNE => Regional::Europe,
            Platform::EUW => Regional::Europe,
            Platform::JP => Regional::Asia,
            Platform::KR => Regional::Asia,
            Platform::LAN => Regional::Americas,
            Platform::LAS => Regional::Americas,
            Platform::MENA => Regional::Europe,
            Platform::NA => Regional::Americas,
            Platform::OCE => Regional::SEA,
            Platform::PH => Regional::SEA,
            Platform::RU => Regional::Europe,
            Platform::SG => Regional::SEA,
            Platform::TH => Regional::SEA,
            Platform::TR => Regional::Europe,
            Platform::TW => Regional::SEA,
            Platform::VN => Regional::SEA,
            Platform::PBE => Regional::Americas,
        };
    }

    public function lorRegional(): Regional
    {
        return match ($this) {
            Platform::BR => Regional::Americas,
            Platform::EUNE => Regional::Europe,
            Platform::EUW => Regional::Europe,
            Platform::JP => Regional::Asia,
            Platform::KR => Regional::Asia,
            Platform::LAN => Regional::Americas,
            Platform::LAS => Regional::Americas,
            Platform::MENA => Regional::Europe,
            Platform::NA => Regional::Americas,
            Platform::OCE => Regional::SEA,
            Platform::PH => Regional::SEA,
            Platform::RU => Regional::SEA,
            Platform::SG => Regional::SEA,
            Platform::TH => Regional::SEA,
            Platform::TR => Regional::SEA,
            Platform::TW => Regional::SEA,
            Platform::VN => Regional::SEA,
            Platform::PBE => Regional::Americas,
        };
    }

    public function deprecated(): bool
    {
        return match ($this) {
            Platform::BR => false,
            Platform::EUNE => false,
            Platform::EUW => false,
            Platform::JP => false,
            Platform::KR => false,
            Platform::LAN => false,
            Platform::LAS => false,
            Platform::MENA => false,
            Platform::NA => false,
            Platform::OCE => false,
            Platform::PH => true,
            Platform::RU => false,
            Platform::SG => false,
            Platform::TH => true,
            Platform::TR => false,
            Platform::TW => false,
            Platform::VN => false,
            Platform::PBE => false,
        };
    }
}
