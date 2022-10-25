<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define offices object array
        $offices = [
            [
                'initials' => 'CPMG',
                'name' => 'CPMG Assam circle Office',
            ],
            [
                'initials' => 'DPSHQ',
                'name' => 'DPS HQ Assam circle Office',
            ],
            [
                'initials' => 'DPSMBD',
                'name' => 'DPS Mails & BD Assam circle Office',
            ],
            [
                'initials' => 'DPSPTC',
                'name' => 'DPS PTC Guwahati',
            ],
            [
                'initials' => 'CIFA',
                'name' => 'Chief Internal Finalcial Advisor',
            ],
            [
                'initials' => 'ACCT',
                'name' => 'Accounts',
            ],
            [
                'initials' => 'TECH',
                'name' => 'Technology & PMU',
            ],
            [
                'initials' => 'CBSCPC',
                'name' => 'Central Processing Center',
            ],
            [
                'initials' => 'FS',
                'name' => 'Financial Services',
            ],
            [
                'initials' => 'PHLY',
                'name' => 'Philately',
            ],
            [
                'initials' => 'PLI',
                'name' => 'Postal Life Insurance',
            ],
            [
                'initials' => 'LEGAL',
                'name' => 'Legal',
            ],
            [
                'initials' => 'PG',
                'name' => 'Public Grievances',
            ],
            [
                'initials' => 'WLF',
                'name' => 'Welfare',
            ],
            [
                'initials' => 'HIN',
                'name' => 'Hindi',
            ],
            [
                'initials' => 'STAFF',
                'name' => 'Staff Section',
            ],
            [
                'initials' => 'INVIG',
                'name' => 'Investigation & Vigilance',
            ],
            [
                'initials' => 'RTI',
                'name' => 'Right to Information',
            ],
            [
                'initials' => 'BLDG',
                'name' => 'Building',
            ],
            [
                'initials' => 'PH',
                'name' => 'Parcel Branch',
            ],
            [
                'initials' => 'MAILS',
                'name' => 'Mails Section',
            ],
            [
                'initials' => 'BD',
                'name' => 'Business Development',
            ],
            [
                'initials' => 'ESTB',
                'name' => 'Establishment',
            ],
            [
                'initials' => 'RCDP',
                'name' => 'Receipt & Dispatch',
            ],
            [
                'initials' => 'AEE',
                'name' => 'Assistant Engineer (Electrical)',
            ],
            [
                'initials' => 'AEC',
                'name' => 'Assistant Engineer (Civil)'
            ]
        ];
        // Create the offices
        foreach ($offices as $office) {
            \App\Models\Office::create($office);
        }
    }
}
