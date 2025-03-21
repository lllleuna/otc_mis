<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EditRequest;
use App\Models\ChangeItem;

class EditRequestSeeder extends Seeder
{
    public function run()
    {
        // Create 10 EditRequests, each with 3-5 ChangeItems
        EditRequest::factory()
            ->has(ChangeItem::factory()->count(rand(3, 5)))
            ->count(10)
            ->create();
    }
}
