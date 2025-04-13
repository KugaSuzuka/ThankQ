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
                'name' => '藤村和弥',
                'email' => 'test@example.com',
            ],
                [
                    'name' => '久賀鈴香',
                    'email' => 'test2@example.com',
                ]
            )
            ->create([
                'password' => bcrypt('password'),
            ]);
        $this->call([
            GuestSeeder::class,
            QuizSeeder::class,
            QuizChoiceSeeder::class,
            QuizAnswerSeeder::class,
            MessageQuestionSeeder::class,
            MessageAnswerSeeder::class,
        ]);
    }
}
