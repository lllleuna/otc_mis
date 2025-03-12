<?php

namespace Database\Factories;

use App\Models\TrainingSeminar;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSeminarFactory extends Factory
{
    protected $model = TrainingSeminar::class;

    public function definition(): array
    {
        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month')->format('Y-m-d');

        return [
            'accreditation_no' => \App\Models\GeneralInfo::factory(), // Assuming accreditation_no exists in GeneralInfo
            'entry_year' => $this->faker->year(),
            'title' => $this->faker->sentence(6),
            'start' => $startDate,
            'end' => $endDate,
            'no_of_attendees' => $this->faker->numberBetween(5, 100),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
