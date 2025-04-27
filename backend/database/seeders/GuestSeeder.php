<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guest::factory()
            ->count(10)
            ->recycle(User::all())
            ->recycle(Wedding::all())
            ->create();
    }
}
