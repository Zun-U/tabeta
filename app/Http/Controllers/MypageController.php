<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;


use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showUser()
    {

        // ログインしているユーザーのお気に入り記事のみ取得
        $bookmarks = Auth::user()->bookmark_articles;

        // dd($bookmarks);
        // exit;

        //ログインしているユーザーに紐づくrecipeテーブル、favoriteテーブルを取得
        // $mypages = User::orderBy("created_at", "desc")->find(Auth::user()->id);

        // $mypages = User::with(['recipes', 'favorites'])->find(Auth::user()->id);

        $mypages = User::with('recipes')->find(Auth::user()->id);


        // dd($mypages);
        // exit;


        // return view('user/mypage', compact('mypages'));

        return view('user/mypage')->with(compact('mypages', 'bookmarks'));
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
