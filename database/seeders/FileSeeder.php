<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of files to create
        $numberOfFiles = 100;
        // Create the files
        \App\Models\File::factory()->count($numberOfFiles)->create();
    }
}
