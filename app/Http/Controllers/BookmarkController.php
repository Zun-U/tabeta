<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Favorite;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
  public function bookmark(Request $request)
    {
        
        $user_id = Auth::user()->id;

        $recipe_id = $request->recipe_id;
        
        $already_marked = Favorite::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();
        
        if (!$already_marked) {

            $favorite = new Favorite;

            $favorite->recipe_id = $recipe_id;

            $favorite->user_id = $user_id;

            $favorite->save();

        } else {
            Favorite::where('recipe_id', $recipe_id)->where('user_id', $user_id)->delete();
        }


        $recipe_bookmark_count = Recipe::withCount('favorites')->findOrFail($recipe_id)->bookmarks_count;

        dd($recipe_bookmark_count);
        exit;

        $param = [
            'recipe_bookmark_count' => $recipe_bookmark_count,
        ];

        return response()->json($param);
    }  
}
