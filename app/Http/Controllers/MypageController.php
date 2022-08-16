<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showUser()
    {
        return view('user/mypage');
    }

    public function editImage()
    {
        
    }
}
