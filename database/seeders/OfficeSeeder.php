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
        // Define the number of offices to create
        $numberOfOffices = 10;

        // Create the offices
        \App\Models\Office::factory()->count($numberOfOffices)->create();
    }
}
