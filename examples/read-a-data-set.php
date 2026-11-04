<?php

declare(strict_types=1);

// The key facts of a data set, and any other field by its name.
//
//     php examples/read-a-data-set.php [file]

use Dealerweb\ECoc\Certificate;

require __DIR__ . '/bootstrap.php';

$certificate = Certificate::fromFile(dataSet('plug-in-hybrid-ivi-1.9.xml'));

printf("Vehicle:   %s %s\n", $certificate->make(), $certificate->commercialName());
printf("VIN:       %s\n", $certificate->vin());
printf("Format:    IVI %s\n", $certificate->formatVersion());
printf("Built on:  %s\n", $certificate->dateOfManufacture());
printf("Signature: %s\n", $certificate->isSigned() ? 'in the data set, not checked' : 'none');

// IVI 1.x and IVI 2.0 name many fields differently: give both names.
printf("CO2:       %s g/km\n", $certificate->value('WLTPWeightedCombinedCO2', 'WltpCo2WeightedCombined'));
printf("Fuel:      %s\n", implode(', ', $certificate->values('FuelCode', 'EnergySource')));
