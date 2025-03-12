<?php

namespace Database\Factories;

use App\Models\GrantsDonation;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrantsDonationFactory extends Factory
{
    protected $model = GrantsDonation::class;

    public function definition()
    {
        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,

            'acquired_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'amount' => $this->faker->randomFloat(2, 1000, 500000), // Random donation/grant amount
            'source' => $this->faker->company, // Random company as the source
            'remarks' => $this->faker->sentence(6), // Random remark about the donation
        ];
    }
}
