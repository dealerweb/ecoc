<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use InvalidArgumentException;

/**
 * The texts of the rendered document: resources/translations/render-<language>.php, and the labels of the numbered
 * items of the certificate in resources/translations/items-<language>.php.
 *
 * @internal
 */
final class Texts
{
    public const LANGUAGES = ['de', 'en', 'fr'];

    /** @var array<string, array<string, string>> */
    private static array $texts = [];

    /** @var array<string, array<string, string>> */
    private static array $items = [];

    public function __construct(private readonly string $language) {}

    /**
     * @throws InvalidArgumentException for a language the package has no texts for
     */
    public static function assertLanguage(string $language): void
    {
        if (! in_array($language, self::LANGUAGES, true)) {
            throw new InvalidArgumentException("Unsupported language \"$language\", use one of " . implode(', ', self::LANGUAGES) . '.');
        }
    }

    /**
     * The text for a key with its placeholders ({name}) replaced; English if the language lacks it.
     *
     * @param array<string, string|int> $parameters
     */
    public function get(string $key, array $parameters = []): string
    {
        $text = self::texts($this->language)[$key] ?? self::texts('en')[$key] ?? $key;

        $replacements = [];
        foreach ($parameters as $name => $value) {
            $replacements['{' . $name . '}'] = (string) $value;
        }

        return strtr($text, $replacements);
    }

    public function has(string $key): bool
    {
        return isset(self::texts($this->language)[$key]) || isset(self::texts('en')[$key]);
    }

    /**
     * The label of a numbered item of the certificate.
     */
    public function item(string $number): string
    {
        return self::items($this->language)[$number] ?? self::items('en')[$number] ?? $number;
    }

    /**
     * @return array<string, string>
     */
    private static function texts(string $language): array
    {
        if (! isset(self::$texts[$language])) {
            /** @var array<string, string> $texts */
            $texts = require dirname(__DIR__, 2) . '/resources/translations/render-' . $language . '.php';
            self::$texts[$language] = $texts;
        }

        return self::$texts[$language];
    }

    /**
     * @return array<string, string>
     */
    private static function items(string $language): array
    {
        if (! isset(self::$items[$language])) {
            /** @var array<string, string> $items */
            $items = require dirname(__DIR__, 2) . '/resources/translations/items-' . $language . '.php';
            self::$items[$language] = $items;
        }

        return self::$items[$language];
    }
}
