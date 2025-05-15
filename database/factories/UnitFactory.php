<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unit;
use App\Models\GeneralInfo;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition()
    {
        // Get a random existing accreditation_no from general_info
        $generalInfo = GeneralInfo::inRandomOrder()->first();

        return [
            'accreditation_no' => $generalInfo ? $generalInfo->accreditation_no : GeneralInfo::factory(),
            'entry_year' => $this->faker->year(),
            'mode_of_service' => $this->faker->randomElement(['Fixed Route', 'Demand Responsive', 'Point-to-Point']),
            'type_of_unit' => $this->faker->randomElement(['Jeepney', 'Bus', 'Van', 'Tricycle']),
            'cooperatively_owned' => $this->faker->numberBetween(0, 100),
            'individually_owned' => $this->faker->numberBetween(0, 100),
        ];
    }
}
