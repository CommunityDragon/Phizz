<?php

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\EnumCase;
use Phizz\Support\Helpers;

/**
 * @extends Definition<EnumCase>
 */
class EnumCaseDefinition extends Definition
{
    public function __construct(
        protected readonly array $item,
        protected readonly bool $hasDeprecationNotice,
    ) {}

    public function definition(): EnumCase
    {
        $name = Helpers::formatAttribute($this->item['x-name'], Helpers::PASCAL_CASE);

        $case = (new EnumCase($name))
            ->setValue($this->item['x-value']);

        if (array_key_exists('x-desc', $this->item)) {
            $case->addComment("\n{$this->item['x-desc']}\n");
        }

        if ($this->item['x-deprecated'] ?? false) {
            $notice = '@deprecated';

            if ($this->hasDeprecationNotice && array_key_exists('notes', $this->item) && ! blank($this->item['notes'])) {
                $notice .= " {$this->item['notes']}";
            }

            $case->addComment($notice);
        }

        return $case;
    }
}
