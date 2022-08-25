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

        // ログインしているユーザーのお気に入り記事のみ取得
        $bookmarks = Auth::user()->bookmark_articles;

        $mypages = User::with('recipes')->find(Auth::user()->id);

        return view('user/mypage')->with(compact('mypages', 'bookmarks'));
    }


    // プロフィール画像編集
    public function editImage(Request $request)
    {


        $user = Auth::user();

        // プロフ画像ファイルの取得
        $profileImage = $request->file('file');


        // dd($profileImage);

        // 画像ファイルがあれば
        if (isset($profileImage)) {
            $image_path = Storage::disk("public")->putFile('profile', $profileImage);
            $imagePath = "/storage/" . $image_path;

            dd($imagePath);
            dd($user->image);
            exit;

            $user->image = $imagePath;
        }
        // 画像ファイルがなければ
        else {
            $image_path = null;
        }


        // unset($request->all()['_token']);

        // usersテーブルにしまう
        $user->save();

        $user_image_path = $user->image;

        $user_image = [
            'user_image_path' => $user_image_path,
        ];

        return response()->json($user_image);
    }



    // ユーザープロフィールの編集
    public function editUser(Request $request)
    {

        $user = Auth::user();

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        if ($name) {
            $user->name = $name;
        }

        if ($email) {
            $user->email = $email;
        }

        if ($password) {
            $user->password = bcrypt($password);
        }

        $user->save();


        $bookmarks = Auth::user()->bookmark_articles;

        $mypages = User::with('recipes')->find(Auth::user()->id);

        return view('user/mypage')->with(compact('mypages', 'bookmarks'));
    }
}
