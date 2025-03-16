<?php

namespace Database\Factories;

use App\Models\Governance;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GovernanceFactory extends Factory
{
    protected $model = Governance::class;

    public function definition()
    {
        $term_start = $this->faker->date();
        $term_end = $this->faker->optional()->dateTimeBetween($term_start, '+5 years');

        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year(),
            'role_name' => $this->faker->randomElement(['Chairperson', 'Vice Chairperson', 'Secretary', 'Treasurer']),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->optional()->randomElement(['Jr.', 'Sr.', 'III']),
            'term_start' => $term_start,
            'term_end' => $term_end,
            'mobile_number' => '09' . $this->faker->numerify('########'),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
