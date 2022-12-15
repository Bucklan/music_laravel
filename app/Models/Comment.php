<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text','user_id','music_id',];

    public function music(){
        return $this->belongsTo(Music::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
