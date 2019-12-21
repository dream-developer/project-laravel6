<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['category_id' , 'title', 'body'];
    // カテゴリー取得
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    // ユーザー取得
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
