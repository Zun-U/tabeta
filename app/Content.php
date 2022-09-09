<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'recipe_image',
    ];


    // タイムスタンプを無効にする。
    public $timestamps = false;

    // 多対1のリレーション
    public function recipes()
    {
        return $this->belongsTo('App\recipe');
    }
}
