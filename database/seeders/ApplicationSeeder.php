<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create applications only for ExternalUsers with accreditation_status = 'New'
        // Application::factory()->count(5)->create(); // Application for accreditation
        
    }
}
