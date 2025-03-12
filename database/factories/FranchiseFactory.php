<?php

namespace Database\Factories;

use App\Models\Franchise;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FranchiseFactory extends Factory
{
    protected $model = Franchise::class;

    public function definition()
    {
        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,
            'route' => $this->faker->streetName,
            'cpc_case_number' => strtoupper($this->faker->bothify('CPC-#######')),
            'type_of_franchise' => $this->faker->randomElement(['Individual', 'Cooperative', 'Corporation']),
            'mode_of_service' => $this->faker->randomElement(['Fixed Route', 'On-Demand', 'Shuttle']),
            'type_of_unit' => $this->faker->randomElement(['Jeepney', 'Bus', 'Taxi', 'UV Express']),
            'validity' => $this->faker->date(),
            'remarks' => $this->faker->optional()->sentence(),
        ];
    }
}
