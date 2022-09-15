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
                'initials' => 'CPC',
                'name' => 'Central Processing Center',
            ],
            [
                'initials' => 'TECH',
                'name' => 'Technology',
            ],
            [
                'initials' => 'ACCT',
                'name' => 'Accounts',
            ],
            [
                'initials' => 'CIFA',
                'name' => 'Chief Internal Finalcial Advisor',
            ],
            [
                'initials' => 'PLI',
                'name' => 'Postal Life Insurance',
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
                'initials' => 'STAFF',
                'name' => 'Staff Section',
            ],
            [
                'initials' => 'INV',
                'name' => 'Investigation',
            ],
            [
                'initials' => 'VIG',
                'name' => 'Vigilance',
            ],
            [
                'initials' => 'PCL',
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
