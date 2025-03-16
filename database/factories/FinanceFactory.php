<?php

namespace Database\Factories;

use App\Models\Finance;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    protected $model = Finance::class;

    public function definition()
    {
        // Generate random financial values
        $current_assets = $this->faker->randomFloat(2, 50000, 5000000);
        $noncurrent_assets = $this->faker->randomFloat(2, 50000, 10000000);
        $total_assets = $current_assets + $noncurrent_assets;
        $liabilities = $this->faker->randomFloat(2, 10000, 5000000);
        $members_equity = $total_assets - $liabilities;
        $total_gross_revenues = $this->faker->randomFloat(2, 100000, 10000000);
        $total_expenses = $this->faker->randomFloat(2, 50000, 9000000);
        $net_surplus = $total_gross_revenues - $total_expenses;

        // Capitalization
        $initial_auth_capital_share = $this->faker->randomFloat(2, 50000, 10000000);
        $present_auth_capital_share = $initial_auth_capital_share + $this->faker->randomFloat(2, 10000, 5000000);
        $subscribed_capital_share = $this->faker->randomFloat(2, 50000, 7000000);
        $paid_up_capital = $this->faker->randomFloat(2, 50000, 5000000);
        $capital_build_up_scheme = $this->faker->randomFloat(2, 5000, 200000);

        // Distribution of net surplus
        $general_reserve_fund = $net_surplus * 0.30;
        $education_training_fund = $net_surplus * 0.10;
        $community_dev_fund = $net_surplus * 0.05;
        $optional_fund = $net_surplus * 0.05;
        $share_capital_interest = $net_surplus * 0.20;
        $patronage_refund = $net_surplus * 0.20;
        $others = $net_surplus * 0.10;
        $total = $general_reserve_fund + $education_training_fund + $community_dev_fund + $optional_fund + $share_capital_interest + $patronage_refund + $others;
        $deficit_from_financial_aspect = $total - $net_surplus;

        return [
            'accreditation_no' => GeneralInfo::inRandomOrder()->first()->accreditation_no ?? GeneralInfo::factory(),
            'entry_year' => $this->faker->year,

            // Financial Aspect
            'current_assets' => $current_assets,
            'noncurrent_assets' => $noncurrent_assets,
            'total_assets' => $total_assets,
            'coop_type' => $this->faker->randomElement(['Micro', 'Small', 'Medium', 'Large']),
            'liabilities' => $liabilities,
            'members_equity' => $members_equity,
            'total_gross_revenues' => $total_gross_revenues,
            'total_expenses' => $total_expenses,
            'net_surplus' => $net_surplus,

            // Capitalization
            'initial_auth_capital_share' => $initial_auth_capital_share,
            'present_auth_capital_share' => $present_auth_capital_share,
            'subscribed_capital_share' => $subscribed_capital_share,
            'paid_up_capital' => $paid_up_capital,
            'capital_build_up_scheme' => $capital_build_up_scheme,

            // Distribution of Net Surplus
            'general_reserve_fund' => $general_reserve_fund,
            'education_training_fund' => $education_training_fund,
            'community_dev_fund' => $community_dev_fund,
            'optional_fund' => $optional_fund,
            'share_capital_interest' => $share_capital_interest,
            'patronage_refund' => $patronage_refund,
            'others' => $others,
            'total' => $total,
            'deficit_from_financial_aspect' => $deficit_from_financial_aspect,
        ];
    }
}
