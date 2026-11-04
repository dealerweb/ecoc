<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use RuntimeException;
use Throwable;

/**
 * Fills the template (resources/templates/certificate.php) with a prepared view.
 *
 * @internal
 */
final class Template
{
    /**
     * @param array<string, mixed> $view from ViewBuilder::build()
     * @param bool $pdf the document is meant for dompdf: no screen frame
     * @param bool $booklet the pages are A5 pages of a booklet: resources/templates/booklet.css on top
     */
    public static function render(array $view, bool $pdf, bool $booklet = false): string
    {
        $directory = dirname(__DIR__, 2) . '/resources/templates';
        $css = '';
        foreach ($booklet ? ['certificate.css', 'booklet.css'] : ['certificate.css'] as $file) {
            $styles = file_get_contents($directory . '/' . $file);
            if ($styles === false) {
                throw new RuntimeException("Cannot read $directory/$file - the package is incomplete");
            }
            $css .= $styles;
        }

        ob_start();
        try {
            (static function (array $view, string $css, bool $pdf, string $template): void {
                require $template;
            })($view, $css, $pdf, $directory . '/certificate.php');
        } catch (Throwable $exception) {
            ob_end_clean();

            throw $exception;
        }

        return (string) ob_get_clean();
    }
}
