<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Directorate;
use App\Models\Division;
use App\Models\Department;
use App\Models\Section;

class StructureSeeder extends Seeder
{
    public function run()
    {
        $structure = [
            "SWADAYA HARAPAN NUSANTARA" => [
                "BOARD OF DIRECTOR" => [
                    "BOARD OF DIRECTOR" => [
                        "BOARD OF DIRECTOR" => [
                            "BOARD OF DIRECTOR"
                        ]
                    ]
                ],
                "BRANCH SUPPORT" => [
                    "BRANCH SUPPORT" => [
                        "SURABAYA - BRANCH" => [
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ]
                    ]
                ],
                "MARKETING & SALES" => [
                    "RENTAL MARKETING & BUSINESS CONTROLLER" => [
                        "CUSTOMER HANDLING & ASSET CONTROL" => [],
                        "MARKETING, COST CONTROL & ADMINISTRATION" => [
                            "MARKETING, COST CONTROL & ADMINISTRATION"
                        ]
                    ],
                    "RENTAL, FG WILSON & GENSET CENTER" => [
                        "FG WILSON BUSINESS & GENSET CENTER (GC)" => [
                            "GENSET CENTER",
                            "POWER GENERATION GROUP 1"
                        ],
                        "LONG TERM RENTAL SALES 1" => [
                            "LONG TERM RENTAL SALES 1"
                        ],
                        "LONG TERM RENTAL SALES AREA 1" => [
                            "LONG TERM RENTAL SALES AREA 1"
                        ],
                        "LONG TERM RENTAL SALES AREA 2" => [
                            "LONG TERM RENTAL SALES AREA 2"
                        ],
                        "SHORT TERM RENTAL SALES" => [
                            "SHORT TERM RENTAL SALES"
                        ]
                    ]
                ]
            ],
            "TRAKTOR NUSANTARA" => [
                "BOARD OF DIRECTOR" => [
                    "BOARD OF DIRECTOR" => [
                        "BOARD OF DIRECTOR" => [
                            "BOARD OF DIRECTOR"
                        ]
                    ]
                ],
                "BRANCH SUPPORT & IMPROVEMENT" => [
                    "BRANCH SUPPORT & IMPROVEMENT" => [
                        "BANDAR LAMPUNG - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "BANDUNG - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "BANJARMASIN - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "BRANCH SUPPORT & IMPROVEMENT" => [
                            "BRANCH SUPPORT & IMPROVEMENT"
                        ],
                        "JAKARTA - BRANCH" => [
                            "SERVICE JK1 - MAINTENANCE CONTRACT",
                            "SERVICE JK1 - NON MAINTENANCE CONTRACT",
                            "SERVICE JK2 - MAINTENANCE CONTRACT",
                            "SERVICE JK2 - NON MAINTENANCE CONTRACT",
                            "SERVICE JK3 - MAINTENANCE CONTRACT"
                        ],
                        "JAMBI - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "JAYAPURA - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "MAKASSAR - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "MEDAN - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "PADANG - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "PALEMBANG - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "PEKANBARU - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "PONTIANAK - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "SAMARINDA - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "SAMPIT - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "SEMARANG - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ],
                        "SURABAYA - BRANCH" => [
                            "ADMINISTRATION",
                            "PARTS",
                            "SALES",
                            "SERVICE MAINTENANCE CONTRACT",
                            "SERVICE NON MAINTENANCE CONTRACT",
                        ]
                    ]
                ],
                "CORPORATE PROCUREMENT" => [
                    "CORPORATE PROCUREMENT" => [
                        "CORPORATE PROCUREMENT" => [
                            "CORPORATE PROCUREMENT"
                        ]
                    ]
                ],
                "EXECUTIVE MANAGEMENT & LEARNING CENTER" => [
                    "EXECUTIVE MANAGEMENT & LEARNING CENTER" => [
                        "EXECUTIVE MANAGEMENT & LEARNING CENTER" => [
                            "EXECUTIVE MANAGEMENT & LEARNING CENTER"
                        ]
                    ]
                ],
                "FINANCE & ADMINISTRATION" => [
                    "FINANCE, ACCOUNTING, TAXES & IT" => [
                        "ACCOUNTING & TAXES" => [
                            "ACCOUNTING & TAXES"
                        ],
                        "BUDGET & CONTROL" => [
                            "BUDGET & CONTROL"
                        ],
                        "FINANCE & PDCA" => [
                            "FINANCE & PDCA"
                        ],
                        "INFORMATION TECHNOLOGY (IT)" => [
                            "INFORMATION TECHNOLOGY (IT)"
                        ]
                    ]
                ],
                "HUMAN CAPITAL & SUSTAINABILITY" => [
                    "HUMAN CAPITAL, SUSTAINABILITY, SECURITY, EHS & GENERAL AFFAIR" => [
                        "GENERAL AFFAIR (GA)" => [
                            "GENERAL AFFAIR (GA)"
                        ],
                        "HUMAN CAPITAL DEVELOPMENT (HCD)" => [
                            "HUMAN CAPITAL DEVELOPMENT (HCD)"
                        ],
                        "HUMAN CAPITAL SERVICES (HCS)" => [
                            "HUMAN CAPITAL SERVICES (HCS)"
                        ],
                        "SUSTAINABILITY, SECURITY, ENVIRONMENT, HEALTH, AND SAFETY (SSEHS)" => [
                            "SUSTAINABILITY, SECURITY, ENVIRONMENT, HEALTH, AND SAFETY (SSEHS)"
                        ]
                    ]
                ],
                "INTERNAL CONTROL" => [
                    "INTERNAL CONTROL" => [
                        "INTERNAL CONTROL" => [
                            "INTERNAL CONTROL"
                        ]
                    ]
                ],
                "MARKETING, HC & SUSTAINABILITY" => [
                    "HC, SSEHS & GENERAL AFFAIR" => [
                        "GENERAL AFFAIR (GA)" => [
                            "GENERAL AFFAIR (GA)"
                        ]
                    ]
                ],
                "MATERIAL HANDLING BUSINESS" => [
                    "MATERIAL HANDLING PRODUCT SUPPORT" => [
                        "BUSINESS DEVELOPMENT & JAPAN DESK" => [
                            "BUSINESS DEVELOPMENT & JAPAN DESK"
                        ],
                        "MATERIAL HANDLING PARTS" => [
                            "MATERIAL HANDLING PARTS"
                        ],
                        "MATERIAL HANDLING SERVICE" => [
                            "MATERIAL HANDLING SERVICE"
                        ],
                        "MATERIAL HANDLING TECHNICAL SUPPORT" => [
                            "MATERIAL HANDLING TECHNICAL SUPPORT"
                        ],
                        "SERVICE PERSONNEL DEVELOPMENT & FACILITIES" => [
                            "SERVICE PERSONNEL DEVELOPMENT & FACILITIES"
                        ]
                    ],
                    "MATERIAL HANDLING SALES & MARKETING" => [
                        "BT & RAYMOND SALES" => [
                            "BT & RAYMOND SALES"
                        ],
                        "PRODUCT MANAGEMENT 1" => [
                            "PRODUCT MANAGEMENT 1"
                        ],
                        "TOYOTA SALES AREA 1" => [
                            "TOYOTA SALES AREA 1"
                        ],
                        "TOYOTA SALES AREA 2" => [
                            "TOYOTA SALES AREA 2"
                        ],
                        "TOYOTA SALES AREA 3" => [
                            "TOYOTA SALES AREA 3"
                        ]
                    ]
                ],
                "PDCA, AMS & INNOVATION, ISO, SOP, LEGAL" => [
                    "PDCA, AMS & INNOVATION, ISO, SOP, LEGAL" => [
                        "PDCA, AMS & INNOVATION, ISO, SOP, LEGAL" => [
                            "PDCA, AMS & INNOVATION, ISO, SOP, LEGAL"
                        ]
                    ]
                ],
                "POWER, AGRO & CONSTRUCTION BUSINESS" => [
                    "AGRO, CONSTRUCTION & CRANE SALES" => [
                        "AGRO SALES" => [
                            "AGRO SALES"
                        ],
                        "CONSTRUCTION & CRANE SALES" => [
                            "CONSTRUCTION SALES",
                            "CRANE SALES"
                        ]
                    ],
                    "MARKETING" => [
                        "APPLICATION ENGINEERING" => [
                            "APPLICATION ENGINEERING"
                        ],
                        "MARKETING COMMUNICATION" => [
                            "MARKETING COMMUNICATION"
                        ],
                        "MARKETING SUPPORT & IMPORTATION" => [
                            "MARKETING SUPPORT & IMPORTATION"
                        ],
                        "PRODUCT MANAGEMENT 2" => [
                            "PRODUCT MANAGEMENT 2"
                        ],
                        "PRODUCT MANAGEMENT 3" => [
                            "PRODUCT MANAGEMENT 3"
                        ]
                    ],
                    "POWER GENERATION & AIR SOLUTION SALES" => [
                        "AIR SOLUTION SALES" => [
                            "AIR SOLUTION SALES"
                        ],
                        "POWER GENERATION SALES GROUP 1" => [
                            "POWER GENERATION SALES GROUP 1"
                        ],
                        "POWER GENERATION SALES GROUP 2" => [
                            "POWER GENERATION SALES GROUP 2"
                        ],
                    ],
                    "PRODUCT SUPPORT" => [
                        "PARTS LOGISTIC & WAREHOUSE" => [
                            "PARTS LOGISTIC & WAREHOUSE"
                        ],
                        "PARTS MARKETING" => [
                            "PARTS MARKETING"
                        ],
                        "PARTS SALES & KEY ACCOUNT" => [
                            "PARTS SALES & KEY ACCOUNT"
                        ],
                        "SERVICE BUSINESS & MARKETING" => [
                            "SERVICE BUSINESS & MARKETING"
                        ],
                        "SERVICE TECHNICAL SUPPORT" => [
                            "SERVICE TECHNICAL SUPPORT"
                        ]
                    ]
                ],
                "PROCESS IMPROVEMENT & DIGITALIZATION" => [
                    "PROCESS IMPROVEMENT & DIGITALIZATION" => [
                        "PROCESS IMPROVEMENT & DIGITALIZATION" => [
                            "PROCESS IMPROVEMENT & DIGITALIZATION"
                        ]
                    ]
                ]
            ]
        ];



        foreach ($structure as $companyName => $directorates) {
            $company = Company::create(['coy' => $companyName]);

            foreach ($directorates as $directorateName => $divisions) {
                $directorate = $company->directorates()->create(['nama_directorate' => $directorateName]);

                foreach ($divisions as $divisionName => $departments) {
                    $division = $directorate->divisions()->create(['nama_division' => $divisionName]);

                    // Ensure $departments is an array
                    if (is_array($departments)) {
                        foreach ($departments as $departmentName => $sections) {
                            // If $sections is not an array, handle it as a string
                            if (is_string($sections)) {
                                $department = $division->departments()->create(['nama_department' => $sections]);
                            } else {
                                // $sections is an array
                                $department = $division->departments()->create(['nama_department' => $departmentName]);

                                foreach ($sections as $sectionName) {
                                    $department->sections()->create(['nama_section' => $sectionName]);
                                }
                            }
                        }
                    } else {
                        // If $departments is not an array, handle it as a string
                        $division->departments()->create(['nama_department' => $departments]);
                    }
                }
            }
        }
    }
}
