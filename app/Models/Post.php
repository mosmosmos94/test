<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'description',
        'image',
        'user_id',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function Comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
