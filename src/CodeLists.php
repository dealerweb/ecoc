<?php

declare(strict_types=1);

namespace Dealerweb\ECoc;

use Dealerweb\ECoc\Render\Texts;
use InvalidArgumentException;

/**
 * What the codes of the data set mean, in German, English and French.
 *
 * resources/translations/codes-<language>.php hold the lists by the name of a field or by the name of its list in the
 * schema of IVI 2. English is what a language lacks, after it the text of the message books in resources/compiled. A code
 * nothing knows stays as it is.
 */
final class CodeLists
{
    /** Fields of IVI 1.x and IVI 2.0 that use the list of another field, or of the same field in the other format. */
    private const SHARED = [
        'AdditionalCouplingPoints' => 'AdditionalCouplingPointsCode',
        'AdditionalEnergySource' => 'FuelCode',
        'AdditionalFuelCode' => 'FuelCode',
        'AdvancedBrakingSystem' => 'AdvancedBrakingSystemCode',
        'AdvancedSafetySystem' => 'AdvancedSafetySystemCode',
        'AerodynamicDeviceEquipped' => 'AerodynamicVehCode',
        'ArrangementCylinders' => 'ArrangementOfCylindersCode',
        'AutomatedVehicle' => 'AutomatedVehCode',
        'BodyworkTypeTrailer' => 'CodeForBodywork',
        'BrakedTypeTrail' => 'BrakedTypeTrailCode',
        'ClassHybridVehicle' => 'ClassOfHybridVehicleCode',
        'CodeForBodyworkSupplement' => 'NumberForBodywork',
        'DesignatedTypeApprovalCountry' => 'NumberOfTheMemberState',
        'DriverSeatTypeCategory' => 'DriverSeatTypeCategoryCode',
        'EcoInnovationCountry' => 'NumberOfTheMemberState',
        'Colour' => 'PrimaryColourCode',
        'CompletedAltered' => 'CompletedAlteredCode',
        'CombustionCycle' => 'EngineCycleCode',
        'ElectricVehicleConfiguration' => 'ElectricVehicleConfigurCode',
        'ElectronicBrakingSystem' => 'ElectronicBrakingSystemCode',
        'EnergySource' => 'FuelCode',
        'FuelType' => 'FuelTypeCode',
        'FuellingArrangement' => 'FuelingArrangementCode',
        'GearboxType' => 'GearboxTypeCode',
        'MaxPermLadenMassAxleCountrCode' => 'InServiceMaximumPermissibleLadenMassAxleCountry',
        'MaxPermLadenMassAxleGrCCode' => 'InServiceMaximumPermissibleLadenMassAxleGroupCountry',
        'MaxPermLadenMassAxleGrMStateNr' => 'NumberOfTheMemberState',
        'MaxPermLadenMassAxleMemStateNr' => 'NumberOfTheMemberState',
        'MaxPermMassNatTraffCountryCode' => 'InServiceMaximumPermissibleMassCountry',
        'MaxPermMassNatTraffMemStateNr' => 'NumberOfTheMemberState',
        'MethodAttachmentStatutoryPlate' => 'MethodOfAttachmStatPlatesCode',
        'MetricImperialOdometer' => 'MetricImperialSpeedometerCode',
        'MetricImperialSpeedometer' => 'MetricImperialSpeedometerCode',
        'RightLeftHandTraffic' => 'RightLeftHandTrafficCode',
        'SecondaryColourCode' => 'PrimaryColourCode',
        'StageOfCompletion' => 'StageOfCompletionCode',
        'TrailerBrakeControlSystemTechnology' => 'TrailerBrakeConnectionsCode',
        'TrailerBrakeTechnologyConnectionsType' => 'TrailerBrakeConnectionsCode',
        'TypeApprovalType' => 'TypeApprovalTypeCode',
        'TypeTrailerCode' => 'CodeForBodywork',
        'TyreClassification' => 'TyreClassificationCode',
        'VehicleClass' => 'ClassOfVehicleCode',
        'WorkingPrinciple' => 'WorkingPrincipleCode',
    ];

    /**
     * Fields whose code is what the certificate states: the text of the message book would say less, or only how the data set
     * is built. The groups of vehicles are defined in a regulation, the message book only refers to it.
     *
     * @internal
     */
    public const AS_DELIVERED = [
        'DrivingCycleClass', 'DrivingCycleClassCode', 'IviVersionNumberXsd', 'LocationMarkingsSubject', 'MechanicalCouplingCanBeFittedClass',
        'RemarkSubjectDescription', 'RemarkSubjectLanguage', 'RollingResistanceClass', 'RollingResistanceClassCode', 'TestFamilyIdentifier',
        'TyreCategory', 'TyreCategoryCode', 'VehicleCategory', 'VehicleCategoryCode', 'VehicleGroup', 'VehicleSubgroup',
    ];

    /** @var array<string, array<string, array<string, string>>> */
    private static array $lists = [];

    /** @var array<string, array{group: string, format: string, unit: string, numbers: array<string, string>, values: array<string, string>}> */
    private static array $catalogue = [];

    /** @var array<string, array{format: string, unit: string, values: array<string, string>}> */
    private static array $catalogue2 = [];

    /** @var array<string, string> */
    private static array $titles = [];

    /**
     * The meaning of a code, or null if the field has no list or the list does not know the code.
     *
     * @param string $element the name of the field, as in the data set
     * @param string $language de, en or fr
     * @throws InvalidArgumentException for any other language
     */
    public static function label(string $element, string $code, string $language): ?string
    {
        Texts::assertLanguage($language);

        if (in_array($element, self::AS_DELIVERED, true)) {
            return null;
        }

        return self::translated($element, $code, $language)
            ?? self::translated($element, $code, 'en')
            ?? self::described2($element)['values'][$code]
            ?? self::catalogue()[self::SHARED[$element] ?? $element]['values'][self::listCode($element, $code)]
            ?? null;
    }

    /**
     * The text of a code in the list of a language, without falling back to another language.
     *
     * @internal
     */
    public static function translated(string $element, string $code, string $language): ?string
    {
        $lists = self::lists($language);
        $code = self::listCode($element, $code);
        if (self::isIndicator($element, $code)) {
            return $lists['indicator'][$code] ?? null;
        }

        return $lists[self::SHARED[$element] ?? $element][$code]
            ?? $lists[self::described2($element)['format'] ?? ''][$code]
            ?? null;
    }

    /**
     * The title and the unit of a field. IVI 1.x and IVI 2 have a few fields of the same name with another unit: the version
     * of the format of a data set says which one is meant, without it IVI 1.x goes first.
     *
     * @return array{title: string, unit: string}|null
     */
    public static function field(string $element, ?string $formatVersion = null): ?array
    {
        $field = self::described($element, $formatVersion);

        return $field === null ? null : ['title' => self::title($element), 'unit' => $field['unit']];
    }

    /**
     * Whether the sources describe the value of a field as a decimal number, and a reader expects it in the form of the language.
     *
     * @internal
     */
    public static function isDecimal(string $element, ?string $formatVersion = null): bool
    {
        return preg_match('~^(Decimal|NUM \d+,[1-9])~', self::described($element, $formatVersion)['format'] ?? '') === 1;
    }

    /**
     * What IVI 2 says about a field, or about the field whose list it uses.
     *
     * @return array{format: string, unit: string, values: array<string, string>}|null
     */
    private static function described2(string $element): ?array
    {
        return self::catalogue2()[$element] ?? self::catalogue2()[self::SHARED[$element] ?? ''] ?? null;
    }

    /**
     * @return array{format: string, unit: string, values: array<string, string>}|null
     */
    private static function described(string $element, ?string $formatVersion): ?array
    {
        $catalogues = str_starts_with((string) $formatVersion, '2') ? [self::catalogue2(), self::catalogue()] : [self::catalogue(), self::catalogue2()];

        return $catalogues[0][$element] ?? $catalogues[1][$element] ?? null;
    }

    /**
     * A title in English for any field: resources/translations/fields-en.php, otherwise its name written out.
     *
     * @internal
     */
    public static function title(string $element): string
    {
        return self::titles()[$element] ?? trim((string) preg_replace('~(?<=[a-z0-9])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])~', ' ', $element));
    }

    /**
     * Whether a field has a title of its own in resources/translations/fields-en.php.
     *
     * @internal
     */
    public static function hasTitle(string $element): bool
    {
        return isset(self::titles()[$element]);
    }

    /**
     * @return array<string, string>
     */
    private static function titles(): array
    {
        if (self::$titles === []) {
            /** @var array<string, string> $titles */
            $titles = require dirname(__DIR__) . '/resources/translations/fields-en.php';
            self::$titles = $titles;
        }

        return self::$titles;
    }

    private static function isIndicator(string $element, string $code): bool
    {
        return preg_match('~(Ind|Indicator)$~', $element) === 1 && in_array($code, ['Y', 'N'], true);
    }

    /**
     * The code as the lists have it: IVI 2 writes the numbers of the bodywork with a leading zero, the list and IVI 1.x do not.
     */
    private static function listCode(string $element, string $code): string
    {
        return (self::SHARED[$element] ?? $element) === 'NumberForBodywork' ? ltrim($code, '0') : $code;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private static function lists(string $language): array
    {
        if (! isset(self::$lists[$language])) {
            /** @var array<string, array<string, string>> $lists */
            $lists = require dirname(__DIR__) . '/resources/translations/codes-' . $language . '.php';
            self::$lists[$language] = $lists;
        }

        return self::$lists[$language];
    }

    /**
     * @return array<string, array{group: string, format: string, unit: string, numbers: array<string, string>, values: array<string, string>}>
     */
    private static function catalogue(): array
    {
        if (self::$catalogue === []) {
            /** @var array{version: string, fields: array<string, array{group: string, format: string, unit: string, numbers: array<string, string>, values: array<string, string>}>} $compiled */
            $compiled = require dirname(__DIR__) . '/resources/compiled/fields.php';
            self::$catalogue = $compiled['fields'];
        }

        return self::$catalogue;
    }

    /**
     * @return array<string, array{format: string, unit: string, values: array<string, string>}>
     */
    private static function catalogue2(): array
    {
        if (self::$catalogue2 === []) {
            /** @var array{fields: array<string, array{format: string, unit: string, values: array<string, string>}>} $compiled */
            $compiled = require dirname(__DIR__) . '/resources/compiled/fields-2.php';
            self::$catalogue2 = $compiled['fields'];
        }

        return self::$catalogue2;
    }
}
