<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeneralInfoFactory extends Factory
{
    protected $model = GeneralInfo::class;

    public function definition()
    {
        return [
            'accreditation_no' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->company,
            'short_name' => $this->faker->word,
            'accreditation_date' => $this->faker->date,
            'accreditation_type' => 'Regional',
            'cda_registration_no' => 'T-' . $this->faker->randomNumber(8),
            'cda_registration_date' => $this->faker->date,
            'common_bond_membership' => 'Transport Operators',
            'membership_fee' => $this->faker->numberBetween(100, 500),
            'area' => 'Metro Manila',
            'region' => 'NCR',
            'city' => $this->faker->city,
            'province' => 'Metro Manila',
            'barangay' => $this->faker->streetName,
            'business_address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'contact_no' => $this->faker->phoneNumber,
            'contact_firstname' => $this->faker->firstName,
            'contact_lastname' => $this->faker->lastName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
