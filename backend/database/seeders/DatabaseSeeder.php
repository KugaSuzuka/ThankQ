<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([WeddingSeeder::class]);
        User::factory()
            ->count(2)
            ->recycle(Wedding::all())
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
        $this->call([
            GuestSeeder::class,
            GuestPhotoSeeder::class,
            QuizSeeder::class,
            QuizChoiceSeeder::class,
            QuizAnswerSeeder::class,
            MessageQuestionSeeder::class,
            MessageAnswerSeeder::class,
        ]);
    }
}
