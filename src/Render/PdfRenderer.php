<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use Dealerweb\ECoc\Certificate;
use Dompdf\Canvas;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
use Dompdf\Options;
use InvalidArgumentException;
use LogicException;

/**
 * Renders a certificate as a PDF with dompdf - a reading aid, not a certificate of conformity: every page says so.
 * dompdf runs with every external access switched off (no remote files, no PHP, no JavaScript in the document).
 */
final class PdfRenderer
{
    /** The foot of a page in millimetres and points: side margin, distance of the text from the bottom edge, font size. */
    private const FOOT_A4 = [16.0, 11.0, 6.5];

    private const FOOT_A5 = [9.0, 6.5, 5.0];

    /**
     * @param string $language de, en or fr
     * @throws InvalidArgumentException for any other language
     */
    public function __construct(private readonly string $language = 'en')
    {
        Texts::assertLanguage($language);
    }

    /**
     * The certificate on A4 pages.
     */
    public function render(Certificate $certificate): string
    {
        $view = (new ViewBuilder($certificate, $this->language))->build();

        return $this->pdf($view, false);
    }

    /**
     * The certificate as a booklet: A5 pages, two on each side of an A4 sheet in landscape. Printed on both sides with
     * the sheet flipped on its short edge and folded once, the pages are in order; several sheets are laid into each
     * other. A data set of a passenger car fits on one sheet.
     */
    public function renderBooklet(Certificate $certificate): string
    {
        $view = (new ViewBuilder($certificate, $this->language))->build();

        return Booklet::impose($this->pdf($view, true), (string) $view['documentTitle']);
    }

    /**
     * @param array<string, mixed> $view
     */
    private function pdf(array $view, bool $booklet): string
    {
        $options = new Options();
        $options->setIsRemoteEnabled(false);
        $options->setIsPhpEnabled(false);
        $options->setIsJavascriptEnabled(false);
        $options->setDefaultFont('DejaVu Sans');
        $options->setDefaultMediaType('print');
        $options->setDefaultPaperSize($booklet ? 'a5' : 'a4');
        $options->setDefaultPaperOrientation('portrait');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(Template::render($view, true, $booklet), 'UTF-8');
        $dompdf->render();
        $dompdf->addInfo('Title', (string) $view['documentTitle']);
        $dompdf->addInfo('Creator', 'dealerweb/ecoc');

        $this->footer($dompdf->getCanvas(), (string) $view['footer'], (string) $view['page'], $booklet ? self::FOOT_A5 : self::FOOT_A4);

        return (string) $dompdf->output();
    }

    /**
     * The note and "page x of y" at the foot of every page - drawn after the layout, when the number of pages is known.
     *
     * @param array{float, float, float} $foot
     */
    private function footer(Canvas $canvas, string $note, string $pageText, array $foot): void
    {
        [$margin, $bottom, $size] = $foot;
        $canvas->page_script(static function (int $number, int $count, Canvas $canvas, FontMetrics $metrics) use ($note, $pageText, $margin, $bottom, $size): void {
            // DejaVu Sans comes with dompdf. The note is no option: without the font there is no document.
            $font = $metrics->getFont('DejaVu Sans') ?? throw new LogicException('The font DejaVu Sans of dompdf is missing.');

            $color = [0.373, 0.420, 0.478];
            $millimetre = 72 / 25.4;
            $left = $margin * $millimetre;
            $right = $canvas->get_width() - $margin * $millimetre;
            $top = $canvas->get_height() - $bottom * $millimetre;
            $text = str_replace(['{page}', '{pages}'], [(string) $number, (string) $count], $pageText);

            $canvas->line($left, $top - 3, $right, $top - 3, [0.851, 0.871, 0.894], 0.5);
            $canvas->text($left, $top, $note, $font, $size, $color);
            $canvas->text($right - $metrics->getTextWidth($text, $font, $size), $top, $text, $font, $size, $color);
        });
    }
}
