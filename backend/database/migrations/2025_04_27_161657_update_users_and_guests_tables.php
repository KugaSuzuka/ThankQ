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
        // usersテーブルにrole追加
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['groom', 'bride'])->comment('新郎or新婦')->after('wedding_id');
        });

        // guestsテーブルに新郎新婦用メッセージ追加
        Schema::table('guests', function (Blueprint $table) {
            $table->text('message_from_groom')->nullable()->comment('新郎メッセージ')->after('access_token');
            $table->text('message_from_bride')->nullable()->comment('新婦メッセージ')->after('message_from_groom');
            $table->dropColumn('thanks_message');
            // wedding_idを追加
            $table->foreignId('wedding_id')->comment('結婚式ID')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // guestsテーブルからメッセージカラム削除
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn(['message_from_groom', 'message_from_bride', 'wedding_id']);
            $table->text('thanks_message')->nullable()->after('access_token');
        });

        // usersテーブルからroleカラム削除
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
