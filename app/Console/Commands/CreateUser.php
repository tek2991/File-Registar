<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {office_initials} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $office_initials = $this->argument('office_initials');

        try {
            $office_id = \App\Models\Office::where('initials', $office_initials)->first()->id;
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'office_id' => $office_id,
            ]);

            $this->info("User {$user->name} created successfully!");
        } catch (\Exception $e) {
            $this->error("Error creating user: {$e->getMessage()}");
        }
    }
}
