<?php

declare(strict_types=1);

// The data set as a booklet: A5 pages on A4 sheets in landscape. Print it on both sides, flipped on the short edge, and
// fold it once.
//
//     php examples/pdf-as-a-booklet.php [file]

use Dealerweb\ECoc\Certificate;
use Dealerweb\ECoc\Render\PdfRenderer;

require __DIR__ . '/bootstrap.php';

$certificate = Certificate::fromFile(dataSet('plug-in-hybrid-ivi-1.9.xml'));

save('booklet-de.pdf', (new PdfRenderer('de'))->renderBooklet($certificate));
