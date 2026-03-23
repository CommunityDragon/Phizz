<?php

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\ClassType;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\StaticApi;
use Phizz\Support\StaticClient;

/**
 * Generates AssetClient — a thin wrapper that exposes $lol and $tft sub-clients.
 *
 * @extends Definition<ClassType>
 */
class CDragonClientDefinition extends Definition implements Writable
{
    use HasWrite;

    public function namespace(): string
    {
        return $this->resolveNamespace('Assets');
    }

    public function directory(): string
    {
        return $this->resolvePath('Assets');
    }

    public function imports(): array
    {
        return [
            StaticApi::class,
            StaticClient::class,
            $this->resolveNamespace('Assets\\Lol').'\\LolClient',
            $this->resolveNamespace('Assets\\Tft').'\\TftClient',
        ];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType('AssetClient'))
            ->setExtends(StaticApi::class);

        $class->addProperty('lol')
            ->setType($this->resolveNamespace('Assets\\Lol').'\\LolClient')
            ->setPublic()
            ->setReadOnly();

        $class->addProperty('tft')
            ->setType($this->resolveNamespace('Assets\\Tft').'\\TftClient')
            ->setPublic()
            ->setReadOnly();

        $ctor = $class->addMethod('__construct')
            ->setPublic();
        $ctor->addParameter('version')->setType('string');
        $ctor->addParameter('http')->setType(StaticClient::class);
        $ctor->setBody(
            'parent::__construct($version, $http);'."\n".
            '$this->lol = new LolClient($version, $http);'."\n".
            '$this->tft = new TftClient($version, $http);'
        );

        $class->addMethod('version')
            ->setReturnType('string')
            ->addComment('Returns the CommunityDragon patch version this client is scoped to.')
            ->setBody('return $this->version;');

        return $class;
    }
}
