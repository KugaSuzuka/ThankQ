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
        Schema::create('quiz_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->comment('クイズID');
            $table->string('choice_text')->comment('選択肢内容');
            $table->boolean('is_correct')->default(false)->comment('正解フラグ');
            $table->string('choice_path')->nullable()->comment('選択肢画像パス');
            $table->timestamps();
            $table->comment('クイズ選択肢');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_choices');
    }
};
