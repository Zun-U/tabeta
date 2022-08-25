<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showUser()
    {

        $bookmarks = Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(4);

        $mypages = Auth::user()->recipes()->orderBy('created_at', 'desc')->paginate(4);

        return view('user/mypage')->with(compact('mypages', 'bookmarks'));
    }


    // プロフィール画像編集
    public function editImage(Request $request)
    {


        $user = Auth::user();

        // Storegaにある現在のプロフィール画像の削除
        $deleteImagePath = $user->image;

        // 必要なパスのみ取得
        $path = substr($deleteImagePath, 9);

        Storage::disk('public')->delete($path);


        // JavaScriptから渡されてきたプロフィール画像ファイルの取得
        $profileImage = $request->file('file');


        // 画像ファイルがあれば
        if (isset($profileImage)) {
            $image_path = Storage::disk("public")->putFile('profile', $profileImage);
            $imagePath = "/storage/" . $image_path;
            $user->image = $imagePath;
        }
        // 画像ファイルがなければ
        else {
            $image_path = null;
        }

        // usersテーブルにしまう
        $user->save();

        $user_image = $user;

        // 変更した現在のユーザーの最新プロフィール画像を返す。
        return response()->json(['user_image' => $user_image]);
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


        $bookmarks = Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(4);

        $mypages = Auth::user()->recipes()->orderBy('created_at', 'desc')->paginate(4);

        return view('user/mypage')->with(compact('mypages', 'bookmarks'));
    }
}
