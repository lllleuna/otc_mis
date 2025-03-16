<?php

namespace Database\Factories;

use App\Models\Cgs;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CgsFactory extends Factory
{
    protected $model = Cgs::class;

    public function definition()
    {
        $issuance_date = $this->faker->date();
        $expiration_date = date('Y-m-d', strtotime($issuance_date . ' +1 year'));

        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,
            'cgs_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'issuance_date' => $issuance_date,
            'expiration_date' => $expiration_date,
        ];
    }
}
