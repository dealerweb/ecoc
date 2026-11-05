<?php

declare(strict_types=1);

namespace Dealerweb\ECoc;

use Dealerweb\ECoc\Exception\InvalidCertificate;
use DOMDocument;
use DOMElement;

/**
 * The electronic certificate of conformity (eCoC) of one vehicle: its IVI data set (Initial Vehicle Information), in
 * the formats IVI 1.x and IVI 2.0.
 *
 * The XML is the data set. Anything rendered from it is a reading aid, not a certificate of conformity.
 */
final class Certificate
{
    private const SIGNATURE_NAMESPACE = 'http://www.w3.org/2000/09/xmldsig#';

    /**
     * Far beyond any data set, whose examples have 13 to 18 KB and a few hundred elements. A document costs much more to
     * render than its size: 5000 elements in 76 KB take more than a gigabyte of memory for a PDF.
     */
    private const MAX_BYTES = 262144;

    private const MAX_ELEMENTS = 2000;

    private function __construct(
        private readonly Node $root,
        private readonly bool $signed,
    ) {}

    /**
     * @throws InvalidCertificate the file cannot be read or holds no IVI data set
     */
    public static function fromFile(string $path): self
    {
        // The failure is the exception below: a warning would become another exception in many frameworks.
        $xml = is_file($path) ? @file_get_contents($path) : false;
        if ($xml === false) {
            throw new InvalidCertificate("Cannot read the file \"$path\".");
        }

        return self::fromXml($xml);
    }

    /**
     * Reads the document with every network access switched off and without entities: a data set comes from outside.
     *
     * @throws InvalidCertificate the document is no IVI data set
     */
    public static function fromXml(string $xml): self
    {
        if (trim($xml) === '') {
            throw new InvalidCertificate('The document is empty.');
        }
        if (strlen($xml) > self::MAX_BYTES) {
            throw new InvalidCertificate('The document is far larger than any IVI data set.');
        }
        if (stripos($xml, '<!DOCTYPE') !== false) {
            throw new InvalidCertificate('A document type declaration is not allowed in an IVI data set.');
        }

        $previous = libxml_use_internal_errors(true);
        $document = new DOMDocument();
        $loaded = $document->loadXML($xml, LIBXML_NONET);
        $error = libxml_get_last_error();
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        if (! $loaded) {
            throw new InvalidCertificate('The document is not well-formed XML: ' . trim($error === false ? 'unknown error' : $error->message));
        }

        $element = $document->documentElement;
        if ($document->doctype !== null) {
            throw new InvalidCertificate('A document type declaration is not allowed in an IVI data set.');
        }
        if ($element === null || $element->localName !== 'InitialVehicleInformation') {
            throw new InvalidCertificate('The document is no IVI data set: its root element is not InitialVehicleInformation.');
        }

        if ($document->getElementsByTagName('*')->length > self::MAX_ELEMENTS) {
            throw new InvalidCertificate('The document holds far more elements than any IVI data set.');
        }

        $signed = false;
        $certificate = new self(self::node($element, $signed), $signed);
        if ($certificate->value('VehicleIdentificationNumber') === null) {
            throw new InvalidCertificate('The data set names no vehicle identification number.');
        }

        return $certificate;
    }

    public function vin(): string
    {
        return (string) $this->value('VehicleIdentificationNumber');
    }

    /**
     * The version of the format the data set is written in, as it states it: "1.9", "2.0".
     */
    public function formatVersion(): ?string
    {
        return $this->value('VersionNumberXsd', 'IviVersionNumberXsd');
    }

    public function make(): ?string
    {
        return $this->value('Make');
    }

    public function commercialName(): ?string
    {
        return $this->value('CommercialName');
    }

    public function dateOfManufacture(): ?string
    {
        return $this->value('DateOfManufactureVeh', 'DateManufactureVehicle');
    }

    /**
     * Whether the data set carries an electronic signature. The signature is not checked.
     */
    public function isSigned(): bool
    {
        return $this->signed;
    }

    /**
     * The value of the first element with one of the names (the names of the message book, without a prefix): the
     * nearest to the root wins. IVI 1.x and IVI 2.0 name many fields differently, so give both names.
     */
    public function value(string ...$elements): ?string
    {
        return $this->root->first(...$elements)?->value;
    }

    /**
     * The values of every element with one of the names.
     *
     * @return list<string>
     */
    public function values(string ...$elements): array
    {
        $values = [];
        foreach ($this->root->find(...$elements) as $node) {
            if ($node->isLeaf() && $node->value !== '') {
                $values[] = $node->value;
            }
        }

        return $values;
    }

    /**
     * @internal
     */
    public function root(): Node
    {
        return $this->root;
    }

    private static function node(DOMElement $element, bool &$signed): Node
    {
        $children = [];
        $leaf = true;
        foreach ($element->childNodes as $child) {
            if (! $child instanceof DOMElement) {
                continue;
            }
            $leaf = false;
            if ($child->localName === 'Signature' && $child->namespaceURI === self::SIGNATURE_NAMESPACE) {
                $signed = true;

                continue;
            }
            $children[] = self::node($child, $signed);
        }

        return new Node((string) $element->localName, $leaf ? trim($element->textContent) : '', $children);
    }
}
