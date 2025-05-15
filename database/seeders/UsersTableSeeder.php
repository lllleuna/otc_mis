<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'firstname' => 'Leunamme Rose',
                'lastname' => 'Atutubo',
                'division' => 'PED',
                'role' => 'Admin',
                'employee_id_no' => fake()->unique()->numerify('#########'),
                'email' => 'leunammerosev.atutubo@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'mobile_number' => '63' . fake()->numerify('##########'),
            ],
            [
                'firstname' => 'Althea',
                'lastname' => 'Bernardo',
                'division' => 'OD',
                'role' => 'Officer 2',
                'employee_id_no' => fake()->unique()->numerify('#########'),
                'email' => 'bernardothea678@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'mobile_number' => '63' . fake()->numerify('##########'),
            ],
            [
                'firstname' => 'John Michael',
                'lastname' => 'Cruz',
                'division' => 'AFD',
                'role' => 'Officer 1',
                'employee_id_no' => fake()->unique()->numerify('#########'),
                'email' => 'johnmichaelcruz0937@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'mobile_number' => '63' . fake()->numerify('##########'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

