<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\GuestPhoto;
use Illuminate\Database\Seeder;

class GuestPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuestPhoto::factory()
            ->recycle(Guest::all())
            ->create();
    }
}
