<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [Controller::class, 'index'])->name('books.index');

Route::get('/books/create', [Controller::class, 'books_create'])->name('books.create');
Route::post('/books', [Controller::class, 'books_store'])->name('books.store');

Route::get('/books/{book}', [Controller::class, 'books_show'])->name('books.show');

Route::get('/books/{book}/edit', [Controller::class, 'books_edit'])->name('books.edit');

Route::get('/ranking', [Controller::class, 'ranking'])->name('ranking.index');
// お気に入り一覧
Route::get('/favorites', [Controller::class, 'favorites'])->name('favorites.index');

// お気に入り登録機能
Route::post('/favorites/toggle/{book}', [Controller::class, 'toggle'])->name('favorites.toggle');

// ジャンル一覧
Route::get('/genres', [Controller::class, 'genres'])->name('genres.index');

// ジャンル登録
Route::get('/genres/create', [Controller::class, 'genres_create'])->name('genres.create');

// ジャンル保存（store）
Route::post('/genres', [Controller::class, 'genres_store'])->name('genres.store');

// ジャンル更新処理
Route::put('/genres/{genre}', [Controller::class, 'genres_update'])->name('genres.update');

// ジャンル削除
Route::delete('/genres/{genre}', [Controller::class, 'genres_destroy'])->name('genres.destroy');

// ジャンル編集画面
Route::get('/genres/{genre}/edit', [Controller::class, 'genres_edit'])->name('genres.edit');

// ジャンル詳細
Route::get('/genres/{genre}', [Controller::class, 'genres_show'])->name('genres.show');

// review
Route::post('/reviews', [Controller::class, 'reviewStore'])->name('reviews.store');

// レビュー参考ボタン
Route::post('/reviews/{review}/like', [Controller::class, 'like'])->name('reviews.like');

// ページ内容確認用(使用後消去)
// Route::get('/login}', [Controller::class, 'login'])->name('login');

//  Route::get('/register', [Controller::class, 'register'])->name('register');

Route::redirect('/home', '/');



