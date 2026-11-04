<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use DateTimeImmutable;
use DateTimeZone;

/**
 * Numbers and dates of the data set the way a reader of the language expects them. Numbers are written as delivered,
 * only the decimal separator changes: the certificate states them exactly.
 *
 * @internal
 */
final class Format
{
    private const DECIMAL_SEPARATORS = ['de' => ',', 'en' => '.', 'fr' => ','];

    private const DATE_FORMATS = ['de' => 'd.m.Y', 'en' => 'Y-m-d', 'fr' => 'd/m/Y'];

    /** The local time of the readers of a language, for times delivered with a time zone. English shows UTC and says so. */
    private const TIME_ZONES = ['de' => 'Europe/Berlin', 'fr' => 'Europe/Paris'];

    private const SUPERSCRIPTS = ['0' => "\u{2070}", '1' => "\u{00B9}", '2' => "\u{00B2}", '3' => "\u{00B3}", '4' => "\u{2074}", '5' => "\u{2075}", '6' => "\u{2076}", '7' => "\u{2077}", '8' => "\u{2078}", '9' => "\u{2079}"];

    public function __construct(private readonly string $language) {}

    /**
     * Anything that is not a plain decimal number is returned as written.
     */
    public function number(string $value): string
    {
        $value = trim($value);
        if (preg_match('~^-?\d+(\.\d+)?$~', $value) !== 1) {
            return $value;
        }

        return str_replace('.', self::DECIMAL_SEPARATORS[$this->language] ?? '.', $value);
    }

    /**
     * An ISO date (xs:date), with a time if the value has one (xs:dateTime). A time with a time zone (Z, +02:00) is shown in
     * the local time of the language, a time without one as it is. Anything else is returned as written.
     */
    public function date(string $value): string
    {
        $value = trim($value);
        if (preg_match('~^(\d{4})-(\d{2})-(\d{2})(?:T(\d{2}):(\d{2})(?::\d{2}(?:\.\d+)?)?)?(Z|[+-](?:0\d|1[0-4]):[0-5]\d)?$~', $value, $parts, PREG_UNMATCHED_AS_NULL) !== 1) {
            return $value;
        }
        [, $year, $month, $day, $hour, $minute, $zone] = $parts;
        if (! checkdate((int) $month, (int) $day, (int) $year)) {
            return $value;
        }

        $moment = DateTimeImmutable::createFromFormat(
            '!Y-m-d H:i',
            "$year-$month-$day " . ($hour ?? '00') . ':' . ($minute ?? '00'),
            new DateTimeZone($zone === null || $zone === 'Z' ? 'UTC' : $zone),
        );
        if ($moment === false) {
            return $value;
        }

        $format = self::DATE_FORMATS[$this->language] ?? self::DATE_FORMATS['en'];
        if ($hour === null) {
            return $moment->format($format);
        }
        if ($zone === null) {
            return $moment->format("$format H:i");
        }

        $local = self::TIME_ZONES[$this->language] ?? 'UTC';
        $shown = $moment->setTimezone(new DateTimeZone($local))->format("$format H:i");

        return $local === 'UTC' ? "$shown UTC" : $shown;
    }

    public function superscript(string $digits): string
    {
        return strtr(trim($digits), self::SUPERSCRIPTS);
    }
}
