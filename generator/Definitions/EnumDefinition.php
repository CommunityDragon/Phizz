<?php

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\EnumType;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;
use RuntimeException;

/**
 * @extends Definition<EnumType>
 */
class EnumDefinition extends Definition implements Writable
{
    use HasWrite;

    public const MAPPING = [
        'season' => 'Season',
        'queue' => 'GameQueue',
        'map' => 'GameMap',
        'gameMode' => 'GameMode',
        'gameType' => 'GameType',
        'queueType' => 'QueueType',
    ];

    public const HAS_DEPRECATION_NOTICES = [
        'queue',
        'queueType',
    ];

    public function __construct(
        protected readonly array $items,
        protected readonly string $key,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('Enums');
    }

    public function directory(): string
    {
        return $this->resolvePath('Enums');
    }

    public function definition(): EnumType
    {
        $name = array_key_exists($this->key, static::MAPPING)
            ? static::MAPPING[$this->key]
            : Helpers::formatAttribute($this->key, Helpers::PASCAL_CASE);

        $enum = (new EnumType($name))
            ->setType($this->backingType());

        $enum->setCases(array_map(
            callback: fn (array $item) => (new EnumCaseDefinition(
                item: $item,
                hasDeprecationNotice: in_array($this->key, static::HAS_DEPRECATION_NOTICES)
            ))->definition(),
            array: $this->items,
        ));

        return $enum;
    }

    protected function backingType(): string
    {
        if (empty($this->items)) {
            throw new RuntimeException('Enum must have at least one item to determine backing type.');
        }

        $value = $this->items[0]['x-value'];

        return match (gettype($value)) {
            'integer' => 'int',
            'string' => 'string',
            default => throw new RuntimeException('Unsupported backing type for enum: '.gettype($value)),
        };
    }
}
