<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use Dealerweb\ECoc\Certificate;
use Dealerweb\ECoc\CodeLists;
use Dealerweb\ECoc\Node;
use LogicException;
use SplObjectStorage;

/**
 * Prepares what the template shows, from the layout in resources/layout/certificate.php.
 *
 * Every field of the data set is shown exactly once: what a row takes is marked as used, and whatever no row took
 * appears under "further data". So a new or unknown field is never lost, it only lands in the wrong place.
 *
 * @internal
 *
 * @phpstan-type Row array{type: 'row', number: string, label: string, note: string, lines: list<string>, missing: bool}
 * @phpstan-type Block array<string, mixed>
 */
final class ViewBuilder
{
    /** What stands in the place of a value the data set lacks: the same in every language, narrow enough for every column. */
    private const MISSING = '-';

    /** @var SplObjectStorage<Node, true> */
    private SplObjectStorage $used;

    private readonly Texts $texts;

    private readonly Format $format;

    private readonly Node $root;

    /** @var array<string, mixed> */
    private readonly array $layout;

    /** @var array{present: list<string>, previous: list<string>, representative: list<string>}|null */
    private ?array $addresses = null;

    /** The fuel with whose values the document marks what the data set lacks; null when it marks nothing. */
    private ?Node $gapHost = null;

    public function __construct(
        private readonly Certificate $certificate,
        private readonly string $language,
    ) {
        $this->texts = new Texts($language);
        $this->format = new Format($language);
        $this->root = $certificate->root();
        /** @var array<string, mixed> $layout */
        $layout = require dirname(__DIR__, 2) . '/resources/layout/certificate.php';
        $this->layout = $layout;
        $this->used = new SplObjectStorage();
    }

    /**
     * @return array<string, mixed>
     */
    public function build(): array
    {
        $this->used = new SplObjectStorage();
        $this->addresses = null;
        $this->gapHost = $this->findGapHost();

        $parts = [];
        foreach ($this->layout['parts'] as $partKey => $sections) {
            $built = [];
            foreach ($sections as $sectionKey => $items) {
                $blocks = self::grouped($this->items($items, $this->root));
                if ($blocks !== []) {
                    $built[] = ['title' => $this->texts->get('section.' . $sectionKey), 'blocks' => $blocks];
                }
            }
            $parts[$partKey] = $built;
        }

        $further = $this->further();
        if ($further !== []) {
            $parts['part2'][] = ['title' => $this->texts->get('section.further'), 'blocks' => self::grouped($further)];
        }

        $vin = $this->certificate->vin();
        $vehicle = trim(($this->certificate->make() ?? '') . ' ' . ($this->certificate->commercialName() ?? ''));
        $category = $this->certificate->value('VehicleCategoryCode', 'VehicleCategory');

        return [
            'language' => $this->language,
            'documentTitle' => $this->texts->get('document.title') . ' - ' . $vin,
            'vehicle' => $vehicle,
            'vin' => $vin,
            'vinLabel' => $this->texts->item('0.10'),
            'notice' => $this->texts->get('document.notice'),
            'footer' => $this->texts->get('document.footer', ['vin' => $vin]),
            'page' => $this->texts->get('document.page'),
            'parts' => array_values(array_filter([
                ['title' => $this->texts->get('part.part1'), 'sections' => $parts['part1']],
                [
                    'title' => $category === null ? $this->texts->get('part.part2_plain') : $this->texts->get('part.part2', ['category' => $category]),
                    'sections' => $parts['part2'],
                ],
            ], static fn(array $part): bool => $part['sections'] !== [])),
        ];
    }

    /**
     * @param list<array<int|string, mixed>> $items
     * @return list<Block>
     */
    private function items(array $items, Node $scope): array
    {
        $out = [];
        foreach ($items as $item) {
            if (isset($item['block'])) {
                array_push($out, ...$this->block((string) $item['block']));
            } elseif (isset($item['table'])) {
                array_push($out, ...$this->table((string) $item['table'], $scope));
            } else {
                $row = $this->row($item, $scope);
                if ($row !== null) {
                    $out[] = $row;
                }
            }
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function block(string $name): array
    {
        return match ($name) {
            'previousStages' => $this->previousStages(),
            'identifiers' => $this->identifiers(),
            'manufacturers' => $this->manufacturers(),
            'locations' => $this->locations(),
            'representative' => $this->representative(),
            'signers' => $this->signers(),
            'signature' => $this->signature(),
            'axleRoles' => $this->axleRoles(),
            'towing' => $this->towing(),
            'engines' => $this->engines(),
            'gears' => $this->gears(),
            'axleSuspension' => $this->axleSuspension(),
            'tyres' => $this->tyres(),
            'environment' => $this->environment(),
            'remarks' => $this->remarks(),
            default => throw new LogicException("Unknown block \"$name\" in the layout."),
        };
    }

    /**
     * @param array<int|string, mixed> $item
     * @return Row|null
     */
    private function row(array $item, Node $scope): ?array
    {
        $scope = ($item['root'] ?? false) === true ? $this->root : $scope;

        if (isset($item['pairs'])) {
            $lines = $this->pairs($item['pairs'], $scope);
        } elseif (isset($item['axles'])) {
            $lines = $this->axleValues((string) $item['axles'], ($item['spacing'] ?? false) === true);
        } elseif (isset($item['axleGroups'])) {
            $lines = $this->axleGroupValues((string) $item['axleGroups']);
        } elseif (($item['all'] ?? false) === true) {
            $lines = [];
            while (($line = $this->fill((string) $item[1], $scope)) !== null) {
                $lines[] = $line;
            }
            if (($item['distinct'] ?? false) === true) {
                $lines = array_values(array_unique($lines));
            }
        } else {
            $lines = [];
            foreach ((array) $item[1] as $template) {
                $line = $this->fill((string) $template, $scope);
                if ($line !== null && $line !== '') {
                    $lines[] = $line;
                }
            }
        }

        $missing = $lines === [];
        if ($missing && ! $this->isLacking($item, $scope)) {
            return null;
        }

        $number = (string) $item[0];
        $label = isset($item['label']) ? $this->texts->get('label.' . $item['label']) : $this->texts->item($number);

        return self::rowOf($number, $label, $missing ? [self::MISSING] : $lines, '', $missing);
    }

    /**
     * @param list<string> $lines
     * @return Row
     */
    private static function rowOf(string $number, string $label, array $lines, string $note = '', bool $missing = false): array
    {
        return ['type' => 'row', 'number' => $number, 'label' => $label, 'note' => $note, 'lines' => $lines, 'missing' => $missing];
    }

    /**
     * The value of a template, or null if a field outside an optional part has no value. Nothing is marked as used
     * unless the template as a whole has a value.
     */
    private function fill(string $template, Node $scope): ?string
    {
        $result = '';
        $marked = [];
        $parts = preg_split('~(\[[^\[\]]*\])~', $template, -1, PREG_SPLIT_DELIM_CAPTURE) ?: [];
        foreach ($parts as $part) {
            if ($part === '') {
                continue;
            }
            $optional = $part[0] === '[';
            $text = $this->segment($optional ? substr($part, 1, -1) : $part, $scope, $marked);
            if ($text === null) {
                if ($optional) {
                    continue;
                }

                return null;
            }
            $result .= $text;
        }

        foreach ($marked as $node) {
            $this->used[$node] = true;
        }

        return $result;
    }

    /**
     * @param list<Node> $marked the fields the segment took, added to when it has a value
     */
    private function segment(string $template, Node $scope, array &$marked): ?string
    {
        $missing = false;
        $taken = [];
        $text = preg_replace_callback(
            '~\{([#@=^]?)([\w|]+)\}|%(\w+)%~',
            function (array $match) use ($scope, $marked, &$missing, &$taken): string {
                if (($match[3] ?? '') !== '') {
                    return $this->texts->get('word.' . $match[3]);
                }

                $node = $this->unused(explode('|', $match[2]), $scope, [...$marked, ...$taken]);
                if ($node === null) {
                    $missing = true;

                    return '';
                }
                $taken[] = $node;

                return $this->display($node, $match[1]);
            },
            $template,
        );

        if ($missing) {
            return null;
        }
        array_push($marked, ...$taken);

        return (string) $text;
    }

    /**
     * The nearest field with one of the names that has a value and is not shown yet.
     *
     * @param list<string> $names
     * @param list<Node> $taken
     */
    private function unused(array $names, Node $scope, array $taken = []): ?Node
    {
        foreach ($scope->find(...$names) as $node) {
            if ($node->isLeaf() && $node->value !== '' && ! isset($this->used[$node]) && ! in_array($node, $taken, true)) {
                return $node;
            }
        }

        return null;
    }

    private function mark(?Node ...$nodes): void
    {
        foreach ($nodes as $node) {
            if ($node !== null) {
                $this->used[$node] = true;
            }
        }
    }

    private function display(Node $node, string $flag = ''): string
    {
        $label = CodeLists::label($node->name, $node->value, $this->language);

        return match ($flag) {
            '#' => $this->format->number($node->value),
            '@' => $this->format->date($node->value),
            '^' => $this->format->superscript($node->value),
            '=' => $label === null || $label === $node->value ? $node->value : $node->value . ' (' . $label . ')',
            default => $label ?? $node->value,
        };
    }

    /**
     * @param list<array{0: string, 1: string}> $pairs
     * @return list<string>
     */
    private function pairs(array $pairs, Node $scope): array
    {
        $parts = [];
        foreach ($pairs as [$label, $template]) {
            $value = $this->fill($template, $scope);
            if ($value !== null) {
                $parts[] = ($label[0] === ':' ? $this->texts->get('word.' . substr($label, 1)) : $label) . ': ' . $value;
            }
        }

        return $parts === [] ? [] : [implode(' · ', $parts)];
    }

    /**
     * @return list<string>
     */
    private function axleValues(string $template, bool $spacing): array
    {
        $parts = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            $value = $this->fill($template, $axle);
            if ($value === null) {
                continue;
            }
            $number = $this->axleNumber($axle, $index);
            $parts[] = ($spacing ? $number . '-' . ((int) $number + 1) : $number) . ': ' . $value;
        }

        return $parts === [] ? [] : [implode(' · ', $parts)];
    }

    /**
     * @return list<string>
     */
    private function axleGroupValues(string $template): array
    {
        $parts = [];
        foreach ($this->root->find('AxleGroupGroup') as $index => $group) {
            $value = $this->fill($template, $group);
            if ($value === null) {
                continue;
            }
            $number = $group->first('AxleGroupNumber');
            $this->mark($number);
            $parts[] = ($number->value ?? (string) ($index + 1)) . ': ' . $value;
        }

        return $parts === [] ? [] : [implode(' · ', $parts)];
    }

    private function axleNumber(Node $axle, int $index): string
    {
        $number = $axle->first('AxleNumber');
        $this->mark($number);

        return $number->value ?? (string) ($index + 1);
    }

    /**
     * The numbers of the axles with the indicator set; every indicator counts as shown.
     *
     * @return list<string>
     */
    private function flaggedAxles(string ...$names): array
    {
        $positions = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            foreach ($axle->children as $child) {
                if (in_array($child->name, $names, true)) {
                    $this->mark($child);
                    if ($child->value === 'Y') {
                        $positions[] = $this->axleNumber($axle, $index);
                    }
                }
            }
        }

        return $positions;
    }
    /**
     * @return list<Block>
     */
    private function axleRoles(): array
    {
        $out = [];
        $roles = [
            ['1.1', null, 'NumberOfAxlesWithTwinWheels', ['TwinWheelsAxleInd', 'TwinWheelsAxleIndicator']],
            ['2', null, 'NumberOfSteeredAxles', ['SteeredAxleInd', 'SteeredAxleIndicator']],
            ['3', null, 'NumberOfPoweredAxles', ['PoweredAxleInd', 'PoweredAxleIndicator']],
            ['', 'braked_axles', 'NumberOfBrakedAxles', ['BrakedAxleInd', 'BrakedAxleIndicator']],
        ];
        foreach ($roles as [$number, $label, $count, $flags]) {
            $total = $this->fill('{' . $count . '}', $this->root);
            $positions = $this->flaggedAxles(...$flags);
            if ($total === null && $positions === []) {
                continue;
            }
            $line = $total ?? (string) count($positions);
            if ($positions !== []) {
                $line .= ' (' . $this->texts->get('word.axle') . ' ' . implode(', ', $positions) . ')';
            }
            $out[] = self::rowOf($number, $label === null ? $this->texts->item($number) : $this->texts->get('label.' . $label), [$line]);
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function axleSuspension(): array
    {
        $out = [];
        foreach ([['31', ['LiftAxleInd', 'LiftAxleIndicator']], ['32', ['LoadableAxleInd', 'LoadableAxleIndicator', 'RetractableOrLoadableAxleInd']]] as [$number, $flags]) {
            $positions = $this->flaggedAxles(...$flags);
            if ($positions !== []) {
                $out[] = self::rowOf($number, $this->texts->item($number), [$this->texts->get('word.axle') . ' ' . implode(', ', $positions)]);
            }
        }

        $positions = $this->flaggedAxles('AxleWithAirSuspOrEquivInd', 'AxleAirSuspensionOrEquivalentIndicator');
        if ($positions !== []) {
            $out[] = self::rowOf('', $this->texts->get('label.axle_air_suspension'), [$this->texts->get('word.axle') . ' ' . implode(', ', $positions)]);
        }

        $flags = ['DriveAxleWithAirSuspOrEquivInd', 'DriveAxleAirSuspensionOrEquivalentIndicator'];
        if ($this->root->find(...$flags) !== []) {
            $positions = $this->flaggedAxles(...$flags);
            $line = (string) CodeLists::label('DriveAxleWithAirSuspOrEquivInd', $positions === [] ? 'N' : 'Y', $this->language);
            if ($positions !== []) {
                $line .= ' (' . $this->texts->get('word.axle') . ' ' . implode(', ', $positions) . ')';
            }
            $out[] = self::rowOf('33', $this->texts->item('33'), [$line]);
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function tyres(): array
    {
        $template = '{TyreSize}[ {LoadCapacityIndexSingleWheel}][/{LoadCapacityIndexTwinWheel}][{SpeedCategorySymbol}]'
            . '[, {RimSizeIncludingOffSet}][, {RimSize}][/ET{RimOffSet}][, {TypeOfTyre|TyreType}]'
            . '[; %rrc% {RollingResistanceClassCode|RollingResistanceClass}][, {TyreCategoryCode|TyreCategory}]';

        $lines = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            foreach ($axle->find('TyreAxleGroup') as $tyre) {
                $value = $this->fill($template, $tyre);
                if ($value === null) {
                    continue;
                }
                $this->mark($tyre->first('TyreNumber'));
                foreach (['CO2DeterminationTyreInd' => 'tyre_co2', 'ProductionTyreRimVehInd' => 'tyre_production', 'TyreFittedProductionIndicator' => 'tyre_production'] as $flag => $word) {
                    $node = $tyre->first($flag);
                    $this->mark($node);
                    if ($node?->value === 'Y') {
                        $value .= ' (' . $this->texts->get('word.' . $word) . ')';
                    }
                }
                $lines[] = $this->texts->get('word.axle') . ' ' . $this->axleNumber($axle, $index) . ': ' . $value;
            }
        }

        return $lines === [] ? [] : [self::rowOf('35', $this->texts->item('35'), $lines)];
    }

    /**
     * @return list<Block>
     */
    private function towing(): array
    {
        $rows = [];
        foreach ($this->root->find('BrakedTypeTrailGroup', 'TowingBrakedTypeTrailGroup') as $braked) {
            $brake = $braked->first('BrakedTypeTrailCode', 'BrakedTypeTrail');
            $this->mark($brake);
            foreach ($braked->find('DrawbarTypeGroup', 'BodyworkTypeGroup') as $type) {
                $trailer = $type->first('TypeTrailerCode', 'BodyworkTypeTrailer');
                $this->mark($trailer);
                $mass = $this->fill('{TechPermMaxTowMassTrailer|TechnicallyPermissibleMaximumTowableMass} kg', $type);
                if ($mass === null) {
                    continue;
                }
                $number = $brake?->value === 'UNB' ? '18.4' : ($this->layout['trailers'][$trailer->value ?? ''] ?? '18');
                if ($brake !== null && ! in_array($brake->value, ['BRK', 'UNB'], true)) {
                    $mass .= ' (' . $this->display($brake) . ')';
                }
                $combination = $this->fill('{TechnPermMaxMassCombinTrail|TechnicallyPermissibleMaximumCombinationMass} kg', $type);
                if ($combination !== null) {
                    $mass .= ' (16.4: ' . $combination . ')';
                }
                $rows[$number][] = $mass;
            }
        }

        $out = [];
        foreach ($rows as $number => $lines) {
            $out[] = self::rowOf((string) $number, $this->texts->item((string) $number), $lines);
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function engines(): array
    {
        $engines = $this->root->find('EngineGroup', 'EnergyConvertorGroup');
        if ($engines === []) {
            return $this->items($this->layout['engine'], $this->root);
        }

        $filled = [];
        foreach ($engines as $engine) {
            $rows = [...$this->items($this->layout['engine'], $engine), ...$this->fuelRows($engine)];
            if ($rows !== []) {
                $filled[] = $rows;
            }
        }

        $out = [];
        foreach ($filled as $index => $rows) {
            if (count($filled) > 1) {
                $out[] = ['type' => 'subheading', 'text' => $this->texts->get('word.engine') . ' ' . ($index + 1)];
            }
            array_push($out, ...$rows);
        }

        return $out;
    }

    /**
     * The rows of the fuels of an engine, one fuel after the other. A group without a fuel code is the electric part of
     * a hybrid: it describes the same engine compartment, so its rows go in number order with those of the fuel before.
     *
     * @return list<Block>
     */
    private function fuelRows(Node $engine): array
    {
        $parts = [];
        foreach ($engine->find('FuelGroup', 'EnergySourceGroup') as $fuel) {
            $rows = $this->items($this->layout['fuel'], $fuel);
            if ($parts !== [] && $fuel->first('FuelCode', 'EnergySource') === null) {
                $last = array_key_last($parts);
                $parts[$last] = self::inNumberOrder([...$parts[$last], ...$rows]);
            } else {
                $parts[] = $rows;
            }
        }

        return array_merge(...$parts);
    }

    /**
     * Rows in the order of their numbers; a row without a number stays behind the row before it.
     *
     * @param list<Block> $rows
     * @return list<Block>
     */
    private static function inNumberOrder(array $rows): array
    {
        $numbers = [];
        $number = '';
        foreach ($rows as $index => $row) {
            $number = ($row['number'] ?? '') !== '' ? (string) $row['number'] : $number;
            $numbers[$index] = $number;
        }

        $order = array_keys($rows);
        usort($order, static fn(int $a, int $b): int => strnatcmp($numbers[$a], $numbers[$b]));

        return array_map(static fn(int $index): array => $rows[$index], $order);
    }

    /**
     * @return list<Block>
     */
    private function gears(): array
    {
        $parts = [];
        foreach ($this->root->find('GearRatioGroup') as $group) {
            $number = $group->first('GearNumber');
            $ratio = $group->first('GearRatio');
            $direction = $group->first('DrivingDirectionCode');
            $this->mark($number, $direction, $ratio);
            if ($ratio !== null) {
                $parts[] = ($direction?->value === 'R' ? 'R' : ($number->value ?? '')) . ': ' . $this->format->number($ratio->value);
            }
        }

        return $parts === [] ? [] : [self::rowOf('28.1', $this->texts->item('28.1'), [implode(' · ', $parts)])];
    }

    /**
     * The environmental performance, fuel by fuel, and the eco-innovations of the whole vehicle: with one fuel all of it in
     * the order of the numbers, as in the model of the certificate; with several, the eco-innovations stand behind them.
     *
     * @return list<Block>
     */
    private function environment(): array
    {
        // A fuel without values of its own, like the electric part of a plug-in hybrid, needs no heading for the other.
        $filled = [];
        foreach ($this->fuels() as $fuel) {
            $blocks = $this->items($this->layout['fuel_environment'], $fuel);
            if ($blocks !== []) {
                $filled[] = [$fuel, $blocks];
            }
        }

        $out = [];
        foreach ($filled as [$fuel, $blocks]) {
            $code = $fuel->first('FuelCode', 'EnergySource');
            if (count($filled) > 1 && $code !== null) {
                $out[] = ['type' => 'subheading', 'text' => $this->display($code)];
            }
            array_push($out, ...$blocks);
        }
        array_push($out, ...$this->items($this->layout['eco'], $this->root));

        return count($filled) > 1 ? $out : self::inNumberOrder($out);
    }

    /**
     * What holds the values of a fuel: the groups of the fuels, or the whole data set when it names none.
     *
     * @return list<Node>
     */
    private function fuels(): array
    {
        return $this->root->find('FuelGroup', 'EnergySourceGroup') ?: [$this->root];
    }

    /**
     * @return list<Block>
     */
    private function table(string $name, Node $scope): array
    {
        $definition = $this->layout['tables'][$name];
        $expected = $name === 'wltp' && $scope === $this->gapHost ? $this->expectedCells() : [];
        $filled = [];
        $columnsWithValues = [];
        foreach ($definition['rows'] as $rowKey => $fields) {
            $cells = [];
            $shown = false;
            foreach ($fields as $column => $names) {
                $node = $names === '' ? null : $this->unused(explode('|', $names), $scope);
                $this->mark($node);
                // A value of the data set, null for a value it lacks, or nothing: the certificate has no such value.
                $cells[$column] = $node === null ? '' : $this->format->number($node->value);
                if ($node === null && in_array($definition['columns'][$column], $expected[$rowKey] ?? [], true) && $this->root->first(...explode('|', $names)) === null) {
                    $cells[$column] = null;
                }
                if ($cells[$column] !== '') {
                    $columnsWithValues[$column] = true;
                    $shown = true;
                }
            }
            if ($shown) {
                $filled[$rowKey] = $cells;
            }
        }
        if ($filled === []) {
            return [];
        }

        $columns = array_keys($columnsWithValues);
        sort($columns);
        $unit = $this->fuelUnit($scope);

        $rows = [];
        foreach ($filled as $rowKey => $cells) {
            $row = [$this->texts->get('table.' . $rowKey, ['unit' => $unit])];
            foreach ($columns as $column) {
                $row[] = $cells[$column];
            }
            $rows[] = $row;
        }

        $head = [$this->texts->get('label.table_' . $name)];
        foreach ($columns as $column) {
            $head[] = $this->texts->get('column.' . $definition['columns'][$column]);
        }

        return [['type' => 'table', 'number' => $this->tableNumber($name), 'head' => $head, 'rows' => $rows, 'missing' => self::MISSING]];
    }

    /**
     * The unit of the fuel consumption: the certificate states liquid fuels in litres, gaseous fuels in cubic metres
     * or in kilograms - the data set does not say which.
     */
    private function fuelUnit(Node $scope): string
    {
        $code = $scope->first('FuelCode', 'EnergySource')?->value;
        if ($code !== null && in_array($code, $this->layout['liquid_fuels'], true)) {
            return 'l/100 km';
        }

        return $code === null ? 'l/100 km, m³/100 km, kg/100 km' : 'm³/100 km, kg/100 km';
    }

    /**
     * The number of a table in the certificate: its WLTP values are point 49.1, those of an externally chargeable hybrid
     * point 49.4.
     */
    private function tableNumber(string $name): string
    {
        if ($name !== 'wltp') {
            return '49';
        }

        return $this->powertrain() === 'ovc' ? '49.4' : '49.1';
    }

    /**
     * What point 49 of the certificate distinguishes: externally chargeable hybrids, pure electric vehicles, all others.
     */
    private function powertrain(): string
    {
        if ($this->root->first('PureElectricVehIndicator', 'PureElectricVehicleIndicator', 'PureElectricIndicator')?->value === 'Y') {
            return 'electric';
        }

        $class = $this->root->first('ClassOfHybridVehicleCode', 'ClassHybridVehicle')->value ?? '';
        $charged = $this->root->first('OffVehicleChargingVehInd', 'OffVehicleChargingIndicator')?->value;

        return str_starts_with($class, 'OVC') || $charged === 'Y' ? 'ovc' : 'other';
    }

    /**
     * Where the document marks what the data set lacks: with the first fuel that has values of the WLTP, so that it says so
     * once. The document shows what a data set delivers, so a gap is marked and never filled. Only for cars and vans with
     * such values, in a format that has these fields (since IVI 1.8): an older or a heavy vehicle has other points.
     */
    private function findGapHost(): ?Node
    {
        $category = $this->certificate->value('VehicleCategoryCode', 'VehicleCategory') ?? '';
        $version = $this->certificate->formatVersion() ?? '';
        if (preg_match('~^[MN]1~', $category) !== 1 || version_compare($version, '1.8', '<')) {
            return null;
        }

        $fields = [];
        foreach ($this->layout['tables']['wltp']['rows'] as $row) {
            array_push($fields, ...array_filter($row, static fn(string $names): bool => $names !== ''));
        }
        foreach ($this->layout['fuel_environment'] as $item) {
            if (isset($item['expected'])) {
                array_push($fields, ...self::fieldsOf((string) $item[1]));
            }
        }

        foreach ($this->fuels() as $fuel) {
            foreach ($fields as $names) {
                if ($fuel->first(...explode('|', $names)) !== null) {
                    return $fuel;
                }
            }
        }

        return null;
    }

    /**
     * The fields a template names, each with its names in both formats: "WLTPLowCO2|WltpCo2Low".
     *
     * @return list<string>
     */
    private static function fieldsOf(string $template): array
    {
        preg_match_all('~\{[#@=^]?([\w|]+)\}~', $template, $fields);

        return $fields[1];
    }

    /**
     * What the model of the certificate provides for this powertrain: the rows of the table of WLTP values with their
     * columns. A driving cycle of class 1 has no high and no extra high phase (UN Regulation No 154, Annex B1).
     *
     * @return array<string, list<string>>
     */
    private function expectedCells(): array
    {
        $absent = ($this->root->first('DrivingCycleClassCode', 'DrivingCycleClass')->value ?? '') === '1' ? ['high', 'extra_high'] : [];

        return array_map(static fn(array $columns): array => array_values(array_diff($columns, $absent)), $this->layout['expected'][$this->powertrain()]);
    }

    /**
     * Whether the model of the certificate provides this row for the powertrain and the data set has no value for it.
     *
     * @param array<int|string, mixed> $item
     */
    private function isLacking(array $item, Node $scope): bool
    {
        if ($scope !== $this->gapHost || ($item['expected'] ?? null) !== $this->powertrain()) {
            return false;
        }

        foreach (self::fieldsOf((string) $item[1]) as $names) {
            if ($this->root->first(...explode('|', $names)) !== null) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return list<Block>
     */
    private function previousStages(): array
    {
        $template = '[{StageEcTypeApprovalNumber|PreviousStageTypeApprovalNumber}][, %type% {StageEcType|PreviousStageType}]'
            . '[, %variant% {StageEcVariant|PreviousStageVariant}][, %version% {StageEcVersion|PreviousStageVersion}][, {@StageDate}]';

        $lines = [];
        foreach ($this->root->find('StageNrOfManufacturingGroup', 'ManufacturerGroup') as $stage) {
            $text = ltrim((string) $this->fill($template, $stage), ', ');
            if ($text === '') {
                continue;
            }
            $number = $stage->first('StageManufacturerNumber', 'ManufacturerStageNumber');
            $this->mark($number);
            $lines[] = ($number === null ? '' : $this->texts->get('word.stage') . ' ' . $number->value . ': ') . $text;
        }

        return $lines === [] ? [] : [self::rowOf('0.2.2', $this->texts->item('0.2.2'), $lines)];
    }

    /**
     * @return list<Block>
     */
    private function identifiers(): array
    {
        $found = [];
        foreach ($this->root->find('TestFamilyIdentifiersGroup') as $group) {
            $code = $group->first('FamilyIdentifierCode', 'TestFamilyIdentifier');
            $value = $group->first('FamilyIdentifierValue', 'TestFamilyIdentifierValue');
            $this->mark($code, $value);
            if ($code !== null && $value !== null) {
                $found[$this->layout['identifiers'][$code->value] ?? $code->value][$value->value] = true;
            }
        }
        uksort($found, 'strnatcmp');

        $out = [];
        foreach ($found as $number => $values) {
            $number = (string) $number;
            $out[] = self::rowOf(str_starts_with($number, '0.') ? $number : '', $this->texts->item($number), array_map('strval', array_keys($values)));
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function manufacturers(): array
    {
        $addresses = $this->addresses();
        $out = [];
        if ($addresses['present'] !== []) {
            $out[] = self::rowOf('0.5', $this->texts->item('0.5'), $addresses['present']);
        }
        if ($addresses['previous'] !== []) {
            $out[] = self::rowOf('0.5.1', $this->texts->item('0.5.1'), $addresses['previous']);
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function representative(): array
    {
        $lines = $this->addresses()['representative'];

        return $lines === [] ? [] : [self::rowOf('0.9', $this->texts->item('0.9'), $lines)];
    }

    /**
     * @return array{present: list<string>, previous: list<string>, representative: list<string>}
     */
    private function addresses(): array
    {
        if ($this->addresses !== null) {
            return $this->addresses;
        }

        $addresses = ['present' => [], 'previous' => [], 'representative' => []];

        // IVI 1.x: the addresses of every stage, with their role.
        foreach ($this->root->find('StageNrOfManufacturingGroup') as $stage) {
            $this->mark($stage->first('StageManufacturerNumber'));
            foreach ($stage->find('AddressGroup') as $address) {
                $type = $address->first('AddressTypeCode');
                $this->mark($type);
                $line = $this->addressLine($address, ['{Name}', '{AddressLine1}', '{AddressLine2}', '[{AddressLine3}][ {PlaceOfResidence}]', '{CountryOfResidence}']);
                if ($line === '') {
                    continue;
                }
                $role = match ($type?->value) {
                    'MRP' => 'representative',
                    'BVM', 'SSM' => 'previous',
                    default => 'present',
                };
                $addresses[$role][] = $line;
            }
            $name = $this->fill('{StageManufacturerName}', $stage);
            if ($name !== null) {
                $addresses['previous'][] = $name;
            }
        }

        // IVI 2.0: the manufacturers by their stage, the last stage is the manufacturer of the vehicle.
        $groups = $this->root->find('ManufacturerGroup');
        $last = 0;
        foreach ($groups as $group) {
            $last = max($last, (int) $group->first('ManufacturerStageNumber')?->value);
        }
        foreach ($groups as $group) {
            $number = $group->first('ManufacturerStageNumber');
            $this->mark($number);
            $line = $this->addressLine($group, ['{ManufacturerName}', '{ManufacturerAddressLine1}', '{ManufacturerAddressLine2}', '[{ManufacturerAddressLine3}][ {ManufacturerPlaceOfResidence}]', '{ManufacturerCountryOfResidence}']);
            if ($line !== '') {
                $addresses[(int) $number?->value === $last ? 'present' : 'previous'][] = $line;
            }
        }
        foreach ($this->root->find('EURepresentativeGroup') as $group) {
            $line = $this->addressLine($group, ['{EURepresentativeName}', '{EURepresentativeAdressLine1}', '{EURepresentativeAdressLine2}', '[{EURepresentativeAdressLine3}][ {EURepresentativePlaceOfResidence}]', '{EURepresentativeCountryOfResidence}']);
            if ($line !== '') {
                $addresses['representative'][] = $line;
            }
        }

        return $this->addresses = $addresses;
    }

    /**
     * @param list<string> $templates
     */
    private function addressLine(Node $address, array $templates): string
    {
        $parts = [];
        foreach ($templates as $template) {
            $part = trim((string) $this->fill($template, $address));
            if ($part !== '') {
                $parts[] = $part;
            }
        }

        return implode(', ', $parts);
    }

    /**
     * @return list<Block>
     */
    private function locations(): array
    {
        $plates = [];
        $vin = [];

        foreach (['{LocOfTheStatutoryPlatesCode}', '{LocOfTheStatutoryPlates23Wheel|LocationStatutoryPlate23Wheel}'] as $template) {
            $line = $this->fill($template, $this->root);
            if ($line !== null) {
                $plates[] = $line;
            }
        }
        foreach (['{LocationOfTheVinCode}', '{LocationOfTheVinCode23Wheel|LocationVin23Wheel}'] as $template) {
            $line = $this->fill($template, $this->root);
            if ($line !== null) {
                $vin[] = $line;
            }
        }
        foreach ($this->root->find('LocationMarkingsGroup') as $group) {
            $subject = $group->first('LocationMarkingsSubject');
            $this->mark($subject);
            $line = $this->fill('{LocationMarkingsVehiclePart}[, {LocationMarkingsVehiclePartSide}][, {LocationMarkingsVehiclePartSideSection}]', $group);
            if ($line === null) {
                continue;
            }
            if ($subject?->value === 'VIN') {
                $vin[] = $line;
            } else {
                $plates[] = $line;
            }
        }

        $method = $this->fill('{MethodOfAttachmStatPlatesCode|MethodAttachmentStatutoryPlate}', $this->root);
        if ($method !== null) {
            $plates[] = $method;
        }

        $out = [];
        if ($plates !== []) {
            $out[] = self::rowOf('0.6', $this->texts->item('0.6'), $plates);
        }
        if ($vin !== []) {
            $out[] = self::rowOf('', $this->texts->get('label.vin_location'), $vin);
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function signers(): array
    {
        $lines = [];
        foreach ($this->root->find('SigningAuthorityGroup') as $group) {
            $line = ltrim((string) $this->fill('[{NameOfSigner|SignerName}][, {PositionOfSigner|SignerPosition}][, {PlaceOfSignature|SignatureLocation}][, {@DateOfSignature|SignatureDate}]', $group), ', ');
            if ($line !== '') {
                $lines[] = $line;
            }
        }

        return $lines === [] ? [] : [self::rowOf('', $this->texts->get('label.signer'), $lines)];
    }

    /**
     * @return list<Block>
     */
    private function signature(): array
    {
        return [self::rowOf('', $this->texts->get('label.signature'), [$this->texts->get($this->certificate->isSigned() ? 'word.signature_present' : 'word.signature_absent')])];
    }

    /**
     * The remarks: IVI 1.x writes them as "13:1022*30:A1:1406;A2:1414*", the number of the item the remark belongs to
     * before its text. What does not follow that pattern stays as it is.
     *
     * An asterisk ends a remark only before the number of the next one or at the end: approval and regulation numbers hold
     * asterisks of their own (e4*2018/858*00079*08).
     *
     * @return list<Block>
     */
    private function remarks(): array
    {
        $out = [];
        foreach ($this->root->find('Remarks') as $remarks) {
            $this->mark($remarks);
            array_push($out, ...$this->remarkRows($remarks->value));
        }
        foreach ($this->root->find('RemarkGroup') as $group) {
            $subject = $group->first('RemarkSubjectDescription');
            $this->mark($subject, $group->first('RemarkSubjectLanguage'));
            $remark = $group->first('Remark');
            $this->mark($remark);
            if ($remark === null) {
                continue;
            }
            $label = match ($subject?->value) {
                'ADINF' => 'additional_information',
                'EXEMP' => 'exemptions',
                'COMTS' => 'comments',
                default => null,
            };
            if ($label === null) {
                array_push($out, ...$this->remarkRows($remark->value));
            } else {
                $out[] = self::rowOf('', $this->texts->get('label.' . $label), [$remark->value]);
            }
        }

        return $out;
    }

    /**
     * @return list<Block>
     */
    private function remarkRows(string $text): array
    {
        $rows = [];
        $plain = [];
        foreach (preg_split('~\*(?=\s*(?:\d+(?:\.\d+)*\s*:|$))~', $text) ?: [$text] as $segment) {
            $segment = trim($segment);
            if ($segment === '') {
                continue;
            }
            if (preg_match('~^(\d+(?:\.\d+)*)\s*:\s*(.+)$~s', $segment, $match) === 1) {
                $lines = array_values(array_filter(array_map('trim', explode(';', $match[2])), static fn(string $line): bool => $line !== ''));
                $item = $this->texts->item($match[1]);
                $rows[] = self::rowOf('52', $this->texts->get('label.remark_for', ['number' => $match[1]]), $lines, $item === $match[1] ? '' : $item);
            } else {
                $plain[] = $segment;
            }
        }
        if ($plain !== []) {
            array_unshift($rows, self::rowOf('52', $this->texts->item('52'), $plain));
        }

        return $rows;
    }

    /**
     * What no row took: nothing of the data set is left out.
     *
     * @return list<Block>
     */
    private function further(): array
    {
        $out = [];
        foreach ($this->root->leaves() as $leaf) {
            if ($leaf->value === '' || isset($this->used[$leaf]) || in_array($leaf->name, $this->layout['technical'], true)) {
                continue;
            }
            $field = CodeLists::field($leaf->name);
            $value = $this->display($leaf) . ($field !== null && $field['unit'] !== '' ? ' ' . $field['unit'] : '');
            $out[] = self::rowOf('', $this->fieldLabel($leaf->name), [$value]);
        }

        return $out;
    }

    /**
     * The name of a field without a row of its own: the text of the language, otherwise its title in English.
     */
    private function fieldLabel(string $name): string
    {
        return $this->texts->has('field.' . $name) ? $this->texts->get('field.' . $name) : CodeLists::title($name);
    }

    /**
     * Rows that follow each other become one block: one table in the document.
     *
     * @param list<Block> $blocks
     * @return list<Block>
     */
    private static function grouped(array $blocks): array
    {
        $out = [];
        $rows = [];
        foreach ($blocks as $block) {
            if ($block['type'] === 'row') {
                $rows[] = $block;

                continue;
            }
            if ($rows !== []) {
                $out[] = ['type' => 'rows', 'rows' => $rows];
                $rows = [];
            }
            $out[] = $block;
        }
        if ($rows !== []) {
            $out[] = ['type' => 'rows', 'rows' => $rows];
        }

        return $out;
    }
}
