<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // 多対1のリレーション
    public function users()
    {
        return $this->belongsTo('App/Recipe');
    }
}
