<?php

namespace Phizz\Generator\Objects;

/**
 * Represents a single field detected from a CommunityDragon JSON sample.
 */
class CDragonField
{
    /**
     * @param  CDragonField[]  $subFields  Populated for object/list-of-objects fields.
     */
    public function __construct(
        /** Raw JSON key name (camelCase) */
        public string $name,
        /** Inferred PHP type: int, float, bool, string, array, mixed */
        public string $phpType,
        /** True if any sample item had null or was missing this field */
        public bool $nullable,
        /** True if name ends in "Path" and value starts with /lol-game-data/assets */
        public bool $isPath,
        /** True if the value is a JSON list array */
        public bool $isList,
        /** Schema of the items/value when this is an object or list-of-objects */
        public array $subFields = [],
        /** True if the value is an associative sub-object (not a list) */
        public bool $isObject = false,
    ) {}
}
