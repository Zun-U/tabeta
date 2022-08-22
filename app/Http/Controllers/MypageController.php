<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showUser()
    {

        //ログインしているユーザーに紐づくrecipeテーブル、favoriteテーブルを取得
        $mypages = User::with(['recipes', 'favorites'])->withCount('likes')->withCount('favorites')->find(Auth::user()->id);


        return view('user/mypage', compact('mypages'));
    }

    public function editImage()
    {
    }
}
