<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // メッセージを取得
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
