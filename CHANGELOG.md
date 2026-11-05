# Changelog

All notable changes to this package are documented in this file. The format follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/), the versions follow
[Semantic Versioning](https://semver.org/spec/v2.0.0.html). Classes and methods marked `@internal` are not
part of the public API and may change in any release.

## [Unreleased]

## [1.1.0] - 2026-11-05

### Changed

- IVI 2.0 follows its final schema of 2026-09-28 and its message book (version 3.1) from the eCoC portal of EUCARIS, no longer the
  draft of 2025-02-27: the names that changed, the namespace on every element. The nine examples of the portal are valid against
  the schema and come out whole; nothing of a road vehicle stands under "Further data of the data set" any more.
- Point 48.3 of the certificate (Implementing Regulation (EU) 2025/1706) and point 49.6 for the average occupancy, as the regulation has
  it, instead of 49.6.1.
- `CodeLists::field()` also knows the fields of IVI 2.0 and takes the version of the format as a second argument: a few fields have
  another unit there.

### Added

- Rows for what IVI 2.0 has beyond 1.x: ranges at points 4.1, 7.1, 8, 16.2 and 30, the coupling point at 4.1, 13.1 and 15.1, the
  mass of the combination at 16.4 without a trailer, country and regulation at 17.1 to 17.3, the parts of the coupling and the devices that
  can be fitted at 44 to 45.1, how powered axles are connected at 3, tube type, ply rating, several types and speeds above 300 km/h of a
  tyre at 35, the territory of a provisional approval, the derogation from the dimensions at 52.
- German and French texts for the special purposes, the tyre types, the eco-innovations, the classes of dangerous goods, the countries and
  the bodywork codes `DF` and `DG`.

### Fixed

- The values of the test Type I of IVI 2.0 are in mg/km, the characteristic U of a coupling in t, the emissions of the tests WHSC and WHTC of
  a tractor in g/kWh; the document wrote g/km, kg and mg/kWh.
- `FinalDriveRatio` stands at point 28.1.2, not at 28.1.1.
- The documents of two-wheelers and tractors no longer show the numbers of the certificate of road vehicles: their certificates have others.
- A vehicle without a combustion engine, as with a fuel cell, is not marked for lacking CO2 values; M2 and N2 are marked for lacking
  WLTP values like M1 and N1, as the official rules ask them of these categories.
- Masses of towing at 18 stand in the order of their numbers.
- What a data set has several of stands in its row, each with what belongs to it: several countries on an axle or axle group at 17.2 and
  17.3 (then every axle has its own line), several bodyworks and supplements at 38 and 51, several couplings at 4.1, 8 to 10, 18 and 19, several brake connections at 36 and
  37. All but the first stood under "Further data of the data set", without saying what they belonged to.
- The mass of the combination at 17.4 names its country and regulation.
- A line no longer starts with a separator when the optional part in front of its first value is missing, as at 4.1, 16.2, 30, 44 and 45.
- A remark of a two-wheeler or a tractor no longer explains its number with the text of the certificate of road vehicles.
- The pressure at 37, the offset of a rim at 35 and the decimal numbers under further data are written in the form of the language.
- Fields of IVI 1.x with a number of the certificate stand in their row and no longer under further data: the ranges at 4.1, the distances
  of the coupling point, its masses at 13.1 to 15.1, how powered axles are connected, the countries and regulations at 17.1 to 17.4, the
  member state of a national mass, the trailer mass at 45.1, indivisible loads at 52, the tests ESC, ETC and ELR.

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

[Unreleased]: https://github.com/dealerweb/ecoc/compare/v1.1.0...main
[1.1.0]: https://github.com/dealerweb/ecoc/releases/tag/v1.1.0
[1.0.0]: https://github.com/dealerweb/ecoc/releases/tag/v1.0.0
