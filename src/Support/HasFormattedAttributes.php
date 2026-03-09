<?php

namespace Phizz\Support;

use NumberFormatter;
use RuntimeException;

trait HasFormattedAttributes
{
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
    private function formatAttributeName(string $input): string
    {
        // 1. Split by existing underscores
        $parts = explode('_', $input);

        $processed = array_map(function ($part) {
            if ($part === '') {
                return '';
            }

            // 2. Tokenize the part using the refined regex
            preg_match_all(
                '/[a-z]+|(?:[A-Z][a-z]+|(?!X)[A-Z][A-Z][a-z]+)|[A-Z]+(?![a-z])|[0-9]+[A-Za-z](?![A-Za-z])|[0-9]+/',
                $part,
                $matches
            );

            $words = $matches[0];
            // 3. Lowercase each token
            $words = array_map('strtolower', $words);

            // 4. Rejoin the tokens with underscores
            return implode('_', $words);
        }, $parts);

        // 5. Recombine the original underscore-separated parts
        $snake = implode('_', $processed);

        // 6. If the whole string is empty, return early
        if ($snake === '') {
            return '';
        }

        // 7. Split again to check the very first token
        $tokens = explode('_', $snake);
        $first = $tokens[0];

        // 8. Convert leading numeric token to English words
        if (preg_match('/^\d+$/', $first)) {
            if (! class_exists('NumberFormatter')) {
                throw new RuntimeException(
                    'NumberFormatter class not found. Please enable the intl extension.'
                );
            }

            $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
            $words = $formatter->format((int) $first);
            // Replace spaces with underscores and ensure lowercase
            $words = strtolower(str_replace(' ', '_', $words));
            $tokens[0] = $words;
        }

        // 9. Rebuild the final snake_case string
        return implode('_', $tokens);
    }
}
