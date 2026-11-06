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

    private const ROAD_VEHICLES = '2018/858';

    /** What separates the values of a row that pairs labels with values: "CO: 1 mg/km · NOx: 2 mg/km". */
    private const PAIRS = ' · ';

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

    /** The regulation the vehicle is approved under. The numbers of the document are those of 2018/858. */
    private string $act = self::ROAD_VEHICLES;

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
        $this->act = self::actOf($this->certificate->value('VehicleCategoryCode', 'VehicleCategory') ?? '');

        $parts = [];
        foreach ($this->layout['parts'] as $partKey => $sections) {
            $built = [];
            foreach ($sections as $sectionKey => $items) {
                $blocks = self::grouped($this->numberedAsTheAct($this->items($items, $this->root)));
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
            'combination' => $this->combination(),
            'towing' => $this->towing(),
            'engines' => $this->engines(),
            'gears' => $this->gears(),
            'axleSuspension' => $this->axleSuspension(),
            'tyres' => $this->tyres(),
            'bodywork' => $this->bodywork(),
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
        if (isset($item['act']) && $item['act'] !== $this->act) {
            return null;
        }

        $scope = ($item['root'] ?? false) === true ? $this->root : $scope;
        $lines = $this->lines($item, $scope);
        $missing = $lines === [];
        if ($missing && ! $this->isLacking($item, $scope)) {
            return null;
        }

        $number = (string) $item[0];
        $label = isset($item['label']) ? $this->texts->get('label.' . $item['label']) : $this->texts->item($number);

        return self::rowOf($number, $label, $missing ? [self::MISSING] : $lines, '', $missing);
    }

    private static function actOf(string $category): string
    {
        return match ($category === '' ? '' : $category[0]) {
            'L' => '168/2013',
            'T', 'C', 'R', 'S' => '167/2013',
            default => self::ROAD_VEHICLES,
        };
    }

    /**
     * The lines a row takes from a scope.
     *
     * @param array<int|string, mixed> $item
     * @return list<string>
     */
    private function lines(array $item, Node $scope): array
    {
        $groups = isset($item['groups']) ? (string) $item['groups'] : null;
        if (isset($item['axles'])) {
            return $this->axleValues((string) $item['axles'], ($item['spacing'] ?? false) === true, $groups);
        }
        if (isset($item['axleGroups'])) {
            return $this->axleGroupValues((string) $item['axleGroups'], $groups);
        }

        $lines = [];
        foreach ($this->scopes($scope, $groups) as $group) {
            if (isset($item['pairs'])) {
                array_push($lines, ...$this->pairs($item['pairs'], $group));

                continue;
            }
            foreach ((array) $item[1] as $template) {
                if (($item['all'] ?? false) === true) {
                    array_push($lines, ...$this->every((string) $template, $group));

                    continue;
                }
                $line = $this->line((string) $template, $group);
                if ($line !== null && $line !== '') {
                    $lines[] = $line;
                }
            }
        }

        return ($item['distinct'] ?? false) === true ? array_values(array_unique($lines)) : $lines;
    }

    /**
     * The groups of this name below a scope, or the scope itself when it has none: IVI 1.x has some of them only since a version.
     *
     * @return list<Node>
     */
    private function scopes(Node $scope, ?string $groups): array
    {
        return $groups === null ? [$scope] : ($scope->find(...explode('|', $groups)) ?: [$scope]);
    }

    /**
     * A template as a line of its own: what an optional part leaves in front of the first value goes.
     */
    private function line(string $template, Node $scope): ?string
    {
        $line = $this->fill($template, $scope);

        return $line === null ? null : ltrim($line, ', ');
    }

    /**
     * Every occurrence of a template in a scope, one line each.
     *
     * @return list<string>
     */
    private function every(string $template, Node $scope): array
    {
        $lines = [];
        while (($line = $this->line($template, $scope)) !== null && $line !== '') {
            $lines[] = $line;
        }

        return $lines;
    }

    /**
     * The blocks without their numbers where the numbers of Annex VIII do not hold: two-wheelers (Regulation (EU) No 168/2013) and
     * tractors (Regulation (EU) No 167/2013) have certificates with other numbers, a number here would point to something else.
     *
     * @param list<Block> $blocks
     * @return list<Block>
     */
    private function numberedAsTheAct(array $blocks): array
    {
        if ($this->act === self::ROAD_VEHICLES) {
            return $blocks;
        }

        return array_map(static fn(array $block): array => isset($block['number']) ? ['number' => ''] + $block : $block, $blocks);
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
            '~\{([#@=^\~]?)([\w|]+)\}|%(\w+)%~',
            function (array $match) use ($scope, $marked, &$missing, &$taken): string {
                if (($match[3] ?? '') !== '') {
                    return $this->texts->get('word.' . $match[3]);
                }

                $names = explode('|', $match[2]);
                $node = $match[1] === '~' ? $scope->first(...$names) : $this->unused($names, $scope, [...$marked, ...$taken]);
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

        return $parts === [] ? [] : [implode(self::PAIRS, $parts)];
    }

    /**
     * @return list<string>
     */
    private function axleValues(string $template, bool $spacing, ?string $groups): array
    {
        $values = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            foreach ($this->scopes($axle, $groups) as $scope) {
                foreach ($this->every($template, $scope) as $value) {
                    $number = $this->axleNumber($axle, $index);
                    $values[$spacing ? $number . '-' . ((int) $number + 1) : $number][] = $value;
                }
            }
        }

        return self::axleLines($values);
    }

    /**
     * One value on every axle fits on one line: "1: 780 kg · 2: 720 kg". With several values on an axle, every axle has its own line.
     *
     * @param array<int|string, list<string>> $values
     * @return list<string>
     */
    private static function axleLines(array $values): array
    {
        if ($values === []) {
            return [];
        }

        $lines = [];
        foreach ($values as $number => $list) {
            $lines[] = "$number: " . implode(' · ', $list);
        }

        return max(array_map('count', $values)) === 1 ? [implode(' · ', $lines)] : $lines;
    }

    /**
     * @return list<string>
     */
    private function axleGroupValues(string $template, ?string $groups): array
    {
        $values = [];
        foreach ($this->root->find('AxleGroupGroup') as $index => $group) {
            foreach ($this->scopes($group, $groups) as $scope) {
                foreach ($this->every($template, $scope) as $value) {
                    $number = $group->first('AxleGroupNumber');
                    $this->mark($number);
                    $values[$number->value ?? (string) ($index + 1)][] = $value;
                }
            }
        }

        return self::axleLines($values);
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
            $connections = $number === '3' ? $this->axleConnections() : [];
            if ($total === null && $positions === [] && $connections === []) {
                continue;
            }
            $line = $total ?? ($positions === [] ? '' : (string) count($positions));
            if ($positions !== []) {
                $line .= ' (' . $this->texts->get('word.axle') . ' ' . implode(', ', $positions) . ')';
            }
            $out[] = self::rowOf($number, $label === null ? $this->texts->item($number) : $this->texts->get('label.' . $label), $line === '' ? $connections : [$line, ...$connections]);
        }

        return $out;
    }

    /**
     * How powered axles are connected. A connection stands with both of its axles in the data set, on the page once.
     *
     * @return list<string>
     */
    private function axleConnections(): array
    {
        $lines = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            foreach ($axle->find('InterconnWithPoweredAxleGroup', 'InterconnectionWithPoweredAxleGroup') as $group) {
                $other = $group->first('InterconnWithPoweredAxleNumber', 'InterconnectionWithPoweredAxleNumber');
                $connection = $group->first('InterconnOfPoweredAxles', 'InterconnectionWithPoweredAxleConnection');
                $this->mark($other, $connection);
                $pair = $other === null ? [$this->axleNumber($axle, $index)] : [$this->axleNumber($axle, $index), $other->value];
                sort($pair);
                $lines[implode('-', $pair)] = $this->texts->get('word.axle') . ' ' . implode(' - ', $pair) . ($connection === null ? '' : ': ' . $this->display($connection));
            }
        }

        return array_values($lines);
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
        $size = '{TyreSize}[ {LoadCapacityIndexSingleWheel}][/{LoadCapacityIndexTwinWheel}][{SpeedCategorySymbol}]'
            . '[, {RimSizeIncludingOffSet}][, {RimSize}][/ET{#RimOffSet}]';
        $classes = '[, {TyreTubeTypeCode|TyreTubeType}][, {TyrePlyRatingNumber} PR][; %rrc% {RollingResistanceClassCode|RollingResistanceClass}][, {TyreCategoryCode|TyreCategory}]';

        $lines = [];
        foreach ($this->root->find('AxleGroup') as $index => $axle) {
            foreach ($axle->find('TyreAxleGroup') as $tyre) {
                $value = $this->fill($size, $tyre);
                if ($value === null) {
                    continue;
                }
                // IVI 2 has a value for each type: a tyre can be M+S and Extra Load.
                while (($type = $this->fill('{TypeOfTyre|TyreType}', $tyre)) !== null) {
                    $value .= ', ' . $type;
                }
                $value .= (string) $this->fill($classes, $tyre);
                $this->mark($tyre->first('TyreNumber'));
                foreach (['CO2DeterminationTyreInd' => 'tyre_co2', 'ProductionTyreRimVehInd' => 'tyre_production', 'TyreFittedProductionIndicator' => 'tyre_production', 'TyreMaximumSpeedIndicator' => 'tyre_over_300'] as $flag => $word) {
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
     * The bodywork, one line each: a code with all its supplements.
     *
     * @return list<Block>
     */
    private function bodywork(): array
    {
        $lines = [];
        foreach ($this->scopes($this->root, 'BodyworkGroup') as $group) {
            $code = $this->fill('{=CodeForBodywork}', $group);
            $parts = [...($code === null ? [] : [$code]), ...$this->every('{NumberForBodywork|CodeForBodyworkSupplement}', $group)];
            if ($parts !== []) {
                $lines[] = implode(', ', $parts);
            }
        }

        return $lines === [] ? [] : [self::rowOf('38', $this->texts->item('38'), $lines)];
    }

    /**
     * The maximum mass of the combination as a value of the vehicle: a type of trailer without a towable mass of its own, the same
     * mass once. With a towable mass it stands in the row of that trailer.
     *
     * @return list<Block>
     */
    private function combination(): array
    {
        $lines = [];
        foreach ($this->root->find('DrawbarTypeGroup', 'BodyworkTypeGroup') as $type) {
            if ($type->first('TechPermMaxTowMassTrailer', 'TechnicallyPermissibleMaximumTowableMass') !== null) {
                continue;
            }
            $line = $this->fill('{TechnPermMaxMassCombinTrail|TechnicallyPermissibleMaximumCombinationMass} kg', $type);
            if ($line !== null) {
                $lines[] = $line;
            }
        }

        return $lines === [] ? [] : [self::rowOf('16.4', $this->texts->item('16.4'), array_values(array_unique($lines)))];
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
                    $mass .= ' (' . ($this->act === self::ROAD_VEHICLES ? '16.4' : $this->texts->item('16.4')) . ': ' . $combination . ')';
                }
                $rows[$number][] = $mass;
            }
        }

        uksort($rows, static fn(int|string $a, int|string $b): int => strnatcmp((string) $a, (string) $b));

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
                $gear = $direction?->value === 'R' ? 'R' : $number?->value;
                $parts[] = ($gear === null ? '' : "$gear: ") . $this->format->number($ratio->value);
            }
        }

        return $parts === [] ? [] : [self::rowOf('28.1', $this->texts->item('28.1'), [implode(' · ', $parts)])];
    }

    /**
     * The environmental performance and the eco-innovations of the vehicle. The certificate states them for the whole vehicle
     * (points 46 to 49 of Annex VIII), the data set fuel by fuel - and a manufacturer repeats them there: the electric motors
     * of a vehicle each carry the same consumption and the same ranges. A fuel that repeats an earlier one is not shown again,
     * and what the fuels give together stands together, as in the model of the certificate: every value once, all of it in
     * the order of the numbers, the values of the WLTP in one table. Only when two fuels give different values for the same
     * point, like a vehicle that runs on petrol and on gas, the document goes fuel by fuel, each under its heading, and the
     * eco-innovations stand behind them.
     *
     * @return list<Block>
     */
    private function environment(): array
    {
        // Point by point of the layout, so that the values of several fuels can stand together in its order.
        /** @var list<array{nodes: list<Node>, points: list<list<Block>>}> $fuels */
        $fuels = [];
        foreach ($this->fuels() as $fuel) {
            $points = [];
            foreach ($this->layout['fuel_environment'] as $item) {
                $points[] = $this->items([$item], $fuel);
            }
            $blocks = array_merge(...$points);
            if ($blocks === []) {
                continue;
            }
            $repeated = false;
            foreach ($fuels as $index => $earlier) {
                if (self::repeats(array_merge(...$earlier['points']), $blocks)) {
                    $repeated = true;
                    // Its engine joins the heading of the same fuel, like a second electric motor, never that of another.
                    if ($earlier['nodes'][0]->first('FuelCode', 'EnergySource')?->value === $fuel->first('FuelCode', 'EnergySource')?->value) {
                        $fuels[$index]['nodes'][] = $fuel;

                        break;
                    }
                }
            }
            if (! $repeated) {
                $fuels[] = ['nodes' => [$fuel], 'points' => $points];
            }
        }

        $eco = $this->items($this->layout['eco'], $this->root);
        $together = $this->together(array_column($fuels, 'points'));
        if ($together !== null) {
            return self::inNumberOrder([...$together, ...$eco]);
        }

        $out = [];
        foreach ($fuels as $fuel) {
            $out[] = ['type' => 'subheading', 'text' => $this->fuelHeading($fuel['nodes'])];
            array_push($out, ...array_merge(...$fuel['points']));
        }

        return [...$out, ...$eco];
    }

    /**
     * Whether the blocks of a fuel only repeat those of an earlier fuel: every row and every table among them.
     *
     * @param list<Block> $earlier
     * @param list<Block> $blocks
     */
    private static function repeats(array $earlier, array $blocks): bool
    {
        foreach ($blocks as $block) {
            if (! in_array($block, $earlier, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * The values of several fuels as those of one vehicle, point by point of the layout: a row another fuel shows the same
     * stands once, the tables become one. Null when two fuels give different values for the same point.
     *
     * @param list<list<list<Block>>> $fuels the blocks of each fuel, point by point
     * @return list<Block>|null
     */
    private function together(array $fuels): ?array
    {
        $out = [];
        foreach (array_keys($this->layout['fuel_environment']) as $point) {
            $together = null;
            foreach ($fuels as $points) {
                // A point is one row or one table.
                foreach ($points[$point] ?? [] as $block) {
                    if ($together === null) {
                        $together = $block;
                    } elseif ($block['type'] === 'table') {
                        $together = $this->joinedTable($together, $block);
                        if ($together === null) {
                            return null;
                        }
                    } elseif ($block !== $together) {
                        $together = self::wider($together, $block);
                        if ($together === null) {
                            return null;
                        }
                    }
                }
            }
            if ($together !== null) {
                $out[] = $together;
            }
        }

        return $out;
    }

    /**
     * Of two rows for the same point, the one that holds all values of the other: a fuel often repeats only a part of a row,
     * like the drive-by noise of the vehicle without its stationary noise. Null when each has a value the other lacks.
     *
     * @param Block $row
     * @param Block $other
     * @return Block|null
     */
    private static function wider(array $row, array $other): ?array
    {
        if ($row['missing'] !== $other['missing']) {
            return null;
        }
        $mine = self::values($row);
        $theirs = self::values($other);
        if (array_diff($theirs, $mine) === []) {
            return $row;
        }

        return array_diff($mine, $theirs) === [] ? $other : null;
    }

    /**
     * The values of a row: its lines, a line that pairs labels with values split into its pairs.
     *
     * @param Block $row
     * @return list<string>
     */
    private static function values(array $row): array
    {
        /** @var list<string> $lines */
        $lines = $row['lines'];
        $values = [];
        foreach ($lines as $line) {
            array_push($values, ...explode(self::PAIRS, $line));
        }

        return $values;
    }

    /**
     * Two tables of a kind as one: a cell only one of them has a value for takes it. Null when both have a value for the
     * same cell and the values differ, or the same row in another unit.
     *
     * @param Block $table
     * @param Block $other
     * @return Block|null
     */
    private function joinedTable(array $table, array $other): ?array
    {
        /** @var array<string, array{label: string, cells: array<int, string|null>}> $filled */
        $filled = $table['filled'];
        /** @var array<string, array{label: string, cells: array<int, string|null>}> $more */
        $more = $other['filled'];

        foreach ($more as $rowKey => $row) {
            $mine = $filled[$rowKey] ?? null;
            if ($mine === null) {
                $filled[$rowKey] = $row;

                continue;
            }
            if ($mine['label'] !== $row['label']) {
                return null;
            }
            foreach ($row['cells'] as $column => $cell) {
                $value = $mine['cells'][$column] ?? '';
                if ($cell === '' || $cell === $value) {
                    continue;
                }
                if ($value !== '') {
                    return null;
                }
                $filled[$rowKey]['cells'][$column] = $cell;
            }
        }

        return $this->tableBlock((string) $table['name'], $filled);
    }

    /**
     * The heading of a fuel when the document goes fuel by fuel: the name of the fuel - in IVI 1.x the electric part of a
     * hybrid has no fuel code, it is electricity - and, with several engines, the engines the fuel belongs to.
     *
     * @param list<Node> $fuels the fuel and those that repeat its values
     */
    private function fuelHeading(array $fuels): string
    {
        $code = $fuels[0]->first('FuelCode', 'EnergySource');
        $heading = $code === null ? $this->texts->get('word.electricity') : $this->display($code);

        $engines = $this->root->find('EngineGroup', 'EnergyConvertorGroup');
        $numbers = [];
        foreach ($engines as $index => $engine) {
            foreach ($engine->find('FuelGroup', 'EnergySourceGroup') as $fuel) {
                if (in_array($fuel, $fuels, true) && ! in_array($index + 1, $numbers, true)) {
                    $numbers[] = $index + 1;
                }
            }
        }

        return count($engines) < 2 || $numbers === [] ? $heading : $heading . ' (' . $this->texts->get('word.engine') . ' ' . implode(', ', $numbers) . ')';
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
        $unit = $this->fuelUnit($scope);
        $filled = [];
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
                $shown = $shown || $cells[$column] !== '';
            }
            if ($shown) {
                $filled[$rowKey] = ['label' => $this->texts->get('table.' . $rowKey, ['unit' => $unit]), 'cells' => $cells];
            }
        }

        return $filled === [] ? [] : [$this->tableBlock($name, $filled)];
    }

    /**
     * A table of the document from its rows: the columns that have a value, the rows in the order of the table. The rows stay
     * in the block, so that the tables of several fuels can become one.
     *
     * @param array<string, array{label: string, cells: array<int, string|null>}> $filled the rows with a value, by key: the cells
     *        by column - a value, null for a value the data set lacks, '' where the certificate has no such value
     * @return Block
     */
    private function tableBlock(string $name, array $filled): array
    {
        $definition = $this->layout['tables'][$name];
        $columns = [];
        foreach ($filled as $row) {
            foreach ($row['cells'] as $column => $cell) {
                if ($cell !== '') {
                    $columns[$column] = true;
                }
            }
        }
        $columns = array_keys($columns);
        sort($columns);

        $head = [$this->texts->get('label.table_' . $name)];
        foreach ($columns as $column) {
            $head[] = $this->texts->get('column.' . $definition['columns'][$column]);
        }

        $rows = [];
        foreach (array_keys($definition['rows']) as $rowKey) {
            $row = $filled[$rowKey] ?? null;
            if ($row !== null) {
                $line = [$row['label']];
                foreach ($columns as $column) {
                    $line[] = $row['cells'][$column];
                }
                $rows[] = $line;
            }
        }

        return ['type' => 'table', 'name' => $name, 'number' => $this->tableNumber($name), 'head' => $head, 'rows' => $rows, 'missing' => self::MISSING, 'filled' => $filled];
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
     * What point 49 of the certificate distinguishes: externally chargeable hybrids, pure electric vehicles, vehicles without a
     * combustion engine like those with a fuel cell (no CO2 of their own), all others.
     */
    private function powertrain(): string
    {
        if ($this->root->first('PureElectricVehIndicator', 'PureElectricVehicleIndicator', 'PureElectricIndicator')?->value === 'Y') {
            return 'electric';
        }

        $class = $this->root->first('ClassOfHybridVehicleCode', 'ClassHybridVehicle', 'CategoryHybridElectricVehicle')->value ?? '';
        $charged = $this->root->first('OffVehicleChargingVehInd', 'OffVehicleChargingIndicator')?->value;
        if (str_starts_with($class, 'OVC') || $charged === 'Y') {
            return 'ovc';
        }

        return $this->root->first('EngineCapacity') === null ? 'no_combustion' : 'other';
    }

    /**
     * Where the document marks what the data set lacks: with the first fuel that has values of the WLTP, so that it says so
     * once. The document shows what a data set delivers, so a gap is marked and never filled. Only for the categories the
     * official rules ask these values of (M1, M2, N1, N2), and only with such values, in a format that has these fields (since
     * IVI 1.8): an older or a heavy vehicle has other points.
     */
    private function findGapHost(): ?Node
    {
        $category = $this->certificate->value('VehicleCategoryCode', 'VehicleCategory') ?? '';
        $version = $this->certificate->formatVersion() ?? '';
        if (preg_match('~^[MN][12]~', $category) !== 1 || version_compare($version, '1.8', '<')) {
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
        preg_match_all('~\{[#@=^\~]?([\w|]+)\}~', $template, $fields);

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
            $text = (string) $this->line($template, $stage);
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
            $line = $this->addressLine($group, ['{EURepresentativeName}', '{EURepresentativeAddressLine1}', '{EURepresentativeAddressLine2}', '[{EURepresentativeAddressLine3}][ {EURepresentativePlaceOfResidence}]', '{EURepresentativeCountryOfResidence}']);
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
            $line = (string) $this->line('[{NameOfSigner|SignerName}][, {PositionOfSigner|SignerPosition}][, {PlaceOfSignature|SignatureLocation}][, {@DateOfSignature|SignatureDate}]', $group);
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
                // The numbers of other acts mean something else: the text of the number would be wrong there.
                $item = $this->act === self::ROAD_VEHICLES ? $this->texts->item($match[1]) : $match[1];
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
            $version = $this->certificate->formatVersion();
            $field = CodeLists::field($leaf->name, $version);
            $value = $this->display($leaf, CodeLists::isDecimal($leaf->name, $version) ? '#' : '') . ($field !== null && $field['unit'] !== '' ? ' ' . $field['unit'] : '');
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
