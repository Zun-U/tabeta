<?php


Route::group(['middleware' => 'auth'], function () {

    // レシピ一覧画面
    Route::get('/', 'RecipeController@getArticleAll')->name('articles');

    // レシピ作成画面
    Route::get('/recipes/create', 'RecipeController@showCreateForm')->name('recipes.create');
    Route::post('/recipes/create', 'RecipeController@createRecipe');


    Route::get('/recipes/{recipe}/preview', 'RecipeController@showRecipe')->name('recipe.preview');


});

// ユーザー認証機能
Auth::routes();
