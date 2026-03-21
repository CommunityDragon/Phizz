<?php

namespace Phizz\Support;

use Illuminate\Support\Str;
use NumberFormatter;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Exceptions\InvalidPlatformException;
use RuntimeException;

/**
 * @internal
 */
final class Helpers
{
    /**
     * Output case constant: camelCase.
     *
     * @var string
     */
    public const CAMEL_CASE = 'camel';

    /**
     * Output case constant: PascalCase.
     *
     * @var string
     */
    public const PASCAL_CASE = 'pascal';

    /**
     * Output case constant: snake_case (default).
     *
     * @var string
     */
    public const SNAKE_CASE = 'snake';

    /**
     * Converts an OpenAPI attribute name to the requested PHP casing convention.
     *
     * Special rules applied during snake_case conversion:
     * - Existing underscores are preserved as token boundaries.
     * - camelCase and acronyms are split intelligently.
     * - Tokens starting with one or two uppercase letters are treated as one token,
     *   except when the first letter is X (treated as a separate prefix).
     * - All-uppercase acronyms are kept as separate tokens.
     * - Digits followed by a single letter (e.g. "20X") stay together.
     * - A leading purely numeric token is spelled out in English words
     *   (e.g. "12_hello" -> "twelve_hello") — requires the intl extension.
     *
     * @param  string  $input  Raw attribute name from the OpenAPI schema.
     * @param  string  $case  One of Helpers::SNAKE_CASE, CAMEL_CASE, or PASCAL_CASE.
     * @return string Converted attribute name.
     *
     * @throws RuntimeException If the intl extension is unavailable and a numeric prefix is encountered.
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
        /** @phpstan-ignore identical.alwaysFalse */
        if ($snake === '') {
            return '';
        }

        $tokens = explode('_', $snake);
        $first = $tokens[0];

        if (preg_match('/^\d+$/', $first)) {
            if (! class_exists('NumberFormatter')) { // @codeCoverageIgnoreStart
                throw new RuntimeException(
                    'NumberFormatter class not found. Please enable the intl extension.'
                ); // @codeCoverageIgnoreEnd
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

    /**
     * Validates and normalizes a platform value against the expected platform type.
     * Accepts enum instances or string shortcuts (e.g. "na1", "europe"), converts
     * Platform -> Regional where required (e.g. for LoR endpoints), and validates
     * against any endpoint-specific allow-list before returning the string routing value.
     *
     * @param  string  $platformType  Class-string of the expected routing enum.
     * @param  Regional|Platform|ValPlatform|string|null  $platform  Raw platform value from the caller.
     * @param  array  $supportedPlatforms  Optional allow-list of valid routing values for this endpoint.
     * @param  string  $endpoint  Endpoint path used in exception messages and LoR routing detection.
     * @return string Resolved routing string (e.g. "na1", "europe").
     *
     * @throws InvalidPlatformException If the platform is blank, of the wrong type, or not in the allow-list.
     */
    public static function resolvePlatform(
        string $platformType,
        Regional|Platform|ValPlatform|string|null $platform,
        array $supportedPlatforms,
        string $endpoint,
    ): string {
        if (blank($platform)) {
            throw new InvalidPlatformException("Invalid platform type '".$platform."' for endpoint '$endpoint'.");
        }

        $platform = self::normalizePlatform($platformType, $platform, $endpoint);

        if (! is_string($platform) && get_class($platform) !== $platformType) {
            throw new InvalidPlatformException("Invalid platform type '".get_class($platform)."' for endpoint '$endpoint'.");
        }

        $value = is_string($platform) ? $platform : $platform->value;

        if (! empty($supportedPlatforms) && ! in_array($value, $supportedPlatforms)) {
            throw new InvalidPlatformException("Invalid platform type '".$value."' for endpoint '$endpoint'.");
        }

        return $value;
    }

    /**
     * Maps a raw decoded response body to the requested return type.
     * Returns null when the endpoint declares no return value, instantiates
     * a typed object or a Collection of typed objects when specified, or
     * returns the raw body array for untyped responses.
     *
     * @param  mixed  $body  Decoded JSON response body.
     * @param  bool  $returns  False when the endpoint has no response body.
     * @param  string|null  $returnType  Short class name to instantiate from the body.
     * @param  string|null  $collectionType  Short class name for each item in a collection response.
     * @return mixed Typed object, collection, raw array, or null.
     */
    public static function resolveBody(mixed $body, bool $returns, ?string $returnType, ?string $collectionType): mixed
    {
        if (! $returns) {
            return null;
        }

        if (! blank($returnType)) {
            return new ($returnType)($body);
        }

        if (! blank($collectionType)) {
            return collect($body)->map(fn ($item) => new ($collectionType)($item));
        }

        return $body;
    }

    /**
     * Coerces a raw string or enum platform value towards the expected routing type.
     * Parses string shortcuts via tryFrom(), and automatically converts a Platform enum
     * to its Regional equivalent when the endpoint requires it (including LoR-specific routing).
     *
     * @param  class-string<Regional|Platform|ValPlatform>  $platformType  Class-string of the expected routing enum.
     * @param  Regional|Platform|ValPlatform|string  $platform  Current platform value to normalize.
     * @param  string  $endpoint  Endpoint path used to detect LoR regional routing.
     * @return Regional|Platform|ValPlatform|string Normalized platform value (may still be an enum instance).
     */
    private static function normalizePlatform(
        string $platformType,
        Regional|Platform|ValPlatform|string $platform,
        string $endpoint,
    ): Regional|Platform|ValPlatform|string {
        if (is_string($platform)) {
            $x = blank($platformType) ? null : $platformType::tryFrom($platform);
            $platform = $x ?? Platform::tryFrom($platform) ?? $platform;
        }

        if ($platformType === Regional::class && $platform instanceof Platform) {
            return Str::startsWith($endpoint, '/lor/')
                ? $platform->lorRegional()
                : $platform->regional();
        }

        return $platform;
    }
}
