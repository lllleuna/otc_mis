<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        return [
            'accreditation_no' => \App\Models\GeneralInfo::factory(), // Assuming accreditation_no exists in GeneralInfo
            'entry_year' => $this->faker->year(),
            'type' => $this->faker->randomElement(['Proposed', 'Existing']),
            'nature_of_business' => $this->faker->company(),
            'starting_capital' => $this->faker->randomFloat(2, 50000, 1000000),
            'capital_to_date' => $this->faker->randomFloat(2, 100000, 5000000),
            'years_of_existence' => $this->faker->numberBetween(0, 50),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Suspended']),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
