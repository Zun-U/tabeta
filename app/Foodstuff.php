<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodstuff extends Model
{
    // 多対1のリレーション
    public function recipe()
    {
        return $this->belongsTo('App/recipe');
    }
}
