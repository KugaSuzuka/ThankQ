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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('user_id')->comment('ユーザーID');
            $table->uuid('access_token')->unique()->comment('ゲスト専用アクセス用トークン');
            $table->text('thank_message')->nullable()->comment('ゲストへの感謝メッセージ');
            $table->string('photo_path')->nullable()->comment('感謝メッセージ用の写真パス');
            $table->timestamps();
            $table->comment('ゲスト');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
