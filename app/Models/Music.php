<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = ['name_music', 'singer','mp3', 'category_id', 'user_id', 'date', 'image','text'];//category_id

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->HasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usersRated()
    {
        return $this->belongsToMany(User::class, 'rating')->withPivot('rating')->withTimestamps();
    }

    public function usersLike()
    {
        return $this->belongsToMany(User::class, 'like')
            ->withPivot('like')
            ->withTimestamps();
    }

    public function musicsSubscribed()
    {
        return $this->belongsToMany(Music::class, 'subscription')
            ->withTimestamps()
            ->withPivot('months');
    }

}
