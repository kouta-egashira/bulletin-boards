<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    // コメントは一つの投稿にしている
    public function post()
    {
        return $this->belongsTo('App\Models\post');
    }

    // Commentsテーブルを軸にUsersテーブルとリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
