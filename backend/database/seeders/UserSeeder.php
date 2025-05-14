<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wedding;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 下記のデータが存在している場合は削除する
        Wedding::truncate();
        $wedding = Wedding::updateOrCreate([
            'name' => 'テストウエディング',
        ]);
        // updateOrCreateを使用して、データが存在しない場合は新規作成、存在する場合は更新する
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => '新郎',
                'role' => 'groom',
                'password' => bcrypt('password'),
                'wedding_id' => $wedding->id,
            ]
        );
        User::updateOrCreate(
            ['email' => 'test2@example.com'],
            [
                'name' => '新婦',
                'role' => 'bride',
                'password' => bcrypt('password'),
                'wedding_id' => $wedding->id,
            ]
        );
    }
}
