<?php

declare(strict_types=1);

// The data set as an HTML page: complete, with its styles in the page, without a script or an external resource.
//
//     php examples/html-page.php [file]

use Dealerweb\ECoc\Certificate;
use Dealerweb\ECoc\Render\HtmlRenderer;

require __DIR__ . '/bootstrap.php';

$certificate = Certificate::fromFile(dataSet('plug-in-hybrid-ivi-2.0.xml'));

save('page-en.html', (new HtmlRenderer('en'))->render($certificate));
