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

Route::get('/books/{books}', [Controller::class, 'form']);

Route::get('/books/create', [Controller::class, 'create'])->name('books.create');

Route::get('/ranking', [Controller::class, 'ranking'])->name('ranking.index');

Route::get('/favorites', [Controller::class, 'favorites'])->name('favorites.index');

// ジャンル一覧
Route::get('/genres', [Controller::class, 'genres'])->name('genres.index');

// ジャンル登録
Route::get('/genres/create', [Controller::class, 'genres_create'])->name('genres.create');

// ジャンル保存（store）
Route::post('/genres', [Controller::class, 'genres_store'])->name('genres.store');

// ジャンル詳細
Route::get('/genres/{genre}', [Controller::class, 'genres_show'])->name('genres.show');


// ページ内容確認用(使用後消去)
// Route::get('/login}', [Controller::class, 'login'])->name('login');

//  Route::get('/register', [Controller::class, 'register'])->name('register');


