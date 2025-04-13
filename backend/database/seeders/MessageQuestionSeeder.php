<?php

namespace Database\Seeders;

use App\Models\MessageQuestion;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class MessageQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageQuestion::factory()
            ->count(10)
            ->for(Wedding::first())
            ->create([
                'question' => '質問内容',
            ]);
    }
}
