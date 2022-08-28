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
    Route::get('/user/mypage/{user}', 'MypageController@showUser')->name('mypage.show');

    // プロフィール画像
    Route::post('/myprofile', 'MypageController@editImage')->name('myprofile.edit');

    // ユーザー情報更新
    Route::post('/user/mypage', 'MypageController@editUser')->name('user.edit');


    // いいね機能（Ajax）
    Route::post('/like', 'LikeController@like')->name('recipe.like');

    // ブックマ－ク（Ajax）
    Route::post('/bookmark', 'BookmarkController@bookmark')->name('recipe.bookmark');

    // レシピ編集画面
    Route::get('/recipes/edit/{recipe}', 'EditController@showEditForm')->name('recipe.edit');
    Route::patch('/recipes/edit', 'EditController@editRecipe')->name('recipe.update');

});

// ユーザー認証機能
Auth::routes();
