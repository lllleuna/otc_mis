<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GeneralInfo;
use App\Models\Membership;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition()
    {
        // Get a random existing accreditation_no from general_info
        $generalInfo = GeneralInfo::inRandomOrder()->first();

        return [
            'accreditation_no' => $generalInfo ? $generalInfo->accreditation_no : GeneralInfo::factory(), 
            'entry_year' => $this->faker->year(),
            'driver_male' => $this->faker->numberBetween(0, 100),
            'driver_female' => $this->faker->numberBetween(0, 100),
            'operator_investor_male' => $this->faker->numberBetween(0, 50),
            'operator_investor_female' => $this->faker->numberBetween(0, 50),
            'allied_workers_male' => $this->faker->numberBetween(0, 50),
            'allied_workers_female' => $this->faker->numberBetween(0, 50),
            'other_member_male' => $this->faker->numberBetween(0, 30),
            'other_member_female' => $this->faker->numberBetween(0, 30),
            'number_of_pwd' => $this->faker->numberBetween(0, 10),
            'number_of_senior' => $this->faker->numberBetween(0, 15),
            'total_members' => function (array $attributes) {
                return $attributes['driver_male'] + 
                       $attributes['driver_female'] +
                       $attributes['operator_investor_male'] +
                       $attributes['operator_investor_female'] +
                       $attributes['allied_workers_male'] +
                       $attributes['allied_workers_female'] +
                       $attributes['other_member_male'] +
                       $attributes['other_member_female'];
            },
        ];
    }
}
