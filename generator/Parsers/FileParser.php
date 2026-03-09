<?php

namespace Phizz\Generator\Parsers;

use Exception;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @template T of mixed
 */
class FileParser
{
    public function __construct(protected OutputInterface $console) {}

    /**
     * @return T
     *
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function parse(string $file)
    {
        $source = Str::isUrl($file) ? 'URL' : 'file';
        $this->console->writeln("Reading file from $source: $file");

        $content = $this->getContent($file);
        $this->console->writeln('Parsing file...');

        $object = $this->parseContent($content);
        $this->console->writeln('File parsed successfully.');

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
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    protected function getContent(string $file): string
    {
        return Str::isUrl($file) ? $this->getUrl($file) : $this->getFile($file);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function getUrl(string $file): string
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $file);

        return $response->getContent();
    }

    /**
     * @throws Exception
     */
    protected function getFile(string $file): string
    {
        $finder = new Finder;

        /** @var SplFileInfo|null $file */
        $file = $finder->path($file)->files()[0];

        if (empty($file)) {
            throw new Exception("File not found: $file");
        }

        return $file->getContents();
    }
}
