<?php

namespace Phizz\Enums;

enum GameType: string
{
    /**
     * Custom games
     */
    case CustomGame = 'CUSTOM_GAME';

    /**
     * all other games
     */
    case MatchedGame = 'MATCHED_GAME';

    /**
     * Tutorial games
     */
    case TutorialGame = 'TUTORIAL_GAME';
}
