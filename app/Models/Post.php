<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    //define relationship with post owner user
    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    //define relationship betwen posts and comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //define reslationship with likes in the post

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //verify if a user likes to post
    public function checkLike(User $user){
        return $this->likes->contains('user_id',$user->id);
    }
}
