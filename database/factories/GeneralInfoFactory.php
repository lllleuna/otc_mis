<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GeneralInfoFactory extends Factory
{
    protected $model = GeneralInfo::class;

    public function definition()
    {
        return [
            'accreditation_no' => $this->faker->numberBetween(2000, now()->year) . '-' . $this->faker->numerify('######'),
            'name' => $this->faker->company . ' Cooperative',
            'short_name' => Str::before($this->faker->company, ' ') . ' Coop',
            'cda_registration_date' => $cdaDate = $this->faker->dateTimeBetween('-10 years', 'now'),
            'cda_registration_no' => 'T-' . $this->faker->randomNumber(8),
            'accreditation_type' => $this->faker->randomElement(['Provisional', 'Full']),
            'accreditation_date' => $this->faker->dateTimeBetween($cdaDate, 'now'),
            'common_bond_membership' => $this->faker->randomElement(['Occupational', 'Residential', 'Associational', 'Institutional', 'Others']),
            'membership_fee' => $this->faker->numberBetween(100, 500),
            'area' => $this->faker->randomElement(['01', '02', '03']), // Example: 01 = Luzon, 02 = Visayas, 03 = Mindanao
            'region' => $this->faker->randomElement([
                '130000000', // NCR
                '140000000', // CAR
                '010000000', // Region I - Ilocos Region
                '020000000', // Region II - Cagayan Valley
                '030000000', // Region III - Central Luzon
                '040000000', // Region IV-A - CALABARZON
                '170000000', // MIMAROPA
                '050000000', // Region V - Bicol Region
                '060000000', // Region VI - Western Visayas
                '070000000', // Region VII - Central Visayas
                '080000000', // Region VIII - Eastern Visayas
                '090000000', // Region IX - Zamboanga Peninsula
                '100000000', // Region X - Northern Mindanao
                '110000000', // Region XI - Davao Region
                '120000000', // Region XII - SOCCSKSARGEN
                '160000000', // Region XIII - Caraga
                '150000000', // BARMM - Bangsamoro Autonomous Region in Muslim Mindanao
            ]),
            'province' => $this->faker->randomElement([
                '133900000', // Metro Manila
                '072200000', // Cebu
                '112400000', // Davao del Sur
                '035400000', // Pampanga
                '043400000', // Laguna
                '041000000', // Batangas
                '063000000', // Iloilo
                '101300000', // Bukidnon
            ]),
            'city' => $this->faker->randomElement([
                '137400000', // Manila
                '137600000', // Quezon City
                '072217000', // Cebu City
                '112402000', // Davao City
                '141102000', // Baguio City
                '063031000', // Iloilo City
                '097332000', // Zamboanga City
                '104305000', // Cagayan de Oro City
            ]),
            'barangay' => $this->faker->randomElement([
                '137404050', // Brgy. 50, Manila
                '137607041', // Brgy. Payatas, Quezon City
                '072217012', // Brgy. Lahug, Cebu City
                '112402019', // Brgy. Buhangin, Davao City
                '141102004', // Brgy. Irisan, Baguio City
            ]),
            'business_address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'contact_no' => $this->faker->phoneNumber,
            'contact_firstname' => $this->faker->firstName,
            'contact_lastname' => $this->faker->lastName,
            'contact_mid_initial' =>  $this->faker->lastName(),
            'contact_suffix' => $this->faker->optional()->randomElement(['Jr.', 'Sr.', 'II', 'III', 'IV']),
            'employer_sss_reg_no' => $this->faker->optional()->regexify('[0-9]{10}'), // 10-digit SSS number
            'employer_pagibig_reg_no' => $this->faker->optional()->regexify('[0-9]{12}'), // 12-digit Pag-IBIG number
            'employer_philhealth_reg_no' => $this->faker->optional()->regexify('[0-9]{12}'), // 12-digit PhilHealth number
            'bir_tin' => $this->faker->optional()->regexify('[0-9]{9}'), // 9-digit TIN number
            'bir_tax_exemption_no' => $this->faker->optional()->regexify('[A-Z0-9]{5,10}'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
