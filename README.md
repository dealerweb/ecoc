# dealerweb/ecoc

[![CI](https://github.com/dealerweb/ecoc/actions/workflows/package.yml/badge.svg)](https://github.com/dealerweb/ecoc/actions/workflows/package.yml)
[![Latest version](https://img.shields.io/packagist/v/dealerweb/ecoc)](https://packagist.org/packages/dealerweb/ecoc)
[![PHP version](https://img.shields.io/packagist/dependency-v/dealerweb/ecoc/php)](https://packagist.org/packages/dealerweb/ecoc)
[![License](https://img.shields.io/packagist/l/dealerweb/ecoc)](https://github.com/dealerweb/ecoc/blob/main/LICENSE)

**eCoC viewer in pure PHP** - makes the electronic certificate of conformity (eCoC) of a vehicle readable: from the IVI
data set, an XML file, to a CoC paper as PDF, A5 booklet or HTML page, in German, English or French.

In 2026 the electronic certificate of conformity becomes mandatory for newly manufactured vehicles in the EU, and
authorities such as the German KBA hand out the data set: an XML file in the format IVI (Initial Vehicle
Information), often named like `Ivi1xDatensatz_1.xml`, hundreds of fields and codes that nobody can read. This package
reads it - IVI 1.x and IVI 2.0 - and shows it with the numbers and the wording of the certificate, the codes explained,
nothing left out. Pure PHP (8.2+), no network access.

Known as CoC paper or certificate of conformity, in German as CoC-Papier or (elektronische)
Übereinstimmungsbescheinigung, in French as certificat de conformité.

![Two pages of a readable eCoC: vehicle and type approval, environmental performances with the WLTP values](https://github.com/dealerweb/ecoc/releases/download/v1.0.0/ecoc-preview.png)

Only the XML is the data set. Anything rendered from it is a reading aid and no certificate of conformity, every page says
so. It is not meant to be presented to registration authorities.

## Online demo

[www.dealerweb.de/ecoc](https://www.dealerweb.de/ecoc) shows the XML file of a vehicle with this library as a readable page
and as PDF, in German, English or French. The file is only read, not stored. In Germany the XML file of a vehicle comes
from the [public eCoC retrieval of the KBA](https://www.kba-online.de/ivicoc_prod/public-access/webapp/#/).

## Installation

```
composer require dealerweb/ecoc
```

PHP 8.2 or later with ext-dom, ext-libxml, ext-mbstring and ext-zlib. Composer installs dompdf for the PDF output (its CSS
parser needs ext-iconv) and FPDI for the booklet.

## Usage

```php
use Dealerweb\ECoc\Certificate;
use Dealerweb\ECoc\Render\HtmlRenderer;
use Dealerweb\ECoc\Render\PdfRenderer;

$certificate = Certificate::fromFile('vehicle.xml');   // or Certificate::fromXml($xml)

$pdf = (new PdfRenderer('de'))->render($certificate);          // a PDF on A4 pages - de, en or fr
$pdf = (new PdfRenderer('de'))->renderBooklet($certificate);   // an A5 booklet on A4 sheets, to print and fold
$html = (new HtmlRenderer('de'))->render($certificate);        // one self-contained HTML page
```

Runnable scripts for every task, with example data sets, are in [`examples/`](examples/).

### Reading a data set

```php
use Dealerweb\ECoc\CodeLists;

$certificate->vin();                 // "XXXTESTVN00000001"
$certificate->make();                // "Musterwagen"
$certificate->commercialName();      // "TESTMODELL"
$certificate->formatVersion();       // "1.9", "2.0": the version of the format, as the data set states it
$certificate->dateOfManufacture();   // "2026-03-09"
$certificate->isSigned();            // whether it carries an electronic signature - the signature is not checked

// Any other field by its name in the message book - IVI 1.x and IVI 2.0 name many fields differently, so give both:
$certificate->value('WLTPCombinedCO2', 'WltpCo2Combined');   // "128", null when it has no such field
$certificate->values('FuelCode', 'EnergySource');            // ["10"]: every occurrence

CodeLists::label('FuelCode', '10', 'de');   // "Benzin": what a code means, in de, en or fr - null when it is unknown,
                                            // an InvalidArgumentException for any other language
CodeLists::field('Wheelbase');              // ["title" => "Wheelbase", "unit" => "mm"], for a field of another unit in
                                            // the other format with the version: CodeLists::field($name, $certificate->formatVersion())
```

Values are the text of the data set, as delivered. A document that cannot be read as a data set throws
`Dealerweb\ECoc\Exception\InvalidCertificate`: a file that cannot be read, an empty document, XML that is not well-formed,
another root element than `InitialVehicleInformation`, no vehicle identification number, a DOCTYPE, a document far larger
than any data set.

### Showing a data set

The renderers throw an `InvalidArgumentException` for a language other than `de`, `en` or `fr`.

- **The certificate's order:** vehicle, type approval and data set, then the technical data of the vehicle, with the
  numbers and the wording of the certificate of conformity (Annex VIII of Regulation (EU) 2020/683), in the official
  German, English and French text.
- **Every field exactly once:** what the document has no row for - a rare field, a field of a newer version of the format -
  appears under "Further data of the data set" with its value and a title, for most of them in English. Nothing is left
  out.
- **Codes explained:** fuels, bodywork, gearboxes, stages of completion and the other code lists in the three languages.
  A code nothing knows stays as delivered.
- **Numbers as delivered:** only the decimal separator follows the language, the certificate states its values exactly.
  A date has the form of the language; a time delivered with a time zone is shown in local time in German and French,
  and in UTC in English.
- **Several engines and fuels:** the rows of each engine, with a heading where there is more than one. The electric part
  of a plug-in hybrid, which IVI 1.x delivers as a fuel without a code, stands with the fuel before it, in the order of
  the numbers. The environmental performance is that of the vehicle, as in the certificate: what the fuels give stands
  together, every value once and the WLTP values in one table, also where a manufacturer repeats them for every electric
  motor. Only fuels with different values for the same point, like petrol and gas, stand one by one under their headings.
- **WLTP and NEDC as tables:** the columns (low, medium, high, extra high, combined, weighted) and rows (charge sustaining,
  charge depleting) the vehicle has values for.
- **Only what the data set delivers:** no value is ever computed or filled in. Where the model of the certificate provides
  for a value for this powertrain and the data set of a car or van with WLTP values lacks it, an orange hyphen stands
  in its place at point 49.
- **Road vehicles first:** the numbers are those of the certificate of road vehicles. The documents of two-wheelers and
  tractors, whose certificates have other numbers, show the same rows without numbers, and more of their fields stand under
  "Further data of the data set".
- **No certificate:** every document says so, at its beginning ("not an original") and at the foot of every page ("not a
  certificate of conformity", the HTML page at its end). It carries no imitation of a signature: the signatory is shown as
  data, an electronic signature as "contained in the data set, not verified".

### Printing the booklet

`renderBooklet()` sets the certificate on A5 pages and places two of them on each side of an A4 sheet in landscape:
page 4 and 1 on the front, page 2 and 3 on the back.

Print it on both sides, flipped on the **short edge**, at actual size (100 %), and fold the sheet once. The PDF tells the
printing dialog about both sides and the short edge, but not every dialog listens. A data set of a passenger car fits on
one sheet; a longer one takes more sheets, which are laid into each other.

## Not included

- **No retrieval:** the package reads a data set you have. It does not fetch one from an authority.
- **No check of a data set:** neither of its electronic signature nor against the schema of IVI. Any document with the
  root element of IVI and a vehicle identification number is read and shown as delivered.

## How it works

- **Reading:** DOM with every network access switched off; a document with a DOCTYPE is refused, in whatever encoding it
  declares. Fields are found by their local names, so IVI 1.x without a namespace and IVI 2.0 with one are read alike.
- **The document** is a layout - which field stands where, with its names in both formats - that a builder fills from the
  data set, marking each field it takes. What is left over becomes "further data": a new field can land in the wrong place,
  but it cannot get lost.
- **The field catalogues** come from the IVI message book (version 1.11) and, for IVI 2.0, from its schema of 2026-09-28 and its
  message book (version 3.1), the labels from the regulations of the EU: see `NOTICE` and `resources/messagebook/SOURCE.md`. The
  examples of the official eCoC portal are valid against that schema and come out whole.
- **The PDF** is made by dompdf with remote files, PHP and JavaScript switched off, in the font DejaVu Sans that comes
  with it; the sheets of the booklet by FPDI, which places the finished A5 pages as vector graphics.

## Versioning

The package follows [Semantic Versioning](https://semver.org/). Classes and methods marked `@internal` are not part of the
public API. Changes are listed in `CHANGELOG.md`.

## Security

Please report vulnerabilities privately, see `SECURITY.md`.

## License

MIT (see `LICENSE`) - free to use, provided as is, without any warranty or liability.

The fields and codes of IVI come from the message book of EReg, the labels of the numbered items from Regulation (EU)
2020/683 and Regulation (EU) 2018/858 - see `NOTICE`. The PDF output uses dompdf (LGPL-2.1) and FPDI with FPDF (MIT);
Composer installs them as separate packages, they are not part of this package.
