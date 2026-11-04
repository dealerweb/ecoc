# Sources of the resources

## The fields of the data set: the IVI message book

`resources/compiled/fields.php` is compiled from the text of the IVI message book: names, units and code values of the
fields of IVI 1.x. The titles of the rare fields in `resources/translations/fields-en.php` are the package's own.

- IVI message book, version 1.11 of 2025-04-02, and its XML schema, published by Topic Group XII of EReg (Association of
  European Vehicle and Driver Registration Authorities), https://www.ereg-association.eu/topic-groups/topic-group-xii/
  - https://www.ereg-association.eu/media/3115/version-111-ivi-messagebook.pdf
  - https://www.ereg-association.eu/media/3114/version-111-initialvehicleinformation-xsd-scheme.xsd

The rows of the document name the fields of IVI 2.0 as well (`resources/layout/certificate.php`). The format is published
as a draft:

- XML schema of IVI 2.0, draft of 2025-02-27:
  https://www.ereg-association.eu/media/3101/version-20-draft-initial-vehicle-information-xsd-scheme.xsd
- Readme: https://www.ereg-association.eu/media/3127/ivi-20-readme-v11.pdf
- Guidelines: https://www.ereg-association.eu/media/3130/ivi-20-guidelines-initial-vehicle-information-v11.pdf
- Overview of the changes: https://www.ereg-association.eu/media/3129/ivi-20-change-overview-v11.pdf

## The labels: the regulations of the European Union

- Numbered items (`resources/translations/items-*.php`): Annex VIII of Commission Implementing Regulation (EU) 2020/683, in
  the consolidated version of 2024-01-01:
  https://eur-lex.europa.eu/legal-content/DE/TXT/HTML/?uri=CELEX:02020R0683-20240101 (`EN`, `FR` in place of `DE`)
- Types of bodywork (`resources/translations/codes-*.php`): Annex I, Part C, of Regulation (EU) 2018/858:
  https://eur-lex.europa.eu/legal-content/DE/TXT/HTML/?uri=CELEX:32018R0858

The tables of point 49 of Annex VIII (the phases of the WLTP, charge sustaining and charge depleting, the electric ranges)
are images in the Official Journal. Their words in `resources/translations/render-*.php` are read from these images; the
rows of the document join them with a unit. What the tables provide for which powertrain is `expected` in
`resources/layout/certificate.php`.
