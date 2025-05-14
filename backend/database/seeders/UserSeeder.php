<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wedding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->for(Wedding::factory()->create())
            ->sequence([
                'name' => '新郎',
                'email' => 'test@example.com',
                'role' => 'groom',
            ],
                [
                    'name' => '新婦',
                    'email' => 'test2@example.com',
                    'role' => 'bride',
                ]
            )
            ->create([
                'password' => bcrypt('password'),
            ]);
    }
}
