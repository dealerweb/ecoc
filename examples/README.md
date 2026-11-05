# Examples

Runnable scripts for every task, each a few lines:

```
php examples/read-a-data-set.php     # the key facts of a data set, and any other field by its name
php examples/pdf-on-a4-pages.php     # a PDF on A4 pages, in German, English and French
php examples/pdf-as-a-booklet.php    # an A5 booklet on A4 sheets, to print on both sides and fold once
php examples/html-page.php           # an HTML page
```

Every script takes the path of a data set as its argument, and otherwise reads one of the data sets in
[input](input). They write to `examples/output`.

The vehicles in `input` are fictional: the structure and the technical values of the two IVI 1.9 data sets follow real
ones, everything that identifies a vehicle or a person is made up, and they validate against the schema of IVI 1.11.
The IVI 2.0 data set is written from the published
schema of 2026-09-28 and validates against it, only its signature is a placeholder.
