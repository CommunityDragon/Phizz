<?php

namespace Phizz\Generator\Parsers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

/**
 * @template T of mixed
 */
class FileParser
{
    public function __construct(
        protected OutputInterface $console,
        protected Client $client = new Guzzle(['timeout' => 30])
    ) {}

    /**
     * @return T
     *
     * @throws GuzzleException
     */
    public function parse(string $entry)
    {
        $filename = basename($entry);
        $source = Str::isUrl($entry) ? 'url' : 'file';

        $this->console->writeln(
            "  <fg=blue;options=bold>  GET  </>  <fg=white>$filename</>  <fg=gray>{$source}</>"
        );

        [$content, $size] = $this->getContent($entry);
        $kb = number_format($size / 1024, 1);

        $object = $this->parseContent($content);

        $this->console->writeln(
            "  <fg=green>   ✓   </>  <fg=cyan>$kb KB</>  <fg=gray>fetched and parsed</>"
        );

        return $object;
    }

    /**
     * @return T
     */
    protected function parseContent(string $content)
    {
        return Yaml::parse($content);
    }

    /**
     * @return array{0: string, 1: int}
     *
     * @throws GuzzleException
     */
    protected function getContent(string $file): array
    {
        return Str::isUrl($file) ? $this->getUrl($file) : $this->getFile($file);
    }

    /**
     * @return array{0: string, 1: int}
     *
     * @throws GuzzleException
     */
    protected function getUrl(string $file): array
    {
        $response = $this->client->get($file);
        $body = $response->getBody();
        $size = $response->getHeader('Content-Length')[0] ?? -1;
        if ($size === -1) {
            $size = $body->getSize();
        }

        return [(string) $body, $size];
    }

    /**
     * @return array{0: string, 1: int}
     *
     * @throws Exception
     */
    protected function getFile(string $file): array
    {
        $finder = new Finder;

        $results = array_values(iterator_to_array($finder->path($file)->files()));
        /** @var SplFileInfo|null $found */
        $found = $results[0] ?? null;

        if (empty($found)) {
            throw new Exception("File not found: $file");
        }

        $content = $found->getContents();
        $size = $found->getSize() === false ? 0 : $found->getSize();

        return [$content, $size];
    }
}
