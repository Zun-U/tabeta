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
    Route::post('/recipes/edit/{recipe}', 'EditController@editRecipe')->name('recipe.update');

    // レシピ削除
    Route::post('/destroy/{recipe}', 'EditController@destroyRecipe')->name('recipe.destroy');

    // 投稿レシピ一覧
    Route::get('/user/myrecipe/{user}', 'MypageController@showMyRecipe')->name('my.recipe');

    // ブックマーク済みレシピ一覧
    Route::get('/user/mybookmark/{user}', 'MypageController@showMyBookmark')->name('my.bookmark');

});

// ユーザー認証機能
Auth::routes();
