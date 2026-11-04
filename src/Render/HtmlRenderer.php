<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Render;

use Dealerweb\ECoc\Certificate;
use InvalidArgumentException;

/**
 * Renders a certificate as a complete HTML page with its styles in the page: no script, no external resource.
 */
final class HtmlRenderer
{
    /**
     * @param string $language de, en or fr
     * @throws InvalidArgumentException for any other language
     */
    public function __construct(private readonly string $language = 'en')
    {
        Texts::assertLanguage($language);
    }

    public function render(Certificate $certificate): string
    {
        return Template::render((new ViewBuilder($certificate, $this->language))->build(), false);
    }
}
