<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GeneralInfo;
use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\Employment;
use App\Models\Unit;
use App\Models\Franchise;
use App\Models\Cgs;
use App\Models\Governance;
use App\Models\Finance;
use App\Models\GrantsDonation;
use App\Models\Scholarship;
use App\Models\Loan;
use App\Models\Business;
use App\Models\Cetos;
use App\Models\TrainingSeminar;
use Database\Seeders\ExternalUserSeeder;
use Database\Seeders\ApplicationSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Employee accounts
        User::factory(5)->create(); 

        $this->call([
            UsersTableSeeder::class,
        ]);

        // Create GeneralInfo records first
        


        // Seeder for external users (client portal)
        // $this->call([
        //     ExternalUserSeeder::class,  // Call the UserSeeder
        // ]);

        // Accreditation application factory and seeder
        // $this->call([
        //     ApplicationSeeder::class,  // Call the UserSeeder
        // ]);

    }
}
