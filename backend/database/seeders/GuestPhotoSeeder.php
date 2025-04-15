<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\GuestPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GuestPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // resources/sample-images/sample_photoをminioにアップロード
        Storage::disk('s3')
            ->put(
                'guest_photos/sample_photo.png',
                file_get_contents(resource_path('sample-images/sample_photo.png'))
            );
        Guest::all()
            ->each(fn (Guest $guest) => GuestPhoto::factory()
                ->create([
                    'guest_id' => $guest->id,
                    'photo_path' => 'guest_photos/sample_photo.png',
                ])
            );
    }
}
