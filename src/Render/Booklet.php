<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use LogicException;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

/**
 * Puts the A5 pages of a document on A4 sheets in landscape so that the sheets make a booklet. The pages are placed as
 * they are: text and lines stay text and lines, fonts stay embedded.
 *
 * @internal
 */
final class Booklet extends Fpdi
{
    private const SHEET_WIDTH = 297.0;

    private const SHEET_HEIGHT = 210.0;

    /**
     * @param string $pdf the document with the pages of the booklet
     */
    public static function impose(string $pdf, string $title): string
    {
        $sheets = new self('L', 'mm', 'A4');
        $sheets->PDFVersion = '1.7';
        $sheets->SetAutoPageBreak(false);
        $sheets->SetTitle($title, true);
        $sheets->SetCreator('dealerweb/ecoc', true);

        $pages = $sheets->setSourceFile(StreamReader::createByString($pdf));
        foreach (self::sides($pages) as [$left, $right]) {
            $sheets->AddPage();
            $sheets->place($left, $pages, 0.0);
            $sheets->place($right, $pages, self::SHEET_WIDTH / 2);
        }

        return $sheets->Output('S');
    }

    /**
     * The sides of the sheets in the order of printing, each with the page on its left and on its right half. The
     * outermost sheet comes first and carries the last and the first page. A booklet has a multiple of four pages: what
     * the document does not fill stays blank at the end.
     *
     * @return list<array{int, int}>
     */
    public static function sides(int $pages): array
    {
        $sides = [];
        $last = (int) ceil($pages / 4) * 4;
        for ($first = 1; $first < $last; $first += 2, $last -= 2) {
            $sides[] = [$last, $first];
            $sides[] = [$first + 1, $last - 1];
        }

        return $sides;
    }

    /**
     * Tells the printing dialog what the booklet needs: both sides, flipped on the short edge. Not every dialog listens.
     */
    protected function _putcatalog(): void
    {
        parent::_putcatalog();
        $this->_put('/ViewerPreferences <</Duplex /DuplexFlipShortEdge>>');
    }

    private function place(int $page, int $pages, float $x): void
    {
        if ($page > $pages) {
            return;
        }

        $template = $this->importPage($page);
        $size = $this->getTemplateSize($template);
        if (! is_array($size)) {
            throw new LogicException("Page $page of the booklet has no size.");
        }
        $this->useTemplate($template, $x + (self::SHEET_WIDTH / 2 - $size['width']) / 2, (self::SHEET_HEIGHT - $size['height']) / 2);
    }
}
