<?php

namespace Database\Seeders;

use App\Models\User;
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
