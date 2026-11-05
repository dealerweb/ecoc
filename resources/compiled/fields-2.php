<?php

// Field catalogue of IVI 2, from its schema and its message book. Generated - do not edit.

return [
  'fields' => [
    'ActualMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AdditionalCouplingPoints' => [
      'format' => 'OptionalCode',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
        'O' => 'Optional',
      ],
    ],
    'AdditionalEnergySource' => [
      'format' => 'EnergySourceCode',
      'unit' => '',
      'values' => [
        10 => 'Petrol',
        11 => 'Petrol E5',
        12 => 'Petrol E10',
        15 => 'Ethanol',
        16 => 'Ethanol E85',
        19 => 'Mixture',
        20 => 'Diesel',
        21 => 'Biodiesel',
        22 => 'ED95',
        30 => 'LPG',
        40 => 'CNG',
        44 => 'Biomethane',
        50 => 'Hydrogen',
        55 => 'H2NG',
        60 => 'LNG',
        90 => 'Other',
        91 => 'Compressed air',
        95 => 'Electricity',
      ],
    ],
    'AdditionalMassAlternativePropulsion' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AdditionalMassDueToBatteries' => [
      'format' => 'Integer4',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AdvancedBrakingSystem' => [
      'format' => 'AdvancedBrakingSystemCode',
      'unit' => '',
      'values' => [
        'ABS' => 'Anti-lock braking system',
        'ACB' => 'Combined ABS/CBS braking system',
        'CBS' => 'Combined braking system',
        'NON' => 'No advanced braking system',
      ],
    ],
    'AdvancedSafetySystem' => [
      'format' => 'AdvancedSafetySystemCode',
      'unit' => '',
      'values' => [
        'AEBS' => 'Advanced Emergency Braking System',
        'ELKS' => 'Emergency Lane Keeping System',
        'ISA' => 'Intelligent Speed Assistance',
        'DDAW' => 'Driver Drowsiness & Attention Monitoring',
        'EDR' => 'Event Data Recorder',
        'AIF' => 'Alcohol Interlock install Facilitation',
        'ESS' => 'Emergency Stop Signal',
        'TPMS' => 'Tyre Pressure Monitoring System',
        'ADDW' => 'Advanced Driver Distraction Warning',
        'DAM' => 'Driver Availability Monitoring system',
        'ADS' => 'Automated Driving System',
        'eCall' => 'Emergency Call',
        'BSIS' => 'Blind Spot Information System',
        'Platooning' => 'Electronic Drawbar',
        'CDCF' => 'Corrective Directional Control Function',
        'LDWS' => 'Lane Departure Warning System',
      ],
    ],
    'AerodynamicDeviceEquipped' => [
      'format' => 'AerodynamicDeviceEquippedCode',
      'unit' => '',
      'values' => [
        'BOTH' => 'Both',
        'FRONT' => 'Front',
        'NONE' => 'Not Equipped',
        'REAR' => 'Rear',
      ],
    ],
    'AerosolIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'AllowedActualMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AllowedActualMassMax' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AllowedActualMassMin' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AllowedCrossSectionalAreaAirFrontGrill' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedCrossSectionalAreaAirFrontGrillMax' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedCrossSectionalAreaAirFrontGrillMin' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedFrontalArea' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedFrontalAreaMax' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedFrontalAreaMin' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'AllowedRollingResistance' => [
      'format' => 'Decimal63',
      'unit' => 'kg/t',
      'values' => [
      ],
    ],
    'AllowedRollingResistanceMax' => [
      'format' => 'Decimal63',
      'unit' => 'kg/t',
      'values' => [
      ],
    ],
    'AllowedRollingResistanceMin' => [
      'format' => 'Decimal63',
      'unit' => 'kg/t',
      'values' => [
      ],
    ],
    'AllowedTechnicallyPermissibleMaximumLadenMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AllowedTechnicallyPermissibleMaximumLadenMassMax' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'AllowedTechnicallyPermissibleMaximumLadenMassMin' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'ArrangementCylinders' => [
      'format' => 'ArrangementCylindersCode',
      'unit' => '',
      'values' => [
        'LI' => 'In line',
        'O' => 'Opposed',
        'R' => 'Radial',
        'S' => 'Single cylinder',
        'V' => 'V-engine',
        'W' => 'W-engine',
      ],
    ],
    'AutomatedVehicle' => [
      'format' => 'AutomatedVehicleCode',
      'unit' => '',
      'values' => [
        'AUTOM' => 'Automated',
        'FULAT' => 'Fully automated',
        'NONAT' => 'Non-automated',
      ],
    ],
    'AverageOccupancy' => [
      'format' => 'Decimal52',
      'unit' => '',
      'values' => [
      ],
    ],
    'AveragePayload' => [
      'format' => 'Decimal95',
      'unit' => 't',
      'values' => [
      ],
    ],
    'AxleAirSuspensionOrEquivalentIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'AxleGroupNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'AxleNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'AxleNumberCombination' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'AxleSpacing' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'AxleSpacingAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'AxleSpacingAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'AxleTrack' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'AxleTrackAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'AxleTrackAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'BallastMassTotal' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'BallastSetNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'BallastSetNumberOfComponents' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'BodyworkTypeTrailer' => [
      'format' => 'BodyworkTypeTrailerCode',
      'unit' => '',
      'values' => [
        'DA' => 'Semi-trailer',
        'DB' => 'Drawbar',
        'DC' => 'Centre-axle',
        'DE' => 'Rigid drawbar',
      ],
    ],
    'BrakedAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'BrakedTypeTrail' => [
      'format' => 'BrakedTypeTrailCode',
      'unit' => '',
      'values' => [
        'BRK' => 'Braked',
        'HDB' => 'Hydraulic braked',
        'INB' => 'Inertia braked',
        'PNB' => 'Pneumatic braked',
        'PNH' => 'Hydraulic pneumatic braked',
        'UNB' => 'Unbraked',
      ],
    ],
    'BrakingTransmissionPowerAssist' => [
      'format' => 'BrakingTransmissionPowerAssistCode',
      'unit' => '',
      'values' => [
        'WPT' => 'Without power assistance',
        'PAT' => 'Power-assisted',
        'FPT' => 'Fully powered transmission',
      ],
    ],
    'BrakingTransmissionPrincipal' => [
      'format' => 'BrakingTransmissionPrincipalCode',
      'unit' => '',
      'values' => [
        'MECHA' => 'Mechanical',
        'PNEU' => 'Pneumatic',
        'HYDRL' => 'Hydraulic',
        'HYDST' => 'Hydrostatic',
      ],
    ],
    'CabCategory' => [
      'format' => 'CabCategoryCode',
      'unit' => '',
      'values' => [
        2 => 'Category 2',
        3 => 'Category 3',
        4 => 'Category 4',
      ],
    ],
    'CargoVolume' => [
      'format' => 'Decimal63',
      'unit' => 'm³',
      'values' => [
      ],
    ],
    'CategoryHybridElectricVehicle' => [
      'format' => 'CategoryHybridElectricVehicleCode',
      'unit' => '',
      'values' => [
        'OVC' => 'Off vehicle-charging hybrid electric vehicle',
        'NOVC' => 'Not off-vehicle charging hybrid electric vehicle',
      ],
    ],
    'CategorySubCategoryEnergyConvertor' => [
      'format' => 'CategorySubCategoryEnergyConvertorCode',
      'unit' => '',
      'values' => [
        'NRE-v-1' => 'Non-road machinery compression ignition type engine with variable speed and a maximum net power range: 0 < P < 8 kW',
        'NRE-v-2' => 'Non-road machinery compression ignition type engine with variable speed and a maximum net power range: 8 = P < 19 kW',
        'NRE-v-3' => 'Non-road machinery compression ignition type engine with variable speed and a maximum net power range: 19 = P < 37 kW',
        'NRE-v-4' => 'Non-road machinery compression ignition type engine with variable speed and a maximum net power range: 37 = P < 56 kW',
        'NRE-v-5' => 'Non-road machinery engine with variable speed and a maximum net power range: 56 = P < 130 kW',
        'NRE-v-6' => 'Non-road machinery engine with variable speed and a maximum net power range: 130 = P = 560 kW',
        'NRE-v-7' => 'Non-road machinery engine with variable speed and a maximum net power range: P > 560 kW',
        'NRE-c-1' => 'Non-road machinery compression ignition type engine with constant speed and a rated net power range: 0 < P < 8 kW',
        'NRE-c-2' => 'Non-road machinery compression ignition type engine with constant speed and a rated net power range: 8 = P < 19 kW',
        'NRE-c-3' => 'Non-road machinery compression ignition type engine with constant speed and a rated net power range: 19 = P < 37 kW',
        'NRE-c-4' => 'Non-road machinery compression ignition type engine with constant speed and a rated net power range: 37 = P < 56 kW',
        'NRE-c-5' => 'Non-road machinery engine with constant speed and a rated net power range: 56 = P < 130 kW',
        'NRE-c-6' => 'Non-road machinery engine with constant speed and a rated net power range: 130 = P = 560 kW',
        'NRG-v-1' => 'Non-road machinery engine with variable speed and a maximum net power range: P > 560 kW',
        'NRG-c-1' => 'Non-road machinery engine with constant speed and a rated net power range: P > 560 kW',
        'NRS-vr-1a' => 'Non-road machinery spark ignition type engine with variable speed = 3600 min-1 or constant speed and a maximum net power range: 0 < P < 19 kW and swept engine volume 80 = SV < 225 cm3',
        'NRS-vr-1b' => 'Non-road machinery spark ignition type engine with variable speed = 3600 min-1 or constant speed and a maximum net power range: 0 < P < 19 kW and swept engine volume SV = 225 cm3',
        'NRS-vi-1a' => 'Non-road machinery spark ignition type engine with variable speed < 3600 min-1 and a maximum net power range: 0 < P < 19 kW and swept engine volume 80 = SV < 225 cm3',
        'NRS-vi-1b' => 'Non-road machinery spark ignition type engine with variable speed < 3600 min-1 and a maximum net power range: 0 < P < 19 kW and swept engine volume SV = 225 cm3',
        'NRS-v-2a' => 'Non-road machinery spark ignition type engine with variable speed = 3600 min-1 or constant speed and a maximum net power range: 19 = P < 30 kW and swept engine volume SV = 1000 cm3',
        'NRS-v-2b' => 'Non-road machinery spark ignition type engine with variable speed = 3600 min-1 or constant speed and a maximum net power range: 19 = P < 30 kW and swept engine volume SV > 1000 cm3',
        'NRS-v-3' => 'Non-road machinery spark ignition type engine with variable speed = 3600 min-1 or constant speed and a maximum net power range: 30 = P < 56 kW',
        'ATS-v-1' => 'All terrain vehicle spark ignition type engine with variable or constant speed and a maximum net power range: P > 0 kW',
      ],
    ],
    'ClassHybridVehicle' => [
      'format' => 'ClassHybridVehicleCode',
      'unit' => '',
      'values' => [
        'OVC-HEV' => 'Off vehicle-charging hybrid electric vehicle',
        'NOVC-HEV' => 'Not off-vehicle charging hybrid electric vehicle',
        'OVC-FCHV' => 'Off-vehicle charging fuel cell hybrid vehicle',
        'NOVC-FCHV' => 'Not off-vehicle charging fuel cell hybrid vehicle',
      ],
    ],
    'CodeForBodywork' => [
      'format' => 'BodyworkCode',
      'unit' => '',
      'values' => [
        'AA' => 'Saloon',
        'AB' => 'Hatchback',
        'AC' => 'Station wagon',
        'AD' => 'Coupé',
        'AE' => 'Convertible',
        'AF' => 'Multi-purpose vehicle',
        'AG' => 'Truck station wagon',
        'BA' => 'Lorry',
        'BB' => 'Van',
        'BC' => 'Tractor unit for semitrailer',
        'BD' => 'Road tractor',
        'BE' => 'Pick-up truck',
        'BX' => 'Chassis-cab or chassiscowl',
        'CA' => 'Single-deck vehicle',
        'CB' => 'Double-deck vehicle',
        'CC' => 'Single-deck articulated vehicle',
        'CD' => 'Double-deck articulated vehicle',
        'CE' => 'Low-floor single-deck vehicle',
        'CF' => 'Low-floor double-deck vehicle',
        'CG' => 'Articulated low-floor single-deck vehicle',
        'CH' => 'Articulated low-floor double-deck vehicle',
        'CI' => 'Open top single deck vehicle',
        'CJ' => 'Open top double deck vehicle',
        'CX' => 'Bus chassis',
        'DA' => 'Semi-trailer',
        'DB' => 'Drawbar trailer',
        'DC' => 'Centre-axle trailer',
        'DE' => 'Rigid drawbar trailer',
        'DF' => 'Link semi-trailer',
        'DG' => 'Link drawbar trailer',
      ],
    ],
    'CodeForBodyworkSupplement' => [
      'format' => 'CodeForBodyworkSupplementCode',
      'unit' => '',
      'values' => [
        '01' => 'Flat bed',
        '02' => 'Drop-side',
        '03' => 'Box body',
        '04' => 'Conditioned body with insulated walls and equipment to maintain the interior temperature',
        '05' => 'Conditioned body with insulated walls but without equipment to maintain the interior temperature',
        '06' => 'Curtain-sided',
        '07' => 'Swap body (interchangeable superstructure)',
        '08' => 'Container carrier',
        '09' => 'Vehicles fitted with hook lift',
        10 => 'Tipper',
        11 => 'Tank',
        12 => 'Tank intended for transport of dangerous goods',
        13 => 'Livestock carrier',
        14 => 'Vehicle transporter',
        15 => 'Concrete mixer',
        16 => 'Concrete pump vehicle',
        17 => 'Timber',
        18 => 'Refuse collection vehicle',
        19 => 'Street sweeper, cleansing and drain clearing',
        20 => 'Compressor',
        21 => 'Boat carrier',
        22 => 'Glider carrier',
        23 => 'Vehicles for retail or display purposes',
        24 => 'Recovery vehicle',
        25 => 'Ladder vehicle',
        26 => 'Crane lorry (other than a mobile crane as defined in point 5.7 of Part A)',
        27 => 'Aerial work platform vehicle',
        28 => 'Digger derrick vehicle',
        29 => 'Low floor trailer',
        30 => 'Glazing transporter',
        31 => 'Fire engine',
        32 => 'Drop-side tarpaulin',
        99 => 'Bodywork that is not included in this list',
      ],
    ],
    'Colour' => [
      'format' => 'ColourCode',
      'unit' => '',
      'values' => [
        1 => 'White',
        2 => 'Yellow',
        3 => 'Orange',
        4 => 'Red',
        5 => 'Violet',
        6 => 'Blue',
        7 => 'Green',
        8 => 'Grey',
        9 => 'Brown',
        10 => 'Black',
      ],
    ],
    'CombustionCycle' => [
      'format' => 'CombustionCycleCode',
      'unit' => '',
      'values' => [
        '2ST' => 'Two stroke cycle',
        '4ST' => 'Four stroke cycle',
        'ROT' => 'Rotary',
        'OTH' => 'Other',
      ],
    ],
    'CommercialName' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'CompletedAltered' => [
      'format' => 'CompletedAlteredCode',
      'unit' => '',
      'values' => [
        'A' => 'Altered',
        'B' => 'Both',
        'C' => 'Completed',
      ],
    ],
    'ConsolidatedMaximum30MinutesPower' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'ConsolidatedMaximumNetPowerElectric' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'ConvertingPerformanceIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'CryptographicHashCustomerInformationFile' => [
      'format' => 'Text64',
      'unit' => '',
      'values' => [
      ],
    ],
    'CryptographicHashManufacturerRecord' => [
      'format' => 'Text64',
      'unit' => '',
      'values' => [
      ],
    ],
    'CryptographicHashVehicleFile' => [
      'format' => 'Text64',
      'unit' => '',
      'values' => [
      ],
    ],
    'DateManufactureVehicle' => [
      'format' => 'Date',
      'unit' => '',
      'values' => [
      ],
    ],
    'DeclaredMaximumSpeedForward' => [
      'format' => 'Decimal52',
      'unit' => 'km/h',
      'values' => [
      ],
    ],
    'DeclaredMaximumSpeedRearward' => [
      'format' => 'Decimal52',
      'unit' => 'km/h',
      'values' => [
      ],
    ],
    'DeclaredRatedNetPower' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'DescriptionCompletedAltered' => [
      'format' => 'Text500',
      'unit' => '',
      'values' => [
      ],
    ],
    'DescriptionServiceAndMaintenance' => [
      'format' => 'Text4000',
      'unit' => '',
      'values' => [
      ],
    ],
    'DesignatedTypeApprovalCountry' => [
      'format' => 'TypeApprovalCountryCode',
      'unit' => '',
      'values' => [
        'e1' => 'Germany',
        'e2' => 'France',
        'e3' => 'Italy',
        'e4' => 'The Netherlands',
        'e5' => 'Sweden',
        'e6' => 'Belgium',
        'e7' => 'Hungary',
        'e8' => 'Czech Republic',
        'e9' => 'Spain',
        'e12' => 'Austria',
        'e13' => 'Luxembourg',
        'e17' => 'Finland',
        'e18' => 'Denmark',
        'e19' => 'Romania',
        'e20' => 'Poland',
        'e21' => 'Portugal',
        'e23' => 'Greece',
        'e24' => 'Ireland',
        'e25' => 'Croatia',
        'e26' => 'Slovenia',
        'e27' => 'Slovakia',
        'e29' => 'Estonia',
        'e32' => 'Latvia',
        'e34' => 'Bulgaria',
        'e36' => 'Lithuania',
        'e49' => 'Cyprus',
        'e50' => 'Malta',
      ],
    ],
    'DistanceCentreCouplingDeviceLastAxle' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCentreCouplingDeviceLastAxleAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCentreCouplingDeviceLastAxleAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCentreCouplingRearEnd' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCentreCouplingRearEndAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCentreCouplingRearEndAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCouplingPointFirstAxle' => [
      'format' => 'Integer6',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCouplingPointFirstAxleAdjustableMax' => [
      'format' => 'Integer6',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceCouplingPointFirstAxleAdjustableMin' => [
      'format' => 'Integer6',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceFrontEndCentreCoupling' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceFrontEndCentreCouplingAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistanceFrontEndCentreCouplingAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'DistributionMassIncompleteAxle' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'DistributionMassRunningOrderAxle' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'DriveAxleAirSuspensionOrEquivalentIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'DriverSeatTypeCategory' => [
      'format' => 'DriverSeatTypeCategoryCode',
      'unit' => '',
      'values' => [
        'A' => 'Category A',
        'B' => 'Category B',
      ],
    ],
    'DriverSeatTypeCategoryClass' => [
      'format' => 'DriverSeatTypeCategoryClassCode',
      'unit' => '',
      'values' => [
        'I' => 'Category I',
        'II' => 'Category II',
        'III' => 'Category III',
      ],
    ],
    'DrivingCycleCappedSpeedIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'DrivingCycleClass' => [
      'format' => 'DrivingCycleClassCode',
      'unit' => '',
      'values' => [
        1 => 'Class 1 <= 22 W/kg',
        2 => 'Class 2 > 22 <= 34 W/kg',
        '3a' => 'Class 3a > 34 W/kg Vmax < 120 km/h',
        '3b' => 'Class 3b > 34 W/kg Vmax >= 120 km/h',
      ],
    ],
    'DrivingCycleDownscalingFactor' => [
      'format' => 'DrivingCycleDownscalingFactor',
      'unit' => '',
      'values' => [
      ],
    ],
    'DualFuelType' => [
      'format' => 'DualFuelTypeCode',
      'unit' => '',
      'values' => [
      ],
    ],
    'DustFilterIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'EURepresentativeAddressLine1' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'EURepresentativeAddressLine2' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'EURepresentativeAddressLine3' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'EURepresentativeCountryOfResidence' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'EURepresentativeName' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'EURepresentativePlaceOfResidence' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'EcoInnovationCountry' => [
      'format' => 'TypeApprovalCountryCode',
      'unit' => '',
      'values' => [
        'e1' => 'Germany',
        'e2' => 'France',
        'e3' => 'Italy',
        'e4' => 'The Netherlands',
        'e5' => 'Sweden',
        'e6' => 'Belgium',
        'e7' => 'Hungary',
        'e8' => 'Czech Republic',
        'e9' => 'Spain',
        'e12' => 'Austria',
        'e13' => 'Luxembourg',
        'e17' => 'Finland',
        'e18' => 'Denmark',
        'e19' => 'Romania',
        'e20' => 'Poland',
        'e21' => 'Portugal',
        'e23' => 'Greece',
        'e24' => 'Ireland',
        'e25' => 'Croatia',
        'e26' => 'Slovenia',
        'e27' => 'Slovakia',
        'e29' => 'Estonia',
        'e32' => 'Latvia',
        'e34' => 'Bulgaria',
        'e36' => 'Lithuania',
        'e49' => 'Cyprus',
        'e50' => 'Malta',
      ],
    ],
    'EcoInnovationsFittedIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'EfficiencyRatioKilometer' => [
      'format' => 'Decimal95',
      'unit' => '',
      'values' => [
      ],
    ],
    'EfficiencyRatioM3Kilometer' => [
      'format' => 'Decimal95',
      'unit' => '',
      'values' => [
      ],
    ],
    'EfficiencyRatioTonKilometer' => [
      'format' => 'Decimal95',
      'unit' => '',
      'values' => [
      ],
    ],
    'ElectricVehicleConfiguration' => [
      'format' => 'ElectricVehicleConfigurationCode',
      'unit' => '',
      'values' => [
        'HYBRE' => 'Hybrid electric',
        'MNPWE' => 'Manpower - electric',
        'PUREE' => 'Pure electric',
      ],
    ],
    'ElectricalControlLineIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'ElectronicBrakingSystem' => [
      'format' => 'OptionalCode',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
        'O' => 'Optional',
      ],
    ],
    'ElongatedCabIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'EnergyConvertorCodeMarkedOnEnergyConvertor' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'EnergyConvertorTypeApprovalNumber' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'EnergySource' => [
      'format' => 'EnergySourceCode',
      'unit' => '',
      'values' => [
        10 => 'Petrol',
        11 => 'Petrol E5',
        12 => 'Petrol E10',
        15 => 'Ethanol',
        16 => 'Ethanol E85',
        19 => 'Mixture',
        20 => 'Diesel',
        21 => 'Biodiesel',
        22 => 'ED95',
        30 => 'LPG',
        40 => 'CNG',
        44 => 'Biomethane',
        50 => 'Hydrogen',
        55 => 'H2NG',
        60 => 'LNG',
        90 => 'Other',
        91 => 'Compressed air',
        95 => 'Electricity',
      ],
    ],
    'EngineCapacity' => [
      'format' => 'Decimal72',
      'unit' => 'cm³',
      'values' => [
      ],
    ],
    'EngineSpeedMaximumNetPower' => [
      'format' => 'Integer5',
      'unit' => 'min⁻¹',
      'values' => [
      ],
    ],
    'EngineSpeedMaximumNetPowerMax' => [
      'format' => 'Integer5',
      'unit' => 'min⁻¹',
      'values' => [
      ],
    ],
    'EngineSpeedMaximumNetPowerMin' => [
      'format' => 'Integer5',
      'unit' => 'min⁻¹',
      'values' => [
      ],
    ],
    'ExhaustEmissionLatestRegulationNumber' => [
      'format' => 'Text35',
      'unit' => '',
      'values' => [
      ],
    ],
    'ExhaustEmissionLevel' => [
      'format' => 'ExhaustEmissionLevel',
      'unit' => '',
      'values' => [
      ],
    ],
    'FallingObjectsProtectiveStructureForestryIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'FallingObjectsProtectiveStructureNonForestryIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'FinalDriveNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'FinalDriveRatio' => [
      'format' => 'Decimal75',
      'unit' => '',
      'values' => [
      ],
    ],
    'FinalDriveVehicleNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'FinalDriveVehicleRatio' => [
      'format' => 'Decimal75',
      'unit' => '',
      'values' => [
      ],
    ],
    'FuelType' => [
      'format' => 'FuelTypeCode',
      'unit' => '',
      'values' => [
        'B' => 'Bifuel',
        'D' => 'Dualfuel',
        'F' => 'Flexfuel',
        'M' => 'Monofuel',
      ],
    ],
    'FuellingArrangement' => [
      'format' => 'FuellingArrangementCode',
      'unit' => '',
      'values' => [
        'D1A' => 'Dualfuel type 1A',
        'D1B' => 'Dualfuel type 1B',
        'D2A' => 'Dualfuel type 2A',
        'D2B' => 'Dualfuel type 2B',
        'D3B' => 'Dualfuel type 3B',
        'G' => 'Gaseous-fuel only',
        'L' => 'Liquidfuel only',
      ],
    ],
    'GearNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'GearRatio' => [
      'format' => 'Decimal106',
      'unit' => '',
      'values' => [
      ],
    ],
    'GearboxType' => [
      'format' => 'GearboxTypeCode',
      'unit' => '',
      'values' => [
        'A' => 'Automatic',
        'C' => 'CVT',
        'D' => 'Double clutch (gear change)',
        'F' => 'Fixed ratio',
        'G' => 'Automised',
        'H' => 'Hydrostatic',
        'M' => 'Manual',
        'O' => 'Other',
        'S' => 'Semi-automatic',
        'W' => 'Wheel hub',
      ],
    ],
    'GeneralCodeEcoInnovation' => [
      'format' => 'GeneralCodeEcoInnovationCode',
      'unit' => '',
      'values' => [
        28 => 'Passenger cars - LED lights',
        29 => 'Passenger cars / Light Commercial Vehicles - Alternator',
        32 => 'Passenger cars / Light Commercial Vehicles - 48V motor generator with DC/DC converter',
        33 => 'Passenger cars / Light Commercial Vehicles - 12V motor generator',
        35 => 'Light Commercial Vehicles - LED lights',
        37 => 'Passenger cars - LED lights',
        38 => 'Passenger cars / Light Commercial Vehicles - Smart diesel fuel heater',
      ],
    ],
    'GeneralDescriptionMachinery' => [
      'format' => 'Text500',
      'unit' => '',
      'values' => [
      ],
    ],
    'GroundClearanceBetweenAxles' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'Height' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'HeightAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'HeightAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'HybridApplicationCode' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleAxleGroupLadenMass' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleLadenMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleLadenMassAxle' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleLadenMassAxleCountry' => [
      'format' => 'EuCountryCode',
      'unit' => '',
      'values' => [
        'AT' => 'Austria',
        'BE' => 'Belgium',
        'BG' => 'Bulgaria',
        'CH' => 'Switzerland',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DE' => 'Germany',
        'DK' => 'Denmark',
        'EE' => 'Estonia',
        'ES' => 'Spain',
        'FI' => 'Finland',
        'FR' => 'France',
        'GR' => 'Greece',
        'HR' => 'Croatia',
        'HU' => 'Hungary',
        'IE' => 'Ireland',
        'IS' => 'Iceland',
        'IT' => 'Italy',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'LV' => 'Latvia',
        'MT' => 'Malta',
        'NL' => 'Netherlands',
        'NO' => 'Norway',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'RO' => 'Romania',
        'SE' => 'Sweden',
        'SI' => 'Slovenia',
        'SK' => 'Slovakia',
        'UK' => 'United Kingdom',
      ],
    ],
    'InServiceMaximumPermissibleLadenMassAxleGroupCountry' => [
      'format' => 'EuCountryCode',
      'unit' => '',
      'values' => [
        'AT' => 'Austria',
        'BE' => 'Belgium',
        'BG' => 'Bulgaria',
        'CH' => 'Switzerland',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DE' => 'Germany',
        'DK' => 'Denmark',
        'EE' => 'Estonia',
        'ES' => 'Spain',
        'FI' => 'Finland',
        'FR' => 'France',
        'GR' => 'Greece',
        'HR' => 'Croatia',
        'HU' => 'Hungary',
        'IE' => 'Ireland',
        'IS' => 'Iceland',
        'IT' => 'Italy',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'LV' => 'Latvia',
        'MT' => 'Malta',
        'NL' => 'Netherlands',
        'NO' => 'Norway',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'RO' => 'Romania',
        'SE' => 'Sweden',
        'SI' => 'Slovenia',
        'SK' => 'Slovakia',
        'UK' => 'United Kingdom',
      ],
    ],
    'InServiceMaximumPermissibleLadenMassAxleGroupTrafficRegulation' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleLadenMassAxleTrafficRegulation' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleMassCombination' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'InServiceMaximumPermissibleMassCountry' => [
      'format' => 'EuCountryCode',
      'unit' => '',
      'values' => [
        'AT' => 'Austria',
        'BE' => 'Belgium',
        'BG' => 'Bulgaria',
        'CH' => 'Switzerland',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DE' => 'Germany',
        'DK' => 'Denmark',
        'EE' => 'Estonia',
        'ES' => 'Spain',
        'FI' => 'Finland',
        'FR' => 'France',
        'GR' => 'Greece',
        'HR' => 'Croatia',
        'HU' => 'Hungary',
        'IE' => 'Ireland',
        'IS' => 'Iceland',
        'IT' => 'Italy',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'LV' => 'Latvia',
        'MT' => 'Malta',
        'NL' => 'Netherlands',
        'NO' => 'Norway',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'RO' => 'Romania',
        'SE' => 'Sweden',
        'SI' => 'Slovenia',
        'SK' => 'Slovakia',
        'UK' => 'United Kingdom',
      ],
    ],
    'InServiceMaximumPermissibleMassTrafficRegulation' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'IntendedCountryRegistration' => [
      'format' => 'ViennaCountryCode',
      'unit' => '',
      'values' => [
        'A' => 'Austria',
        'AL' => 'Albania',
        'AND' => 'Andorra',
        'AM' => 'Armenia',
        'AUS' => 'Australia',
        'AZ' => 'Azerbaijan',
        'B' => 'Belgium',
        'BD' => 'Bangladesh',
        'BDS' => 'Barbados',
        'BG' => 'Bulgaria',
        'BH' => 'Belize',
        'BIH' => 'Bosnia and Herzegovina',
        'BR' => 'Brazil',
        'BRN' => 'Bahrain',
        'BRU' => 'Brunei',
        'BS' => 'Bahamas',
        'BW' => 'Botswana',
        'BY' => 'Belarus',
        'C' => 'Cuba',
        'CDN' => 'Canada',
        'CGO' => 'Congo-Kinshasa',
        'CH' => 'Switzerland',
        'CI' => 'Côte d\'Ivoire',
        'CL' => 'Sri Lanka',
        'CO' => 'Colombia',
        'CR' => 'Costa Rica',
        'CV' => 'Cabo Verde',
        'CY' => 'Cyprus',
        'CZ' => 'Czechia',
        'D' => 'Germany',
        'DK' => 'Denmark',
        'DOM' => 'Dominican Republic',
        'DZ' => 'Algeria',
        'E' => 'Spain',
        'EAK' => 'Kenia',
        'EAT' => 'Tanzania',
        'EAU' => 'Uganda',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'EST' => 'Estonia',
        'F' => 'France',
        'FIN' => 'Finland',
        'FJI' => 'Fiji',
        'FL' => 'Liechtenstein',
        'FO' => 'Faeröers',
        'GBA' => 'Alderney',
        'GBG' => 'Guernsey',
        'GBJ' => 'Jersey',
        'GBM' => 'Isle of Man',
        'GBZ' => 'Gibraltar',
        'GCA' => 'Guatamala',
        'GE' => 'Georgia',
        'GH' => 'Ghana',
        'GR' => 'Greece',
        'GUY' => 'Guyana',
        'H' => 'Hungary',
        'HK' => 'Hong Kong',
        'HKJ' => 'Jordan',
        'HR' => 'Croatia',
        'I' => 'Italy',
        'IL' => 'Israel',
        'IND' => 'India',
        'IR' => 'Iran, Islamic Republic of',
        'IRL' => 'Ireland',
        'IRQ' => 'Iraq',
        'IS' => 'Iceland',
        'J' => 'Japan',
        'JA' => 'Jamaica',
        'KH' => 'Cambodia',
        'KG' => 'Kyrgyzstan',
        'KWT' => 'Kuwait',
        'KZ' => 'Kazakhstan',
        'L' => 'Luxembourg',
        'LAO' => 'Lao People\'s Democratic Republic',
        'LS' => 'Lesotho',
        'LT' => 'Lithuania',
        'LV' => 'Latvia',
        'M' => 'Malta',
        'MA' => 'Morocco',
        'MAL' => 'Malaysia',
        'MC' => 'Monaco',
        'MD' => 'Moldova, Republic of',
        'MEX' => 'Mexico',
        'MGL' => 'Mongolia',
        'MNE' => 'Montenegro',
        'MS' => 'Mauritius',
        'MW' => 'Malawi',
        'MYA' => 'Myanmar',
        'N' => 'Norway',
        'NA' => 'Netherlands Antilles',
        'NAM' => 'Namibia',
        'NIC' => 'Nicaragua',
        'NL' => 'Netherlands',
        'NZ' => 'New Zealand',
        'OM' => 'Oman',
        'P' => 'Portugal',
        'PA' => 'Panama',
        'PK' => 'Pakistan',
        'PAL' => 'Palau',
        'PE' => 'Peru',
        'PL' => 'Poland',
        'PNG' => 'Papua New Guinea',
        'PS' => 'Palestine, State of',
        'PY' => 'Paraguay',
        'RA' => 'Argentina',
        'RC' => 'Taiwan',
        'RCA' => 'Central African Republic',
        'RCB' => 'Congo-Brazzaville',
        'RCH' => 'Chile',
        'RH' => 'Haïti',
        'RI' => 'Indonesia',
        'RL' => 'Lebanon',
        'RM' => 'Madagascar',
        'RMM' => 'Mali',
        'RN' => 'Niger',
        'RO' => 'Romania',
        'ROK' => 'Republic of Korea',
        'ROU' => 'Uruguay',
        'RP' => 'Philipines',
        'RSM' => 'San Marino',
        'RUS' => 'Russia ',
        'RWA' => 'Rwanda',
        'S' => 'Sweden',
        'SD' => 'Swaziland',
        'SGP' => 'Singapore',
        'SK' => 'Slovakia',
        'SLO' => 'Slovenia',
        'SME' => 'Surinam',
        'SN' => 'Senegal',
        'SRB' => 'Serbia',
        'SY' => 'Seychelles',
        'SYR' => 'Syrian Arab Republic',
        'T' => 'Thailand',
        'TG' => 'Togo',
        'TJ' => 'Tajikistan',
        'TM' => 'Turkmenistan',
        'TN' => 'Tunisia',
        'TR' => 'Türkiye',
        'TT' => 'Trinidad and Tobago',
        'UA' => 'Ukraine',
        'UAE' => 'United Arab Emirates',
        'UK' => 'United Kingdom',
        'USA' => 'United States',
        'UZ' => 'Uzbekistan',
        'V' => 'Vatican',
        'VN' => 'Vietnam',
        'WAG' => 'Gambia',
        'WAL' => 'Sierra Leone',
        'WAN' => 'Nigeria',
        'WG' => 'Grenada',
        'WL' => 'Saint Lucia',
        'WS' => 'Samoa',
        'WV' => 'Windward Islands Saint Vincent and the Grenadines',
        'YV' => 'Venezuela',
        'Z' => 'Zambia',
        'ZA' => 'South Africa',
        'ZW' => 'Zimbabwe',
      ],
    ],
    'InterconnectionWithPoweredAxleConnection' => [
      'format' => 'InterconnectionWithPoweredAxleConnectionCode',
      'unit' => '',
      'values' => [
        'TRANS' => 'Transfer box',
        'ELECT' => 'Electronic',
        'SHAFT' => 'Shaft',
      ],
    ],
    'InterconnectionWithPoweredAxleNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'Iso7638ConnectorIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'IviReferenceId' => [
      'format' => 'IviReferenceId',
      'unit' => '',
      'values' => [
      ],
    ],
    'IviVersionDateTime' => [
      'format' => 'DateTime',
      'unit' => '',
      'values' => [
      ],
    ],
    'IviVersionNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'IviVersionNumberXsd' => [
      'format' => 'IviVersionNumberXsd',
      'unit' => '',
      'values' => [
        '2.0' => 'Versionnumber of the XSD the eCoC has been generated with.',
      ],
    ],
    'Length' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LengthAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LengthAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LengthLoadingArea' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LengthLoadingAreaAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LengthLoadingAreaAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LiftAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'LoadCapacityIndexSingleWheel' => [
      'format' => 'LoadCapacityIndex',
      'unit' => '',
      'values' => [
      ],
    ],
    'LoadCapacityIndexTwinWheel' => [
      'format' => 'LoadCapacityIndex',
      'unit' => '',
      'values' => [
      ],
    ],
    'LoadPlatformHeightAboveGround' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LoadPlatformLength' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LoadPlatformLoadCapacity' => [
      'format' => 'Integer6',
      'unit' => '',
      'values' => [
      ],
    ],
    'LoadPlatformWidth' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'LoadableAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'LocationArrangementSeats' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'LocationMarkingsSubject' => [
      'format' => 'LocationMarkingsSubjectCode',
      'unit' => '',
      'values' => [
        'VIN' => 'Location VIN',
        'STAT' => 'Location Statutory Plates Code',
      ],
    ],
    'LocationMarkingsVehiclePart' => [
      'format' => 'LocationMarkingsVehiclePartCode',
      'unit' => '',
      'values' => [
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
    ],
    'LocationMarkingsVehiclePartSide' => [
      'format' => 'LocationMarkingsVehiclePartSideCode',
      'unit' => '',
      'values' => [
        'FRONTSIDE' => 'Frontside',
        'LEFTSIDE' => 'Leftside',
        'RIGHTSIDE' => 'Rightside',
        'BACKSIDE' => 'Backside',
      ],
    ],
    'LocationMarkingsVehiclePartSideSection' => [
      'format' => 'LocationMarkingsVehiclePartSideSectionCode',
      'unit' => '',
      'values' => [
        'BACK' => 'Back',
        'FRONT' => 'Front',
        'LEFT' => 'Left',
        'MIDDLE' => 'Middle',
        'RIGHT' => 'Right',
      ],
    ],
    'LocationStatutoryPlate23Wheel' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'LocationVin23Wheel' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'MachineryMountedIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'Make' => [
      'format' => 'Text52',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerAddressLine1' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerAddressLine2' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerAddressLine3' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerCountryOfResidence' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerEnergyConvertor' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerHybridApplication' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerName' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerPlaceOfResidence' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'ManufacturerStageNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'MassInRunningOrder' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MassInRunningOrderIncomplete' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MassInRunningOrderVariableMax' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MassInRunningOrderVariableMin' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'Maximum15MinutesPower' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'Maximum30MinutesPower' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'MaximumAcceptableAmountPercentageBiofuel' => [
      'format' => 'Decimal52',
      'unit' => '% vol.',
      'values' => [
      ],
    ],
    'MaximumAssistanceFactor' => [
      'format' => 'Decimal32',
      'unit' => '',
      'values' => [
      ],
    ],
    'MaximumAssistanceSpeed' => [
      'format' => 'Decimal52',
      'unit' => 'km/h',
      'values' => [
      ],
    ],
    'MaximumAuthorisedDimensionsDerogationIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'MaximumNetPowerCombustion' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'MaximumNetPowerElectric' => [
      'format' => 'Decimal62',
      'unit' => 'kW',
      'values' => [
      ],
    ],
    'MaximumPermissibleHeight' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleHeightMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleHeightMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleLength' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleLengthMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleLengthMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleMassTyreAxleCombination' => [
      'format' => 'Integer6',
      'unit' => '',
      'values' => [
      ],
    ],
    'MaximumPermissibleRearOverhang' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleVerticalLoadOnCouplingPointTrackTrainCoupling' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MaximumPermissibleVerticalLoadOnCouplingPointTyreCombination' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MaximumPermissibleVerticalLoadOnCouplingPointTyreCombinationCoupling' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MaximumPermissibleWidth' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleWidthMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumPermissibleWidthMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MaximumSpeed' => [
      'format' => 'Decimal52',
      'unit' => 'km/h',
      'values' => [
      ],
    ],
    'MechanicalCouplingApprovalMark' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingApprovalNumber' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedApprovalMark' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedApprovalNumber' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedClass' => [
      'format' => 'MechanicalCouplingCanBeFittedClassCode',
      'unit' => '',
      'values' => [
        'A' => 'Coupling balls and towing brackets employing a 50 mm diameter spherical device and brackets on the towing vehicle for connecting to the trailer by means of a coupling head.',
        'A50-1' => 'Standard 50 mm diameter ball coupling with flange attachment (ball type towing device).',
        'A50-2' => 'Standard 50 mm diameter ball coupling with alternative flange attachment.',
        'A50-3' => 'Standard 50 mm diameter ball coupling with different mounting arrangement.',
        'A50-4' => 'Standard 50 mm diameter ball coupling with alternative mounting.',
        'A50-5' => 'Standard 50 mm diameter ball coupling with specific mounting arrangement.',
        'A50-X' => 'Non-standard 50 mm ball couplings and brackets.',
        'B' => 'Couplings for trailers with 50 mm ball.',
        'B50-X' => 'Non-standard 50 mm couplings for trailers.',
        'C' => 'Drawbar couplings with 50 mm pin and automatic closure.',
        'C50-1' => 'Standard 50 mm pin drawbar coupling, type 1.',
        'C50-2' => 'Standard 50 mm pin drawbar coupling, type 2.',
        'C50-3' => 'Standard 50 mm pin drawbar coupling, type 3.',
        'C50-4' => 'Standard 50 mm pin drawbar coupling, type 4.',
        'C50-5' => 'Standard 50 mm pin drawbar coupling, type 5.',
        'C50-6' => 'Standard 50 mm pin drawbar coupling, type 6.',
        'C50-7' => 'Standard 50 mm pin drawbar coupling, type 7.',
        'C50-X' => 'Non-standard 50 mm pin drawbar couplings.',
        'D' => 'Drawbar eyes with parallel hole for 50 mm pin.',
        'D50-A' => 'Standard 50 mm pin drawbar eye for welded attachment.',
        'D50-B' => 'Standard 50 mm pin drawbar eye for bolted attachment.',
        'D50-C' => 'Standard 50 mm pin drawbar eye for bolted attachment (variant C).',
        'D50-D' => 'Standard 50 mm pin drawbar eye for bolted attachment (variant D).',
        'D50-X' => 'Non-standard 50 mm pin drawbar eyes.',
        'E' => 'Non-standard drawbars, including overrun brakes and similar equipment.',
        'F' => 'Non-standard drawbeams between coupling and vehicle frame.',
        'G' => 'Fifth wheel couplings with automatic locking.',
        'G50' => 'Standard 50 mm pin fifth wheel coupling.',
        'G50-X' => 'Non-standard 50 mm pin fifth wheel couplings.',
        'H' => 'Fifth wheel kingpins, 50 mm diameter.',
        'H50-X' => 'Non-standard 50 mm kingpins for fifth wheel couplings.',
        'J' => 'Non-standard mounting plates for fifth wheel couplings.',
        'K' => 'Standard hook couplings for use with L-type drawbar eyes.',
        'K1' => 'Subclass of hook couplings (see Annex 5 for details).',
        'K2' => 'Subclass of hook couplings (see Annex 5 for details).',
        'K3' => 'Subclass of hook couplings (see Annex 5 for details).',
        'K4' => 'Subclass of hook couplings (see Annex 5 for details).',
        'KA1' => 'Subclass of hook couplings (see Annex 5 for details).',
        'KA2' => 'Subclass of hook couplings (see Annex 5 for details).',
        'KA3' => 'Subclass of hook couplings (see Annex 5 for details).',
        'L' => 'Standard toroidal drawbar eyes for use with K-type hook couplings.',
        'L1' => 'Subclass of toroidal drawbar eyes (see Annex 5 for details).',
        'L2' => 'Subclass of toroidal drawbar eyes (see Annex 5 for details).',
        'L3' => 'Subclass of toroidal drawbar eyes (see Annex 5 for details).',
        'L4' => 'Subclass of toroidal drawbar eyes (see Annex 5 for details).',
        'L5' => 'Subclass of toroidal drawbar eyes (see Annex 5 for details).',
        'S' => 'Devices/components not covered by A to L, often for special or heavy transport.',
        'T' => 'Non-standard, non-automatic couplings, only detachable with tools (e.g. car transporters).',
        'W' => '(Not explicitly mentioned in R55, possibly national or manufacturer-specific.)',
      ],
    ],
    'MechanicalCouplingCanBeFittedType' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedValueD' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedValueDc' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedValueS' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedValueU' => [
      'format' => 'Decimal62',
      'unit' => 't',
      'values' => [
      ],
    ],
    'MechanicalCouplingCanBeFittedValueV' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingDistributionMassRunningOrder' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MechanicalCouplingHeightAboveGround' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MechanicalCouplingHeightAboveGroundAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MechanicalCouplingHeightAboveGroundAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'MechanicalCouplingLocation' => [
      'format' => 'MechanicalCouplingLocationCode',
      'unit' => '',
      'values' => [
        'FRONT' => 'Front mechanical coupling',
        'REAR' => 'Rear mechanical coupling',
      ],
    ],
    'MechanicalCouplingMake' => [
      'format' => 'Text52',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingManufacturersTypeDesignation' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingMinimumDistributionMassCompleted' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MechanicalCouplingNumber' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingNumberOfTrackTrainCouplingPoint' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingNumberOfTyreAxleCouplingPointTyreCombination' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingNumberTowingMasses' => [
      'format' => 'Integer3',
      'unit' => 't',
      'values' => [
      ],
    ],
    'MechanicalCouplingNumberVerticalMass' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsApprovalMark' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsApprovalNumber' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsMake' => [
      'format' => 'Text52',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsManufacturersTypeDesignation' => [
      'format' => 'Text40',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsTypeAccordingAppendixEU' => [
      'format' => 'Text120',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsValueD' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsValueDc' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsValueS' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsValueU' => [
      'format' => 'Decimal62',
      'unit' => 't',
      'values' => [
      ],
    ],
    'MechanicalCouplingPartsValueV' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingTechnicallyPermissibleTowableMass' => [
      'format' => 'Decimal52',
      'unit' => 't',
      'values' => [
      ],
    ],
    'MechanicalCouplingTypeAccordingAppendixEU' => [
      'format' => 'Text120',
      'unit' => '',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueD' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueDc' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueHorizontalLoad' => [
      'format' => 'Integer6',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueS' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueU' => [
      'format' => 'Decimal62',
      'unit' => 't',
      'values' => [
      ],
    ],
    'MechanicalCouplingValueV' => [
      'format' => 'Decimal62',
      'unit' => 'kg/kN',
      'values' => [
      ],
    ],
    'MemberAxleNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'MethodAttachmentStatutoryPlate' => [
      'format' => 'MethodAttachmentStatutoryPlateCode',
      'unit' => '',
      'values' => [
        'A1' => 'Glued or bonded',
        'A2' => 'Screwed',
        'A3' => 'Riveted',
        'A4' => 'Bolted',
      ],
    ],
    'MetricImperialOdometer' => [
      'format' => 'MetricImperialOdometerCode',
      'unit' => '',
      'values' => [
        'B' => 'Both',
        'I' => 'Imperial',
        'M' => 'Metric',
      ],
    ],
    'MetricImperialSpeedometer' => [
      'format' => 'MetricImperialSpeedometerCode',
      'unit' => '',
      'values' => [
        'B' => 'Both',
        'I' => 'Imperial',
        'M' => 'Metric',
      ],
    ],
    'MinimalPermissibleDistributionMassCompletedAxle' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'MinimumMassCompleted' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'NrscCo' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscCo2' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscHc' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscHcNox' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscNox' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/kWh',
      'values' => [
      ],
    ],
    'NrscNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NrscParticulates' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrscTestCycle' => [
      'format' => 'NrscTestCycleCode',
      'unit' => '',
      'values' => [
        'C1' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'C2' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'D2' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'E2' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'E3' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'F' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'G1' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'G2' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'G3' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
        'H' => 'For full description see Annex XVII, Appendix 1 (EU) 2017/654',
      ],
    ],
    'NrtcCo' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcCo2' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcHc' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcHcNox' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcNox' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/kWh',
      'values' => [
      ],
    ],
    'NrtcNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NrtcParticulates' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'NrtcTestCycle' => [
      'format' => 'NrtcTestCycleCode',
      'unit' => '',
      'values' => [
        'NRTC' => 'Standard NRTC includes codes for diesel-powered equipment (like ATC, BLC, EXC, etc.)',
        'LSI-NRTC' => 'The LSI-NRTC (Large Spark-Ignition Non-Road Transient Cycle) is a variant of the NRTC test cycle specifically designed for large spark-ignition engines used in non-road mobile machinery. These engines are typically found in equipment like forklifts, sweepers, and airport ground support vehicles.',
      ],
    ],
    'NumberOfAxles' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfAxlesWithTwinWheels' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfBrakedAxles' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfCylinders' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfDoors' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfDoorsBack' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfDoorsFront' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfDoorsLeft' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfDoorsRight' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfPoweredAxles' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSeatingPositionsExcludingDriver' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSeatingPositionsIncludingDriver' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSeatingPositionsLowerDeck' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSeatingPositionsUpperDeck' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSeatsStationaryUseOnly' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSetsBallastMasses' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfStandingPlaces' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfSteeredAxles' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfWheelchairUserAccessiblePositions' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'NumberOfWheels' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'OtherBodywork' => [
      'format' => 'Text200',
      'unit' => '',
      'values' => [
      ],
    ],
    'OverallGearRatioHighestGear' => [
      'format' => 'Decimal75',
      'unit' => '',
      'values' => [
      ],
    ],
    'PowerMassRatio' => [
      'format' => 'Decimal32',
      'unit' => 'kW/kg',
      'values' => [
      ],
    ],
    'PowerTakeOffEngineSpeed' => [
      'format' => 'Integer5',
      'unit' => '',
      'values' => [
      ],
    ],
    'PowerTakeOffPosition' => [
      'format' => 'PowerTakeOffPositionCode',
      'unit' => '',
      'values' => [
        'FRONT' => 'Front',
        'OTHER' => 'Other',
        'REAR' => 'Rear',
      ],
    ],
    'PowerTakeOffPositionOtherDescription' => [
      'format' => 'Text200',
      'unit' => '',
      'values' => [
      ],
    ],
    'PowerTakeOffPower' => [
      'format' => 'Decimal62',
      'unit' => '',
      'values' => [
      ],
    ],
    'PowerTakeOffRatedSpeedRange' => [
      'format' => 'Text15',
      'unit' => '',
      'values' => [
      ],
    ],
    'PowerTakeOffType' => [
      'format' => 'PowerTakeOffTypeCode',
      'unit' => '',
      'values' => [
        'MNPTO' => 'Main PTO',
        'SCPTO' => 'Secundary PTO',
      ],
    ],
    'PoweredAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'PreviousStageType' => [
      'format' => 'Text15',
      'unit' => '',
      'values' => [
      ],
    ],
    'PreviousStageTypeApprovalNumber' => [
      'format' => 'Text35',
      'unit' => '',
      'values' => [
      ],
    ],
    'PreviousStageVariant' => [
      'format' => 'Text25',
      'unit' => '',
      'values' => [
      ],
    ],
    'PreviousStageVersion' => [
      'format' => 'Text35',
      'unit' => '',
      'values' => [
      ],
    ],
    'ProductionSequentialNumberSmallSeries' => [
      'format' => 'Integer4',
      'unit' => '',
      'values' => [
      ],
    ],
    'ProductionYearSmallSeries' => [
      'format' => 'Integer4',
      'unit' => '',
      'values' => [
      ],
    ],
    'ProjectedFrontalAreaAirEntranceFrontGrill' => [
      'format' => 'Integer6',
      'unit' => 'cm²',
      'values' => [
      ],
    ],
    'ProtectionPenetratingObjectsForestryIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'ProtectionPenetratingObjectsNonForestryIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'ProvisionalApprovalTerritoryCountry' => [
      'format' => 'ViennaCountryCode',
      'unit' => '',
      'values' => [
        'A' => 'Austria',
        'AL' => 'Albania',
        'AND' => 'Andorra',
        'AM' => 'Armenia',
        'AUS' => 'Australia',
        'AZ' => 'Azerbaijan',
        'B' => 'Belgium',
        'BD' => 'Bangladesh',
        'BDS' => 'Barbados',
        'BG' => 'Bulgaria',
        'BH' => 'Belize',
        'BIH' => 'Bosnia and Herzegovina',
        'BR' => 'Brazil',
        'BRN' => 'Bahrain',
        'BRU' => 'Brunei',
        'BS' => 'Bahamas',
        'BW' => 'Botswana',
        'BY' => 'Belarus',
        'C' => 'Cuba',
        'CDN' => 'Canada',
        'CGO' => 'Congo-Kinshasa',
        'CH' => 'Switzerland',
        'CI' => 'Côte d\'Ivoire',
        'CL' => 'Sri Lanka',
        'CO' => 'Colombia',
        'CR' => 'Costa Rica',
        'CV' => 'Cabo Verde',
        'CY' => 'Cyprus',
        'CZ' => 'Czechia',
        'D' => 'Germany',
        'DK' => 'Denmark',
        'DOM' => 'Dominican Republic',
        'DZ' => 'Algeria',
        'E' => 'Spain',
        'EAK' => 'Kenia',
        'EAT' => 'Tanzania',
        'EAU' => 'Uganda',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'EST' => 'Estonia',
        'F' => 'France',
        'FIN' => 'Finland',
        'FJI' => 'Fiji',
        'FL' => 'Liechtenstein',
        'FO' => 'Faeröers',
        'GBA' => 'Alderney',
        'GBG' => 'Guernsey',
        'GBJ' => 'Jersey',
        'GBM' => 'Isle of Man',
        'GBZ' => 'Gibraltar',
        'GCA' => 'Guatamala',
        'GE' => 'Georgia',
        'GH' => 'Ghana',
        'GR' => 'Greece',
        'GUY' => 'Guyana',
        'H' => 'Hungary',
        'HK' => 'Hong Kong',
        'HKJ' => 'Jordan',
        'HR' => 'Croatia',
        'I' => 'Italy',
        'IL' => 'Israel',
        'IND' => 'India',
        'IR' => 'Iran, Islamic Republic of',
        'IRL' => 'Ireland',
        'IRQ' => 'Iraq',
        'IS' => 'Iceland',
        'J' => 'Japan',
        'JA' => 'Jamaica',
        'KH' => 'Cambodia',
        'KG' => 'Kyrgyzstan',
        'KWT' => 'Kuwait',
        'KZ' => 'Kazakhstan',
        'L' => 'Luxembourg',
        'LAO' => 'Lao People\'s Democratic Republic',
        'LS' => 'Lesotho',
        'LT' => 'Lithuania',
        'LV' => 'Latvia',
        'M' => 'Malta',
        'MA' => 'Morocco',
        'MAL' => 'Malaysia',
        'MC' => 'Monaco',
        'MD' => 'Moldova, Republic of',
        'MEX' => 'Mexico',
        'MGL' => 'Mongolia',
        'MNE' => 'Montenegro',
        'MS' => 'Mauritius',
        'MW' => 'Malawi',
        'MYA' => 'Myanmar',
        'N' => 'Norway',
        'NA' => 'Netherlands Antilles',
        'NAM' => 'Namibia',
        'NIC' => 'Nicaragua',
        'NL' => 'Netherlands',
        'NZ' => 'New Zealand',
        'OM' => 'Oman',
        'P' => 'Portugal',
        'PA' => 'Panama',
        'PK' => 'Pakistan',
        'PAL' => 'Palau',
        'PE' => 'Peru',
        'PL' => 'Poland',
        'PNG' => 'Papua New Guinea',
        'PS' => 'Palestine, State of',
        'PY' => 'Paraguay',
        'RA' => 'Argentina',
        'RC' => 'Taiwan',
        'RCA' => 'Central African Republic',
        'RCB' => 'Congo-Brazzaville',
        'RCH' => 'Chile',
        'RH' => 'Haïti',
        'RI' => 'Indonesia',
        'RL' => 'Lebanon',
        'RM' => 'Madagascar',
        'RMM' => 'Mali',
        'RN' => 'Niger',
        'RO' => 'Romania',
        'ROK' => 'Republic of Korea',
        'ROU' => 'Uruguay',
        'RP' => 'Philipines',
        'RSM' => 'San Marino',
        'RUS' => 'Russia ',
        'RWA' => 'Rwanda',
        'S' => 'Sweden',
        'SD' => 'Swaziland',
        'SGP' => 'Singapore',
        'SK' => 'Slovakia',
        'SLO' => 'Slovenia',
        'SME' => 'Surinam',
        'SN' => 'Senegal',
        'SRB' => 'Serbia',
        'SY' => 'Seychelles',
        'SYR' => 'Syrian Arab Republic',
        'T' => 'Thailand',
        'TG' => 'Togo',
        'TJ' => 'Tajikistan',
        'TM' => 'Turkmenistan',
        'TN' => 'Tunisia',
        'TR' => 'Türkiye',
        'TT' => 'Trinidad and Tobago',
        'UA' => 'Ukraine',
        'UAE' => 'United Arab Emirates',
        'UK' => 'United Kingdom',
        'USA' => 'United States',
        'UZ' => 'Uzbekistan',
        'V' => 'Vatican',
        'VN' => 'Vietnam',
        'WAG' => 'Gambia',
        'WAL' => 'Sierra Leone',
        'WAN' => 'Nigeria',
        'WG' => 'Grenada',
        'WL' => 'Saint Lucia',
        'WS' => 'Samoa',
        'WV' => 'Windward Islands Saint Vincent and the Grenadines',
        'YV' => 'Venezuela',
        'Z' => 'Zambia',
        'ZA' => 'South Africa',
        'ZW' => 'Zimbabwe',
      ],
    ],
    'ProvisionalTypeApprovalIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'PureElectricVehicleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'RdeCompleteNox' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'RdeCompleteNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/km',
      'values' => [
      ],
    ],
    'RdeCompleteNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'RdeUrbanNox' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'RdeUrbanNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/km',
      'values' => [
      ],
    ],
    'RdeUrbanNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'RearOverhang' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'RearOverhangAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'RearOverhangAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'RecommendedTyrePressure' => [
      'format' => 'Decimal72',
      'unit' => '',
      'values' => [
      ],
    ],
    'Remark' => [
      'format' => 'Text2000',
      'unit' => '',
      'values' => [
      ],
    ],
    'RemarkSubjectDescription' => [
      'format' => 'RemarkSubjectDescriptionCode',
      'unit' => '',
      'values' => [
        'ADINF' => 'Additional information',
        'COMTS' => 'Comments',
        'EXEMP' => 'Exemptions',
        'RMRKS' => 'Remarks',
      ],
    ],
    'RemarkSubjectLanguage' => [
      'format' => 'EuLanguageCode',
      'unit' => '',
      'values' => [
        'bg' => 'Bulgarian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'de' => 'German',
        'el' => 'Greek',
        'en' => 'English',
        'es' => 'Spanish',
        'et' => 'Estonian',
        'fi' => 'Finnish',
        'fr' => 'French',
        'ga' => 'Irish',
        'hr' => 'Croatian',
        'hu' => 'Hungarian',
        'it' => 'Italian',
        'lt' => 'Lithuanian',
        'lv' => 'Latvian',
        'mt' => 'Maltese',
        'nl' => 'Dutch',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'ro' => 'Romanian',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'sv' => 'Swedish',
      ],
    ],
    'ReversibleDrivingPositionIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'RightLeftHandTraffic' => [
      'format' => 'RightLeftHandTrafficCode',
      'unit' => '',
      'values' => [
        'BOTH' => 'Both',
        'LEFT' => 'Left',
        'RIGHT' => 'Right',
      ],
    ],
    'RimOffSet' => [
      'format' => 'RimOffSet',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'RimSize' => [
      'format' => 'Text20',
      'unit' => '',
      'values' => [
      ],
    ],
    'RollOverProtectiveEquipment' => [
      'format' => 'RollOverProtectiveEquipmentCode',
      'unit' => '',
      'values' => [
        'CMP' => 'Compulsory',
        'OPT' => 'Optional',
        'STD' => 'Standard',
      ],
    ],
    'RollOverProtectiveFoldable' => [
      'format' => 'RollOverProtectiveFoldableCode',
      'unit' => '',
      'values' => [
        'FOLDA' => 'Foldable',
        'NFOLD' => 'Non Foldable',
      ],
    ],
    'RollOverProtectiveFoldingOperation' => [
      'format' => 'RollOverProtectiveFoldingOperationCode',
      'unit' => '',
      'values' => [
        'NNAST' => 'Non-assisted',
        'PTAST' => 'Partially assisted',
        'FLAST' => 'Fully assisted',
      ],
    ],
    'RollOverProtectiveHandOperated' => [
      'format' => 'RollOverProtectiveHandOperatedCode',
      'unit' => '',
      'values' => [
        'WTHLS' => 'With tools',
        'WTTLS' => 'Without tools',
      ],
    ],
    'RollOverProtectiveLockingMechanism' => [
      'format' => 'RollOverProtectiveLockingMechanismCode',
      'unit' => '',
      'values' => [
        'MANUL' => 'Manual',
        'AUTOM' => 'Automatic',
      ],
    ],
    'RollOverProtectiveMake' => [
      'format' => 'Text52',
      'unit' => '',
      'values' => [
      ],
    ],
    'RollOverProtectivePosition' => [
      'format' => 'RollOverProtectivePositionCode',
      'unit' => '',
      'values' => [
        'BOTH' => 'Both',
        'FRONT' => 'Front',
        'REAR' => 'Rear',
      ],
    ],
    'RollOverProtectiveStructure' => [
      'format' => 'RollOverProtectiveStructureCode',
      'unit' => '',
      'values' => [
        'CAB' => 'Cab',
        'FRA' => 'Frame',
        'ROL' => 'Roll bar',
      ],
    ],
    'RollOverProtectiveTypeApprovalNumber' => [
      'format' => 'Text120',
      'unit' => '',
      'values' => [
      ],
    ],
    'RollingResistanceClass' => [
      'format' => 'RollingResistanceClassCode',
      'unit' => '',
      'values' => [
        'A' => 'Fuel efficiency class A',
        'B' => 'Fuel efficiency class B',
        'C' => 'Fuel efficiency class C',
        'D' => 'Fuel efficiency class D',
        'E' => 'Fuel efficiency class E',
        'F' => 'Fuel efficiency class F',
        'G' => 'Fuel efficiency class G',
      ],
    ],
    'SeatingHeight' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'SeatingPositionConfiguration' => [
      'format' => 'SeatingPositionConfigurationCode',
      'unit' => '',
      'values' => [
        'SAD' => 'Saddle',
        'SEA' => 'Seat',
      ],
    ],
    'SignatureDate' => [
      'format' => 'Date',
      'unit' => '',
      'values' => [
      ],
    ],
    'SignatureLocation' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'SignerName' => [
      'format' => 'Text150',
      'unit' => '',
      'values' => [
      ],
    ],
    'SignerPosition' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'SmokeCorrectedAbsorptionCoefficient' => [
      'format' => 'Decimal95',
      'unit' => 'm⁻¹',
      'values' => [
      ],
    ],
    'SoundLevelDriveBy' => [
      'format' => 'Decimal52',
      'unit' => 'dB(A)',
      'values' => [
      ],
    ],
    'SoundLevelDriverPerceivedClosedCab' => [
      'format' => 'Decimal52',
      'unit' => 'dB(A)',
      'values' => [
      ],
    ],
    'SoundLevelDriverPerceivedOpenCab' => [
      'format' => 'Decimal52',
      'unit' => 'dB(A)',
      'values' => [
      ],
    ],
    'SoundLevelDriverPerceivedRegulation' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'SoundLevelDriverPerceivedTestMethod' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'SoundLevelExternalRegulation' => [
      'format' => 'Text50',
      'unit' => '',
      'values' => [
      ],
    ],
    'SoundLevelLimitValueLUrban' => [
      'format' => 'Decimal52',
      'unit' => 'dB(A)',
      'values' => [
      ],
    ],
    'SoundLevelStationary' => [
      'format' => 'Decimal52',
      'unit' => 'dB(A)',
      'values' => [
      ],
    ],
    'SoundLevelStationaryEngineSpeed' => [
      'format' => 'Integer5',
      'unit' => 'min⁻¹',
      'values' => [
      ],
    ],
    'SpecialPurposeDesignation' => [
      'format' => 'SpecialPurposeDesignationCode',
      'unit' => '',
      'values' => [
        'SA' => 'Motor caravan',
        'SB' => 'Armoured vehicle',
        'SC' => 'Ambulance',
        'SD' => 'Hearse',
        'SE' => 'Trailer caravan',
        'SF' => 'Mobile crane',
        'SG' => 'Special group',
        'SH' => 'Wheelchair accessible vehicle',
        'SJ' => 'Converter dolly',
        'SK' => 'Exceptional load transport trailer',
        'SL' => 'Exceptional load transport motor vehicle',
        'SM' => 'Multi-equipment carrier',
      ],
    ],
    'SpecificCo2EmissionsMass' => [
      'format' => 'Decimal95',
      'unit' => 'gCO2/tkm',
      'values' => [
      ],
    ],
    'SpecificCo2EmissionsPerson' => [
      'format' => 'Decimal95',
      'unit' => 'gCO2/pkm',
      'values' => [
      ],
    ],
    'SpeedCategorySymbol' => [
      'format' => 'SpeedCategorySymbolCode',
      'unit' => '',
      'values' => [
      ],
    ],
    'StageOfCompletion' => [
      'format' => 'StageOfCompletionCode',
      'unit' => '',
      'values' => [
        'C' => 'Complete',
        'I' => 'Incomplete',
        'V' => 'Completed',
      ],
    ],
    'SteeredAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'SteeringCategory' => [
      'format' => 'SteeringCategoryCode',
      'unit' => '',
      'values' => [
        'DIFFL' => 'Differential',
        'HYDRL' => 'Hydraulic',
        'MANUL' => 'Manual',
        'POWER' => 'Power',
        'SERVO' => 'Servo steering',
      ],
    ],
    'SubFuelType' => [
      'format' => 'SubFuelTypeCode',
      'unit' => '',
      'values' => [
        'LNG' => 'Fuel specific',
        'RH' => 'High caloric fuel (H-gas)',
        'RL' => 'Low caloric fuel (L-gas)',
        'U' => 'Universal fuel - high caloric fuel (H-gas) and low caloric fuel (L-gas)',
      ],
    ],
    'SubjectApprovalCertificateNumber' => [
      'format' => 'Text80',
      'unit' => '',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMassAxle' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMassAxleAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMassAxleAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMassAxleGroup' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumCombinationMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumLadenMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumLadenMassVariableMax' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumLadenMassVariableMin' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumMassAxleTyre' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumStaticVerticalMassCouplingPoint' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TechnicallyPermissibleMaximumTowableMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TestFamilyIdentifier' => [
      'format' => 'TestFamilyIdentifierCode',
      'unit' => '',
      'values' => [
        'ATCT' => 'ATCT family as defined in paragraph 2. of Sub-Annex 6a',
        'EV' => 'Evaporative emissions family identifier',
        'IP' => 'Interpolation family as defined in paragraph 5.6',
        'OM' => 'OBM family identifier',
        'PEMS' => 'Portable emissions management system',
        'PR' => 'Periodically regenerating systems family as defined in paragraph 5.9',
        'RL' => 'Road load family as defined in paragraph 5.7',
        'RM' => 'Road load matrix family as defined in paragraph 5.8',
      ],
    ],
    'TestFamilyIdentifierValue' => [
      'format' => 'Text100',
      'unit' => '',
      'values' => [
      ],
    ],
    'ThreePointLiftingMechanism' => [
      'format' => 'ThreePointLiftingMechanismCode',
      'unit' => '',
      'values' => [
        'BOTH' => 'Both Front and Rear mounted',
        'INEXT' => 'Inexistent',
        'FRONT' => 'Front mounted',
        'REAR' => 'Rear mounted',
      ],
    ],
    'ThreePointLiftingMechanismMaximumTowableMass' => [
      'format' => 'Integer6',
      'unit' => '',
      'values' => [
      ],
    ],
    'TrackSetBrakedIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrackSetNumber' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'TrackSetPoweredIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrackTrainCrawlerUndercarriageConfiguration' => [
      'format' => 'TrackTrainCrawlerUndercarriageConfigurationCode',
      'unit' => '',
      'values' => [
        'STF' => 'Set of traintracks at front',
        'STR' => 'Set of traintracks at rear',
        'TFR' => 'Set of traintracks at front and rear',
        'CTT' => 'Continuous tracktrain at each side of the vehicle',
      ],
    ],
    'TrackTrainNumberOfBrakedSet' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'TrackTrainNumberOfPoweredSet' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'TrackTrainSetAverageContactPressureGround' => [
      'format' => 'Decimal95',
      'unit' => 'kPa',
      'values' => [
      ],
    ],
    'TrackTrainSetLength' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TrackTrainSetMaximumPermissibleMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TrackTrainSetMaximumPermissibleMassVehicle' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TrackTrainSetMaximumPermissibleVerticalLoadOnCouplingPoint' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TrackTrainSetRollerMaximumload' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TrackTrainSetRollerNumber' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'TrackTrainSetWidth' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TrackTrainSteeringByArticulationCentreAxisDirectionIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrackTrainSteeringByArticulationCentreAxisIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrackTrainSteeringByPivotingOppositeIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrackTrainSteeringBySpeedSideIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TrailerBrakeControlSystemTechnology' => [
      'format' => 'TrailerBrakeControlSystemTechnologyCode',
      'unit' => '',
      'values' => [
        'COMPE' => 'Combination pneumatic-electric',
        'ELECT' => 'Electric',
        'HYDRL' => 'Hydraulic',
        'INERT' => 'Inertia',
        'MECHA' => 'Mechanical',
        'NONE' => 'None',
        'PNEU' => 'Pneumatic',
      ],
    ],
    'TrailerBrakePressFeedLineBraking' => [
      'format' => 'Decimal72',
      'unit' => 'kPa',
      'values' => [
      ],
    ],
    'TrailerBrakeTechnologyConnectionsType' => [
      'format' => 'TrailerBrakeTechnologyConnectionsTypeCode',
      'unit' => '',
      'values' => [
        '1LINE' => '1 Line',
        '2LINE' => '2 Line',
        'NONE' => 'None',
      ],
    ],
    'TwinWheelsAxleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'Type' => [
      'format' => 'Text15',
      'unit' => '',
      'values' => [
      ],
    ],
    'TypeApprovalIssueDate' => [
      'format' => 'Date',
      'unit' => '',
      'values' => [
      ],
    ],
    'TypeApprovalNumber' => [
      'format' => 'Text35',
      'unit' => '',
      'values' => [
      ],
    ],
    'TypeApprovalTransportDangerousGoodsClass' => [
      'format' => 'TypeApprovalTransportDangerousGoodsClassCode',
      'unit' => '',
      'values' => [
        'EX/II' => 'Explosives Transport Vehicle (Type II)',
        'EX/III' => 'Explosives Transport Vehicle (Type III)',
        'AT' => 'Tank Vehicle (Other than EX/III, FL, or OX)',
        'FL' => 'Flammable Liquids/Gases Transport Vehicle',
        'MEMU' => 'Mobile Explosives Manufacturing Unit',
      ],
    ],
    'TypeApprovalTransportDangerousGoodsIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TypeApprovalType' => [
      'format' => 'TypeApprovalTypeCode',
      'unit' => '',
      'values' => [
        'NSS' => 'National Smal Series type approval',
        'ESS' => 'European Smal Series type approval',
        'EU' => 'European whole vehicle type approval',
      ],
    ],
    'TypeICo' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeIHcNox' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeIICoAtHighIdleEngineSpeed' => [
      'format' => 'Decimal64',
      'unit' => '% vol.',
      'values' => [
      ],
    ],
    'TypeIICoAtNormalIdleSpeed' => [
      'format' => 'Decimal64',
      'unit' => '% vol.',
      'values' => [
      ],
    ],
    'TypeIIHcAtHighIdleEngineSpeed' => [
      'format' => 'Decimal95',
      'unit' => 'ppm',
      'values' => [
      ],
    ],
    'TypeIIHcAtNormalIdleEngineSpeed' => [
      'format' => 'Decimal95',
      'unit' => 'ppm',
      'values' => [
      ],
    ],
    'TypeINmhc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeINox' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeIParticulates' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeIThc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'TypeVIICo2' => [
      'format' => 'Decimal95',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'TypeVIICo2WeightedCombined' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'TypeVIIElectricRange' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'TypeVIIElectricRangeWeightedCombined' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'TypeVIIEnergyConsumption' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'TypeVIIEnergyConsumptionWeightedCombined' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'TypeVIIFuelConsumption' => [
      'format' => 'Decimal53',
      'unit' => 'l or kg/100 km',
      'values' => [
      ],
    ],
    'TypeVIIFuelConsumptionWeightedCombined' => [
      'format' => 'Decimal53',
      'unit' => 'l or kg/100 km',
      'values' => [
      ],
    ],
    'TyreAxleCombinationNumber' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'TyreAxleTrack' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TyreAxleTrackAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TyreAxleTrackAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TyreCategory' => [
      'format' => 'TyreCategoryCode',
      'unit' => '',
      'values' => [
        'C1' => 'Class C1 tyres',
        'C2' => 'Class C2 tyres',
        'C3' => 'Class C3 tyres',
      ],
    ],
    'TyreClassification' => [
      'format' => 'TyreClassificationCode',
      'unit' => '',
      'values' => [
        'F-1' => 'Tyre designed to be fitted to non-driven axles of agricultural and forestry tractors. The tread pattern generally consists of circumferential grooves and ribs.',
        'F-2' => 'Tyre designed for improved steering performance, often with a three-rib tread pattern for better directional stability.',
        'F-3' => 'Tyre for steering axles of industrial or implement vehicles, often with a ribbed tread pattern.',
        'G-1' => 'Tyre designed for forestry machines with a standard tread pattern for general forestry use.',
        'G-2' => 'Tyre designed for forestry machines with a special tread pattern for enhanced traction or flotation.',
        'G-3' => 'Tyre designed for forestry machines with a traction tread pattern, typically with pronounced lugs.',
        'I-1' => 'Tyre designed primarily for agricultural machines or implements or trailers, with a ribbed tread pattern for minimal soil disturbance.',
        'I-2' => 'Tyre designed for implements or trailers, with a block tread pattern for better grip on soft ground.',
        'I-3' => 'Tyre designed for implements or trailers, with a traction tread pattern (lugs or cleats) for improved grip.',
        'I-4' => 'Tyre designed for mixed applications, suitable for both driven and non-driven axles of implements, agricultural machinery or trailers.',
        'I-5' => 'Tyre designed for implements or trailers, with a high flotation design for reduced soil compaction.',
        'I-6' => 'Tyre designed for special implement applications, may include unique tread or construction features.',
        'LS-1' => 'Tyre designed for logging or skidder machines, standard tread for forestry operations.',
        'LS-2' => 'Tyre designed for logging or skidder machines, with a traction tread pattern for enhanced grip.',
        'LS-3' => 'Tyre designed for logging or skidder machines, with a flotation tread pattern for reduced ground pressure.',
        'LS-4' => 'Tyre designed for logging or skidder machines, special tread or construction for unique forestry conditions.',
        'R-1' => 'Tyre designed to be fitted to driven axles of agricultural tractors, suitable for sustained high torque service. The tread pattern consists of lugs or cleats.',
        'R-2' => 'Tyre designed for driven axles of tractors, with a deeper tread for use in wet or muddy conditions such as rice or cane fields.',
        'R-3' => 'Tyre designed for driven axles of tractors, with a tread pattern suitable for turf or grass, minimizing soil disturbance.',
        'R-4' => 'Tyre designed for industrial or construction applications, often marked \'IND\', with a tread pattern suitable for hard surfaces and mixed use.',
      ],
    ],
    'TyreFittedProductionIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TyreLoadRating' => [
      'format' => 'Integer5',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'TyreMaximumSpeedIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'TyreNumber' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'TyreNumberCombination' => [
      'format' => 'Integer3',
      'unit' => '',
      'values' => [
      ],
    ],
    'TyrePlyRatingNumber' => [
      'format' => 'TyrePlyRatingNumber',
      'unit' => '',
      'values' => [
      ],
    ],
    'TyreRollingRadius' => [
      'format' => 'Decimal72',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'TyreSize' => [
      'format' => 'Text20',
      'unit' => '',
      'values' => [
      ],
    ],
    'TyreTubeType' => [
      'format' => 'TyreTubeTypeCode',
      'unit' => '',
      'values' => [
        'TUBLS' => 'Tubeless',
        'TUBTP' => 'Tube type',
      ],
    ],
    'TyreType' => [
      'format' => 'TyreTypeCode',
      'unit' => '',
      'values' => [
        'AS' => 'All Seasons',
        'C' => 'Light commercial vehicle tyre',
        'CP' => 'Special tyre for motor caravans',
        'DP' => 'Dual Purpose',
        'ET' => 'Extra Tread',
        'FRT' => 'Free Rolling Tyre',
        'HL' => 'High Load capacity',
        'LT' => 'Light commercial vehicle tyre',
        'MC' => 'Motorcycle tyre',
        'ML' => 'Mining and Logging',
        'MOPED' => 'Moped tyres',
        'MPT' => 'Multi-Purpose Truck',
        'MS' => 'M+S tyre',
        'MST' => 'Multi Service Tyre',
        'POR' => 'Professional Off Road',
        'REINF' => 'Reinforced',
        'RF' => 'Runflat tyre',
        'SU' => 'Special use tyre',
        'TRAC' => 'Traction',
        'XL' => 'Extra Load',
      ],
    ],
    'VapourFilterIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'Variant' => [
      'format' => 'Text25',
      'unit' => '',
      'values' => [
      ],
    ],
    'VehicleCategory' => [
      'format' => 'VehicleCategoryCode',
      'unit' => '',
      'values' => [
        'C1a' => 'Track-laying tractors with a maximum design speed <=1150mm >600kg <=1000mm <=40km/u',
        'C1b' => 'Track-laying tractors with a maximum design speed <=1150mm >600kg <=1000mm >40km/h',
        'C2a' => 'Track-laying tractors with a maximum design speed <=1150mm >600kg <600mm <=40km/h',
        'C2b' => 'Track-laying tractors with a maximum design speed <=1150mm >600kg <600mm >40km/h',
        'C3a' => 'Track-laying tractors with a maximum design speed <=600 kg <=40km/h',
        'C3b' => 'Track-laying tractors with a maximum design speed <=600 kg >40km/h',
        'C4.1a' => 'Track-laying tractors high ground clearance with a maximum design speed <=40km/h',
        'C4.1b' => 'Track-laying tractors high ground clearance with a maximum design speed >40km/h',
        'C4.2a' => 'Track-laying tractors wide tractor with a maximum design speed <=40km/h',
        'C4.2b' => 'Track-laying tractors wide tractor with a maximum design speed >40km/h',
        'C4.3a' => 'Track-laying tractors low ground clearance with a maximum design speed <=40km/h',
        'C4.3b' => 'Track-laying tractors low ground clearance with a maximum design speed >40km/h',
        'L1e-A' => 'Powered cycle',
        'L1e-B' => 'Two-wheel moped',
        'L2e-P' => 'Three-wheel moped for passenger transport',
        'L2e-U' => 'Three-wheel moped for utility purposes',
        'L3e-A1' => 'Low-performance motorcycle',
        'L3e-A1E' => 'Low-performance motorcycle',
        'L3e-A1T' => 'Low-performance motorcycle',
        'L3e-A2' => 'Medium-performance motorcycle',
        'L3e-A2E' => 'Medium-performance motorcycle',
        'L3e-A2T' => 'Medium-performance motorcycle',
        'L3e-A3' => 'High-performance motorcycle',
        'L3e-A3E' => 'High-performance motorcycle',
        'L3e-A3T' => 'High-performance motorcycle',
        'L4e-A1' => 'Motorcycle with sidecar (low performance)',
        'L4e-A2' => 'Motorcycle with sidecar (medium performance)',
        'L4e-A3' => 'Motorcycle with sidecar (high performance)',
        'L5e-A' => 'Passenger tricycle',
        'L5e-B' => 'Utility tricycle',
        'L6e-A' => 'Light on-road quad',
        'L6e-BP' => 'Light quadri-mobile for passenger transport',
        'L6e-BU' => 'Light quadri-mobile for utility purposes',
        'L7e-A1' => 'Heavy on-road quad',
        'L7e-A2' => 'Heavy on-road quad',
        'L7e-B1' => 'Heavy all-terrain quad',
        'L7e-B2' => 'Side-by-side buggy',
        'L7e-CP' => 'Heavy quadri-mobile for passenger transport',
        'L7e-CU' => 'Heavy quadri-mobile for utility purposes',
        'M1' => 'Passenger vehicle with ≤ 8 seats + driver, ≤ 3.5 tonnes',
        'M1G' => 'Off-road passenger vehicle (M1)',
        'M1GS' => 'Armored passenger vehicle (M1)',
        'M1S' => 'Special-purpose passenger vehicle (M1)',
        'M2' => 'Passenger vehicle with > 8 seats, ≤ 5 tonnes',
        'M2G' => 'Off-road passenger vehicle (M2)',
        'M2GS' => 'Armored passenger vehicle (M2)',
        'M2S' => 'Special-purpose passenger vehicle (M2)',
        'M3' => 'Passenger vehicle with > 8 seats, > 5 tonnes',
        'M3G' => 'Off-road passenger vehicle (M3)',
        'M3GS' => 'Armored passenger vehicle (M3)',
        'M3S' => 'Special-purpose passenger vehicle (M3)',
        'N1' => 'Goods vehicle ≤ 3.5 tonnes',
        'N1G' => 'Off-road goods vehicle (N1)',
        'N1GS' => 'Armored goods vehicle (N1)',
        'N1S' => 'Special-purpose goods vehicle (N1)',
        'N2' => 'Goods vehicle > 3.5 tonnes and ≤ 12 tonnes',
        'N2G' => 'Off-road goods vehicle (N2)',
        'N2GS' => 'Armored goods vehicle (N2)',
        'N2S' => 'Special-purpose goods vehicle (N2)',
        'N3' => 'Goods vehicle > 12 tonnes',
        'N3G' => 'Off-road goods vehicle (N3)',
        'N3GS' => 'Armored goods vehicle (N3)',
        'N3S' => 'Special-purpose goods vehicle (N3)',
        'O1' => 'Trailer ≤ 0.75 tonnes',
        'O1S' => 'Special-purpose trailer (O1)',
        'O2' => 'Trailer > 0.75 tonnes and ≤ 3.5 tonnes',
        'O2S' => 'Special-purpose trailer (O2)',
        'O3' => 'Trailer > 3.5 tonnes and ≤ 10 tonnes',
        'O3S' => 'Special-purpose trailer (O3)',
        'O4' => 'Trailer > 10 tonnes',
        'O4S' => 'Special-purpose trailer (O4)',
        'R1a' => 'Light agricultural trailer',
        'R1b' => 'Light agricultural trailer',
        'R2a' => 'Medium agricultural trailer',
        'R2b' => 'Medium agricultural trailer',
        'R3a' => 'Heavy agricultural trailer',
        'R3b' => 'Heavy agricultural trailer',
        'R4a' => 'Very heavy agricultural trailer',
        'R4b' => 'Very heavy agricultural trailer',
        'S1a' => 'Light interchangeable towed equipment',
        'S1b' => 'Light interchangeable towed equipment',
        'S2a' => 'Heavy interchangeable towed equipment',
        'S2b' => 'Heavy interchangeable towed equipment',
        'T1a' => 'Wheeled tractor with high ground clearance',
        'T1b' => 'Wheeled tractor with high ground clearance',
        'T2a' => 'Narrow tractor',
        'T2b' => 'Narrow tractor',
        'T3a' => 'Small tractor',
        'T3b' => 'Small tractor',
        'T4.1a' => 'Special-purpose tractor (e.g., vineyard)',
        'T4.1b' => 'Special-purpose tractor (e.g., vineyard)',
        'T4.2a' => 'High-clearance tractor',
        'T4.2b' => 'High-clearance tractor',
        'T4.3a' => 'Low-clearance tractor',
        'T4.3b' => 'Low-clearance tractor',
      ],
    ],
    'VehicleCertified155Indicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'VehicleCertified156Indicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'VehicleClass' => [
      'format' => 'VehicleClassCode',
      'unit' => '',
      'values' => [
        'I' => 'Class I',
        'II' => 'Class II',
        'III' => 'Class III',
        'A' => 'Class A',
        'B' => 'Class B',
      ],
    ],
    'VehicleGroup' => [
      'format' => 'VehicleGroupCode',
      'unit' => '',
      'values' => [
        1 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        10 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '10v' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        11 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        111 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '111V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        112 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '112V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        113 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        12 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        121 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '121V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        122 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '122V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        123 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '123V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        124 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '124V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        125 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        126 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        13 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        131 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '131V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        132 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '132V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        133 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        14 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        141 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '141V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        142 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '142V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        143 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        15 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        16 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        17 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        18 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        19 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '1s' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        2 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        221 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        222 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        223 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        231 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        232 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        233 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        3 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31b1' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31b2' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '31e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32b' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '32f' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33b1' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33b2' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '33e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34b' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '34f' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '35a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '35b1' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '35b2' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '35c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36b' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '36f' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37b1' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37b2' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '37e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38b' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '38f' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '39a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '39b1' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '39b2' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '39c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        4 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40a' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40b' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40c' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40d' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40e' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '40f' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        421 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '421V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        422 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '422V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        423 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        431 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '431V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        432 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '432V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        433 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        441 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '441V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        442 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '442V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        443 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '4v' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        5 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        51 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        52 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        53 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        54 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        541 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        542 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        543 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        55 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        56 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '5v' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        6 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        611 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '611V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        612 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '612V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        621 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '621V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        622 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '622V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        623 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '623V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        624 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '624V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        625 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        631 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '631V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        632 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '632V' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        633 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        7 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        8 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        9 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '9v' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        31 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        32 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        33 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        34 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        35 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        36 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        37 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        38 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        39 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        40 => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
      ],
    ],
    'VehicleIdentificationNumber' => [
      'format' => 'VehicleIdentificationNumber',
      'unit' => '',
      'values' => [
      ],
    ],
    'VehicleSubgroup' => [
      'format' => 'VehicleSubgroupCode',
      'unit' => '',
      'values' => [
        '4-UD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '4-RD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '4-LH' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '9-RD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '9-LH' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '5-RD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '5-LH' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '10-RD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        '10-LH' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P31 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P31 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P32 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P32 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P33 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P33 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P34 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P34 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P35 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P35 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P36 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P36 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P37 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P37 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P38 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P38 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P39 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P39 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P40 SD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
        'P40 DD' => 'See EU 1999/62, 2017/2400 and 2019/1242 for definitions',
      ],
    ],
    'Version' => [
      'format' => 'Text35',
      'unit' => '',
      'values' => [
      ],
    ],
    'VocationalVehicleIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'VolumeOrientationIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
    'WheelBaseGroundRatio' => [
      'format' => 'Decimal32',
      'unit' => '',
      'values' => [
      ],
    ],
    'WheelBaseSideCar' => [
      'format' => 'Integer5',
      'unit' => '',
      'values' => [
      ],
    ],
    'Wheelbase' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WheelbaseAdjustableMax' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WheelbaseAdjustableMin' => [
      'format' => 'Integer5',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WhscCo' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhscCo2' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'WhscHcNox' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhscNh3' => [
      'format' => 'Decimal95',
      'unit' => 'ppm',
      'values' => [
      ],
    ],
    'WhscNmhc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhscNox' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhscNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/kWh',
      'values' => [
      ],
    ],
    'WhscNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'WhscParticulates' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhscThc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcCh4' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcCo' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcHcNox' => [
      'format' => 'Decimal95',
      'unit' => 'g/kWh',
      'values' => [
      ],
    ],
    'WhtcNh3' => [
      'format' => 'Decimal95',
      'unit' => 'ppm',
      'values' => [
      ],
    ],
    'WhtcNmhc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcNox' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcNumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/kWh',
      'values' => [
      ],
    ],
    'WhtcNumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '1/kWh',
      'values' => [
      ],
    ],
    'WhtcParticulates' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'WhtcThc' => [
      'format' => 'Decimal95',
      'unit' => 'mg/kWh',
      'values' => [
      ],
    ],
    'Width' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WidthAdjustableMax' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WidthAdjustableMin' => [
      'format' => 'Integer4',
      'unit' => 'mm',
      'values' => [
      ],
    ],
    'WltpAllElectricOffVehicleChargingRange' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpAllElectricOffVehicleChargingRangeCity' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeDepletingCombined' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeSustainingCombined' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeSustainingExtraHigh' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeSustainingHigh' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeSustainingLow' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ChargeSustainingMedium' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2Combined' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2ExtraHigh' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2High' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2Low' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2Medium' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpCo2WeightedCombined' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpEmissionTestMass' => [
      'format' => 'Integer6',
      'unit' => 'kg',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedCity' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedCombined' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedExtraHigh' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedHigh' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedLow' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedMedium' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionExternallyChargedWeightedCombined' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionPureElectricCombined' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionPureElectricExtraHigh' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionPureElectricHigh' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionPureElectricLow' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEnergyConsumptionPureElectricMedium' => [
      'format' => 'Decimal72',
      'unit' => 'Wh/km',
      'values' => [
      ],
    ],
    'WltpEquivalentAllElectricOffVehicleChargingRange' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpEquivalentAllElectricOffVehicleChargingRangeCity' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpFrontalArea' => [
      'format' => 'Decimal86',
      'unit' => 'm²',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeDepletingCombined' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeSustainingCombined' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeSustainingExtraHigh' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeSustainingHigh' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeSustainingLow' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionChargeSustainingMedium' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionCombined' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionExtraHigh' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionHigh' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionLow' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionMedium' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpFuelConsumptionWeightedCombined' => [
      'format' => 'Decimal53',
      'unit' => 'l/100km or m3/100km or kg/100km',
      'values' => [
      ],
    ],
    'WltpPureElectricRange' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpPureElectricRangeCity' => [
      'format' => 'Integer5',
      'unit' => 'km',
      'values' => [
      ],
    ],
    'WltpRoadLoadCoefficientF0' => [
      'format' => 'RoadLoadCoefficient',
      'unit' => 'N',
      'values' => [
      ],
    ],
    'WltpRoadLoadCoefficientF1' => [
      'format' => 'RoadLoadCoefficient',
      'unit' => 'N/(km/h)',
      'values' => [
      ],
    ],
    'WltpRoadLoadCoefficientF2' => [
      'format' => 'RoadLoadCoefficient',
      'unit' => 'N/(km/h)²',
      'values' => [
      ],
    ],
    'WltpTotalCo2EmissionSavedDueEcoInnovation' => [
      'format' => 'Decimal52',
      'unit' => 'g/km',
      'values' => [
      ],
    ],
    'WltpType1Co' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1Nh3' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1Nmhc' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1Nox' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1NumberOfParticles' => [
      'format' => 'Decimal95',
      'unit' => '1/km',
      'values' => [
      ],
    ],
    'WltpType1NumberOfParticlesExponent' => [
      'format' => 'Integer2',
      'unit' => '',
      'values' => [
      ],
    ],
    'WltpType1Particulates' => [
      'format' => 'Decimal95',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1Thc' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WltpType1ThcNox' => [
      'format' => 'Decimal82',
      'unit' => 'mg/km',
      'values' => [
      ],
    ],
    'WorkingPrinciple' => [
      'format' => 'WorkingPrincipleCode',
      'unit' => '',
      'values' => [
        'CMPRA' => 'Compressed air',
        'ELECT' => 'Electric',
        'EXTCI' => 'External compression ignition',
        'EXTPI' => 'External positive ignition',
        'INTCI' => 'Internal compression ignition',
        'INTPI' => 'Internal positive ignition',
        'TRBNE' => 'Turbine',
      ],
    ],
    'ZeroEmissionHeavyDutyIndicator' => [
      'format' => 'Indicator',
      'unit' => '',
      'values' => [
        'Y' => 'Yes',
        'N' => 'No',
      ],
    ],
  ],
];
