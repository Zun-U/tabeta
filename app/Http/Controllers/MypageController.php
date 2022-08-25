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

        // ログインしているユーザーのお気に入り記事のみ取得
        // $bookmarks = DB::table('users')
        // ->select('favorites.user_id as favorites_user_id', 'recipes.*')
        // ->join('favorites', 'favorites.user_id', '=', 'users.id')
        // ->join('recipes','recipes.id', '=', 'favorites.recipe_id')
        // ->where('users.id', '=', Auth::user()->id)
        // ->paginate(4);



        $bookmarks = Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(4);

        $mypages = Auth::user()->recipes()->orderBy('created_at', 'desc')->paginate(4);
        // dd($mypages);
        // exit;

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

            // dd($imagePath);
            // exit;

            $user->image = $imagePath;
        }
        // 画像ファイルがなければ
        else {
            $image_path = null;
        }

        // usersテーブルにしまう
        $user->save();

        return response()->json();
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
