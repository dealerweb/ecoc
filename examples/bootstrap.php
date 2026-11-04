<?php

declare(strict_types=1);

// Shared by the examples: the autoloader of Composer, the example data sets in examples/input and the folder the
// examples write to - examples/output, or the folder ECOC_EXAMPLES_OUTPUT names.

$autoloader = null;
foreach ([__DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../autoload.php'] as $candidate) {
    if (is_file($candidate)) {
        $autoloader = $candidate;
        break;
    }
}
if ($autoloader === null) {
    fwrite(STDERR, "Run \"composer install\" first.\n");
    exit(1);
}
require $autoloader;

/**
 * The data set given on the command line (php example.php <file>), or the example data set of that name.
 */
function dataSet(string $name): string
{
    $given = $_SERVER['argv'][1] ?? null;
    if (is_string($given) && $given !== '') {
        return $given;
    }

    return __DIR__ . '/input/' . $name;
}

/**
 * Writes a file of an example and says so.
 */
function save(string $name, string $content): void
{
    $directory = getenv('ECOC_EXAMPLES_OUTPUT') ?: __DIR__ . '/output';
    if (! is_dir($directory) && ! mkdir($directory, 0o777, true) && ! is_dir($directory)) {
        throw new RuntimeException("Cannot create the folder $directory.");
    }
    if (file_put_contents($directory . '/' . $name, $content) === false) {
        throw new RuntimeException("Cannot write $directory/$name.");
    }
    printf("wrote output/%s (%s KB)\n", $name, number_format(strlen($content) / 1024, 1));
}
