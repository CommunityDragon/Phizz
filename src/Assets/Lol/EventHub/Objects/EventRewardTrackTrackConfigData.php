<?php

namespace Phizz\Assets\Lol\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $premium_entitlement_id
 * @property-read EventRewardTrackTrackConfigPremiumEntitlementData $premiumEntitlement
 */
class EventRewardTrackTrackConfigData extends StaticData
{
    protected array $objects = [
        'premium_entitlement' => EventRewardTrackTrackConfigPremiumEntitlementData::class,
    ];
}
