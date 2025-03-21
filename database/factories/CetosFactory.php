<?php

namespace Database\Factories;

use App\Models\Cetos;
use Illuminate\Database\Eloquent\Factories\Factory;

class CetosFactory extends Factory
{
    protected $model = Cetos::class;

    public function definition(): array
    {
        $membersWith = $this->faker->numberBetween(50, 500);
        $membersWithout = $this->faker->numberBetween(10, 300);
        $total = $membersWith + $membersWithout;

        return [
            'accreditation_no' => \App\Models\GeneralInfo::factory(), // Assuming accreditation_no exists in GeneralInfo
            'entry_year' => $this->faker->year(),
            'members_with' => $membersWith,
            'members_without' => $membersWithout,
            'total' => $total,
        ];
    }
}
