<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->comment('ゲストID');
            $table->foreignId('message_question_id')->comment('メッセージ質問ID');
            $table->text('answer_text')->comment('回答内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_answers');
    }
};
