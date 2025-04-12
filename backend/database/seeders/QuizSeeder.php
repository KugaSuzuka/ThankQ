<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::factory()
            ->count(5)
            ->recycle(Wedding::all())
            ->create([
                'question' => 'クイズの問題',
            ]);
    }
}
