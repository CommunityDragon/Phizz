<?php

namespace Phizz\Enums;

enum GameMap: int
{
    /**
     * Summoner's Rift
     * Original Summer variant
     *
     * @deprecated
     */
    case SummonersRiftOriginalSummerVariant = 1;

    /**
     * Summoner's Rift
     * Original Autumn variant
     *
     * @deprecated
     */
    case SummonersRiftOriginalAutumnVariant = 2;

    /**
     * The Proving Grounds
     * Tutorial Map
     */
    case TheProvingGrounds = 3;

    /**
     * Twisted Treeline
     * Original Version
     *
     * @deprecated
     */
    case TwistedTreelineOriginalVersion = 4;

    /**
     * The Crystal Scar
     * Dominion map
     */
    case TheCrystalScar = 8;

    /**
     * Twisted Treeline
     * Last TT map
     */
    case TwistedTreeline = 10;

    /**
     * Summoner's Rift
     * Current Version
     */
    case SummonersRift = 11;

    /**
     * Howling Abyss
     * ARAM map
     */
    case HowlingAbyss = 12;

    /**
     * Butcher's Bridge
     * Alternate ARAM map
     */
    case ButchersBridge = 14;

    /**
     * Cosmic Ruins
     * Dark Star: Singularity map
     */
    case CosmicRuins = 16;

    /**
     * Valoran City Park
     * Star Guardian Invasion map
     */
    case ValoranCityPark = 18;

    /**
     * Substructure 43
     * PROJECT: Hunters map
     */
    case Substructure43 = 19;

    /**
     * Crash Site
     * Odyssey: Extraction map
     */
    case CrashSite = 20;

    /**
     * Nexus Blitz
     * Nexus Blitz map
     */
    case NexusBlitz = 21;

    /**
     * Convergence
     * Teamfight Tactics map
     */
    case Convergence = 22;

    /**
     * Arena
     * Map for 2v2v2v2 (`CHERRY`). Team up with a friend or venture solo in this new game mode. Face against multiple teams in chaotic battles across diverse arenas
     */
    case Arena = 30;

    /**
     * Swarm
     * Map for Swarm (`STRAWBERRY`). Team up with a friend or venture solo in this horde survival mode.
     */
    case Swarm = 33;

    /**
     * The Bandlewood
     * Map for Brawl (`BRAWL`). Work together with your team to escort minions into the enemy portal. No roles, no lanes, no pressure. Just a five-on-five brawl.
     */
    case TheBandlewood = 35;
}
