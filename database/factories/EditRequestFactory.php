<?php

namespace Database\Factories;

use App\Models\EditRequest;
use App\Models\User;
use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EditRequestFactory extends Factory
{
    protected $model = EditRequest::class;

    public function definition()
    {
        return [
            'reference_no' => 'REQ-' . strtoupper($this->faker->unique()->bothify('???###')),
            'table_name' => $this->faker->randomElement(['general_info', 'governance', 'membership']),
            'accreditation_no' => GeneralInfo::inRandomOrder()->value('accreditation_no'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'editor_id' => User::factory(), // Generates a new user if not specified
            'edited_at' => now(),
            'editor_remarks' => $this->faker->boolean(50) ? $this->faker->sentence() : null,
            'approver_id' => $this->faker->boolean(50) ? User::factory() : null,
            'reviewed_at' => $this->faker->boolean(50) ? $this->faker->dateTime() : null,
            'approver_remarks' => $this->faker->boolean(50) ? $this->faker->sentence() : null,
            'file_upload' => $this->faker->boolean(50) ? $this->faker->word() . '.pdf' : null,

        ];
    }

    /**
     * Define state for pending requests.
     */
    public function pending()
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    /**
     * Define state for approved requests.
     */
    public function approved()
    {
        return $this->state(fn () => ['status' => 'approved', 'reviewed_at' => now()]);
    }

    /**
     * Define state for rejected requests.
     */
    public function rejected()
    {
        return $this->state(fn () => ['status' => 'rejected', 'reviewed_at' => now()]);
    }
}
