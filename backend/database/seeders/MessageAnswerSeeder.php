<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\MessageAnswer;
use App\Models\MessageQuestion;
use Illuminate\Database\Seeder;

class MessageAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageAnswer::factory()
            ->count(10)
            ->recycle(Guest::all())
            ->recycle(MessageQuestion::all())
            ->create([
                'answer_text' => '回答内容',
            ]);
    }
}
