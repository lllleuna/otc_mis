<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GeneralInfo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        GeneralInfo::factory()->count(10)->create();

        // run once
        User::factory()->create([
            'firstname' => 'Carlos Antonio',
            'lastname' => 'Albornoz',
            'division' => 'PED',
            'role' => 'Admin',
            'employee_id_no' => '1234567890',
            'email' => 'test@example.com',
        ]);
    }
}
