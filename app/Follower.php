<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    // 多対1のリレーション
    public function users()
    {
        return $this->belongsTo('App/User');
    }
}
