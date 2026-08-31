<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // 山田太郎

        $books = [
            [
                'title' => '吾輩は猫である',
                'author' => '夏目漱石',
                'isbn' => '9784101010014',
                'publication_date' => '1905-01-01',
                'genres' => ['小説'],
                'description' => '夏目漱石によるユーモア文学の代表作。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=1',
            ],
            [
                'title' => '人を動かす',
                'author' => 'D・カーネギー',
                'isbn' => '9784422100524',
                'publication_date' => '1936-10-01',
                'genres' => ['ビジネス', '自己啓発'],
                'description' => '人間関係の基本原則を説いた世界的名著。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=2',
            ],
            [
                'title' => 'リーダブルコード',
                'author' => 'Dustin Boswell',
                'isbn' => '9784873115658',
                'publication_date' => '2012-06-23',
                'genres' => ['技術書'],
                'description' => '読みやすいコードを書くための実践的ガイド。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=3',
            ],
            [
                'title' => '7つの習慣',
                'author' => 'スティーブン・R・コヴィー',
                'isbn' => '9784863940246',
                'publication_date' => '2013-08-30',
                'genres' => ['ビジネス', '自己啓発'],
                'description' => '人生を変えるための7つの原則を解説。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=4',
            ],
            [
                'title' => '坊っちゃん',
                'author' => '夏目漱石',
                'isbn' => '9784101010021',
                'publication_date' => '1906-04-01',
                'genres' => ['小説'],
                'description' => '正義感あふれる主人公の痛快な物語。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=5',
            ],
            [
                'title' => 'サピエンス全史',
                'author' => 'ユヴァル・ノア・ハラリ',
                'isbn' => '9784309226712',
                'publication_date' => '2016-09-08',
                'genres' => ['歴史', '科学'],
                'description' => '人類の進化と文明の歴史を壮大に描く。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=6',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9784048930598',
                'publication_date' => '2017-12-18',
                'genres' => ['技術書'],
                'description' => 'プロフェッショナルなコードを書くための原則。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=7',
            ],
            [
                'title' => '嫌われる勇気',
                'author' => '岸見一郎・古賀史健',
                'isbn' => '9784478025819',
                'publication_date' => '2013-12-13',
                'genres' => ['自己啓発'],
                'description' => 'アドラー心理学をわかりやすく解説。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=8',
            ],
            [
                'title' => '火花',
                'author' => '又吉直樹',
                'isbn' => '9784163902302',
                'publication_date' => '2015-03-11',
                'genres' => ['小説'],
                'description' => '芸人の世界を描いた芥川賞受賞作。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=9',
            ],
            [
                'title' => 'FACTFULNESS',
                'author' => 'ハンス・ロスリング',
                'isbn' => '9784822289607',
                'publication_date' => '2019-01-11',
                'genres' => ['ビジネス', '科学'],
                'description' => '世界を正しく理解するための10の思考法。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=10',
            ],
            [
                'title' => 'コンテナ物語',
                'author' => 'マルク・レビンソン',
                'isbn' => '9784822251468',
                'publication_date' => '2007-01-18',
                'genres' => ['ビジネス', '歴史'],
                'description' => '物流革命をもたらしたコンテナの歴史。',
                'image_url' => 'https://placehold.co/200x300/e2e8f0/475569?text=11',
            ],
        ];

        foreach ($books as $data) {

            // ISBN 重複防止
            $book = Book::firstOrCreate(
                ['isbn' => $data['isbn']],
                [
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'publication_date' => $data['publication_date'],
                    'description' => $data['description'],
                    'image_url' => $data['image_url'],
                    'user_id' => $user->id,
                ]
            );

            // ジャンル紐付け
            $genreIds = Genre::whereIn('name', $data['genres'])->pluck('id')->toArray();
            $book->genres()->sync($genreIds);
        }
    }
}
