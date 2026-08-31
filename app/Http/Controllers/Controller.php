<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class Controller extends BaseController
{
    public function index()
    {
    $books = Book::paginate(10); 
        return view('books.index',compact('books'));
    }

        public function books_show(Book $book)
    {
        $books = collect();
        return view('books.show',compact('book'));
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

    public function ranking()
    {
        $rankedBooks = collect();
        return view('ranking.index',compact('rankedBooks'));
    }

    public function favorites()
    {
        $books = collect();
        return view('favorites.index',compact('books'));
    }

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



    // public function login()
    // {
    //     return view('auth.login');
    // }

    // public function register()
    // {
    //     return view('auth.register');
    // }
}

