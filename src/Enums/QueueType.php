<?php

namespace Phizz\Enums;

enum QueueType: int
{
    /**
     * 5v5 Ranked Solo games
     */
    case RankedSolo5x5 = 420;

    /**
     * 5v5 Ranked Flex games
     */
    case RankedFlexSr = 440;

    /**
     * 3v3 Ranked Flex games
     *
     * @deprecated Deprecated in patch 9.23
     */
    case RankedFlexTt = 470;

    /**
     * Ranked Teamfight Tactics games
     */
    case RankedTft = 1100;

    /**
     * Ranked Teamfight Tactics (Hyper Roll) games
     */
    case RankedTftTurbo = 1130;

    /**
     * Ranked Teamfight Tactics (Double Up Workshop) games
     *
     * @deprecated Deprecated in patch 12.11 in favor of queueId 1160 (`RANKED_TFT_DOUBLE_UP`)
     */
    case RankedTftPairs = 1150;

    /**
     * Ranked Teamfight Tactics (Double Up Workshop) games
     */
    case RankedTftDoubleUp = 1160;

    /**
     * "Arena" games
     */
    case Cherry = 1710;
}
