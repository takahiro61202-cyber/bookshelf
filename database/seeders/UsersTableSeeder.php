<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => '山田太郎',   'email' => 'yamada@example.com',   'password' => 'password'],
            ['name' => '鈴木花子',   'email' => 'suzuki@example.com',   'password' => 'password'],
            ['name' => '田中一郎',   'email' => 'tanaka@example.com',   'password' => 'password'],
            ['name' => '佐藤美咲',   'email' => 'sato@example.com',     'password' => 'password'],
            ['name' => '高橋健太',   'email' => 'takahashi@example.com','password' => 'password'],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']], // ← 重複チェック
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']), // ← ハッシュ化
                ]
            );
        }
    }
}
