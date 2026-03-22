<?php

namespace Phizz\Generator\Objects;

/**
 * Represents one CommunityDragon JSON file and its inferred schema.
 */
class CDragonEndpoint
{
    /**
     * @param  CDragonField[]  $fields
     */
    public function __construct(
        /** Filename, e.g. "items.json" or directory name "champions" */
        public string $file,
        /** Slug without extension, e.g. "items" or "champions" */
        public string $slug,
        /** True if the top-level JSON value is an array */
        public bool $isArray,
        /** Name of the id field if one exists (typically "id") */
        public ?string $idField,
        public array $fields,
        /**
         * True when this endpoint is a directory of per-ID JSON files
         * (e.g. v1/champions/{id}.json) rather than a single flat file.
         */
        public bool $isDirectory = false,
    ) {}

    /** @return CDragonField[] */
    public function pathFields(): array
    {
        return array_values(array_filter($this->fields, fn (CDragonField $f) => $f->isPath));
    }
}
