<?php

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\ClassType;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\StaticApi;
use Phizz\Support\StaticClient;

/**
 * Generates CDragonClient — a thin wrapper that exposes $lol and $tft sub-clients.
 *
 * @extends Definition<ClassType>
 */
class CDragonClientDefinition extends Definition implements Writable
{
    use HasWrite;

    public function namespace(): string
    {
        return $this->resolveNamespace('CDragon');
    }

    public function directory(): string
    {
        return $this->resolvePath('CDragon');
    }

    public function imports(): array
    {
        return [
            StaticApi::class,
            StaticClient::class,
        ];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType('CDragonClient'))
            ->setExtends(StaticApi::class);

        $class->addProperty('lol')
            ->setType($this->resolveNamespace('CDragon').'\\LolClient')
            ->setPublic()
            ->setReadOnly();

        $class->addProperty('tft')
            ->setType($this->resolveNamespace('CDragon').'\\TftClient')
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
