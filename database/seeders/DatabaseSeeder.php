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


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Employee accounts
        User::factory(10)->create(); 

        // Create GeneralInfo records first
        GeneralInfo::factory(10)->create()->each(function ($generalInfo) {
            $accreditationNo = $generalInfo->accreditation_no;

            // Create related records for each GeneralInfo entry
            Membership::factory()->count(3)->create(['accreditation_no' => $accreditationNo]);
            Employment::factory()->count(3)->create(['accreditation_no' => $accreditationNo]);
            Unit::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
            Franchise::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
            Cgs::factory()->count(1)->create(['accreditation_no' => $accreditationNo]);
            Governance::factory()->count(3)->create(['accreditation_no' => $accreditationNo]);

            // New Tables
            Finance::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
            GrantsDonation::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
            Scholarship::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
            Loan::factory()->count(2)->create(['accreditation_no' => $accreditationNo]);
        
            TrainingSeminar::factory()->count(2)->create(['accreditation_no' => $generalInfo->accreditation_no]);
            Business::factory()->count(1)->create(['accreditation_no' => $generalInfo->accreditation_no]);
            Cetos::factory()->count(1)->create(['accreditation_no' => $generalInfo->accreditation_no]);
        
        });


        // Seeder for external users (client portal)
        $this->call([
            ExternalUserSeeder::class,  // Call the UserSeeder
        ]);

    }
}
