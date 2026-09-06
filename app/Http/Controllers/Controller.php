<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
// 本関係
    public function index()
    {
    $books = Book::paginate(10); 
        return view('books.index',compact('books'));
    }

public function books_show(Book $book)
{
    return view('books.show', compact('book'));
}

    public function books_create()
    {
        $genres = collect();
        return view('books._form',compact('genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('books.create',compact('books'));
    }
// ランキング関係
    public function ranking()
    {
        $rankedBooks = collect();
        return view('ranking.index',compact('rankedBooks'));
    }
// お気に入り関係
public function favorites()
{
    $user = Auth::user();

    $books = $user->favoriteBooks()->paginate(10);

    return view('favorites.index', compact('books'));
}

    public function toggle(Book $book)
{
    $user = Auth::user();

    if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
        $user->favoriteBooks()->detach($book->id);
    } else {
        $user->favoriteBooks()->attach($book->id);
    }

    return back(); // ← ページ移動しない（元のページに戻る）
}
// ジャンル関係
    public function genres()
    {
    $genres = Genre::withCount('books')->get();
    return view('genres.index', compact('genres'));
    }

    public function genres_create()
    {
    return view('genres.create');
    }

    public function genres_store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    

    Genre::create($validated);

    return redirect()->route('genres.create')->with('success', 'ジャンルを登録しました');
    }

    public function genres_update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($validated);

        return redirect()->route('genres.index');
        // ->with('success', 'ジャンルを更新しました');
    }

        public function genres_edit(Genre $genre)
    {
        
        return view('genres.edit', compact('genre'));
        }

    public function genres_destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', 'ジャンルを削除しました');
    }

    public function genres_show(Genre $genre)
    {
            $books = $genre->books()->paginate(10);
        return view('genres.show', compact('genre','books'));
    }
    // review関連



    
public function reviewStore(Request $request)
{
    $validated = $request->validate([
        'comment' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'book_id' => 'required|exists:books,id',
    ]);

    Review::create([
        'comment' => $validated['comment'],
        'rating' => $validated['rating'],
        'book_id' => $validated['book_id'],
        'user_id' => Auth::id(),
    ]);

    return back()->with('success', 'レビューを投稿しました');
}
// レビュー参考ボタン
public function like(Review $review)
{
    $user = Auth::user();

    if ($user->likedReviews()->where('review_id', $review->id)->exists()) {
        $user->likedReviews()->detach($review->id);
    } else {
        $user->likedReviews()->attach($review->id);
    }

    return back();
}





    // public function login()
    // {
    //     return view('auth.login');
    // }

    // public function register()
    // {
    //     return view('auth.register');
    // }
}

