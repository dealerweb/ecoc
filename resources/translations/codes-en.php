<?php

declare(strict_types=1);

/*
 * What the codes of the data set mean, by the name of the list. English comes first from here and otherwise from the
 * message books (resources/compiled): this file corrects their texts where they read badly. The bodywork codes are those
 * of Regulation (EU) 2018/858, Annex I, Part C.
 */

return [
    'indicator' => ['Y' => 'Yes', 'N' => 'No'],

    'StageOfCompletionCode' => ['C' => 'Complete', 'I' => 'Incomplete', 'V' => 'Completed'],

    'TypeApprovalTypeCode' => [
        'NAT' => 'National type approval',
        'NKS' => 'National small series type approval',
        'KS' => 'European small series type approval',
        'EC' => 'EU type approval',
        'IND' => 'Individual approval',
        'NSS' => 'National small series type approval',
        'ESS' => 'European small series type approval',
        'EU' => 'EU type approval',
    ],

    'RightLeftHandTrafficCode' => [
        'L' => 'left-hand traffic',
        'R' => 'right-hand traffic',
        'B' => 'left-hand and right-hand traffic',
        'LEFT' => 'left-hand traffic',
        'RIGHT' => 'right-hand traffic',
        'BOTH' => 'left-hand and right-hand traffic',
    ],

    'MetricImperialSpeedometerCode' => ['I' => 'imperial', 'M' => 'metric', 'B' => 'metric and imperial'],

    'OdometerUnitCode' => ['K' => 'kilometres', 'M' => 'miles', 'B' => 'kilometres and miles'],

    'MethodOfAttachmStatPlatesCode' => ['A1' => 'glued or bonded', 'A2' => 'screwed', 'A3' => 'riveted', 'A4' => 'bolted'],

    'LocationOfTheVinCode' => [
        'C9' => 'Right side cross member',
        'D0' => 'Right side windscreen base/cowl louvre',
        'D4' => 'Right cross member, in front of coupling point',
        'D6' => 'Right cross member, behind coupling point',
        'D7' => 'Right cross member, in front of axle group',
        'E3' => 'Right side member, in front of coupling point',
        'E5' => 'Right side member, behind coupling point',
        'E6' => 'Right side member, in front of axle group',
        'E9' => 'Right side member, in front of front axle',
        'F3' => 'Right side member, in front of rear axle',
        'F6' => 'Front at water gutter',
    ],

    'LocationMarkingsVehiclePart' => [
        'ENGCT' => 'Engine compartment',
        'PASCT' => 'Passenger compartment',
        'LUGCT' => 'Luggage compartment',
        'INSPL' => 'Instrument panel',
        'DRAWB' => 'Drawbar',
        'CHASS' => 'Chassis',
        'APILR' => 'A-pillar',
        'BPILR' => 'B-pillar',
        'CPILR' => 'C-pillar',
        'DPILR' => 'D-pillar',
    ],
    'LocationMarkingsVehiclePartSide' => ['FRONTSIDE' => 'front side', 'LEFTSIDE' => 'left side', 'RIGHTSIDE' => 'right side', 'BACKSIDE' => 'back side'],
    'LocationMarkingsVehiclePartSideSection' => ['LEFT' => 'left', 'MIDDLE' => 'middle', 'RIGHT' => 'right', 'FRONT' => 'front', 'BACK' => 'back'],

    'WorkingPrincipleCode' => [
        'CMPRA' => 'compressed air',
        'EXTCI' => 'external combustion engine, compression ignition',
        'EXTPI' => 'external combustion engine, positive ignition',
        'INTCI' => 'internal combustion engine, compression ignition',
        'INTPI' => 'internal combustion engine, positive ignition',
        'TRBNE' => 'turbine',
        'ELECT' => 'electric motor',
    ],

    'ClassOfHybridVehicleCode' => [
        'OVC-HEV' => 'OVC-HEV (off-vehicle charging hybrid electric vehicle)',
        'NOVC-HEV' => 'NOVC-HEV (not off-vehicle charging hybrid electric vehicle)',
        'OVC-FCHV' => 'OVC-FCHV (off-vehicle charging fuel cell hybrid vehicle)',
        'NOVC-FCHV' => 'NOVC-FCHV (not off-vehicle charging fuel cell hybrid vehicle)',
    ],
    'CategoryHybridElectricVehicle' => ['OVC' => 'Off-vehicle charging', 'NOVC' => 'Not off-vehicle charging'],

    'FuelCode' => [
        '23' => 'GTL (Gas to liquid = Diesel)',
        '26' => 'HVO (Hydrotreated vegetable oil = Diesel)',
        '95' => 'Electricity',
    ],
    'FuelTypeCode' => ['B' => 'Bi fuel', 'D' => 'Dual-fuel', 'F' => 'Flex fuel', 'M' => 'Mono fuel', 'T' => 'Tri fuel'],

    'GearboxTypeCode' => ['D' => 'Double clutch', 'G' => 'Automated', 'S' => 'Semi-automatic'],

    'AutomatedVehCode' => [
        'NON' => 'non-automated',
        'AUT' => 'automated',
        'FUL' => 'fully automated',
        'NONAT' => 'non-automated',
        'AUTOM' => 'automated',
        'FULAT' => 'fully automated',
    ],
    'AerodynamicVehCode' => [
        'F' => 'On the front',
        'R' => 'On the rear',
        'B' => 'On the front and rear',
        'N' => 'Not equipped',
        'FRONT' => 'On the front',
        'REAR' => 'On the rear',
        'BOTH' => 'On the front and rear',
        'NONE' => 'Not equipped',
    ],

    'AdvancedSafetySystemCode' => [
        'AEBS' => 'Advanced emergency braking system',
        'ELKS' => 'Emergency lane keeping system',
        'ISA' => 'Intelligent speed assistance',
        'DDAW' => 'Driver drowsiness and attention warning',
        'EDR' => 'Event data recorder',
        'AIF' => 'Alcohol interlock installation facilitation',
        'ESS' => 'Emergency stop signal',
        'TPMS' => 'Tyre pressure monitoring system',
        'ADDW' => 'Advanced driver distraction warning',
        'DAM' => 'Driver availability monitoring system',
        'ADS' => 'Automated driving system',
        'eCall' => 'Emergency call',
        'BSIS' => 'Blind spot information system',
        'Platooning' => 'Electronic drawbar',
        'CDCF' => 'Corrective directional control function',
        'LDWS' => 'Lane departure warning system',
    ],

    'TrailerBrakeConnectionsCode' => [
        'ELECT' => 'Electric',
        'HYDRL' => 'Hydraulic',
        'PNEU' => 'Pneumatic',
        'COMPE' => 'Combination pneumatic/electric (EBS)',
        'MECHA' => 'Mechanical',
        'INERT' => 'Inertia',
        'NONE' => 'None',
        '1LINE' => 'Single line',
        '2LINE' => 'Two line',
    ],

    'ElectricVehicleConfigurCode' => ['PUREE' => 'Pure electric', 'HYBRE' => 'Hybrid electric', 'MNPWE' => 'Manpower - electric'],

    'CodeForBodywork' => [
        'AA' => 'Saloon',
        'AB' => 'Hatchback',
        'AC' => 'Station wagon',
        'AD' => 'Coupé',
        'AE' => 'Convertible',
        'AF' => 'Multi-purpose vehicle',
        'AG' => 'Truck station wagon',
        'BA' => 'Lorry',
        'BB' => 'Van',
        'BC' => 'Tractor unit for semi-trailer',
        'BD' => 'Road tractor',
        'BE' => 'Pick-up truck',
        'BX' => 'Chassis-cab or chassis-cowl',
        'CA' => 'Single-deck vehicle',
        'CB' => 'Double-deck vehicle',
        'CC' => 'Single-deck articulated vehicle',
        'CD' => 'Double-deck articulated vehicle',
        'CE' => 'Low-floor single-deck vehicle',
        'CF' => 'Low-floor double-deck vehicle',
        'CG' => 'Articulated low-floor single-deck vehicle',
        'CH' => 'Articulated low-floor double-deck vehicle',
        'CI' => 'Open top single-deck vehicle',
        'CJ' => 'Open top double-deck vehicle',
        'CX' => 'Bus chassis',
        'DA' => 'Semi-trailer',
        'DB' => 'Drawbar trailer',
        'DC' => 'Centre-axle trailer',
        'DE' => 'Rigid drawbar trailer',
        'DF' => 'Link semi-trailer',
        'DG' => 'Link drawbar trailer',
    ],

    'NEDCVerificationFactor' => ['0' => 'Conform', '1' => 'Not conform'],

    'CompletedAlteredCode' => ['A' => 'Altered', 'C' => 'Completed', 'B' => 'Completed and altered'],

    'InterconnectionWithPoweredAxleConnectionCode' => ['TRANS' => 'transfer box', 'ELECT' => 'electronic', 'SHAFT' => 'shaft'],

    'TyreTubeTypeCode' => ['TL' => 'tubeless', 'TT' => 'tube type', 'TUBLS' => 'tubeless', 'TUBTP' => 'tube type'],

    'TyreTypeCode' => ['C' => 'Light commercial vehicle tyre (C)', 'LT' => 'Light commercial vehicle tyre (LT)', 'XL' => 'Extra load', 'FRT' => 'Free rolling tyre', 'HL' => 'High load capacity', 'MOPED' => 'Moped tyre'],

    'ViennaCountryCode' => [
        'EAK' => 'Kenya',
        'EAT' => 'Tanzania',
        'FO' => 'Faroe Islands',
        'GCA' => 'Guatemala',
        'IR' => 'Iran',
        'LAO' => 'Laos',
        'MD' => 'Moldova',
        'PS' => 'Palestine',
        'RH' => 'Haiti',
        'RP' => 'Philippines',
        'RUS' => 'Russia',
        'SD' => 'Eswatini',
        'SME' => 'Suriname',
        'SYR' => 'Syria',
        'WV' => 'Saint Vincent and the Grenadines',
    ],
];
