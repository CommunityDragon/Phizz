<?php

namespace Phizz\Enums;

enum GameQueue: int
{
    /**
     * Games on Custom games
     */
    case Custom = 0;

    /**
     * 5v5 Blind Pick games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 430
     */
    case SummonersRift5v5BlindPickDeprecated2 = 2;

    /**
     * 5v5 Ranked Solo games on Summoner's Rift
     *
     * @deprecated Deprecated in favor of queueId 420
     */
    case SummonersRift5v5RankedSoloDeprecated4 = 4;

    /**
     * 5v5 Ranked Premade games on Summoner's Rift
     *
     * @deprecated Game mode deprecated
     */
    case SummonersRift5v5RankedPremade = 6;

    /**
     * Co-op vs AI games on Summoner's Rift
     *
     * @deprecated Deprecated in favor of queueId 32 and 33
     */
    case SummonersRiftCoOpVsAi = 7;

    /**
     * 3v3 Normal games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 460
     */
    case TwistedTreeline3v3Normal = 8;

    /**
     * 3v3 Ranked Flex games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 470
     */
    case TwistedTreeline3v3RankedFlexDeprecated9 = 9;

    /**
     * 5v5 Draft Pick games on Summoner's Rift
     *
     * @deprecated Deprecated in favor of queueId 400
     */
    case SummonersRift5v5DraftPickDeprecated14 = 14;

    /**
     * 5v5 Dominion Blind Pick games on Crystal Scar
     *
     * @deprecated Game mode deprecated
     */
    case CrystalScar5v5DominionBlindPick = 16;

    /**
     * 5v5 Dominion Draft Pick games on Crystal Scar
     *
     * @deprecated Game mode deprecated
     */
    case CrystalScar5v5DominionDraftPick = 17;

    /**
     * Dominion Co-op vs AI games on Crystal Scar
     *
     * @deprecated Game mode deprecated
     */
    case CrystalScarDominionCoOpVsAi = 25;

    /**
     * Co-op vs AI Intro Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 830
     */
    case SummonersRiftCoOpVsAiIntroBotDeprecated31 = 31;

    /**
     * Co-op vs AI Beginner Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 840
     */
    case SummonersRiftCoOpVsAiBeginnerBotDeprecated32 = 32;

    /**
     * Co-op vs AI Intermediate Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 850
     */
    case SummonersRiftCoOpVsAiIntermediateBotDeprecated33 = 33;

    /**
     * 3v3 Ranked Team games on Twisted Treeline
     *
     * @deprecated Game mode deprecated
     */
    case TwistedTreeline3v3RankedTeam = 41;

    /**
     * 5v5 Ranked Team games on Summoner's Rift
     *
     * @deprecated Game mode deprecated
     */
    case SummonersRift5v5RankedTeam = 42;

    /**
     * Co-op vs AI games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 800
     */
    case TwistedTreelineCoOpVsAi = 52;

    /**
     * 5v5 Team Builder games on Summoner's Rift
     *
     * @deprecated Game mode deprecated
     */
    case SummonersRift5v5TeamBuilder = 61;

    /**
     * 5v5 ARAM games on Howling Abyss
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 450
     */
    case HowlingAbyss5v5AramDeprecated65 = 65;

    /**
     * ARAM Co-op vs AI games on Howling Abyss
     *
     * @deprecated Game mode deprecated
     */
    case HowlingAbyssAramCoOpVsAi = 67;

    /**
     * One for All games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 8.6 in favor of queueId 1020
     */
    case SummonersRiftOneForAllDeprecated70 = 70;

    /**
     * 1v1 Snowdown Showdown games on Howling Abyss
     */
    case HowlingAbyss1v1SnowdownShowdown = 72;

    /**
     * 2v2 Snowdown Showdown games on Howling Abyss
     */
    case HowlingAbyss2v2SnowdownShowdown = 73;

    /**
     * 6v6 Hexakill games on Summoner's Rift
     */
    case SummonersRift6v6Hexakill = 75;

    /**
     * Ultra Rapid Fire games on Summoner's Rift
     */
    case SummonersRiftUltraRapidFire = 76;

    /**
     * One For All: Mirror Mode games on Howling Abyss
     */
    case HowlingAbyssOneForAllMirrorMode = 78;

    /**
     * Co-op vs AI Ultra Rapid Fire games on Summoner's Rift
     */
    case SummonersRiftCoOpVsAiUltraRapidFire = 83;

    /**
     * Doom Bots Rank 1 games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 950
     */
    case SummonersRiftDoomBotsRank1 = 91;

    /**
     * Doom Bots Rank 2 games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 950
     */
    case SummonersRiftDoomBotsRank2 = 92;

    /**
     * Doom Bots Rank 5 games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 950
     */
    case SummonersRiftDoomBotsRank5 = 93;

    /**
     * Ascension games on Crystal Scar
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 910
     */
    case CrystalScarAscensionDeprecated96 = 96;

    /**
     * 6v6 Hexakill games on Twisted Treeline
     */
    case TwistedTreeline6v6Hexakill = 98;

    /**
     * 5v5 ARAM games on Butcher's Bridge
     */
    case ButchersBridge5v5Aram = 100;

    /**
     * Legend of the Poro King games on Howling Abyss
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 920
     */
    case HowlingAbyssLegendOfThePoroKingDeprecated300 = 300;

    /**
     * Nemesis games on Summoner's Rift
     */
    case SummonersRiftNemesis = 310;

    /**
     * Black Market Brawlers games on Summoner's Rift
     */
    case SummonersRiftBlackMarketBrawlers = 313;

    /**
     * Nexus Siege games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 940
     */
    case SummonersRiftNexusSiegeDeprecated315 = 315;

    /**
     * Definitely Not Dominion games on Crystal Scar
     */
    case CrystalScarDefinitelyNotDominion = 317;

    /**
     * ARURF games on Summoner's Rift
     *
     * @deprecated Deprecated in patch 7.19 in favor of queueId 900
     */
    case SummonersRiftArurfDeprecated318 = 318;

    /**
     * All Random games on Summoner's Rift
     */
    case SummonersRiftAllRandom = 325;

    /**
     * 5v5 Draft Pick games on Summoner's Rift
     */
    case SummonersRift5v5DraftPick = 400;

    /**
     * 5v5 Ranked Dynamic games on Summoner's Rift
     *
     * @deprecated Game mode deprecated in patch 6.22
     */
    case SummonersRift5v5RankedDynamic = 410;

    /**
     * 5v5 Ranked Solo games on Summoner's Rift
     */
    case SummonersRift5v5RankedSolo = 420;

    /**
     * 5v5 Blind Pick games on Summoner's Rift
     */
    case SummonersRift5v5BlindPick = 430;

    /**
     * 5v5 Ranked Flex games on Summoner's Rift
     */
    case SummonersRift5v5RankedFlex = 440;

    /**
     * 5v5 ARAM games on Howling Abyss
     */
    case HowlingAbyss5v5Aram = 450;

    /**
     * 3v3 Blind Pick games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 9.23
     */
    case TwistedTreeline3v3BlindPick = 460;

    /**
     * 3v3 Ranked Flex games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 9.23
     */
    case TwistedTreeline3v3RankedFlexDeprecated470 = 470;

    /**
     * Normal (Swiftplay) games on Summoner's Rift
     */
    case SummonersRiftNormalSwiftplay = 480;

    /**
     * Normal (Quickplay) games on Summoner's Rift
     */
    case SummonersRiftNormalQuickplay = 490;

    /**
     * Blood Hunt Assassin games on Summoner's Rift
     */
    case SummonersRiftBloodHuntAssassin = 600;

    /**
     * Dark Star: Singularity games on Cosmic Ruins
     */
    case CosmicRuinsDarkStarSingularity = 610;

    /**
     * Summoner's Rift Clash games on Summoner's Rift
     */
    case SummonersRiftClash = 700;

    /**
     * ARAM Clash games on Howling Abyss
     */
    case HowlingAbyssAramClash = 720;

    /**
     * Co-op vs. AI Intermediate Bot games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 9.23
     */
    case TwistedTreelineCoOpVsAiIntermediateBot = 800;

    /**
     * Co-op vs. AI Intro Bot games on Twisted Treeline
     *
     * @deprecated Deprecated in patch 9.23
     */
    case TwistedTreelineCoOpVsAiIntroBot = 810;

    /**
     * Co-op vs. AI Beginner Bot games on Twisted Treeline
     */
    case TwistedTreelineCoOpVsAiBeginnerBot = 820;

    /**
     * Co-op vs. AI Intro Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in March 2024 in favor of queueId 870
     */
    case SummonersRiftCoOpVsAiIntroBotDeprecated830 = 830;

    /**
     * Co-op vs. AI Beginner Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in March 2024 in favor of queueId 880
     */
    case SummonersRiftCoOpVsAiBeginnerBotDeprecated840 = 840;

    /**
     * Co-op vs. AI Intermediate Bot games on Summoner's Rift
     *
     * @deprecated Deprecated in March 2024 in favor of queueId 890
     */
    case SummonersRiftCoOpVsAiIntermediateBotDeprecated850 = 850;

    /**
     * Co-op vs. AI Intro Bot games on Summoner's Rift
     */
    case SummonersRiftCoOpVsAiIntroBot = 870;

    /**
     * Co-op vs. AI Beginner Bot games on Summoner's Rift
     */
    case SummonersRiftCoOpVsAiBeginnerBot = 880;

    /**
     * Co-op vs. AI Intermediate Bot games on Summoner's Rift
     */
    case SummonersRiftCoOpVsAiIntermediateBot = 890;

    /**
     * ARURF games on Summoner's Rift
     */
    case SummonersRiftArurf = 900;

    /**
     * Ascension games on Crystal Scar
     */
    case CrystalScarAscension = 910;

    /**
     * Legend of the Poro King games on Howling Abyss
     */
    case HowlingAbyssLegendOfThePoroKing = 920;

    /**
     * Nexus Siege games on Summoner's Rift
     */
    case SummonersRiftNexusSiege = 940;

    /**
     * Doom Bots Voting games on Summoner's Rift
     */
    case SummonersRiftDoomBotsVoting = 950;

    /**
     * Doom Bots Standard games on Summoner's Rift
     */
    case SummonersRiftDoomBotsStandard = 960;

    /**
     * Star Guardian Invasion: Normal games on Valoran City Park
     */
    case ValoranCityParkStarGuardianInvasionNormal = 980;

    /**
     * Star Guardian Invasion: Onslaught games on Valoran City Park
     */
    case ValoranCityParkStarGuardianInvasionOnslaught = 990;

    /**
     * PROJECT: Hunters games on Overcharge
     */
    case OverchargeProjectHunters = 1000;

    /**
     * Snow ARURF games on Summoner's Rift
     */
    case SummonersRiftSnowArurf = 1010;

    /**
     * One for All games on Summoner's Rift
     */
    case SummonersRiftOneForAll = 1020;

    /**
     * Odyssey Extraction: Intro games on Crash Site
     */
    case CrashSiteOdysseyExtractionIntro = 1030;

    /**
     * Odyssey Extraction: Cadet games on Crash Site
     */
    case CrashSiteOdysseyExtractionCadet = 1040;

    /**
     * Odyssey Extraction: Crewmember games on Crash Site
     */
    case CrashSiteOdysseyExtractionCrewmember = 1050;

    /**
     * Odyssey Extraction: Captain games on Crash Site
     */
    case CrashSiteOdysseyExtractionCaptain = 1060;

    /**
     * Odyssey Extraction: Onslaught games on Crash Site
     */
    case CrashSiteOdysseyExtractionOnslaught = 1070;

    /**
     * Teamfight Tactics games on Convergence
     */
    case ConvergenceTeamfightTactics = 1090;

    /**
     * Teamfight Tactics 1v0 games on Convergence
     */
    case ConvergenceTeamfightTactics1v0 = 1091;

    /**
     * Teamfight Tactics 2v0 games on Convergence
     */
    case ConvergenceTeamfightTactics2v0 = 1092;

    /**
     * Ranked Teamfight Tactics games on Convergence
     */
    case ConvergenceRankedTeamfightTactics = 1100;

    /**
     * Teamfight Tactics Tutorial games on Convergence
     */
    case ConvergenceTeamfightTacticsTutorial = 1110;

    /**
     * Teamfight Tactics Simluation games on Convergence
     */
    case ConvergenceTeamfightTacticsSimluation = 1111;

    /**
     * Ranked Teamfight Tactics (Hyper Roll) games on Convergence
     */
    case ConvergenceRankedTeamfightTacticsHyperRoll = 1130;

    /**
     * Ranked Teamfight Tactics (Double Up Workshop) games on Convergence
     *
     * @deprecated Deprecated in patch 12.11 in favor of queueId 1160
     */
    case ConvergenceRankedTeamfightTacticsDoubleUpWorkshopDeprecated1150 = 1150;

    /**
     * Ranked Teamfight Tactics (Double Up Workshop) games on Convergence
     */
    case ConvergenceRankedTeamfightTacticsDoubleUpWorkshop = 1160;

    /**
     * Nexus Blitz games on Nexus Blitz
     *
     * @deprecated Deprecated in patch 9.2 in favor of queueId 1300
     */
    case NexusBlitzDeprecated1200 = 1200;

    /**
     * Teamfight Tactics (Choncc's Treasure) games on Convergence
     */
    case ConvergenceTeamfightTacticsChonccsTreasure = 1210;

    /**
     * Teamfight Tactics: Tocker's Trials games on Convergence
     */
    case ConvergenceTeamfightTacticsTockersTrials = 1220;

    /**
     * Nexus Blitz games on Nexus Blitz
     */
    case NexusBlitz = 1300;

    /**
     * Ultimate Spellbook games on Summoner's Rift
     */
    case SummonersRiftUltimateSpellbook = 1400;

    /**
     * 2v2v2v2 `CHERRY` games on Arena
     */
    case Arena2v2v2v2Cherry = 1700;

    /**
     * Arena (`CHERRY` games) games on Rings of Wrath
     */
    case RingsOfWrathArenaCherryGames = 1710;

    /**
     * Swarm solo (`STRAWBERRY` games) games on Swarm
     */
    case SwarmSoloStrawberryGames = 1810;

    /**
     * Swarm duo (`STRAWBERRY` games) games on Swarm
     */
    case SwarmDuoStrawberryGames = 1820;

    /**
     * Swarm trio (`STRAWBERRY` games) games on Swarm
     */
    case SwarmTrioStrawberryGames = 1830;

    /**
     * Swarm quad (`STRAWBERRY` games) games on Swarm
     */
    case SwarmQuadStrawberryGames = 1840;

    /**
     * Pick URF games on Summoner's Rift
     */
    case SummonersRiftPickUrf = 1900;

    /**
     * Tutorial 1 games on Summoner's Rift
     */
    case SummonersRiftTutorial1 = 2000;

    /**
     * Tutorial 2 games on Summoner's Rift
     */
    case SummonersRiftTutorial2 = 2010;

    /**
     * Tutorial 3 games on Summoner's Rift
     */
    case SummonersRiftTutorial3 = 2020;

    /**
     * Games on The Bandlewood
     */
    case TheBandlewood = 2300;

    /**
     * ARAM: Mayhem games on Howling Abyss
     */
    case HowlingAbyssAramMayhem = 2400;

    /**
     * Teamfight Tactics Set 3.5 Revival games on Convergence
     */
    case ConvergenceTeamfightTacticsSet35Revival = 6000;

    /**
     * Teamfight Tactics Revival: Festival of Beasts games on Convergence
     */
    case ConvergenceTeamfightTacticsRevivalFestivalOfBeasts = 6100;

    /**
     * Teamfight Tactics Revival: Remix Rumble games on Convergence
     */
    case ConvergenceTeamfightTacticsRevivalRemixRumble = 6110;

    /**
     * Teamfight Tactics: Pengu's Party games on Convergence
     */
    case ConvergenceTeamfightTacticsPengusParty = 6120;
}
