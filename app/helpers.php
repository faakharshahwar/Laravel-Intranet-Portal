<?php

if (!function_exists('Permissions_friendly_names')) {

    function Permissions_friendly_names($p_name)
    {
        $find = array(
            'create_user',
            'edit_user',
            'read_user',
            'delete_user',
            'create_calibrated_devices',
            'edit_calibrated_devices',
            'read_calibrated_devices',
            'delete_calibrated_devices',
            'create_customer_feedback_records',
            'edit_customer_feedback_records',
            'read_customer_feedback_records',
            'delete_customer_feedback_records',
            'create_continual_improvement_records',
            'edit_continual_improvement_records',
            'read_continual_improvement_records',
            'delete_continual_improvement_records',
            'create_cpars',
            'edit_cpars',
            'read_cpars',
            'delete_cpars',
            'create_customer_satisfaction_records',
            'edit_customer_satisfaction_records',
            'read_customer_satisfaction_records',
            'delete_customer_satisfaction_records',
            'read_ncrs',
            'edit_ncrs',
            'create_ncrs',
            'delete_ncrs',
            'read_snrs',
            'edit_snrs',
            'create_snrs',
            'delete_snrs',
            'read_rars',
            'edit_rars',
            'create_rars',
            'delete_rars',
            'read_training_history',
            'edit_training_history',
            'create_training_history',
            'delete_training_history',
            'read_management_reviews',
            'edit_management_reviews',
            'create_management_reviews',
            'delete_management_reviews',
            'read_maintenance_list',
            'edit_maintenance_list',
            'create_maintenance_list',
            'delete_maintenance_list',
            'read_documents',
            'edit_documents',
            'create_documents',
            'delete_documents',
        );
        $replace = array(
            'Create User',
            'Edit User',
            'Read User',
            'Delete User',
            'Create Calibrated Devices',
            'Edit Calibrated Devices',
            'Read Calibrated Devices',
            'Delete Calibrated Devices',
            'Create Customer Feedback Records',
            'Edit Customer Feedback Records',
            'Read Customer Feedback Records',
            'Delete Customer Feedback Records',
            'Create Continual Improvement Records',
            'Edit Continual Improvement Records',
            'Read Continual Improvement Records',
            'Delete Continual Improvement Records',
            'Create CPARS',
            'Edit CPARS',
            'Read CPARS',
            'Delete CPARS',
            'Create Customer Satisfaction Records',
            'Edit Customer Satisfaction Records',
            'Read Customer Satisfaction Records',
            'Delete Customer Satisfaction Records',
            'Create NCRS',
            'Edit NCRS',
            'Read NCRS',
            'Delete NCRS',
            'Create SNRS',
            'Edit SNRS',
            'Read SNRS',
            'Delete SNRS',
            'Create RARS',
            'Edit RARS',
            'Read RARS',
            'Delete RARS',
            'Create Training History',
            'Edit Training History',
            'Read Training History',
            'Delete Training History',
            'Create Management Reviews',
            'Edit Management Reviews',
            'Read Management Reviews',
            'Delete Management Reviews',
            'Create Maintenance List',
            'Edit Maintenance List',
            'Read Maintenance List',
            'Delete Maintenance List',
            'Create Documents',
            'Edit Documents',
            'Read Documents',
            'Delete Documents',
        );
        return str_replace($find, $replace, $p_name);
    }
}

if (!function_exists('dynamicOptions')) {
    function dynamicOptions()
    {
        $optionArr = array();
        $optionArr['site'] = array(
            'Applicable to All Sites' => 'Applicable to All Sites',
            'CPAE - Dubai' => 'CPAE - Dubai',
            'CPLA - Mandeville' => 'CPLA - Mandeville',
            'CPTX - West Texas' => 'CPTX - West Texas',
            'CPUK - Aberdeen' => 'CPUK - Aberdeen',
        );
        $optionArr['calibrationCategory'] = array(
            'In-house Calibration' => 'In-house Calibration',
            'Third Party Procedures' => 'Third Party Procedures',
            'Other' => 'Other',
        );
        $optionArr['methodOfCalibration'] = array(
            'CPLA/PRC-QC-020 Calibration OD Micrometer' => 'CPLA/PRC-QC-020 Calibration OD Micrometer',
            'CPLA/PRC-QC-025 Calibration Dial Calipers' => 'CPLA/PRC-QC-025 Calibration Dial Calipers',
            'CPLA/PRC-QC-030 Calibration ID Micrometer' => 'CPLA/PRC-QC-030 Calibration ID Micrometer',
            'CPLA/PRC-QC-035 Calibration Height Micrometer' => 'CPLA/PRC-QC-035 Calibration Height Micrometer',
            'CPLA/PRC-QC-040 Calibration Depth Micrometer' => 'CPLA/PRC-QC-040 Calibration Depth Micrometer',
            'CPLA/PRC-QC-045 Calibration Altair 2X H2S Gas Monitor' => 'CPLA/PRC-QC-045 Calibration Altair 2X H2S Gas Monitor',
            'CPLA/PRC-QC-050 Calibration Dial Depth Gauge' => 'CPLA/PRC-QC-050 Calibration Dial Depth Gauge',
            'CPLA/PRC-QC-055 Calibration Height Gauge' => 'CPLA/PRC-QC-055 Calibration Height Gauge',
            'CPLA/PRC-QC-290 Calibration Gauge Certification' => 'CPLA/PRC-QC-290 Calibration Gauge Certification',
            'Third Party Procedures' => 'Third Party Procedures',
            'USE CALIBRATED 0-1 MIC TO CONFIRM MEASUREMENTS' => 'USE CALIBRATED 0-1 MIC TO CONFIRM MEASUREMENTS',
        );
        $optionArr['cparType'] = array(
            'Corrective (C)' => 'Corrective (C)',
            'Improvement (I)' => 'Improvement (I)',
            'Preventive (P)' => 'Preventive (P)',
        );
        $optionArr['nonconformanceType'] = array(
            '' => '',
            'Process' => 'Process',
            'Product' => 'Product',
        );
        $optionArr['cparReason'] = array(
            '3rd Party Registrar Nonconformances' => '3rd Party Registrar Nonconformances',
            'Audit Issues (Major or Recurring)' => 'Audit Issues (Major or Recurring)',
            'Customer Complaints (Major or Recurring)' => 'Customer Complaints (Major or Recurring)',
            'Employee Input' => 'Employee Input',
            'Management Review' => 'Management Review',
            'NCRs (Major or Recurring Trends)' => 'NCRs (Major or Recurring Trends)',
            'NCRs (Major or Recurring)' => 'NCRs (Major or Recurring)',
            'Other' => 'Other',
            'Quality System Issue' => 'Quality System Issue',
            'SNRs (Major or Recurring)' => 'SNRs (Major or Recurring)',
        );
        $optionArr['cparResultsArea'] = array(
            'Accounting' => 'Accounting',
            'All Results Areas' => 'All Results Areas',
            'Customer Service' => 'Customer Service',
            'Engineering' => 'Engineering',
            'Environmental Management System' => 'Environmental Management System',
            'Export Compliance' => 'Export Compliance',
            'Finance' => 'Finance',
            'Human Resources' => 'Human Resources',
            'Integrated Management System' => 'Integrated Management System',
            'International' => 'International',
            'Inventory' => 'Inventory',
            'Maintenance' => 'Maintenance',
            'Management' => 'Management',
            'Manufacturing' => 'Manufacturing',
            'Marketing' => 'Marketing',
            'N/A' => 'N/A',
            'Production' => 'Production',
            'Purchasing' => 'Purchasing',
            'Quality Control (In)' => 'Quality Control (In)',
            'Quality Control (Out)' => 'Quality Control (Out)',
            'Quality Management System' => 'Quality Management System',
            'Repair/Service' => 'Repair/Service',
            'Safety Management System' => 'Safety Management System',
            'Sales' => 'Sales',
            'Shipping / Receiving' => 'Shipping / Receiving',
            'Systems' => 'Systems',
            'Training' => 'Training',
        );
        $optionArr['rating'] = array(
            '1 Poor' => '1 Poor',
            '2 Fair' => '2 Fair',
            '3 Good' => '3 Good',
            '4 Very Good' => '4 Very Good',
            '5 Excellent' => '5 Excellent',
            'N/A Not Applicable' => 'N/A Not Applicable',
        );
        $optionArr['results_area'] = array(
            '' => '',
            'N/A' => 'N/A',
            'Accounting' => 'Accounting',
            'All Results Areas' => 'All Results Areas',
            'Customer Service' => 'Customer Service',
            'Engineering' => 'Engineering',
            'Environmental Management System' => 'Environmental Management System',
            'Export Compliance' => 'Export Compliance',
            'Finance' => 'Finance',
            'Human Resources' => 'Human Resources',
            'Integrated Management System' => 'Integrated Management System',
            'International' => 'International',
            'Inventory' => 'Inventory',
            'Maintenance' => 'Maintenance',
            'Management' => 'Management',
            'Manufacturing' => 'Manufacturing',
            'Marketing' => 'Marketing',
            'Production' => 'Production',
            'Purchasing' => 'Purchasing',
            'Quality Control (In)' => 'Quality Control (In)',
            'Quality Control (Out)' => 'Quality Control (Out)',
            'Quality Management System' => 'Quality Management System',
            'Repair/Service' => 'Repair/Service',
            'Safety Management System' => 'Safety Management System',
            'Sales' => 'Sales',
            'Shipping / Receiving' => 'Shipping / Receiving',
            'Systems' => 'Systems',
            'Training' => 'Training',
        );
        $optionArr['severity_scale'] = array(
            '' => '',
            '1 Harmless - No potential for harm, correctable' => '1 Harmless - No potential for harm, correctable',
            '2 Mild - Little potential for harm, easily correctable' => '2 Mild - Little potential for harm, easily correctable',
            '3 Moderate - Somewhat harmful, correctable' => '3 Moderate - Somewhat harmful, correctable',
            '4 Serious - Harmful but not potentially fatal, difficult to correct but recoverable' => '4 Serious - Harmful but not potentially fatal, difficult to correct but recoverable',
            '5 Severe/Catastrophic - Very harmful or potentially fatal; great effort to correct and recover' => '5 Severe/Catastrophic - Very harmful or potentially fatal; great effort to correct and recover',
        );
        $optionArr['likelihood_scale'] = array(
            '' => '',
            '1 Remote - Very unlikely (10 percent or less) that an aspect will result in a detectable impact' => '1 Remote - Very unlikely (10 percent or less) that an aspect will result in a detectable impact',
            '2 Low - Low probability (11 percent to 33 percent) that an aspect will result in a detectable impact' => '2 Low - Low probability (11 percent to 33 percent) that an aspect will result in a detectable impact',
            '3 Moderate - Reasonable probability (34 percent to 67 percent) that an aspect will result in a detectable impact' => '3 Moderate - Reasonable probability (34 percent to 67 percent) that an aspect will result in a detectable impact',
            '4 Likely - Strong probability (68 percent to 89 percent) that an aspect will result in a detectable impact' => '4 Likely - Strong probability (68 percent to 89 percent) that an aspect will result in a detectable impact',
            '5 Very Likely - High probability (90 percent or more) that an aspect will result in a detectable impact' => '5 Very Likely - High probability (90 percent or more) that an aspect will result in a detectable impact',
        );
        $optionArr['ncr_category'] = array(
            '' => '',
            'Appearance – Discoloration' => 'Appearance – Discoloration',
            'Appearance – Inconsistency' => 'Appearance – Inconsistency',
            'Appearance – Nicks, Scratches, Dents, Bends, Burs' => 'Appearance – Nicks, Scratches, Dents, Bends, Burs',
            'Appearance – Surface Finish' => 'Appearance – Surface Finish',
            'Appearance – Water Marks' => 'Appearance – Water Marks',
            'Calibration Issue' => 'Calibration Issue',
            'Customer Service – Poor Response Time' => 'Customer Service – Poor Response Time',
            'Delivery – Late Delivery' => 'Delivery – Late Delivery',
            'Delivery – Wrong Destination' => 'Delivery – Wrong Destination',
            'Dimensional/Orientation – Can’t Install' => 'Dimensional/Orientation – Can’t Install',
            'Dimensional/Orientation – Misalignment' => 'Dimensional/Orientation – Misalignment',
            'Dimensional/Orientation – Parallelism / Perpendicularity' => 'Dimensional/Orientation – Parallelism / Perpendicularity',
            'Documentation – Incorrect Documents' => 'Documentation – Incorrect Documents',
            'Documentation – Missing Documents' => 'Documentation – Missing Documents',
            'Documentation – Missing/Wrong Info on Documents' => 'Documentation – Missing/Wrong Info on Documents',
            'Environmental Issue' => 'Environmental Issue',
            'Forecasting Issue' => 'Forecasting Issue',
            'Inventory Error' => 'Inventory Error',
            'Machine Tool Issue' => 'Machine Tool Issue',
            'Machining Issue' => 'Machining Issue',
            'Metric Measurement Not Achieved' => 'Metric Measurement Not Achieved',
            'Other' => 'Other',
            'Package/Labeling – Incorrect Packaging' => 'Package/Labeling – Incorrect Packaging',
            'Package/Labeling – Missing/Wrong Labels' => 'Package/Labeling – Missing/Wrong Labels',
            'Package/Labeling – Torn Packaging' => 'Package/Labeling – Torn Packaging',
            'Performance – Leaks' => 'Performance – Leaks',
            'Performance – Not Working As Intended' => 'Performance – Not Working As Intended',
            'Performance – Poor Cycle Life' => 'Performance – Poor Cycle Life',
            'Performance – Weld Breaks' => 'Performance – Weld Breaks',
            'Production - Late Shipment' => 'Production - Late Shipment',
            'QC Error' => 'QC Error',
            'Receiving Error' => 'Receiving Error',
            'Rental Repair Issue' => 'Rental Repair Issue',
            'Safety Issue' => 'Safety Issue',
            'Sales - Communication Error' => 'Sales - Communication Error',
            'Sales - Order Entry Error' => 'Sales - Order Entry Error',
            'Sales – Did Not Meet Customer Needs' => 'Sales – Did Not Meet Customer Needs',
            'Sales – Poor Response Time' => 'Sales – Poor Response Time',
            'Sales – Unresponsive' => 'Sales – Unresponsive',
            'Service - Wrong Part' => 'Service - Wrong Part',
            'Service – Wrong Quantity (Over/Under)' => 'Service – Wrong Quantity (Over/Under)',
            'Shipping - Late Shipment' => 'Shipping - Late Shipment',
            'Shipping - Packaging Issue' => 'Shipping - Packaging Issue',
            'Shipping Error' => 'Shipping Error',
        );
        $optionArr['system_type'] = array(
            '' => '',
            'EMS - Environmental Management System' => 'EMS - Environmental Management System',
            'Need Data' => 'Need Data',
            'QMS - Quality Management System' => 'QMS - Quality Management System',
            'SMS - Safety Management System' => 'SMS - Safety Management System',
        );
        $optionArr['disposition_decision'] = array(
            '' => '',
            'Accept/Offer By Concession' => 'Accept/Offer By Concession',
            'Other' => 'Other',
            'Regrade' => 'Regrade',
            'Reject/Scrap' => 'Reject/Scrap',
            'Reprocess' => 'Reprocess',
            'Use As Is' => 'Use As Is',
        );
        $optionArr['supplier'] = array(
            '' => '',
            'AIP' => 'AIP',
            'Alliance Laser' => 'Alliance Laser',
            'Allied Waste (Disqualif)' => 'Allied Waste (Disqualif)',
            'American Friction Welding' => 'American Friction Welding',
            'Applied Industrial Technologies' => 'Applied Industrial Technologies',
            'Atlas Seals' => 'Atlas Seals',
            'Avon Gear & engineering Company' => 'Avon Gear & engineering Company',
            'Bodycote K-Tech, Inc.' => 'Bodycote K-Tech, Inc.',
            'BR Metals Products' => 'BR Metals Products',
            'Bray Sales' => 'Bray Sales',
            'BWB' => 'BWB',
            'CheckPoint Machine Shop' => 'CheckPoint Machine Shop',
            'Coffeyville Sektam, Inc.' => 'Coffeyville Sektam, Inc.',
            'CP Fab' => 'CP Fab',
            'CTG, Inc.' => 'CTG, Inc.',
            'Dynomach' => 'Dynomach',
            'Electropolishing Systems' => 'Electropolishing Systems',
            'Engineered Plastic Prod. Corp.' => 'Engineered Plastic Prod. Corp.',
            'EPP Corporation' => 'EPP Corporation',
            'EXCO INDUSTRIAL, INC.' => 'EXCO INDUSTRIAL, INC.',
            'Extreme Powder Coating' => 'Extreme Powder Coating',
            'Fastenal' => 'Fastenal',
            'Fusion' => 'Fusion',
            'Gage Services, Inc.' => 'Gage Services, Inc.',
            'Guico Specialty' => 'Guico Specialty',
            'Innex Industries' => 'Innex Industries',
            'Laird Plastics' => 'Laird Plastics',
            'Lewa, Inc.' => 'Lewa, Inc.',
            'Losch Machine, Inc.' => 'Losch Machine, Inc.',
            'Magnetrol' => 'Magnetrol',
            'Martin Fluid Power' => 'Martin Fluid Power',
            'Mckay Equipment' => 'Mckay Equipment',
            'Moody Price - Guico Division' => 'Moody Price - Guico Division',
            'Moseys Production Machinist\'s' => 'Moseys Production Machinist\'s',
            'NCT INC.' => 'NCT INC.',
            'Nickel Systems, Inc.' => 'Nickel Systems, Inc.',
            'OLD DOMINION FREIGHT LINE, INC' => 'OLD DOMINION FREIGHT LINE, INC',
            'Paragon Machine, LLC' => 'Paragon Machine, LLC',
            'PORE TECH. INC.' => 'PORE TECH. INC.',
            'PowerUp' => 'PowerUp',
            'Pratt Industries' => 'Pratt Industries',
            'Ryerson' => 'Ryerson',
            'Samuel Son & Co.' => 'Samuel Son & Co.',
            'SKF' => 'SKF',
            'Southern Precision' => 'Southern Precision',
            'Spartan Industrial' => 'Spartan Industrial',
            'Spinweld, Inc.' => 'Spinweld, Inc.',
            'SSP' => 'SSP',
            'Sunsource' => 'Sunsource',
            'Texas All-Steel' => 'Texas All-Steel',
            'TRES MANUFACTURING' => 'TRES MANUFACTURING',
            'Triple D Machine, Inc.' => 'Triple D Machine, Inc.',
            'Wanner Engineering, Inc.' => 'Wanner Engineering, Inc.',
            'Wenesco' => 'Wenesco',
            'Windward, Inc.' => 'Windward, Inc.',
            'Wingate Alloys, Inc.' => 'Wingate Alloys, Inc.',
            'Wurth Snider Bolt & Screw' => 'Wurth Snider Bolt & Screw',
            'AL Waleed Technical LLC, Dubai' => 'AL Waleed Technical LLC, Dubai',
            'EuroMotori S.R.L' => 'EuroMotori S.R.L',
        );

        $optionArr['department'] = array(
            '' => '',
            'Administration' => 'Administration',
            'Accounts' => 'Accounts',
            'Business Systems' => 'Business Systems',
            'Engineering' => 'Engineering',
            'Executive' => 'Executive',
            'General and Administration' => 'General and Administration',
            'Machine Shop' => 'Machine Shop',
            'Materials' => 'Materials',
            'Sales' => 'Sales',
            'Global Sales' => 'Global Sales',
            'Maintenance' => 'Maintenance',
            'Manufacturing' => 'Manufacturing',
            'Production' => 'Production',
            'Quality Control - Outgoing' => 'Quality Control - Outgoing',
            'Shipping / Receiving' => 'Shipping / Receiving',
            'Site Wide' => 'Site Wide',
        );

        $optionArr['risk_type'] = array(
            'Customer' => 'Customer',
            'External' => 'External',
            'Internal' => 'Internal',
            'Legal Regulatory' => 'Legal Regulatory',
            'Safety' => 'Safety',
            'Safety-Internal' => 'Safety-Internal',
        );

        $optionArr['risk_source'] = array(
            'Computer Hardware' => 'Computer Hardware',
            'Customer/End User' => 'Customer/End User',
            'Economy/Markets' => 'Economy/Markets',
            'Internet' => 'Internet',
            'Legal' => 'Legal',
            'Mother Nature' => 'Mother Nature',
            'Regulatory Compliance' => 'Regulatory Compliance',
            'Resources' => 'Resources',
        );

        $optionArr['risk_category'] = array(
            'Performance' => 'Performance',
            'Schedule' => 'Schedule',
            'Safety' => 'Safety',
            'External' => 'External',
            'Legal' => 'Legal',
            'Regulatory Compliance' => 'Regulatory Compliance',
            'Innovation' => 'Innovation',
        );

        $optionArr['risk_probability'] = array(
            '' => '',
            '1' => '1',
            '2' => '2',
            'N/A' => 'N/A',
        );

        $optionArr['risk_impact'] = array(
            '' => '',
            '1' => '1',
            '2' => '2',
            'N/A' => 'N/A',
        );

        $optionArr['risk_priority'] = array(
            '' => '',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            'N/A' => 'N/A',
        );

        $optionArr['training_type'] = array(
            '' => '',
            'Client Required' => 'Client Required',
            'Information Management System' => 'Information Management System',
            'Language - Spanish' => 'Language - Spanish',
            'LWCC Online' => 'LWCC Online',
            'N/A' => 'N/A',
            'New Hire Training' => 'New Hire Training',
            'On the Job Required Training' => 'On the Job Required Training',
            'Online Training Course' => 'Online Training Course',
            'Production Management System' => 'Production Management System',
            'Quality Management System' => 'Quality Management System',
            'Safety Management System' => 'Safety Management System',
            'Self Learning' => 'Self Learning',
        );

        $optionArr['audit_type'] = array(
            'ABS Recertification Audit' => 'ABS Recertification Audit',
            'ABS Surveillance Audit' => 'ABS Surveillance Audit',
            'Customer Audit' => 'Customer Audit',
            'Internal Audit' => 'Internal Audit',
            'Safety Audit' => 'Safety Audit',
            'System-Wide Audit' => 'System-Wide Audit',
            'Vendor Audit' => 'Vendor Audit',
            'External Audit' => 'External Audit',
            'Full Management System Audit' => 'Full Management System Audit',
            'Quality Management System Audit' => 'Quality Management System Audit',
        );

        $optionArr['sub_type'] = array(
            'SMS Safety Management System Audit' => 'SMS Safety Management System Audit',
            'EMS Environmental Management System Audit' => 'EMS Environmental Management System Audit',
            'SWA System-Wide Audit' => 'SWA System-Wide Audit',
            'Third-Party Audit' => 'Third-Party Audit',
            'N/A (Customer Audit)' => 'N/A (Customer Audit)',
            'Department Internal Audit' => 'Department Internal Audit',
            'Transition ISO 9001:2015 Audit' => 'Transition ISO 9001:2015 Audit',
            'QMS Processes' => 'QMS Processes',
            'QMS Surveillance Audit' => 'QMS Surveillance Audit',
        );

        $optionArr['audit_year'] = array(
            '2005' => '2005',
            '2006' => '2006',
            '2007' => '2007',
            '2008' => '2008',
            '2009' => '2009',
            '2010' => '2010',
            '2011' => '2011',
            '2012' => '2012',
            '2013' => '2013',
            '2014' => '2014',
            '2015' => '2015',
            '2016' => '2016',
            '2017' => '2017',
            '2018' => '2018',
            '2019' => '2019',
            '2020' => '2020',
            '2021' => '2021',
            '2022' => '2022',
            '2023' => '2023',
            '2024' => '2024',
            '2025' => '2025',
            '2026' => '2026',
            '2027' => '2027',
            '2028' => '2028',
            '2029' => '2029',
            '2030' => '2030',
        );

        $optionArr['status'] = array(
            '' => '',
            'Completed' => 'Completed',
            'Confirmed' => 'Confirmed',
            'Planned' => 'Planned',
        );

        $optionArr['frequency'] = array(
            'Hours - Every 0100 Hours' => 'Hours - Every 0100 Hours',
            'Hours - Every 0200 Hours' => 'Hours - Every 0200 Hours',
            'Hours - Every 0250 Hours' => 'Hours - Every 0250 Hours',
            'Hours - Every 0500 Hours' => 'Hours - Every 0500 Hours',
            'Hours - Every 1000 Hours' => 'Hours - Every 1000 Hours',
            'Hours - Every 2000 Hours' => 'Hours - Every 2000 Hours',
            'Miles - Every 03000 Miles' => 'Miles - Every 03000 Miles',
            'Miles - Every 05000 Miles' => 'Miles - Every 05000 Miles',
            'Miles - Every 06000 Miles' => 'Miles - Every 06000 Miles',
            'Miles - Every 09000 Miles' => 'Miles - Every 09000 Miles',
            'Miles - Every 10000 Miles' => 'Miles - Every 10000 Miles',
            'Miles - Every 12000 Miles' => 'Miles - Every 12000 Miles',
            'Months - Every 01 Month' => 'Months - Every 01 Month',
            'Months - Every 02 Months' => 'Months - Every 02 Months',
            'Months - Every 03 Months' => 'Months - Every 03 Months',
            'Months - Every 04 Months' => 'Months - Every 04 Months',
            'Months - Every 06 Months' => 'Months - Every 06 Months',
            'Months - Every 09 Months' => 'Months - Every 09 Months',
            'Months - Every 12 Months' => 'Months - Every 12 Months',
            'Months - Every 24 Months' => 'Months - Every 24 Months',
            'Months - Every 36 Months' => 'Months - Every 36 Months',
            'Weeks - Every 04 Weeks' => 'Weeks - Every 04 Weeks',
            'Weeks - Every 08 Weeks' => 'Weeks - Every 08 Weeks',
        );

        $optionArr['maintenance_by'] = array(
            'MACHINE SHOP PERSONNEL' => 'MACHINE SHOP PERSONNEL',
            'SHIPPING DEPT.' => 'SHIPPING DEPT.',
            'LA LIFT' => 'LA LIFT',
            'PAN AMERICAN POWER' => 'PAN AMERICAN POWER',
            'Maintenance' => 'Maintenance',
            'Deep South Equipment.' => 'Deep South Equipment.',
            'Site Safety Facilitator' => 'Site Safety Facilitator',
            'Forklift Trainer Supervisor' => 'Forklift Trainer Supervisor',
            'BRIGSS' => 'BRIGSS',
            'CAMPAT SERVICE' => 'CAMPAT SERVICE',
        );

        $optionArr['equipment_status'] = array(
            'Active' => 'Active',
            'Not Active' => 'Not Active',
            'Dispositioned As Surplus' => 'Dispositioned As Surplus',
            'Out of Service' => 'Out of Service',
        );

//        $optionArr['location'] = array(
//            '' => '',
//            'ABS Documents' => 'ABS Documents',
//            'ACM Audit Checklists Manual' => 'ACM Audit Checklists Manual',
//            'ATEX Declaration of Conformity Manual' => 'ATEX Declaration of Conformity Manual',
//            'BCP - Business Continuity Plan' => 'BCP - Business Continuity Plan',
//            'Certificate of Compliance' => 'Certificate of Compliance',
//            'Distribution Lists' => 'Distribution Lists',
//            'Distributor Information' => 'Distributor Information',
//            'ECP Export Compliance Program Manual' => 'ECP Export Compliance Program Manual',
//            'EPM Employee Policy Manual' => 'EPM Employee Policy Manual',
//            'External Safety Documents' => 'External Safety Documents',
//            'FSM Form Sample Manual' => 'FSM Form Sample Manual',
//            'IPM Integrated Procedures Manual' => 'IPM Integrated Procedures Manual',
//            'JDM Job Descriptions Manual' => 'JDM Job Descriptions Manual',
//            'Legal' => 'Legal',
//            'Marketing - Case Studies and Solution Briefs' => 'Marketing - Case Studies and Solution Briefs',
//            'Marketing - General' => 'Marketing - General',
//            'Manual' => 'Manual',
//            'Newsletters' => 'Newsletters',
//            'Objectives Measurements' => 'Objectives Measurements',
//            'OPM Operations Manual' => 'OPM Operations Manual',
//            'Parts Lists' => 'Parts Lists',
//            'POM Product Operation Manual' => 'POM Product Operation Manual',
//            'QSM Quality System Manual' => 'QSM Quality System Manual',
//            'SSM Safety System Manual' => 'SSM Safety System Manual',
//            'Table of Contents' => 'Table of Contents',
//            'Technical Support Documents' => 'Technical Support Documents',
//            'Training Packages' => 'Training Packages',
//            'Uncontrolled Safety Documents' => 'Uncontrolled Safety Documents',
//        );

        $optionArr['location'] = array(
            '' => '',
            'Accounting' => 'Accounting',
            'Administration' => 'Administration',
            'CheckPoint Engineered Solutions' => 'CheckPoint Engineered Solutions',
            'Customer Services' => 'Customer Services',
            'Export Compliance Program' => 'Export Compliance Program',
            'Engineering' => 'Engineering',
            'Environmental, Health & Safety' => 'Environmental, Health & Safety',
            'Human Resources' => 'Human Resources',
            'Integrated Mgmt. System' => 'Integrated Mgmt. System',
            'Inventory Control' => 'Inventory Control',
            'Manufacturing (Machine Shop) ' => 'Manufacturing (Machine Shop) ',
            'Management' => 'Management',
            'Maintenance' => 'Maintenance',
            'Marketing' => 'Marketing',
            'Materials Management (Inventory) ' => 'Materials Management (Inventory) ',
            'Production (Assembly & Service)' => 'Production (Assembly & Service)',
            'Purchasing' => 'Purchasing',
            'Quality Control' => 'Quality Control',
            'Quality Management Systems' => 'Quality Management Systems',
            'Safety' => 'Safety',
            'Sales' => 'Sales',
            'Service' => 'Service',
            'Shipping / Receiving' => 'Shipping / Receiving',
            'Safety Management System' => 'Safety Management System',
            'Training' => 'Training',
        );

        $optionArr['sub_location'] = array(
            '' => '',
            'ACC Accounting' => 'ACC Accounting',
            'Business Systems' => 'Business Systems',
            'CES CheckPoint Engineered Solutions' => 'CES CheckPoint Engineered Solutions',
            'CP Management Review #01 09-11-09' => 'CP Management Review #01 09-11-09',
            'CP Management Review #02 10-21-09' => 'CP Management Review #02 10-21-09',
            'CP Management Review #03 09-20-10' => 'DocuCP Management Review #03 09-20-10ments',
            'CP Management Review #04 03-03-11' => 'CP Management Review #04 03-03-11',
            'CP Management Review #05 04-12-12' => 'CP Management Review #05 04-12-12',
            'CP Management Review #06 09-10-12' => 'CP Management Review #06 09-10-12',
            'CP Management Review #07 - CP-MRV-Y13-001' => 'CP Management Review #07 - CP-MRV-Y13-001',
            'CP Management Review #08 - CP-MRV-Y14-001' => 'CP Management Review #08 - CP-MRV-Y14-001',
            'ECM' => 'ECM',
            'FSM' => 'FSM',
            'HR Human Resources' => 'HR Human Resources',
            'IMS Integrated Mgmt. System' => 'IMS Integrated Mgmt. System',
            'Internal Audit #001 QMS' => 'Internal Audit #001 QMS',
            'Internal Audit #002 SMS (Compliance Audit)' => 'Internal Audit #002 SMS (Compliance Audit)',
            'Internal Audit #003 EMS (Compliance Audit)' => 'Internal Audit #003 EMS (Compliance Audit)',
            'Internal Audit #004 - QMS - Mandeville' => 'Internal Audit #004 - QMS - Mandeville',
            'Internal Audit #005 - QMS - Mandeville' => 'Internal Audit #005 - QMS - Mandeville',
            'IPM' => 'IPM',
            'JDM' => 'JDM',
            'MFG Manufacturing' => 'MFG Manufacturing',
            'MNT Maintenance' => 'MNT Maintenance',
            'MTM Materials Management' => 'MTM Materials Management',
            'OPM' => 'OPM',
            'POM' => 'POM',
            'PRD Production' => 'PRD Production',
            'PUR Purchasing' => 'PUR Purchasing',
            'QC Quality Control' => 'QC Quality Control',
            'QMS Quality Management System' => 'QMS Quality Management System',
            'SAF Safety' => 'SAF Safety',
            'SAL Sales' => 'SAL Sales',
            'SER Servicing' => 'SER Servicing',
            'SHR Shipping Receiving' => 'SHR Shipping Receiving',
            'SSM' => 'SSM',
            'TRG Training' => 'TRG Training',
        );

//        $optionArr['document_type'] = array(
//            '' => '',
//            '_other' => '_other',
//            'ABS Documents' => 'ABS Documents',
//            'Certificate' => 'Certificate',
//            'Checklist' => 'Checklist',
//            'Distribution Lists' => 'Distribution Lists',
//            'Distributor Information' => 'Distributor Information',
//            'External Safety Documents' => 'External Safety Documents',
//            'Flowcharts' => 'Flowcharts',
//            'Forms' => 'Forms',
//            'Job Description' => 'Job Description',
//            'Marketing - Case Studies and Solution Briefs' => 'Marketing - Case Studies and Solution Briefs',
//            'Newsletters' => 'Newsletters',
//            'Objectives Measurements' => 'Objectives Measurements',
//            'Parts Lists' => 'Parts Lists',
//            'Policy Statement' => 'Policy Statement',
//            'Procedures' => 'Procedures',
//            'Product Operating Manual' => 'Product Operating Manual',
//            'Quality Policy' => 'Quality Policy',
//            'System Level Procedures' => 'System Level Procedures',
//            'Table of Contents' => 'Table of Contents',
//            'Table of Information' => 'Table of Information',
//            'Training Packages' => 'Training Packages',
//            'Vision, Values & Mission Statement' => 'Vision, Values & Mission Statement',
//        );

        $optionArr['document_type'] = array(
            '' => '',
            'ATEX Declaration Conformity' => 'ATEX Declaration Conformity',
            'Audit Checklist ' => 'Audit Checklist ',
            'Business Continuity Plan' => 'Business Continuity Plan',
            'Brochure' => 'Brochure',
            'Charts' => 'Charts',
            'Certificate of Conformity' => 'Certificate of Conformity',
            'Distribution List' => 'Distribution List',
            'Drawing' => 'Drawing',
            'Form' => 'Form',
            'Job Description' => 'Job Description',
            'Manual' => 'Manual',
            'Organization Chart' => 'Organization Chart',
            'Pump/Parts Order Guide ' => 'Pump/Parts Order Guide ',
            'Policies' => 'Policies',
            'Policy Statement' => 'Policy Statement',
            'Procedure' => 'Procedure',
            'Parts List' => 'Parts List',
            'System Level Procedure' => 'System Level Procedure',
            'Schedule' => 'Schedule',
            'Sign' => 'Sign',
            'Tags' => 'Tags',
            'Table of Information' => 'Table of Information',
            'Table of Contents' => 'Table of Contents',
            'Technical Support Document' => 'Technical Support Document',
            'Work Instruction ' => 'Work Instruction ',
        );

        $optionArr['dcr_approvers'] = array(
            'Maggie Drury' => 'Maggie Drury',
            'Angela Morere' => 'Angela Morere',
            'Leadership Team' => 'Leadership Team',
            'Devin Lovas' => 'Devin Lovas',
        );

        $optionArr['management_system'] = array(
            'All' => 'All',
            'QMS' => 'QMS',
            'EMS' => 'EMS',
            'OHSMS' => 'OHSMS',
            'Other' => 'Other',
        );

        $optionArr['external_document_type'] = array(
            'Certificate' => 'Certificate',
            'Certification' => 'Certification',
            'Customer Standard' => 'Customer Standard',
            'Industry Standard' => 'Industry Standard',
            'Insurance Documents' => 'Insurance Documents',
            'Manufacturer Standard' => 'Manufacturer Standard',
            'Miscellaneous Document' => 'Miscellaneous Document',
            'Regulatory Standard' => 'Regulatory Standard',
            'MSDS' => 'MSDS',
        );

        $optionArr['record_summary_location'] = array(
            'Accounting' => 'Accounting',
            'Administration' => 'Administration',
            'Box' => 'Box',
            'Bull Pen' => 'Bull Pen',
            'CP Intranet' => 'CP Intranet',
            'Document Control Library' => 'Document Control Library',
            'Engineering Office' => 'Engineering Office',
            'Engineering Office - Project Folder' => 'Engineering Office - Project Folder',
            'File Room' => 'File Room',
            'File Storage Room' => 'File Storage Room',
            'HR' => 'HR',
            'HR Admin' => 'HR Admin',
            'Inside Pump Boxes' => 'Inside Pump Boxes',
            'Intranet' => 'Intranet',
            'Inventory Planners Office' => 'Inventory Planners Office',
            'Inventory Product Location' => 'Inventory Product Location',
            'Maintenance' => 'Maintenance',
            'Management Representative Office' => 'Management Representative Office',
            'Marrero Office' => 'Marrero Office',
            'MAS - Accounts Receivable Module' => 'MAS - Accounts Receivable Module',
            'MAS - Purchase Order Module' => 'MAS - Purchase Order Module',
            'MAS - Sales Order Module' => 'MAS - Sales Order Module',
            'NetSuite' => 'NetSuite',
            'Preventive Maintenance Records' => 'Preventive Maintenance Records',
            'Production Mgr Office' => 'Production Mgr Office',
            'Purchasing' => 'Purchasing',
            'Purchasing Office' => 'Purchasing Office',
            'QC Office' => 'QC Office',
            'QSM' => 'QSM',
            'Quality Control' => 'Quality Control',
            'Quote Folder' => 'Quote Folder',
            'Repair Shop' => 'Repair Shop',
            'Sales' => 'Sales',
            'Sales File' => 'Sales File',
            'Server - G - drive' => 'Server - G - drive',
            'Server - G- drive' => 'Server - G- drive',
            'Server - G-Drive' => 'Server - G-Drive',
            'Supplier File' => 'Supplier File',
            'Test Bench' => 'Test Bench',
            'Upstairs File Room' => 'Upstairs File Room',
        );

        $optionArr['record_summary_type'] = array(
            'Electronic' => 'Electronic',
            'Other Media' => 'Other Media',
            'Paper' => 'Paper',
        );

        $optionArr['record_summary_file'] = array(
            'Accounting' => 'Accounting',
            'Accounts Payable Files' => 'Accounts Payable Files',
            'Accounts Receivable Files' => 'Accounts Receivable Files',
            'Accounts Receivable Module' => 'Accounts Receivable Module',
            'Box File ISO' => 'Box File ISO',
            'Box Sales' => 'Box Sales',
            'Calibration Record Binder' => 'Calibration Record Binder',
            'Calibration Records Binder' => 'Calibration Records Binder',
            'Calibration Records Manual' => 'Calibration Records Manual',
            'Certs File' => 'Certs File',
            'CFRs Database' => 'CFRs Database',
            'Closed Purchase Order Files' => 'Closed Purchase Order Files',
            'COA File' => 'COA File',
            'CP/FRM-SAL-040' => 'CP/FRM-SAL-040',
            'CP/FRM-SAL-100B' => 'CP/FRM-SAL-100B',
            'CPARs Database' => 'CPARs Database',
            'Credit Memo File' => 'Credit Memo File',
            'CSRs Database' => 'CSRs Database',
            'Current Years A/P Files by Name' => 'Current Years A/P Files by Name',
            'Custom Package Progress Sheet' => 'Custom Package Progress Sheet',
            'Customer File - Marrero' => 'Customer File - Marrero',
            'Customer Specific' => 'Customer Specific',
            'DON/INSIDE ENGINEERING PROJECTS/OPEN BIDS' => 'DON/INSIDE ENGINEERING PROJECTS/OPEN BIDS',
            'ECO Binder' => 'ECO Binder',
            'ECRs Database' => 'ECRs Database',
            'Emergency Drill Records Database' => 'Emergency Drill Records Database',
            'Employee Files' => 'Employee Files',
            'Employees benefits packet' => 'Employees benefits packet',
            'Engineering\Microsoft Project Schedules  AND  ENGINEERING OFFICE' => 'Engineering\Microsoft Project Schedules  AND  ENGINEERING OFFICE',
            'Enginereeng office - Project Master List' => 'Enginereeng office - Project Master List',
            'EQRs Database' => 'EQRs Database',
            'EWA Binders' => 'EWA Binders',
            'EWA - Respective project name' => 'EWA - Respective project name',
            'File Box - PE,DE,WO,RCG, ROG,TRF,RMA' => 'File Box - PE,DE,WO,RCG, ROG,TRF,RMA',
            'Final Inspection & Test Record Binder' => 'Final Inspection & Test Record Binder',
            'Fork Lift Inspections Manual' => 'Fork Lift Inspections Manual',
            'Form Sample Manual' => 'Form Sample Manual',
            'IARs Database' => 'IARs Database',
            'Inventory Control Card Box' => 'Inventory Control Card Box',
            'Maintenance Binder' => 'Maintenance Binder',
            'Maintenance Manual' => 'Maintenance Manual',
            'Maintenance Records' => 'Maintenance Records',
            'Management Meeting Binder' => 'Management Meeting Binder',
            'Management Review Manual' => 'Management Review Manual',
            'Metrics Measurement Database' => 'Metrics Measurement Database',
            'N/A' => 'N/A',
            'NCR Binder' => 'NCR Binder',
            'NCRs Database' => 'NCRs Database',
            'NetSuite Customer' => 'NetSuite Customer',
            'New Inventory Items Folder' => 'New Inventory Items Folder',
            'OSHA file (by relevant year)' => 'OSHA file (by relevant year)',
            'Personnel Records' => 'Personnel Records',
            'PO File' => 'PO File',
            'Posted' => 'Posted',
            'Preventive Maintenance Records' => 'Preventive Maintenance Records',
            'Product Control' => 'Product Control',
            'Production Quality Binder' => 'Production Quality Binder',
            'Purchase Files' => 'Purchase Files',
            'Purchase Order File Folder' => 'Purchase Order File Folder',
            'Purchase Order Files' => 'Purchase Order Files',
            'Purchase Order Files - Open' => 'Purchase Order Files - Open',
            'Purchase Order Folder' => 'Purchase Order Folder',
            'Purchase Order Module' => 'Purchase Order Module',
            'Qualified Auditors List' => 'Qualified Auditors List',
            'Quote' => 'Quote',
            'Quote File (as needed)' => 'Quote File (as needed)',
            'Receiving Files - General' => 'Receiving Files - General',
            'Records Binder' => 'Records Binder',
            'Rental Binder' => 'Rental Binder',
            'Safety Files' => 'Safety Files',
            'Safety Records Binder' => 'Safety Records Binder',
            'Sales Order Files' => 'Sales Order Files',
            'Sales Order Folder' => 'Sales Order Folder',
            'SNRs Database' => 'SNRs Database',
            'SQRs Database' => 'SQRs Database',
            'Time and Labor Folder' => 'Time and Labor Folder',
            'Time Records (by relevant year)' => 'Time Records (by relevant year)',
            'Tool List Binder' => 'Tool List Binder',
            'Training History Database' => 'Training History Database',
            'Training Manual Binder' => 'Training Manual Binder',
            'Training Records Manual' => 'Training Records Manual',
            'Work Order Folder' => 'Work Order Folder',
            'Work Order Priority Binder' => 'Work Order Priority Binder',
        );

        $optionArr['record_summary_maintained_by'] = array(
            'Accounting Assistant' => 'Accounting Assistant',
            'Accounting staff' => 'Accounting staff',
            'Accounts Payable Rep.' => 'Accounts Payable Rep.',
            'Accounts Receivable Rep.' => 'Accounts Receivable Rep.',
            'Administrative Assistant' => 'Administrative Assistant',
            'Administrative Representative' => 'Administrative Representative',
            'Assembly Tech' => 'Assembly Tech',
            'Calibration Coordinator' => 'Calibration Coordinator',
            'Customer Service Rep.' => 'Customer Service Rep.',
            'Devin Lovas' => 'Devin Lovas',
            'Engineering Staff' => 'Engineering Staff',
            'Equipment Users' => 'Equipment Users',
            'Export Compliance Officer' => 'Export Compliance Officer',
            'General Accounting Specialist' => 'General Accounting Specialist',
            'HR Manager' => 'HR Manager',
            'Inventory Logistics' => 'Inventory Logistics',
            'Inventory Planner' => 'Inventory Planner',
            'Inventory Planner/ Purchasing Agent' => 'Inventory Planner/ Purchasing Agent',
            'Kirk Haik' => 'Kirk Haik',
            'Maintenance Coordinator' => 'Maintenance Coordinator',
            'Production Manager' => 'Production Manager',
            'Production Tech' => 'Production Tech',
            'Production Tech. & Quality Assurance Tech.' => 'Production Tech. & Quality Assurance Tech.',
            'Purchasing Agent' => 'Purchasing Agent',
            'Purchasing Representative' => 'Purchasing Representative',
            'Purchasing/Receiving/Inventory' => 'Purchasing/Receiving/Inventory',
            'QC Representative' => 'QC Representative',
            'Quality Control Rep.' => 'Quality Control Rep.',
            'Quality Control Tech.' => 'Quality Control Tech.',
            'Quality Management Rep' => 'Quality Management Rep',
            'Quality Mgmt Rep' => 'Quality Mgmt Rep',
            'Receiving Rep.' => 'Receiving Rep.',
            'Repair Tech' => 'Repair Tech',
            'Repair Tech.' => 'Repair Tech.',
            'Sales Operations Rep' => 'Sales Operations Rep',
            'Sales Representative' => 'Sales Representative',
            'Shipping and Receiving' => 'Shipping and Receiving',
            'Site Document Coordinator' => 'Site Document Coordinator',
            'Site Mgmt. Rep.' => 'Site Mgmt. Rep.',
            'Site Safety Facilitator' => 'Site Safety Facilitator',
            'Site. Mgmt. Rep.' => 'Site. Mgmt. Rep.',
        );

        $optionArr['record_summary_minimum_retention'] = array(
            '1 Year' => '1 Year',
            '20 Years' => '20 Years',
            '3 Years' => '3 Years',
            '3 Years or when form changes' => '3 Years or when form changes',
            '5 Years or When Form Changes' => '5 Years or When Form Changes',
            '7 Years' => '7 Years',
            'Consistent with Safety records retention guidelines.' => 'Consistent with Safety records retention guidelines.',
            'Do not discard' => 'Do not discard',
            'Employment +5 years' => 'Employment +5 years',
            'Length Of Employ. + 2 Yrs.' => 'Length Of Employ. + 2 Yrs.',
            'Length Of Employ. + 5 Yrs.' => 'Length Of Employ. + 5 Yrs.',
            'N/A' => 'N/A',
            'Need Data' => 'Need Data',
            'Until Revised' => 'Until Revised',
        );

        $optionArr['record_summary_record_status'] = array(
            'Active' => 'Active',
            'Not Active' => 'Not Active',
        );

        $optionArr['type_of_emergency_simulated'] = array(
            'Electrical Outage Drill' => 'Electrical Outage Drill',
            'Fire Drill' => 'Fire Drill',
            'Hazardous Waste' => 'Hazardous Waste',
            'Hurricane Drill' => 'Hurricane Drill',
            'Other' => 'Other',
            'Terrorism Drill' => 'Terrorism Drill',
            'Tornado Drill' => 'Tornado Drill',
        );

        $optionArr['notification_used'] = array(
            'Email' => 'Email',
            'Instant Power Outage' => 'Instant Power Outage',
            'PA System & Verbal Announcement' => 'PA System & Verbal Announcement',
            'Paging System' => 'Paging System',
            'Paging System/Verbal Announcement' => 'Paging System/Verbal Announcement',
            'Verbal Announcement' => 'Verbal Announcement',
        );

        $optionArr['auditor_status'] = array(
            'Auditor' => 'Auditor',
            'Auditor - Inactive' => 'Auditor - Inactive',
            'Auditor-In-Training' => 'Auditor-In-Training',
            'Auditor-In-Training - Inactive' => 'Auditor-In-Training - Inactive',
            'Lead Auditor' => 'Lead Auditor',
            'Lead Auditor - Inactive' => 'Lead Auditor - Inactive',
        );

        $optionArr['qualification_basis'] = array(
            'Certified Manufacturing Engineer' => 'Certified Manufacturing Engineer',
            'Certified Quality Auditor' => 'Certified Quality Auditor',
            'Certified Quality Manager' => 'Certified Quality Manager',
            'Environmental Management System Auditor' => 'Environmental Management System Auditor',
            'External Training' => 'External Training',
            'Internal Auditor Training By Synergistic Systems' => 'Internal Auditor Training By Synergistic Systems',
            'Internal Training' => 'Internal Training',
            'ISO / TS Lead Auditor' => 'ISO / TS Lead Auditor',
            'N/A Not Applicable' => 'N/A Not Applicable',
            'Quality Management System Auditor' => 'Quality Management System Auditor',
        );

        $optionArr['report_type'] = array(
            'Monthly Safety Inspection' => 'Monthly Safety Inspection',
            'External Service ' => 'External Service',
        );

        $optionArr['efr_type'] = array(
            'Complaint' => 'Complaint',
            'Compliment' => 'Compliment',
            'Suggestion' => 'Suggestion',
        );

        $optionArr['agency_type'] = array(
            '' => '',
            'City' => 'City',
            'Federal' => 'Federal',
            'Other' => 'Other',
            'Parish' => 'Parish',
            'State' => 'State',
        );

        $optionArr['site_url'] = array(
            'base_url' => 'https://cppumpsdb.com',
        );

        $optionArr['countries'] = array(
            'Afghanistan' => 'Afghanistan',
            'Albania' => 'Albania',
            'Algeria' => 'Algeria',
            'Andorra' => 'Andorra',
            'Angola' => 'Angola',
            'Antigua and Barbuda' => 'Antigua and Barbuda',
            'Argentina' => 'Argentina',
            'Armenia' => 'Armenia',
            'Australia' => 'Australia',
            'Austria' => 'Austria',
            'Azerbaijan' => 'Azerbaijan',
            'Bahamas' => 'Bahamas',
            'Bahrain' => 'Bahrain',
            'Bangladesh' => 'Bangladesh',
            'Barbados' => 'Barbados',
            'Belarus' => 'Belarus',
            'Belgium' => 'Belgium',
            'Belize' => 'Belize',
            'Benin' => 'Benin',
            'Bhutan' => 'Bhutan',
            'Bolivia' => 'Bolivia',
            'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
            'Botswana' => 'Botswana',
            'Brazil' => 'Brazil',
            'Brunei' => 'Brunei',
            'Bulgaria' => 'Bulgaria',
            'Burkina Faso' => 'Burkina Faso',
            'Burundi' => 'Burundi',
            'Cabo Verde' => 'Cabo Verde',
            'Cambodia' => 'Cambodia',
            'Cameroon' => 'Cameroon',
            'Canada' => 'Canada',
            'Central African Republic' => 'Central African Republic',
            'Chad' => 'Chad',
            'Chile' => 'Chile',
            'China' => 'China',
            'Colombia' => 'Colombia',
            'Comoros' => 'Comoros',
            'Congo (Congo-Brazzaville)' => 'Congo (Congo-Brazzaville)',
            'Costa Rica' => 'Costa Rica',
            'Croatia' => 'Croatia',
            'Cuba' => 'Cuba',
            'Cyprus' => 'Cyprus',
            'Czechia (Czech Republic)' => 'Czechia (Czech Republic)',
            'Democratic Republic of the Congo' => 'Democratic Republic of the Congo',
            'Denmark' => 'Denmark',
            'Djibouti' => 'Djibouti',
            'Dominica' => 'Dominica',
            'Dominican Republic' => 'Dominican Republic',
            'Ecuador' => 'Ecuador',
            'Egypt' => 'Egypt',
            'El Salvador' => 'El Salvador',
            'Equatorial Guinea' => 'Equatorial Guinea',
            'Eritrea' => 'Eritrea',
            'Estonia' => 'Estonia',
            'Eswatini (fmr. Swaziland)' => 'Eswatini (fmr. Swaziland)',
            'Ethiopia' => 'Ethiopia',
            'Fiji' => 'Fiji',
            'Finland' => 'Finland',
            'France' => 'France',
            'Gabon' => 'Gabon',
            'Gambia' => 'Gambia',
            'Georgia' => 'Georgia',
            'Germany' => 'Germany',
            'Ghana' => 'Ghana',
            'Greece' => 'Greece',
            'Grenada' => 'Grenada',
            'Guatemala' => 'Guatemala',
            'Guinea' => 'Guinea',
            'Guinea-Bissau' => 'Guinea-Bissau',
            'Guyana' => 'Guyana',
            'Haiti' => 'Haiti',
            'Holy See' => 'Holy See',
            'Honduras' => 'Honduras',
            'Hungary' => 'Hungary',
            'Iceland' => 'Iceland',
            'India' => 'India',
            'Indonesia' => 'Indonesia',
            'Iran' => 'Iran',
            'Iraq' => 'Iraq',
            'Ireland' => 'Ireland',
            'Israel' => 'Israel',
            'Italy' => 'Italy',
            'Jamaica' => 'Jamaica',
            'Japan' => 'Japan',
            'Jordan' => 'Jordan',
            'Kazakhstan' => 'Kazakhstan',
            'Kenya' => 'Kenya',
            'Kiribati' => 'Kiribati',
            'Kuwait' => 'Kuwait',
            'Kyrgyzstan' => 'Kyrgyzstan',
            'Laos' => 'Laos',
            'Latvia' => 'Latvia',
            'Lebanon' => 'Lebanon',
            'Lesotho' => 'Lesotho',
            'Liberia' => 'Liberia',
            'Libya' => 'Libya',
            'Liechtenstein' => 'Liechtenstein',
            'Lithuania' => 'Lithuania',
            'Luxembourg' => 'Luxembourg',
            'Madagascar' => 'Madagascar',
            'Malawi' => 'Malawi',
            'Malaysia' => 'Malaysia',
            'Maldives' => 'Maldives',
            'Mali' => 'Mali',
            'Malta' => 'Malta',
            'Marshall Islands' => 'Marshall Islands',
            'Mauritania' => 'Mauritania',
            'Mauritius' => 'Mauritius',
            'Mexico' => 'Mexico',
            'Micronesia' => 'Micronesia',
            'Moldova' => 'Moldova',
            'Monaco' => 'Monaco',
            'Mongolia' => 'Mongolia',
            'Montenegro' => 'Montenegro',
            'Morocco' => 'Morocco',
            'Mozambique' => 'Mozambique',
            'Myanmar (Burma)' => 'Myanmar (Burma)',
            'Namibia' => 'Namibia',
            'Nauru' => 'Nauru',
            'Nepal' => 'Nepal',
            'Netherlands' => 'Netherlands',
            'New Zealand' => 'New Zealand',
            'Nicaragua' => 'Nicaragua',
            'Niger' => 'Niger',
            'Nigeria' => 'Nigeria',
            'North Korea' => 'North Korea',
            'North Macedonia' => 'North Macedonia',
            'Norway' => 'Norway',
            'Oman' => 'Oman',
            'Pakistan' => 'Pakistan',
            'Palau' => 'Palau',
            'Palestine State' => 'Palestine State',
            'Panama' => 'Panama',
            'Papua New Guinea' => 'Papua New Guinea',
            'Paraguay' => 'Paraguay',
            'Peru' => 'Peru',
            'Philippines' => 'Philippines',
            'Poland' => 'Poland',
            'Portugal' => 'Portugal',
            'Qatar' => 'Qatar',
            'Romania' => 'Romania',
            'Russia' => 'Russia',
            'Rwanda' => 'Rwanda',
            'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
            'Saint Lucia' => 'Saint Lucia',
            'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
            'Samoa' => 'Samoa',
            'San Marino' => 'San Marino',
            'Sao Tome and Principe' => 'Sao Tome and Principe',
            'Saudi Arabia' => 'Saudi Arabia',
            'Senegal' => 'Senegal',
            'Serbia' => 'Serbia',
            'Seychelles' => 'Seychelles',
            'Sierra Leone' => 'Sierra Leone',
            'Singapore' => 'Singapore',
            'Slovakia' => 'Slovakia',
            'Slovenia' => 'Slovenia',
            'Solomon Islands' => 'Solomon Islands',
            'Somalia' => 'Somalia',
            'South Africa' => 'South Africa',
            'South Korea' => 'South Korea',
            'South Sudan' => 'South Sudan',
            'Spain' => 'Spain',
            'Sri Lanka' => 'Sri Lanka',
            'Sudan' => 'Sudan',
            'Suriname' => 'Suriname',
            'Sweden' => 'Sweden',
            'Switzerland' => 'Switzerland',
            'Syria' => 'Syria',
            'Tajikistan' => 'Tajikistan',
            'Tanzania' => 'Tanzania',
            'Thailand' => 'Thailand',
            'Timor-Leste' => 'Timor-Leste',
            'Togo' => 'Togo',
            'Tonga' => 'Tonga',
            'Trinidad and Tobago' => 'Trinidad and Tobago',
            'Tunisia' => 'Tunisia',
            'Turkey' => 'Turkey',
            'Turkmenistan' => 'Turkmenistan',
            'Tuvalu' => 'Tuvalu',
            'Uganda' => 'Uganda',
            'Ukraine' => 'Ukraine',
            'United Arab Emirates' => 'United Arab Emirates',
            'United Kingdom' => 'United Kingdom',
            'United States of America' => 'United States of America',
            'Uruguay' => 'Uruguay',
            'Uzbekistan' => 'Uzbekistan',
            'Vanuatu' => 'Vanuatu',
            'Venezuela' => 'Venezuela',
            'Vietnam' => 'Vietnam',
            'Yemen' => 'Yemen',
            'Zambia' => 'Zambia',
            'Zimbabwe' => 'Zimbabwe'
        );

        $optionArr['travel_type'] = array(
            'Business' => 'Business',
            'Training' => 'Training',
            'Event' => 'Event',
            'Annual Leaves' => 'Annual Leaves',
            'Other' => 'Other',
        );

        $optionArr['mode_of_travel'] = array(
            'By Air' => 'By Air',
            'By Road' => 'By Road',
        );

        $optionArr['travel_attachments'] = array(
            'Tickets' => 'Tickets',
            'Hotel Confirmations' => 'Hotel Confirmations',
            'Visa Documents' => 'Visa Documents',
        );

        if (app()->environment('local')) {
            $optionArr['hr_email'] = [
                'faakharshahwar@gmail.com' => 'faakharshahwar@gmail.com',
            ];
        } else {
            $optionArr['hr_email'] = [
                'mayantonette@cppumps.com' => 'mayantonette@cppumps.com',
            ];
        }

        return $optionArr;
    }
}

if (!function_exists('externalLinks')) {
    function externalLinks()
    {
        $externalLinks = array(
            'CheckPoint Pumps and Systems Web Site' => 'https://cppumps.com/',
            'Electronic General Training Record' => 'http://www.formdesk.com/e-ssy/CP-TRR-GEN-005',
        );

        return $externalLinks;
    }
}

if (!function_exists('getLastTenYears')) {
    function getLastTenYears()
    {
        $currentYear = date('Y');
        $years = [];

        for ($i = 10; $i > 0; $i--) {
            $year = $currentYear - $i;
            $years[$year] = $year;
        }

        $years[$currentYear] = $currentYear;

        for ($i = 1; $i <= 10; $i++) {
            $year = $currentYear + $i;
            $years[$year] = $year;
        }

        return $years;
    }
}

if (!function_exists('format_date')) {
    function format_date($date)
    {
        if (preg_match('/\d{4}-\d{2}-\d{2}/', $date)) {
            return \Carbon\Carbon::parse($date)->format('d-M-Y');
        } else {
            return $date;
        }
    }
}

if (!function_exists('format_date_time')) {
    function format_date_time($dateTime)
    {
        if (preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $dateTime)) {
            return \Carbon\Carbon::parse($dateTime)->format('d-M-Y h:i A');
        } else {
            return $dateTime;
        }
    }
}

//if (!function_exists('addOptionToArray')) {
//    function addOptionToArray($arrayName, $newOption)
//    {
//        $helpersFile = app_path('helpers.php');
//
//        $content = file_get_contents($helpersFile);
//
//        $startPosition = strpos($content, "\$optionArr['$arrayName'] = array(");
//
//        if ($startPosition !== false) {
//            $endPosition = strpos($content, ');', $startPosition);
//
//            if ($endPosition !== false) {
//                $arrayContent = substr($content, $startPosition, $endPosition - $startPosition);
//
//                if (strpos($arrayContent, "'$newOption' => '$newOption'") === false) {
//
//                    $updatedArrayContent = substr_replace($arrayContent, "    '$newOption' => '$newOption',\n", $endPosition - $startPosition - 1, 0);
//
//                    $newContent = substr_replace($content, $updatedArrayContent, $startPosition, $endPosition - $startPosition);
//
//                    file_put_contents($helpersFile, $newContent);
//
//                    return true;
//                } else {
//                    return false;
//                }
//            }
//        }
//
//        return null;
//    }
//}
