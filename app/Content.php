<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    // 多対1のリレーション
    public function recipe()
    {
        return $this->belongsTo('App/recipe');
    }
}
