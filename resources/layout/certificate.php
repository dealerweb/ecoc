<?php

declare(strict_types=1);

/*
 * The document: which field of the data set stands where, in the order and with the numbers of the certificate of
 * conformity (Annex VIII of Regulation (EU) 2020/683). A field nobody names here is not lost: it appears under
 * "further data".
 *
 * A row: [number, template or list of templates (one line each), options]
 *   {A|B}    the value of field A or B (the name in IVI 1.x | the name in IVI 2.0), its code explained
 *   {#A}     a number      {@A} a date      {=A} a code and what it means      {^A} digits as superscript
 *   [...]    an optional part, left out when a field in it has no value
 *   %key%    the text word.key of the language
 * Options:
 *   label       the text label.<key> instead of the label of the number
 *   all         every occurrence of the field, one line each
 *   distinct    with all: the same value only once
 *   root        the field is looked up in the whole data set, also in a row of an engine or a fuel
 *   axles       a template filled for every axle: "1: 780 kg, 2: 720 kg"; spacing: the axles are named "1-2"
 *   axleGroups  the same for every axle group
 *   pairs       a list of [label, template]: a label starting with a colon is the text word.<key>
 *   expected    the model of the certificate provides the row for this powertrain (see the list "expected"): when the
 *               data set has no value, the row stays with an orange hyphen
 * ['block' => name] is a part that needs code (Render\ViewBuilder), ['table' => name] a table of the list "tables".
 */

$range = static fn (string $min, string $max, string $unit): string => '{#' . $min . '} - {#' . $max . '} ' . $unit;

$particles = static fn (string $number, string $exponent, string $unit): string => '{#' . $number . '}[ × 10{^' . $exponent . '}] ' . $unit;

return [
    'parts' => [
        'part1' => [
            'vehicle' => [
                ['0.1', '{Make}', 'all' => true],
                ['0.2', '{Type}'],
                ['', '{Variant}', 'label' => 'variant'],
                ['', '{Version}', 'label' => 'version'],
                ['0.2.1', '{CommercialName}', 'all' => true],
                ['block' => 'previousStages'],
                ['0.2.2.1', ['{#PermActualMassOfTheVehicle|AllowedActualMass} kg', $range('MinPermActualMassOfTheVehicle|AllowedActualMassMin', 'MaxPermActualMassOfTheVehicle|AllowedActualMassMax', 'kg')], 'label' => 'allowed_actual_mass'],
                ['0.2.2.1', ['{#PermTechnPermMaxLadenMass|AllowedTechnicallyPermissibleMaximumLadenMass} kg', $range('MinPermTechnPermMaxLadenMass|AllowedTechnicallyPermissibleMaximumLadenMassMin', 'MaxPermTechnPermMaxLadenMass|AllowedTechnicallyPermissibleMaximumLadenMassMax', 'kg')], 'label' => 'allowed_laden_mass'],
                ['0.2.2.1', ['{#PermissibleFrontalArea|AllowedFrontalArea} cm²', $range('MinimumPermissibleFrontalArea|AllowedFrontalAreaMin', 'MaximumPermissibleFrontalArea|AllowedFrontalAreaMax', 'cm²')], 'label' => 'allowed_frontal_area'],
                ['0.2.2.1', ['{#PermissibleRollingResistance|AllowedRollingResistance} kg/t', $range('MinimumPermRollingResistance|AllowedRollingResistanceMin', 'MaximumPermRollingResistance|AllowedRollingResistanceMax', 'kg/t')], 'label' => 'allowed_rolling_resistance'],
                ['0.2.2.1', ['{#PermProjFrontAreaAirFrontGrill|AllowedCrossSectionalAreaAirFrontGrill} cm²', $range('MinPermProjFrntArAirFrntGrill|AllowedCrossSectionalAreaAirFrontGrillMin', 'MaxPermProjFrntArAirFrntGrill|AllowedCrossSectionalAreaAirFrontGrillMax', 'cm²')], 'label' => 'allowed_grille_area'],
                ['block' => 'identifiers'],
                ['0.4', '{VehicleCategoryCode|VehicleCategory}'],
                ['block' => 'manufacturers'],
                ['block' => 'locations'],
                ['block' => 'representative'],
                ['0.10', '{VehicleIdentificationNumber}'],
                ['0.11', '{@DateOfManufactureVeh|DateManufactureVehicle}'],
            ],
            'approval' => [
                ['', '{TypeApprovalNumber}', 'label' => 'approval_number'],
                ['', '{@TypeApprovalDateOfIssue|TypeApprovalIssueDate}', 'label' => 'approval_date'],
                ['', '{@RevisionDate}', 'label' => 'revision_date'],
                ['', '{TypeApprovalTypeCode|TypeApprovalType}', 'label' => 'approval_type'],
                ['', '{ProvisionalApprovalIndicator|ProvisionalTypeApprovalIndicator}', 'label' => 'approval_provisional'],
                ['', '{StageOfCompletionCode|StageOfCompletion}', 'label' => 'stage'],
                ['', '{RightLeftHandTrafficCode|RightLeftHandTraffic}', 'label' => 'traffic'],
                ['', '{MetricImperialSpeedometerCode|MetricImperialSpeedometer}', 'label' => 'speedometer'],
                ['', '{OdometerUnitCode|MetricImperialOdometer}', 'label' => 'odometer'],
                ['', '{AllowedEuropeanMarketIndicator}', 'label' => 'european_market'],
                ['', '{IntendedCountryOfRegistrCode|IntendedCountryRegistration}', 'label' => 'intended_country'],
                ['', '{DesignatedTypeApprovalCountry}', 'label' => 'approval_country'],
                ['block' => 'signers'],
            ],
            'dataset' => [
                ['', '{VersionNumberXsd|IviVersionNumberXsd}', 'label' => 'format_version'],
                ['', '{IVIReferenceId|IviReferenceId}', 'label' => 'reference'],
                ['', '{VersionCoc|IviVersionNumber}', 'label' => 'coc_version'],
                ['', '{@VersionDateIVI|IviVersionDateTime}', 'label' => 'version_date'],
                ['block' => 'signature'],
            ],
        ],
        'part2' => [
            'general' => [
                ['1', '{NumberOfAxles}[ / {NumberOfWheels}]'],
                ['block' => 'axleRoles'],
                ['3.1', '{AutomatedVehCode|AutomatedVehicle}'],
            ],
            'dimensions' => [
                ['4', ['{Wheelbase} mm', $range('WheelbaseMinimum|WheelbaseAdjustableMin', 'WheelbaseMaximum|WheelbaseAdjustableMax', 'mm')]],
                ['4.1', 'axles' => '{AxleSpacing} mm', 'spacing' => true],
                ['5', ['{Length} mm', $range('LengthMinimum|LengthAdjustableMin', 'LengthMaximum|LengthAdjustableMax', 'mm')]],
                ['5.1', ['{MaximumPermissibleLength} mm', $range('MaximumPermissibleLengthMin', 'MaximumPermissibleLengthMax', 'mm')]],
                ['5.2', '{ElongatedCabInd|ElongatedCabineIndicator}'],
                ['5.3', '{AerodynamicVehCode|AerodynamicDeviceEquiped}'],
                ['6', ['{Width} mm', $range('WidthMinimum|WidthAdjustableMin', 'WidthMaximum|WidthAdjustableMax', 'mm')]],
                ['6.1', ['{MaximumPermissibleWidth} mm', $range('MaximumPermissibleWidthMin', 'MaximumPermissibleWidthMax', 'mm')]],
                ['7', ['{Height} mm', $range('HeightMinimum|HeightAdjustableMin', 'HeightMaximum|HeightAdjustableMax', 'mm')]],
                ['7.1', '{MaximumPermissibleHeight} mm'],
                ['8', ['{FifthWheelLead} mm', $range('FifthWheelLeadMinimum', 'FifthWheelLeadMaximum', 'mm')]],
                ['9', ['{DistFrontVehCentreCouplDev|DistanceFrontEndCentreCoupling} mm', $range('DistFrontVehCentreCouplDevMin|DistanceFrontEndCentreCouplingAdjustableMin', 'DistFrontVehCentreCouplDevMax|DistanceFrontEndCentreCouplingAdjustableMax', 'mm')]],
                ['10', ['{DistCentreCouplDevRearVeh|DistanceCentreCouplingRearEnd} mm', $range('DistCentreCouplDevRearVehMin|DistanceCentreCouplingRearEndAdjustableMin', 'DistCentreCouplDevRearVehMax|DistanceCentreCouplingRearEndAdjustableMax', 'mm')]],
                ['11', ['{LengthOfTheLoadingArea|LengthLoadingArea} mm', $range('LengthOfTheLoadingAreaMinimum|LengthLoadingAreaAdjustableMin', 'LengthOfTheLoadingAreaMaximum|LengthLoadingAreaAdjustableMax', 'mm')]],
                ['12', ['{RearOverhang} mm', $range('RearOverhangMinimum|RearOverhangAdjustableMin', 'RearOverhangMaximum|RearOverhangAdjustableMax', 'mm')]],
                ['12.1', '{MaximumPermissibleRearOverhang} mm'],
            ],
            'masses' => [
                ['13', ['{MassOfTheVehicleInRunningOrder|MassInRunningOrder} kg', $range('UnladenMassVehRunningOrderMin|MassInRunningOrderVariableMin', 'UnladenMassVehRunningOrderMax|MassInRunningOrderVariableMax', 'kg')]],
                ['13.1', 'axles' => '{DistrOfMassRunningOrderAxle|DistributionMassRunningOrderAxle} kg'],
                ['13.2', '{ActualMassOfTheVehicle|ActualMass} kg'],
                ['13.3', '{AddMassAlternativePropulsion|AdditionalMassAlternativePropulsion} kg'],
                ['', '{AdditionalMassDueToBatteries} kg', 'label' => 'mass_batteries'],
                ['14', '{MassIncompleteVehRunningOrder|MassInRunningOrderIncomplete} kg'],
                ['14.1', 'axles' => '{DistribMassIncompleteVehAxle|DistributionMassIncompleteAxle} kg'],
                ['15', '{MinMassVehCompleted|MinimumMassCompleted} kg'],
                ['15.1', 'axles' => '{DistribMassCompletedVehAxleMin|MinimalPermissibleDistributionMassCompletedAxle} kg'],
                ['16.1', ['{TechnPermMaxLadenMass|TechnicallyPermissibleMaximumLadenMass} kg', $range('TechPermMaxLadenMassMin|TechnicallyPermissibleMaximumLadenMassVariableMin', 'TechPermMaxLadenMassMax|TechnicallyPermissibleMaximumLadenMassVariableMax', 'kg')]],
                ['16.2', 'axles' => '{TechnicallyPermMassAxle|TechnicallyPermissibleMassAxle} kg'],
                ['16.3', 'axleGroups' => '{TechPermMassAxleGroup|TechnicallyPermissibleMassAxleGroup} kg'],
                ['16.4', '{TechnPermMaxMassCombination} kg'],
                ['17.1', '{MaxPermLadenMassInternational|MaxPermLadenMassNational|InServiceMaximumPermissibleLadenMass} kg', 'all' => true],
                ['17.2', 'axles' => '{MaxPermLadenMassAxleInt|MaxPermLadenMassAxleNational|InServiceMaximumPermissibleLadenMassAxle} kg'],
                ['17.3', 'axleGroups' => '{MaxPermLadenMassAxleGrInt|MaxPermLadenMassAxleGrNat|InServiceMaximumPermissibleLadenMassAxleGroup} kg'],
                ['17.4', '{MaxPermMassCombinationInt|MaxPermMassCombinationNational|InServiceMaximumPermissibleMassCombination} kg', 'all' => true],
                ['18.1', '{TechPermMaxTowMassDrawbarTrail} kg'],
                ['18.2', '{TechPermMaxTowMassSemiTrailer} kg'],
                ['18.3', '{TechPermMaxTowMassCentAxTrail} kg'],
                ['18.3.1', '{TechPermMaxTowMassRigidTrail} kg'],
                ['18.4', '{TechPermMaxTowMassUnbrTrailer} kg'],
                ['18', '{TechPermMaxTowMassBrakedTrail} kg', 'label' => 'towing_braked'],
                ['block' => 'towing'],
                ['19', '{TechPermMaxStatVertMassCouplPt|TechPermMaxStatMassCouplPoint|TechnicallyPermissibleMaximumStaticVerticalMassCouplingPoint} kg'],
            ],
            'powerplant' => [
                ['block' => 'engines'],
                ['27.3', '{#MaximumNetPowerElectricEngine|ConsolidatedMaximumNetPowerElectricEngine} kW', 'label' => 'power_net_total'],
                ['27.4', '{#MaximumContinuousRatedPowerVeh|ConsolidatedMaximum30MinutesPower} kW', 'label' => 'power_30min_total'],
                ['', '{#Maximum15MinutesPower} kW', 'label' => 'power_15min'],
                ['', '{#MaximumHourlyPower} kW', 'label' => 'power_hourly'],
                ['28', '{GearboxTypeCode|GearboxType}'],
                ['', '{NumberOfRatiosFront}[ / {NumberOfRatiosRear}]', 'label' => 'gear_count'],
                ['block' => 'gears'],
                ['28.1.1', '{#FinalDriveRatioVeh|FinalDriveVehicleRatio|FinalDriveRatio}', 'all' => true],
            ],
            'speed' => [
                ['29', '{#MaximumSpeed|MaximumSpeedNonPropulsion} km/h', 'all' => true, 'distinct' => true],
            ],
            'axles' => [
                ['30', 'axles' => '{AxleTrack} mm'],
                ['30.1', '{TrackOfEachSteeredAxle} mm', 'all' => true],
                ['30.2', '{TrackOfAllOtherAxles} mm', 'all' => true],
                ['block' => 'axleSuspension'],
                ['block' => 'tyres'],
            ],
            'brakes' => [
                ['36', '{TrailerBrakeConnectionsCode|TrailerBrakeControlSystemTechnology}[, {TrailerBrakeTechnologyConnectionsType}]'],
                ['37', ['{PressFeedLineBraking|TrailerBrakePressFeedLineBraking} kPa', '{#PressFeedLineTwoLineBraking} bar', '{#PressFeedLineSingleLineBraking} bar']],
            ],
            'bodywork' => [
                ['38', '{=CodeForBodywork}[, {NumberForBodywork|CodeForBodyworkSupplement}]'],
                ['39', '{ClassOfVehicleCode|VehicleClass}', 'all' => true],
                ['40', '{PrimaryColourCode}[ / {SecondaryColourCode}]'],
                ['40', '{Colour}', 'all' => true],
                ['41', '{NumberOfDoors}[ ({ConfigurationOfDoors})][, {NumberOfDoorsLeft}L][, {NumberOfDoorsRight}R][, {NumberOfDoorsRear}RE][, {NumberOfDoorsFront}FR]'],
                ['42', '{NrOfSeatingPositions|NumberOfSeatingPositionsIncludingDriver}'],
                ['42.1', '{SeatForUseOnlyWhenTheVehStat|NumberOfSeatsStationaryUseOnly}'],
                ['42.2', '{NrOfPassSeatingPosLowerDeck|NumberOfSeatingPositionsLowerDeck} / {NrOfPassSeatingPosUpperDeck|NumberOfSeatingPositionsUpperDeck}'],
                ['42.3', '{NrOfWheelchairUserAccessPos|NumberOfWheelchairUserAccessiblePositions}'],
                ['43', '{NumberOfStandingPlaces}'],
            ],
            'coupling' => [
                ['44', '{ApprovalNrCouplingDevice|MechanicalCouplingApprovalNumber|ApprovalMarkCouplingDevice|MechanicalCouplingApprovalMark}', 'all' => true],
                ['45', '{TypeOfCouplingDeviceFitted|MechanicalCouplingTypeCanBeFitted|MechanicalCouplingClassCanBeFitted}', 'all' => true],
                ['45.1', 'pairs' => [
                    ['D', '{#CouplingCharacteristicValueD|MechanicalCouplingValueD} kN'],
                    ['DC', '{#CouplingCharacteristicValueDC} kN'],
                    ['V', '{#CouplingCharacteristicValueV|MechanicalCouplingValueV} kN'],
                    ['S', '{#CouplingCharacteristicValueS|MechanicalCouplingValueS} kg'],
                    ['U', '{#CouplingCharacteristicValueU|MechanicalCouplingValueU} kg'],
                ]],
            ],
            'environment' => [
                ['block' => 'environment'],
                ['49.1', '{CryptHashManufacturerRecord|CryptographicHashManufacturerRecord}'],
                ['49.2', '{ZeroEmisVehInd|ZeroEmissionHeavyDutyIndicator}'],
                ['49.3', '{VocationalVehicleInd|VocationalVehicleIndicator}'],
                ['49.4', '{CryptHashCustomerFile|CryptographicHashCustomerInformationFile}'],
                ['49.5', '{#SpecificCO2Emissions|SpecificCo2EmissionsMass} gCO2/tkm', 'all' => true],
                ['49.5.1', '{#SpecificCO2EmissionsPerson|SpecificCo2EmissionsPerson} gCO2/pkm', 'all' => true],
                ['49.6', '{#AveragePayload} t'],
                ['49.6.1', '{#AverageOccupancy}'],
                ['49.7', '{VehicleGroup}[ / {VehicleSubgroupGroup|VehicleSubgroup}]'],
                ['49.8', '{CryptHashVehicleFile|CryptographicHashVehicleFile}'],
                ['49.9', '{#CargoVolume} m³'],
                ['49.10', '{VolumeOrientationInd|VolumeOrientationIndicator}'],
                ['49.11.1', '{#EfficiencyRatioKilometer}'],
                ['49.11.2', '{#EfficiencyRatioTonKilometer}'],
                ['49.11.3', '{#EfficiencyRatioM3Kilometer}'],
            ],
            'misc' => [
                ['50', '{TypeApprTranspDangerGoodsInd|TypeApprovalTransportDangerousGoodsIndicator}'],
                ['', '{TypeApprTranspDangerGoodsClass|TypeApprovalTransportDangerousGoodsClass}', 'all' => true, 'label' => 'dangerous_goods_class'],
                ['51', '{CodeForBodyworkSpecPurpVeh|SpecialPurposeDesignation}'],
                ['block' => 'remarks'],
                ['', '{AdditionalInformation}', 'label' => 'additional_information'],
                ['', '{Exemptions}', 'label' => 'exemptions'],
                ['', '{RemarksExceptions}', 'label' => 'exemptions'],
                ['54', '{=AdvancedSafetySystemCode|AdvancedSafetySystem}', 'all' => true],
                ['55', '{VehicleCertified155Indicator}'],
                ['56', '{VehicleCertified156Indicator}'],
                ['', '{TwentyFourGHzRadarInd}', 'label' => 'radar_24ghz'],
            ],
        ],
    ],

    // For every engine.
    'engine' => [
        ['20', '{ManufacturerOfTheEngine|ManufacturerEnergyConvertor}'],
        ['21', '{EngineCodeAsMarkedOnTheEngine|EnergyConvertorCodeMarkedOnEnergyConvertor}'],
        ['', '{EngineEcTypeApprovalNumber|EnergyConvertorTypeApprovalNumber}', 'label' => 'engine_approval'],
        ['', '{ElectricEngineIndicator}', 'label' => 'electric_engine'],
        ['22', '{WorkingPrincipleCode|WorkingPrinciple}[, {EngineCycleCode|CombustionCycle}]'],
        ['23', '{PureElectricVehIndicator|PureElectricVehicleIndicator|PureElectricIndicator}', 'root' => true],
        ['', '{HybridVehIndicator|HybridIndicator}', 'label' => 'hybrid', 'root' => true],
        ['', '{OffVehicleChargingVehInd|OffVehicleChargingIndicator}', 'label' => 'off_vehicle_charging', 'root' => true],
        ['23.1', '{ClassOfHybridVehicleCode|ClassHybridVehicle}', 'root' => true],
        ['23.1', '{CategoryHybridElectricVehicle}', 'label' => 'hybrid_category', 'root' => true],
        ['24', '{NumberOfCylinders}[, {ArrangementOfCylindersCode|ArrangementCylinders}]'],
        ['25', ['{#EngineCapacity} cm³', $range('EngineCapacityMin', 'EngineCapacityMax', 'cm³')]],
        ['', '{AdditionalFuelCode|AdditionalEnergySource}', 'all' => true, 'label' => 'additional_fuel'],
    ],

    // For every fuel of an engine.
    'fuel' => [
        ['26', '{FuelCode|EnergySource}[, {SubFuelType}]'],
        ['26', '{SubFuelType}', 'root' => true],
        ['26.1', '{FuelTypeCode|FuelType}', 'root' => true],
        ['26.2', '{DualFuelType}', 'root' => true],
        ['27.1', '{#MaximumNetPower|MaximumNetPowerCombustion} kW[ %at% {EngineSpeedMaximumNetPower} %rpm%][ %at% {EngineSpeedMaximumNetPowerMin} - {EngineSpeedMaximumNetPowerMax} %rpm%]'],
        ['27.3', '{#MaxNetPowerElectricEngFuel|MaximumNetPowerElectric} kW'],
        ['27.4', '{#MaximumContinuousRatedPower|Maximum30MinutesPower} kW'],
        ['', '{#Max15MinutesPowerFuel|Maximum15MinutesPower} kW', 'label' => 'power_15min'],
        ['', '{#MaxHourlyPowerFuel} kW', 'label' => 'power_hourly'],
    ],

    // For every fuel, its environmental performance.
    'fuel_environment' => [
        ['46', 'pairs' => [
            [':stationary', '{#SoundLevelStationary} dB(A)[ %at% {SoundLevelStatEngineSpeed|SoundLevelStationaryEngineSpeed} %rpm%]'],
            [':drive_by', '{#SoundLevelDriveBy} dB(A)'],
        ]],
        ['46', '{ExtSoundLevelNrBaseRegulAct|SoundLevelExternalRegulation}', 'label' => 'sound_act'],
        ['47', '{ExhaustEmissionLevelEuro}'],
        ['47', '{ExhaustEmissionLevel}', 'root' => true],
        ['47.1.1', '{#EmisTestMassWLTP|WltpEmissionTestMass} kg', 'root' => true],
        ['47.1.2', '{#FrontalAreaWLTP|WltpFrontalArea} m²', 'root' => true],
        ['47.1.2.1', '{#ProjectFrontAreaAirFrontGrill|ProjectedFrontalAreaAirEntranceFrontGrill} cm²', 'root' => true],
        ['47.1.3.0', '{#RoadLoadCoefF0WLTP|WltpRoadLoadCoefficientF0} N', 'root' => true],
        ['47.1.3.1', '{#RoadLoadCoefF1WLTP|WltpRoadLoadCoefficientF1} N/(km/h)', 'root' => true],
        ['47.1.3.2', '{#RoadLoadCoefF2WLTP|WltpRoadLoadCoefficientF2} N/(km/h)²', 'root' => true],
        ['47.2.1', '{DrivingCycleClassCode|DrivingCycleClass}', 'root' => true],
        ['47.2.2', '{#DownscalingFactor|DrivingCycleDownscalingFactor}', 'root' => true],
        ['47.2.3', '{CappedSpeedIndicator|DrivingCycleCappedSpeedIndicator}', 'root' => true],
        ['48', '{NrBaseRegulActLastAmendMotVeh}', 'label' => 'base_act'],
        ['48', '{NrBaseRegulActLastAmendEngines}', 'label' => 'base_act'],
        ['48', '{ExhaustEmissionLatestRegulationNumber}', 'label' => 'base_act', 'root' => true],
        ['', 'label' => 'test_wltp', 'pairs' => [
            ['CO', '{#TestprocWltpType1CO|WltpType1Co} mg/km'],
            ['THC', '{#TestprocWltpType1THC|WltpType1Thc} mg/km'],
            ['NMHC', '{#TestprocWltpType1NMHC|WltpType1Nmhc} mg/km'],
            ['NOx', '{#TestprocWltpType1NOx|WltpType1Nox} mg/km'],
            ['THC + NOx', '{#TestprocWltpType1THC_NOx|WltpType1ThcNox} mg/km'],
            ['NH3', '{#TestprocWltpType1NH3|WltpType1Nh3} mg/km'],
            [':particulates_mass', '{#TestprocWltpType1Particulates|WltpType1Particulates} mg/km'],
            [':particles_number', $particles('TestprocWltpType1NrOfPart|WltpType1NumberOfParticles', 'TestprocWltpType1ExPart|WltpType1NumberOfParticlesExponent', '1/km')],
        ]],
        ['', 'label' => 'test_type1', 'pairs' => [
            ['CO', '{#TestprocType1CO|TypeICo} g/km'],
            ['THC', '{#TestprocType1HC|TypeIThc} g/km'],
            ['NMHC', '{#TestprocType1NMHC|TypeINmhc} g/km'],
            ['NOx', '{#TestprocType1NOx|TypeINox} g/km'],
            ['THC + NOx', '{#TestprocType1HC_NOx|TypeIHcNox} g/km'],
            [':particulates_mass', '{#TestprocType1Particulates|TypeIParticulates} g/km'],
            [':particles_number', $particles('TestprocType1NrOfParticles', 'TestprocType1ExponentParticles', '1/km')],
        ]],
        ['', 'label' => 'test_whsc', 'pairs' => [
            ['CO', '{#TestprocWhscCO|WhscCo} mg/kWh'],
            ['THC', '{#TestprocWhscTHC|WhscHc} mg/kWh'],
            ['NMHC', '{#TestprocWhscNMHC|WhscNmhc} mg/kWh'],
            ['NOx', '{#TestprocWhscNOx|WhscNox} mg/kWh'],
            ['THC + NOx', '{#TestprocWhscHC_NOx|WhscHcNox} mg/kWh'],
            ['NH3', '{#TestprocWhscNH3|WhscNh3} ppm'],
            ['CH4', '{#TestprocWhscCH4} mg/kWh'],
            [':particulates_mass', '{#TestprocWhscParticulates|WhscParticulates} mg/kWh'],
            [':particles_number', $particles('TestprocWhscNumberOfParticles|WhscNumberOfParticles', 'TestprocWhscExponentParticles|WhscNumberOfParticlesExponent', '1/kWh')],
            ['CO2', '{#TestprocWhscCO2|WhscCo2} g/kWh'],
        ]],
        ['', 'label' => 'test_whtc', 'pairs' => [
            ['CO', '{#TestprocWhtcCO|WhtcCo} mg/kWh'],
            ['NOx', '{#TestprocWhtcNOx|WhtcNox} mg/kWh'],
            ['NMHC', '{#TestprocWhtcNMHC|WhtcNmhc} mg/kWh'],
            ['THC', '{#TestprocWhtcTHC|WhtcHc} mg/kWh'],
            ['CH4', '{#TestprocWhtcCH4|WhtcCh4} mg/kWh'],
            ['NH3', '{#TestprocWhtcNH3|WhtcNh3} ppm'],
            ['THC + NOx', '{#TestprocWhtcHC_NOx|WhtcHcNox} mg/kWh'],
            [':particulates_mass', '{#TestprocWhtcParticulates|WhtcParticulates} mg/kWh'],
            [':particles_number', $particles('TestprocWhtcNumberOfParticles|WhtcNumberOfParticles', 'TestprocWhtcExponentParticles|WhtcNumberOfParticlesExponent', '1/kWh')],
            ['CO2', '{#TestprocWhtcCO2} g/kWh'],
        ]],
        ['48.1', '{#SmokeCorrectedAbsorptionCoeff|SmokeCorrectedAbsorptionCoefficient} m⁻¹'],
        ['48.2', 'label' => 'rde_complete', 'pairs' => [
            ['NOx', '{#TestprocRdeCompleteRdeNOx|RdeCompleteNox} mg/km'],
            [':particles_number', $particles('TestprocRdeCompleteRdeNrOfPart|RdeCompleteNumberOfParticles', 'TestprocRdeCompleteRdeExpPart|RdeCompleteNumberOfParticlesExponent', '1/km')],
        ]],
        ['48.2', 'label' => 'rde_urban', 'pairs' => [
            ['NOx', '{#TestprocRdeUrbanRdeNOx|RdeUrbanNox} mg/km'],
            [':particles_number', $particles('TestprocRdeUrbanRdeNrOfPart|RdeUrbanNumberOfParticles', 'TestprocRdeUrbanRdeExpPart|RdeUrbanNumberOfParticlesExponent', '1/km')],
        ]],
        ['table' => 'wltp'],
        ['table' => 'nedc'],
        ['49.2', '{WLTPElectricRangePureElectric|WltpPureElectricRange} km', 'label' => 'range_pure', 'expected' => 'electric'],
        ['49.2', '{WLTPElectricRangeCityPureElec|WltpPureElectricRangeCity} km', 'label' => 'range_pure_city', 'expected' => 'electric'],
        ['49.4', '{#WLTPCityElecEnergyConsExtCharg|WltpEnergyConsumptionExternallyChargedCity} Wh/km', 'label' => 'energy_ovc_city', 'expected' => 'ovc'],
        ['49.5', '{WLTPElectricRangeExternCharg|WltpEquivalentAllElectricOffVehicleChargingRange} km', 'label' => 'range_ovc_eaer', 'expected' => 'ovc'],
        ['49.5', '{WLTPElectricRangeCityExtCharg|WltpEquivalentAllElectricOffVehicleChargingRangeCity} km', 'label' => 'range_ovc_eaer_city', 'expected' => 'ovc'],
        ['49.5', '{WLTPAllElecRangeExternCharg|WltpAllElectricOffVehicleChargingRange} km', 'label' => 'range_ovc_aer', 'expected' => 'ovc'],
        ['49.5', '{WLTPAllElecRangeCityExtCharg|WltpAllElectricOffVehicleChargingRangeCity} km', 'label' => 'range_ovc_aer_city', 'expected' => 'ovc'],
        ['', '{ElectricRange} km', 'label' => 'range_nedc'],
        ['', '{ElectricRangeExternChargeable} km', 'label' => 'range_nedc_ovc'],
        ['49.3.2.1', '{#TotalCO2EmisSavDueEcoInnFuel} g/km', 'label' => 'eco_savings_nedc'],
        ['49.3.2.2', '{#TotalCO2WLTPEmSavDueEcoInnFuel} g/km', 'label' => 'eco_savings'],
        ['', '{#NEDCDeviationFactor}', 'label' => 'nedc_deviation', 'root' => true],
        ['', '{NEDCVerificationFactor}', 'label' => 'nedc_verification', 'root' => true],
    ],

    // The eco-innovations of the whole vehicle: the block "environment" sets them in the order of the numbers with the values.
    'eco' => [
        ['49.3', '{VehicleFittedWithEcoInnovInd|EcoInnovationsFittedIndicator}', 'label' => 'eco_fitted'],
        ['49.3.1', '{GeneralCodeOfTheEcoInnovations|GeneralCodeEcoInnovation}[ ({EcoInnovationCountry})]', 'all' => true, 'label' => 'eco_code'],
        ['49.3.2.1', '{#TotalCO2EmisSavingDueEcoInnov} g/km', 'label' => 'eco_savings_nedc'],
        ['49.3.2.2', '{#TotalCO2WLTPEmisSavDueEcoInnov|WltpTotalCo2EmissionSavedDueEcoInnovation} g/km', 'label' => 'eco_savings'],
    ],

    'tables' => [
        'wltp' => [
            'columns' => ['low', 'medium', 'high', 'extra_high', 'combined', 'weighted'],
            'rows' => [
                'co2' => ['WLTPLowCO2|WltpCo2Low', 'WLTPMediumCO2|WltpCo2Medium', 'WLTPHighCO2|WltpCo2High', 'WLTPExtraHighCO2|WltpCo2ExtraHigh', 'WLTPCombinedCO2|WltpCo2Combined', 'WLTPWeightedCombinedCO2|WltpCo2WeightedCombined'],
                'co2_sustaining' => ['WLTPLowCO2ChargeSust|WltpCo2ChargeSustainingLow', 'WLTPMediumCO2ChargeSust|WltpCo2ChargeSustainingMedium', 'WLTPHighCO2ChargeSust|WltpCo2ChargeSustainingHigh', 'WLTPExtraHighCO2ChargeSust|WltpCo2ChargeSustainingExtraHigh', 'WLTPCombinedCO2ChargeSust|WltpCo2ChargeSustainingCombined', ''],
                'co2_depleting' => ['', '', '', '', 'WLTPCombinedCO2ChargeDepl|WltpCo2ChargeDepletingCombined', ''],
                'fuel' => ['WLTPLowFuelConsumption|WltpFuelConsumptionLow', 'WLTPMediumFuelConsumption|WltpFuelConsumptionMedium', 'WLTPHighFuelConsumption|WltpFuelConsumptionHigh', 'WLTPExtraHighFuelConsumption|WltpFuelConsumptionExtraHigh', 'WLTPCombinedFuelCons|WltpFuelConsumptionCombined', 'WLTPWeightedCombinedFuelCons|WltpFuelConsumptionWeightedCombined'],
                'fuel_sustaining' => ['WLTPLowFuelConsChargeSust|WltpFuelConsumptionChargeSustainingLow', 'WLTPMediumFuelConsChargeSust|WltpFuelConsumptionChargeSustainingMedium', 'WLTPHighFuelConsChargeSust|WltpFuelConsumptionChargeSustainingHigh', 'WLTPExtraHighFuelConsChargSust|WltpFuelConsumptionChargeSustainingExtraHigh', 'WLTPCombinedFuelConsChargeSust|WltpFuelConsumptionChargeSustainingCombined', ''],
                'fuel_depleting' => ['', '', '', '', 'WLTPCombinedFuelConsChargeDepl|WltpFuelConsumptionChargeDepletingCombined', ''],
                'energy_pure' => ['WLTPLowElecEnergyConsPureElec|WltpEnergyConsumptionPureElectricLow', 'WLTPMediumElEnergyConsPureElec|WltpEnergyConsumptionPureElectricMedium', 'WLTPHighElecEnergyConsPureElec|WltpEnergyConsumptionPureElectricHigh', 'WLTPExtrHighElecEnConsPureElec|WltpEnergyConsumptionPureElectricExtraHigh', 'WLTPElecEnergyConsPureElectric|WltpEnergyConsumptionPureElectricCombined', ''],
                'energy_ovc' => ['WLTPLowElecEnergyConsExtCharg|WltpEnergyConsumptionExternallyChargedLow', 'WLTPMediumElEnergyConsExtCharg|WltpEnergyConsumptionExternallyChargedMedium', 'WLTPHighElEnergyConsExtCharg|WltpEnergyConsumptionExternallyChargedHigh', 'WLTPExtrHighElecEnConsExtCharg|WltpEnergyConsumptionExternallyChargedExtraHigh', 'WLTPCombElEnergyConsExtCharg|WltpEnergyConsumptionExternallyChargedCombined', 'WLTPElectEnergyConsExternCharg|WltpEnergyConsumptionExternallyChargedWeightedCombined'],
            ],
        ],
        'nedc' => [
            'columns' => ['urban', 'extra_urban', 'combined', 'weighted', 'condition_a', 'condition_b'],
            'rows' => [
                'co2' => ['UrbanConditionsCO2', 'ExtraUrbanConditionsCO2', 'CombinedCO2', 'WeightedCombinedCO2', 'CombinedCO2ConditionA', 'CombinedCO2ConditionB'],
                'fuel' => ['UrbanConditionsFuelConsumption', 'ExtraUrbanConditionsFuelCons', 'CombinedFuelConsumption', 'WeightedCombinedFuelCons', 'CombinedFuelConsConditionA', 'CombinedFuelConsConditionB'],
                'energy_nedc' => ['', '', 'ElectricEnergyConsPureElectric', 'ElectricEnergyConsWeightedComb', 'ElectricEnergyConsConditionA', 'ElectricEnergyConsConditionB'],
            ],
        ],
    ],

    // What the model of the certificate provides for a powertrain (Annex VIII, the tables of point 49): the rows of the table
    // wltp with their columns. In a data set of a car or van with WLTP values, such a cell stays in its place with an orange
    // hyphen when the value is missing; the document shows what a data set delivers and fills in nothing. The rows outside the
    // table are marked with the option "expected".
    'expected' => [
        'ovc' => [
            'co2' => ['weighted'],
            'co2_sustaining' => ['low', 'medium', 'high', 'extra_high', 'combined'],
            'co2_depleting' => ['combined'],
            'fuel' => ['weighted'],
            'fuel_sustaining' => ['low', 'medium', 'high', 'extra_high', 'combined'],
            'fuel_depleting' => ['combined'],
            'energy_ovc' => ['low', 'medium', 'high', 'extra_high', 'combined', 'weighted'],
        ],
        'electric' => [
            'energy_pure' => ['low', 'medium', 'high', 'extra_high', 'combined'],
        ],
        'other' => [
            'co2' => ['low', 'medium', 'high', 'extra_high', 'combined'],
            'fuel' => ['low', 'medium', 'high', 'extra_high', 'combined'],
        ],
    ],

    // Fields that only number the elements of a table: they tell a reader nothing, so they are not listed as further data.
    'technical' => ['AxleNumberCombination', 'FinalDriveNumber', 'FinalDriveVehNumber', 'FinalDriveVehicleNumber', 'MechanicalCouplingNumber', 'MechanicalCouplingNumberTowingMasses', 'TechnAddDataGrAxleNumber', 'TyreAxleCombinationNumber', 'TyreNumberCombination'],

    // What the family identifiers of the data set are in the certificate.
    'identifiers' => ['IP' => '0.2.3.1', 'ATCT' => '0.2.3.2', 'PEMS' => '0.2.3.3', 'RL' => '0.2.3.4', 'RM' => '0.2.3.5', 'PR' => '0.2.3.6', 'EV' => '0.2.3.7'],

    // What a trailer of the data set is in the certificate.
    'trailers' => ['DB' => '18.1', 'DA' => '18.2', 'DC' => '18.3', 'DE' => '18.3.1'],

    // Liquid fuels: their consumption is stated in litres.
    'liquid_fuels' => ['10', '11', '12', '13', '14', '15', '16', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '72', '81', '82', '83', '84', '85', '86', '87'],
];
