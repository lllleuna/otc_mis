<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,

            'financing_institution' => $this->faker->company, // Random company as loan provider
            'acquired_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'amount' => $this->faker->randomFloat(2, 50000, 5000000), // Loan amount range
            'utilization' => $this->faker->randomElement([
                'Vehicle Acquisition', 'Office Expansion', 'Technology Upgrade', 'Business Capital'
            ]), // How the loan is used

            'remarks' => $this->faker->sentence(6), // Additional remarks
        ];
    }
}
