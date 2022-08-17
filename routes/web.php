<?php


Route::group(['middleware' => 'auth'], function () {

    // レシピ一覧画面
    Route::get('/', 'ArticlesController@getArticleAll')->name('articles.index');

    // レシピ詳細画面
    Route::get('/recipes/recipe/{recipe}', 'ArticlesController@getArticleDetail')->name('article.detail');

    // レシピ作成画面
    Route::get('/recipes/create', 'RecipeController@showCreateForm')->name('recipes.create');
    Route::post('/recipes/create', 'RecipeController@createRecipe');

    // プレビュー画面
    Route::get('/recipes/preview/{recipe}', 'RecipeController@showPreview')->name('recipe.preview');

    // マイページ
    Route::get('/user/mypage', 'MypageController@showUser')->name('mypage.show');

    Route::post('/user/mypage', 'MypageController@editImage');

    // いいね機能（Ajax）
    Route::post('/like', 'LikeController@like')->name('recipe.like');

    //ブックマーク機能(Ajax)
    Route::post('/bookmark', 'BookmarkController@bookmark')->name('recipe.bookmark');

});

// ユーザー認証機能
Auth::routes();
