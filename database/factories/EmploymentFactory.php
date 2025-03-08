<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employment;
use App\Models\GeneralInfo;

class EmploymentFactory extends Factory
{
    protected $model = Employment::class;

    public function definition()
    {
        // Get a random existing accreditation_no from general_info
        $generalInfo = GeneralInfo::inRandomOrder()->first();

        return [
            'accreditation_no' => $generalInfo ? $generalInfo->accreditation_no : GeneralInfo::factory(),
            'entry_year' => $this->faker->year(),
            'drivers_probationary_male' => $this->faker->numberBetween(0, 50),
            'drivers_probationary_female' => $this->faker->numberBetween(0, 50),
            'drivers_regular_male' => $this->faker->numberBetween(0, 100),
            'drivers_regular_female' => $this->faker->numberBetween(0, 100),
            'management_probationary_male' => $this->faker->numberBetween(0, 20),
            'management_probationary_female' => $this->faker->numberBetween(0, 20),
            'management_regular_male' => $this->faker->numberBetween(0, 40),
            'management_regular_female' => $this->faker->numberBetween(0, 40),
            'allied_probationary_male' => $this->faker->numberBetween(0, 30),
            'allied_probationary_female' => $this->faker->numberBetween(0, 30),
            'allied_regular_male' => $this->faker->numberBetween(0, 50),
            'allied_regular_female' => $this->faker->numberBetween(0, 50),
            'total_employees' => function (array $attributes) {
                return $attributes['drivers_probationary_male'] +
                       $attributes['drivers_probationary_female'] +
                       $attributes['drivers_regular_male'] +
                       $attributes['drivers_regular_female'] +
                       $attributes['management_probationary_male'] +
                       $attributes['management_probationary_female'] +
                       $attributes['management_regular_male'] +
                       $attributes['management_regular_female'] +
                       $attributes['allied_probationary_male'] +
                       $attributes['allied_probationary_female'] +
                       $attributes['allied_regular_male'] +
                       $attributes['allied_regular_female'];
            },
        ];
    }
}
