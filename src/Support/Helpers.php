<?php

namespace Phizz\Support;

use Illuminate\Support\Str;
use NumberFormatter;
use RuntimeException;

/**
 * @internal
 */
final class Helpers
{
    public const CAMEL_CASE = 'camel';

    public const PASCAL_CASE = 'pascal';

    public const SNAKE_CASE = 'snake';

    /**
     * Convert a string to snake_case with special rules:
     * - Preserve existing underscores.
     * - Split camelCase and acronyms intelligently.
     * - Words starting with one or two uppercase letters are treated as one token,
     *   except when the first uppercase is 'X' (then the X is separate).
     * - All‑uppercase acronyms are separate tokens.
     * - Digits followed by a single letter (e.g., "20X") stay together.
     * - A leading purely numeric token is converted to English words
     *   (e.g., "12_hello" → "twelve_hello").
     *
     * @throws RuntimeException if the intl extension is missing
     */
    public static function formatAttribute(string $input, string $case = Helpers::SNAKE_CASE): string
    {
        $processed = array_map(function ($part) {
            if ($part === '') {
                return '';
            }

            preg_match_all(
                '/[a-z]+|(?:[A-Z][a-z]+|(?!X)[A-Z][A-Z][a-z]+)|[A-Z]+(?![a-z])|[0-9]+[A-Za-z](?![A-Za-z])|[0-9]+/',
                $part,
                $matches
            );

            $words = $matches[0];
            $words = array_map('strtolower', $words);

            return implode('_', $words);
        }, explode('_', $input));

        $snake = implode('_', $processed);
        if ($snake === '') {
            return '';
        }

        $tokens = explode('_', $snake);
        $first = $tokens[0];

        if (preg_match('/^\d+$/', $first)) {
            if (! class_exists('NumberFormatter')) {
                throw new RuntimeException(
                    'NumberFormatter class not found. Please enable the intl extension.'
                );
            }

            $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
            $words = $formatter->format((int) $first);
            $words = strtolower(str_replace(' ', '_', $words));
            $tokens[0] = $words;
        }

        $result = implode('_', $tokens);

        return match ($case) {
            Helpers::CAMEL_CASE => Str::camel($result),
            Helpers::PASCAL_CASE => Str::studly($result),
            default => $result,
        };
    }
}
