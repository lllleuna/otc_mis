<?php

namespace Database\Factories;

use App\Models\Scholarship;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScholarshipFactory extends Factory
{
    protected $model = Scholarship::class;

    public function definition()
    {
        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,

            'course_taken' => $this->faker->randomElement([
                'Business Administration', 'Information Technology', 'Engineering', 
                'Nursing', 'Education', 'Accountancy', 'Social Work'
            ]), // Simulated course names

            'beneficiary' => $this->faker->numberBetween(1, 100), // Random number of scholars
            'remarks' => $this->faker->sentence(6), // Random remarks
        ];
    }
}
