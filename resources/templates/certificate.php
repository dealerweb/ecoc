<?php

declare(strict_types=1);

/**
 * The document, from the view of Render\ViewBuilder.
 *
 * @var array<string, mixed> $view
 * @var string $css
 * @var bool $pdf
 */

$e = static fn(string $text): string => htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

?><!DOCTYPE html>
<html lang="<?= $e($view['language']) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $e($view['documentTitle']) ?></title>
<style>
<?= $css ?>
</style>
</head>
<body<?= $pdf ? '' : ' class="screen"' ?>>
<div class="sheet">
<table>
<tr>
<td>
<div class="notice"><?= $e($view['notice']) ?></div>
<div class="vehicle"><?= $e($view['vehicle']) ?></div>
</td>
<td class="vin-box">
<div class="vin-label"><?= $e($view['vinLabel']) ?></div>
<div class="vin"><?= $e($view['vin']) ?></div>
</td>
</tr>
</table>
<?php foreach ($view['parts'] as $part) { ?>
<div class="part"><?= $e($part['title']) ?></div>
<?php foreach ($part['sections'] as $section) { ?>
<div class="section-title"><?= $e($section['title']) ?></div>
<?php foreach ($section['blocks'] as $block) { ?>
<?php if ($block['type'] === 'subheading') { ?>
<div class="subheading"><?= $e($block['text']) ?></div>
<?php } elseif ($block['type'] === 'table') { ?>
<table class="values">
<thead>
<tr>
<th class="number"><?= $e($block['number']) ?></th>
<?php foreach ($block['head'] as $index => $cell) { ?>
<th<?= $index === 0 ? ' class="label"' : '' ?>><?= $e($cell) ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php foreach ($block['rows'] as $row) { ?>
<tr>
<td class="number"></td>
<?php foreach ($row as $index => $cell) { ?>
<td<?= $index === 0 ? ' class="label"' : '' ?>><?php if ($cell === null) { ?><span class="missing"><?= $e($block['missing']) ?></span><?php } else { ?><?= $e($cell) ?><?php } ?></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { ?>
<table class="rows">
<?php foreach ($block['rows'] as $row) { ?>
<tr>
<td class="number"><?= $e($row['number']) ?></td>
<td class="label"><?= $e($row['label']) ?><?php if ($row['note'] !== '') { ?><div class="note"><?= $e($row['note']) ?></div><?php } ?></td>
<td class="value"><?php foreach ($row['lines'] as $line) { ?><div<?= $row['missing'] ? ' class="missing"' : '' ?>><?= $e($line) ?></div><?php } ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if (! $pdf) { ?>
<div class="foot"><?= $e($view['footer']) ?></div>
<?php } ?>
</div>
</body>
</html>
