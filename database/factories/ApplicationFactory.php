<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Application;
use App\Models\ExternalUser;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        // Get a user with accreditation_status = 'New' who doesn't already have an application
        $user = ExternalUser::where('accreditation_status', 'New')
            ->whereDoesntHave('applications') // Ensures only users without applications are selected
            ->inRandomOrder()
            ->first();

        // If no such user exists, create one
        if (!$user) {
            $user = ExternalUser::factory()->create([
                'accreditation_status' => 'New'
            ]);
        }

        return [
            'user_id' => $user->id,
            'tc_name' => $user->tc_name,
            'cda_reg_no' => $user->cda_reg_no,
            'cda_reg_date' => $this->faker->date(),
            'area' => $this->faker->word,
            'region' => $this->faker->state,
            'province' => $this->faker->optional()->state,
            'city_municipality' => $this->faker->city,
            'barangay' => $this->faker->word,
            'address' => $this->faker->address,
            'status' => 'new', // Default status
            'application_type' => 'accreditation',
            'file_upload' => 'uploads/' . $this->faker->uuid . '.pdf',
            'message' => $this->faker->optional()->sentence,
            'consent' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
