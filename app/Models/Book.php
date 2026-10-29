<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'title',
        'author',
        'isbn',
        'publication_date',
        'description',
        'favorite_ave',
        'image_url',
    ];

public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites', 'book_id', 'user_id');
}

    


public function genres()
{
    return $this->belongsToMany(Genre::class, 'book_genres', 'book_id', 'genre_id');
}


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}


