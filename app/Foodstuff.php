<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodstuff extends Model
{

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'food',
        'amount',
    ];

    // タイムスタンプを無効にする。
    public $timestamps = false;

    // 多対1のリレーション
    public function recipes()
    {
        return $this->belongsTo('App\recipe');
    }
}
