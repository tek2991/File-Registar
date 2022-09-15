<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Seed the offices
        $this->call(OfficeSeeder::class);
        // Seed the files
        $this->call(FileSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
    }
}
