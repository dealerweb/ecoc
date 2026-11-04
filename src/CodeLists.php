<?php

declare(strict_types=1);

namespace Dealerweb\ECoc;

use Dealerweb\ECoc\Render\Texts;
use InvalidArgumentException;

/**
 * What the codes of the data set mean, in German, English and French.
 *
 * resources/translations/codes-<language>.php hold the lists by the name of a field. English is what a language lacks,
 * after it the text of the message book in resources/compiled/fields.php. A code nothing knows stays as it is.
 */
final class CodeLists
{
    /** Fields of IVI 1.x and IVI 2.0 that use the list of another field. */
    private const SHARED = [
        'AdditionalCouplingPoints' => 'AdditionalCouplingPointsCode',
        'AdditionalEnergySource' => 'FuelCode',
        'AdditionalFuelCode' => 'FuelCode',
        'AdvancedBrakingSystem' => 'AdvancedBrakingSystemCode',
        'AdvancedSafetySystem' => 'AdvancedSafetySystemCode',
        'AerodynamicDeviceEquiped' => 'AerodynamicVehCode',
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
        'FuelingArrangement' => 'FuelingArrangementCode',
        'GearboxType' => 'GearboxTypeCode',
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
        'TyreType' => 'TypeOfTyre',
        'VehicleClass' => 'ClassOfVehicleCode',
        'WorkingPrinciple' => 'WorkingPrincipleCode',
    ];

    /** Fields whose code is what the certificate states: the text of the message book would say less. */
    private const AS_DELIVERED = ['DrivingCycleClass', 'DrivingCycleClassCode', 'VehicleCategory', 'VehicleCategoryCode'];

    /** @var array<string, array<string, array<string, string>>> */
    private static array $lists = [];

    /** @var array<string, array{group: string, format: string, unit: string, numbers: array<string, string>, values: array<string, string>}> */
    private static array $catalogue = [];

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

        $list = self::SHARED[$element] ?? $element;
        if (preg_match('~(Ind|Indicator)$~', $element) === 1 && in_array($code, ['Y', 'N'], true)) {
            $list = 'indicator';
        }

        // IVI 2.0 writes the numbers of the bodywork with a leading zero, the list and IVI 1.x do not.
        if ($list === 'NumberForBodywork') {
            $code = ltrim($code, '0');
        }

        return self::lists($language)[$list][$code]
            ?? self::lists('en')[$list][$code]
            ?? self::catalogue()[$list]['values'][$code]
            ?? null;
    }

    /**
     * The title and the unit of a field of IVI 1.x.
     *
     * @return array{title: string, unit: string}|null
     */
    public static function field(string $element): ?array
    {
        $field = self::catalogue()[$element] ?? null;

        return $field === null ? null : ['title' => self::title($element), 'unit' => $field['unit']];
    }

    /**
     * A title in English for any field: resources/translations/fields-en.php, otherwise its name written out.
     *
     * @internal
     */
    public static function title(string $element): string
    {
        if (self::$titles === []) {
            /** @var array<string, string> $titles */
            $titles = require dirname(__DIR__) . '/resources/translations/fields-en.php';
            self::$titles = $titles;
        }

        return self::$titles[$element] ?? trim((string) preg_replace('~(?<=[a-z0-9])(?=[A-Z])~', ' ', $element));
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
}
