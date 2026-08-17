<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Genre;

class Controller extends BaseController
{
    public function index()
    {
        $books = collect();
        return view('books.index',compact('books'));
    }

    public function form()
    {
        $genres = collect();
        return view('books._form',compact('genres'));
    }

    public function create()
    {
        $books = collect();
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
        $genres = collect();
        return view('genres.index',compact('genres'));
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

    return redirect()->route('genres.index');
    }

    public function genres_show()
    {
        return view('genres.show');
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

