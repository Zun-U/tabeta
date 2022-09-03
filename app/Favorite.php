<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // 多対1のリレーション
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function recipes()
    {
        return $this->belongsTo('App\Recipe');
    }
}
