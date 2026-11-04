# Changelog

All notable changes to this package are documented in this file. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), the versions follow
[Semantic Versioning](https://semver.org/spec/v2.0.0.html). Classes and methods marked `@internal` are not
part of the public API and may change in any release.

## [Unreleased]

## [1.0.0] - 2026-11-05

First public release.

### Added

- Reading of IVI data sets, the electronic certificates of conformity (eCoC), in the formats IVI 1.x (message book 1.11)
  and IVI 2.0 (the draft of the schema of 2025-02-27): `Certificate::fromFile()`, `fromXml()`, the key facts of a vehicle
  and any field by its name (`value()`, `values()`). Without network access, a document with a DOCTYPE or far larger than any data
  set is refused (`InvalidCertificate`).
- `PdfRenderer::render()`: a readable PDF on A4 pages in German, English and French, with the numbers and the official
  wording of the certificate of conformity (Annex VIII of Regulation (EU) 2020/683). Every field of a data set is shown
  once, what the document has no row for under "Further data of the data set"; every page says that it is a reading
  copy and no certificate.
- Point 49 follows the model of the certificate: where it provides a value for the powertrain of a car or van and the data
  set lacks it, an orange hyphen stands in its place; no value is filled in.
- `PdfRenderer::renderBooklet()`: the same on A5 pages, two on each side of an A4 sheet in landscape, to print on both
  sides and fold once.
- `HtmlRenderer::render()`: one self-contained HTML page, on a phone with the label above the value.
- `CodeLists`: what the codes of a data set mean, in German, English and French, and the title and the unit of a field.
- Runnable examples with fictional data sets (`examples/`).

[Unreleased]: https://github.com/dealerweb/ecoc/compare/v1.0.0...main
[1.0.0]: https://github.com/dealerweb/ecoc/releases/tag/v1.0.0
