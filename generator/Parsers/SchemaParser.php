<?php

namespace Phizz\Generator\Parsers;

use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\Reader;
use cebe\openapi\spec\OpenApi;

/**
 * @extends FileParser<OpenApi>
 */
class SchemaParser extends FileParser
{
    /**
     * @throws TypeErrorException
     */
    public function parseContent(string $content): OpenApi
    {
        return Reader::readFromYaml($content);
    }
}
