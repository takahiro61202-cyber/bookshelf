<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;

class ReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(5)->get();   // 5人のユーザー
        $books = Book::all();            // 11冊の書籍

        $comments = [
            'とても面白かったです！また読みたいと思いました。',
            '内容が深くて考えさせられました。',
            'テンポが良くて読みやすかったです。',
            '少し難しかったですが、学びが多かったです。',
            '感動しました。友達にもおすすめしたいです。',
            '期待以上の内容でした！',
            'ところどころ退屈でしたが、全体的には良かったです。',
            '作者の考え方に共感できました。',
            '読み応えがありました。',
            'ストーリー展開が素晴らしかったです。',
        ];

        foreach ($books as $book) {

            // 各書籍に 2〜4 件のレビューを作成
            $reviewCount = rand(2, 4);

            for ($i = 0; $i < $reviewCount; $i++) {

                Review::create([
                    'user_id' => $users->random()->id,
                    'book_id' => $book->id,
                    'rating' => rand(3, 5),
                    'comment' => $comments[array_rand($comments)],
                ]);
            }
        }
    }
}
