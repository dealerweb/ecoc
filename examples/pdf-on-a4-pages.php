<?php

declare(strict_types=1);

// The data set as a PDF on A4 pages, in German, English and French.
//
//     php examples/pdf-on-a4-pages.php [file]

use Dealerweb\ECoc\Certificate;
use Dealerweb\ECoc\Render\PdfRenderer;

require __DIR__ . '/bootstrap.php';

$certificate = Certificate::fromFile(dataSet('combustion-ivi-1.9.xml'));

foreach (['de', 'en', 'fr'] as $language) {
    save("a4-$language.pdf", (new PdfRenderer($language))->render($certificate));
}
