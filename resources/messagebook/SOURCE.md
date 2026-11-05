# Sources of the resources

## The fields of the data set: the IVI message book

`resources/compiled/fields.php` is compiled from the text of the IVI message book: names, units and code values of the
fields of IVI 1.x. The titles of the rare fields in `resources/translations/fields-en.php` are the package's own.

- IVI message book, version 1.11 of 2025-04-02, and its XML schema, published by Topic Group XII of EReg (Association of
  European Vehicle and Driver Registration Authorities), https://www.ereg-association.eu/topic-groups/topic-group-xii/
  - https://www.ereg-association.eu/media/3115/version-111-ivi-messagebook.pdf
  - https://www.ereg-association.eu/media/3114/version-111-initialvehicleinformation-xsd-scheme.xsd

`resources/compiled/fields-2.php` is compiled from the schema and the message book of IVI 2.0: names, units and the texts of
the codes. The rows of the document name these fields as well (`resources/layout/certificate.php`).

- On the portal of EUCARIS for the eCoC, https://ecoc.eucaris.net/documentation: XML schema of IVI 2.0 of 2026-09-28, message
  book in Excel format, version 3.1, overview of the transition from IVI 1.x to 2.0, version 2.6

## The labels: the regulations of the European Union

- Numbered items (`resources/translations/items-*.php`): Annex VIII of Commission Implementing Regulation (EU) 2020/683, in
  the consolidated version of 2024-01-01:
  https://eur-lex.europa.eu/legal-content/DE/TXT/HTML/?uri=CELEX:02020R0683-20240101 (`EN`, `FR` in place of `DE`), and item 48.3
  from Commission Implementing Regulation (EU) 2025/1706: https://eur-lex.europa.eu/eli/reg_impl/2025/1706/oj
- Types of bodywork and special purposes (`resources/translations/codes-*.php`): Annex I of Regulation (EU) 2018/858, in the
  consolidated version of 2026-08-02:
  https://eur-lex.europa.eu/legal-content/DE/TXT/HTML/?uri=CELEX:02018R0858-20260802

The tables of point 49 of Annex VIII (the phases of the WLTP, charge sustaining and charge depleting, the electric ranges)
are images in the Official Journal. Their words in `resources/translations/render-*.php` are read from these images; the
rows of the document join them with a unit. What the tables provide for which powertrain is `expected` in
`resources/layout/certificate.php`.
