<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // $fillableに設定したもの以外のカラムはユーザーが変更できないようにできる
    protected $fillable = ['title', 'body'];


    // Postテーブルを軸にUserテーブルとリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
