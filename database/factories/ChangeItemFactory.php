<?php

namespace Database\Factories;

use App\Models\ChangeItem;
use App\Models\EditRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChangeItemFactory extends Factory
{
    protected $model = ChangeItem::class;

    public function definition()
    {
        // Define allowed columns for each table
        $tableColumns = [
            'general_info' => ['name', 'common_bond_membership', 'business_address', 'email'],
            'governance' => ['role_name', 'first_name', 'last_name', 'email'],
            'membership' => ['driver_male', 'driver_female', 'operator_investor_male', 'operator_investor_female'],
        ];

        // Fetch a random or newly created EditRequest
        $editRequest = EditRequest::inRandomOrder()->first() ?? EditRequest::factory()->create();

        // Ensure the table_name exists in our predefined list, default to 'general_info' if not found
        $tableName = $editRequest->table_name ?? 'general_info';
        $validColumns = $tableColumns[$tableName] ?? $tableColumns['general_info'];

        return [
            'edit_request_id' => $editRequest->id,
            'column_name' => $this->faker->randomElement($validColumns), // Ensures column matches table
            'old_value' => $this->faker->optional()->word(),
            'new_value' => $this->faker->word(),
        ];
    }
}
