<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showUser()
    {

        //ログインしているユーザーに紐づくrecipeテーブル、favoriteテーブルを取得
        $mypages = User::with(['recipes', 'favorites'])->withCount('likes')->withCount('favorites')->find(Auth::user()->id);


        // $paginations = Auth::user()->favorites->sortBy('created_at');

        // dd($paginations);
        // exit;

        return view('user/mypage', compact('mypages'));

        // return view('user/mypage')->with(compact("mypages", "paginations"));


        return view('user/mypage', compact('mypages'));

    }


    // プロフィール画像編集
    public function editImage(Request $request)
    {


        // プロフ画像ファイルの取得
        $profileImage = $request->file('file');

        dd($profileImage);
        exit;

        // 画像ファイルがあれば
        if ($profileImage) {
            $image_path = Storage::disk("public")->putFile('profile', $profileImage);
            $imagePath = "/storage/" . $image_path;
            Auth::user()->image = $imagePath;
        }
        // 画像ファイルがなければ
        else {
            $image_path = null;
        }

        Auth::user()->save();

        return response()->json();



    }
}
